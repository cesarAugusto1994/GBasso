<div class="conteiner">

  <div class="secao-principal row-fluid sem-coluna">



    <div class="campos-pedido">

      <div id="login-content" class="">
        <div class="row-fluid" style="display: block;">
          <div class="col-lg-4 hidden-xs ">

          </div>
          <div class="col-lg-4 col-xs-12 " style="margin-top:40px;">
            <h4 class="identificacao-title text-center">Para continuar, informe seu e-mail</h4>
            <br/>
            <div class="caixa-sombreada borda-principal">
              <form action="/login" method="post" id="formularioLogin">
                  <fieldset data-recording-ignore="events">
                <legend class=" cor-secundaria"><i class="icon-user"></i>Identifique-se</legend>
                <div id="formularioEndereco" class="">

                  <div class="formEndereco-conteiner">

                    <div class="row-fluid">
                      <div class="control-group span12 required" style="display: block;">
                        <label class="control-label font-bold" for="shippingAddressStreet">E-mail</label>
                        <div class="controls">
                          <input type="text" name="email" id="id_email_login" class="input-xlarge span12 form-control" value="" autocomplete="email" placeholder="meu@email.com.br">
                        </div>
                      </div>
                    </div>

                    <button type="submit" class="btn btn-success btn-block">Continuar</button>
                    <a href="http://www.grupobasso.com.br/minha/conta/cadastrar" class="btn btn-default btn-block">Novo Cadastro</a>
                  </div>
                </div>
              </fieldset>
              </form>
            </div>

            <div class="checkout-alerta-seguro">
              <h3 class="checkout-alerta-seguro-tit">Usamos seu e-mail de forma 100% segura para:</h3>
              <ul class="checkout-alerta-seguro-list">
                <li class="checkout-alerta-seguro-item"><i class="icon-ok"></i> <span class="checkout-alerta-seguro-text">Identificar seu perfil</span></li>
                <li class="checkout-alerta-seguro-item"><i class="icon-ok"></i> <span class="checkout-alerta-seguro-text">Notificar sobre o andamento do seu pedido</span></li>
                <li class="checkout-alerta-seguro-item"><i class="icon-ok"></i> <span class="checkout-alerta-seguro-text">Gerenciar seu histórico de compras</span></li>
                <li class="checkout-alerta-seguro-item"><i class="icon-ok"></i> <span class="checkout-alerta-seguro-text">Acelerar o preenchimento de suas informações</span></li>
              </ul>
              <i class="icon-lock checkout-alerta-seguro-icon"></i>
            </div>

          </div>

          <div class="col-lg-4 hidden-xs ">

          </div>
        </div>

      </div>

    </div>
      <div class="row-fluid">
        <div class="span12">
          <div class="resumo-compra caixa-sombreada">
            <table class="table tabela-carrinho borda-alpha">
              <thead class="cor-secundaria">
                <tr><th><h6>Produtos</h6></th>
                <th width="80"><h6>Qtd.</h6></th>
                <th width="140" class="padding-preco"><div><h6 style="margin-left: 10px;">Preço</h6></div></th>
              </tr></thead>

                <tbody>

                <?php
                    $attr = 'disabled';
                if (count($carrinho) > 0) :
                    $attr = '';
                    $index = 0;
                    foreach ($carrinho as $key => $value) :
                ?>

                <tr>
                  <td class="phone-pullleft" data-produto-id="24316594" data-produto-quantidade="1">
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

                      </ul>
                    </div>
                  </td>
                  <td class="conteiner-qtd">
                    <div><?= $value['qtd']; ?></div>
                  </td>
                  <td class="conteiner-preco padding-preco">
                    <div class="preco-produto">
                      <strong class="preco-promocional cor-principal">
                        R$ <?= number_format($value['valor_int'] * $value['qtd'], 2, ',', '.' ); ?>
                      </strong>
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


              <tr class="bg-dark esconder-mobile">
                <td>&nbsp;</td>
                <td class="text-right">
                  <span>Subtotal:</span>
                </td>
                <td class="padding-preco">
                  <div class="subtotal" data-subtotal="" data-float="">
                    <strong class="cor-principal">
                      R$ <?= $total; ?>
                    </strong>
                  </div>
                </td>
              </tr>
              <tr class="bg-dark esconder-mobile tr-checkout-frete" style="display: table-row;">
                <td>&nbsp;</td>
                <td class="text-right">
                  <span>Frete:</span>
                </td>
                <td class="padding-preco">
                  <div class="frete-preco">
                    <strong class="cor-principal" style="display: inline;">R$ <span id="valorFrete"></span></strong>
                  </div>
                </td>
              </tr>

              <tr class="bg-dark tr-checkout-total" style="display: table-row;">
                <td colspan="2" class="text-right hidden-phone">
                  <span>Total:</span>
                </td>
                <td class="padding-preco">
                  <div class="total">
                    <strong class="cor-principal preco-carrinho-total">R$ <span id="totalValue"><?=$total;?></span></strong>
                  </div>
                </td>
              </tr>
            </tbody></table>
            <div class="alert alert-error hide" id="alertError">
              <span></span>
            </div>
          </div>
        </div>
      </div>

</div>
</div>

<script>

    $(document).ready(function() {

      var freteValor = window.localStorage.getItem('freteValor');
      $("#valorFrete").html(freteValor.replace(".", ','));

      var valorTotal = $("#totalValue").html().replace(',', ".");
      $("#totalValue").html((+valorTotal + +freteValor).toFixed(2).replace(".", ','))

    });

</script>
