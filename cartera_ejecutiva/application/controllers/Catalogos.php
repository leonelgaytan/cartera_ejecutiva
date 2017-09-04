<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Catalogos extends MY_Controller {
	var $opciones = array('insert','edit','delete');
	var $methods = array('GET','POST','PUT','DELETE');
	public function __construct()
	{
		parent::__construct();
		if($this->ion_auth->logged_in()){
			if($this->ion_auth->in_group('admin') || $this->ion_auth->in_group('capturista')){
				$this->load->model('catalogos_model','model');
			}else{
				redirect('inicio/sinpermiso', 'refresh');
			}
		}else{
			redirect('auth/login', 'refresh');
		}
	}

	
	public function index()
	{
		$data = $this->getCbos();		
		$data['Content'] = 'catalogos/inicio';
		$this->load->view('includes/template', $data);

	}

	public function getCatalogos(){
		sleep(1);
		//$data = $this->model->getCatalogos();
		$data = $this->getCatalogosList();
		return $this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function getItems(){
		sleep(1);
		$table = $_GET['TBL'];
		$data = $this->model->getItems($table);
		return $this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function getItemsUR(){
		sleep(1);
		$table = $_GET['TBL'];
		$id = $_GET['ID'];
		$data = $this->model->getItemsUR($table,$id);
		return $this->output->set_content_type('application/json')->set_output(json_encode($data));
	}



	public function getId(){
		sleep(1);
		$table = $_GET['TBL'];
		$data = $this->model->getId($table);
		return $this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function getIdUR(){
		sleep(1);
		$table = $_GET['TBL'];
		$id = $_GET['ID'];
		$data = $this->model->getIdUr($table,$id);
		return $this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function guardaItemSecundario(){

		sleep(1);
		$rm = $_SERVER['REQUEST_METHOD']; 
		if(in_array($rm, $this->methods)){
			$data = $this->getRequestData($rm);
			$id = $data['ID'];
			$idSec = $data['ID_SEC'];
			$tbl = $data['TBL'];
			$tblName = $tbl;
			$seqName = getPropCat($tbl,'seq');
			$fieldName = getPropCat($tbl,'name');
			$fieldId = getPropCat($tbl,'id');
			$fieldIdSec = getPropCat($tbl,'id_sec');
			$data[$fieldName] = $data['NAME'];
			$data[$fieldId] = $id;
			$data[$fieldIdSec] = $idSec;
			unset($data['ID']);
			unset($data['ID_SEC']);
			unset($data['TBL']);
			unset($data['NAME']);


			if($rm == 'POST'){
				// Existe el ID que se intenta registrar??
				$itemId = (int)$this->model->getExisteElementoCatalogoSec($tbl,$fieldId,$fieldIdSec,$fieldName,$data[$fieldId],$data[$fieldIdSec],$data[$fieldName]);
				$idExiste = (int)$this->model->getExisteIdCatalogoSec($tbl,$fieldId,$fieldIdSec,$data[$fieldId],$data[$fieldIdSec]);
				if($itemId == 0){
					if($idExiste == 0){
						$R = $this->guarda($tblName,$data);
					}else{
						// Ya existe el id Seleccionado
						$R['success'] = 0;
						$R['message'] = 'El ID (Identificador) ya existe, debe elegir otro.';
					}
				}else{
					// Ya existe el Nombre del item
						$R['success'] = 0;
						$R['message'] = 'Ya existe un elemento dle catálogo con la información ingresada.';

				}


			}elseif($rm == 'PUT'){
				$R = $this->edita($tblName,$id,$data);
			}elseif($rm == 'DELETE'){
				$R = $this->elimina($tblName,$id);
			}



		}else{
			$R['success'] = 0;
			$R['message'] = 'No se ha definido correctamente la accion a realizar';
		}

		return $this->output->set_content_type('application/json')->set_output(json_encode($R));


	}


	public function guardaFormatoRecibido(){

		$rm = $_SERVER['REQUEST_METHOD']; 
		if(in_array($rm, $this->methods)){
			$data = $this->getRequestData($rm);
			$id = $data['ID'];
			$this->db->trans_begin();


			if($rm == 'POST'){

					$formato = array(
						'ID_FORMATO'			=>	$data['ID'],
						'FORMATOS_RECIBIDOS'	=>	$data['NAME']
					);

					$this->db->insert('C_FORMATOS_RECIBIDOS', $formato); 

					// Registramos en R_FORMATO_OFICIO_PROYECTO

					for ($p=0; $p < count($data['ID_TIPO_PROYECTO']); $p++) { 
						for ($o=0; $o < count($data['ID_TIPO_OFICIO']); $o++) { 
							$rel = array(
								'ID_TIPO_OFICIO'	=>	$data['ID_TIPO_OFICIO'][$o],
								'ID_TIPO_PROYECTO'	=>	$data['ID_TIPO_PROYECTO'][$p],
								'ID_FORMATO'		=>	$data['ID'],
								'CREATED'			=>	date('Y-m-d H:i:s')
								);
							$this->db->insert('R_FORMATO_OFICIO_PROYECTO', $rel); 
						}
					}


			}elseif($rm == 'PUT'){
				// Actualizamos nombre del formato
					$formato = array('FORMATOS_RECIBIDOS'	=>	$data['NAME']);
					$this->db->where('ID_FORMATO',$data['ID']);
					$this->db->update('C_FORMATOS_RECIBIDOS', $formato); 
				// Eliminamos las relaciones
				$this->db->delete('R_FORMATO_OFICIO_PROYECTO', array('ID_FORMATO' => $data['ID'])); 
				// Registramos las relaciones
					for ($p=0; $p < count($data['ID_TIPO_PROYECTO']); $p++) { 
						for ($o=0; $o < count($data['ID_TIPO_OFICIO']); $o++) { 
							$rel = array(
								'ID_TIPO_OFICIO'	=>	$data['ID_TIPO_OFICIO'][$o],
								'ID_TIPO_PROYECTO'	=>	$data['ID_TIPO_PROYECTO'][$p],
								'ID_FORMATO'		=>	$data['ID'],
								'CREATED'			=>	date('Y-m-d H:i:s')
								);
							$this->db->insert('R_FORMATO_OFICIO_PROYECTO', $rel); 
						}
					}
			}elseif($rm == 'DELETE'){
				// Eliminamos el formato 
				$this->db->delete('C_FORMATOS_RECIBIDOS', array('ID_FORMATO' => $data['ID'])); 
			}


			if ($this->db->trans_status() === FALSE)
			{
					$R['success'] = 0;
					$R['message'] = 'Error al intentar eliminar.';
			        $this->db->trans_rollback();
			}
			else
			{
					$R['success'] = 1;
					$R['message'] = 'información registrada.';
			        $this->db->trans_commit();
			}


		}else{
			$R['success'] = 0;
			$R['message'] = 'No se ha definido la acción a realizar.';
		}

		return $this->output->set_content_type('application/json')->set_output(json_encode($R));

	}

	public function guardaItem(){

		sleep(1);
		$rm = $_SERVER['REQUEST_METHOD']; 
		if(in_array($rm, $this->methods)){
			$data = $this->getRequestData($rm);$id = $data['ID'];
			$tbl = $data['TBL'];unset($data['ID']);unset($data['TBL']);
			$tblName = $tbl;
			$seqName = getPropCat($tbl,'seq');
			$fieldName = getPropCat($tbl,'name');
			$fieldId = getPropCat($tbl,'id');
			$data[$fieldName] = $data['NAME'];
			$data[$fieldId] = $id;
			unset($data['NAME']);
			unset($data['ID_SEC']);
			if($rm == 'POST'){
				// Existe el ID que se intenta registrar??
				$itemId = (int)$this->model->getExisteElementoCatalogo($tbl,$fieldId,$fieldName,$data[$fieldName]);
				$idExiste = (int)$this->model->getExisteIdCatalogo($tbl,$fieldId,$data[$fieldId]);
				if($itemId == 0){
					if($idExiste == 0){
						$R = $this->guarda($tblName,$data);
					}else{
						// Ya existe el id Seleccionado
						$R['success'] = 0;
						$R['message'] = 'El ID (Identificador) ya existe, debe elegir otro.';
					}
				}else{
					// Ya existe el Nombre del item
						$R['success'] = 0;
						$R['message'] = 'Ya existe un elemento dle catálogo con la información ingresada.';

				}


			}elseif($rm == 'PUT'){
				$R = $this->edita($tblName,$id,$data);
			}elseif($rm == 'DELETE'){
				$R = $this->elimina($tblName,$id);
			}
		}else{
			$R['success'] = 0;
			$R['message'] = 'No se ha definido correctamente la accion a realizar';
		}

		return $this->output->set_content_type('application/json')->set_output(json_encode($R));


	}

	function getFormatosRecibidos(){
		$R = $this->model->getFormatosRecibidos();
		return $this->output->set_content_type('application/json')->set_output(json_encode($R));

	}


}
