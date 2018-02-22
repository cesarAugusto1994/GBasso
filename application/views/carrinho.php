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
                <div class="form-horizontal" id="formCalcularFrete">
                  <div class="control-group">
                    <label class="control-label" for="calcularFrete">

                    </label>
                    <div class="controls text-left">
                      <div class="input-append">
                        <input type="tel" id="cep" name="cep_destino" class="input-small input-cep informarCep" style="height: 34px;width:180px" value="" placeholder="Informe o Frete" maxlength="8">
                        <button type="button" class="btn btn-default btnCaclcularFrete"><i class="icon-truck"></i>Calcular Frete</button>
                      </div>
                      <span class="help-inline">
                        <a href="http://www.buscacep.correios.com.br/sistemas/buscacep/" target="_blank"><i class="icon-question-sign"></i>Não sei meu CEP</a>
                      </span>
                    </div>
                  </div>
                </div>
              </td>
              <td colspan="2">
                <div class="formas-envio">
                    <center><p class="lead">Informe o seu cep.</p><i><small>As suas opçoes de frete aparecerão aqui.</small><i></center>
                </div>
              </td>
            </tr>

            <tr class="bg-dark">
              <td colspan="6" class="line-18">
                <div class="total">
                  <span>Total:</span>
                  <strong class="cor-principal valor-total" data-total-valor="<?= $total; ?>">R$ <span id="valorTotal"><?= $total; ?></span></strong>
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
                <?php if(1==1): ?>
                    <a data-redirect="http://www.grupobasso.com.br/compras/precheckout" class="botao principal grande"><i class="icon-ok"></i>Finalizar compra</a>
                <?php elseif($logado): ?>
                    <button type="button" class="botao principal grande finalizarCompra"><i class="icon-ok"></i>Finalizar compra</button>
                <?php else: ?>
                    <a href="http://www.grupobasso.com.br/minha/conta/login?redirect=/compras/carrinho" class="botao principal grande"><i class="icon-ok"></i>Finalizar compra</a>
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

    function somaValorFrete()
    {
      freteValor = $("input[name='inputFrete']:checked").data('valor');

      if(!freteValor) {
          freteValor = window.localStorage.getItem('freteValor');;
      }

      var valorTotalOriginal = $('.valor-total').data('total-valor').replace(',', ".");

      var valorTotal = valorTotalOriginal;
      $("#valorTotal").html((+valorTotal + +freteValor).toFixed(2).replace(".", ','))
    }


    $(document).ready(function(){

        $("#cep").change(function() {
            window.localStorage.setItem('cep', $(this).val())
        });

        var cepCodigo = window.localStorage.getItem('cep');

        if(cepCodigo) {
          $("#cep").val(cepCodigo);
          var post = 'cep=' + $("#cep").val();
          getValorFrete2(post);
        }

        //$("#cep").mask("99999-999");

        $(".principal").click(function(e) {

            e.preventDefault();

            var inputFrete = $("input[name='inputFrete']").is(':checked');

            if(!inputFrete) {

                alerta('Selecione uma Opção de Frete.', 102);

                $('#cep').focus();

                return false;

            }

            $url = $(this).data('redirect');

            var freteId = $("input[name='inputFrete']:checked").data('id');
            var freteValor = $("input[name='inputFrete']:checked").data('valor');

            freteValor = freteValor.toFixed(2);

            window.localStorage.setItem('freteId', freteId)
            window.localStorage.setItem('freteValor', freteValor)

            window.location.href = $url;
        });

    });
</script>

<script type="text/javascript" src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>
