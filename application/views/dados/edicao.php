
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
            		<form action="<?php echo base_url() . $this->uri->segment(1); ?>/editado/<?php echo $list->id; ?>" method="post" class="col s12 m12 l12">

				   	  <div class="row">
						<div class="input-field col s12 m12 l12">
					   	  	<fieldset>
			            	<legend><strong>&nbsp Tipo de Cadastro &nbsp</strong></legend>
			            	<div class="row">
							       	<div class="input-field col s12 m12 l12">
									    <select name="opcao" id="selector" required>
									      <option value="" disabled selected>Escolha sua opção</option>
									      <option value="1" <?php echo ($list->tipo_cadastro == '1') ? 'selected="selected"' : ''; ?>>Professor Universitário</option>
									      <option value="2" <?php echo ($list->tipo_cadastro == '2') ? 'selected="selected"' : ''; ?>>Aluno de Pós-Graduação</option>
									      <option value="3" <?php echo ($list->tipo_cadastro == '3') ? 'selected="selected"' : ''; ?>>Aluno de Graduação</option>
									      <option value="4" <?php echo ($list->tipo_cadastro == '4') ? 'selected="selected"' : ''; ?>>Técnico Administrativo</option>
									      <option value="5" <?php echo ($list->tipo_cadastro == '5') ? 'selected="selected"' : ''; ?>>Demais Profissionais</option>
									    </select>
									    <label>Tipo de Cadastro</label>
								  	</div>
					      	</div>
					    	</fieldset>
					    </div>
				   	  </div>

				   	  <?php echo validation_errors(); ?>

				      <div class="row">
				        <div class="input-field col s12 m3 l3">
				          <input name="cpf" id="cpf" type="text" class="validate" data-mask = "000.000.000-00"  data-mask-selectonfocus = "true" value="<?php echo $list->cpf; ?>" required>
				          <label for="cpf">CPF</label>
				        </div>
				        <div class="input-field col s12 m9 l9">
				          <input name="nome_completo" id="nome_completo" type="text" class="validate" value="<?php echo $list->nome ?>" required>
				          <label for="nome_completo">Nome Completo</label>
				        </div>
				      </div>

				      <div class="row">
				        <div class="input-field col s12 m8 l8">
				          <input name="instituicao" value="<?php echo $list->instituicao; ?>" id="instituicao" type="text" class="validate">
				          <label for="instituicao">Nome da instituição</label>
				        </div>
						<div class="input-field col s12 m4 l4" id="profissionais">
				          <input name="profissao" value="<?php echo $list->profissao; ?>" id="profissao" type="text" class="validate">
				          <label for="profissao">Profissão</label>
				        </div>
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
				          <input name="telefone" id="telefone" type="text" class="validate" value="<?php echo $list->telefone; ?>" data-mask = "00000-0000"  data-mask-selectonfocus = "true" required>
				          <label for="telefone">Telefone</label>
				        </div>
						<div class="input-field col s12 m7 l7">
				          <input name="email" value="<?php echo $list->email; ?>" id="email" type="email" class="validate" required>
			              <label for="email" data-error="E-mail Inválido" data-success="right">Email</label>
				        </div>
				      </div>

				      <div class="row">
				      	<div class="input-field col s12 m6 l6">
						    <input type="checkbox" name="submissao" value="1" id="sub" <?php echo $list->com_apresentacao == '1' ? "checked" : ""; ?> />
						    <label for="sub">Submissão de trabalho ao evento ?</label>
						    <input type="checkbox" name="administrador" value="1" id="adm" <?php echo $list->status == '1' ? "checked" : ""; ?> />
						    <label for="adm">Administrador do sistema ?</label>
				        </div>
				      </div>
				     
					  <div class="row  center-align">
							<a href='<?php echo base_url() . $this->uri->segment(1); ?>/listagem' class="waves-effect waves-light btn grey darken-1">Cancelar</a>
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

