<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Certificados extends CI_Controller{

	public function __construct()
	{
		parent::__construct();
		
			if(!$this->session->userdata('log_in'))
			{
				redirect(base_url(), 'refresh');
			}
	}

	public function index()
	{
		//model
		$this->load->model('minicursos_model', 'minicursos');
		$this->load->model('oficinas_model', 'oficinas');
		$this->load->model('usuario_model', 'usuario');
		$this->load->model('artigos_model', 'artigos');

		$id = $this->session->userdata('id');

		$data['titulo'] = '| Impressão de Certificados';
		$data['voltar'] = base_url() .  'painel';

		$data['minicurso'] 		= $this->minicursos->verificar_presenca($id);
		$data['oficina'] 		= $this->oficinas->verificar_presenca($id);
		$data['usuario'] 		= $this->usuario->verificar_presenca($id);
		$data['resumos'] 		= $this->artigos->verificar_presenca($id);
		$data['min_minicurso']	= $this->minicursos->certificado_ministrante($id);
		$data['min_oficina']	= $this->oficinas->certificado_ministrante($id);

		$this->load->view('include/header');
		$this->load->view('certificados/listagem', $data);
		$this->load->view('include/footer');
	}
}