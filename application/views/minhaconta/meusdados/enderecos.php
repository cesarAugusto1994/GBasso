<div class="container margin-top padding-med-reset">
	<div class="row">
		<ol class="breadcrumb">
			<li>
				<a href="{url}minha/conta" class="breadcump">Minha conta</a>
			</li>
			<li>
				<a href="{url}minha/conta/meusenderecos" class="breadcump">Meus Endereços</a>
			</li>			
			<li class="active">
				Editar
			</li>			
		</ol>
	</div>
	<div class="row">		
		<form class='formCadastro' method='post' action='{url}ajax/minha/conta/atualizar/usuario' >
			<div class='col-lg-12 no-padding margin-bottom-17'>
				<table class='table'>
					<thead>
						<th style='width: 30px;'><input type="checkbox" id='chkAllEndereco' /></th>
						<th>Cep</th>
						<th>Destinatário</th>
						<th>Pt. Referência</th>
						<th>Principal</th>
						<th>Endereço</th>
						<th>Bairro</th>
						<th>Número</th>
						<th>Complemento</th>
						<th>Cidade</th>
						<th>Estado</th>
					</thead>
					<tbody>
						<?php
							if( count( $endereco ) > 0 ) {

								foreach ($endereco as $key => $value ) {
						?>
									<tr>
										<td><input type='checkbox' class="chkEndereco" id="<?php echo $value['val']; ?>" /></td>
										<td><?php echo $value['cep']; ?></td>
										<td><?php echo $value['des']; ?></td>
										<td><?php echo $value['ptr']; ?></td>
										<td><?php echo $value['pri']; ?></td>
										<td><?php echo $value['end']; ?></td>
										<td><?php echo $value['bai']; ?></td>
										<td><?php echo $value['num']; ?></td>
										<td><?php echo $value['com']; ?></td>
										<td><?php echo $value['cid']; ?></td>
										<td><?php echo $value['est']; ?></td>
									</tr>
						<?php
								}

							}else {
						?>
								<tr>
									<td colspan="11" class='text-center'>Nenhum endereço cadastrado</td>
								</tr>
						<?php
							}
						?>
					</tbody>
				</table>
				<div class='pull-right'>
					<button type='button' class='btn btn-info novoEndereco'>Novo</button>
					<button type='button' class='btn btn-success editarEndereco'>Editar</button>
					<button type='button' class='btn btn-danger deletarEndereco'>Deletar</button>
				</div>
			</div>
			<!--
			<div class='col-lg-6 no-padding margin-bottom-17'>
				<h3>Endereço</h3>
				<hr />
				<div class="col-lg-12 no-padding margin-bottom-17">
					<div class='col-lg-3 no-padding'>
						<label>Cep</label>
						<input type='text' name='cep' class='form-control' />
					</div>
					<div class='col-lg-9'>
						<label>Endereço</label>
						<input type='text' name='endereco' class='form-control' />
					</div>	
				</div>
				<div class="col-lg-12 no-padding margin-bottom-17">
					<div class='col-lg-6 no-padding'>
						<label>Bairro</label>
						<input type='text' name='bairro' class='form-control' />
					</div>
					<div class='col-lg-3'>
						<label>Número</label>
						<input type='text' name='numero' class='form-control' />
					</div>
					<div class='col-lg-3'>
						<label>Comple.</label>
						<input type='text' name='comple' class='form-control' />
					</div>
				</div>
				<div class="col-lg-12 no-padding margin-bottom-17">
					<div class='col-lg-6 no-padding'>
						<label>Cidade</label>
						<input type='text' name='cidade' readonly class='form-control' />
					</div>
					<div class='col-lg-6'>
						<label>Estado</label>
						<input type='text' name='estado' readonly class='form-control' />
					</div>	
				</div>
			</div>
			-->
		</form>
	</div>
</div>
<script type='text/javascript'>
	var baseUrl      =   '{url}';
	var baseUrlAjax  =   '{url}ajax/';
	var page         =   'editar-usuario';
</script>





