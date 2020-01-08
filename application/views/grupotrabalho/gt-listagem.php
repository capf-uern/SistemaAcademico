
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
				              <th width="80%">Descrição</th>
				              <th width="20%" class="center-align">Funções</th>
				              
				          </tr>
				        </thead>

				        <tbody>

				        <?php foreach ($listagem as $list) { ?>
				        	
				          <tr>
				            <td><?php echo $list->titulo; ?></td>
				            </td>
				            <td class="right-align">

				            	<a href="<?php echo base_url('grupotrabalho/detalhes') . "/" . $list->id; ?>" class="btn btn-small tooltipped waves-effect waves-orange orange darken-3" data-position="top" data-delay="50" data-tooltip="Listar Resumos Expandidos"><i class="small material-icons">format_list_numbered</i></i></a>

				            	<a href="<?php echo base_url('grupotrabalho/editargt') . "/" . $list->id; ?>"" class="btn btn-small tooltipped waves-effect waves-blue blue darken-4" data-position="top" data-delay="50" data-tooltip="Editar Grupo de Trabalho"><i class="small material-icons">edit</i></a>

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

