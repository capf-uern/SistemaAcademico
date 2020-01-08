<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Oficinas extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		
		if(!$this->session->userdata('log_in'))
		{
			redirect(base_url(), 'refresh');
		}
	}

//------------------- FUNCOES DAS OFICINAS ----------------------------------//
	
	public function index()
	{
		//model
		$this->load->model('oficinas_model', 'oficinas');
	
		$data['listagem'] 	= $this->oficinas->listagem();
		$data['titulo'] 	= '<blockquote>Oficinas  |  Listagem</blockquote>';
		
		$this->load->view('include/header');
		$this->load->view('oficinas/visualizar', $data);
		$this->load->view('include/footer');
	}

	public function cadastro()
	{
		//model
		$this->load->model('usuario_model', 'usuario');

		$data['nomes'] 	= $this->usuario->pesquisaNome();
		$data['titulo'] = '<blockquote>Oficinas  |  Cadastrar Evento</blockquote>';
		
		$this->load->view('include/header');
		$this->load->view('oficinas/cadastro', $data);
		$this->load->view('include/footer');
	}

	public function cadastrar()
	{
		//model
		$this->load->model('oficinas_model', 'oficinas');

		$data = array(
			'titulo'				=> $this->input->post('titulo'),
			'descricao'				=> $this->input->post('descricao'),
			'data'					=> dataetempo_inverso($this->input->post('data')),
			'local'					=> $this->input->post('local'),
			'carga_horaria'			=> $this->input->post('carga_horaria'),
			'vagas'					=> $this->input->post('vagas'),
			'usuario_id_curriculo'	=> $this->input->post('curriculo'),
			'usuario_id'			=> $this->input->post('ministrante_cod')
		);

		$query = $this->oficinas->cadastrar($data);
		if($query == FALSE)
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
			$data['msg'] = 'Oficina cadastrada com sucesso!';
			$data['voltar'] = base_url() . $this->uri->segment(1) . '/listagem';

			$this->load->view('include/header');
			$this->load->view('include/mensagem', $data);
			$this->load->view('include/footer');
		}
	}

	public function listar($id)
	{
		//model
		$this->load->model('oficinas_model', 'oficinas');
	
		$data['listagem'] 	= $this->oficinas->listarInscritos($id);
		$data['curso'] 		= $this->oficinas->listar_unidade($id);
		$data['titulo'] 	= '<blockquote>Oficinas  |  Lista de Inscritos</blockquote>';
	
		$this->load->view('include/header');
		$this->load->view('oficinas/inscritos', $data);
		$this->load->view('include/footer');
	}

	public function editar($id)
	{
		//model
		$this->load->model('oficinas_model', 'oficinas');
		$this->load->model('usuario_model', 'usuario');

		$data['nomes'] 		= $this->usuario->pesquisaNome();
		$data['listagem'] 	= $this->oficinas->listar_unidade($id);
		$data['titulo'] 	= '<blockquote>Oficinas  |  Editar Dados</blockquote>';
		
		$this->load->view('include/header');
		$this->load->view('oficinas/edicao', $data);
		$this->load->view('include/footer');
	}

	public function editado($id)
	{
		//model
		$this->load->model('oficinas_model', 'oficinas');

		$data = array(
			'titulo'				=> $this->input->post('titulo'),
			'descricao'				=> $this->input->post('descricao'),
			'data'					=> dataetempo_inverso($this->input->post('data')),
			'local'					=> $this->input->post('local'),
			'carga_horaria'			=> $this->input->post('carga_horaria'),
			'vagas'					=> $this->input->post('vagas'),
			'usuario_id_curriculo'	=> $this->input->post('curriculo'),
			'usuario_id'			=> $this->input->post('ministrante_cod')
		);

		$query = $this->oficinas->alterar($data, $id);
		if($query === FALSE)
		{
			$data['titulo'] = '| Erro na operação';
			$data['msg'] = 'Erro ao atualizar os dados. Tente novamente!';
			$data['voltar'] = 'javascript:history.back(-1)';
	
			$this->load->view('include/header');
			$this->load->view('include/mensagem', $data);
			$this->load->view('include/footer');
		}else
		{
			$data['titulo'] = '| Sucesso na operação';
			$data['msg'] = 'Dados da oficina alterados com sucesso!';
			$data['voltar'] = base_url() . $this->uri->segment(1) . '/listagem';
	
			$this->load->view('include/header');
			$this->load->view('include/mensagem', $data);
			$this->load->view('include/footer');
		}
	}

	public function listagem()
	{
		//model
		$this->load->model('oficinas_model', 'oficinas');
	
		$data['listagem'] 	= $this->oficinas->listagem();
		$data['titulo'] 	= '<blockquote>Oficinas  |  Listagem</blockquote>';
	
		$this->load->view('include/header');
		$this->load->view('oficinas/listagem', $data);
		$this->load->view('include/footer');
	}
	
	public function detalhes($id)
	{
		//model
		$this->load->model('oficinas_model', 'oficinas');
		
		$data['listagem'] 	= $this->oficinas->listar_unidade($id);
		$data['titulo'] 	= '<blockquote>Oficinas  |  Informações Gerais</blockquote>';
		
		$this->load->view('include/header');
		$this->load->view('oficinas/detalhes', $data);
		$this->load->view('include/footer');
	}

	public function inscrever($oficina)
	{
		//model
		$this->load->model('oficinas_model', 'oficinas');

		$data = array(
			'Usuario_id'	=> $this->session->userdata('id'),
			'Oficina_id'	=> $oficina
		);

		$query = $this->oficinas->inscrever($data);
		if($query === FALSE)
		{
			$data['titulo'] = '| Erro na operação';
			$data['msg'] 	= 'Erro ao realizar a inscrição. Tente novamente!';
			$data['voltar'] = 'javascript:history.back(-1)';
	
			$this->load->view('include/header');
			$this->load->view('include/mensagem', $data);
			$this->load->view('include/footer');
		}
		else
		{
			$data['titulo'] = '| Sucesso na operação';
			$data['msg'] 	= 'Inscrição realizada com sucesso!';
			$data['voltar'] = base_url() . $this->uri->segment(1);
	
			$this->load->view('include/header');
			$this->load->view('include/mensagem', $data);
			$this->load->view('include/footer');
		}
	}

	public function presente($participante, $oficina)
	{
		//model
		$this->load->model('oficinas_model', 'oficinas');

		$data = array(
			'presente'	=> '1'
		);

		$query = $this->oficinas->participacao($participante, $oficina, $data);
		if($query === FALSE)
		{
			$data['titulo'] = '| Erro na operação';
			$data['msg'] 	= 'Erro ao atualizar os dados. Tente novamente!';
			$data['voltar'] = 'javascript:history.back(-1)';
	
			$this->load->view('include/header');
			$this->load->view('include/mensagem', $data);
			$this->load->view('include/footer');
		}
		else
		{
			$data['titulo'] = '| Sucesso na operação';
			$data['msg'] 	= 'Participante registrado com sucesso!';
			$data['voltar'] = base_url() . $this->uri->segment(1) . '/listar/' . $oficina;
	
			$this->load->view('include/header');
			$this->load->view('include/mensagem', $data);
			$this->load->view('include/footer');
		}
	}
	
	public function removeInscricao($participante, $oficina)
	{
		//model
		$this->load->model('oficinas_model', 'oficinas');
		
		$query = $this->oficinas->removerInscricao($participante, $oficina);
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
			$data['msg'] 	= 'Inscrição removida com sucesso!';
			$data['voltar'] = base_url() . $this->uri->segment(1) . '/listar/' . $oficina;
	
			$this->load->view('include/header');
			$this->load->view('include/mensagem', $data);
			$this->load->view('include/footer');
		}
	}

	public function removerInscricao($oficina)
	{
		//model
		$this->load->model('oficinas_model', 'oficinas');
		
		$query = $this->oficinas->removerInscricao($this->session->userdata('id'), $oficina);
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
			$data['voltar'] = base_url() . $this->uri->segment(1);
	
			$this->load->view('include/header');
			$this->load->view('include/mensagem', $data);
			$this->load->view('include/footer');
		}
	}

	public function excluir($id)
	{
		//model
		$this->load->model('oficinas_model', 'oficinas');
		
		$query = $this->oficinas->excluir($id);
		if($query === FALSE)
		{
			$data['titulo'] = '| Erro na operação';
			$data['msg'] 	= 'Erro ao excluir os dados. Tente novamente!';
			$data['voltar'] = 'javascript:history.back(-1)';
	
			$this->load->view('include/header');
			$this->load->view('include/mensagem', $data);
			$this->load->view('include/footer');
		}
		else
		{
			$data['titulo'] = '| Sucesso na operação';
			$data['msg'] = 'Oficina excluída com sucesso!';
			$data['voltar'] = base_url() . $this->uri->segment(1) . '/listagem';
	
			$this->load->view('include/header');
			$this->load->view('include/mensagem', $data);
			$this->load->view('include/footer');
		}
	}

//------------------- FUNCOES DAS OFICINAS ----------------------------------//

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