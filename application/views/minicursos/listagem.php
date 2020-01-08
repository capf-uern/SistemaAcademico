
<div class="container" style="margin-top: 2%;">

	<div class="row">
		<div class="col s12 m6 l6">
			<?php echo $titulo; ?>
		</div>
		
		<div class="col s12 m6 l6">
				<a href='<?php echo base_url('minicursos/cadastro'); ?>' class="waves-effect waves-light green accent-4
 btn right"><i class="material-icons right">add_circle</i> Novo Minicurso </a>

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
				              <th width="40%">Título</th>
				              <th width="35%" class="left-align">Ministrante</th>
				              <th width="10%" class="center-align">Vagas</th>
				              <th width="15%" class="center-align">Funções</th>
				              
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
				            	<?php echo $this->listagem->contarInscritos($list->id_minicurso) . '/' .
				            	$list->vagas; ?>
				            </td>
				            <td class="right-align">

				            	<a href="<?php echo base_url('minicursos/listar') . "/" . $list->id_minicurso; ?>" class="btn btn-small tooltipped waves-effect waves-orange orange darken-3" data-position="top" data-delay="50" data-tooltip="Listar Participantes"><i class="small material-icons">format_list_numbered</i></i></a>

				            	<a href="<?php echo base_url('minicursos/editar') . "/" . $list->id_minicurso; ?>"" class="btn btn-small tooltipped waves-effect waves-blue blue darken-4" data-position="top" data-delay="50" data-tooltip="Editar Minicurso"><i class="small material-icons">edit</i></a>
				            	
				            	<script>
				            	$(document).ready(function() {
				            		$('#modal<?php echo $list->id_minicurso; ?>').modal();
				            	});
				            	</script>

				            	<button data-target="modal<?php echo $list->id_minicurso; ?>" class="btn btn-small tooltipped waves-effect waves-red red darken-4 modal-trigger" data-position="top" data-delay="50" data-tooltip="Excluir Minicurso"><i class="small material-icons">delete_forever</i></button>

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

