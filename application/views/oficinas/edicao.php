
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
            		<form action="<?php echo base_url() . $this->uri->segment(1); ?>/editado/<?php echo $list->id_oficina; ?>" method="post" class="col s12 m12 l12">

				   	  <?php echo validation_errors(); ?>

				      <div class="row">
				        <div class="input-field col s12 m9 l9">
				          <input name="titulo" id="titulo" type="text" class="validate" value="<?php echo $list->titulo; ?>" required>
				          <label for="titulo">Título</label>
				        </div>
				        <div class="input-field col s12 m3 l3">
				          <input name="data" id="data" type="text" class="validate" pattern="\[0-9]{2}/[0-9]{2}/[0-9]{4} [0-9]{2}:[0-9]{2}:[0-9]{2}" value="<?php echo dataetempo($list->data); ?>" data-mask = "00/00/0000 00:00:00"  data-mask-selectonfocus = "true" required>
				          <label for="data">Data</label>
				        </div>
				      </div>

				      <div class="row">
				        <div class="input-field col s12 m12 l12">
				         	<textarea name="descricao" id="descricao" class="materialize-textarea"><?php echo $list->descricao; ?></textarea>
          					<label for="descricao">Descrição do evento</label>
				        </div>
						<div class="input-field col s12 m8 l8">
				          <input name="local" value="<?php echo $list->local; ?>" id="local" type="text" class="validate">
				          <label for="local">Local</label>
				        </div>
				        <div class="input-field col s12 m2 l2">
				          <input name="carga_horaria" value="<?php echo $list->carga_horaria; ?>" id="carga_horaria" type="text" class="validate">
				          <label for="carga_horaria">Carga Horária</label>
				        </div>
				        <div class="input-field col s12 m2 l2">
				          <input name="vagas" value="<?php echo $list->vagas; ?>" id="vagas" type="text" class="validate">
				          <label for="vagas">Vagas</label>
				        </div>
				       </div>
				       
				       <div class="row">
				        <div class="input-field col s12 m11 l11">
				          <input name="ministrante" value="<?php echo $list->nome; ?>" id="ministrante" type="text" class="validate" onblur="buscarDestinatario()">
				          <label for="ministrante">Ministrante</label>
				        </div>
				      	<div class="input-field col s12 m1 l1">
				          <input name="ministrante_cod" value="<?php echo $list->Usuario_id; ?>" id="ministrante_cod" type="text" class="validate" readonly>
				          <label for="ministrante_cod"></label>
				        </div>
				        <div class="input-field col s12 m12 l12">
				          <textarea name="curriculo" id="curriculo" class="materialize-textarea"><?php echo $list->Usuario_id_curriculo; ?></textarea>
          					<label for="curriculo">Currículo</label>
				        </div>
				      </div>

					  <div class="row  center-align">
							<a href='<?php echo base_url() . $this->uri->segment(1); ?>/listagem' class="waves-effect waves-light btn grey darken-1">Cancelar</a>
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

