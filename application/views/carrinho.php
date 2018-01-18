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
								<th>Imagem</th>
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
												<td><a href="<?php echo $value['link']; ?>"><img style="min-width:64px;min-height:64px;max-width:64px;max-height:64px;" src="<?php echo $value['image']; ?>"/></a></td>
												<td><?php echo $value['prod']; ?></td>
												<td><?php echo $value['refe']; ?></td>
												<td><input min="1" style="width: 45px;padding:0.2em 0.5em;background-color:#f5f5f5;border:none;font-size:12px" data-id="<?php echo $value['valu']; ?>" type="number" class="control-form change-quantity" value="<?php echo $value['qtd']; ?>" /></td>
												<td><?php echo $value['valo']; ?></td>
											</tr>
								<?php
										}

										echo "<tr><td colspan='5'></td><td>Total: R$ " . $total . "</td></tr>";
									}else {

										echo "<tr><td colspan='6' style='text-align: center;'>Seu carrinho está vázio</td></tr>";

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

							<div class="row">

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Informe o seu CEP</label>
                                        <input type='text' class='form-control' id="informarCep" name='cepEntregaCarrinho' />
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Frete</label>
                                        <select class='form-control selectpicker' name='servicoFrete' id='servicoFreteCarrinho'>
                                                <option value="1">PAC </option>
                                                <option value="2">SEDEX </option>
                                            </select>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label style='float: left; margin-bottom: 20px; width: 100%;'>Valor do frete: </label>
                                        <span class='valorFrete'>R$ 0,00</span>
                                    </div>
                                </div>

                            </div>


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





