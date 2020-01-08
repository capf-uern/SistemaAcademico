
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


        			<table class="bordered responsive-table">

				        <?php foreach ($listagem as $list) { ?>
				        <tbody>
				          	<tr>
					            <td>
					            	<h5><?php echo $list->titulo; ?></h5>
					            </td>
				          	</tr>
				          	<tr>
					            <td class="left-align">
					            	<?php echo $list->descricao; ?>
					            </td>
				            </tr>
				            <tr>
					            <td class="left-align">
					            	<?php echo "<strong>Ministrante: </strong>" . $list->nome . "<br>"; ?>
					            	<?php echo $list->Usuario_id_curriculo; ?>

					            </td>
				            </tr>
				            <tr>
					            <td class="left-align">
					            	<?php  
					            	echo '<strong>Data: </strong>' . datasemtempo_final($list->data) . '<br>';
					            	echo '<strong>Horário: </strong>' . datacomtempo($list->data) . '<br>';
									echo '<strong>Local: </strong>' . $list->local . '<br>';

									echo '<strong>Carga Horária: </strong>' . $list->carga_horaria . '<br>';
									echo '<strong>Vagas: </strong>' . $list->vagas . '<br>';
									?>
					            </td>
				            </tr>

				        

				        </tbody>
				    </table>

				    <div style="margin-top: 2%;">
				    
				    <?php

					/*

					if($this->listagem->contarInscritos($list->id_minicurso) >= $list->vagas) {

						echo '<a class="btn btn-small tooltipped waves-effect waves-blue blue darken-4" data-position="top" data-delay="50" data-tooltip="Realizar inscrição" disabled>LOTADO</a>';

					}else {

						if ($this->listagem->limitaInscricao($this->session->userdata('id'), 1)) {

							if ($this->listagem->verificaInscrito($this->session->userdata('id'),
								$list->id_minicurso)) {

								echo '<a class="btn btn-small tooltipped waves-effect waves-blue blue darken-4" data-position="top" data-delay="50" data-tooltip="Realizar inscrição" disabled>inscrito</a>';

							} else {

								if ($this->listagem->contarInscritos($list->id_minicurso) <= $list->vagas) {

									// ABERTO
									if ($this->session->userdata('liberado') == '1') {

										echo '<a href="' . base_url('minicursos/inscrever') . '/' . $list->id_minicurso . '" class="btn btn-small waves-effect waves-blue blue darken-4"><i class="small material-icons">edit</i> Realizar inscrição</a>';

									} else {

										echo '<a class="btn btn-small tooltipped waves-effect waves-blue blue darken-4" data-position="top" data-delay="50" data-tooltip="Pagamento Pendente " disabled>Pagamento Pendente</a>';

									}

								} else {

									echo '<a class="btn btn-small waves-effect waves-blue white-text red darken-4">lotado</a><br>
		            			<h6>Todas as vagas preenchidas para este minicurso. </h6>';
								}

							}

						} else {

							echo '<a class="btn btn-small waves-effect waves-blue white-text red darken-4">limite excedido</a><br>
            			<h6>Você chegou ao limite permitido de inscrições em minicursos. </h6>';

						}

					}
*/
	            	?>
	            	</div>


            </div> <!-- DIV CARD-CONTENT -->
          </div>
          <div class="row  center-align">
					<a href='javascript:history.back(-1)' class="waves-effect waves-light btn grey darken-1">Voltar</a>
	      </div>
        </div>
  </div>
<?php } ?>
<?php foreach ($listagem as $list) { ?>
  <!-- Modal Structure -->
  <div id="modal<?php echo $list->id_minicurso; ?>" class="modal">
  <form action="<?php echo base_url() . $this->uri->segment(1); ?>/excluir/<?php echo $list->id_minicurso; ?>" method="post">
	    <div class="modal-content">
	      <h4><strong>Confirmar Exclusão ?</strong></h4>
	      <p>Excluir o minicurso: <br><h5><strong><?php echo $list->titulo; ?></strong></h5>
	      </p>	
	    </div>
	    <div class="modal-footer">
	      <button type="reset" class="modal-close waves-effect waves-green grey lighten-1 btn-flat">Cancelar </button>
	      <button class="modal-action modal-close waves-effect waves-blue white-text center blue darken-4 btn-flat" type="submit" name="action">Confirmar </button>
	    </div>
  </form>
  </div>
<?php } ?>

</div>

