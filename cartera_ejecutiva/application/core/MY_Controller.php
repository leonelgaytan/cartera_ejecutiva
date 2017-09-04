<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
	var $docsPath;
    function __construct() {
        parent::__construct();
		$this->docsPath = $this->config->item('docsPath');
    }




    protected function getRequestData($rm){
    	switch ($rm) {
    		case 'GET':
    			$data = $_GET;
    			break;
    		case 'POST':
    			$data = $_POST;
    			break;
    		case 'PUT':
    			parse_str(file_get_contents('php://input'), $data);
    			break;
    		case 'DELETE':
    			parse_str(file_get_contents('php://input'), $data);
    			break;
    		default:
    			$data = array();
    			break;
    	}
    	return $data;
    }

    protected function getCbos(){

		$tablas = $this->config->item('tablas');

		for ($t=0; $t <count($tablas); $t++) { 
			if($tablas[$t]['cat'] == 1){
			$data[$tablas[$t]['id']] = $this->model->getDataCatalogo($tablas[$t]['tbl'],$tablas[$t]['id'],$tablas[$t]['name']);
			}
		}

		$data['anios'] = $this->model->getAnios();
		return $data;
    }

	function getTableName($id){
		return $this->model->getTableName($id);
	}

	function getSequenceName($id){
		return $this->model->getSequenceName($id);
	}

	function existeElementoCatalogo($tbl,$seq,$id,$name,$value){
		$itemId = (int)$this->model->getExisteElementoCatalogo($tbl,$id,$name,$value);
		if($itemId == 0){
			// Guardamos el nuevo elemento
			$R = $this->guarda($tbl,array($name => $value),$seq);
			return $R['last_insert'];
		}else{
			return $itemId;
		}

	}

	function fillCatalogo($tbl,$field,$tblCatalogo,$fieldCatalogo = 'NAME',$seq = false){
		$info = $this->model->getCatFromTbl($tbl,$field);
		for ($i=0; $i <count($info); $i++) { 
			$data = array(
			   $fieldCatalogo => $info[$i][$field]
			);

			if($seq){
		  		$nv = "$seq.NEXTVAL";
				$this->db->set('ID', $nv, FALSE);
			}

			$this->db->insert($tblCatalogo, $data); 
		}

	}



	public function getCatalogosList(){
		$tablas = $this->config->item('tablas');
		$cats = array();
		for ($s=0; $s <count($tablas); $s++) {
			if($tablas[$s]['cat'] == 1){
				$item = array("ID" => $tablas[$s]['id'],"NAME" => $tablas[$s]['name'],"DESCRIPTION" => $tablas[$s]['label'],"TBL" => $tablas[$s]['tbl']);
				array_push($cats, $item);
			}
		}
		return $cats;
	}

	public function getSequenceTable($tbl){
		return $this->model->getSequenceTable($tbl);
	}

	private function last_insert($tbl){
		$fieldId = getPropCat($tbl,'id');
		$this->db->select("MAX($fieldId) AS MAXID");
		$this->db->from($tbl);
		$query = $this->db->get();
		$row = $query->row();
		return $row->MAXID;
	}

	public function guarda($tbl,$data,$seq = false){
		//error_reporting(0);
		$this->db->db_debug = FALSE;
		if($this->ion_auth->in_group('admin') || $this->ion_auth->in_group('capturista')){		
		$user = $this->ion_auth->user()->row();			
		$this->db->db_debug = FALSE;
		if($seq){
			$fieldId = getPropCat($tbl,'id');
	  		$nv = "$seq.NEXTVAL";
			$this->db->set($fieldId, $nv, FALSE);
		}


		if($this->db->insert($tbl, $data)){
			// Obtenemos el ultimo insert
			$R['success'] = 1;
			$R['last_insert'] = $this->db->insert_id();
			//$R['last_insert'] = $this->last_insert($tbl);
			$R['head'] = 'OK';
			$R['message'] = 'Información registrada';
			$this->db->db_debug = TRUE;
			return $R;
		}else{
			$error = $this->db->error();
			$R['success'] = 0;
			$R['last_insert'] = 0;
			$R['head'] = 'ERROR: ' . $error['code'];
			$R['message'] = $error['message'];
			$this->db->db_debug = TRUE;
			return $R;
		}
	}else{
		$R['success'] = 0;
		$R['last_insert'] = 0;
		$R['head'] = 'ERROR';
		$R['message'] = 'El usuario actual no tiene privilegios para Agregar, editar o eliminar información';
		$this->db->db_debug = TRUE;
		return $R;

	}

}
	public function guardaUpdateLog($tbl,$id,$user_id){
		$updData = array(
			"TABLE_NAME"			=>	$tbl,
			"ROW_ID"			=>	$id,
			"USER_ID"			=>	$user_id,
			"UPDATE_ON"			=>	date('Y-m-d H:i:s')
		);
		$seq = 'PLN_LOG_UPDATES_SEQ.NEXTVAL';
		$this->db->set('ID_LOG_UPD', $seq, FALSE);
		$this->db->insert('T_LOG_UPDATES', $updData);
	}


	public function editaCartera($tbl,$id,$data){
		if($this->ion_auth->in_group('admin') || $this->ion_auth->in_group('capturista')){
		$user = $this->ion_auth->user()->row();	
		$this->db->db_debug = FALSE;
		$this->db->where('ID_PROYECTO', $id);
		if($this->db->update($tbl, $data)){
			// Guardamos en el Log
			//$this->guardaUpdateLog($tbl,$id,$user->ID_USUARIO);
			$R['success'] = 1;
			$R['last_insert'] = $id;
			$R['head'] = 'OK';
			$R['message'] = 'Información actualizada';
			return $R;
		}else{
			$error = $this->db->error();
			$R['success'] = 0;
			$R['last_insert'] = 0;
			$R['head'] = 'ERROR: ' . $error['code'];
			$R['message'] = $error['message'];
			$this->db->db_debug = TRUE;
			return $R;
		}
	}else{
		$R['success'] = 0;
		$R['head'] = 'ERROR';
		$R['message'] = 'El usuario actual no tiene privilegios para Agregar, editar o eliminar información';
		return $R;

	}

	}


	public function edita($tbl,$id,$data){
		if($this->ion_auth->in_group('admin') || $this->ion_auth->in_group('capturista')){
		$user = $this->ion_auth->user()->row();			
		$this->db->db_debug = FALSE;
		$fieldId = getPropCat($tbl,'id');
		$this->db->where($fieldId, $id);
		if($this->db->update($tbl, $data)){
			// Guardamos en el Log
			//$this->guardaUpdateLog($tbl,$id,$user->ID_USUARIO);
			$R['success'] = 1;
			$R['last_insert'] = $id;
			$R['head'] = 'OK';
			$R['message'] = 'Información actualizada';
			return $R;
		}else{
			$error = $this->db->error();
			$R['success'] = 0;
			$R['last_insert'] = 0;
			$R['head'] = 'ERROR: ' . $error['code'];
			$R['message'] = $error['message'];
			$this->db->db_debug = TRUE;
			return $R;
		}
	}else{
		$R['success'] = 0;
		$R['head'] = 'ERROR';
		$R['message'] = 'El usuario actual no tiene privilegios para Agregar, editar o eliminar información';
		return $R;

	}

	}

	public function guardaDeleteLog($tbl,$id,$user_id){
		$delData = array(
			"TABLE_NAME"		=>	$tbl,
			"ROW_ID"			=>	$id,
			"USER_ID"			=>	$user_id,
			"DELETE_ON"			=>	date('Y-m-d H:i:s')
		);
		$seq = 'PLN_LOG_DELETES_SEQ.NEXTVAL';
		$this->db->set('ID_LOG_DELETE', $seq, FALSE);
		$this->db->insert('T_LOG_DELETES', $delData);
	}

	public function elimina($tbl,$id){
		if($this->ion_auth->in_group('admin') || $this->ion_auth->in_group('capturista')){		
		$user = $this->ion_auth->user()->row();			
		$this->db->db_debug = FALSE;

		$eData = array('ESTATUS' => 0);

		$fieldId = getPropCat($tbl,'id');


		$this->db->where($fieldId, $id);
		if($this->db->update($tbl, $eData)){
			//$this->guardaDeleteLog($tbl,$id,$user->ID_USUARIO);
			$R['success'] = 1;
			$R['head'] = 'OK';
			$R['message'] = 'Información eliminada';
			return $R;
		}else{
			$R['success'] = 0;
			$R['head'] = 'ERROR';
			$R['message'] = 'Ocurrio un error al actualizar la información';
			return $R;
		}
	}else{
		$R['success'] = 0;
		$R['head'] = 'ERROR';
		$R['message'] = 'El usuario actual no tiene privilegios para Agregar, editar o eliminar información';
		return $R;

	}
		
	}

    public function getConfigGrafica($titulo,$subtitulo){

                return array(
                "container" => "g3",
                "title" => $titulo,
                "subtitle" => $subtitulo,
                "type" => "line",
                "is_time_line" => false,
                "col_serie"=>"serie", 
                "col_categorias" => "categoria",
                "col_valor" => "total",
                "series" => "{enabled: true}",
                "ordenar" => "",
                "add_on_chart" => " className: 'SiafesonChart',style:{fontSize: '18px'},zoomType:'xy' ",
                "add_on_plot_options" => " series: { lineWidth: 4,dataLabels: { enabled: true,format: '{point.y:.1f}%'} }  ", 
                "add_on_legend"=>"itemStyle:{fontSize:'18px'}" ,
                "add_on_x_axis" => " labels: { rotation: 0, step: 1, y:20, align: 'left', x: -8, style:{color: 'black',fontSize: '18'} },title: {text: '', style: {
                fontSize: '22px',
                fontWeight: 'bold',
                color: 'black'
                }}",    
                "add_on_y_axis" => " title:'',labels: {y:15,style:{color: 'black',fontSize: '18'}},title: {text: 'Infección (%).',style: {
                fontSize: '18px',
                fontWeight: 'bold',
                color: 'black'
                }} ",  
                "add_on_exporting" => "sourceWidth: 1800, sourceHeight: 800, scale: 1"    
                );

    }
    

	protected function makedirs($dirpath, $mode=0777) {
		if (file_exists($this->docsPath . $dirpath)) {
			return true;
		}else{
		    mkdir($this->docsPath . $dirpath);
			if (file_exists($this->docsPath . $dirpath)) {
				return true;
			}else{
				return false;
			}
		}
	}

    public function do_upload($ANIO = 'XXXX',$FOLIO_PROYECTO = '0',$FORMATO = 1){
        $this->load->library('upload');
        $doc_upload_folder = $ANIO . '/' . $FOLIO_PROYECTO . '/';
        $doc_upload_folder_dpntic = $ANIO . '/' . $FOLIO_PROYECTO . '/OFICIO_DPNTIC/';

        if($this->makedirs($ANIO)){
        	if($this->makedirs($doc_upload_folder)){
		        if($this->makedirs($doc_upload_folder)){
		        if($this->makedirs($doc_upload_folder_dpntic)){
		        	$up = $this->docsPath . '/' . $doc_upload_folder;
		        	$upload_path = ($FORMATO == 1) ? $doc_upload_folder : $doc_upload_folder_dpntic;

			        $this->upload_config = array(
			            'upload_path'   => $this->docsPath . '/' . $upload_path,
			            'allowed_types' => 'PDF|pdf',
			            'max_size'      => 20480,
			            'remove_space'  => TRUE,
			            'encrypt_name'  => FALSE
			        );

		        	if(isset($_FILES['userfile']['name'])){
						$new_file_name = preg_replace('/[^(\x20-\x7F)]*/','', $_FILES['userfile']['name']);
						$this->upload_config['file_name'] = $new_file_name;
		        	}


			        $this->upload->initialize($this->upload_config);
			        if (!$this->upload->do_upload('userfile')) {
			            return $this->upload->display_errors();
			        } else {
			            return  $this->upload->data();
			        }
		        }
		    }

        	}

        }

    }
}