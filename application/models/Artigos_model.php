<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Artigos_model extends CI_Model {
	
	
	public function __construct()
	{
	
		parent::__construct();
	
	}
	
	//------------------------ FUNCOES SETORES ----------------------------- //
	
		public function cadastrar($data){
		
			$this->db->insert('artigo', $data);
		
			$query = $this->db->affected_rows();
		
			if($query){		//se retornar algum resultado
				return TRUE;
			}else{
				return FALSE;
			}
		
		}

		public function retornaID($data){

			$this->db->insert("artigo", $data);
		    $recebe_id = $this->db->insert_id();
			return $recebe_id;

		}

		public function autores($artigo, $usuario, $principal){

			$data = array(
				'Artigo_id'			=> $artigo,
				'Usuario_id' 		=> $usuario,
				'autor_principal'	=> $principal,
			);

			$this->db->insert("artigo_has_usuario", $data);
		    
		    $query = $this->db->affected_rows();
		
			if($query){		//se retornar algum resultado
				return TRUE;
			}else{
				return FALSE;
			}

		}

		public function alterar($dados, $id){
		
			$this->db->where('id', $id);
			$this->db->update('artigo', $dados);
		
			$query = $this->db->affected_rows();
		
			if($query){//se retornar algum resultado
				return TRUE;
			}else{
				return FALSE;
			}
		
		}

		public function alterar_certificado($dados, $id){

			$this->db->where('Artigo_id', $id);
			$this->db->update('artigo_has_usuario', $dados);

			$query = $this->db->affected_rows();

			if($query){//se retornar algum resultado
				return TRUE;
			}else{
				return FALSE;
			}

		}

		public function listagem()
		{
		
			$this->db->select("artigo.id AS artigoID, artigo.titulo");
			$this->db->from('artigo_has_usuario');
			$this->db->join('usuario', 'artigo_has_usuario.Usuario_id = usuario.id');
			$this->db->join('artigo', 'artigo_has_usuario.artigo_id = artigo.id');
			

			$this->db->group_by('artigo.id');

			$query = $this->db->get();
			
			return $query->result();

		}

		public function listagemAutor($id)
		{
		
			$this->db->select("artigo.id AS artigoID, artigo.situacao, artigo.parecer,
							   artigo.titulo, artigo.arquivo, artigo.Grupo_Trabalho_id AS gtID, artigo.carta_aceite, usuario.nome");
			$this->db->from('artigo_has_usuario');
			$this->db->join('usuario', 'artigo_has_usuario.Usuario_id = usuario.id');
			$this->db->join('artigo', 'artigo_has_usuario.artigo_id = artigo.id');
			$this->db->where('artigo_has_usuario.autor_principal', '1');
			$this->db->where('artigo_has_usuario.Usuario_id', $id);

			$this->db->group_by('artigo.id');

			$query = $this->db->get();
			
			return $query->result();

		}

		public function listagemCoAutor($id)
		{
		
			$this->db->select("artigo.id AS artigoID, artigo.situacao, artigo.parecer,
							   artigo.titulo, artigo.arquivo, usuario.nome");
			$this->db->from('artigo_has_usuario');
			$this->db->join('usuario', 'artigo_has_usuario.Usuario_id = usuario.id');
			$this->db->join('artigo', 'artigo_has_usuario.artigo_id = artigo.id');
			$this->db->where('artigo_has_usuario.autor_principal', '0');
			$this->db->where('artigo_has_usuario.Usuario_id', $id);

			$this->db->group_by('artigo.id');

			$query = $this->db->get();
			
			return $query->result();

		}

		public function listagemAll(){

			$this->db->select("artigo.id AS artigoID, artigo.titulo");
			$this->db->from('grupo_trabalho');
			$this->db->join('usuario', 'artigo_has_usuario.Usuario_id = usuario.id');
			$this->db->join('artigo', 'artigo_has_usuario.artigo_id = artigo.id');
			

			$this->db->group_by('artigo.id');

			$query = $this->db->get();
			
			return $query->result();

		}

		public function listar_artigosGT($id){

			$this->db->select("*, artigo.id as artigoID");
			$this->db->from('artigo_has_usuario');
			$this->db->join('usuario', 'artigo_has_usuario.Usuario_id = usuario.id');
			$this->db->join('artigo', 'artigo_has_usuario.artigo_id = artigo.id');

			$this->db->where('artigo.Grupo_Trabalho_id', $id);
			$this->db->where('artigo_has_usuario.autor_principal', '1');
		
			$query = $this->db->get();
		
			return $query->result();
		
		}

		public function listar_unidade($id){

			$this->db->select('*, artigo.id AS artigoID, artigo.titulo AS artigoTitulo');
			$this->db->from('artigo');
			$this->db->join('grupo_trabalho', 'artigo.Grupo_Trabalho_id = grupo_trabalho.id');
		
			$this->db->where('artigo.id', $id);

			$query = $this->db->get();
		
			return $query->result();
		
		}

		public function contaRegistros()
		{
			$this->db->select("*");
			$this->db->from('artigo');
			$query = $this->db->get();
		
			return count($query->result());
		}
		
		public function retornaLista($maximo, $inicio)
		{
			$this->db->select("*");
			$this->db->from('artigo');
			$this->db->order_by('tipo', 'ASC');
			$this->db->order_by('descricao', 'ASC');
			$this->db->limit($maximo, $inicio);
			$query = $this->db->get();
			return $query->result();
		}
		
		public function pesquisaNome($nome){
		
			$this->db->like('descricao', $nome);
			$this->db->or_like("sigla", $nome);
			$query = $this->db->get('artigo');
		
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
			$this->db->delete('artigo');
		
			$query = $this->db->affected_rows();
		
			if($query)//se retornar algum resultado
				return TRUE;
			else
				return FALSE;
		
		}

		public function excluir_arquivo($id){
		
			$this->db->where('id', $id);
			$query = $this->db->get('artigo');
		
			return $query->result();
		
		}

	public function verificar_presenca($id){

		$this->db->select('*, artigo.id AS id_artigo, usuario.id AS id_usuario');
		$this->db->from('artigo_has_usuario');
		$this->db->join('usuario', 'artigo_has_usuario.Usuario_id = usuario.id');
		$this->db->join('artigo', 'artigo_has_usuario.Artigo_id = artigo.id');

		$this->db->where('artigo_has_usuario.Usuario_id', $id);
		$this->db->where('artigo_has_usuario.autor_principal', '1');
		$this->db->where('artigo_has_usuario.certificado', '1');

		$query = $this->db->get();

		return $query->result();

	}
	
	//------------------------ FUNCOES SETORES ----------------------------- //


	//------------------------ FUNCOES DE INSCRIÇÃO ----------------------------- //
	
	public function listarInscritos($id)
	{

		$this->db->select('*, artigo.id AS id_artigo, usuario.id AS id_usuario');
		$this->db->from('usuario_has_artigo');
		$this->db->join('usuario', 'usuario_has_artigo.Usuario_id = usuario.id');
		$this->db->join('artigo', 'usuario_has_artigo.artigo_id = artigo.id');
		$this->db->order_by('usuario.nome', 'ASC');

		$this->db->where('usuario_has_artigo.artigo_id', $id);

		$query = $this->db->get();

		return $query->result();
	}

	public function inscrever($dados){
		
		$this->db->insert('usuario_has_artigo', $dados);
	
		$query = $this->db->affected_rows();
	
		if($query){		//se retornar algum resultado
			return TRUE;
		}else{
			return FALSE;
		}
		
	}

	public function participacao($participante, $artigo, $dados){
		
		$this->db->where('artigo_id', $artigo);
		$this->db->where('Usuario_id', $participante);
		$this->db->update('usuario_has_artigo', $dados);
	
		$query = $this->db->affected_rows();
	
		if($query){//se retornar algum resultado
			return TRUE;
		}else{
			return FALSE;
		}
		
	}

	public function removerInscricao($participante, $artigo){

		$this->db->where('artigo_id', $artigo);
		$this->db->where('Usuario_id', $participante);
		$this->db->delete('usuario_has_artigo');

		$query = $this->db->affected_rows();
	
		if($query)//se retornar algum resultado
			return TRUE;
		else
			return FALSE;


	}	



	
	//------------------------ FUNCOES DE INSCRIÇÃO ----------------------------- //
		
}