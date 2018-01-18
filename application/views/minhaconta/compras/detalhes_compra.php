<div class="container margin-top padding-med-reset">
	<div class="row">
		<ol class="breadcrumb">
			<li>
				<a href="{url}minha/conta" class="breadcump">Minha Conta</a>
			</li>
			<li>
				<a href="{url}minha/conta/compras" class="breadcump">Compras</a>
			</li>
			<li class="active">
				{referencia}
			</li>
		</ol>
	</div>
	<div class="row">
		<div class="col-lg-6 border-left-custom">
			<div class="col-lg-12 no-padding margin-bottom-17">
				<h3>Suas compra: {referencia}</h3>
				<div class="col-lg-12 no-padding">
					<table class='table'>
						<thead>
							<th>Ref.</th>
							<th>Status</th>
							<th>Valor</th>
							<th style='width: 160px;'>Data</th>
						</thead>
						<tbody class='compras'>
							<tr>
								<td colspan="4" class="text-center">Nenhuma compra encontrada</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="col-lg-6 border-left-custom">
			<div class="col-lg-12 no-padding margin-bottom-17">
				<h3>Produtos da compra: {referencia}</h3>
				<div class="col-lg-12 no-padding">
					<table class='table'>
						<thead>
							<th>Código</th>
							<th>Nome do produto</th>
							<th>Valor</th>
						</thead>
						<tbody class='produtosVenda'>
							<tr>
								<td colspan="3" class="text-center">Nenhum produto encontrado</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>		
	</div>
</div>
<script type='text/javascript'>
	var baseUrl       =   '{url}';
	var baseUrlAjax   =   '{url}ajax/';
	var page          =   'detalhes-compras';
</script>





