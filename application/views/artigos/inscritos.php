
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

            	<?php foreach ($curso as $lista) { 
            		$nome_minicurso = $lista->titulo;
            	}?>

        			<table class="striped bordered responsive-table">
        				<div class="card-panel grey lighten-2"><h5 style="margin: 0;"><strong><?php echo $nome_minicurso; ?></strong></h5></div>

				<?php 
		        if(count($listagem) == 0){

		        	echo '<tr><td>Nenhum participante inscrito.<td></tr>';

		        }else{ ?>
        				
				        <thead>
				          <tr>
				              <th width="2%" class="left-align">#</th>
				              <th width="33%" class="left-align">Nome</th>
				              <th width="45%" class="left-align">Assinatura</th>
				              <th width="10%" class="center-align"></th>
				              
				          </tr>
				        </thead>

				        <tbody>

				        <?php //echo var_dump($listagem); ?>



					    <?php 

					    $i = 1;
					    foreach ($listagem as $list) { ?>
					        	
					          <tr>
					          	<td><strong><?php echo $i; ?></strong></td>
					            <td class="left-align">
					            	<?php echo $list->nome; ?>
					            </td>
					            <td class="center-align">
					            	
					            </td>
					            <td class="right-align">

					            <?php if($list->presente !='1'){ ?>
					            	<a href="<?php echo base_url('minicursos/presente') . "/" . $list->id_usuario; ?>/<?php echo $list->Minicurso_id; ?>" class="btn btn-small tooltipped waves-effect waves-teal deep-orange" data-position="top" data-delay="50" data-tooltip="Confirmar Participação"><i class="small material-icons">access_alarms</i></a>
					            <?php }else{  ?>
					            	<a class="btn btn-small tooltipped waves-effect waves-teal teal darken-2" data-position="top" data-delay="50" data-tooltip="Participação Confirmada"><i class="fa fa-check-circle-o" aria-hidden="true"></i></a>
								<?php } ?>

					            	<script>
					            	$(document).ready(function() {
					            		$('#modal<?php echo $list->Usuario_id; ?>').modal();
					            	});
					            	</script>

					            	<button data-target="modal<?php echo $list->Usuario_id; ?>" class="btn btn-small tooltipped waves-effect waves-red red darken-4 modal-trigger" data-position="top" data-delay="50" data-tooltip="Remover Inscrição"><i class="small material-icons">delete_forever</i></button>

					            </td>
					          </tr>

				        	<?php $i++; } //foreach ?>
				        </tbody>
				        <?php } //if ?>
				    </table>

				</div>

            </div> <!-- DIV CARD-CONTENT -->


          </div>
             <div class="row  center-align">
					<a href='<?php echo base_url() . $this->uri->segment(1); ?>/listagem' class="waves-effect waves-light btn grey darken-1">Voltar</a>
		      </div>
        </div>
  </div>

<?php foreach ($listagem as $list) { ?>
  <!-- Modal Structure -->
  <div id="modal<?php echo $list->Usuario_id; ?>" class="modal">
  <form action="<?php echo base_url() . $this->uri->segment(1); ?>/removeInscricao/<?php echo $list->id_usuario; ?>/<?php echo $list->Minicurso_id; ?>" method="post">
	    <div class="modal-content">
	      <h4><strong>Confirmar Remoção ?</strong></h4>
	      <p>Remover o participante do Minicurso <?php echo $list->titulo; ?>: <br><h5><strong><?php echo $list->nome; ?></strong></h5>
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

