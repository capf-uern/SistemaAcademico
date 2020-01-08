
<div class="container" style="margin-top: 2%;">
	
	<div class="row">
        <div class="col s12 m12">
          <div class="card white">
            <div class="card-action grey lighten-2">
              <a href="#" class="card-content black-text"><strong>Editar grupo de trabalho</strong></a>
            </div>
            <div class="card-content black-text"> <!-- DIV CARD-CONTENT -->
		   	  
		   	<?php foreach ($listagem as $list) { ?>

            <div class="row">
            		<form action="<?php echo base_url() . $this->uri->segment(1); ?>/editadogt/<?php echo $list->gtID; ?>" method="post" class="col s12 m12 l12">

				   	  <?php echo validation_errors(); ?>
				       
				       <div class="row">
				        <div class="input-field col s12 m11 l11">
				          <input name="coordenador" value="<?php echo $list->nome; ?>" id="coautor1" type="text" class="validate" onblur="buscarcoautor1()">
				          <label for="coautor1">Coordenador</label>
				        </div>
				      	<div class="input-field col s12 m1 l1">
				          <input name="coordenador_cod" value="<?php echo $list->id; ?>" id="coautor1_cod" type="text" class="validate white-text white" readonly>
				          <label for="coautor1_cod"></label>
				        </div>
				      </div>
				      
				      <div class="row">
						<div class="input-field col s12 m12 l12">
				          <input name="titulo" value="<?php echo $list->titulo; ?>" id="titulo" type="text" class="validate">
				          <label for="titulo">Grupo de Trabalho</label>
				        </div>
				       </div>

					  <div class="row  center-align">
							<a href='<?php echo base_url('artigos/listagem'); ?>' class="waves-effect waves-light btn grey darken-1">Cancelar</a>
							<button class="btn waves-effect waves-light blue darken-3" type="submit">Alterar <i class="material-icons right">send</i></button>
				      </div>
				      <?php } ?>
				    </form>
				  </div>
			</div>

            </div> <!-- DIV CARD-CONTENT -->
          </div>
        </div>
  </div>


</div>

<script>
$(document).ready(function () {
	$('#coautor1').autocomplete({
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

