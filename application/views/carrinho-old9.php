<div class="container margin-top padding-med-reset">
	<div class="row">
		<ol class="breadcrumb">
			<li><a href='{url}'>Home</a></li>
			<li class="active">
				Carrinho
			</li>
		</ol>
		<div class="row">

			<div class="col-lg-8 col-xs-12">
				<div class="panel panel-primary">
					<!-- Default panel contents -->
					<div class="panel-heading">Seus produtos</div>
					<div class="panel-body">
						<table class="table">
							<thead>
								<th><input type='checkbox' id='chkCarrinhoAll' /></th>
								<th>Produto</th>
								<th>Referência</th>
								<th style='width: 80px;'>Qtde</th>
								<th style='width: 200px;'>Valor</th>
							</thead>
							<tbody>
								<?php
									$attr  =  'disabled';
									if( count( $carrinho ) > 0 ) {
										$attr  =  '';
										foreach ($carrinho as $key => $value ) {
								?>
											<tr>
												<td><input type='checkbox' class='chkCarrinho' id="<?php echo $value['valu']; ?>" /></td>
												<td><?php echo $value['prod']; ?></td>
												<td><?php echo $value['refe']; ?></td>
												<td><input min="1" style="width: 45px;padding:0.2em 0.5em;background-color:#f5f5f5;border:none;font-size:12px" data-id="<?php echo $value['valu']; ?>" type="number" class="control-form change-quantity" value="<?php echo $value['qtd']; ?>" /></td>
												<td><?php echo $value['valo']; ?></td>
											</tr>
								<?php
										}

										echo "<tr><td colspan='4'></td><td>Total: R$ " . $total . "</td></tr>";
									}else {

										echo "<tr><td colspan='5' style='text-align: center;'>Seu carrinho está vázio</td></tr>";

									}
								?>			    		
							</tbody>
						</table>
					</div>
					<div class="panel-footer">
						<button class='btn btn-danger btn-xs deletarProduto' disabled>Remover Produtos</button>
					</div>
				</div>	
			</div>


			<div class="col-lg-4 col-xs-12">
                    <div class="panel panel-primary">
                        <!-- Default panel contents -->
                        <div class="panel-heading">Informações Adicionais</div>
                        <div class="panel-body">

                            <p>Frete: <b>R$ 0,00</b></p>
                        </div>
                        <div class="panel-footer">
							<button class='btn btn-success btn-xs finalizarCompra' <?php echo $attr; ?>>Ir para Checkout</button>
                        </div>
                    </div>
                </div>
		</div>		
	</div>
</div>
<script type="text/javascript">
	var baseUrl              =  '{url}';
	var baseUrlAjaxCarrinho  =  '{url}' + 'ajax/carrinho/';
	var valorPagamento       =  parseFloat( '{totalS}' );
</script>
<script type="text/javascript" src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>






