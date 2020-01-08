
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

            <?php foreach ($grupotrabalho as $gt) { ?>
            	<h5><?php echo '<strong>' . $gt->titulo . '</strong>'; ?></h5>
            	<h6><?php echo 'Coordenador: '. $gt->nome; ?></h6>

            <?php } ?>

        			<table class="bordered responsive-table">
				         <thead>
				          <tr>
							  <th width="5%" class="center-align">#</th>
							  <th width="40%">Título</th>
							  <th width="35%" class="left-align">Autor</th>
							  <th width="20%" class="center-align">Funções</th>
				          </tr>
				        </thead>
				        <tbody>

				        <?php if(count($listagem) <= 0){
				        	echo '<tr>
				        	<td colspan="3"><h6>Nenhum Resumo Expandido publicado para esse Grupo de Trabalho</h6></td>
				        	</tr>';
				        } ?>

				        <?php foreach ($listagem as $list) { ?>
				          	<tr>
								<td class="">
									<?php if($list->certificado == '0'){ ?>
										<a href="<?php echo base_url('artigos/certificado') . "/" . $list->Artigo_id; ?>" class="btn btn-small tooltipped waves-effect waves-red red darken-4" data-position="top" data-delay="50" data-tooltip="Gerar certificado"><i class="small material-icons">access_alarms</i></a>
									<?php }else{ ?>
										<a class="btn btn-small tooltipped waves-effect waves-green light-green darken-4" data-position="top" data-delay="50" data-tooltip="Certificado gerado com sucesso"><i class="fa fa-check-circle-o" aria-hidden="true"></i></a>
									<?php } ?>
								</td>
					            <td class="left-align">
					            	<?php echo $list->titulo; ?>
					            </td>
					            <td class="left-align">
					            	<?php echo $list->nome; ?>
					            </td>
					            <td class="center-align">

					            	<a href="<?php echo base_url('uploads/files') . '/'. $list->arquivo; ?>" class="btn btn-small tooltipped waves-effect waves-orange orange" data-position="top" data-delay="50" data-tooltip="Visualizar Resumo Expandido" target="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>

					            	<script>
					            	$(document).ready(function() {
					            		$('#modal-parecer<?php echo $list->artigoID; ?>').modal();
					            	});
					            	</script>

					            	<button data-target="modal-parecer<?php echo $list->artigoID; ?>" class="btn btn-small tooltipped waves-effect waves-orange orange darken-3 modal-trigger" data-position="top" data-delay="50" data-tooltip="Enviar Parecer"><i class="fa fa-file-text-o" aria-hidden="true"></i></button>

					            	<a href="<?php echo base_url('artigos/editar') . "/" . $list->artigoID; ?>"" class="btn btn-small tooltipped waves-effect waves-blue blue darken-4" data-position="top" data-delay="50" data-tooltip="Editar Resumo Expandido"><i class="small material-icons">edit</i></a>

					            	<script>
					            	$(document).ready(function() {
					            		$('#modal<?php echo $list->artigoID; ?>').modal();
					            	});
					            	</script>

					            	<button data-target="modal<?php echo $list->artigoID; ?>" class="btn btn-small tooltipped waves-effect waves-red red darken-4 modal-trigger" data-position="top" data-delay="50" data-tooltip="Excluir Resumo Expandido"><i class="small material-icons">delete_forever</i></button>

					            </td>
				            </tr>
							<?php } ?>			
				        </tbody>
				    </table>

            </div> <!-- DIV CARD-CONTENT -->
          </div>
          <div class="row  center-align">
					<a href='javascript:history.back(-1)' class="waves-effect waves-light btn grey darken-1">Voltar</a>
	      </div>
        </div>
  </div>

  <?php foreach ($listagem as $list) { ?>
  <!-- Modal Structure -->
  <div id="modal<?php echo $list->artigoID; ?>" class="modal">
  <form action="<?php echo base_url() . $this->uri->segment(1); ?>/removeartigo/<?php echo $list->artigoID; ?>" method="post">
	    <div class="modal-content">
	      <h4><strong>Confirmar Remoção ?</strong></h4>
	      <p>Remover o Resumo Expandido <?php echo $list->titulo; ?>
	      </p>	
	    </div>
	    <div class="modal-footer">
	      <button type="reset" class="modal-close waves-effect waves-green grey lighten-1 btn-flat">Cancelar </button>
	      <button class="modal-action modal-close waves-effect waves-blue white-text center blue darken-4 btn-flat" type="submit" name="action">Confirmar </button>
	    </div>
  </form>
  </div>
  <?php } ?>


  <?php foreach ($listagem as $list) { ?>
  <!-- Modal Structure -->
  <div id="modal-parecer<?php echo $list->artigoID; ?>" class="modal">
  <form action="<?php echo base_url() . $this->uri->segment(1); ?>/cartaaceite/<?php echo $list->artigoID; ?>" method="post" enctype="multipart/form-data">
	    <div class="modal-content">
	      <h4><strong>Emitir Parecer</strong></h4>
	      <div class="row">

			<div class="input-field col s12 m6 l6">
            	<div class="row">
			       	<div class="input-field col s12 m12 l12">
					    <select name="situacao" id="selector" required>
					      <option value="" disabled selected>Escolha sua opção</option>
					      <option value="1" <?php echo ($list->situacao == '1') ? 'selected="selected"' : ''; ?>>Aprovado</option>
					      <option value="2" <?php echo ($list->situacao == '2') ? 'selected="selected"' : ''; ?>>Aprovado com ressalvas</option>
					      <option value="3" <?php echo ($list->situacao == '3') ? 'selected="selected"' : ''; ?>>Reprovado</option>
					    </select>
					    <label>Situação</label>
				  	</div>
		      	</div>
		    </div>

		    <div class="file-field input-field  col s12 m6 l6" style="padding-top: 2.1%;">
		      <div class="btn">
		        <span>Carta de Aceite</span>
		        <input name="userfile" type="file">
		      </div>
		      <div class="file-path-wrapper">
		        <input class="file-path validate" type="text">
		      </div>
		    </div>

	   	  	<div class="input-field col s12 m12 l12">
	        	<textarea name="parecer" id="parecer" class="materialize-textarea"><?php echo $list->parecer; ?></textarea>
				<label for="parecer">Texto do parecer</label>
          	</div>
	      	
		  </div>	
	    </div>

	    <div class="modal-footer">
	      <button type="reset" class="modal-close waves-effect waves-grey grey lighten-1 btn-flat">Cancelar </button>
	      <button class="modal-action modal-close waves-effect waves-blue white-text center blue darken-4 btn-flat" type="submit" name="action">Enviar </button>
	    </div>
  </form>
  </div>
  <?php } ?>


</div>

