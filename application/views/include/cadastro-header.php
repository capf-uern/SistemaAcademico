<!DOCTYPE html>
<html lang="en">
  	<head>
  	
	    <meta charset="utf-8">
	    <title><?php echo TITULO_SISTEMA; ?></title>
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <meta name="robots" content="noindex, nofollow" />
	
		<!-- Folha de Estilo Principal -->
		<link href="<?php echo base_url('assets/css/style.css') ?>" rel="stylesheet">
	
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
		<script src="http://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	
	    <!-- Compiled and minified CSS -->
  		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.99.0/css/materialize.min.css">
  		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  		<!-- Compiled and minified JavaScript -->
  		<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.99.0/js/materialize.min.js"></script>

		<script type="text/javascript">
			
			$(document).ready(function() {
    			$('select').material_select();
  			});

		</script>
		
	</head>
	
<body>

<header>

<nav class="blue darken-4">

	<div class="container">

		<div class="row">
      		<div class="col s12 l9 hide-on-med-and-down"><?php echo TITULO_SISTEMA; ?></div>
      		<div class="col s12 l3"><strong><?php echo $titulo; ?></strong></div>
    	</div>

	</div>
  
</nav>

</header>

<main>
  
