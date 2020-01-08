
<div class="container" style="margin-top: 2%;">

	<div class="row">
        <div class="col s12 m12 l12">
          <div class="card white">
            <div class="card-content"> <!-- DIV CARD-CONTENT -->

            <div class="row">

            		<div class="col s12 m3 l3 card-panel hoverable white-text blue darken-1
 center-align">
            			<i class="medium material-icons">insert_chart</i> <br>
            			<?php echo $inscritos ?> inscritos
            		</div>

            		<div class="col s12 m3 l3 card-panel hoverable white-text indigo accent-2 center-align"><i class="medium material-icons">question_answer</i> <br>
						<?php echo $minicursos ?> minicursos
					</div>

					<div class="col s12 m3 l3 card-panel hoverable white-text blue accent-2 center-align"><i class="medium material-icons">recent_actors</i> <br>
						<?php echo $oficinas ?> oficinas
					</div>

					<div class="col s12 m3 l3 card-panel hoverable white-text teal lighten-2
 center-align"><i class="medium material-icons">content_copy</i> <br>
						<?php echo $posteres ?> posteres
					</div>

            </div>

			<div class="row">

				<div class="col s12 m6 l6">

					<div class="card-panel col s12 m12 l12 grey lighten-1">
						<span><strong>Cadastros recentes</strong></span>
					</div>
					<table class="striped responsive-table">
						<thead>
						<tr>
							<th width="55%">Nome</th>
							<th width="15%" class="right-align">Status</th>
						</tr>
						</thead>

						<tbody>

						<?php foreach ($ultimos as $ult) { ?>

							<tr>
								<td><?php echo $ult->nome; ?></td>
								<td class="center-align">
									<?php
									if($ult->liberado == '1'){
										echo '<span class="badge blue darken-1 white-text">Ativo</span>';
									}else{
										echo '<span class="badge teal darken-3 white-text">Pendente</span>';
									}
									?>
								</td>
							</tr>

						<?php } ?>

						</tbody>
					</table>

				</div>

				<div class="col s12 m6 l6">

					<div class="card-panel col s12 m12 l12 grey lighten-1">
						<span><strong>Estatísticas de cadastros</strong></span>
					</div>
					<table class="striped responsive-table">
						<thead>
						<tr>
							<th width="55%">Tipo de cadastro</th>
							<th width="15%" class="right-align">Quantidade</th>
						</tr>
						</thead>

						<tbody>

						<tr>
							<td>Professor Universitário</td>
							<td class="right-align"><?php echo $professores; ?></td>
						</tr>
						<tr>
							<td>Aluno Pós-Graduação</td>
							<td class="right-align"><?php echo $posgraduacao; ?></td>
						</tr>
						<tr>
							<td>Aluno Graduação</td>
							<td class="right-align"><?php echo $graduacao; ?></td>
						</tr>
						<tr>
							<td>Técnico Administrativo</td>
							<td class="right-align"><?php echo $tecnico; ?></td>
						</tr>
						<tr>
							<td>Demais Profissionais</td>
							<td class="right-align"><?php echo $demais; ?></td>
						</tr>

						</tbody>
					</table>

				</div>

			</div>

            </div> <!-- DIV CARD-CONTENT -->
          </div>
        </div>

  	</div>

</div>

