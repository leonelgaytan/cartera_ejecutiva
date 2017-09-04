<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Captura extends MY_Controller {
	var $opciones = array('insert','edit','delete');
	var $methods = array('GET','POST','PUT','DELETE');
	public function __construct()
	{
		parent::__construct();
		if($this->ion_auth->logged_in()){
			if($this->ion_auth->in_group('admin') || $this->ion_auth->in_group('capturista') || $this->ion_auth->in_group('visualizador') || $this->ion_auth->in_group('responsables')){
				$this->load->model('catalogos_model','model');
			}else{
				redirect('inicio/sinpermiso', 'refresh');
			}
		}else{
			redirect('auth/login', 'refresh');
		}
	}


	public function eliminaResponsable(){
		sleep(1);
		$this->db->WHERE('ID_PROYECTO',$_GET['ID_PROYECTO']);
		$this->db->WHERE('ID_RESPONSABLE',$_GET['ID_RESPONSABLE']);
		if($this->db->delete('R_PROYECTO_RESPONSABLE')){
			$R['success'] = 1;
			$R['message'] = 'Ok';
		}else{
			$R['success'] = 0;
			$R['message'] = 'ERROR';
		}
		return $this->output->set_content_type('application/json')->set_output(json_encode($R));
	}


	public function asignaResponsable(){
		sleep(1);
		$insert_query = $this->db->insert_string('R_PROYECTO_RESPONSABLE', $_POST);  // QUERY RUNS ONCE
		$insert_query = str_replace('INSERT INTO','INSERT IGNORE INTO',$insert_query);
		if($this->db->query($insert_query)){
			$R['success'] = 1;
			$R['message'] = 'Ok';
		}else{
			$R['success'] = 0;
			$R['message'] = 'ERROR';
		}
		return $this->output->set_content_type('application/json')->set_output(json_encode($R));
	}


	public function createFolders(){
		// obtenems todos los folios
			$this->db->select('ANIO');
			$this->db->select('ANIO,FOLIO_PROYECTO');
			$this->db->from('T_CARTERA_EJECUTIVA_PROYECTOS');
			$this->db->order_by('ANIO','ASC');
			$this->db->order_by('FOLIO_PROYECTO','ASC');
			$folios = $this->db->get()->result_array();
			for ($f=0; $f < count($folios); $f++) { 
				$this->makedirs($folios[$f]['ANIO']);
				$this->makedirs($folios[$f]['ANIO'] . '/' . $folios[$f]['FOLIO_PROYECTO']);
			}

	}


	public function pdf($DOCUMENTO,$FORMATO = 1){
		if($FORMATO == 1){
			$info = $this->model->getDetalleFormato($DOCUMENTO);
		}else{
			$info = $this->model->getFormato($DOCUMENTO);
		}

		if(count($info) > 0){
			if($FORMATO == 1){
				$file = $this->docsPath . $info[0]['ANIO'] . '/' . $info[0]['FOLIO_PROYECTO'] . '/'  . $info[0]['DOCUMENTO'];
			$filename = $info[0]['ID_DETALLE_OFICIO'] . '_' . $info[0]['ID_PROYECTO'] . '_' . $info[0]['DESCRIP_OFICIO'] . '_' . $info[0]['VOLANTE'] . '_' . $info[0]['ID_FORMATO'] . '_' . $info[0]['FEC_OFICIO_REG'] . '.pdf';
			}else{
				$file = $this->docsPath . $info[0]['ANIO'] . '/' . $info[0]['FOLIO_PROYECTO'] . '/OFICIO_DPNTIC/'  . $info[0]['DOCUMENTO'];

			$filename = 'OFICIO_DPNTIC' . '_' . $info[0]['ANIO'] . '_' . $info[0]['FOLIO_PROYECTO']   . '';
			}


			header('Content-type: application/pdf');
			header('Content-Disposition: inline; filename="' . $filename . '"');
			header('Content-Transfer-Encoding: binary');
			header('Content-Length: ' . filesize($file));
			header('Accept-Ranges: bytes');
			@readfile($file);
		}else{
			echo "<center><h3>Documento no encontrado</h3></center>";
		}
	}

	public function index($ID_PROYECTO = 0){
		$data = $this->getCbos();
		$data['idd'] = $ID_PROYECTO;

		if($ID_PROYECTO > 0){
			//Buscar el registro
			$data['info'] = $this->model->getCarteraInfo($ID_PROYECTO);
			if(count($data['info']) == 0){
				// rtrim ltrim
				$data['error']['code'] = 1;
				$data['error']['message'] = 'No se encontró informacion de la cartera ejecutiva solicitada';
			}else{
				$data['ID_ACTIVIDAD'] = $this->model->geTipoActividades($data['info'][0]['ID_TIPO_PROYECTO']);
				$data['idd'] = $data['info'][0]['ID_PROYECTO'];
				foreach ($data['info'][0] as $key => $value) {
					$data['info'][0][$key] = rtrim(ltrim($value));
				}
			}
		}

		//$data['ID_EDN'] = $this->model->getEDN();
		$data['FOLIO_PROYECTO'] = $this->generaFolio(date('Y'));
		$data['Content'] = 'captura/inicio';
		$this->load->view('includes/template', $data);
	}


	public function getUrSec(){
		if ($this->input->is_ajax_request()) {
			$ID_UR = isset($_GET['ID_UR']) ? $_GET['ID_UR'] : 0;
			return $this->output->set_content_type('application/json')->set_output(json_encode($this->model->getUrSec($ID_UR)));
		}
	}

	public function generaFolio($year = false){
			return $this->model->generaFolio($year);
	}

	public function generaFolioAjax($year = false){
		if ($this->input->is_ajax_request()) {
			$year = isset($_GET['year']) ? $_GET['year'] : date('Y');
			$R['success'] = 1;
			$R['folio'] = $this->model->generaFolio($year);
			$R['message'] = 'Ok';
			return $this->output->set_content_type('application/json')->set_output(json_encode($R));
		}
	}


	function getFormatosRecibidos2(){
		$R = $this->model->getFormatosRecibidos($_GET['ID_TIPO_OFICIO']);
		return $this->output->set_content_type('application/json')->set_output(json_encode($R));		
	}


	function getFormatosRecibidos(){
		$ID_TIPO_PROYECTO = $this->model->getTipoProyecto($_GET['ID_PROYECTO']);
		$R = $this->model->getFormatosRecibidos($ID_TIPO_PROYECTO,$_GET['ID_TIPO_OFICIO']);
		//return $this->output->set_content_type('application/json')->set_output(json_encode($R));	
		print_r(json_encode($R));

	}

	function deleteFormato(){
		$rm = $_SERVER['REQUEST_METHOD']; 
		$data = array();
		if(in_array($rm, $this->methods)){
			$data = $this->getRequestData($rm);
		}

		$R = $this->elimina('T_DETALLE_FORMATO',$data['ID_DETALLE_FORMATO']);
		return $this->output->set_content_type('application/json')->set_output(json_encode($R));

	}


	public function getFormatos(){
		$R = $this->model->getFormatos($_GET['ID_PROYECTO']);
		return $this->output->set_content_type('application/json')->set_output(json_encode($R));
	}


	public function guardaFormato(){

		$rm = $_SERVER['REQUEST_METHOD']; 
		$data = array();
		if(in_array($rm, $this->methods)){
			$data = $this->getRequestData($rm);
		}

		// Obtenemos el año y el folio del proyecto
		$ANIO = $this->model->getAnioProyecto($data['ID_PROYECTO']);
		$FOLIO_PROYECTO = $this->model->getFolioProyecto($data['ID_PROYECTO']);


        if(isset($_FILES['userfile']) && $_FILES['userfile']['size'] > 0){  
              $file = $this->do_upload($ANIO,$FOLIO_PROYECTO);
              if(isset($file['file_name'])){
              	$data['DOCUMENTO'] = $file['file_name'];
              }
        }


		unset($data['ci_csrf_token']);
		$id = (isset($data['ID_DETALLE_OFICIO'])) ? $data['ID_DETALLE_OFICIO'] : 0;
		unset($data['ID_DETALLE_OFICIO']);
		unset($data['ID_TIPO_OFICIO']);

		$fechas = array('FEC_OFICIO_REG');
		$vf = $this->validaFechas($data,$fechas);

		if($vf['success'] == 1){

			foreach ($data as $key => $value) {
				//Cambiamos el formato de la fecha
				for ($f=0; $f < count($fechas); $f++) { 
					if($key == $fechas[$f] && strlen($data[$key]) == 10){
						// cambiamos el formato 01/01/2017 => 2017-01-01
					$date = DateTime::createFromFormat('d/m/Y', $data[$key]);
					$data[$key] =  $date->format('Y-m-d');
					}
				}

			}




			if($id > 0){
				$res = parent::edita('T_DETALLE_FORMATO',$id,$data);
			}else{
				// Existe el tipo de actividad que se quiere registrar??
				$user = $this->ion_auth->user()->row();			
				$data['CREATE_BY'] = $user->ID_USUARIO;
				$data['CREATE_ON'] = date('Y-m-d H:i:s');
				$res = parent::guarda('T_DETALLE_FORMATO',$data);
			}
		}else{
			$res = $vf;
		}

		return $this->output->set_content_type('application/json')->set_output(json_encode($res));

	}

	function testfechas(){
		//01/03/2017	31/12/2017

		$fec_ini = strtotime('2017-03-01');
		$fec_fin = strtotime('2017-12-31');
		$fec_int = strtotime('2017-10-31');

		//$fec_int > $fec_ini &&  $fec_init < $fec_fin

		if($fec_int > $fec_ini && $fec_fin > $fec_int) {
			echo "Fecha Correcta";
		} else {
			echo "Fecha InCorrecta";
		}
	}


	function deleteActividad(){
		$rm = $_SERVER['REQUEST_METHOD']; 
		$data = array();
		if(in_array($rm, $this->methods)){
			$data = $this->getRequestData($rm);
		}

		$R = $this->elimina('T_DETALLE_ACTIVIDAD',$data['ID_DETALLE_ACTIVIDAD']);
		return $this->output->set_content_type('application/json')->set_output(json_encode($R));

	}

	public function getActividades(){
		$R = $this->model->getActividades($_GET['ID_PROYECTO']);
		return $this->output->set_content_type('application/json')->set_output(json_encode($R));
	}

	public function guardaActividad(){

		$rm = $_SERVER['REQUEST_METHOD']; 
		$data = array();
		if(in_array($rm, $this->methods)){
			$data = $this->getRequestData($rm);
		}
		unset($data['ci_csrf_token']);
		$id = (isset($data['ID_DETALLE_ACTIVIDAD'])) ? $data['ID_DETALLE_ACTIVIDAD'] : 0;
		unset($data['ID_DETALLE_ACTIVIDAD']);


		$fechas = array('FEC_INI_PLANEADA','FEC_FIN_PLANEADA','FEC_INI_REAL','FEC_FIN_REAL');
		$vf = $this->validaFechas($data,$fechas);

		if($vf['success'] == 1){


			foreach ($data as $key => $value) {
				//Cambiamos el formato de la fecha
				for ($f=0; $f < count($fechas); $f++) { 
					if($key == $fechas[$f] && strlen($data[$key]) == 10){
						// cambiamos el formato 01/01/2017 => 2017-01-01
					$date = DateTime::createFromFormat('d/m/Y', $data[$key]);
					$data[$key] =  $date->format('Y-m-d');
					}
				}

			}

			/* Validamos que las fechas esten en rango */
			//$TBL,$FIELD,$IDFIELD,$IDVAL
			//Obtenemos la fecha base inicio
			$fbi = $this->model->getColumVal('T_CARTERA_EJECUTIVA_PROYECTOS','FEC_LINEA_BASE_INICIO','ID_PROYECTO',$data['ID_PROYECTO']);
			//Obtenemos la fecha base fin
			$fbf = $this->model->getColumVal('T_CARTERA_EJECUTIVA_PROYECTOS','FEC_LINEA_BASE_FIN','ID_PROYECTO',$data['ID_PROYECTO']);


			if(($data['FEC_INI_PLANEADA'] >= $fbi && $fbf >= $data['FEC_INI_PLANEADA']) && ($data['FEC_FIN_PLANEADA'] >= $fbi && $fbf >= $data['FEC_FIN_PLANEADA'])) {

				$user = $this->ion_auth->user()->row();			
				if($id > 0){
					$res = parent::edita('T_DETALLE_ACTIVIDAD',$id,$data);
				}else{
					// Existe el tipo de actividad que se quiere registrar??
					if($this->model->ExisteActividad($data['ID_PROYECTO'],$data['ID_ACTIVIDAD']) == 0){
						$data['CREATE_BY'] = $user->ID_USUARIO;
						$data['CREATE_ON'] = date('Y-m-d H:i:s');
						$res = parent::guarda('T_DETALLE_ACTIVIDAD',$data);
					}else{
						$res['success'] = 0;
						$res['head'] = 'Error';
						$res['message'] = 'Ya existe un tipo de actividad de la que se desea registrar.';

					}
				}

			} else {

				$res['success'] = 0;
				$res['head'] = 'Error';
				$res['message'] = 'Las fechas deben encontrarse en el rango de las fechas linea base del proyecto.';

			}

		}else{
			$res = $vf;
		}




		return $this->output->set_content_type('application/json')->set_output(json_encode($res));

	}





	function validaFechas($_data,$_fechas){
		$errores['success'] = 0;
		$errores['head'] = '';
		$errores['message'] = '';
		$errores['cnt'] = 0;
		foreach ($_data as $key => $value) {
			for ($f=0; $f < count($_fechas); $f++) { 
				if($key == $_fechas[$f] && strlen($value) == 10){
					if(!validateDate($value,'d/m/Y')){
						$errores['cnt']++;
						$errores['head'] = 'Errores: ' . $errores['cnt'];
						$errores['message'] .= 'Error en : ' . $key . ' valor: ' . $value . ' <br />';
					}
				}

			}
		}

		if($errores['cnt'] == 0){
			$errores['success'] = 1;
		}

		return $errores;
	}

	public function existeProyecto(){
		$rm = $_SERVER['REQUEST_METHOD']; 
		$data = array();
		if(in_array($rm, $this->methods)){
			$data = $this->getRequestData($rm);
		}
		unset($data['ci_csrf_token']);

		$res = $this->model->existeProyecto($data['NOMBRE_PROYECTO']);
		return $this->output->set_content_type('application/json')->set_output(json_encode($res));
	}

	public function guardaCartera(){
		$rm = $_SERVER['REQUEST_METHOD']; 
		$data = array();
		if(in_array($rm, $this->methods)){
			$data = $this->getRequestData($rm);
		}




		$data['ID_CATEGORIA'] = (isset($data['ID_CATEGORIA_to'])) ? $data['ID_CATEGORIA_to']: array();
		$data['ID_DOMINIO_TEC'] = (isset($data['ID_DOMINIO_TEC_to'])) ? $data['ID_DOMINIO_TEC_to']: array();
		$data['ID_PGCM'] = (isset($data['ID_PGCM_to'])) ? $data['ID_PGCM_to']: array();
		$data['ID_EDN'] = (isset($data['ID_EDN_to'])) ? $data['ID_EDN_to']: array();

		unset($data['ID_CATEGORIA_from']);
		unset($data['ID_CATEGORIA_to']);
		unset($data['ID_DOMINIO_TEC_from']);
		unset($data['ID_DOMINIO_TEC_to']);
		unset($data['ID_PGCM_from']);
		unset($data['ID_PGCM_to']);
		unset($data['ID_EDN_from']);
		unset($data['ID_EDN_to']);


		//7085376400.00
		if(count($data) > 0){
			// 7.085.376.400,00 260
			unset($data[0]);
			unset($data['ci_csrf_token']);


			$data['PRESUPUESTO_ESTIMADO'] = str_replace(",", ".", $data['PRESUPUESTO_ESTIMADO']);
			$data['PRESUPUESTO_ESTIMADO'] = preg_replace("/[\,\.](\d{3})/", "$1", $data['PRESUPUESTO_ESTIMADO']);

			$data['PRESUPUESTO_ASIGNADO'] = str_replace(",", ".", $data['PRESUPUESTO_ASIGNADO']);
			$data['PRESUPUESTO_ASIGNADO'] = preg_replace("/[\,\.](\d{3})/", "$1", $data['PRESUPUESTO_ASIGNADO']);


			$id = (isset($data['ID_PROYECTO'])) ? $data['ID_PROYECTO'] : 0;
			unset($data['ID_PROYECTO']);
			// Verificamos si hay nuevos elementos por agregar en los catalogos.
		$tablas = $this->config->item('tablas');
		for ($t=0; $t <count($tablas); $t++) { 
			if(isset($data[$tablas[$t]['id']. '_input']) && $tablas[$t]['cat'] == 1){
			$newItem = $data[$tablas[$t]['id']. '_input'];
				if(strlen($newItem) > 0){
					// Guardamos el elemento en el catalogo, obtenemos el valor y lo agregamos al arreglo que se registrara.
					$eic = $this->existeElementoCatalogo($tablas[$t]['tbl'],$tablas[$t]['seq'],$tablas[$t]['id'],$tablas[$t]['name'],$newItem);
					$data[$tablas[$t]['id']] = $eic;
					}
				}
				unset($data[$tablas[$t]['id']. '_input']);
			}
		}

				$fechas = array('FEC_REGISTRO','FEC_LINEA_BASE_INICIO','FEC_LINEA_BASE_FIN');

				// Validar Fechas
				$vf = $this->validaFechas($data,$fechas);

				if($vf['success'] == 1){

					foreach ($data as $key => $value) {
						if(is_array($value)){
							$data[$key] = implode(',',$value);
						}
						//Cambiamos el formato de la fecha

						for ($f=0; $f < count($fechas); $f++) { 
							if($key == $fechas[$f] && strlen($data[$key]) == 10){
								// cambiamos el formato 01/01/2017 => 2017-01-01
							$date = DateTime::createFromFormat('d/m/Y', $data[$key]);
							$data[$key] =  $date->format('Y-m-d');
							}
						}

					}


					$user = $this->ion_auth->user()->row();			
					if($id > 0){
						$res = parent::editaCartera('T_CARTERA_EJECUTIVA_PROYECTOS',$id,$data);
					}else{
					$data['ANIO'] = (isset($data['ANIO']) && $data['ANIO'] > 0) ? $data['ANIO'] : date('Y') ;


						// Generamos un folio
						$data['FOLIO_PROYECTO'] = $this->generaFolio($data['ANIO']);
						$data['CREATE_BY'] = $user->ID_USUARIO;
						$data['CREATE_ON'] = date('Y-m-d H:i:s');

						$res = parent::guarda('T_CARTERA_EJECUTIVA_PROYECTOS',$data);
					}
				}else{
					$res = $vf;
				}

		if($res['success'] == 1 && $res['last_insert'] > 0){
	        if(isset($_FILES['userfile']) && $_FILES['userfile']['size'] > 0){  
	        	$FOLIO_PROYECTO = $this->model->getFolioProyecto($res['last_insert']);
	        	$ANIO = $this->model->getAnioProyecto($res['last_insert']);
	        	$du = $this->do_upload($ANIO,$FOLIO_PROYECTO,0);

	        	if(strlen($du['file_name']) > 0){
	        		// Actualizar documento
						$res = parent::editaCartera('T_CARTERA_EJECUTIVA_PROYECTOS',$res['last_insert'],array('DOCUMENTO' => $du['file_name']));
	        	}
			}
		}


		return $this->output->set_content_type('application/json')->set_output(json_encode($res));


	}

	public function getResponsables(){
		//if ($this->input->is_ajax_request()) {
			$TIPO = isset($_GET['TIPO']) ? $_GET['TIPO'] : 1;
			$ID_PROYECTO = isset($_GET['ID_PROYECTO']) ? $_GET['ID_PROYECTO'] : 0;
			if($TIPO == 2 && $ID_PROYECTO == 0){
				$ID_PROYECTO = pi();
			}

			return $this->output->set_content_type('application/json')->set_output(json_encode($this->model->getResponsables($ID_PROYECTO)));
		//}
	}

	public function guardaItem(){
		$rm = $_SERVER['REQUEST_METHOD']; 
		$cbos = array(
			array('id' => 1,'name' => 'CONDENA_NO_ECO'),
			array('id' => 3,'name' => 'CAUSA_CONCLUSION'),
			array('id' => 4,'name' => 'CONDENA_ECO'),
			array('id' => 5,'name' => 'DICTAMEN'),
			array('id' => 6,'name' => 'APERCIBIMIENTO'),
			array('id' => 21,'name' => 'UR_ADCRIP_TRAB'),
			array('id' => 22,'name' => 'CATEGORIA'),
			array('id' => 23,'name' => 'ACCION_LABORAL')
			);
		if(in_array($rm, $this->methods)){
			$data = $this->getRequestData($rm);
			// Viene nuevo elemento de catalogos
			$id = (isset($data['ID'])) ? $data['ID'] : 0;
			unset($data['ID']);
			for ($c=0; $c <count($cbos); $c++) { 
				if(isset($data[$cbos[$c]['name']. '_input'])){
					if(strlen($data[$cbos[$c]['name']. '_input']) > 0){

						$data[$cbos[$c]['name']] = $data[$cbos[$c]['name']. '_input'];
						unset($data[$cbos[$c]['name']. '_input']);
						// Guardamos el item nuevo.
						$tblName = $this->getTableName($cbos[$c]['id']);
						$seqName = $this->getSequenceName($cbos[$c]['id']);					
						$info = array('NAME' => $data[$cbos[$c]['name']]);
						$R = $this->guarda($tblName,$info,$seqName);

					}else{
						unset($data[$cbos[$c]['name']. '_input']);
					}

				}

			}



            if(isset($_FILES['userfile']) && $_FILES['userfile']['size'] > 0){  
                  $file = $this->do_upload();
                  if(isset($file['file_name'])){
                  	$data['DOCUMENTO'] = $file['file_name'];
                  }
             }

			//$this->db->dbprefix = '';

			$arrDem = $data['NOM_DEMANDANTE'];
			unset($data['NOM_DEMANDANTE']);
			$seq = $this->getSequenceTable('PLN_T_DATOS_DEMANDA');

			if($id > 0){
				if(count($arrDem) > 0){
					$strDem = implode(",", $arrDem);
					$str_dem = $this->model->getDemsActuales($id);
					if(strlen($strDem) > 0){
					$data['NOM_DEMANDANTE'] = $str_dem . ',' . $strDem;
					}
					$this->guardaDemandantes($id,$arrDem);
				}
				$R = $this->edita('T_DATOS_DEMANDA',$id,$data);
			}else{
				$nd = '';
	            $valido = 0;
	            for ($n=0; $n <count($arrDem); $n++) { 
	            	if(strlen($arrDem[$n]) > 0){
	            		$valido = 1;
						$nd .= $arrDem[$n] . ',';
	            	}
	            }
	            if($valido == 1){
	            $data['NOM_DEMANDANTE'] = (strlen($nd) > 0) ? substr($nd, 0, -1) : '';
					$R = $this->guarda('T_DATOS_DEMANDA',$data,$seq);
					// Guardamos los demandantes de la demanda
					$last_insert = $R['last_insert'];
					$this->guardaDemandantes($last_insert,$arrDem);
	            }else{
				$R['success'] = 1;
				$R['head'] = 'Error';
				$R['message'] = 'No se ha definido correctamente el/los demandante(s)';
				return $this->output->set_content_type('application/json')->set_output(json_encode($R));
	            }

			}
			//$this->db->dbprefix = 'PLN_';
		}else{
			$R['success'] = 0;
			$R['message'] = 'No se ha definido correctamente la accion a realizar';
		}

		return $this->output->set_content_type('application/json')->set_output(json_encode($R));


	}


}