<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario_model extends CI_Model {
	
	
	public function __construct()
	{
	
		parent::__construct();
	
	}
	
	//------------------------ FUNCOES DO USUARIO ----------------------------- //
	
		public function cadastrar($data){
		
			$this->db->insert('usuario', $data);
		
			$query = $this->db->affected_rows();
		
			if($query){		//se retornar algum resultado
				return TRUE;
			}else{
				return FALSE;
			}
		
		}

		public function alterar($dados, $id){
		
			$this->db->where('id', $id);
			$this->db->update('usuario', $dados);
		
			$query = $this->db->affected_rows();
		
			if($query){//se retornar algum resultado
				return TRUE;
			}else{
				return FALSE;
			}
		
		}
		
		public function verificar_cpf($cpf){
		
			$this->db->where('cpf', $cpf);
			$query = $this->db->get('usuario');
		
			return $query->result();
		
		
		}

		public function verificar_email($email){
		
			$this->db->where('email', $email);
			$query = $this->db->get('usuario');
		
			return $query->result();
		
		
		}
		
		public function listagem_geral(){
			
			$this->db->order_by('nome', 'ASC');
			
			$query = $this->db->get('usuario');
			
			return $query->result();
			
		}
		
		public function listagem($maximo, $inicio){
			
			$this->db->order_by('liberado', 'ASC');
			$this->db->order_by('nome', 'ASC');
			$this->db->limit($maximo, $inicio);
			
			$query = $this->db->get('usuario');
			
			return $query->result();
			
		}

		public function verificar_presenca($id){

			$this->db->where("id", $id);
			$this->db->where("presente", '1');

			$query = $this->db->get('usuario');

			return $query->result();

		}

		public function ultimos_registros($qtde){

			$this->db->order_by('id', 'DESC');
			$this->db->limit($qtde);

			$query = $this->db->get('usuario');

			return $query->result();

		}

		public function listagem_tipo($tipo){

			$this->db->where("tipo_cadastro", $tipo);
			$this->db->order_by('nome', 'ASC');

			$query = $this->db->get('usuario');

			return $query->result();

		}

		public function contagem_tipo($tipo){

			$this->db->where("tipo_cadastro", $tipo);

			$query = $this->db->get('usuario');

			return count($query->result());

		}
		
		public function pesquisar_filtro($numero, $dataentrada, $situacao, $descricao, $maximo, $inicio){
		
			
			if($numero != 0){
				$this->db->like('nome', $numero, 'both');
			}
			if($dataentrada != 0){
				$this->db->like('nome', $dataentrada, 'both');
			}
			if($situacao != 0){
				$this->db->where('nome', $situacao);
			}
			if($descricao != 0){
				$this->db->like('nome', $descricao);
			}
			$this->db->order_by('nome', 'ASC');
			$this->db->limit($maximo, $inicio);
				
			$query = $this->db->get('usuario');
			
			return $query->result();
		
		
		}
	
		public function listar_usuario($id)
		{
		
			$this->db->where('id', $id);
			$query = $this->db->get('usuario');
		
			return $query->result();
		
		}
		
		public function contaRegistros()
		{
			$this->db->select("*");
			$this->db->from('usuario');
			$query = $this->db->get();
		
			return count($query->result());
		}
		
		public function contaRegistros_filtro($campo)
		{
			$this->db->select("*");
			$this->db->from('usuario');
			$this->db->like('nome', $campo);
			$query = $this->db->get();
		
			return count($query->result());
		}
		
		public function retornaLista_filtro($campo, $maximo, $inicio)
		{
			$this->db->select("*");
			$this->db->from('usuario');
			$this->db->order_by('liberado', 'ASC');
			$this->db->order_by('nome', 'ASC');
			$this->db->like('nome', $campo);
			$this->db->limit($maximo, $inicio);
			$query = $this->db->get();
			return $query->result();
		}

		public function pesquisaNome(){
		
			$this->db->select("nome");
			$this->db->from('usuario');
			$this->db->order_by('nome', 'ASC');
			$this->db->where('tipo_cadastro', '1');
			$this->db->or_where('tipo_cadastro', '2');
			$this->db->or_where('tipo_cadastro', '3');
			$this->db->or_where('tipo_cadastro', '4');
			$query = $this->db->get();
			return $query->result();
			
		
		}

		public function pesquisaNomeArtigos($id){
		
			$this->db->select("nome");
			$this->db->from('usuario');
			$this->db->order_by('nome', 'ASC');
			$this->db->where('id !=', $id);
			$query = $this->db->get();
			return $query->result();
			
		
		}
		
	
	//------------------------ FUNCOES DE LISTAGEM -----------------------------//
	
		
	//------------------------ FUNCOES DE EXCLUSAO -----------------------------//
	
		
		public function excluir($id){
		
			$this->db->where('id', $id);
			$this->db->delete('usuario');
		
			$query = $this->db->affected_rows();
		
			if($query)//se retornar algum resultado
				return TRUE;
			else
				return FALSE;
		
		}
		
		
	//------------------------ FUNCOES DE EXCLUSAO -----------------------------//
	
	
}