<!--<div class="container margin-top padding-med-reset">
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
                                    $attr = 'disabled';
                                if (count($carrinho) > 0) {
                                    $attr = '';
                                    foreach ($carrinho as $key => $value) {
                                ?>
                                        <tr>
                                            <td><input type='checkbox' class='chkCarrinho' id="<?= $value['valu']; ?>" /></td>
                                            <td><a href="<?= $value['link']; ?>"><img style="min-width:64px;min-height:64px;max-width:64px;max-height:64px;" src="<?= $value['image']; ?>"/></a></td>
                                            <td><?= $value['prod']; ?></td>
                                            <td><?= $value['refe']; ?></td>
                                            <td><input min="1" style="width: 45px;padding:0.2em 0.5em;background-color:#f5f5f5;border:none;font-size:12px" data-id="<?= $value['valu']; ?>" type="number" class="control-form change-quantity" value="<?= $value['qtd']; ?>" /></td>
                                            <td><?= $value['valo']; ?></td>
                                        </tr>
                                <?php
                                    }

                                    echo "<tr><td colspan='5'></td><td>Total: R$ " . $total . "</td></tr>";
                                } else {
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
                        <div class="panel-heading">Informações Adicionais</div>
                        <div class="panel-body">

                            <div class="row">

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Informe o seu CEP</label>
                                        <input type='text' class='form-control informarCep' name='cepEntregaCarrinho' />
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
                            <button class='btn btn-success btn-xs finalizarCompra' <?= $attr; ?>>Ir para Checkout</button>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
-->

<div class="conteiner">

    <div class="secao-principal row-fluid sem-coluna">

    <div class="finalizar-compra">
      <div class="cabecalho-interno row-fluid">
        <div class="span12">

            <h1 class=" cor-secundaria">
              Carrinho <small> Clique em finalizar compra para efetuar o seu pedido.</small>
            </h1>

        </div>
      </div>
      <div class="caixa-sombreada">
        <table class="table tabela-carrinho border-alpha">
          <thead>
            <tr><th colspan="2" width="45%">
              <h6 class="cor-secundaria">Produto</h6>
            </th>

              <th width="15%">
                <h6 class="cor-secundaria">Preço unitário</h6>
              </th>

            <th width="15%">
              <h6 class="cor-secundaria">Quantidade</h6>
            </th>

              <th width="15%">
                <h6 class="cor-secundaria">Subtotal</h6>
              </th>

            <th width="10%">
              <h6 class="cor-secundaria">Excluir</h6>
            </th>
          </tr></thead>

            <tbody>

                <?php
                    $attr = 'disabled';
                if (count($carrinho) > 0) :
                    $attr = '';
                    $index = 0;
                    foreach ($carrinho as $key => $value) :
                ?>
                
                <tr data-produto-quantidade="<?= $value['qtd']; ?>">
                    
                    <td class="sem-borda conteiner-imagem">
                        <div class="imagem">
                            <a href="<?= $value['link']; ?>">
                            <img src="<?= $value['image']; ?>" alt="Bolsa Caramelo Reversível Ellus com Alça Transversal"></a>
                        </div>
                    </td>
                    <td class="sem-borda">
                        <div class="produto-info">
                        <a href="<?= $value['link']; ?>" class="cor-secundaria">
                            <?= $value['prod']; ?>
                        </a>

                        <ul>
                            <li>
                            <span>
                                Referencia:
                                <strong>
                                <?= $value['refe']; ?>
                                </strong>
                            </span>
                            </li>
                            <li>
                            <span>
                                Estoque:
                                <strong>
                                Disponível
                                </strong>
                            </span>
                            </li>
                        </ul>
                        </div>
                    </td>

                    <td class="hidden-phone">


                        <div class="preco-produto destaque-preco com-promocao">

                            <div>
                                <strong class="preco-promocional cor-principal">
                                R$ <?= $value['valo']; ?>
                                </strong>
                            </div>

                        </div>

                    </td>

                    <td class="clearfix">
                        <form action="#" method="post">
                        <div class="quantidade">
                            <input min="1" style="width: 45px;padding:0.2em 0.5em;border:none;font-size:12px" data-id="<?= $value['valu']; ?>" type="number" class="control-form change-quantity" value="<?= $value['qtd']; ?>" />
                            <button class="botao principal pequeno atualizar-quantidade">Atualizar quantidade</button>
                        </div>
                        </form>
                    </td>

                    <td>
                    <div class="preco-produto">
                        <strong class="preco-promocional cor-principal">
                        R$ <?= number_format($value['valor_int'] * $value['qtd'], 2, ',', '.' ); ?>
                        </strong>
                    </div>
                    </td>

                    <td>
                        <div class="excluir">
                        <a class="excluirProduto" title="Excluir este produto." data-index="<?= $index ?>" data-id="<?= $value['valu']; ?>" data-quantidade="<?= $value['qtd']; ?>"><i class="icon-trash cor-secundaria"></i></button>
                        </div>
                    </td>
                </tr>

                <?php
                    $index++;
                    endforeach;
                else :
                        echo "<tr><td colspan='6' style='text-align: center;'>Seu carrinho está vázio</td></tr>";
                endif;
                ?>



            <tr class="hidden-phone bg-dark">
              <td colspan="4">&nbsp;</td>

                <td colspan="2">
                  <div class="subtotal">
                    <span>Subtotal: </span>
                    <strong class="cor-principal" data-subtotal-valor="<?= $total; ?>">
                      R$ <?= $total; ?>
                    </strong>
                  </div>
                </td>

            </tr>

            <tr class="hidden-phone bg-dark">
              <td colspan="4">
                <form class="form-horizontal" id="formCalcularFrete">
                  <div class="control-group">
                    <label class="control-label" for="calcularFrete">
                      
                    </label>
                    <div class="controls text-left">
                      <div class="input-append">
                        <input type="tel" id="cep" name="cep_destino" class="input-small input-cep informarCep" style="height: 34px;width:180px" value="" placeholder="Informe o Frete" maxlength="9">
                        <button type="button" class="btn btnCaclcularFrete"><i class="icon-truck"></i>Calcular Frete</button>
                      </div>
                      <span class="help-inline">
                        <a href="http://www.buscacep.correios.com.br/sistemas/buscacep/" target="_blank"><i class="icon-question-sign"></i>Não sei meu CEP</a>
                      </span>
                    </div>
                  </div>
                </form>
              </td>
              <td colspan="2">
                <div class="formas-envio">
                  <ul>
                  </ul>

                </div>
              </td>
            </tr>

            <tr class="bg-dark">
              <td colspan="6" class="line-18">
                <div class="total">
                  <span>Total:</span>
                  <strong class="cor-principal valor-total" data-total-valor="<?= $total; ?>">R$ <?= $total; ?></strong>
                </div>
                <div class="valores-descontos">






          <!--<div class="descontos avista">
            <span>

                via depósito

              por <strong class="cor-principal  font-15">R$ <?= $total; ?></strong> com <strong>8% de desconto</strong>
            </span>
          </div>

        <div class="descontos parcelas">
          <span>
            ou em até <strong>6x</strong> de <strong>R$ 73,32</strong> sem juros
          </span>
        </div>-->

								</div>
              </td>
            </tr>

        </tbody></table>
      </div>

        <div class="acao-editar row-fluid">
            <div class="span12">
                <a href="/" class="botao">Continuar comprando</a>
                <?php if($logado): ?>
                    <button type="button" class="botao principal grande finalizarCompra"><i class="icon-ok"></i>Finalizar compra</button>
                <?php else: ?>
                    <a href="/minha/conta/login?redirect=http://www.grupobasso.com.br/compras/carrinho" class="botao principal grande"><i class="icon-ok"></i>Finalizar compra</a>
                <?php endif; ?>
			</div>

           <div class="selo-ssl hidden-phone">
             <img src="https://cdn.awsli.com.br/production/static/img/struct/stamp_encryptssl_cart.png" alt="Compra 100% Segura">
           </div>
        </div>
    </div>

    </div>
				<div class="secao-secundaria">
				</div>
    </div>

<script type="text/javascript">
    var baseUrl              =  '{url}';
    var baseUrlAjaxCarrinho  =  '{url}' + 'ajax/carrinho/';
    var valorPagamento       =  parseFloat( '{totalS}' );
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $("#cep").mask("99999-999");
    });
</script>

<script type="text/javascript" src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>






