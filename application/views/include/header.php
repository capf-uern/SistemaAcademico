<!DOCTYPE html>
<html lang="en">
  	<head>
  	
	    <meta charset="utf-8">
	    <title><?php echo TITULO_SISTEMA; ?></title>
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <meta name="robots" content="noindex, nofollow" />
	
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
		<script src="http://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	
	    <!-- Compiled and minified CSS -->
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
  		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.99.0/css/materialize.min.css">
  		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  		<!-- Compiled and minified JavaScript -->
  		<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.99.0/js/materialize.min.js"></script>

		<!-- Folha de Estilo Principal -->
		<link href="<?php echo base_url('assets/css/style.css') ?>" rel="stylesheet">

		<script type="text/javascript">
			
			$(document).ready(function() {
    			$('select').material_select();
    			$(".button-collapse").sideNav();
    			$(".dropdown-button").dropdown({
			      inDuration: 300,
			      outDuration: 225,
			      constrainWidth: false, // Does not change width of dropdown to that of the activator
			      hover: false, // Activate on hover
			      gutter: 0, // Spacing from edge
			      belowOrigin: true, // Displays dropdown below the button
			      alignment: 'left', // Displays dropdown with edge aligned to the left of button
			      stopPropagation: false // Stops event propagation
			    });
			    $('#modal-pesquisa').modal();

  			});

		</script>

	</head>
	
<body>

<header>

<nav class="blue darken-4">

	<div class="container">

		<div class="row">
      		<div class="col s12 m6 l6 hide-on-med-and-down">
      			<a href="<?php echo base_url('painel'); ?>"><?php echo TITULO_SISTEMA; ?></a>
  			</div>
      		<div class="col s8 m10 l4 right-align">
      			<div class="truncate right-align"><?php echo $this->session->userdata('nome'); ?></div>
			</div>
      		<div class="col s4 m2 l2 right-align">
      			<a href="<?php echo base_url() ?>login/logoff" class="waves-effect waves-light btn red darken-4">sair</a>
      		</div>
    	</div>

	</div>
  
</nav>

	<?php

	$largura = 60;

	if($this->session->userdata('artigos') == '1') {
		$largura = 70;
	}

	if($this->listagem->verificaGrupodeTrabalho($this->session->userdata('id')) AND $this->session->userdata('artigos') == '0'){
		$largura = 72;
	}

	if(($this->listagem->verificaGrupodeTrabalho($this->session->userdata('id'))) OR ($this->listagem->verificaGrupoPosteres($this->session->userdata('id'))) and $this->session->userdata('status') == '0'){
		$largura = 83;
	}

	if((!$this->listagem->verificaGrupodeTrabalho($this->session->userdata('id'))) OR (!$this->listagem->verificaGrupoPosteres($this->session->userdata('id'))) and $this->session->userdata('status') == '1'){
		$largura = 83;
	}

	if((($this->listagem->verificaGrupodeTrabalho($this->session->userdata('id'))) OR ($this->listagem->verificaGrupoPosteres($this->session->userdata('id'))) and $this->session->userdata('status') == '1')){
		$largura = 93;
	}



	?>

<nav class="light-blue accent-4">
	<div class="container" style="width: <?php echo $largura.'%';?>;">
		<div class="row">
		    <div class="nav-wrapper">
		      <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
		      <div class="hide-on-large-only">Menu</div>
		      <ul id="nav-mobile"  class="left hide-on-med-and-down">
		        <li>
		        	<a class="waves-effect waves-blue" href="<?php echo base_url('dados'); ?>"><i class="material-icons left">contacts</i>Meus Dados</a>
		        </li>
		        <li>
		        	<a class="waves-effect waves-blue" href="<?php echo base_url('minicursos'); ?>"><i class="material-icons left">question_answer</i>Minicursos</a>
		        </li>
		        <?php if($this->session->userdata('artigos') == '1'){ ?>
		        <li>
		        	<a class="waves-effect waves-blue" href="<?php echo base_url('artigos'); ?>"><i class="material-icons left">description</i>Resumo Expandido</a>
		        </li>
				<li>
		        	<a class="waves-effect waves-blue" href="<?php echo base_url('posteres'); ?>"><i class="material-icons left">content_copy</i>Pôsteres</a>
		        </li>
				<?php } ?>
		        <li>
		        	<a class="waves-effect waves-blue" href="<?php echo base_url('oficinas'); ?>"><i class="material-icons left">recent_actors</i>Oficinas</a>
		        </li>
		        <li>
		        	<a class="waves-effect waves-blue" href="<?php echo base_url('certificados'); ?>"><i class="material-icons left">language</i>Certificados</a>
		        </li>
		        <?php
				if(($this->listagem->verificaGrupodeTrabalho($this->session->userdata('id'))) OR ($this->listagem->verificaGrupoPosteres($this->session->userdata('id')))){ ?>
		        <li>
				<a class="dropdown-button" href="#!" data-activates="dropdown2"><i class="material-icons left">chrome_reader_mode</i>Coordenações<i class="material-icons right">arrow_drop_down</i></a>
		        </li>
		        <?php } ?>
		      </ul>

		      <?php if($this->session->userdata('status') == '1'){ ?>
		      <ul id="nav-mobile" class="right hide-on-med-and-down">
		        <li>
		        	<a class="dropdown-button" href="#!" data-activates="dropdown1">Administração<i class="material-icons right">arrow_drop_down</i></a>
		        </li>
		      </ul>
		      <?php } ?>

		      <!-- mobile version -->
		      <ul class="side-nav" id="mobile-demo">
		        <li>
		        	<a href="<?php echo base_url('dados'); ?>"><i class="material-icons left">contacts</i>Meus Dados</a>
		        </li>
		        <li>
		        	<a href="<?php echo base_url('minicursos'); ?>"><i class="material-icons left">question_answer</i>Minicursos</a>
		        </li>
		        <li>
		        	<a href="<?php echo base_url('artigos'); ?>"><i class="material-icons left">description</i>Artigos</a>
		        </li>
			  	<li>
		        	<a href="<?php echo base_url('posteres'); ?>"><i class="material-icons left">content_copy</i>Pôsteres</a>
		        </li>
		        <li>
		        	<a href="<?php echo base_url('oficinas'); ?>"><i class="material-icons left">recent_actors</i>Oficinas</a>
		        </li>
		        <li>
		        	<a href="<?php echo base_url('certificados'); ?>"><i class="material-icons left">language</i>Certificados</a>
		        </li>
		      </ul>
				<!-- mobile version -->

				<?php //MENU DO ADMINISTRADOR DO SISTEMA
		      	if($this->session->userdata('status') == '1'){ ?>
					<ul id="dropdown1" class="dropdown-content">
						<li><a href="<?php echo base_url('dados/listagem'); ?>">Participantes</a></li>
						<li><a href="<?php echo base_url('minicursos/listagem'); ?>">Minicursos</a></li>
						<li><a href="<?php echo base_url('oficinas/listagem'); ?>">Oficinas</a></li>
						<li><a href="<?php echo base_url('artigos/listagem'); ?>">Grupos de Trabalhos</a></li>
						<li><a href="<?php echo base_url('posteres/listagem'); ?>">Seção de Pôsteres</a></li>
						<li><a href="<?php echo base_url('painel/listagem'); ?>">Estatísticas</a></li>
			  </ul>
		      <?php } 
		      //MENU DO ADMINISTRADOR DO SISTEMA ?>

				<?php //MENU DOS COORDENADORES ?>
					<ul id="dropdown2" class="dropdown-content">
						<?php
						if($this->listagem->verificaGrupodeTrabalho($this->session->userdata('id'))){ ?>
						<li><a href="<?php echo base_url('grupotrabalho'); ?>">Resumos Expandidos</a></li>
						<?php } ?>
						<?php
						if($this->listagem->verificaGrupoPosteres($this->session->userdata('id'))){ ?>
						<li><a href="<?php echo base_url('posteres/coordenacao'); ?>">Pôsteres</a></li>
						<?php } ?>
					</ul>

				<?php //MENU DOS COORDENADORES ?>

		    </div>
		</div>
    </div>
</nav>

</header>

<main>
  
