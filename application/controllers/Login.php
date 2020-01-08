<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{
		$this->load->view('login');
	}

	public function verifica()
	{
		//model
		$this->load->model('login_model', 'login');

		if(!$this->input->post('username') OR !$this->input->post('password'))
		{
			$data['error'] = "- Todos os campos devem ser preenchimento!";
			$this->load->view('login', $data);
		}
		else
		{
			$login = $this->input->post('username');
			$senha = $this->input->post('password');

			$query = $this->login->verifica($login, $senha);
	
			if ($query) {
	
				$listagem = $this->login->lista($login);
	
				foreach($listagem as $valor){
	
					$data = array(
							'id' 				=> $valor->id,
							'nome' 				=> $valor->nome,
							'cpf' 				=> $valor->cpf,
							'email'				=> $valor->email,
							'tipo_cadastro'		=> $valor->tipo_cadastro,
							'status'			=> $valor->status,
							'liberado'			=> $valor->liberado,
							'artigos'			=> $valor->com_apresentacao,
							'log_in' 			=> TRUE
					);
	
				}
	
				$this->session->set_userdata($data);

				$data['titulo'] = 'Autenticação';
		
				$this->load->view('include/cadastro-header', $data);
				$this->load->view('include/autentica');
				$this->load->view('include/footer');
	
			} else {
	
				$data['error'] = "- Dados não conferem.";
				$this->load->view('login', $data);
	
			}
		}
	}

	public function autentica()
	{
		$data['titulo'] = 'Autenticação';
		
		$this->load->view('include/cadastro-header', $data);
		$this->load->view('include/autentica');
		$this->load->view('include/footer');	
	}
	
	
	public function logoff()
	{
		$this->session->sess_destroy();
		redirect('/');
	}
	
}
