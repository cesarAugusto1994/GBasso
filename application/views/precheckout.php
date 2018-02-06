<div class="conteiner">
          
  <div class="secao-principal row-fluid sem-coluna">
              
    <div class="campos-pedido">
      <div class="cabecalho-interno row-fluid hide">
        <div class="span12">
            <h1 class="titulo cor-secundaria">
              Finalizar compra <small> Preencha os dados necessários para finalizar o pedido.</small>
            </h1>
        </div>
      </div>
    </div>

    <div class="campos-pedido">

      <div id="login-content" class="">
        <div class="row-fluid identificacao">
          <div class="span12">
            <hr class="sem-margem">
            <div class="identificacao-inner">
              <h3 class="identificacao-title">Para continuar, informe seu e-mail</h3>
              <form action="/login" method="post" id="formularioLogin">
                <div class="form-horizontal">
                  <div class="control-group">
                      <label for="id_email_login">E-mail</label>
                      <input type="text" name="email" id="id_email_login" class="form-control" autocomplete="email" placeholder="meu@email.com.br">
                      <br/>
                      <br/>
                      <button type="submit" class="btn btn-success btn-block">Continuar</button>
                  </div>
                
                </div>
              </form>
            </div>
          </div>
        </div>
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
      