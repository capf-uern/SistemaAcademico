<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Minicursos extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		if(!$this->session->userdata('log_in'))
		{
			redirect(base_url(), 'refresh');
		}
	}

//------------------- FUNCOES DOS MINICURSOS ----------------------------------//
	
	public function index()
	{
		//model
		$this->load->model('minicursos_model', 'minicursos');
	
		$data['listagem'] 	= $this->minicursos->listagem();
		$data['titulo'] 	= '<blockquote>Minicursos  |  Listagem</blockquote>';
		
		$this->load->view('include/header');
		$this->load->view('minicursos/visualizar', $data);
		$this->load->view('include/footer');
	}

	public function cadastro()
	{
		//model
		$this->load->model('usuario_model', 'usuario');

		$data['nomes'] 	= $this->usuario->pesquisaNome();
		$data['titulo'] = '<blockquote>Minicursos  |  Cadastrar Evento</blockquote>';
		
		$this->load->view('include/header');
		$this->load->view('minicursos/cadastro', $data);
		$this->load->view('include/footer');
	}

	public function cadastrar()
	{
		//model
		$this->load->model('minicursos_model', 'minicursos');

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

		$query = $this->minicursos->cadastrar($data);
		if($query == FALSE)
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
			$data['msg'] = 'Minicurso cadastrado com sucesso!';
			$data['voltar'] = base_url() . $this->uri->segment(1) . '/listagem';

			$this->load->view('include/header');
			$this->load->view('include/mensagem', $data);
			$this->load->view('include/footer');
		}
	}

	public function listar($id)
	{
		//model
		$this->load->model('minicursos_model', 'minicursos');
	
		$data['listagem'] 	= $this->minicursos->listarInscritos($id);
		$data['curso'] 		= $this->minicursos->listar_unidade($id);
		$data['titulo'] 	= '<blockquote>Minicursos  |  Lista de Inscritos</blockquote>';
	
		$this->load->view('include/header');
		$this->load->view('minicursos/inscritos', $data);
		$this->load->view('include/footer');
	}

	public function editar($id)
	{
		//model
		$this->load->model('minicursos_model', 'minicursos');
		$this->load->model('usuario_model', 'usuario');

		$data['nomes'] 		= $this->usuario->pesquisaNome();
		$data['listagem'] 	= $this->minicursos->listar_unidade($id);
		$data['titulo'] 	= '<blockquote>Minicursos  |  Editar Dados</blockquote>';
		
		$this->load->view('include/header');
		$this->load->view('minicursos/edicao', $data);
		$this->load->view('include/footer');
	}

	public function editado($id)
	{
		//model
		$this->load->model('minicursos_model', 'minicursos');

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

		$query = $this->minicursos->alterar($data, $id);
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

	public function listagem()
	{
		//model
		$this->load->model('minicursos_model', 'minicursos');
	
		$data['listagem'] 	= $this->minicursos->listagem();
		$data['titulo'] 	= '<blockquote>Minicursos  |  Listagem</blockquote>';
	
		$this->load->view('include/header');
		$this->load->view('minicursos/listagem', $data);
		$this->load->view('include/footer');
	}
	
	public function detalhes($id)
	{
		//model
		$this->load->model('minicursos_model', 'minicursos');
		
		$data['listagem'] 	= $this->minicursos->listar_unidade($id);
		$data['titulo'] 	= '<blockquote>Minicursos  |  Informações Gerais</blockquote>';
		
		$this->load->view('include/header');
		$this->load->view('minicursos/detalhes', $data);
		$this->load->view('include/footer');
	}

	public function inscrever($minicurso)
	{
		//model
		$this->load->model('minicursos_model', 'minicursos');

		$data = array(
			'Usuario_id'	=> $this->session->userdata('id'),
			'Minicurso_id'	=> $minicurso
		);

		$query = $this->minicursos->inscrever($data);
		if($query === FALSE)
		{
			$data['titulo'] = '| Erro na operação';
			$data['msg'] = 'Erro ao realizar a inscrição. Tente novamente!';
			$data['voltar'] = 'javascript:history.back(-1)';
	
			$this->load->view('include/header');
			$this->load->view('include/mensagem', $data);
			$this->load->view('include/footer');
		}
		else
		{
			$data['titulo'] = '| Sucesso na operação';
			$data['msg'] = 'Inscrição realizada com sucesso!';
			$data['voltar'] = base_url() . $this->uri->segment(1);
	
			$this->load->view('include/header');
			$this->load->view('include/mensagem', $data);
			$this->load->view('include/footer');
		}
	}

	public function presente($participante, $minicurso)
	{
		//model
		$this->load->model('minicursos_model', 'minicursos');

		$data = array(
			'presente'				=> '1'
		);

		$query = $this->minicursos->participacao($participante, $minicurso, $data);
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
		$this->load->model('minicursos_model', 'minicursos');
		
		$query = $this->minicursos->removerInscricao($participante, $minicurso);
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

	public function removerInscricao($minicurso)
	{
		//model
		$this->load->model('minicursos_model', 'minicursos');
		
		$query = $this->minicursos->removerInscricao($this->session->userdata('id'), $minicurso);
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
		$this->load->model('minicursos_model', 'minicursos');
		
		$query = $this->minicursos->excluir($id);
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
			$data['msg'] = 'Minicurso excluído com sucesso!';
			$data['voltar'] = base_url() . $this->uri->segment(1) . '/listagem';
	
			$this->load->view('include/header');
			$this->load->view('include/mensagem', $data);
			$this->load->view('include/footer');
		}
	}

//------------------- FUNCOES DOS MINICURSOS ----------------------------------//

//------------------- FUNCOES DO AJAX ----------------------------------//
	
	public function get_externo()
	{
		//model
		$this->load->model('usuario_model', 'usuario');

		$this->usuario->pesquisaNome();

		foreach($this->usuario->pesquisaNome() as $lista)
		{
			$arr = array(
					'nome'		=> $lista->nome
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