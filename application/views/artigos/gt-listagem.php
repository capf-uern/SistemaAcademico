
<div class="container" style="margin-top: 2%;">

	<div class="row">
		<div class="col s12 m6 l6">
			<?php echo $titulo; ?>
		</div>
		
		<div class="col s12 m6 l6">
				<a href='<?php echo base_url('artigos/criargt'); ?>' class="waves-effect waves-light green accent-4
 btn right"><i class="material-icons right">add_circle</i> Grupo de Trabalho </a>

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
				              <th width="43%">Descrição</th>
				              <th width="38%" class="left-align">Coordenador</th>
				              <th width="19%" class="center-align">Funções</th>
				              
				          </tr>
				        </thead>

				        <tbody>

				        <?php foreach ($listagem as $list) { ?>
				        	
				          <tr>
				            <td><?php echo $list->titulo; ?></td>
				            <td class="left-align">
				            	<?php echo $list->nome; ?>
				            </td>
				            <td class="right-align">

				            	<a href="<?php echo base_url('artigos/detalhes') . "/" . $list->id; ?>" class="btn btn-small tooltipped waves-effect waves-orange orange darken-3" data-position="top" data-delay="50" data-tooltip="Listar Resumo Expandido"><i class="small material-icons">format_list_numbered</i></i></a>

				            	<a href="<?php echo base_url('artigos/editargt') . "/" . $list->id; ?>"" class="btn btn-small tooltipped waves-effect waves-blue blue darken-4" data-position="top" data-delay="50" data-tooltip="Editar Grupo de Trabalho"><i class="small material-icons">edit</i></a>

				            	<script>
					            	$(document).ready(function() {
					            		$('#modal<?php echo $list->id; ?>').modal();
					            	});
				            	</script>

				            	<button data-target="modal<?php echo $list->id; ?>" class="btn btn-small tooltipped waves-effect waves-red red darken-4 modal-trigger" data-position="top" data-delay="50" data-tooltip="Remover Grupo de Trabalho"><i class="small material-icons">delete_forever</i></button>
				            	
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
  <div id="modal<?php echo $list->id; ?>" class="modal">
  <form action="<?php echo base_url() . $this->uri->segment(1); ?>/removegt/<?php echo $list->id; ?>" method="post">
	    <div class="modal-content">
	      <h4><strong>Confirmar Remoção ?</strong></h4>
	      <p>Remover o Grupo de Trabalho <?php echo $list->titulo; ?>
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

