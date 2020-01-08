
<div class="container" style="margin-top: 2%;">

	<div class="row">
        <div class="col s12 m6 l6">
          <div class="card white">
           <div class="card-action grey lighten-2">
              <a href="#" class="card-content black-text"><strong>Datas Importantes</strong></a>
            </div>
            <div class="card-content black-text"> <!-- DIV CARD-CONTENT -->

            	<div class="row">
	            	<div class="col s12 m6 l6" style="border-right: 1px solid #999">
	            		<h5>08 a 20/09</h5>
						<h6>Submissões de resumo expandido</h6>
	            	</div>

	            	<div class="col s12 m6 l6">
	            		<h5>07/08 a 30/09</h5>
						<h6>Inscrições sem apresentação de trabalhos</h6>
	            	</div>
	            </div>

            </div> <!-- DIV CARD-CONTENT -->
          </div>
        </div>

        <div class="col s12 m6 l6">
          <div class="card white">
           <div class="card-action grey lighten-2">
              <a href="#" class="card-content black-text"><strong>informações de pagamento</strong></a>
            </div>
            <div class="card-content black-text"> <!-- DIV CARD-CONTENT -->

            	<div class="row">
	            	<div class="col s12 m12 l12">
	            			
	            		<?php 
	            		
	            			$tipoPagamento = $this->session->userdata('tipo_cadastro');

	            			switch ($tipoPagamento) {
	            				case '1':
	            					$tipo 			= 'Professor Universitário';
	            					$valorTrabalho	= 'R$ 50,00';
	            					$valor			= 'R$ 40,00';
	            					break;
	            				case '2':
	            					$tipo 			= 'Aluno de Pós-Graduação';
	            					$valorTrabalho	= 'R$ 40,00';
	            					$valor			= 'R$ 35,00';
	            					break;
	            				case '3':
	            					$tipo 			= 'Aluno de Graduação';
	            					$valorTrabalho	= 'R$ 30,00';
	            					$valor			= 'R$ 20,00';
	            					break;
	            				case '4':
	            					$tipo 			= 'Técnico Administrativo';
	            					$valorTrabalho	= 'R$ 25,00';
	            					$valor			= 'R$ 20,00';
	            					break;
	            				
	            				default:
	            					$tipo		= 'Demais profissionais';
									$valorTrabalho	= 'R$ 40,00';
									$valor			= 'R$ 35,00';
	            					break;
	            			}

	            			echo '<table class="responsive-table bordered striped">
								<tbody>
								<tr >
									<td ></td>
									<td >Com apresentação</td>
									<td >Sem apresentação</td>
								</tr>
								<tr >
								<td > ' . $tipo . '</td>
								<td > ' . $valorTrabalho . '</td>
								<td > ' . $valor . '</td>
								</tr>
								</tbody>
								</table>';

	            		?>



	            	</div>
	            </div>

	            <div class="row">
	            	<div class="col s12 m12 l12">
	            		<h6><strong>Conta para Pagamento</strong> - BANCO DO BRASIL</h6>
						 Agência: 1109-6 <br>
						 Conta Corrente: 37459-8 <br>
						 <strong>JAKELYNE SANTOS APOLONIO</strong>
	            	</div>

	            </div>


	            <div class="row">
	            <form action="<?php echo base_url() . $this->uri->segment(1); ?>/pagamento/" method="post" class="col s12 m12 l12" enctype="multipart/form-data">

			      	<div class="file-field input-field  col s12 m12 l12">
				      <div class="btn">
				        <span>anexar comprovante</span>
				        <input name="userfile" type="file">
				      </div>
				      <button class="btn waves-effect waves-light blue darken-3 right" type="submit">enviar <i class="material-icons right">send</i></button>	
				    </div>


			  	</form>
			  	</div>



            </div> <!-- DIV CARD-CONTENT -->
          </div>
        </div>
  	</div>

</div>

