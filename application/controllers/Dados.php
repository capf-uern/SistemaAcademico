<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dados extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
			if(!$this->session->userdata('log_in'))
			{
				redirect(base_url(), 'refresh');
			}
	}

//------------------- FUNCOES DO USUARIO ----------------------------------//
	
	public function index()
	{
		//model
		$this->load->model('usuario_model', 'usuario');
		
		$data['listagem'] = $this->usuario->listar_usuario($this->session->userdata('id'));
	
		$data['titulo'] = 'Meus Dados';
		
		$this->load->view('include/header');
		$this->load->view('dados/index', $data);
		$this->load->view('include/footer');
	}

	public function atualizar()
	{
		//model
		$this->load->model('usuario_model', 'usuario');

		$id = $this->session->userdata('id');

		if($this->input->post('senha'))
		{
			$data = array(
				'nome' 				=> $this->input->post('nome_completo'),
				'ddd'				=> $this->input->post('telefone_ddd'),
				'telefone'			=> $this->input->post('telefone'),
				'senha'				=> md5($this->input->post('senha')),
				'area_interesse'	=> $this->input->post('interesse'),
				'instituicao'		=> $this->input->post('instituicao')
			);
		}
		else{
			$data = array(
				'nome' 				=> $this->input->post('nome_completo'),
				'ddd'				=> $this->input->post('telefone_ddd'),
				'telefone'			=> $this->input->post('telefone'),
				'area_interesse'	=> $this->input->post('interesse'),
				'instituicao'		=> $this->input->post('instituicao')
			);
		}

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
			$data['msg'] = 'Dados alterados com sucesso!';
			$data['voltar'] = base_url('painel');

			$this->load->view('include/header');
			$this->load->view('include/mensagem', $data);
			$this->load->view('include/footer');
		}
	}

	public function editar($id)
	{
		//model
		$this->load->model('usuario_model', 'usuario');
		
		$data['listagem'] = $this->usuario->listar_usuario($id);
	
		$data['titulo'] = '<blockquote>Participantes  |  Editar Dados</blockquote>';
		
		$this->load->view('include/header');
		$this->load->view('dados/edicao', $data);
		$this->load->view('include/footer');
	}

	public function editado($id)
	{
		//model
		$this->load->model('usuario_model', 'usuario');

		//TODO verificar melhorias no codigo abaixo
		switch ($this->input->post('opcao')) {
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

		if($submissao != '1'){

			$submissao = '0';

		}

		$administrador = $this->input->post('administrador');

		if($administrador != '1'){

			$administrador = '0';

		}

		$data = array(
				'cpf'				=> $this->input->post('cpf'),
				'nome' 				=> $this->input->post('nome_completo'),
				'ddd'				=> $this->input->post('telefone_ddd'),
				'telefone'			=> $this->input->post('telefone'),
				'email'				=> $this->input->post('email'),
				'area_interesse'	=> $this->input->post('interesse'),
				'instituicao'		=> $this->input->post('instituicao'),
				'tipo_cadastro'		=> $this->input->post('opcao'),
				'status'			=> $administrador,
				'profissao'			=> $profissao,
				'com_apresentacao'	=> $submissao
		);

		$query = $this->usuario->alterar($data, $id);
	
		if($query === FALSE){
				
			$data['titulo'] = '| Erro na operação';
			$data['msg'] = 'Erro ao atualizar os dados. Tente novamente!';
			$data['voltar'] = 'javascript:history.back(-1)';
	
			$this->load->view('include/header');
			$this->load->view('include/mensagem', $data);
			$this->load->view('include/footer');
				
		}else{
			
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
		$this->load->model('usuario_model', 'usuario');
	
		$maximo = 20;
	
		if ($this->uri->segment(3) == "")
		{
			$inicio = 0;
		}
		else
		{
			$inicio = $this->uri->segment(3);
		}
	
		// PAGINATION
		$this->load->library('pagination');
	
		$num_rows = $this->usuario->contaRegistros();
	
		$config['base_url'] = site_url() . 'dados/listagem/';
		$config['per_page'] = $maximo;
		$config['total_rows'] = $num_rows;
		$config['uri_segment'] = 3;
		$config['num_links'] = 5;
	
		$config['prev_link'] = false;
		$config['next_link'] = false;
		$config['first_link'] = '<span class="btn black-text blue-grey lighten-4"> Primeiro';
		$config['last_link'] = '<span class="btn black-text blue-grey lighten-4"> Último ';
	
		$config['cur_tag_open'] = '<span class="btn blue-grey"> ';
		$config['cur_tag_close'] = ' </span>';
			
		$config['num_tag_open'] = '<span class="btn white-text blue-grey lighten-4"> ';
		$config['num_tag_close'] = ' </span>';
	
		$config['prev_link'] = '<i class="fa fa-angle-double-left"></i>';
		$config['prev_tag_open'] = '<span class="btn blue-grey lighten-4">';
		$config['prev_tag_close'] = '</span>';
	
		$config['next_link'] = '<i class="fa fa-angle-double-right"	></i>';
		$config['next_tag_open'] = '<span class="btn blue-grey lighten-4">';
		$config['next_tag_close'] = '</span>';
	
		$config['full_tag_open'] = '<div class="center">'; // Tag que vai ficar em volta da Paginação toda.
		$config['full_tag_close'] = '</div>'; // Fechamento da Tag.
	
		$this->pagination->initialize($config);
		$data['paginacao'] = $this->pagination->create_links();
			
		$data['listagem'] = $this->usuario->listagem($maximo, $inicio);
			
		$data['titulo'] = '<blockquote>Participantes  |  Listagem simplificada</blockquote>';
		
		$this->load->view('include/header');
		$this->load->view('dados/listagem', $data);
		$this->load->view('include/footer');
	}
	
	public function visualizar($id)
	{
		//model
		$this->load->model('protocolo_model', 'protocolo');
		$this->load->model('movimentacao_model', 'movimentacao');
	
		$data['listagem'] 	= $this->protocolo->protocolo_unidade($id);
		$data['tramite']	= $this->protocolo->protocolo_tramite($id);
		$data['acesso']		= $this->protocolo->tramite_permissao_geral($id);
		$data['cancelar']	= $this->protocolo->tramite_permissao_cancelar($id);
		$data['situacao']	= $this->protocolo->tramite_permissao_situacao($id);
		$data['movimento'] 	= $this->movimentacao->listar_ultimas(1, $id);
	
		$data['tipo_pagina'] = '';
	
		$this->load->view('include/header');
		$this->load->view('include/menu_protocolo', $data);
		$this->load->view('protocolo/visualiza', $data);
		$this->load->view('include/footer');
	}
	
	public function pesquisar()
	{
		//model
		$this->load->model('usuario_model', 'usuario');
		
		$pesquisa = $this->input->post('pesquisar');
		
		$maximo = 20;
		
		if ($this->uri->segment(3) == "")
		{
			$inicio = 0;
		}
		else
		{
			$inicio = $this->uri->segment(3);
		}
		
		//PAGINATION
		$this->load->library('pagination');
		
		$num_rows = $this->usuario->contaRegistros_filtro($pesquisa);
		
		$config['base_url'] = site_url() . 'dados/pesquisar/';
		$config['per_page'] = $maximo;
		$config['total_rows'] = $num_rows;
		$config['uri_segment'] = 3;
		$config['num_links'] = 5;
		
		$config['prev_link'] = false; // Como não quero que exiba o prev_link, inicio ele como false.
		$config['next_link'] = false; // Como não quero que exiba o next_link, inicio ele como false.
		$config['last_link'] = '<span class="btn blue-grey lighten-4"> Último ';
		$config['first_link'] = '<span class="btn blue-grey lighten-4"> Primeiro';
	
		$config['cur_tag_open'] = '<span class="btn blue-grey"> ';
		$config['cur_tag_close'] = ' </span>';
			
		$config['num_tag_open'] = '<span class="btn white-text blue-grey lighten-4"> ';
		$config['num_tag_close'] = ' </span>';
	
		$config['prev_link'] = '<i class="fa fa-angle-double-left"></i>';
		$config['prev_tag_open'] = '<span class="btn blue-grey lighten-4">';
		$config['prev_tag_close'] = '</span>';
	
		$config['next_link'] = '<i class="fa fa-angle-double-right"	></i>';
		$config['next_tag_open'] = '<span class="btn blue-grey lighten-4">';
		$config['next_tag_close'] = '</span>';
	
		$config['full_tag_open'] = '<div class="center">'; // Tag que vai ficar em volta da Paginação toda.
		$config['full_tag_close'] = '</div>'; // Fechamento da Tag.
		
		$this->pagination->initialize($config);
		$data['paginacao'] = $this->pagination->create_links();
			
		$data['listagem'] = $this->usuario->retornaLista_filtro($pesquisa, $maximo, $inicio);
			
		$data['titulo'] = '<blockquote>Participantes  |  Resultado da Pesquisa</blockquote>';
		
		$this->load->view('include/header');
		$this->load->view('dados/listagem', $data);
		$this->load->view('include/footer');
	}

	public function liberar($id)
	{
		//MODEL
		$this->load->model('usuario_model', 'usuario');

		$data = array(
			'liberado'			=> '1'
		);

		$query = $this->usuario->alterar($data, $id);
			
		if($query === FALSE)
		{
			$data['titulo'] = '| Erro na operação';
			$data['msg'] = 'Cadastro já liberado no sistema.';
			$data['voltar'] = 'javascript:history.back(-1)';
	
			$this->load->view('include/header');
			$this->load->view('include/mensagem', $data);
			$this->load->view('include/footer');
		}
		else{
			$envEmail = $this->listagem->emailParticipante($id);

			$this->load->library('email');

			$this->email->from('notify@semanauniversitariacameam.com.br', 'Notificação - Semana Universitária');
			$this->email->to($envEmail);

			$this->email->subject('Notificação XVII Semana Universitária - Cadastro liberado');
			$this->email->message('Notificação automática - Informamos que após confirmação de pagamento, o seu cadastro encontra-se liberado para realizar inscrições nas oficinas, minicursos e demais atividades. ');

			$this->email->send();
				
			$data['titulo'] = '| Sucesso na operação';
			$data['msg'] = 'Cadastro liberado com sucesso!';
			$data['voltar'] = base_url() . $this->uri->segment(1) . '/listagem';
	
			$this->load->view('include/header');
			$this->load->view('include/mensagem', $data);
			$this->load->view('include/footer');
		}
	}

	public function presente($id)
	{
		//model
		$this->load->model('usuario_model', 'usuario');

		$data = array(
			'presente'			=> '1'
		);

		$query = $this->usuario->alterar($data, $id);

		if($query === FALSE)
		{
			$data['titulo'] = '| Erro na operação';
			$data['msg'] = 'Presença no evento já liberada no sistema.';
			$data['voltar'] = 'javascript:history.back(-1)';

			$this->load->view('include/header');
			$this->load->view('include/mensagem', $data);
			$this->load->view('include/footer');
		}
		else{
			$data['titulo'] = '| Sucesso na operação';
			$data['msg'] = 'Presença no evento confirmada com sucesso!';
			$data['voltar'] = base_url() . $this->uri->segment(1) . '/listagem';

			$this->load->view('include/header');
			$this->load->view('include/mensagem', $data);
			$this->load->view('include/footer');
		}
	}
	
	public function resetar($id)
	{
		//model
		$this->load->model('usuario_model', 'usuario');
					
		if($this->session->userdata('id') != $id){

			$data = array(
				'senha'				=> md5('senha123')
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
				$data['msg'] = 'Dados alterados com sucesso!';
				$data['voltar'] = base_url() . $this->uri->segment(1) . '/listagem';
		
				$this->load->view('include/header');
				$this->load->view('include/mensagem', $data);
				$this->load->view('include/footer');
			}
		}
		else{
			$data['titulo'] = '| Erro na operação';
			$data['msg'] = 'Não é possível alterar senha do atual operador!';
			$data['voltar'] = 'javascript:history.back(-1)';
	
			$this->load->view('include/header');
			$this->load->view('include/mensagem', $data);
			$this->load->view('include/footer');
		}
	}

	public function excluir($id)
	{
		//model
		$this->load->model('usuario_model', 'usuario');
		
		if($this->session->userdata('id') != $id)
		{
			$query = $this->usuario->excluir($id);
				
			if($query === FALSE)
			{
				$data['titulo'] = '| Erro na operação';
				$data['msg'] 	= 'Erro ao excluir os dados. Tente novamente!';
				$data['voltar'] = 'javascript:history.back(-1)';
		
				$this->load->view('include/header');
				$this->load->view('include/mensagem', $data);
				$this->load->view('include/footer');
			}
			else{
				$data['titulo'] = '| Sucesso na operação';
				$data['msg'] = 'Dados excluídos com sucesso!';
				$data['voltar'] = base_url() . $this->uri->segment(1) . '/listagem';
		
				$this->load->view('include/header');
				$this->load->view('include/mensagem', $data);
				$this->load->view('include/footer');
			}
		}
		else{
			$data['titulo'] = '| Erro na operação';
			$data['msg'] = 'Não é possível excluir o operador conectado!';
			$data['voltar'] = 'javascript:history.back(-1)';
	
			$this->load->view('include/header');
			$this->load->view('include/mensagem', $data);
			$this->load->view('include/footer');
		}
	}

//------------------- FUNCOES DO USUARIO ----------------------------------//

//------------------- FUNCOES DO AJAX ----------------------------------//
	
	function get_externo()
	{
		$this->load->model('setores_model', 'setores');

		if(isset($_GET['term']))
		{
			$q = strtolower($_GET['term']);
			$this->setores->pesquisaNome($q);
		}
	}

	public function externo_informacoes($dado1)
	{
		//TODO verificar uso dessa function par futura atualizacao
		$dado1 = $this->input->post('busca');

		$this->db->where("descricao", $dado1);
		$this->db->or_where("sigla", $dado1);
		$verifica = $this->db->get('cad_setores');
		$verifica->result();

		if(count($verifica->result())>0)
		{
			foreach($verifica->result() as $lista)
			{
				$arr = array(
						'id_externo'		=> $lista->id,
						'descricao'			=> $lista->descricao
				);

				echo json_encode($arr);
			}
		}
		else{
			echo '1';
		}
	}
}