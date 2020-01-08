<!DOCTYPE html>
<html lang="en">
  	<head>
  	
	    <meta charset="utf-8">
	    <title><?php echo TITULO_SISTEMA; ?> - Autenticação</title>
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	
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

    <div class="container">
			<div class="row main">
				<div class="panel-heading">
	               <div class="panel-title text-center">
	               		<center><img class="img-responsive" src="<?php echo base_url(); ?>assets/images/logo.jpg" /></center>
	               	</div>
	            </div> 
				<div class="main-login main-center">

				<?php if (!empty($error)){ ?>
					<div class="alert alert-danger" role="alert">
						<?php echo validation_errors(); ?>
						<?php echo $error; ?>
					</div>
				<?php } ?>

					<form class="form-horizontal" method="post" action="<?php echo base_url()?>login/verifica">
						
						<div class="form-group">
							<label for="username" class="cols-sm-2 control-label">Usuário</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="username" id="username"  placeholder="Digite seu e-mail"/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="password" class="cols-sm-2 control-label">Senha</label>
							<div class="cols-sm-12">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
									<input type="password" class="form-control" name="password" id="password"  placeholder="Digite sua senha"/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<button type="submit" class="btn btn-primary btn-lg btn-block login-button">Entrar</button>
						</div>
						<div class="form-group">
				            <a href="<?php echo base_url()?>formulario" class="btn btn-danger btn-lg btn-block"><i class="glyphicon glyphicon-log-in"></i> Faça sua inscrição</a>
				         </div>
					</form>
				</div>
			</div>
			<hr>
			<pre class="alinhamento" ><strong><?php echo TITULO_SISTEMA; ?></strong><br>Todos dos Direitos Reservados.</pre>

		</div>
    
  </body>
</html>