<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	public $data;
	public function __construct()
	{
		parent::__construct();

		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
		$this->store_salt = $this->config->item('store_salt', 'ion_auth');
		$this->lang->load('auth');
	}

	// redirect if needed, otherwise display the user list
	public function index()
	{

		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login', 'refresh');
		}
		elseif (!$this->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
		{
			// redirect them to the home page because they must be an administrator to view this
			return show_error('You must be an administrator to view this page.');
		}
		else
		{
			// set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			//list the users
			$this->data['users'] = $this->ion_auth->users()->result();
			foreach ($this->data['users'] as $k => $user)
			{
				$this->data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
			}

			$this->_render_page('auth/index', $this->data);
		}
	}
	public function AccesoLogeo($cUser, $cPass = '')
	{		
		if ($cUser != NULL) $cUser = "'{$this->db->escapeString($cUser)}'"; else $cUser = "NULL";
		if ($cPass != NULL) $cPass = "'{$this->db->escapeString($this->db->Encriptar($cUser,$cPass))}'"; else $cPass = "NULL";
		//echo "AccessLogin<br />";
		$rs = $this->ObtengoUsuario('', $cUser, $cPass);	
		
		if ($rs !== false )
		{
			//Verificamos si se encuentra logueado
			$cSql = "SELECT * FROM AD_C_USUARIO WHERE ID_USUARIO = {$this->getId_Usuario()} AND CONECTADO = 'N' AND ESTATUS IS NULL";	
			$rs1 = $this->db->query($cSql,0);
			if ($rs1 !== false)
			{
				if($this->db->numRows($cSql) > 0)
				{
                                    //Registramos el acceso
                                    $this->db->query("UPDATE AD_C_USUARIO SET ULTIMO_ACCESO = SYSDATE, IP ='".GetUserIp()."', CONECTADO = 'S' WHERE USUARIO = '{$this->getUsuario()}'",0);
                            
					$_SESSION['cUsuario'] = $this->getUsuario();
					$_SESSION['cNombreUser'] = trim($this->getNombreUsr())." ".trim($this->getPaternoUsr())." ".trim($this->getMaternoUsr());
					$_SESSION['nId_Usuario'] = $this->getId_Usuario();
					$_SESSION['nId_Perfil'] = $this->getId_Perfil();
					$_SESSION['nId_Proveedor'] = $this->getId_Proveedor();
					$_SESSION['nId_Empleado'] = $this->getId_Empleado();
			
					//Asignamos las cookies
					setcookie("nId_Usuario",$_SESSION['nId_Usuario']);
					setcookie("nId_Perfil",$_SESSION['nId_Perfil']);
					setcookie("cUsuario",$_SESSION['cUsuario']);
					
					//Se direcciona a pagina de administrarSitio.php
					header('Location: administrarSitio.php');					
				}
				else 
				{	
		    		return "false|El Usuario ya se encuentra ingresado en el sistema<br />NO PUEDE INGRESAR HASTA QUE CIERRE LA SESI&Oacute;N ABIERTA.|";
		    	}
			}			
		}
		else
		{
			//Verficamos que no este reseteada la contraseña
			$rs = $this->ObtengoUsuario('', $cUser, 'NULL');
			
			if ($rs !== false )
			{
				$this->db->query("UPDATE AD_C_USUARIO SET CLAVE = $cPass WHERE USUARIO = $cUser AND ESTATUS IS NULL",0);				
				return "true|Por favor confirme su contrase&ntilde;a.|".$cUser;
			}
			else{

				return "false|El Usuario y Contrase&ntilde;a NO son validos.<br>Por favor verifiquelas.|";
			}					
		}		
	}//End metodo

	function ldap_data($arr){



		if(isset($arr['sn'][0]) && isset($arr['givenname'][0])){
			$person['FIRST_NAME'] = $arr['givenname'][0];
			$person['LAST_NAME'] = $arr['sn'][0];
		}else{
			if(isset($arr['cn'][0])){
				$person['FIRST_NAME'] = '';
				$person['LAST_NAME'] = '';
				$arrNom = explode(' ', $arr['cn'][0]);
				$ultimo = count($arrNom) - 1;
				for ($a=0; $a < count($arrNom); $a++) { 
					if($a == $ultimo || $a == ($ultimo-1)){
						$person['LAST_NAME'] .= ' ' . $arrNom[$a];
					}else{
						$person['FIRST_NAME'] .= ' ' .  $arrNom[$a];
					}
				}
			}
		}

		/*
		if(isset($arr['email'][0])){
			$person['EMAIL'] = $arr['email'][0];
		}elseif(isset($arr['proxyaddresses'][0])){
			$person['EMAIL'] = str_replace('sip:', '', $arr['proxyaddresses'][0]);
		}
		*/
		if(isset($arr['physicaldeliveryofficename'][0])){
			$person['COMPANY'] = $arr['physicaldeliveryofficename'][0];

		}


		return $person;

	}

	public function ldap($LDAP_USER = '',$LDAP_PASS = ''){
		$R['success'] = 0;
		$R['error'] = 0;
		$person = array();
		$filtrar = true;
		$encontrado = 0;
		$ldap_data = $this->ion_auth->ldap_data();

		//echo '<pre>';
		//print_r($ldap_data);
		//exit();

		if(count($ldap_data) > 0){
		$ldapU = array();

		for ($l=0; $l < count($ldap_data); $l++) { 
			$LDAP_USER2 = $LDAP_USER . '@' . str_replace(',', '.', 'ac,sep,gob,mx');
			//$ldap_data[$l]['SERVIDOR'],$ldap_data[$l]['PUERTO']
			$ldap = @ldap_connect('10.2.10.82',389);
			//$bind = @ldap_bind ($ldap, $LDAP_USER2, $LDAP_PASS);
			$bind = @ldap_bind ($ldap, utf8_decode($LDAP_USER2), utf8_decode($LDAP_PASS));


			if(!$bind) {  // If Bind Failed then.
			    if (ldap_errno($ldap) == 49) {
			        //Invalid Credentials
			        $R['success'] = 0;
			        $R['error'] = 1;
			        $R['message'] = ' El servidor de dominio (Directorio Activo) rechazó los datos de usuario introducidos.';
			    } else {
			    //LDAP Connection to LDAP Server Failed
			        $R['success'] = 0;
			        $R['error'] = 2;
			        $R['message'] = 'Error en la conexión con el servidor LDAP';
			    }
			}else{
		        
				$arrOU = explode(',', 'UR ' . $ldap_data[$l]['NOMBRE_LDAP_UR'] . '0,Usuarios SEP');
				$arrDC = explode(',', 'ac,sep,gob,mx');
				$ldaptree = '';
				for ($o=0; $o < count($arrOU); $o++) { 
					$ldaptree .= 'OU=' . ltrim(rtrim($arrOU[$o])) . ',';
				}

				for ($d=0; $d < count($arrDC); $d++) { 
					$ldaptree .= 'DC=' . ltrim(rtrim($arrDC[$d])) . ',';
				}

				$ldaptree = substr($ldaptree, 0, -1);

				/*
		        $result = ldap_search($ldap,"$ldaptree", "(cn=*)") or die ("Error in search query: ".ldap_error($ldap));


		        $data = ldap_get_entries($ldap, $result);


		        // iterate over array and print data for each entry
			        for ($i=0; $i<$data["count"]; $i++) {
			        	//proxyaddresses
			        	if(isset($data[$i]["mail"][0])){
			        			$arrEmail = explode('@', $data[$i]["mail"][0]);
			        			
			        			if($arrEmail[0] == $LDAP_USER && count($ldapU) == 0){
			        				$person = $this->ldap_data($data[$i]);
			        				$person['UR'] = $ldap_data[$l]['NOMBRE_LDAP_UR'];
			        				$person['NOMBRE_USUARIO'] = $LDAP_USER;
			        				$person['PASSWORD'] = $LDAP_PASS;

			        			}
			        	}
			        	if(isset($data[$i]["proxyaddresses"][0])){
			        			$arrEmail = explode('@', $data[$i]["proxyaddresses"][0]);
			        			$orig = str_replace('sip:', '', $data[$i]["proxyaddresses"][0]);
			        			
			        			if($orig ==  $LDAP_USER && count($ldapU) == 0){
			        				$person = $this->ldap_data($data[$i]);
			        				$person['UR'] = $ldap_data[$l]['NOMBRE_LDAP_UR'];
			        				$person['NOMBRE_USUARIO'] = $LDAP_USER;
			        				$person['PASSWORD'] = $LDAP_PASS;
			        			}
			        	}
			        }

		        	if(isset($person['NOMBRE_USUARIO'])){
		        		$R['success'] = 1;
		        		$R['error'] = 0;
		        		$R['message'] = 'Usuario encontrado';
		        		$R['person'] = $person;
		        	}else{
		        		$R['success'] = 0;
		        		$R['error'] = 3;
		        		$R['message'] = 'Usuario no encontrado';
		        	}
		        	*/


			        $R['success'] = 1;
			        $R['error'] = 0;
			        $R['message'] = 'Usuario validado';
			        $R['person']['NOMBRE_USUARIO'] = $LDAP_USER;
			        $R['person']['PASSWORD'] = $LDAP_PASS;


			}

		}

	}
		ldap_close($ldap);
		return $R;
	}


/*
	public function ldap($LDAP_USER = '',$LDAP_PASS = ''){
		$R['success'] = 0;
		$R['error'] = 0;
		$person = array();
		$filtrar = false;
		$encontrado = 0;
		$ldap_data = $this->ion_auth->ldap_data();
		if(count($ldap_data) > 0){
		$ldapU = array();
			$LDAP_USER2 = $LDAP_USER . '@' . str_replace(',', '.', 'ac,sep,gob,mx');
			$ldap = @ldap_connect('10.2.10.82',389);
			ldap_set_option( $ldap, LDAP_OPT_PROTOCOL_VERSION, 3 );
			ldap_set_option( $ldap, LDAP_OPT_REFERRALS, 0 );
			//setlocale(LC_ALL,'es_MX.UTF-8');
			//echo utf8_encode($LDAP_PASS);
			//exit();

			$bind = @ldap_bind ($ldap, utf8_decode($LDAP_USER2), utf8_decode($LDAP_PASS));


			if(!$bind) {  // If Bind Failed then.
			    if (ldap_errno($ldap) == 49) {
			        //Invalid Credentials
			        $R['success'] = 0;
			        $R['error'] = 1;
			        $R['message'] = ' El servidor de dominio (Directorio Activo) rechazó los datos de usuario introducidos.';
			    } else {
			    //LDAP Connection to LDAP Server Failed
			        $R['success'] = 0;
			        $R['error'] = 2;
			        $R['message'] = 'Error en la conexión con el servidor LDAP';
			    }

				ldap_close($ldap);
				return $R;
				exit();
			}else{
		for ($l=0; $l < count($ldap_data); $l++) { 
				$arrOU = explode(',', $ldap_data[$l]['OU']);
				$arrDC = explode(',', 'ac,sep,gob,mx');
				$ldaptree = '';
				for ($o=0; $o < count($arrOU); $o++) { 
					$ldaptree .= 'OU=' . ltrim(rtrim($arrOU[$o])) . ',';
				}

				for ($d=0; $d < count($arrDC); $d++) { 
					$ldaptree .= 'DC=' . ltrim(rtrim($arrDC[$d])) . ',';
				}

				$ldaptree = rtrim(ltrim(substr($ldaptree, 0, -1)));

				//$ldaptree = 'OU=UR 7130,OU=Usuarios SEP,DC=ac,DC=sep,DC=gob,DC=mx';
				//echo $ldaptree;
				//exit();

		        $result = ldap_search($ldap,"$ldaptree", "(cn=*)") or die ("Error in search query: ".ldap_error($ldap));
		        $data = ldap_get_entries($ldap, $result);





				$LDAP_USER = ($filtrar) ? 'pedro.gil': $LDAP_USER;

		        // iterate over array and print data for each entry
			        for ($i=0; $i<$data["count"]; $i++) {
			        	//proxyaddresses
			        	if(isset($data[$i]["samaccountname"][0])){
			        			$arrEmail = explode('@', $data[$i]["samaccountname"][0]);
			        			$abuscar = $arrEmail[0];
			        			if($abuscar == $LDAP_USER && count($ldapU) == 0){
			        				$person = $this->ldap_data($data[$i]);
			        				$person['UR'] = $ldap_data[$l]['NOMBRE_LDAP_UR'];
			        				$person['NOMBRE_USUARIO'] = $LDAP_USER;
			        				$person['PASSWORD'] = $LDAP_PASS;
			        				$person['MAIL'] = $data[$i]["samaccountname"][0];
			        				array_push($ldapU,$person);
			        			}
			        	}elseif(isset($data[$i]["proxyaddresses"][0])){
			        			$arrEmail = explode('@', $data[$i]["proxyaddresses"][0]);
			        			$orig = str_replace('sip:', '', $data[$i]["proxyaddresses"][0]);
			        			if($orig ==  $LDAP_USER && count($ldapU) == 0){
			        				$person = $this->ldap_data($data[$i]);
			        				$person['UR'] = $ldap_data[$l]['NOMBRE_LDAP_UR'];
			        				$person['NOMBRE_USUARIO'] = $LDAP_USER;
			        				$person['PASSWORD'] = $LDAP_PASS;
			        				$person['MAIL'] = $data[$i]["proxyaddresses"][0];
			        				array_push($ldapU,$person);
			        			}
			        	}elseif(isset($data[$i]["userprincipalname"][0])){
			        			$arrEmail = explode('@', $data[$i]["userprincipalname"][0]);
			        			$orig = str_replace('sip:', '', $arrEmail[0]);
			        			if($orig ==  $LDAP_USER && count($ldapU) == 0){
			        				$person = $this->ldap_data($data[$i]);
			        				$person['UR'] = $ldap_data[$l]['NOMBRE_LDAP_UR'];
			        				$person['NOMBRE_USUARIO'] = $LDAP_USER;
			        				$person['PASSWORD'] = $LDAP_PASS;
			        				$person['MAIL'] = $data[$i]["userprincipalname"][0];
			        				array_push($ldapU,$person);
			        			}
			        	}


			        }

			}
		
		}


		        	if(isset($ldapU[0]['NOMBRE_USUARIO'])){
		        		$R['success'] = 1;
		        		$R['error'] = 0;
		        		$R['message'] = 'Usuario encontrado';
		        		$R['person'] = $ldapU[0];
		        	}else{
		        		$R['success'] = 0;
		        		$R['error'] = 3;
		        		$R['message'] = 'Usuario no encontrado';
		        	}

	}
		ldap_close($ldap);
		return $R;
	}

	*/

	// log the user in
	public function login()
	{
		$data['title'] = $this->lang->line('login_heading');

		//validate form input
		$this->form_validation->set_rules('identity', str_replace(':', '', $this->lang->line('login_identity_label')), 'required');
		$this->form_validation->set_rules('password', str_replace(':', '', $this->lang->line('login_password_label')), 'required');

		if ($this->form_validation->run() == true)
		{

			if($this->input->post('identity') == 'proyectos'){
				$remember = (bool) $this->input->post('remember');
				$identity = $this->input->post('identity');
				if ($this->ion_auth->login($identity, $this->input->post('password'), $remember)){
					//if the login is successful
					//redirect them back to the home page
					$this->session->set_flashdata('message', $this->ion_auth->messages());
					redirect('/', 'refresh');
				}else{
					// if the login was un-successful
					// redirect them back to the login page
					$this->session->set_flashdata('message', $this->ion_auth->errors());
					redirect('auth/login', 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
				}

			}


			// Nombre de usuario es un email??
			$identityOri = $this->input->post('identity');
			$arrIdentity = explode('@', $identityOri);
			$identity = $arrIdentity[0];
			// Verificar en LDAP
			$ldap = $this->ldap($identity, $this->input->post('password'));
			if($ldap['success'] == 0){
				$this->data['message'] = $ldap['message'];
				$this->data['identity'] = array('name' => 'identity',
					'id'    => 'identity',
					'type'  => 'text',
					'value' => $this->form_validation->set_value('identity'),
				);
				$this->data['password'] = array('name' => 'password',
					'id'   => 'password',
					'type' => 'password',
				);

				$this->data['login'] = 1;

				$this->_render_page('auth/login', $this->data);
			}else{
				// El usuario ya existe en la base de datos ??
				$user_exist = $this->ion_auth->username_check($ldap['person']['NOMBRE_USUARIO']);
				// Registrar usuario
				if($user_exist){
					// Aztualizar contraseña
				if(isset($ldap['person']['NOMBRE_USUARIO']) && isset($ldap['person']['PASSWORD'])){
					$salt = $this->store_salt ? $this->ion_auth->salt() : FALSE;
					$password   = $this->ion_auth->hash_password($ldap['person']['PASSWORD'], $salt);
					$ID_USUARIO = $this->ion_auth->ldap_get_id_usuario($ldap['person']['NOMBRE_USUARIO']);
					if($ID_USUARIO > 0){
						$this->ion_auth->ldap_update_password($ID_USUARIO,$password);
					}
				}
				}else{
					// Registrar usuario
					if(isset($ldap['person']['NOMBRE_USUARIO']) && $ldap['person']['PASSWORD']){
						$additional_data = array();

					if(isset($ldap['person']['FIRST_NAME']) && isset($ldap['person']['LAST_NAME']) && isset($ldap['person']['COMPANY'])){
							$additional_data = array(
				                'FIRST_NAME' => $ldap['person']['FIRST_NAME'],
				                'LAST_NAME'  => $ldap['person']['LAST_NAME'],
				                'COMPANY'    => 'SEP - ' . $ldap['person']['COMPANY']
				            );

						}


						$EMAIL = (isset($ldap['person']['MAIL'])) ? $ldap['person']['MAIL'] : $ldap['person']['NOMBRE_USUARIO'];


					$this->ion_auth->register($ldap['person']['NOMBRE_USUARIO'], $ldap['person']['PASSWORD'], $EMAIL, $additional_data);
					}
				}
				// check to see if the user is logging in
				// check for "remember me"
				$remember = (bool) $this->input->post('remember');

				if ($this->ion_auth->login($identity, $this->input->post('password'), $remember)){
					//if the login is successful
					//redirect them back to the home page
					$this->session->set_flashdata('message', $this->ion_auth->messages());
					redirect('/', 'refresh');
				}else{
					// if the login was un-successful
					// redirect them back to the login page
					$this->session->set_flashdata('message', $this->ion_auth->errors());
					redirect('auth/login', 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
				}


			}

		}
		else
		{
			// the user is not logging in so display the login page
			// set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$this->data['identity'] = array('name' => 'identity',
				'id'    => 'identity',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('identity'),
			);
			$this->data['password'] = array('name' => 'password',
				'id'   => 'password',
				'type' => 'password',
			);

			$this->data['login'] = 1;

			$this->_render_page('auth/login', $this->data);
		}
	}

	// log the user out
	public function logout()
	{
		$this->data['title'] = "Logout";

		// log the user out
		$logout = $this->ion_auth->logout();

		// redirect them to the login page
		$this->session->set_flashdata('message', $this->ion_auth->messages());
		redirect('auth/login', 'refresh');
	}

	// change password
	public function change_password()
	{
		$this->form_validation->set_rules('old', $this->lang->line('change_password_validation_old_password_label'), 'required');
		$this->form_validation->set_rules('new', $this->lang->line('change_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
		$this->form_validation->set_rules('new_confirm', $this->lang->line('change_password_validation_new_password_confirm_label'), 'required');

		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login', 'refresh');
		}

		$user = $this->ion_auth->user()->row();

		if ($this->form_validation->run() == false)
		{
			// display the form
			// set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
			$this->data['old_password'] = array(
				'name' => 'old',
				'id'   => 'old',
				'type' => 'password',
			);
			$this->data['new_password'] = array(
				'name'    => 'new',
				'id'      => 'new',
				'type'    => 'password',
				'pattern' => '^.{'.$this->data['min_password_length'].'}.*$',
			);
			$this->data['new_password_confirm'] = array(
				'name'    => 'new_confirm',
				'id'      => 'new_confirm',
				'type'    => 'password',
				'pattern' => '^.{'.$this->data['min_password_length'].'}.*$',
			);
			$this->data['user_id'] = array(
				'name'  => 'user_id',
				'id'    => 'user_id',
				'type'  => 'hidden',
				'value' => $user->id,
			);

			// render
			$this->_render_page('auth/change_password', $this->data);
		}
		else
		{
			$identity = $this->session->userdata('identity');

			$change = $this->ion_auth->change_password($identity, $this->input->post('old'), $this->input->post('new'));

			if ($change)
			{
				//if the password was successfully changed
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				$this->logout();
			}
			else
			{
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect('auth/change_password', 'refresh');
			}
		}
	}

	// forgot password
	public function forgot_password()
	{
		// setting validation rules by checking whether identity is username or email
		if($this->config->item('identity', 'ion_auth') != 'email' )
		{
		   $this->form_validation->set_rules('identity', $this->lang->line('forgot_password_identity_label'), 'required');
		}
		else
		{
		   $this->form_validation->set_rules('identity', $this->lang->line('forgot_password_validation_email_label'), 'required|valid_email');
		}


		if ($this->form_validation->run() == false)
		{
			$this->data['type'] = $this->config->item('identity','ion_auth');
			// setup the input
			$this->data['identity'] = array('name' => 'identity',
				'id' => 'identity',
			);

			if ( $this->config->item('identity', 'ion_auth') != 'email' ){
				$this->data['identity_label'] = $this->lang->line('forgot_password_identity_label');
			}
			else
			{
				$this->data['identity_label'] = $this->lang->line('forgot_password_email_identity_label');
			}

			// set any errors and display the form
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$this->data['login'] = 1;
			$this->_render_page('auth/forgot_password', $this->data);
		}
		else
		{
			$identity_column = $this->config->item('identity','ion_auth');
			$identity = $this->ion_auth->where($identity_column, $this->input->post('identity'))->users()->row();

			if(empty($identity)) {

	            		if($this->config->item('identity', 'ion_auth') != 'email')
		            	{
		            		$this->ion_auth->set_error('forgot_password_identity_not_found');
		            	}
		            	else
		            	{
		            	   $this->ion_auth->set_error('forgot_password_email_not_found');
		            	}

		                $this->session->set_flashdata('message', $this->ion_auth->errors());
                		redirect("auth/forgot_password", 'refresh');
            		}

			// run the forgotten password method to email an activation code to the user
			$forgotten = $this->ion_auth->forgotten_password($identity->{$this->config->item('identity', 'ion_auth')});

			if ($forgotten)
			{
				// if there were no errors
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect("auth/login", 'refresh'); //we should display a confirmation page here instead of the login page
			}
			else
			{
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect("auth/forgot_password", 'refresh');
			}
		}
	}

	// reset password - final step for forgotten password
	public function reset_password($code = NULL)
	{
		if (!$code)
		{
			show_404();
		}

		$user = $this->ion_auth->forgotten_password_check($code);

		if ($user)
		{
			// if the code is valid then display the password reset form

			$this->form_validation->set_rules('new', $this->lang->line('reset_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
			$this->form_validation->set_rules('new_confirm', $this->lang->line('reset_password_validation_new_password_confirm_label'), 'required');

			if ($this->form_validation->run() == false)
			{
				// display the form

				// set the flash data error message if there is one
				$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

				$this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
				$this->data['new_password'] = array(
					'name' => 'new',
					'id'   => 'new',
					'type' => 'password',
					'pattern' => '^.{'.$this->data['min_password_length'].'}.*$',
				);
				$this->data['new_password_confirm'] = array(
					'name'    => 'new_confirm',
					'id'      => 'new_confirm',
					'type'    => 'password',
					'pattern' => '^.{'.$this->data['min_password_length'].'}.*$',
				);
				$this->data['user_id'] = array(
					'name'  => 'user_id',
					'id'    => 'user_id',
					'type'  => 'hidden',
					'value' => $user->id,
				);
				$this->data['csrf'] = $this->_get_csrf_nonce();
				$this->data['code'] = $code;

				// render
				$this->_render_page('auth/reset_password', $this->data);
			}
			else
			{
				// do we have a valid request?
				if ($this->_valid_csrf_nonce() === FALSE || $user->id != $this->input->post('user_id'))
				{

					// something fishy might be up
					$this->ion_auth->clear_forgotten_password_code($code);

					show_error($this->lang->line('error_csrf'));

				}
				else
				{
					// finally change the password
					$identity = $user->{$this->config->item('identity', 'ion_auth')};

					$change = $this->ion_auth->reset_password($identity, $this->input->post('new'));

					if ($change)
					{
						// if the password was successfully changed
						$this->session->set_flashdata('message', $this->ion_auth->messages());
						redirect("auth/login", 'refresh');
					}
					else
					{
						$this->session->set_flashdata('message', $this->ion_auth->errors());
						redirect('auth/reset_password/' . $code, 'refresh');
					}
				}
			}
		}
		else
		{
			// if the code is invalid then send them back to the forgot password page
			$this->session->set_flashdata('message', $this->ion_auth->errors());
			redirect("auth/forgot_password", 'refresh');
		}
	}


	// activate the user
	public function activate($id, $code=false)
	{
		if ($code !== false)
		{
			$activation = $this->ion_auth->activate($id, $code);
		}
		else if ($this->ion_auth->is_admin())
		{
			$activation = $this->ion_auth->activate($id);
		}

		if ($activation)
		{
			// redirect them to the auth page
			$this->session->set_flashdata('message', $this->ion_auth->messages());
			redirect("auth", 'refresh');
		}
		else
		{
			// redirect them to the forgot password page
			$this->session->set_flashdata('message', $this->ion_auth->errors());
			redirect("auth/forgot_password", 'refresh');
		}
	}

	// deactivate the user
	public function deactivate($id = NULL)
	{
		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
			// redirect them to the home page because they must be an administrator to view this
			return show_error('You must be an administrator to view this page.');
		}

		$id = (int) $id;

		$this->load->library('form_validation');
		$this->form_validation->set_rules('confirm', $this->lang->line('deactivate_validation_confirm_label'), 'required');
		$this->form_validation->set_rules('id', $this->lang->line('deactivate_validation_user_id_label'), 'required|alpha_numeric');

		if ($this->form_validation->run() == FALSE)
		{
			// insert csrf check
			$this->data['csrf'] = $this->_get_csrf_nonce();
			$this->data['user'] = $this->ion_auth->user($id)->row();

			$this->_render_page('auth/deactivate_user', $this->data);
		}
		else
		{
			// do we really want to deactivate?
			if ($this->input->post('confirm') == 'yes')
			{
				// do we have a valid request?
				if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id'))
				{
					show_error($this->lang->line('error_csrf'));
				}

				// do we have the right userlevel?
				if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin())
				{
					$this->ion_auth->deactivate($id);
				}
			}

			// redirect them back to the auth page
			redirect('auth', 'refresh');
		}
	}

	// create a new user
	public function create_user()
    {
        $this->data['title'] = $this->lang->line('create_user_heading');

        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
        {
            redirect('auth', 'refresh');
        }

        $tables = $this->config->item('tables','ion_auth');
        $identity_column = $this->config->item('identity','ion_auth');
        $this->data['identity_column'] = $identity_column;

        // validate form input
        $this->form_validation->set_rules('FIRST_NAME', $this->lang->line('create_user_validation_fname_label'), 'required');
        $this->form_validation->set_rules('LAST_NAME', $this->lang->line('create_user_validation_lname_label'), 'required');
        if($identity_column!=='USERMAME')
        {
            $this->form_validation->set_rules('IDENTITY',$this->lang->line('create_user_validation_identity_label'),'required|is_unique['.$tables['users'].'.'.$identity_column.']');
            $this->form_validation->set_rules('EMAIL', $this->lang->line('create_user_validation_email_label'), 'required|valid_email');
        }
        else
        {
            $this->form_validation->set_rules('EMAIL', $this->lang->line('create_user_validation_email_label'), 'required|valid_email|is_unique[' . $tables['users'] . '.email]');
        }
        $this->form_validation->set_rules('PHONE', $this->lang->line('create_user_validation_phone_label'), 'trim');
        $this->form_validation->set_rules('COMPANY', $this->lang->line('create_user_validation_company_label'), 'trim');
        $this->form_validation->set_rules('PASSWORD', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[PASSWORD_CONFIRM]');
        $this->form_validation->set_rules('PASSWORD_CONFIRM', $this->lang->line('create_user_validation_password_confirm_label'), 'required');

        if ($this->form_validation->run() == true)
        {
            $email    = strtolower($this->input->post('EMAIL'));
            $identity = ($identity_column==='email') ? $email : $this->input->post('IDENTITY');
            $password = $this->input->post('PASSWORD');

            $additional_data = array(
                'FIRST_NAME' => $this->input->post('FIRST_NAME'),
                'LAST_NAME'  => $this->input->post('LAST_NAME'),
                'COMPANY'    => $this->input->post('COMPANY'),
                'PHONE'      => $this->input->post('PHONE'),
            );
        }
        if ($this->form_validation->run() == true && $this->ion_auth->register($identity, $password, $email, $additional_data))
        {
            // check to see if we are creating the user
            // redirect them back to the admin page
            $this->session->set_flashdata('message', $this->ion_auth->messages());
            redirect("auth", 'refresh');
        }
        else
        {
            // display the create user form
            // set the flash data error message if there is one
            $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

            $this->data['first_name'] = array(
                'name'  => 'FIRST_NAME',
                'id'    => 'first_name',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('first_name'),
            );
            $this->data['last_name'] = array(
                'name'  => 'LAST_NAME',
                'id'    => 'last_name',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('last_name'),
            );
            $this->data['identity'] = array(
                'name'  => 'IDENTITY',
                'id'    => 'identity',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('identity'),
            );
            $this->data['email'] = array(
                'name'  => 'EMAIL',
                'id'    => 'email',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('email'),
            );
            $this->data['company'] = array(
                'name'  => 'COMPANY',
                'id'    => 'company',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('company'),
            );
            $this->data['phone'] = array(
                'name'  => 'PHONE',
                'id'    => 'phone',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('phone'),
            );
            $this->data['password'] = array(
                'name'  => 'PASSWORD',
                'id'    => 'password',
                'type'  => 'password',
                'value' => $this->form_validation->set_value('password'),
            );
            $this->data['password_confirm'] = array(
                'name'  => 'PASSWORD_CONFIRM',
                'id'    => 'password_confirm',
                'type'  => 'password',
                'value' => $this->form_validation->set_value('password_confirm'),
            );

            $this->_render_page('auth/create_user', $this->data);
        }
    }

	// edit a user
	public function edit_user($id)
	{
		$this->data['title'] = $this->lang->line('edit_user_heading');

		if (!$this->ion_auth->logged_in() || (!$this->ion_auth->is_admin() && !($this->ion_auth->user()->row()->id == $id)))
		{
			redirect('auth', 'refresh');
		}

		$user = $this->ion_auth->user($id)->row();
		$groups=$this->ion_auth->groups()->result_array();
		$currentGroups = $this->ion_auth->get_users_groups($id)->result();

		// validate form input
		$this->form_validation->set_rules('FIRST_NAME', $this->lang->line('edit_user_validation_fname_label'), 'required');
		$this->form_validation->set_rules('LAST_NAME', $this->lang->line('edit_user_validation_lname_label'), 'required');
		$this->form_validation->set_rules('PHONE', $this->lang->line('edit_user_validation_phone_label'), 'required');
		$this->form_validation->set_rules('COMPANY', $this->lang->line('edit_user_validation_company_label'), 'required');

		if (isset($_POST) && !empty($_POST))
		{


			// do we have a valid request?
			if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('ID'))
			{
				show_error($this->lang->line('error_csrf'));
			}

			// update the password if it was posted
			if ($this->input->post('PASSROWD'))
			{
				$this->form_validation->set_rules('PASSWORD', $this->lang->line('edit_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[PASSWORD_CONFIRM]');
				$this->form_validation->set_rules('PASSWORD_CONFIRM', $this->lang->line('edit_user_validation_password_confirm_label'), 'required');
			}

			if ($this->form_validation->run() === TRUE)
			{
				$data = array(
					'FIRST_NAME' => $this->input->post('FIRST_NAME'),
					'LAST_NAME'  => $this->input->post('LAST_NAME'),
					'COMPANY'    => $this->input->post('COMPANY'),
					'PHONE'      => $this->input->post('PHONE'),
				);

				// update the password if it was posted
				if ($this->input->post('PASSWORD'))
				{
					$data['PASSWORD'] = $this->input->post('PASSWORD');
				}



				// Only allow updating groups if user is admin
				if ($this->ion_auth->is_admin())
				{
					//Update the groups user belongs to
					$groupData = $this->input->post('groups');

					if (isset($groupData) && !empty($groupData)) {

						$this->ion_auth->remove_from_group('', $id);

						foreach ($groupData as $grp) {
							$this->ion_auth->add_to_group($grp, $id);
						}

					}
				}

			// check to see if we are updating the user
			   if($this->ion_auth->update($user->ID_USUARIO, $data))
			    {
			    	// redirect them back to the admin page if admin, or to the base url if non admin
				    $this->session->set_flashdata('message', $this->ion_auth->messages() );
				    if ($this->ion_auth->is_admin())
					{
						redirect('auth', 'refresh');
					}
					else
					{
						redirect('/', 'refresh');
					}

			    }
			    else
			    {
			    	// redirect them back to the admin page if admin, or to the base url if non admin
				    $this->session->set_flashdata('message', $this->ion_auth->errors() );
				    if ($this->ion_auth->is_admin())
					{
						redirect('auth', 'refresh');
					}
					else
					{
						redirect('/', 'refresh');
					}

			    }

			}
		}

		// display the edit user form
		$this->data['csrf'] = $this->_get_csrf_nonce();

		// set the flash data error message if there is one
		$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

		// pass the user to the view
		$this->data['user'] = $user;
		$this->data['groups'] = $groups;
		$this->data['currentGroups'] = $currentGroups;

		$this->data['first_name'] = array(
			'name'  => 'FIRST_NAME',
			'id'    => 'first_name',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('first_name', $user->FIRST_NAME),
		);
		$this->data['last_name'] = array(
			'name'  => 'LAST_NAME',
			'id'    => 'last_name',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('last_name', $user->LAST_NAME),
		);
		$this->data['company'] = array(
			'name'  => 'COMPANY',
			'id'    => 'company',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('company', $user->COMPANY),
		);
		$this->data['phone'] = array(
			'name'  => 'PHONE',
			'id'    => 'phone',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('phone', $user->PHONE),
		);
		$this->data['password'] = array(
			'name' => 'PASSWORD',
			'id'   => 'password',
			'type' => 'password'
		);
		$this->data['PASSWORD_CONFIRM'] = array(
			'name' => 'password_confirm',
			'id'   => 'password_confirm',
			'type' => 'password'
		);

		$this->_render_page('auth/edit_user', $this->data);
	}

	// create a new group
	public function create_group()
	{
		$this->data['title'] = $this->lang->line('create_group_title');

		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
			redirect('auth', 'refresh');
		}

		// validate form input
		$this->form_validation->set_rules('group_name', $this->lang->line('create_group_validation_name_label'), 'required|alpha_dash');

		if ($this->form_validation->run() == TRUE)
		{
			$new_group_id = $this->ion_auth->create_group($this->input->post('group_name'), $this->input->post('description'));
			if($new_group_id)
			{
				// check to see if we are creating the group
				// redirect them back to the admin page
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect("auth", 'refresh');
			}
		}
		else
		{
			// display the create group form
			// set the flash data error message if there is one
			$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

			$this->data['group_name'] = array(
				'name'  => 'group_name',
				'id'    => 'group_name',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('group_name'),
			);
			$this->data['description'] = array(
				'name'  => 'description',
				'id'    => 'description',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('description'),
			);

			$this->_render_page('auth/create_group', $this->data);
		}
	}

	// edit a group
	public function edit_group($id)
	{
		// bail if no group id given
		if(!$id || empty($id))
		{
			redirect('auth', 'refresh');
		}

		$this->data['title'] = $this->lang->line('edit_group_title');

		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
			redirect('auth', 'refresh');
		}

		$group = $this->ion_auth->group($id)->row();

		// validate form input
		$this->form_validation->set_rules('group_name', $this->lang->line('edit_group_validation_name_label'), 'required|alpha_dash');

		if (isset($_POST) && !empty($_POST))
		{
			if ($this->form_validation->run() === TRUE)
			{
				$group_update = $this->ion_auth->update_group($id, $_POST['group_name'], $_POST['group_description']);

				if($group_update)
				{
					$this->session->set_flashdata('message', $this->lang->line('edit_group_saved'));
				}
				else
				{
					$this->session->set_flashdata('message', $this->ion_auth->errors());
				}
				redirect("auth", 'refresh');
			}
		}

		// set the flash data error message if there is one
		$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

		// pass the user to the view
		$this->data['group'] = $group;

		$readonly = $this->config->item('admin_group', 'ion_auth') === $group->NAME ? 'readonly' : '';

		$this->data['group_name'] = array(
			'name'    => 'group_name',
			'id'      => 'group_name',
			'type'    => 'text',
			'value'   => $this->form_validation->set_value('group_name', $group->NAME),
			$readonly => $readonly,
		);
		$this->data['group_description'] = array(
			'name'  => 'group_description',
			'id'    => 'group_description',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('group_description', $group->DESCRIPTION),
		);

		$this->_render_page('auth/edit_group', $this->data);
	}


	public function _get_csrf_nonce()
	{
		$this->load->helper('string');
		$key   = random_string('alnum', 8);
		$value = random_string('alnum', 20);
		$this->session->set_flashdata('csrfkey', $key);
		$this->session->set_flashdata('csrfvalue', $value);

		return array($key => $value);
	}

	public function _valid_csrf_nonce()
	{
		if ($this->input->post($this->session->flashdata('csrfkey')) !== FALSE &&
			$this->input->post($this->session->flashdata('csrfkey')) == $this->session->flashdata('csrfvalue'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	public function _render_page($view, $data=null, $returnhtml=false)//I think this makes more sense
	{

		$d = (empty($data)) ? $this->data: $data;
		$d['Content'] = $view;
		$this->load->view('includes/template', $d, $returnhtml);

		/*
		$this->viewdata = new stdClass();
		$this->viewdata = (empty($data)) ? $this->data: $data;

		$view_html = $this->load->view('includes/template', $this->viewdata, $returnhtml);

		if ($returnhtml) return $view_html;//This will return html on 3rd argument being true
		*/
	}

}
