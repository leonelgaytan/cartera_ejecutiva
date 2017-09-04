<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Consulta extends MY_Controller {
	var $opciones = array('insert','edit','delete');
	var $methods = array('GET','POST','PUT','DELETE');
	public function __construct()
	{
		parent::__construct();
		if($this->ion_auth->logged_in()){
			if($this->ion_auth->in_group('admin') || $this->ion_auth->in_group('capturista') || $this->ion_auth->in_group('visualizador')  || $this->ion_auth->in_group('responsables')){
				$this->load->model('consulta_model','model');
			}else{
				redirect('inicio/sinpermiso', 'refresh');
			}
		}else{
			redirect('auth/login', 'refresh');
		}
	}

	public function index(){
		$data = $this->getCbos();
		$data['Content'] = 'consulta/inicio2';
		$this->load->view('includes/template', $data);
	}




	public function buscar(){

		$folio = $_GET['folio'];
		$nombre = $_GET['nombre'];
		$oficio = $_GET['DESCRIP_OFICIO'];
		$ur = isset($_GET['ur']) ? $_GET['ur'] : array();
		$fp = isset($_GET['fp']) ? $_GET['fp'] : array();
		$anio = isset($_GET['anio']) ? $_GET['anio'] : array();
		$pluri = isset($_GET['PLURIANUALIDAD']) ? $_GET['PLURIANUALIDAD'] : '';
		$data = $this->model->buscarFolios($folio,$nombre,$anio,$ur,$fp,$oficio,$pluri);
		return $this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function buscarBitacora(){
		$demID = $_GET['id'];
		$data = $this->model->buscarBitacora($demID);
		return $this->output->set_content_type('application/json')->set_output(json_encode($data));
	}



	public function buscarDetalle(){
		$data = $this->model->buscarDetalle($_GET['id']);
		return $this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

}