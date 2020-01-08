
<div class="container" style="margin-top: 2%;">
	
	<div class="row">
        <div class="col s12 m12">
          <div class="card white">
            <div class="card-action grey lighten-2">
              <a href="#" class="card-content black-text"><strong>Novo Artigo</strong></a>
            </div>
            <div class="card-content black-text"> <!-- DIV CARD-CONTENT -->

            <div class="row">
            		<form action="<?php echo base_url() . $this->uri->segment(1); ?>/cadastrar/" method="post" class="col s12 m12 l12" enctype="multipart/form-data">

				   	  <?php echo validation_errors(); ?>

				      <div class="row">
			        	<div class="input-field col s12">
						    <select name="grupotrabalho" required>
						      <option value="" disabled selected>Grupo de Trabalho</option>
						      <?php foreach ($listagem as $list) {
						      	echo '<option value="' . $list-> id . '">' . $list->titulo . ' - Coord.: ' . $list->nome . '</option>';
						      } ?>
						    </select>
						    <label>Grupo de Trabalho</label>
					  	</div>
				      </div>

				      <div class="row">
						<div class="input-field col s12 m12 l12">
				          <input name="titulo" value="<?php echo set_value('titulo'); ?>" id="titulo" type="text" class="validate">
				          <label for="titulo">Título do Artigo</label>
				        </div>
				       </div>
				       
				       <div class="row">
				        <div class="input-field col s12 m11 l11">
				          <input name="coautor1" value="<?php echo set_value('coautor1'); ?>" id="coautor1" type="text" class="validate" onblur="buscarcoautor1()">
				          <label for="coautor1">Coautor 1</label>
				        </div>
				      	<div class="input-field col s12 m1 l1">
				          <input name="coautor1_cod" value="<?php echo set_value('coautor1_cod'); ?>" id="coautor1_cod" type="text" class="validate white-text white" readonly>
				          <label for="coautor1_cod"></label>
				        </div>
				        <div class="input-field col s12 m11 l11">
				          <input name="coautor2" value="<?php echo set_value('coautor2'); ?>" id="coautor2" type="text" class="validate" onblur="buscarcoautor2()">
				          <label for="coautor2">Coautor 2</label>
				        </div>
				      	<div class="input-field col s12 m1 l1">
				          <input name="coautor2_cod" value="<?php echo set_value('coautor2_cod'); ?>" id="coautor2_cod" type="text" class="validate white-text white" readonly>
				          <label for="coautor2_cod"></label>
				        </div>
				        <div class="input-field col s12 m11 l11">
				          <input name="coautor3" value="<?php echo set_value('coautor3'); ?>" id="coautor3" type="text" class="validate" onblur="buscarcoautor3()">
				          <label for="coautor3">Coautor 3</label>
				        </div>
				      	<div class="input-field col s12 m1 l1">
				          <input name="coautor3_cod" value="<?php echo set_value('coautor3_cod'); ?>" id="coautor3_cod" type="text" class="validate white-text white" readonly>
				          <label for="coautor3_cod"></label>
				        </div>
				      </div>

				      <div class="row">
				      	<div class="file-field input-field  col s12 m12 l12">
					      <div class="btn">
					        <span>artigo</span>
					        <input name="userfile" type="file">
					      </div>
					      <div class="file-path-wrapper">
					        <input class="file-path validate" type="text">
					      </div>
					    </div>
					  </div>

					  <div class="row  center-align">
							<a href='<?php echo base_url('artigos/'); ?>' class="waves-effect waves-light btn grey darken-1">Cancelar</a>
							<button class="btn waves-effect waves-light blue darken-3" type="submit">Submeter <i class="material-icons right">send</i></button>
				      </div>

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

$(document).ready(function () {
	$('#coautor2').autocomplete({
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

$(document).ready(function () {
	$('#coautor3').autocomplete({
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

