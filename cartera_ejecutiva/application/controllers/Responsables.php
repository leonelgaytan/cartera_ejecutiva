<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Responsables extends MY_Controller {
	var $opciones = array('insert','edit','delete');
	var $methods = array('GET','POST','PUT','DELETE');
	public function __construct()
	{
		parent::__construct();
		if($this->ion_auth->logged_in()){
			if($this->ion_auth->in_group('admin') || $this->ion_auth->in_group('responsables')){
				$this->load->model('responsables_model','model');
			}else{
				redirect('inicio/sinpermiso', 'refresh');
			}
		}else{
			redirect('auth/login', 'refresh');
		}
	}

	
	public function index($ID_RESPONSABLE = 0)
	{
		$data = $this->getCbos();
		$data['MODAL'] = isset($_GET['m']) ? $_GET['m'] : 0;
		$data['ID_RESPONSABLE'] = $ID_RESPONSABLE;
		$data['Responsables'] = $this->model->getResponsables(0);

		if($ID_RESPONSABLE > 0){
			$data['Info'] = $this->model->getResponsables(0,$ID_RESPONSABLE);
		}


		$data['Content'] = 'responsables/inicio';
		$this->load->view('includes/template', $data);

	}

	public function guardar(){
		$rm = $_SERVER['REQUEST_METHOD']; 
		$data = array();
		if(in_array($rm, $this->methods)){
			$data = $this->getRequestData($rm);
		}

		$ID_RESPONSABLE = $data['ID_RESPONSABLE'];
		unset($data['ID_RESPONSABLE']);

		if($ID_RESPONSABLE == 0){
			// NUEVO
			if($this->db->insert('T_RESPONSABLES',$data)){
				$R['success'] = 1;
				$R['message'] = 'Información registrada';
			}else{
				$R['success'] = 0;
				$R['message'] = 'Ocurrio un error. intente de nuevo';
			}
		}else{
			// EDITAR
			$this->db->where('ID_RESPONSABLE',$ID_RESPONSABLE);
			if($this->db->update('T_RESPONSABLES',$data)){
				$R['success'] = 1;
				$R['message'] = 'Información actualizada';
			}else{
				$R['success'] = 0;
				$R['message'] = 'Ocurrio un error. intente de nuevo';
			}
		}

		return $this->output->set_content_type('application/json')->set_output(json_encode($R));
	}

	public function eliminar(){
		$this->db->db_debug = FALSE; 
		$rm = $_SERVER['REQUEST_METHOD']; 
		$data = array();
		if(in_array($rm, $this->methods)){
			$data = $this->getRequestData($rm);
		}
		$this->db->where('ID_RESPONSABLE', $data['ID_RESPONSABLE']);
		if($this->db->delete('T_RESPONSABLES')){
				$R['success'] = 1;
				$R['head'] = 'Ok';
				$R['message'] = 'Responsable eliminado';
		}else{
			$error = $this->db->error();
				$R['success'] = 0;
				$R['head'] = 'Error: '. $error['code'];
				$R['message'] = ($error['code'] == 1451) ? 'El responsable que intenta eliminar esta asociado a un proyecto.': $error['message'];
		}
		$this->db->db_debug = TRUE; 
		return $this->output->set_content_type('application/json')->set_output(json_encode($R));

	}



}