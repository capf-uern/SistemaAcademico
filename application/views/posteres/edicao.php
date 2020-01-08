
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

            <?php foreach ($listagem as $list) { ?>

            <div class="row">
            		<form action="<?php echo base_url() . $this->uri->segment(1); ?>/editado/<?php echo $list->posterID; ?>" method="post" class="col s12 m12 l12">

				   	  <?php echo validation_errors(); ?>

				       <div class="row">
			        	<div class="input-field col s12">
						    <select name="grupotrabalho" required>
						      <option value="" disabled selected>Grupo de Trabalho</option>
						      <?php foreach ($gt as $listgt) { ?>
						      	<option value="<?php echo $listgt-> id; ?>" <?php echo ($list->Grupo_Posteres_id == $listgt->id) ? 'selected="selected"' : ''; ?>><?php echo $listgt->titulo . ' - Coord.: ' . $listgt->nome . '</option>';
						      } ?>
						    </select>
						    <label>Grupo de Trabalho</label>
					  	</div>
				      </div>

				      <div class="row">
						<div class="input-field col s12 m12 l12">
				          <input name="titulo" value="<?php echo $list->posterTitulo; ?>" id="titulo" type="text" class="validate">
				          <label for="titulo">Título do Pôster</label>
				        </div>
				       </div>
				       
				      <div class="input-field col s12 m12 l12">
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

					  <div class="row  center-align">
							<a href='javascript:history.back(-1)' class="waves-effect waves-light btn grey darken-1">Cancelar</a>
							<button class="btn waves-effect waves-light blue darken-3" type="submit" name="action">Atualizar <i class="material-icons right">send</i></button>
							
				      </div>

				    </form>

				    <?php } ?>

				  </div>
			</div>

            </div> <!-- DIV CARD-CONTENT -->
          </div>
        </div>
  </div>


</div>

<script>
$(document).ready(function () {
	$('#ministrante').autocomplete({
    data: {

    <?php foreach ($nomes as $name) { 

      	echo "\"" . $name->nome . "\": null,";

    } ?>


    },
    limit: 20, // The max amount of results that can be shown at once. Default: Infinity.
    onAutocomplete: function(val) {
      // Callback function when value is autcompleted.
    },
    minLength: 1, // The minimum length of the input for the autocomplete to start. Default: 1.
  });
});

  </script>

