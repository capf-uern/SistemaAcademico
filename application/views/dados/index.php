
<div class="container" style="margin-top: 2%;">
	
	<div class="row">
        <div class="col s12 m12">
          <div class="card white">
            <div class="card-action grey lighten-2">
              <a href="#" class="card-content black-text"><strong><?php echo $titulo; ?></strong></a>
            </div>
            <div class="card-content black-text"> <!-- DIV CARD-CONTENT -->

            	<div class="row">
            		<form action="<?php echo base_url() . $this->uri->segment(1); ?>/atualizar/" method="post" class="col s12 m12 l12">

				   	  <?php echo validation_errors(); ?>

				   	  <?php foreach ($listagem as $list) { ?>

				      <div class="row">
				        <div class="input-field col s12 m3 l3">
				          <input name="cpf" id="cpf" type="text" class="validate" pattern="\[0-9]{3}.[0-9]{3}.[0-9]{3}-[0-9]{2}" data-mask = "000.000.000-00"  data-mask-selectonfocus = "true" value="<?php echo $list->cpf; ?>" required disabled>
				          <label for="cpf">CPF</label>
				        </div>
				        <div class="input-field col s12 m9 l9">
				          <input name="nome_completo" id="nome_completo" type="text" class="validate" value="<?php echo $list->nome; ?>" required>
				          <label for="nome_completo">Nome Completo</label>
				        </div>
				      </div>

				      <div class="row">
				        <div class="input-field col s12 m8 l8">
				          <input name="instituicao" value="<?php echo $list->instituicao; ?>" id="instituicao" type="text" class="validate">
				          <label for="instituicao">Nome da instituição</label>
				        </div>
				        <?php if($list->tipo_cadastro == 5){ ?>
						<div class="input-field col s12 m4 l4">
				          <input name="profissao" value="<?php echo $list->profissao; ?>" id="profissao" type="text" class="validate">
				          <label for="profissao">Profissão</label>
				        </div>
				        <?php } ?>
				      </div>

				      <div class="row">
				      	<div class="input-field col s12 m12 l12">
				          <input name="interesse" value="<?php echo $list->area_interesse; ?>" id="interesse" type="text" class="validate">
				          <label for="interesse">Área de Interesse</label>
				        </div>
				      </div>

				      <div class="row">
				      	<div class="input-field col s12 m1 l1">
				          <input name="telefone_ddd" value="<?php echo $list->ddd; ?>" id="telefone_ddd" type="text" class="validate" required>
				          <label for="telefone_ddd">DDD</label>
				        </div>
				      	<div class="input-field col s12 m4 l4">
				          <input name="telefone" value="<?php echo $list->telefone; ?>" id="telefone" type="text" class="validate" pattern="\[0-9]{5}-[0-9]{4}" data-mask = "00000-0000"  data-mask-selectonfocus = "true" required>
				          <label for="telefone">Telefone</label>
				        </div>
						<div class="input-field col s12 m7 l7">
				          <input name="email" value="<?php echo $list->email; ?>" id="email" type="email" class="validate" disabled  required>
			              <label for="email" data-error="E-mail Inválido" data-success="right">Email</label>
				        </div>
				      </div>

				      <div class="row">
				      	<div class="input-field col s12 m6 l6">
				          <input name="senha" value="" id="senha" type="password" class="validate">
				          <label for="senha">Senha</label>
				        </div>
				      </div>
				     
					  <div class="row  center-align">
							<button class="btn waves-effect waves-light blue darken-3" type="submit" name="action">Atualizar <i class="material-icons right">send</i></button>
				      </div>

				      <?php } ?>

				    </form>
				  </div>

            </div> <!-- DIV CARD-CONTENT -->
          </div>
        </div>
  </div>


</div>

