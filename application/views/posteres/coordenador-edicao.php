
<div class="container" style="margin-top: 2%;">
	
	<div class="row">
        <div class="col s12 m12">
          <div class="card white">
            <div class="card-action grey lighten-2">
              <a href="#" class="card-content black-text"><strong>Editar coordenação</strong></a>
            </div>
            <div class="card-content black-text"> <!-- DIV CARD-CONTENT -->
		   	  
		   	<?php foreach ($listagem as $list) { ?>

            <div class="row">
            		<form action="<?php echo base_url() . $this->uri->segment(1); ?>/coordenacaoeditado/<?php echo $list->gtID; ?>" method="post" class="col s12 m12 l12">

				   	  <?php echo validation_errors(); ?>
				       
				      <div class="row">
						<div class="input-field col s12 m12 l12">
				          <input name="titulo" value="<?php echo $list->titulo; ?>" id="titulo" type="text" class="validate">
				          <label for="titulo">Coordenação</label>
				        </div>
				       </div>

					  <div class="row  center-align">
							<a href='<?php echo base_url('posteres/coordenacao'); ?>' class="waves-effect waves-light btn grey darken-1">Cancelar</a>
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

