<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Minicursos_model extends CI_Model {
	
	
	public function __construct()
	{
	
		parent::__construct();
	
	}
	
	//------------------------ FUNCOES SETORES ----------------------------- //
	
		public function cadastrar($data){
		
			$this->db->insert('minicurso', $data);
		
			$query = $this->db->affected_rows();
		
			if($query){		//se retornar algum resultado
				return TRUE;
			}else{
				return FALSE;
			}
		
		}
		
		public function alterar($dados, $id){
		
			$this->db->where('id', $id);
			$this->db->update('minicurso', $dados);
		
			$query = $this->db->affected_rows();
		
			if($query){//se retornar algum resultado
				return TRUE;
			}else{
				return FALSE;
			}
		
		}

		public function listagem()
		{
		
			$this->db->select('*, minicurso.id AS id_minicurso');
			$this->db->from('minicurso');
			$this->db->join('usuario', 'minicurso.usuario_id = usuario.id');
			
			$this->db->order_by('minicurso.titulo', 'ASC');
			
			$query = $this->db->get();
			
			return $query->result();

		}
		
		public function listar_unidade($id){

			$this->db->select('*, minicurso.id AS id_minicurso');
			$this->db->from('minicurso');
			$this->db->join('usuario', 'minicurso.usuario_id = usuario.id');
		
			$this->db->where('minicurso.id', $id);

			$query = $this->db->get();
		
			return $query->result();
		
		}

		public function verificar_presenca($id){

			$this->db->select('*, minicurso.id AS id_minicurso, usuario.id AS id_usuario');
			$this->db->from('usuario_has_minicurso');
			$this->db->join('usuario', 'usuario_has_minicurso.Usuario_id = usuario.id');
			$this->db->join('minicurso', 'usuario_has_minicurso.Minicurso_id = minicurso.id');

			$this->db->where('usuario_has_minicurso.Usuario_id', $id);
			$this->db->where('usuario_has_minicurso.presente', '1');

			$query = $this->db->get();

			return $query->result();

		}
	
		public function listar_ultimas($quantidade)
		{
		
			$this->db->order_by('id', 'DESC');
			$this->db->limit($quantidade);
		
			$query = $this->db->get('minicurso');
		
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
			$this->db->delete('minicurso');
		
			$query = $this->db->affected_rows();
		
			if($query)//se retornar algum resultado
				return TRUE;
			else
				return FALSE;
		
		}

	public function certificado_ministrante($id){

		$this->db->select('*, minicurso.id AS id_minicurso, usuario.id AS id_usuario');
		$this->db->from('minicurso');
		$this->db->join('usuario', 'minicurso.Usuario_id = usuario.id');

		$this->db->where('minicurso.Usuario_id', $id);

		$query = $this->db->get();

		return $query->result();

	}
	
	//------------------------ FUNCOES SETORES ----------------------------- //


	//------------------------ FUNCOES DE INSCRIÇÃO ----------------------------- //
	
	public function listarInscritos($id)
	{

		$this->db->select('*, usuario_has_minicurso.presente, minicurso.id AS id_minicurso, usuario.id AS id_usuario');
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