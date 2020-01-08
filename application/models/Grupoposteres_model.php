<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Grupoposteres_model extends CI_Model {
	
	
	public function __construct()
	{
	
		parent::__construct();
	
	}
	
	//------------------------ FUNCOES SETORES ----------------------------- //
	
		public function cadastrar($data){
		
			$this->db->insert('grupo_posteres', $data);
		
			$query = $this->db->affected_rows();
		
			if($query){		//se retornar algum resultado
				return TRUE;
			}else{
				return FALSE;
			}
		
		}
		
		public function alterar($dados, $id){
		
			$this->db->where('id', $id);
			$this->db->update('grupo_posteres', $dados);
		
			$query = $this->db->affected_rows();
		
			if($query){//se retornar algum resultado
				return TRUE;
			}else{
				return FALSE;
			}
		
		}

		public function listagem(){

			$this->db->select("grupo_posteres.id, grupo_posteres.titulo, usuario.nome");
			$this->db->from('grupo_posteres');
			$this->db->join('usuario', 'grupo_posteres.Usuario_id = usuario.id');

			$this->db->order_by('grupo_posteres.titulo');

			$query = $this->db->get();
			
			return $query->result();

		}

		public function filtro_listagem($id)
		{

			$this->db->select("grupo_posteres.id, grupo_posteres.titulo, usuario.nome");
			$this->db->from('grupo_posteres');
			$this->db->join('usuario', 'grupo_posteres.Usuario_id = usuario.id');
			$this->db->order_by('grupo_posteres.titulo');
			$this->db->where('grupo_posteres.Usuario_id', $id);

			$query = $this->db->get();

			return $query->result();
		}
		
		public function listarGT($id)
		{
		
			$this->db->select("grupo_posteres.id AS gtID, grupo_posteres.titulo, usuario.nome, usuario.id");
			$this->db->from('grupo_posteres');
			$this->db->join('usuario', 'grupo_posteres.Usuario_id = usuario.id');

			$this->db->where('grupo_posteres.id', $id);

			$query = $this->db->get();
			
			return $query->result();
		
		}

		public function contaRegistros()
		{
			$this->db->select("*");
			$this->db->from('minicurso');
			$query = $this->db->get();
		
			return count($query->result());
		}
		
		public function retornaLista($maximo, $inicio)
		{
			$this->db->select("*");
			$this->db->from('minicurso');
			$this->db->order_by('tipo', 'ASC');
			$this->db->order_by('descricao', 'ASC');
			$this->db->limit($maximo, $inicio);
			$query = $this->db->get();
			return $query->result();
		}
		
		public function pesquisaNome($nome){
		
			$this->db->like('descricao', $nome);
			$this->db->or_like("sigla", $nome);
			$query = $this->db->get('minicurso');
		
			if($query->num_rows() > 0){
				foreach ($query->result_array() as $row){
					$row_set[] = stripslashes($row['descricao']); //build an array
						
					/* $new_row['id']			=	htmlentities(stripslashes($row['id_setor_externo']));
					 $new_row['descricao'] 	= 	htmlentities(stripslashes($row['descricao'])); //build an array
					$row_set[] = $new_row; */
				}
				echo json_encode($row_set); //format the array into json data
			}
		
		}
		
		public function excluir($id){
		
			$this->db->where('id', $id);
			$this->db->delete('grupo_posteres');
		
			$query = $this->db->affected_rows();
		
			if($query)//se retornar algum resultado
				return TRUE;
			else
				return FALSE;
		
		}
	
	//------------------------ FUNCOES SETORES ----------------------------- //


	//------------------------ FUNCOES DE INSCRIÇÃO ----------------------------- //
	
	public function listarInscritos($id)
	{

		$this->db->select('*, minicurso.id AS id_minicurso, usuario.id AS id_usuario');
		$this->db->from('usuario_has_minicurso');
		$this->db->join('usuario', 'usuario_has_minicurso.Usuario_id = usuario.id');
		$this->db->join('minicurso', 'usuario_has_minicurso.Minicurso_id = minicurso.id');
		$this->db->order_by('usuario.nome', 'ASC');

		$this->db->where('usuario_has_minicurso.Minicurso_id', $id);

		$query = $this->db->get();

		return $query->result();
	}

	public function inscrever($dados){
		
		$this->db->insert('usuario_has_minicurso', $dados);
	
		$query = $this->db->affected_rows();
	
		if($query){		//se retornar algum resultado
			return TRUE;
		}else{
			return FALSE;
		}
		
	}

	public function participacao($participante, $minicurso, $dados){
		
		$this->db->where('Minicurso_id', $minicurso);
		$this->db->where('Usuario_id', $participante);
		$this->db->update('usuario_has_minicurso', $dados);
	
		$query = $this->db->affected_rows();
	
		if($query){//se retornar algum resultado
			return TRUE;
		}else{
			return FALSE;
		}
		
	}

	public function removerInscricao($participante, $minicurso){

		$this->db->where('Minicurso_id', $minicurso);
		$this->db->where('Usuario_id', $participante);
		$this->db->delete('usuario_has_minicurso');

		$query = $this->db->affected_rows();
	
		if($query)//se retornar algum resultado
			return TRUE;
		else
			return FALSE;


	}	



	
	//------------------------ FUNCOES DE INSCRIÇÃO ----------------------------- //
		
}