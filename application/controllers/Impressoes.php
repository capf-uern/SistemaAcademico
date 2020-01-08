<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Impressoes extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		if(!$this->session->userdata('log_in'))
		{
			redirect(base_url(), 'refresh');
		}
	}
	
	public function index()
	{
		$data['titulo'] = '| emissão de certificados';
		$data['msg'] 	= 'Área dos certificados não disponível no momento.';
		$data['voltar'] = base_url() .  'painel';

		$this->load->view('include/header');
		$this->load->view('include/mensagem', $data);
		$this->load->view('include/footer');
	}

	public function minicursos($id)
	{
		//model
		$this->load->model('minicursos_model', 'minicursos');

		$data['titulo'] 	= 'Lista de Presença';
		$data['listagem'] 	= $this->minicursos->listarInscritos($id);
		$data['curso'] 	= $this->minicursos->listar_unidade($id);

		$pdfFilePath = "listagem".date('YmdHis').".pdf";
		$pdf = $this->pdf->load();

		$pdf->SetHTMLHeader( $this->load->view('include/header', true) );
		$pdf->SetHTMLFooter( $this->load->view('include/footer') );
		$pdf->WriteHTML( $this->load->view('impressoes/lista', $data, TRUE) );
		$pdf->Output( $pdfFilePath, 'D' );
	}

	public function oficinas($id)
	{
		//model
		$this->load->model('oficinas_model', 'oficinas');

		$data['titulo'] 	= 'Lista de Presença';
		$data['listagem'] 	= $this->oficinas->listarInscritos($id);
		$data['curso'] 		= $this->oficinas->listar_unidade($id);

		$pdfFilePath = "listagem".date('YmdHis').".pdf";
		$pdf = $this->pdf->load();

		$pdf->SetHTMLHeader( $this->load->view('include/header', true) );
		$pdf->SetHTMLFooter( $this->load->view('include/footer') );
		$pdf->WriteHTML( $this->load->view('impressoes/lista', $data, TRUE) );
		$pdf->Output( $pdfFilePath, 'D' );
	}

	public function certificadgeral()
	{
		//model
		$this->load->model('usuario_model', 'usuario');

		$id = $this->session->userdata('id');

		$data['usuario'] = $this->usuario->verificar_presenca($id);

		$pdfFilePath = "certificado_".date('YmdHis').".pdf";
		$pdf = $this->pdf->load("L");

		$pdf->SetHTMLHeader( $this->load->view('include/header', true) );
		$pdf->SetHTMLFooter( $this->load->view('include/footer') );
		$pdf->WriteHTML( $this->load->view('impressoes/geral', $data, TRUE) );
		$pdf->Output( $pdfFilePath, 'D' );
	}

	public function certificadominicurso()
	{
		//model
		$this->load->model('minicursos_model', 'minicursos');

		$id = $this->session->userdata('id');

		$data['minicurso'] = $this->minicursos->verificar_presenca($id);

		$pdfFilePath = "certificado_".date('YmdHis').".pdf";
		$pdf = $this->pdf->load("L");

		$pdf->SetHTMLHeader( $this->load->view('include/header_mini', true) );
		$pdf->SetHTMLFooter( $this->load->view('include/footer') );
		$pdf->WriteHTML( $this->load->view('impressoes/minicurso', $data, TRUE) );
		$pdf->Output( $pdfFilePath, 'D' );
	}

	public function certificadooficina()
	{
		//model
		$this->load->model('oficinas_model', 'oficinas');

		$id = $this->session->userdata('id');

		$data['oficina'] = $this->oficinas->verificar_presenca($id);

		$pdfFilePath = "certificado_".date('YmdHis').".pdf";
		$pdf = $this->pdf->load("L");

		$pdf->SetHTMLHeader( $this->load->view('include/header_mini', true) );
		$pdf->SetHTMLFooter( $this->load->view('include/footer') );
		$pdf->WriteHTML( $this->load->view('impressoes/oficina', $data, TRUE) );
		$pdf->Output( $pdfFilePath, 'D' );
	}

	public function certificadoresumos()
	{
		//model
		$this->load->model('artigos_model', 'artigos');

		$id = $this->session->userdata('id');

		$data['resumos'] = $this->artigos->verificar_presenca($id);

		$pdfFilePath = "certificado_".date('YmdHis').".pdf";
		$pdf = $this->pdf->load("L");

		$pdf->SetHTMLHeader( $this->load->view('include/header_mini', true) );
		$pdf->SetHTMLFooter( $this->load->view('include/footer') );
		$pdf->WriteHTML( $this->load->view('impressoes/resumos', $data, TRUE) );
		$pdf->Output( $pdfFilePath, 'D' );
	}

	public function ministrantemini()
	{
		//model
		$this->load->model('minicursos_model', 'minicursos');

		$id = $this->session->userdata('id');

		$data['min_minicurso']	= $this->minicursos->certificado_ministrante($id);

		$pdfFilePath = "certificado_".date('YmdHis').".pdf";
		$pdf = $this->pdf->load("L");

		$pdf->SetHTMLHeader( $this->load->view('include/header_mini', true) );
		$pdf->SetHTMLFooter( $this->load->view('include/footer') );
		$pdf->WriteHTML( $this->load->view('impressoes/minicurso_ministrante', $data, TRUE) );
		$pdf->Output( $pdfFilePath, 'D' );
	}

	public function ministranteoficina()
	{
		//model
		$this->load->model('oficinas_model', 'oficinas');

		$id = $this->session->userdata('id');

		$data['min_oficina']	= $this->oficinas->certificado_ministrante($id);

		$pdfFilePath = "certificado_".date('YmdHis').".pdf";
		$pdf = $this->pdf->load("L");

		$pdf->SetHTMLHeader( $this->load->view('include/header_mini', true) );
		$pdf->SetHTMLFooter( $this->load->view('include/footer') );
		$pdf->WriteHTML( $this->load->view('impressoes/oficina_ministrante', $data, TRUE) );
		$pdf->Output( $pdfFilePath, 'D' );
	}

	public function imprimir(){

		//FUNÇÃO DE EXEMPLO PARA TODO O SISTEMA
		$html= '<h1></h1>';
		//echo $html;
		//this the the PDF filename that user will get to download
		$pdfFilePath = "certificate_".date('Ymd_His').".pdf";
		//envia L para imprimir em Landscape (paisagem) , para imprimir em modo retrato nao precisa passar nenhum parametro.
	    $pdf = $this->pdf->load("L");
	    //$pdf->SetHTMLFooter( $this->footer() ); 
	    //$pdf->SetHTMLHeader( $this->header() ); 
	    $pdf->WriteHTML( $html );
	    $pdf->Output( $pdfFilePath, 'D' ); 

	}
}