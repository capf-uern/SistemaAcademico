<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Painel extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		if(!$this->session->userdata('log_in'))
		{
			redirect(base_url(), 'refresh');
		}
	}

	public function index()
	{
		$this->load->view('include/header');
		$this->load->view('painel');
		$this->load->view('include/footer');
	}

	public function pagamento()
	{
		//model
		$this->load->model('usuario_model', 'usuario');

		$path = './uploads/files/';
			
		$id = $this->session->userdata('id');

			if(is_dir($path))
			{
				//parametriza as preferencias
				$config["upload_path"] = $path;
				$config["allowed_types"] = 'pdf|jpg|jpeg|png|txt';
				$config["overwrite"] = FALSE;
				$config["encrypt_name"] = TRUE;
				$config["remove_spaces"] = TRUE;
				
				$this->load->library('upload', $config);
	
				if (!$this->upload->do_upload())
				{
					$data['titulo'] = '| Erro na operação';
					$data['msg'] = 'Erro ao enviar o arquivo. Tente novamente!';
					$data['voltar'] = 'javascript:history.back(-1)';
			
					$this->load->view('include/header');
					$this->load->view('include/mensagem', $data);
					$this->load->view('include/footer');
				}
				else
				{
					$nomeorig = $config["upload_path"] . "/" . $this->upload->file_name;
					$nomedestino = $config["upload_path"] . "/" . md5(date("YmdH").$id) . $this->upload->file_ext;
					rename($nomeorig, $nomedestino);
					$novo_nome = md5(date("YmdH").$id) . $this->upload->file_ext;

					$data = array(
							'comprovante_pagamento'	=> $novo_nome
					);
				
					$query = $this->usuario->alterar($data, $id);
				
					if($query === FALSE)
					{
						$data['titulo'] = '| Erro na operação';
						$data['msg'] = 'Erro ao atualizar os dados. Tente novamente!';
						$data['voltar'] = 'javascript:history.back(-1)';
				
						$this->load->view('include/header');
						$this->load->view('include/mensagem', $data);
						$this->load->view('include/footer');
					}
					else{
							
						$data['titulo'] = '| Sucesso na operação';
						$data['msg'] = 'Comprovante de pagamento enviado com sucesso!';
						$data['voltar'] = base_url('painel');
				
						$this->load->view('include/header');
						$this->load->view('include/mensagem', $data);
						$this->load->view('include/footer');
					}
				}
			}
			else{

				$data['titulo'] = '| Erro na operação';
				$data['msg'] = 'Erro ao inserir os dados. Tente novamente!';
				$data['voltar'] = 'javascript:history.back(-1)';
		
				$this->load->view('include/header');
				$this->load->view('include/mensagem', $data);
				$this->load->view('include/footer');
			}
	}

	public function listagem()
	{
		//model
		$this->load->model('usuario_model', 'usuario');
		$this->load->model('minicursos_model', 'minicursos');
		$this->load->model('oficinas_model', 'oficinas');
		$this->load->model('posteres_model', 'posteres');

		$data['inscritos'] 	= $this->usuario->contaRegistros();
		$data['minicursos'] = $this->minicursos->contaRegistros();
		$data['oficinas'] 	= $this->oficinas->contaRegistros();
		$data['posteres'] 	= $this->posteres->contagem_posteres();
		$data['ultimos']	= $this->usuario->ultimos_registros(5);

		$data['professores']	= $this->usuario->contagem_tipo(1);
		$data['posgraduacao']	= $this->usuario->contagem_tipo(2);
		$data['graduacao']		= $this->usuario->contagem_tipo(3);
		$data['tecnico']		= $this->usuario->contagem_tipo(4);
		$data['demais']			= $this->usuario->contagem_tipo(5);

		$this->load->view('include/header');
		$this->load->view('painel/informacoes', $data);
		$this->load->view('include/footer');
	}
}