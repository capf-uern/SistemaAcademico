
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

            	<div class="row">

					<!-- tabela do certificado geral -->
					<table class="bordered responsive-table">
						<thead>
						<tr class="grey lighten-3">
							<th width="85%">Evento</th>
							<th width="15%" class="center-align"></th>

						</tr>
						</thead>

						<tbody>

						<?php foreach ($usuario as $list) { ?>

							<tr>
								<td>Certificado geral de participação na XVII Semana Universitária</td>
								<td class="right-align">
									<a href="<?php echo base_url('impressoes/certificadgeral'); ?>" class="btn btn-small tooltipped waves-effect waves-blue blue darken-3" data-position="top" data-delay="50" data-tooltip="Imprimir certificado">Imprimir <i class="small material-icons">local_printshop</i></a>
								</td>
							</tr>

						<?php } ?>

						</tbody>
					</table>

					<!-- tabela do minicursos -->
        			<table class="bordered responsive-table">
				        <thead>
						<tr class="grey lighten-3">
				              <th width="85%">Minicurso</th>
				              <th width="15%" class="center-align"></th>

				          </tr>
				        </thead>

				        <tbody>

				        <?php foreach ($minicurso as $list) { ?>
				        	
				          <tr>
						  <?php if(count($min_minicurso) > 0){ ?>
							  <?php foreach ($min_minicurso as $ministrante1) { ?>
							  <td><span class="new badge red" data-badge-caption="">Ministrante</span><?php echo $ministrante1->titulo; ?></td>
							  <td class="right-align">
								  <a href="<?php echo base_url('impressoes/ministrantemini'); ?>" class="btn btn-small tooltipped waves-effect waves-blue blue darken-3" data-position="top" data-delay="50" data-tooltip="Imprimir certificado">Imprimir <i class="small material-icons">local_printshop</i></a>
							  </td>
							  <?php } ?>
						  <?php } ?>
						  </tr>
						  <tr>
				            <td><?php echo $list->titulo; ?></td>
				            <td class="right-align">
								<a href="<?php echo base_url('impressoes/certificadominicurso'); ?>" class="btn btn-small tooltipped waves-effect waves-blue blue darken-3" data-position="top" data-delay="50" data-tooltip="Imprimir certificado">Imprimir <i class="small material-icons">local_printshop</i></a>
				            </td>
				          </tr>

				        <?php } ?>

				        </tbody>
				    </table>

					<!-- tabela do oficinas -->
					<table class="bordered responsive-table">
						<thead>
						<tr class="grey lighten-3">
							<th width="85%">Oficina</th>
							<th width="15%" class="center-align"></th>

						</tr>
						</thead>

						<tbody>

						<?php foreach ($oficina as $list) { ?>

							<tr>
								<?php if(count($min_oficina) > 0){ ?>
									<?php foreach ($min_oficina as $ministrante2) { ?>
										<td><span class="new badge red" data-badge-caption="">Ministrante</span><?php echo $ministrante2->titulo; ?></td>
										<td class="right-align">
											<a href="<?php echo base_url('impressoes/ministranteoficina'); ?>" class="btn btn-small tooltipped waves-effect waves-blue blue darken-3" data-position="top" data-delay="50" data-tooltip="Imprimir certificado">Imprimir <i class="small material-icons">local_printshop</i></a>
										</td>
									<?php } ?>
								<?php } ?>
							</tr>
							<tr>
								<td><?php echo $list->titulo; ?></td>
								<td class="right-align">
									<a href="<?php echo base_url('impressoes/certificadooficina'); ?>" class="btn btn-small tooltipped waves-effect waves-blue blue darken-3" data-position="top" data-delay="50" data-tooltip="Imprimir certificado">Imprimir <i class="small material-icons">local_printshop</i></a>
								</td>
							</tr>

						<?php } ?>

						</tbody>
					</table>

					<!-- tabela do resumos expandidos -->
					<table class="bordered responsive-table">
						<thead>
						<tr class="grey lighten-3">
							<th width="85%">Grupos de Trabalhos</th>
							<th width="15%" class="center-align"></th>

						</tr>
						</thead>

						<tbody>

						<?php foreach ($resumos as $list) { ?>

							<tr>
								<td><?php echo $list->titulo; ?></td>
								<td class="right-align">
									<a href="<?php echo base_url('impressoes/certificadoresumos'); ?>" class="btn btn-small tooltipped waves-effect waves-blue blue darken-3" data-position="top" data-delay="50" data-tooltip="Imprimir certificado">Imprimir <i class="small material-icons">local_printshop</i></a>
								</td>
							</tr>

						<?php } ?>

						</tbody>
					</table>

				</div>

            </div> <!-- DIV CARD-CONTENT -->
          </div>
        </div>
  </div>

</div>

