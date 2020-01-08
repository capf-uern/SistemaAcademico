
	<div class="container" style="margin-top: 2%;">

		<div class="row">
			<div class="col s12 m6 l6">
				<?php echo $titulo; ?>
			</div>
			
			<div class="col s12 m6 l6">

					<a href='<?php echo base_url() . $this->uri->segment(1); ?>/cadastro' class="waves-effect waves-light cyan darken-4 btn right">Enviar Resumo Expandido <i class="material-icons right">queue</i></a>

	        </div>

	  	</div>
		
		<div class="row">
	        <div class="col s12 m12">
	          <div class="card white">
	            <div class="card-content black-text"> <!-- DIV CARD-CONTENT -->

	            	<div class="row">

	            	<div class="card-panel grey lighten-2"><strong>Resumos Expandidos publicados</strong></div>

	        			<table class="striped responsive-table">
					        <thead>
					          <tr>
					              
					              <th width="35%">Título</th>
					              <th width="35%" class="left-align">Autores/Coautores</th>
					              <th width="15%" class="center-align">Parecer</th>
					              <th width="15%" class="center-align">Arquivos</th>
					              
					          </tr>
					        </thead>

					        <tbody>

					        <?php foreach ($listagem as $list) { ?>
					        	
					          <tr>
					            <td><?php echo $list->titulo; ?></td>
					            <td class="left-align">
					            	<?php echo '<strong>' . $list->nome . '</strong><br>';
					            	foreach ($this->listagem->listarCoAutores($list->artigoID) as $autores)
					            	{

					            		echo ' - ' . $autores->nome . '<br>';
					            		
					            	}
					            	?>
									<?php if($list->situacao == '2'){ ?>

										<form action="<?php echo base_url() . $this->uri->segment(1); ?>/reenviar/" method="post" class="col s12 m12 l12" enctype="multipart/form-data">
									<input name="id_artigo" type="hidden" value="<?php echo $list->artigoID; ?>" >
									<input name="grupotrabalho" value="<?php echo $list->gtID; ?>" type="hidden">
									<div class="file-field input-field  col s12 m12 l12">
										<div class="btn col s12 m9 l9">
											<span>Reenviar Resumo</span>
											<input name="userfile" type="file">
										</div>
										<button class="btn col s12 m2 l2 waves-effect waves-light blue darken-3" type="submit"><i class="material-icons right">send</i></button>
									</div>
									</form>

									<?php } ?>
					            </td>
					            <td class="right-align">

					            	<?php if($list->situacao == '0'){
					            		echo '<ul class="collection">
									      <li class="collection-item teal lighten-2 white-text">Avaliação pendente</li>
									    </ul>';
					            	}else  if($list->situacao == '1'){
					            		echo '<ul class="collection">
									      <li class="collection-item blue darken-1 white-text">Aprovado</li>
									    </ul>';
					            	}else  if($list->situacao == '2'){
					            		echo '<ul class="collection">
									      <li class="collection-item teal lighten-2 white-text">Aprovado com ressalvas</li>
									    </ul>';
									}else  if($list->situacao == '3'){
										echo '<ul class="collection">
									      <li class="collection-item red darken-4 white-text">Reprovado</li>
									    </ul>';
									}
					            	?>

					            	<?php 
					            	if($list->situacao != '0'){ ?>

					            		<script>
						            	$(document).ready(function() {
						            		$('#modal-parecer<?php echo $list->artigoID; ?>').modal();
						            	});
						            	</script>

					            		<button data-target="modal-parecer<?php echo $list->artigoID; ?>" class="btn btn-small tooltipped waves-effect waves-green green darken-3 modal-trigger col s112 m12 l12" data-position="top" data-delay="50" data-tooltip="Ler Parecer">parecer</button>


					            	<?php } ?>

					            </td>
					            <td class="center-align">
									<?php if($list->carta_aceite){ ?>
					            	<a href="<?php echo base_url('uploads/files') . '/'. $list->carta_aceite; ?>" class="btn btn-small tooltipped waves-effect waves-blue blue" data-position="top" data-delay="50" data-tooltip="Carta de Aceite" target="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
									<?php } ?>
					            	<a href="<?php echo base_url('uploads/files') . '/'. $list->arquivo; ?>" class="btn btn-small tooltipped waves-effect waves-orange orange" data-position="top" data-delay="50" data-tooltip="Visualizar Resumo Expandido" target="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>

					            </td>
					          </tr>

					        <?php } ?>

					        </tbody>
					    </table>


					    <div class="card-panel grey lighten-2"><strong>Participação em Resumos Expandidos</strong></div>

	        			<table class="striped responsive-table">
					        <thead>
					          <tr>
					              
					              <th width="35%">Título</th>
					              <th width="50%" class="left-align">Autores/Coautores</th>
					              <th width="15%" class="center-align">Arquivos</th>
					              
					          </tr>
					        </thead>

					        <tbody>

					        <?php foreach ($participa as $part) { ?>
					        	
					          <tr>
					            <td><?php echo $part->titulo; ?></td>
					            <td class="left-align">
					            <?php 
					            	foreach ($this->listagem->listarAutores($part->artigoID) as $autores)
					            	{

					            		echo '<strong>' . $autores->nome . '</strong><br>';
					            		
					            	}
					            	foreach ($this->listagem->listarCoAutores($part->artigoID) as $coautores)
					            	{

					            		echo ' - ' . $coautores->nome . '<br>';
					            		
					            	}
					            	?>
					            </td>
					            <td class="center-align">

					            	<a href="<?php echo base_url('uploads/files') . '/'. $part->arquivo; ?>" class="btn btn-small tooltipped waves-effect waves-orange orange" data-position="top" data-delay="50" data-tooltip="Visualizar Resumo Expandido" target="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>

					            </td>
					          </tr>

					        <?php } ?>

					        </tbody>
					    </table>

					</div>

	            </div> <!-- DIV CARD-CONTENT -->
	          </div>
	        </div>
	  </div>

	  <?php foreach ($listagem as $list) { ?>
  <!-- Modal Structure -->
  <div id="modal-parecer<?php echo $list->artigoID; ?>" class="modal">
	    <div class="modal-content">
	      <h4><strong>Parecer</strong></h4>
	      <div class="row">

			<div class="input-field col s12 m12 l12"  style="margin-top: -2%;">
            	<div class="row">
			       	<div class="col s12 m12 l12">
					    <?php if($list->situacao == '0'){
		            		echo '<ul class="collection">
						      <li class="collection-item teal lighten-2 white-text">Avaliação pendente</li>
						    </ul>';
		            	}else  if($list->situacao == '1'){
		            		echo '<ul class="collection">
						      <li class="collection-item blue darken-1 white-text">Aprovado</li>
						    </ul>';
		            	}else  if($list->situacao == '2'){
		            		echo '<ul class="collection">
						      <li class="collection-item teal lighten-2 white-text">Aprovado com ressalvas</li>
						    </ul>';
						}else  if($list->situacao == '3'){
							echo '<ul class="collection">
						      <li class="collection-item red darken-4 white-text">Reprovado</li>
						    </ul>';
						}
		            	?>
				  	</div>
		      	</div>
		    </div>

	   	  	<div class="col s12 m12 l12" style="margin-top: -4%;">
	        	<p><?php echo $list->parecer; ?></p>
          	</div>
	      	
		  </div>	
	    </div>

	    <div class="modal-footer">
	      <button type="reset" class="modal-close waves-effect waves-grey grey lighten-1 btn-flat">Fechar </button>
	    </div>
  </div>
  <?php } ?>

	</div>

