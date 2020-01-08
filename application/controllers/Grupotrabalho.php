<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Grupotrabalho extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		if(!$this->session->userdata('log_in'))
		{
			redirect(base_url(), 'refresh');
		}
	}
	
//------------------- FUNCOES DOS GRUPOS DE TRABALHO -------------------------//

	public function index()
	{
		//model
		$this->load->model('grupotrabalho_model', 'grupotrabalho');
	
		$data['listagem'] 	= $this->grupotrabalho->filtro_listagem($this->session->userdata('id'));
		$data['titulo'] = '<blockquote>Resumos Expandidos  |  Listagem </blockquote>';
		
		$this->load->view('include/header');
		$this->load->view('grupotrabalho/gt-listagem', $data);
		$this->load->view('include/footer');
	}

	public function editargt($id)
	{
		//model
		$this->load->model('grupotrabalho_model', 'grupotrabalho');
		$this->load->model('usuario_model', 'usuario');
	
		$data['listagem'] 	= $this->grupotrabalho->listarGT($id);
		$data['nomes'] 		= $this->usuario->pesquisaNomeArtigos($this->session->userdata('id'));
		$data['titulo'] = '<blockquote>Grupo de Trabalho  |  Editar Grupo de Trabalho</blockquote>';
	
		$this->load->view('include/header');
		$this->load->view('grupotrabalho/gt-edicao', $data);
		$this->load->view('include/footer');
	}

	public function editadogt($id)
	{
		//model
		$this->load->model('grupotrabalho_model', 'grupotrabalho');

		$data = array(
			'titulo'	=> $this->input->post('titulo')
		);

		$query = $this->grupotrabalho->alterar($data, $id);
	
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
			$data['voltar'] = base_url() . $this->uri->segment(1);
	
			$this->load->view('include/header');
			$this->load->view('include/mensagem', $data);
			$this->load->view('include/footer');
		}
	}

	public function cadastro()
	{
		//model
		$this->load->model('usuario_model', 'usuario');
		$this->load->model('grupotrabalho_model', 'grupotrabalho');

		$data['listagem'] 	= $this->grupotrabalho->listagem();
		$data['nomes'] 		= $this->usuario->pesquisaNomeArtigos($this->session->userdata('id'));

		$this->load->view('include/header');
		$this->load->view('grupotrabalho/cadastro', $data);
		$this->load->view('include/footer');
	}

	public function cadastrar()
	{
		//model
		$this->load->model('artigos_model', 'artigos');

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
					'Grupo_Trabalho_id'	=> $this->input->post('grupotrabalho'),
					'arquivo'			=> $novo_nome
				);

				$this->db->trans_begin();

				$pegaID = $this->artigos->retornaID($data);

				//insere o AUTOR principal no cadastro
				$this->artigos->autores($pegaID, $this->session->userdata('id'), 1);

				//verifica se os COAUTORES foram setados no cadastro
					if($this->input->post('coautor1'))
					{
						$this->artigos->autores($pegaID, $this->input->post('coautor1_cod'), '0');
					}

					if($this->input->post('coautor2'))
					{
						$this->artigos->autores($pegaID, $this->input->post('coautor2_cod'), '0');
					}

					if($this->input->post('coautor3'))
					{
						$this->artigos->autores($pegaID, $this->input->post('coautor3_cod'), '0');
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
					$data['titulo'] = '| Sucesso na operação';
					$data['msg'] = 'Artigo submetido com sucesso!';
					$data['voltar'] = base_url('artigos');

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
		$this->load->model('artigos_model', 'artigos');
		$this->load->model('usuario_model', 'usuario');
		$this->load->model('grupotrabalho_model', 'grupotrabalho');

		$data['nomes'] 		= $this->usuario->pesquisaNome();
		$data['listagem'] 	= $this->artigos->listar_unidade($id);
		$data['gt'] 		= $this->grupotrabalho->listagem();
		$data['titulo'] = '<blockquote>Resumo Expandido  |  Editar Informações</blockquote>';
		
		$this->load->view('include/header');
		$this->load->view('grupotrabalho/edicao', $data);
		$this->load->view('include/footer');
	}

	public function editado($id)
	{
		//model
		$this->load->model('artigos_model', 'artigos');

		$data = array(
			'titulo'	=> $this->input->post('titulo'),
			'situacao'	=> $this->input->post('situacao'),
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
			$data['msg'] = 'Dados do Artigo alterados com sucesso!';
			$data['voltar'] = base_url() . $this->uri->segment(1);
	
			$this->load->view('include/header');
			$this->load->view('include/mensagem', $data);
			$this->load->view('include/footer');
		}
	}

	public function listagem()
	{
		//model
		$this->load->model('grupotrabalho_model', 'grupotrabalho');
	
		$data['listagem'] 	= $this->grupotrabalho->listagem();
		$data['titulo'] = '<blockquote>Artigos  |  Listagem dos Grupos de Trabalhos</blockquote>';
	
		$this->load->view('include/header');
		$this->load->view('grupotrabalho/gt-listagem', $data);
		$this->load->view('include/footer');
	}
	
	public function detalhes($id)
	{
		//model
		$this->load->model('artigos_model', 'artigos');
		$this->load->model('grupotrabalho_model', 'grupotrabalho');
		
		$data['listagem'] = $this->artigos->listar_artigosGT($id);
		$data['grupotrabalho'] = $this->grupotrabalho->listarGT($id);
		$data['titulo'] = '<blockquote>Grupo de Trabalho  |  Listagem :: Resumo expandido </blockquote>';
		
		$this->load->view('include/header');
		$this->load->view('grupotrabalho/detalhes', $data);
		$this->load->view('include/footer');
	}

	public function certificado($id)
	{
		//model
		$this->load->model('artigos_model', 'artigos');

		$data = array(
			'certificado'	=> '1'
		);

		$query = $this->artigos->alterar_certificado($data, $id);

		if($query === FALSE)
		{
			$data['titulo'] = '| Erro na operação';
			$data['msg'] = 'Certificado já gerado no sistema.';
			$data['voltar'] = 'javascript:history.back(-1)';

			$this->load->view('include/header');
			$this->load->view('include/mensagem', $data);
			$this->load->view('include/footer');
		}
		else
		{
			$data['titulo'] = '| Sucesso na operação';
			$data['msg'] = 'Certificado gerado com sucesso!';
			$data['voltar'] = base_url() . $this->uri->segment(1);

			$this->load->view('include/header');
			$this->load->view('include/mensagem', $data);
			$this->load->view('include/footer');
		}
	}

	public function detalhesposteres($id)
	{
		//model
		$this->load->model('posteres_model', 'posteres');
		$this->load->model('grupotrabalho_model', 'grupotrabalho');

		$data['listagem'] = $this->posteres->listar_posteresGT($id);
		$data['grupotrabalho'] = $this->grupotrabalho->listarGT($id);
		$data['titulo'] = '<blockquote>Grupo de Trabalho  |  Listagem :: Pôsteres </blockquote>';

		$this->load->view('include/header');
		$this->load->view('grupotrabalho/posteres-detalhes', $data);
		$this->load->view('include/footer');
	}

	public function cartaaceite($id)
	{
		//model
		$this->load->model('artigos_model', 'artigos');

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
						'situacao'		=> $this->input->post('situacao'),
						'parecer' 		=> $this->input->post('parecer')
					);

					$query = $this->artigos->alterar($data, $id);

					if($query === FALSE)
					{
						$data['titulo'] = '| Erro na operação';
						$data['msg'] = 'Erro ao registrar os dados. Tente novamente!';
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
					
					$this->load->model('artigos_model', 'artigos');

					$query = $this->artigos->alterar($data, $id);
					if($query === FALSE)
					{
						$data['titulo'] = '| Erro na operação';
						$data['msg'] = 'Parecer alterado com sucesso!';
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

//---------------- REMOÇÃO DO GRUPO DE TRABALHO TOTAL ----------------//

	public function removegt($gt)  
	{
		//model
		$this->load->model('grupotrabalho_model', 'grupotrabalho');
		
		$query = $this->grupotrabalho->excluir($gt);
		if($query === FALSE)
		{
			$data['titulo'] = '| Erro na operação';
			$data['msg'] 	= 'Erro ao remover o Grupo de Trabalho. Tente novamente!';
			$data['voltar'] = 'javascript:history.back(-1)';
	
			$this->load->view('include/header');
			$this->load->view('include/mensagem', $data);
			$this->load->view('include/footer');
		}
		else
		{
			$data['titulo'] = '| Sucesso na operação';
			$data['msg'] = 'Grupo de Trabalho removido com sucesso!';
			$data['voltar'] = base_url() . $this->uri->segment(1);
			
			$this->load->view('include/header');
			$this->load->view('include/mensagem', $data);
			$this->load->view('include/footer');
		}
	}

//---------------- REMOÇÃO DO GRUPO DE TRABALHO TOTAL ----------------//

	public function removeartigo($id)
	{
		//model
		$this->load->model('artigos_model', 'artigos');
		
		$arquivo = $this->artigos->excluir_arquivo($id);
		
		foreach ($arquivo as $arq)
		{
			$caminho = $arq->arquivo;
		}
		
		$path = './uploads/files/'.$caminho;
		
		$result = unlink($path);
		if($result)
		{
			$query = $this->artigos->excluir($id);
			if($query)
			{
				$data['titulo'] = '| Sucesso na operação';
				$data['msg'] = 'Artigo excluído com sucesso!';
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