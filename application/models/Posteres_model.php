<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Posteres_model extends CI_Model {
	
	
	public function __construct()
	{
	
		parent::__construct();
	
	}
	
	//------------------------ FUNCOES SETORES ----------------------------- //
	
		public function cadastrar($data){
		
			$this->db->insert('poster', $data);
		
			$query = $this->db->affected_rows();
		
			if($query){		//se retornar algum resultado
				return TRUE;
			}else{
				return FALSE;
			}
		
		}

		public function retornaID($data){

			$this->db->insert("poster", $data);
		    $recebe_id = $this->db->insert_id();
			return $recebe_id;

		}

		public function autores($poster, $usuario, $principal){

			$data = array(
				'poster_id'			=> $poster,
				'Usuario_id' 		=> $usuario,
				'autor_principal'	=> $principal,
			);

			$this->db->insert("poster_has_usuario", $data);
		    
		    $query = $this->db->affected_rows();
		
			if($query){		//se retornar algum resultado
				return TRUE;
			}else{
				return FALSE;
			}

		}

		public function alterar($dados, $id){
		
			$this->db->where('id', $id);
			$this->db->update('poster', $dados);
		
			$query = $this->db->affected_rows();
		
			if($query){//se retornar algum resultado
				return TRUE;
			}else{
				return FALSE;
			}
		
		}

		public function listagem()
		{
		
			$this->db->select("poster.id AS posterID, poster.titulo");
			$this->db->from('poster_has_usuario');
			$this->db->join('usuario', 'poster_has_usuario.Usuario_id = usuario.id');
			$this->db->join('poster', 'poster_has_usuario.poster_id = poster.id');
			

			$this->db->group_by('poster.id');

			$query = $this->db->get();
			
			return $query->result();

		}

		public function listagemAutor($id)
		{
		
			$this->db->select("poster.id AS posterID, poster.situacao, poster.parecer,
							   poster.titulo, poster.arquivo, poster.carta_aceite, usuario.nome");
			$this->db->from('poster_has_usuario');
			$this->db->join('usuario', 'poster_has_usuario.Usuario_id = usuario.id');
			$this->db->join('poster', 'poster_has_usuario.poster_id = poster.id');
			$this->db->where('poster_has_usuario.autor_principal', '1');
			$this->db->where('poster_has_usuario.Usuario_id', $id);

			$this->db->group_by('poster.id');

			$query = $this->db->get();
			
			return $query->result();

		}

		public function listagemCoAutor($id)
		{
		
			$this->db->select("poster.id AS posterID, poster.situacao, poster.parecer,
							   poster.titulo, poster.arquivo, usuario.nome");
			$this->db->from('poster_has_usuario');
			$this->db->join('usuario', 'poster_has_usuario.Usuario_id = usuario.id');
			$this->db->join('poster', 'poster_has_usuario.poster_id = poster.id');
			$this->db->where('poster_has_usuario.autor_principal', '0');
			$this->db->where('poster_has_usuario.Usuario_id', $id);

			$this->db->group_by('poster.id');

			$query = $this->db->get();
			
			return $query->result();

		}

		public function listagemAll(){

			$this->db->select("poster.id AS posterID, poster.titulo");
			$this->db->from('grupo_trabalho');
			$this->db->join('usuario', 'poster_has_usuario.Usuario_id = usuario.id');
			$this->db->join('poster', 'poster_has_usuario.poster_id = poster.id');
			

			$this->db->group_by('poster.id');

			$query = $this->db->get();
			
			return $query->result();


		}

		public function listar_posteresGT($id){

			$this->db->select("*, poster.id as posterID");
			$this->db->from('poster_has_usuario');
			$this->db->join('usuario', 'poster_has_usuario.Usuario_id = usuario.id');
			$this->db->join('poster', 'poster_has_usuario.poster_id = poster.id');

			$this->db->where('poster.Grupo_POsteres_id', $id);
			$this->db->where('poster_has_usuario.autor_principal', '1');
		
			$query = $this->db->get();
		
			return $query->result();
		
		}

		public function listar_unidade($id){

			$this->db->select('*, poster.id AS posterID, poster.titulo AS posterTitulo');
			$this->db->from('poster');
			$this->db->join('grupo_posteres', 'poster.Grupo_Posteres_id = grupo_posteres.id');
		
			$this->db->where('poster.id', $id);

			$query = $this->db->get();
		
			return $query->result();
		
		}
	
	
		public function contaRegistros()
		{
			$this->db->select("*");
			$this->db->from('poster');
			$query = $this->db->get();
		
			return count($query->result());
		}

	public function contagem_posteres()
	{
		$this->db->select("*");
		$this->db->from('grupo_posteres');
		$query = $this->db->get();

		return count($query->result());
	}
		
		public function retornaLista($maximo, $inicio)
		{
			$this->db->select("*");
			$this->db->from('poster');
			$this->db->order_by('tipo', 'ASC');
			$this->db->order_by('descricao', 'ASC');
			$this->db->limit($maximo, $inicio);
			$query = $this->db->get();
			return $query->result();
		}
		
		public function pesquisaNome($nome){
		
			$this->db->like('descricao', $nome);
			$this->db->or_like("sigla", $nome);
			$query = $this->db->get('poster');
		
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
			$this->db->delete('poster');
		
			$query = $this->db->affected_rows();
		
			if($query)//se retornar algum resultado
				return TRUE;
			else
				return FALSE;
		
		}

		public function excluir_arquivo($id){
		
			$this->db->where('id', $id);
			$query = $this->db->get('poster');
		
			return $query->result();
		
		}
	
	//------------------------ FUNCOES SETORES ----------------------------- //


	//------------------------ FUNCOES DE INSCRIÇÃO ----------------------------- //
	
	public function listarInscritos($id)
	{

		$this->db->select('*, poster.id AS id_poster, usuario.id AS id_usuario');
		$this->db->from('usuario_has_poster');
		$this->db->join('usuario', 'usuario_has_poster.Usuario_id = usuario.id');
		$this->db->join('poster', 'usuario_has_poster.poster_id = poster.id');
		$this->db->order_by('usuario.nome', 'ASC');

		$this->db->where('usuario_has_poster.poster_id', $id);

		$query = $this->db->get();

		return $query->result();
	}

	public function inscrever($dados){
		
		$this->db->insert('usuario_has_poster', $dados);
	
		$query = $this->db->affected_rows();
	
		if($query){		//se retornar algum resultado
			return TRUE;
		}else{
			return FALSE;
		}
		
	}

	public function participacao($participante, $poster, $dados){
		
		$this->db->where('poster_id', $poster);
		$this->db->where('Usuario_id', $participante);
		$this->db->update('usuario_has_poster', $dados);
	
		$query = $this->db->affected_rows();
	
		if($query){//se retornar algum resultado
			return TRUE;
		}else{
			return FALSE;
		}
		
	}

	public function removerInscricao($participante, $poster){

		$this->db->where('poster_id', $poster);
		$this->db->where('Usuario_id', $participante);
		$this->db->delete('usuario_has_poster');

		$query = $this->db->affected_rows();
	
		if($query)//se retornar algum resultado
			return TRUE;
		else
			return FALSE;


	}	



	
	//------------------------ FUNCOES DE INSCRIÇÃO ----------------------------- //
		
}