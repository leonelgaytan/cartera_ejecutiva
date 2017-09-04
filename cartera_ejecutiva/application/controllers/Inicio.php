<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login', 'refresh');
		}
	}

	public function index()
	{
		redirect('/inicio/consulta');
	}


	public function sinpermiso(){

		if($this->ion_auth->in_group('admin') || $this->ion_auth->in_group('capturista') || $this->ion_auth->in_group('visualizador')){
			redirect('/consulta');
		}

		$data['Content'] = 'sinpermiso';
		$this->load->view('includes/template', $data);
	}


}
