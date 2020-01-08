
<div class="container" style="margin-top: 2%;">

	<div class="row">
		<div class="col s12 m6 l6">
			<?php echo $titulo; ?>
		</div>
		
		<div class="col s12 m6 l6">

        </div>
  	</div>
	
	<div class="row">
        <div class="col s12 m12">
          <div class="card white">
            <div class="card-content black-text"> <!-- DIV CARD-CONTENT -->

            	<div class="row">

        			<table class="striped responsive-table">
				        <thead>
				          <tr>
				              
				              <th width="35%">Título</th>
				              <th width="35%" class="left-align">Ministrante</th>
				              <th class="center-align">Status</th>
				              <th class="center-align">Detalhes</th>
				              
				          </tr>
				        </thead>

				        <tbody>

				        <?php foreach ($listagem as $list) { ?>
				        	
				          <tr>
				            <td><?php echo $list->titulo; ?></td>
				            <td class="left-align">
				            	<?php echo $list->nome; ?>
				            </td>
				            <td class="center-align">

				            	<?php 
				            		if($this->listagem->contarInscritos($list->id_minicurso) < $list->vagas){

				            			echo '<p class="black-text blue lighten-3">Aberto</p>';
				            		}else{

				            			echo '<p class="white-text red darken-4">Lotado</p>';
				            		}
				            	?>
				            </td>
				            <td class="left-align">

							<?php
								if($this->listagem->contarInscritos($list->id_minicurso) < $list->vagas){ ?>

				            	<a href="<?php echo base_url('minicursos/detalhes') . "/" . $list->id_minicurso; ?>" class="btn btn-small tooltipped waves-effect waves-orange blue darken-3" data-position="top" data-delay="50" data-tooltip="Informações do Minicurso">Detalhes</a>

								<?php }else{ ?>

								<a href="<?php echo base_url('minicursos/detalhes') . "/" . $list->id_minicurso; ?>" class="btn btn-small tooltipped waves-effect waves-orange blue darken-3" disabled data-position="top" data-delay="50" data-tooltip="Minicurso lotado">LOTADO</a>

								<?php } ?>

				            	<?php if($this->listagem->verificaInscrito($this->session->userdata('id'), $list->id_minicurso)){ ?>
				            		<a href="<?php echo base_url('minicursos/removerInscricao') . "/" . $list->id_minicurso; ?>" class="btn btn-small tooltipped waves-effect waves-orange red darken-3" data-position="top" data-delay="50" data-tooltip="Cancelar Inscrição">Cancelar</a>
				            	<?php } ?>
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

