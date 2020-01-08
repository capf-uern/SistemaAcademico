<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Formulario extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$data['titulo'] = 'Cadastro do Usuário';
		
		$this->load->view('include/cadastro-header', $data);
		$this->load->view('dados/cadastro');
		$this->load->view('include/footer');
	}

	public function cadastrar()
	{
		//model
		$this->load->model('usuario_model', 'usuario');

		$path = './uploads/files/';

			if(is_dir($path))
			{
				//parametriza as preferencias
				$config["upload_path"] = $path;
				$config["allowed_types"] = 'pdf|jpg|jpeg';
				$config["overwrite"] = FALSE;
				$config["encrypt_name"] = TRUE;
				$config["remove_spaces"] = TRUE;

				$this->load->library('upload', $config);

				if (!$this->upload->do_upload())
				{
					$this->form_validation->set_rules('cpf', 'CPF', 'callback_cpf_check');
					$this->form_validation->set_rules('email', 'E-MAIL', 'required|callback_email_check');
					$this->form_validation->set_rules('nome_completo', 'NOME COMPLETO', 'required');
					$this->form_validation->set_rules('telefone_ddd', 'DDD', 'required');
					$this->form_validation->set_rules('telefone', 'TELEFONE', 'required');
					$this->form_validation->set_error_delimiters('<div class="error_box">', '</div>');
					if ($this->form_validation->run() == FALSE)
					{
						$data['titulo'] = 'Cadastro do Usuário';

						$this->load->view('include/cadastro-header', $data);
						$this->load->view('dados/cadastro');
						$this->load->view('include/footer');
					}
					else
					{
						switch ($this->input->post('opcao'))
						{
							case '1':
								$profissao = "Professor Universitário";
								break;
							case '2':
								$profissao = "Aluno de Pós-Graduação";
								break;
							case '3':
								$profissao = "Aluno de Graduação";
								break;
							case '4':
								$profissao = "Técnico Administrativo";
								break;
							default:
								$profissao = $this->input->post('profissao');
								break;
						}

						$submissao = $this->input->post('submissao');

						if($submissao != '1')
						{
							$submissao = '0';
						}

						$data = array(
								'cpf'				=> $this->input->post('cpf'),
								'nome' 				=> $this->input->post('nome_completo'),
								'ddd'				=> $this->input->post('telefone_ddd'),
								'telefone'			=> $this->input->post('telefone'),
								'email'				=> $this->input->post('email'),
								'senha'				=> md5($this->input->post('senha')),
								'area_interesse'	=> $this->input->post('interesse'),
								'instituicao'		=> $this->input->post('instituicao'),
								'tipo_cadastro'		=> $this->input->post('opcao'),
								'chamada'			=> '2',
								'profissao'			=> $profissao,
								'com_apresentacao'	=> $submissao
						);

						$query = $this->usuario->cadastrar($data);

						if($query === FALSE)
						{
							$msg['erro'] = "Não foi possível inserir os dados.";

							$data['titulo'] = 'Cadastro do Usuário';

							$this->load->view('include/cadastro-header', $data);
							$this->load->view('include/cadastro-erro', $msg);
							$this->load->view('include/footer');
						}
						else
						{
							$data['titulo'] = 'Cadastro do Usuário';

							$this->load->view('include/cadastro-header', $data);
							$this->load->view('include/cadastro-sucesso');
							$this->load->view('include/footer');
						}
					}
				}
				else
				{
					//renomeia a foto
					$nomeorig = $config["upload_path"] . "/" . $this->upload->file_name;
					$nomedestino = $config["upload_path"] . "/" . md5($this->input->post('cpf').$this->input->post('nome_completo')) . $this->upload->file_ext;
					rename($nomeorig, $nomedestino);
					$novo_nome = md5($this->input->post('cpf').$this->input->post('nome_completo')) . $this->upload->file_ext;

					$this->form_validation->set_rules('cpf', 'CPF', 'callback_cpf_check');
					$this->form_validation->set_rules('email', 'E-MAIL', 'required|callback_email_check');
					$this->form_validation->set_rules('nome_completo', 'NOME COMPLETO', 'required');
					$this->form_validation->set_rules('telefone_ddd', 'DDD', 'required');
					$this->form_validation->set_rules('telefone', 'TELEFONE', 'required');
					$this->form_validation->set_error_delimiters('<div class="error_box">', '</div>');
					if ($this->form_validation->run() == FALSE)
					{
						$data['titulo'] = 'Cadastro do Usuário';

						$this->load->view('include/cadastro-header', $data);
						$this->load->view('dados/cadastro');
						$this->load->view('include/footer');
					}
					else
					{
						switch ($this->input->post('opcao'))
						{
							case '1':
								$profissao = "Professor Universitário";
								break;
							case '2':
								$profissao = "Aluno de Pós-Graduação";
								break;
							case '3':
								$profissao = "Aluno de Graduação";
								break;
							case '4':
								$profissao = "Técnico Administrativo";
								break;
							default:
								$profissao = $this->input->post('profissao');
								break;
						}

						$submissao = $this->input->post('submissao');

						if($submissao != '1')
						{
							$submissao = '0';
						}

						$data = array(
							'cpf'					=> $this->input->post('cpf'),
							'nome' 					=> $this->input->post('nome_completo'),
							'ddd'					=> $this->input->post('telefone_ddd'),
							'telefone'				=> $this->input->post('telefone'),
							'email'					=> $this->input->post('email'),
							'senha'					=> md5($this->input->post('senha')),
							'area_interesse'		=> $this->input->post('interesse'),
							'instituicao'			=> $this->input->post('instituicao'),
							'tipo_cadastro'			=> $this->input->post('opcao'),
							'chamada'				=> '1',
							'profissao'				=> $profissao,
							'com_apresentacao'		=> $submissao,
							'comprovante_matricula'	=> $novo_nome
						);

						$query = $this->usuario->cadastrar($data);
					
						if($query === FALSE)
						{
							$msg['erro'] = "Não foi possível inserir os dados.";
							$data['titulo'] = 'Cadastro do Usuário';
					
							$this->load->view('include/cadastro-header', $data);
							$this->load->view('include/cadastro-erro', $msg);
							$this->load->view('include/footer');
						}
						else
						{
							$data['titulo'] = 'Cadastro do Usuário';
					
							$this->load->view('include/cadastro-header', $data);
							$this->load->view('include/cadastro-sucesso');
							$this->load->view('include/footer');
						}
					}
				}
			}
			else
			{
				$msg['erro'] = "Não foi possível realizar o cadastro. Tente novamente.";
				$data['titulo'] = 'Cadastro do Usuário';
		
				$this->load->view('include/cadastro-header', $data);
				$this->load->view('include/cadastro-erro', $msg);
				$this->load->view('include/footer');
			}
	}

	function cpf_check($number)
	{
		//model
		$this->load->model('usuario_model', 'usuario');
		
		$return_value = $this->usuario->verificar_cpf($number);
		if ($return_value)
		{
			$this->form_validation->set_message('cpf_check', 'O <strong>CPF</strong> informado já está cadastrado!');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

	function email_check($mail)
	{
		//model
		$this->load->model('usuario_model', 'usuario');
		
		$return_value = $this->usuario->verificar_email($mail);
		if ($return_value)
		{
			$this->form_validation->set_message('email_check', 'O <strong>E-MAIL</strong> informado já está cadastrado!');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
}