<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Listagem {
	
		public function __construct()
		{
			
			$this->CI =& get_instance();
			
		}
		
		public function contarInscritos($minicurso){
		
			$CI =& get_instance();
		
			$CI->db->where('Minicurso_id', $minicurso);
			$query = $CI->db->get('usuario_has_minicurso');
		
			return count($query->result());
		
		}

		public function verificaInscrito($id, $minicurso){

			$CI =& get_instance();
		
			$CI->db->where('Usuario_id', $id);
			$CI->db->where('Minicurso_id', $minicurso);
			$query = $CI->db->get('usuario_has_minicurso');
		
			if($query->num_rows() > 0)
				return TRUE;
			else
				return FALSE;

		}

		public function limitaInscricao($id, $qtde){

			$CI =& get_instance();
		
			$CI->db->where('Usuario_id', $id);
			$query = $CI->db->get('usuario_has_minicurso');
		
			if($query->num_rows() >= $qtde)
				return FALSE;
			else
				return TRUE;

		}

		public function contarInscritosOficina($oficina){
		
			$CI =& get_instance();
		
			$CI->db->where('Oficina_id', $oficina);
			$query = $CI->db->get('usuario_has_oficina');
		
			return count($query->result());
		
		}

		public function verificaInscritoOficina($id, $oficina){

			$CI =& get_instance();
		
			$CI->db->where('Usuario_id', $id);
			$CI->db->where('Oficina_id', $oficina);
			$query = $CI->db->get('usuario_has_oficina');
		
			if($query->num_rows() > 0)
				return TRUE;
			else
				return FALSE;

		}

		public function limitaInscricaoOficina($id, $qtde){

			$CI =& get_instance();
		
			$CI->db->where('Usuario_id', $id);
			$query = $CI->db->get('usuario_has_oficina');
		
			if($query->num_rows() >= $qtde)
				return FALSE;
			else
				return TRUE;

		}

		public function listarCoAutores($artigo){

			$CI =& get_instance();
		
			$CI->db->select("usuario.nome, artigo_has_usuario.autor_principal");
			$CI->db->from('artigo_has_usuario');
			$CI->db->join('usuario', 'artigo_has_usuario.Usuario_id = usuario.id');
			$CI->db->where('artigo_has_usuario.Artigo_id', $artigo);
			$CI->db->where('artigo_has_usuario.autor_principal', '0');
			$CI->db->order_by('artigo_has_usuario.autor_principal', 'DESC');
			$CI->db->order_by('usuario.nome', 'ASC');

			$query = $CI->db->get();
		
			return $query->result();

		}

		public function listarAutores($artigo){

			$CI =& get_instance();
		
			$CI->db->select("usuario.nome, artigo_has_usuario.autor_principal");
			$CI->db->from('artigo_has_usuario');
			$CI->db->join('usuario', 'artigo_has_usuario.Usuario_id = usuario.id');
			$CI->db->where('artigo_has_usuario.Artigo_id', $artigo);
			$CI->db->where('artigo_has_usuario.autor_principal', '1');
			$CI->db->order_by('artigo_has_usuario.autor_principal', 'DESC');
			$CI->db->order_by('usuario.nome', 'ASC');

			$query = $CI->db->get();
		
			return $query->result();

		}

		public function verificaGrupodeTrabalho($id){

			$CI =& get_instance();
		
	 		$CI->db->where('Usuario_id', $id);
			$query = $CI->db->get('grupo_trabalho');
		
			if($query->num_rows() > 0)
				return TRUE;
			else
				return FALSE;

		}

	public function verificaGrupoPosteres($id){

		$CI =& get_instance();

		$CI->db->where('Usuario_id', $id);
		$query = $CI->db->get('grupo_posteres');

		if($query->num_rows() > 0)
			return TRUE;
		else
			return FALSE;

	}

		public function emailCoordenador($id){

			$CI =& get_instance();
		
			$CI->db->select("usuario.nome, usuario.email");
			$CI->db->from('grupo_trabalho');
			$CI->db->join('usuario', 'grupo_trabalho.Usuario_id = usuario.id');
			$CI->db->where('grupo_trabalho.id', $id);

			$query = $CI->db->get();
		
			if ($query->row())
			{
				return $query->row()->email;
			}

		}

		public function emailCoordenadorPoster($id){

			$CI =& get_instance();

			$CI->db->select("usuario.nome, usuario.email");
			$CI->db->from('grupo_posteres');
			$CI->db->join('usuario', 'grupo_posteres.Usuario_id = usuario.id');
			$CI->db->where('grupo_posteres.id', $id);

			$query = $CI->db->get();

			if ($query->row())
			{
				return $query->row()->email;
			}

		}

		public function emailParticipante($id){

			$CI =& get_instance();
		
			$CI->db->select("usuario.nome, usuario.email");
			$CI->db->where('id', $id);
			$query = $CI->db->get('usuario');
		
			if ($query->row())
			{
				return $query->row()->email;
			}

		}		
		
		function barcode($numero){
			
			$fino = 3;
			$largo = 6;
			$altura = 60;
		
			$barcodes[0] = '00110';
			$barcodes[1] = '10001';
			$barcodes[2] = '01001';
			$barcodes[3] = '11000';
			$barcodes[4] = '00101';
			$barcodes[5] = '10100';
			$barcodes[6] = '01100';
			$barcodes[7] = '00011';
			$barcodes[8] = '10010';
			$barcodes[9] = '01010';
		
			for($f1 = 9; $f1 >= 0; $f1--){
		
				for($f2 = 9; $f2 >= 0; $f2--){
		
					$f = ($f1 * 10) + $f2;
					$texto = '';
					for($i = 1; $i < 6; $i++){
						$texto .= substr($barcodes[$f1], ($i-1), 1).substr($barcodes[$f2] ,($i-1), 1);
					}
					$barcodes[$f] = $texto;
				}
					
			}
		
		
			echo '<img ';
		
			$texto = $numero;
		
			if((strlen($texto) % 2) <> 0){
				$texto = '0' . $texto;
			}
		
			while(strlen($texto) > 0){
					
				$i = round(substr($texto, 0, 2));
				$texto = substr($texto, strlen($texto)-(strlen($texto)-2), (strlen($texto)-2));
		
				if( isset($barcodes[$i]) ){
					$f = $barcodes[$i];
				}
		
				for($i = 1; $i < 11; $i+=2){
					if(substr($f, ($i-1), 1) == '0'){
						$f1 = $fino;
					}else{
						$f1 = $largo;
					}
		
					echo 'src="' . base_url() . 'assets/images/p.gif" width="'.$f1.'" height="'.$altura.'" border="0">';
					echo '<img ';
						
					if(substr($f, $i, 1) == '0'){
						$f2 = $fino;
					}else{
						$f2 = $largo;
					}
						
					echo 'src="' . base_url() . 'assets/images/b.gif" width="'.$f2.'" height="'.$altura.'" border="0">';
					echo '<img ';
				}
			}
			echo 'src="' . base_url() . 'assets/images/p.gif" width="'.$largo.'" height="'.$altura.'" border="0" />';
			echo '<img src="' . base_url() . 'assets/images/b.gif" width="'.$fino.'" height="'.$altura.'" border="0" />';
			echo '<img src="' . base_url() . 'assets/images/p.gif" width="1" height="'.$altura.'" border="0" />';
		
		}
		
}


