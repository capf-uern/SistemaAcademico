<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Posteres extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		
		if(!$this->session->userdata('log_in'))
		{
			redirect(base_url(), 'refresh');
		}
	}

//------------------- FUNCOES DOS POSTERES ----------------------------------//
	
	public function index()
	{
		//model
		$this->load->model('posteres_model', 'posteres');
	
		$data['listagem'] 	= $this->posteres->listagemAutor($this->session->userdata('id'));
		$data['participa'] 	= $this->posteres->listagemCoAutor($this->session->userdata('id'));
		$data['titulo'] 	= '<blockquote>Pôsteres  |  Listagem</blockquote>';
		
		$this->load->view('include/header');
		$this->load->view('posteres/visualizar', $data);
		$this->load->view('include/footer');
	}

	public function cadastro()
	{
		//model
		$this->load->model('usuario_model', 'usuario');
		$this->load->model('grupoposteres_model', 'grupoposteres');

		$data['listagem'] 	= $this->grupoposteres->listagem();
		$data['nomes'] 		= $this->usuario->pesquisaNomeArtigos($this->session->userdata('id'));

		$this->load->view('include/header');
		$this->load->view('posteres/cadastro', $data);
		$this->load->view('include/footer');
	}

	public function cadastrar()
	{
		//model
		$this->load->model('posteres_model', 'posteres');

		$path = './uploads/files/';

			if(is_dir($path))
			{
				//parametriza as preferencias
				$config["upload_path"] = $path;
				$config["allowed_types"] = 'pdf|doc|odt|docx';
				$config["overwrite"] = FALSE;
				$config["encrypt_name"] = TRUE;
				$config["remove_spaces"] = TRUE;

				$this->load->library('upload', $config);

				if (!$this->upload->do_upload())
				{
					$data['titulo'] = '| Erro na operação';
					$data['msg'] = 'Erro ao cadastrar, arquivo inválido. Tente novamente!';
					$data['voltar'] = 'javascript:history.back(-1)';

					$this->load->view('include/header');
					$this->load->view('include/mensagem', $data);
					$this->load->view('include/footer');
				}
				else
				{
					//renomeia a foto
					$nomeorig = $config["upload_path"] . "/" . $this->upload->file_name;
					$nomedestino = $config["upload_path"] . "/" . md5(date("YmdH").$this->input->post('titulo').$this->input->post('grupotrabalho')) . $this->upload->file_ext;
					rename($nomeorig, $nomedestino);
					$novo_nome = md5(date("YmdH").$this->input->post('titulo').$this->input->post('grupotrabalho')) . $this->upload->file_ext;

					$data = array(
						'titulo'			=> $this->input->post('titulo'),
						'situacao' 			=> '0',
						'Grupo_Posteres_id'	=> $this->input->post('grupotrabalho'),
						'arquivo'			=> $novo_nome
					);

					$this->db->trans_begin();

					$pegaID = $this->posteres->retornaID($data);

					//insere o AUTOR principal no cadastro
					$this->posteres->autores($pegaID, $this->session->userdata('id'), 1);

					//verifica se os COAUTORES foram setados no cadastro
					if($this->input->post('coautor1'))
					{
						$this->posteres->autores($pegaID, $this->input->post('coautor1_cod'), '0');
					}

					if($this->input->post('coautor2'))
					{
						$this->posteres->autores($pegaID, $this->input->post('coautor2_cod'), '0');
					}

					if($this->input->post('coautor3'))
					{
						$this->posteres->autores($pegaID, $this->input->post('coautor3_cod'), '0');
					}
					//*************************************************

					if ($this->db->trans_status() === FALSE)
					{
						$this->db->trans_rollback();
					}
					else
					{
						$this->db->trans_commit();
						$query = TRUE;
					}

					if($query === FALSE)
					{
						$data['titulo'] = '| Erro na operação';
						$data['msg'] = 'Erro ao atualizar os dados. Tente novamente!';
						$data['voltar'] = 'javascript:history.back(-1)';

						$this->load->view('include/header');
						$this->load->view('include/mensagem', $data);
						$this->load->view('include/footer');
					}
					else
					{
						$envEmail = $this->listagem->emailCoordenadorPoster($this->input->post('grupotrabalho'));

						$this->load->library('email');

						$this->email->from('notify@semanauniversitariacameam.com.br', 'Notificação - Semana Universitária');
						$this->email->to($envEmail);

						$this->email->subject('Notificação - Novo pôster publicado');
						$this->email->message('Notificação automática - Um novo pôster foi publicado na coordenação. Acesso o painel da XVII Semana Universitária.');

						$this->email->send();

						$data['titulo'] = '| Sucesso na operação';
						$data['msg'] = 'Pôster submetido com sucesso!';
						$data['voltar'] = base_url('posteres');

						$this->load->view('include/header');
						$this->load->view('include/mensagem', $data);
						$this->load->view('include/footer');
					}
				}
			}
			else
			{
				$data['titulo'] = '| Erro na operação';
				$data['msg'] = 'Erro ao inserir os dados. Tente novamente!';
				$data['voltar'] = 'javascript:history.back(-1)';
		
				$this->load->view('include/header');
				$this->load->view('include/mensagem', $data);
				$this->load->view('include/footer');
			}
	}

	public function editar($id)
	{
		//model
		$this->load->model('posteres_model', 'posteres');
		$this->load->model('usuario_model', 'usuario');
		$this->load->model('grupoposteres_model', 'grupoposteres');

		$data['nomes'] 		= $this->usuario->pesquisaNome();
		$data['listagem'] 	= $this->posteres->listar_unidade($id);
		$data['gt'] 		= $this->grupoposteres->listagem();
		$data['titulo'] 	= '<blockquote>Pôsteres  |  Editar Informações</blockquote>';
		
		$this->load->view('include/header');
		$this->load->view('posteres/edicao', $data);
		$this->load->view('include/footer');
	}

	public function editado($id)
	{
		//model
		$this->load->model('artigos_model', 'artigos');

		$data = array(
			'titulo'				=> $this->input->post('titulo'),
			'situacao'				=> $this->input->post('situacao'),
			'Grupo_Trabalho_id'		=> $this->input->post('grupotrabalho'),
		);

		$query = $this->artigos->alterar($data, $id);
		if($query === FALSE)
		{
			$data['titulo'] = '| Erro na operação';
			$data['msg'] = 'Erro ao atualizar os dados. Tente novamente!';
			$data['voltar'] = 'javascript:history.back(-1)';
	
			$this->load->view('include/header');
			$this->load->view('include/mensagem', $data);
			$this->load->view('include/footer');
		}
		else
		{
			$data['titulo'] = '| Sucesso na operação';
			$data['msg'] = 'Dados do Resumo Expandido alterados com sucesso!';
			$data['voltar'] = base_url() . $this->uri->segment(1) . '/listagem';
	
			$this->load->view('include/header');
			$this->load->view('include/mensagem', $data);
			$this->load->view('include/footer');
		}
	}

	public function editarposter($id)
	{
		//model
		$this->load->model('posteres_model', 'posteres');
		$this->load->model('usuario_model', 'usuario');
		$this->load->model('grupoposteres_model', 'grupoposteres');

		$data['nomes'] 		= $this->usuario->pesquisaNome();
		$data['listagem'] 	= $this->posteres->listar_unidade($id);
		$data['gt'] 		= $this->grupoposteres->listagem();
		$data['titulo'] 	= '<blockquote>Pôsteres  |  Editar Informações</blockquote>';

		$this->load->view('include/header');
		$this->load->view('posteres/posteres-edicao', $data);
		$this->load->view('include/footer');
	}

	public function editadoposter($id)
	{
		//model
		$this->load->model('artigos_model', 'artigos');

		$data = array(
			'titulo'				=> $this->input->post('titulo'),
			'situacao'				=> $this->input->post('situacao'),
			'Grupo_Trabalho_id'		=> $this->input->post('grupotrabalho'),
		);

		$query = $this->artigos->alterar($data, $id);
		if($query === FALSE)
		{
			$data['titulo'] = '| Erro na operação';
			$data['msg'] = 'Erro ao atualizar os dados. Tente novamente!';
			$data['voltar'] = 'javascript:history.back(-1)';

			$this->load->view('include/header');
			$this->load->view('include/mensagem', $data);
			$this->load->view('include/footer');
		}
		else
		{
			$data['titulo'] = '| Sucesso na operação';
			$data['msg'] = 'Dados do Pôster alterados com sucesso!';
			$data['voltar'] = base_url() . $this->uri->segment(1) . '/listagem';

			$this->load->view('include/header');
			$this->load->view('include/mensagem', $data);
			$this->load->view('include/footer');
		}
	}

	public function listagem()
	{
		//model
		$this->load->model('grupoposteres_model', 'grupoposteres');
	
		$data['listagem'] 	= $this->grupoposteres->listagem();
		$data['titulo'] 	= '<blockquote>Pôsteres  |  Listagem das coordenações</blockquote>';
	
		$this->load->view('include/header');
		$this->load->view('posteres/gt-listagem', $data);
		$this->load->view('include/footer');
	}
	
	public function detalhes($id)
	{
		//model
		$this->load->model('posteres_model', 'posteres');
		$this->load->model('grupoposteres_model', 'grupoposteres');
		
		$data['listagem'] 		= $this->posteres->listar_posteresGT($id);
		$data['grupotrabalho'] 	= $this->grupoposteres->listarGT($id);
		$data['titulo'] 		= '<blockquote>Pôsteres  | Listagem por coordenação</blockquote>';
		
		$this->load->view('include/header');
		$this->load->view('posteres/detalhes', $data);
		$this->load->view('include/footer');
	}

	public function cartaaceite($id)
	{
		//model
		$this->load->model('posteres_model', 'posteres');

		$path = './uploads/files/';

			if(is_dir($path))
			{
				//parametriza as preferencias
				$config["upload_path"] = $path;
				$config["allowed_types"] = 'pdf|doc|odt|docx';
				$config["overwrite"] = TRUE;
				$config["encrypt_name"] = TRUE;
				$config["remove_spaces"] = TRUE;

				$this->load->library('upload', $config);

				if (!$this->upload->do_upload())
				{
					$data = array(
						'situacao'	=> $this->input->post('situacao'),
						'parecer' 	=> $this->input->post('parecer')
					);

					$query = $this->posteres->alterar($data, $id);
					if($query === FALSE)
					{
						$data['titulo'] = '| Erro na operação';
						$data['msg'] 	= 'Erro ao registrar os dados. Tente novamente!';
						$data['voltar'] = 'javascript:history.back(-1)';

						$this->load->view('include/header');
						$this->load->view('include/mensagem', $data);
						$this->load->view('include/footer');
					}
					else
					{
						$data['titulo'] = '| Sucesso na operação';
						$data['msg'] = 'Parecer cadastrado com sucesso!';
						$data['voltar'] = 'javascript:history.back(-1)';

						$this->load->view('include/header');
						$this->load->view('include/mensagem', $data);
						$this->load->view('include/footer');
					}
				}
				else
				{
					//renomeia a foto
					$nomeorig = $config["upload_path"] . "/" . $this->upload->file_name;
					$nomedestino = $config["upload_path"] . "/" . md5(date("YmdH").$id.$this->input->post('situacao')) . $this->upload->file_ext;
					rename($nomeorig, $nomedestino);
					$novo_nome = md5(date("YmdH").$id.$this->input->post('situacao')) . $this->upload->file_ext;

					$data = array(
						'situacao'		=> $this->input->post('situacao'),
						'parecer' 		=> $this->input->post('parecer'),
						'carta_aceite'	=> $novo_nome
					);

					$query = $this->posteres->alterar($data, $id);
					if($query === FALSE)
					{
						$data['titulo'] = '| Erro na operação';
						$data['msg'] 	= 'Parecer cadastrado com sucesso!';
						$data['voltar'] = 'javascript:history.back(-1)';

						$this->load->view('include/header');
						$this->load->view('include/mensagem', $data);
						$this->load->view('include/footer');
					}
					else
					{
						$data['titulo'] = '| Sucesso na operação';
						$data['msg'] = 'Parecer cadastrado com sucesso!';
						$data['voltar'] = 'javascript:history.back(-1)';

						$this->load->view('include/header');
						$this->load->view('include/mensagem', $data);
						$this->load->view('include/footer');
					}
				}
			}
			else
			{
				$data['titulo'] = '| Erro na operação';
				$data['msg'] = 'Erro ao inserir os dados. Tente novamente!';
				$data['voltar'] = 'javascript:history.back(-1)';
		
				$this->load->view('include/header');
				$this->load->view('include/mensagem', $data);
				$this->load->view('include/footer');
			}
	}

	public function presente($participante, $minicurso)
	{
		//model
		$this->load->model('artigos_model', 'artigos');

		$data = array(
			'presente'	=> '1'
		);

		$query = $this->artigos->participacao($participante, $minicurso, $data);
		if($query === FALSE)
		{
			$data['titulo'] = '| Erro na operação';
			$data['msg'] = 'Erro ao atualizar os dados. Tente novamente!';
			$data['voltar'] = 'javascript:history.back(-1)';
	
			$this->load->view('include/header');
			$this->load->view('include/mensagem', $data);
			$this->load->view('include/footer');
		}
		else
		{
			$data['titulo'] = '| Sucesso na operação';
			$data['msg'] = 'Participante registrado com sucesso!';
			$data['voltar'] = base_url() . $this->uri->segment(1) . '/listar/' . $minicurso;
	
			$this->load->view('include/header');
			$this->load->view('include/mensagem', $data);
			$this->load->view('include/footer');
		}
	}

	public function removeInscricao($participante, $minicurso)
	{
		//model
		$this->load->model('artigos_model', 'artigos');
		
		$query = $this->artigos->removerInscricao($participante, $minicurso);
		if($query === FALSE)
		{
			$data['titulo'] = '| Erro na operação';
			$data['msg'] 	= 'Erro ao remover o participante. Tente novamente!';
			$data['voltar'] = 'javascript:history.back(-1)';
	
			$this->load->view('include/header');
			$this->load->view('include/mensagem', $data);
			$this->load->view('include/footer');
		}
		else
		{
			$data['titulo'] = '| Sucesso na operação';
			$data['msg'] = 'Inscrição removida com sucesso!';
			$data['voltar'] = base_url() . $this->uri->segment(1) . '/listar/' . $minicurso;
	
			$this->load->view('include/header');
			$this->load->view('include/mensagem', $data);
			$this->load->view('include/footer');
		}
	}

	public function removegt($gt)
	{
		//model
		$this->load->model('grupoposteres_model', 'grupoposteres');
		
		$query = $this->grupoposteres->excluir($gt);
		if($query === FALSE)
		{
			$data['titulo'] = '| Erro na operação';
			$data['msg'] 	= 'Erro ao remover a coordenação. Tente novamente!';
			$data['voltar'] = 'javascript:history.back(-1)';
	
			$this->load->view('include/header');
			$this->load->view('include/mensagem', $data);
			$this->load->view('include/footer');
		}
		else
		{
			$data['titulo'] = '| Sucesso na operação';
			$data['msg'] = 'Coordenação removida com sucesso!';
			$data['voltar'] = base_url() . $this->uri->segment(1) . '/listagem';
			
			$this->load->view('include/header');
			$this->load->view('include/mensagem', $data);
			$this->load->view('include/footer');
		}
	}

	public function removeposter($id)
	{
		//model
		$this->load->model('posteres_model', 'posteres');

		$arquivo = $this->posteres->excluir_arquivo($id);

		foreach ($arquivo as $arq)
		{
			$caminho = $arq->arquivo;
		}

		$path = './uploads/files/'.$caminho;

		$result = unlink($path);
		if($result)
		{
			$query = $this->posteres->excluir($id);
			if($query)
			{
				$data['titulo'] = '| Sucesso na operação';
				$data['msg'] = 'Pôster excluído com sucesso!';
				$data['voltar'] = 'javascript:history.back(-1)';

				$this->load->view('include/header');
				$this->load->view('include/mensagem', $data);
				$this->load->view('include/footer');
			}
			else
			{
				$data['titulo'] = '| Erro na operação';
				$data['msg'] 	= 'Erro ao remover o arquivo. Tente novamente!';
				$data['voltar'] = 'javascript:history.back(-1)';

				$this->load->view('include/header');
				$this->load->view('include/mensagem', $data);
				$this->load->view('include/footer');
			}
		}
		else
		{
			$data['titulo'] = '| Erro na operação';
			$data['msg'] 	= 'Erro ao remover o arquivo. Tente novamente!';
			$data['voltar'] = 'javascript:history.back(-1)';

			$this->load->view('include/header');
			$this->load->view('include/mensagem', $data);
			$this->load->view('include/footer');
		}
	}
	
//------------------- FUNCOES DOS POSTERES ----------------------------------//

//------------------- FUNCOES DOS COORDENADORES ----------------------------------//

	public function criargt()
	{
		header("Access-Control-Allow-Origin: *");

		//model
		$this->load->model('usuario_model', 'usuario');

		$data['nomes'] 	= $this->usuario->pesquisaNomeArtigos($this->session->userdata('id'));

		$this->load->view('include/header');
		$this->load->view('posteres/gt-cadastro', $data);
		$this->load->view('include/footer');
	}

	public function cadastrargt()
	{
		header("Access-Control-Allow-Origin: *");

		//model
		$this->load->model('grupoposteres_model', 'grupoposteres');

		$data = array(
			'titulo'		=> $this->input->post('titulo'),
			'Usuario_id'	=> $this->input->post('coordenador_cod'),
		);

		$query = $this->grupoposteres->cadastrar($data);
		if($query === FALSE)
		{
			$data['titulo'] = '| Erro na operação';
			$data['msg'] = 'Erro ao atualizar os dados. Tente novamente!';
			$data['voltar'] = 'javascript:history.back(-1)';

			$this->load->view('include/header');
			$this->load->view('include/mensagem', $data);
			$this->load->view('include/footer');
		}
		else
		{
			$data['titulo'] = '| Sucesso na operação';
			$data['msg'] = 'Coordenação criada com sucesso!';
			$data['voltar'] = base_url() . $this->uri->segment(1) . '/listagem';

			$this->load->view('include/header');
			$this->load->view('include/mensagem', $data);
			$this->load->view('include/footer');
		}
	}

	public function editargt($id)
	{
		//model
		$this->load->model('grupoposteres_model', 'grupoposteres');
		$this->load->model('usuario_model', 'usuario');

		$data['listagem'] 	= $this->grupoposteres->listarGT($id);
		$data['nomes'] 		= $this->usuario->pesquisaNomeArtigos($this->session->userdata('id'));
		$data['titulo'] = '<blockquote>Pôsteres  |  Editar Coordenação</blockquote>';

		$this->load->view('include/header');
		$this->load->view('posteres/gt-edicao', $data);
		$this->load->view('include/footer');
	}

	public function editadogt($id)
	{
		//model
		$this->load->model('grupoposteres_model', 'grupoposteres');

		$data = array(
			'titulo'		=> $this->input->post('titulo'),
			'Usuario_id'	=> $this->input->post('coordenador_cod')
		);

		$query = $this->grupoposteres->alterar($data, $id);
		if($query === FALSE)
		{
			$data['titulo'] = '| Erro na operação';
			$data['msg'] = 'Erro ao atualizar os dados. Tente novamente!';
			$data['voltar'] = 'javascript:history.back(-1)';

			$this->load->view('include/header');
			$this->load->view('include/mensagem', $data);
			$this->load->view('include/footer');
		}
		else
		{
			$data['titulo'] = '| Sucesso na operação';
			$data['msg'] = 'Dados alterados com sucesso!';
			$data['voltar'] = base_url() . $this->uri->segment(1) . '/listagem';

			$this->load->view('include/header');
			$this->load->view('include/mensagem', $data);
			$this->load->view('include/footer');
		}
	}

	public function coordenacao()
	{
		//model
		$this->load->model('grupoposteres_model', 'grupoposteres_model');

		$data['listagem'] 	= $this->grupoposteres_model->filtro_listagem($this->session->userdata('id'));
		$data['titulo'] 	= '<blockquote>Pôsteres  |  Listagem </blockquote>';

		$this->load->view('include/header');
		$this->load->view('posteres/coordenador-listagem', $data);
		$this->load->view('include/footer');
	}

	public function coordenacaodetalhes($id)
	{
		//model
		$this->load->model('posteres_model', 'posteres');
		$this->load->model('grupoposteres_model', 'grupoposteres');

		$data['listagem'] 		= $this->posteres->listar_posteresGT($id);
		$data['grupotrabalho'] 	= $this->grupoposteres->listarGT($id);
		$data['titulo'] 		= '<blockquote>Pôsteres  | Listagem por coordenação</blockquote>';

		$this->load->view('include/header');
		$this->load->view('posteres/coordenador-detalhes', $data);
		$this->load->view('include/footer');
	}

	public function coordenacaoeditar($id)
	{
		//model
		$this->load->model('grupoposteres_model', 'grupoposteres');
		$this->load->model('usuario_model', 'usuario');

		$data['listagem'] 	= $this->grupoposteres->listarGT($id);
		$data['nomes'] 		= $this->usuario->pesquisaNomeArtigos($this->session->userdata('id'));
		$data['titulo'] 	= '<blockquote>Pôsteres  |  Editar Coordenação</blockquote>';

		$this->load->view('include/header');
		$this->load->view('posteres/coordenador-edicao', $data);
		$this->load->view('include/footer');
	}

	public function coordenacaoeditado($id)
	{
		//model
		$this->load->model('grupoposteres_model', 'grupoposteres');

		$data = array(
			'titulo'	=> $this->input->post('titulo')
		);

		$query = $this->grupoposteres->alterar($data, $id);
		if($query === FALSE)
		{
			$data['titulo'] = '| Erro na operação';
			$data['msg'] = 'Erro ao atualizar os dados. Tente novamente!';
			$data['voltar'] = 'javascript:history.back(-1)';

			$this->load->view('include/header');
			$this->load->view('include/mensagem', $data);
			$this->load->view('include/footer');
		}
		else
		{
			$data['titulo'] = '| Sucesso na operação';
			$data['msg'] = 'Dados alterados com sucesso!';
			$data['voltar'] = base_url() . $this->uri->segment(1) . '/coordenacao';

			$this->load->view('include/header');
			$this->load->view('include/mensagem', $data);
			$this->load->view('include/footer');
		}
	}

	public function postereditar($id)
	{
		//model
		$this->load->model('posteres_model', 'posteres');
		$this->load->model('usuario_model', 'usuario');
		$this->load->model('grupoposteres_model', 'grupoposteres');

		$data['nomes'] 		= $this->usuario->pesquisaNome();
		$data['listagem'] 	= $this->posteres->listar_unidade($id);
		$data['gt'] 		= $this->grupoposteres->listagem();
		$data['titulo'] 	= '<blockquote>Pôsteres  |  Editar Informações</blockquote>';

		$this->load->view('include/header');
		$this->load->view('posteres/posteres-edicao', $data);
		$this->load->view('include/footer');
	}

	public function postereditado($id)
	{
		//model
		$this->load->model('posteres_model', 'posteres');

		$data = array(
			'titulo'	=> $this->input->post('titulo'),
			'situacao'	=> $this->input->post('situacao')
		);

		$query = $this->posteres->alterar($data, $id);
		if($query === FALSE)
		{
			$data['titulo'] = '| Erro na operação';
			$data['msg'] = 'Erro ao atualizar os dados. Tente novamente!';
			$data['voltar'] = 'javascript:history.back(-1)';

			$this->load->view('include/header');
			$this->load->view('include/mensagem', $data);
			$this->load->view('include/footer');
		}
		else
		{
			$data['titulo'] = '| Sucesso na operação';
			$data['msg'] = 'Dados do Pôster alterados com sucesso!';
			$data['voltar'] = base_url() . $this->uri->segment(1) . '/coordenacao';

			$this->load->view('include/header');
			$this->load->view('include/mensagem', $data);
			$this->load->view('include/footer');
		}
	}

//------------------- FUNCOES DOS COORDENADORES ----------------------------------//
	
//------------------- FUNCOES DO AJAX ----------------------------------//
	
	public function get_externo()
	{
		//model
		$this->load->model('usuario_model', 'usuario');

		$this->usuario->pesquisaNome();

		foreach($this->usuario->pesquisaNome() as $lista)
		{
			$arr = array(
				'nome'	=> $lista->nome
			);
		}
		return json_encode($arr);
	}

	public function externo_informacoes($dado1)
	{
		$dado1 = $this->input->post('busca');

		$this->db->where("nome", $dado1);
		$verifica = $this->db->get('usuario');
		$verifica->result();

		if(count($verifica->result())>0)
		{
			foreach($verifica->result() as $lista)
			{
				$arr = array(
					'id'	=> $lista->id,
					'nome'	=> $lista->nome
				);
			echo json_encode($arr);
			}
		}
		else
		{
			echo '1';
		}
	}
	
//------------------- FUNCOES DO AJAX ----------------------------------//

}