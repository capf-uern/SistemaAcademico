
<div class="container" style="margin-top: 2%;">
	
	<div class="row">
        <div class="col s12 m12">
          <div class="card white">
            <div class="card-action grey lighten-2">
              <a href="#" class="card-content black-text"><strong>Cadastro</strong></a>
            </div>
            <div class="card-content black-text"> <!-- DIV CARD-CONTENT -->

            	<div class="row">
            		<form action="<?php echo base_url() . $this->uri->segment(1); ?>/cadastrar/" method="post" class="col s12 m12 l12" enctype="multipart/form-data">

				   	  <div class="row">
						<div class="input-field col s12 m12 l12">
					   	  	<fieldset>
			            	<legend><strong>&nbsp Tipo de Cadastro &nbsp</strong></legend>
			            	<div class="row">
							       	<div class="input-field col s12 m12 l12">
									    <select name="opcao" id="selector" required>
									      <option value="" disabled selected>Escolha sua opção</option>
									      <option value="1">Professor Universitário</option>
									      <option value="2">Aluno de Pós-Graduação</option>
									      <option value="3">Aluno de Graduação</option>
									      <option value="4">Técnico Administrativo</option>
									      <option value="5">Demais Profissionais</option>
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
				          <input name="cpf" id="cpf" type="text" class="validate" data-mask = "000.000.000-00"  data-mask-selectonfocus = "true" value="<?php echo set_value('cpf'); ?>" required>
				          <label for="cpf">CPF</label>
				        </div>
				        <div class="input-field col s12 m9 l9">
				          <input name="nome_completo" id="nome_completo" type="text" class="validate" value="<?php echo set_value('nome_completo'); ?>" required>
				          <label for="nome_completo">Nome Completo</label>
				        </div>
				      </div>

				      <div class="row">
				        <div class="input-field col s12 m8 l8">
				          <input name="instituicao" value="<?php echo set_value('instituicao'); ?>" id="instituicao" type="text" class="validate">
				          <label for="instituicao">Nome da instituição</label>
				        </div>
						<div class="input-field col s12 m4 l4" id="demais_profissionais">
				          <input name="profissao" value="<?php echo set_value('profissao'); ?>" id="profissao" type="text" class="validate">
				          <label for="profissao">Profissão</label>
				        </div>
				       </div>
				       
				       <div class="row">
				      	<div class="input-field col s12 m12 l12">
				          <input name="interesse" value="<?php echo set_value('interesse'); ?>" id="interesse" type="text" class="validate">
				          <label for="interesse">Área de Interesse</label>
				        </div>
				      </div>

				      <div class="row">
				      	<div class="input-field col s12 m1 l1">
				          <input name="telefone_ddd" value="<?php echo set_value('telefone_ddd'); ?>" id="telefone_ddd" type="text" class="validate" required>
				          <label for="telefone_ddd">DDD</label>
				        </div>
				      	<div class="input-field col s12 m4 l4">
				          <input name="telefone" id="telefone" type="text" class="validate" value="<?php echo set_value('telefone'); ?>" data-mask = "00000-0000"  data-mask-selectonfocus = "true" required>
				          <label for="telefone">Telefone</label>
				        </div>
						<div class="input-field col s12 m7 l7">
				          <input name="email" value="<?php echo set_value('email'); ?>" id="email" type="email" class="validate" required>
			              <label for="email" data-error="E-mail Inválido" data-success="right">Email</label>
				        </div>
				      </div>

				      <div class="row">
				      	<div class="input-field col s12 m6 l6">
				          <input name="senha" value="<?php echo set_value('senha'); ?>" id="senha" type="password" class="validate" required>
				          <label for="senha">Senha</label>
				        </div>
				      	<div class="input-field col s12 m6 l6">
				          <p>
						    <input type="checkbox" name="submissao" value="1" id="sub" />
						    <label for="sub">Submissão de trabalho ao evento ?</label>
						</p>
				        </div>
				      </div>

				      <div class="row" id="rowfile">
				      	<div class="file-field input-field  col s12 m12 l12">
					      <div class="btn">
					        <span>anexo: Declaração de Vínculo</span>
					        <input name="userfile" id="inputfile" type="file" required>
					      </div>
					      <div class="file-path-wrapper">
					        <input class="file-path validate" type="text">
					      </div>
					    </div>
					  </div>
				     
					  <div class="row  center-align">
							<a href='<?php echo base_url(); ?>' class="waves-effect waves-light btn grey darken-1">Cancelar</a>
							<button class="btn waves-effect waves-light blue darken-3" type="submit" name="action">Cadastrar <i class="material-icons right">send</i></button>
				      </div>

				    </form>
				  </div>

            </div> <!-- DIV CARD-CONTENT -->
          </div>
        </div>
  </div>


</div>

