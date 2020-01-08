
	<div class="container" style="margin-top: 2%;">

		<div class="row">
			<div class="col s12 m6 l6">
				<?php echo $titulo; ?>
			</div>
			
			<div class="col s12 m6 l6">
					<a href='<?php echo base_url() . $this->uri->segment(1); ?>/cadastro' class="waves-effect waves-light cyan darken-4 btn right">Enviar Artigo <i class="material-icons right">queue</i></a>
	        </div>

	  	</div>
		
		<div class="row">
	        <div class="col s12 m12">
	          <div class="card white">
	            <div class="card-content black-text"> <!-- DIV CARD-CONTENT -->

	            	<div class="row">

	            	<div class="card-panel grey lighten-2"><strong>Artigos</strong></div>

	        			<table class="striped responsive-table">
					        <thead>
					          <tr>
					              
					              <th width="35%">Título</th>
					              <th width="35%" class="left-align">Autores/Coautores</th>
					              <th class="center-align">Parecer</th>
					              <th class="center-align">Arquivos</th>
					              
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
					            </td>
					            <td class="center-align">

					            </td>
					            <td class="left-align">

					            </td>
					          </tr>

					        <?php } ?>

					        </tbody>
					    </table>


					    <div class="card-panel grey lighten-2"><strong>Participação em Artigos</strong></div>

	        			<table class="striped responsive-table">
					        <thead>
					          <tr>
					              
					              <th width="35%">Título</th>
					              <th width="35%" class="left-align">Autores/Coautores</th>
					              <th class="center-align">Parecer</th>
					              <th class="center-align">Arquivos</th>
					              
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

					            </td>
					            <td class="left-align">

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

	</div>

