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

<div class="container">

	<div class="row">
		<div>
			Universidade do Estado do Rio Grande do Norte - UERN <br>
			Campus Avançado Profa. Maria Elisa de Albuquerque Maia - CAMEAM <br>
			XVII Semana Universitária - 04 a 07 de outubro de 2017
			<br><br>
		</div>
		
		<div>

			<table class="cabeca">
			<?php foreach ($curso as $lista) {

				echo
					'<tr>
						<td class="cabeca" colspan="2"><strong>' . $lista->titulo . '</strong></td>
					</tr>
					<tr>
						<td class="cabeca"><strong>Ministrante: ' . $lista->nome . '</strong></td>
						<td class="cabeca"><strong>Data: </strong>' . datasemtempo_final($lista->data) . '</td>
					</tr>
					<tr>
						<td class="cabeca"><strong>Local: </strong>' . $lista->local . '</strong></td>
						<td class="cabeca"><strong>Carga Horária: </strong>' . $lista->carga_horaria . '</td>
					</tr>';
			}?>
			</table>
        </div>
		<strong>LISTA DE PRESENÇA</strong><br>
  	</div>
	
	<div class="row">
        <div class="col s12 m12">
          <div class="card white">
            <div class="card-content black-text"> <!-- DIV CARD-CONTENT -->

            	<div class="row">



        			<table class="table table-striped">

				<?php 
		        if(count($listagem) == 0){

		        	echo '<tr><td>Nenhum participante inscrito.<td></tr>';

		        }else{ ?>
        				
				        <thead>
				          <tr>
				              <th width="2%" class="left-align">#</th>
				              <th width="33%" class="left-align">Nome</th>
				              <th width="55%" class="left-align">Assinatura</th>
				          </tr>
				        </thead>

				        <tbody>

					    <?php

					    $i = 1;
					    foreach ($listagem as $list) { ?>
					        	
					          <tr>
					          	<td><strong><?php echo $i; ?></strong></td>
					            <td class="left-align">
					            	<?php echo $list->nome; ?>
					            </td>
					            <td class="linha">
					            	
					            </td>
					          </tr>

				        	<?php $i++; } //foreach ?>
				        </tbody>
				        <?php } //if ?>
				    </table>

				</div>

            </div> <!-- DIV CARD-CONTENT -->

          </div>
        </div>
  </div>

</div>

</body>
</html>

