<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="utf-8">
	<title><?php echo TITULO_SISTEMA; ?> - Autenticação</title>

	<!-- Folha de Estilo Principal -->
	<link href="<?php echo base_url('assets/css/style.css') ?>" rel="stylesheet">

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

	<style type="text/css">

		body {
			padding-top: 35px;
			padding-bottom: 40px;
			background-color: #f5f5f5;
		}

	</style>


</head>

<body>

<div class="bg_minicursos">

				<?php
		        if(count($oficina) == 0){
		        	echo 'Nenhuma informação encontrada.';

		        }else{
					foreach ($oficina as $list) {

					$titulo = explode(".", $list->titulo);

						echo '<p class="texto_minicurso">
						Certificamos que <span class="texto_nome">'. strtoupper ($list->nome) .'</span> participou da oficina <span class="texto_negrito">'.  $titulo[0] .'</span>, durante a XVII Semana Universitária, promovida pelo Campus Avançado “Profa. Maria Elisa de Albuquerque Maia” (CAMEAM), da Universidade do Estado do Rio Grande do Norte (UERN), no período de 04 a 07 de outubro de 2017, perfazendo a carga-horária de <span class="texto_negrito">'. $list->carga_horaria .'</span> horas.
						</p>';
						echo '<p class="texto_data">
						Pau dos Ferros-RN, 07 de outubro de 2017.
						</p>';

						echo '<p class="assinatura_jailson_mini">'; ?>
						<img src="<?php echo base_url(); ?>assets/images/assinatura_jailson.jpg">
						<?php echo '</p>';

						echo '<p class="assinatura_sidneia_mini">'; ?>
						<img src="<?php echo base_url(); ?>assets/images/assinatura_sidneia.jpg">
						<?php echo '</p>';
					}
				} //if ?>
</div>
</body>
</html>

