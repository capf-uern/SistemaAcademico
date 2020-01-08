<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Oficinas_model extends CI_Model {
	
	
	public function __construct()
	{
	
		parent::__construct();
	
	}
	
	//------------------------ FUNCOES SETORES ----------------------------- //
	
		public function cadastrar($data){
		
			$this->db->insert('oficina', $data);
		
			$query = $this->db->affected_rows();
		
			if($query){		//se retornar algum resultado
				return TRUE;
			}else{
				return FALSE;
			}
		
		}
		
		public function alterar($dados, $id){
		
			$this->db->where('id', $id);
			$this->db->update('oficina', $dados);
		
			$query = $this->db->affected_rows();
		
			if($query){//se retornar algum resultado
				return TRUE;
			}else{
				return FALSE;
			}
		
		}

		public function listagem()
		{
		
			$this->db->select('*, oficina.id AS id_oficina');
			$this->db->from('oficina');
			$this->db->join('usuario', 'oficina.usuario_id = usuario.id');
			
			$this->db->order_by('oficina.titulo', 'ASC');
			
			$query = $this->db->get();
			
			return $query->result();

		}
		
		public function listar_unidade($id){

			$this->db->select('*, oficina.id AS id_oficina');
			$this->db->from('oficina');
			$this->db->join('usuario', 'oficina.usuario_id = usuario.id');
		
			$this->db->where('oficina.id', $id);

			$query = $this->db->get();
		
			return $query->result();
		
		}

	public function verificar_presenca($id){

		$this->db->select('*, oficina.id AS id_oficina, usuario.id AS id_usuario');
		$this->db->from('usuario_has_oficina');
		$this->db->join('usuario', 'usuario_has_oficina.Usuario_id = usuario.id');
		$this->db->join('oficina', 'usuario_has_oficina.Oficina_id = oficina.id');

		$this->db->where('usuario_has_oficina.Usuario_id', $id);
		$this->db->where('usuario_has_oficina.presente', '1');

		$query = $this->db->get();

		return $query->result();

	}
	
	public function contaRegistros()
	{
		$this->db->select("*");
		$this->db->from('oficina');
		$query = $this->db->get();

		return count($query->result());
	}

	public function retornaLista($maximo, $inicio)
	{
		$this->db->select("*");
		$this->db->from('oficina');
		$this->db->order_by('tipo', 'ASC');
		$this->db->order_by('descricao', 'ASC');
		$this->db->limit($maximo, $inicio);
		$query = $this->db->get();
		return $query->result();
	}

	public function pesquisaNome($nome){

		$this->db->like('descricao', $nome);
		$this->db->or_like("sigla", $nome);
		$query = $this->db->get('oficina');

		if($query->num_rows() > 0){
			foreach ($query->result_array() as $row){
				$row_set[] = stripslashes($row['descricao']); //constroi o array

			}
			echo json_encode($row_set); //configura o array no formato json
		}

	}
		
		public function excluir($id){
		
			$this->db->where('id', $id);
			$this->db->delete('oficina');
		
			$query = $this->db->affected_rows();
		
			if($query)//se retornar algum resultado
				return TRUE;
			else
				return FALSE;
		
		}

	public function certificado_ministrante($id){

		$this->db->select('*, oficina.id AS id_oficina, usuario.id AS id_usuario');
		$this->db->from('oficina');
		$this->db->join('usuario', 'oficina.Usuario_id = usuario.id');

		$this->db->where('oficina.Usuario_id', $id);

		$query = $this->db->get();

		return $query->result();

	}
	
	//------------------------ FUNCOES SETORES ----------------------------- //


	//------------------------ FUNCOES DE INSCRIÇÃO ----------------------------- //
	
	public function listarInscritos($id)
	{

		$this->db->select('*, oficina.id AS id_oficina, usuario.id AS id_usuario');
		$this->db->from('usuario_has_oficina');
		$this->db->join('usuario', 'usuario_has_oficina.Usuario_id = usuario.id');
		$this->db->join('oficina', 'usuario_has_oficina.oficina_id = oficina.id');
		$this->db->order_by('usuario.nome', 'ASC');

		$this->db->where('usuario_has_oficina.oficina_id', $id);

		$query = $this->db->get();

		return $query->result();
	}

	public function inscrever($dados){
		
		$this->db->insert('usuario_has_oficina', $dados);
	
		$query = $this->db->affected_rows();
	
		if($query){		//se retornar algum resultado
			return TRUE;
		}else{
			return FALSE;
		}
		
	}

	public function participacao($participante, $oficina, $dados){
		
		$this->db->where('Oficina_id', $oficina);
		$this->db->where('Usuario_id', $participante);
		$this->db->update('usuario_has_oficina', $dados);
	
		$query = $this->db->affected_rows();
	
		if($query){//se retornar algum resultado
			return TRUE;
		}else{
			return FALSE;
		}
		
	}

	public function removerInscricao($participante, $oficina){

		$this->db->where('Oficina_id', $oficina);
		$this->db->where('Usuario_id', $participante);
		$this->db->delete('usuario_has_oficina');

		$query = $this->db->affected_rows();
	
		if($query)//se retornar algum resultado
			return TRUE;
		else
			return FALSE;


	}	



	
	//------------------------ FUNCOES DE INSCRIÇÃO ----------------------------- //
		
}