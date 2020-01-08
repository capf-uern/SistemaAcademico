
<div class="container" style="margin-top: 2%;">

	<div class="row">
		<div class="col s12 m6 l6">
			<?php echo $titulo; ?>
		</div>
		
		<div class="col s12 m6 l6">
				<button data-target="modal-pesquisa" class="waves-effect waves-light blue darken-3 btn right modal-trigger">Pesquisar <i class="material-icons right">pageview</i></button>
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
				              <th width="55%">Nome</th>
				              <th width="15%" class="right-align">Status</th>
				              <th width="30%" class="center-align">Funções</th>
				          </tr>
				        </thead>

				        <tbody>

				        <?php foreach ($listagem as $list) { ?>
				        	
				          <tr>
				            <td>

								<?php if($list->presente == '0'){ ?>
									<a href="<?php echo base_url('dados/presente') . "/" . $list->id; ?>" class="btn btn-small tooltipped waves-effect waves-red red darken-4" data-position="top" data-delay="50" data-tooltip="Participação no evento"><i class="small material-icons">access_alarms</i></a>
								<?php }else{ ?>
									<a class="btn btn-small tooltipped waves-effect waves-green light-green darken-4" data-position="top" data-delay="50" data-tooltip="Participação confirmada"><i class="fa fa-check-circle-o" aria-hidden="true"></i></a>
								<?php } ?>

								<?php echo $list->cpf . " - " . $list->nome; ?></td>
				            <td class="center-align">
				            	<?php 
					            	if($list->liberado == '1'){
					            		echo '<span class="badge blue darken-1 white-text">Ativo</span>';
					            	}else{
					            		echo '<span class="badge teal darken-3 white-text">Pendente</span>';
					            	}
				            	?>
				            </td>
				            <td class="right-align">

								<?php if($list->chamada == '1'){ ?>
									<a class="btn btn-small tooltipped waves-effect waves-lime lime darken-4" data-position="top" data-delay="50" data-tooltip="1ª chamada">1ª</a>
								<?php }else{ ?>
									<a class="btn btn-small tooltipped waves-effect waves-blue blue darken-4" data-position="top" data-delay="50" data-tooltip="2ª chamada">2ª</a>
								<?php } ?>

				            	<a href="<?php echo base_url('uploads/files') . '/'. $list->comprovante_matricula; ?>" class="btn btn-small tooltipped waves-effect waves-orange orange darken-3" data-position="top" data-delay="50" data-tooltip="Certidão de Vínculo" target="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
				            	
				            	<?php if(isset($list->comprovante_pagamento)){ ?>
				            	<a href="<?php echo base_url('uploads/files') . '/'. $list->comprovante_pagamento; ?>" class="btn btn-small tooltipped waves-effect waves-orange orange" data-position="top" data-delay="50" data-tooltip="Comprovante Pagamento" target="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
				            	<?php }else{ ?>
				            	<a href="<?php echo base_url('uploads/files') . '/'. $list->comprovante_pagamento; ?>" class="btn btn-small tooltipped waves-effect waves-orange orange disabled" data-position="top" data-delay="50" data-tooltip="Comprovante Pagamento" target="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
				            	<?php } ?>
				            	
				            	<?php if($list->liberado == '0'){ ?>
				            		<a href="<?php echo base_url('dados/liberar') . "/" . $list->id; ?>" class="btn btn-small tooltipped waves-effect waves-teal deep-orange" data-position="top" data-delay="50" data-tooltip="Liberar Cadastro"><i class="small material-icons">access_alarms</i></a>
				            	<?php }else{ ?>
				            		<a class="btn btn-small tooltipped waves-effect waves-teal teal darken-2" data-position="top" data-delay="50" data-tooltip="Cadastro Liberado"><i class="fa fa-check-circle-o" aria-hidden="true"></i></a>
				            	<?php } ?>
				            	
				            	<a href="<?php echo base_url('dados/editar') . "/" . $list->id; ?>"" class="btn btn-small tooltipped waves-effect waves-blue blue darken-4" data-position="top" data-delay="50" data-tooltip="Editar Dados"><i class="small material-icons">edit</i></a>

				            	<a href="<?php echo base_url('dados/resetar') . "/" . $list->id; ?>" class="btn btn-small tooltipped waves-effect waves-red red darken-4" data-position="top" data-delay="50" data-tooltip="Resetar Senha"><i class="fa fa-undo" aria-hidden="true"></i></a>
				            	
				            	<script>
				            	$(document).ready(function() {
				            		$('#modal<?php echo $list->id; ?>').modal();
				            	});
				            	</script>

				            	<button data-target="modal<?php echo $list->id; ?>" class="btn btn-small tooltipped waves-effect waves-red red darken-4 modal-trigger" data-position="top" data-delay="50" data-tooltip="Excluir Participante"><i class="small material-icons">delete_forever</i></button>

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

  <?php if($paginacao){ ?>
  <div class="row">
        <div class="col s12 m12">
          <div class="card white">
            <div class="card-content black-text"> <!-- DIV CARD-CONTENT -->

            	<?php echo $paginacao; ?>

			</div> <!-- DIV CARD-CONTENT -->
          </div>
        </div>
  </div>
  <?php } ?>


  <!-- Modal Structure -->
  <div id="modal-pesquisa" class="modal">
  <form action="<?php echo base_url() . $this->uri->segment(1); ?>/pesquisar/" method="post">
	    <div class="modal-content">
	      <h5>Pesquisar Participante</h5>
	      	<div class="input-field col s6">
	          <input name="pesquisar" id="pesquisar" type="text" class="validate" required>
	          <label for="pesquisar">Digite o nome</label>
	        </div>
	    </div>
	    <div class="modal-footer">
	      <button class="modal-action modal-close waves-effect waves-green btn-flat" type="submit" name="action">Pesquisar </button>
	    </div>
  </form>
  </div>

<?php foreach ($listagem as $list) { ?>
  <!-- Modal Structure -->
  <div id="modal<?php echo $list->id; ?>" class="modal">
  <form action="<?php echo base_url() . $this->uri->segment(1); ?>/excluir/<?php echo $list->id; ?>" method="post">
	    <div class="modal-content">
	      <h4><strong>Confirmar Exclusão ?</strong></h4>
	      <p>Excluir os dados do participante: <br><h5><strong><?php echo $list->nome; ?></strong></h5>
	      <p>CPF: <?php echo $list->cpf; ?></p>
	    </div>
	    <div class="modal-footer">
	      <button type="reset" class="modal-close waves-effect waves-green grey lighten-1 btn-flat">Cancelar </button>
	      <button class="modal-action modal-close waves-effect waves-blue white-text center blue darken-4 btn-flat" type="submit" name="action">Confirmar </button>
	    </div>
  </form>
  </div>
<?php } ?>

</div>

