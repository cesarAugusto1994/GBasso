<div id="corpo">
<div class="conteiner">

<div class="secao-principal row-fluid sem-coluna">

<div class="campos-pedido">
<div class="cabecalho-interno row-fluid">
<div class="span12">
<h1 class="cor-secundaria">
  Finalizar compra <small> Preencha os dados necessários para finalizar o pedido.</small>
</h1>
</div>
</div>
<div class="campos-pedido">


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
          <div class="subtotal" data-subtotal="369,90" data-float="369.9">
            <strong class=" cor-principal">
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
            <small class="muted" style="display: none;">(defina abaixo)</small>
            <strong class=" cor-principal hide" style="display: inline;">R$ 0,00</strong>
          </div>
        </td>
      </tr>

        <tr class="bg-dark esconder-mobile desconto-tr hide" style="">
          <td>&nbsp;</td>
          <td class="text-right">
            <span>Desconto à vista:</span>
            <small class="hide texto-aplicar-total muted" style="">(frete não incluso)</small>
          </td>
          <td class="padding-preco">
            <div class="desconto-preco">
              <strong class=" cor-principal">R$ 0,00</strong>
            </div>
          </td>
        </tr>

      <tr class="bg-dark tr-checkout-total" style="display: table-row;">
        <td colspan="2" class="text-right hidden-phone">
          <span>Total:</span>
        </td>
        <td class="padding-preco">
          <!--<span class="visible-phone">Total:</span>-->
          <div class="total" data-total="<?= $total; ?>">
            <strong class=" cor-principal preco-carrinho-total">R$ <?= $total; ?></strong>
          </div>
        </td>
      </tr>
    </tbody></table>
    <div class="alert alert-error" id="alertError">
      <span></span>
    </div>
  </div>
</div>
</div>

<form action="https://www.biellissima.com.br/checkout/finalizar" method="POST" id="formularioCheckout">

<div class="row-fluid" style="display: block;">
  <div class="span4">
    <div class="caixa-sombreada borda-principal dados-cadastro">
      <fieldset data-recording-ignore="events">

        <legend class=" cor-secundaria"><i class="icon-list"></i>Novo cadastro ou <a href="javascript:;" class=" cor-secundaria fazer-login-btn" style="text-decoration: underline;">identifique-se</a></legend>


          <input id="id_tipo" name="tipo" type="hidden" value="PF">
          <input id="id_tipo_usuario" name="tipo_usuario" type="hidden" value="PF">
          <div class="control-group  required">
            <label class="control-label font-bold" for="senderName">Nome</label>
            <div class="controls">
              <input autocomplete="senderName" class="input-xlarge span12" value="<?=$usuario['nome'] . ' ' . $usuario['sobrenome']?>" id="senderName" maxlength="128" name="senderName" type="text">
                <p class="help-block hide">

                </p>
            </div>
          </div>
          <div class="control-group  required">
            <label class="control-label font-bold" for="senderEmail">E-mail</label>
            <div class="controls">
              <input autocomplete="senderEmail" class="input-xlarge span12" value="<?=$usuario['email']?>" id="senderEmail" maxlength="128" name="senderEmail" type="text">
                <p class="help-block hide">

                </p>
            </div>
          </div>
          <div class="control-group  required">
            <label class="control-label font-bold" for="senderCPF">CPF</label>
            <div class="controls">
              <input autocapitalize="off" autocomplete="off" value="<?=$cpf?>" autocorrect="off" class="input-small span12" id="senderCPF" maxlength="14" name="senderCPF" spellcheck="false" type="tel">
              <p class="help-block hide">

              </p>
            </div>
          </div>

          <div id="userExtraInfo">

            <div class="row-fluid campos-bot">
              <div class="control-group span6  required" style="margin-left: 0;">
                <label class="control-label font-bold" for="id_telefone_celular">Celular</label>
                <div class="controls">
                  <input autocapitalize="off" autocomplete="off" autocorrect="off" class="input-small span12" id="id_telefone_celular" name="telefone_celular" spellcheck="false" tel="" type="tel" maxlength="15">
                  <p class="help-block hide">

                  </p>
                </div>
              </div>
              <div class="control-group span6 ">
                <label class="control-label" for="id_telefone_principal">Telefone fixo</label>
                <div class="controls">
                  <input autocapitalize="off" autocomplete="off" autocorrect="off" class="input-small span12" id="id_telefone_principal" name="telefone_principal" spellcheck="false" type="tel" maxlength="15">
                  <p class="help-block hide">

                  </p>
                </div>
              </div>
            </div>
          </div><!-- /userExtraInfo -->

      </fieldset>

    </div>
  </div>
  <div class="span4">
    <div class="caixa-sombreada borda-principal">
      <fieldset data-recording-ignore="events">
        <legend class=" cor-secundaria"><i class="icon-map-marker"></i>Entrega</legend>
        <div id="formularioEndereco" class="">
          <div id="exibirFormasEnvio" class="hide pull-right" style="margin-bottom: 15px; margin-top: 25px; display: block;">
            <a href="javascript:;" class="btn btn-small"><i class="icon-pencil"></i> Alterar entrega</a>
          </div>
          <div class="formEndereco-conteiner">
            <div class="control-group  required" style="margin-bottom: 20px;">
              <label class="control-label font-bold" for="shippingAddressPostalCode">CEP</label>
              <div class="controls">
                <input  id="shippingAddressPostalCodeId" type="hidden" value="<?=$enderecoPrincipal['val']?>">
                <input autocapitalize="off" autocomplete="off" autocorrect="off" class="input-small" id="shippingAddressPostalCode" value="<?=$enderecoPrincipal['cep']?>" name="shippingAddressPostalCode" spellcheck="false" type="tel" maxlength="9">
                <button class="btn btn-link btn-sm" data-toggle="modal" data-target="#modal-enderecos">Meus Endereços</button>
                <p class="help-block hide">

                </p>
              </div>
              <div class="envio-erro alert alert-errors alert-error hide" style="margin: 10px 0px; display: none;">
                CEP não informado
              </div>
              <ul class="hide borda-alpha"></ul>
            </div>
          </div>
          <div id="formasEnvio" class="hide" style="display: block;">
            <ul class="hide borda-alpha"></ul>

            <div class="formas envio accordion borda-alpha" id="formas-envio-wrapper"><div class="accordion-group pac forma-envio hide forma-envio-ativo" id="envio2" data-id="2" data-nome="Frete Grátis" data-code="pac" data-valor="0" style="display: block;"><label for="formaEnvio2-pac" class="accordion-heading Frete Grátis"><span class="radio-conteiner"><input type="radio" name="forma_envio" value="2" id="formaEnvio2-pac" checked="checked" data-codigo="pac" data-prazo="9"></span><span class="forma-conteiner"><span class="helper"></span><div class="text-content"><span class="cor-secundaria"><span class="cor-principal envio-preco">R$ 0,00</span><b class="envio-prazo-entrega">9 dias</b></span></div><span class="envio-nome cor-secundaria" id="envio-nome-2">Frete Grátis</span></span></label></div><div class="accordion-group sedex forma-envio hide" id="envio1" data-id="1" data-nome="SEDEX" data-code="sedex" data-valor="41" style="display: none;"><label for="formaEnvio1-sedex" class="accordion-heading SEDEX"><span class="radio-conteiner"><input type="radio" name="forma_envio" value="1" id="formaEnvio1-sedex" data-codigo="sedex" data-prazo="4"></span><span class="forma-conteiner"><span class="helper"></span><div class="text-content"><span class="cor-secundaria"><span class="cor-principal envio-preco">R$ 41,00</span><b class="envio-prazo-entrega">4 dias</b></span></div><span class="envio-nome cor-secundaria" id="envio-nome-1">SEDEX</span></span></label></div></div>
            <p class="warning-text">
              Dias úteis, após confirmação do pagamento.
            </p>
            <input type="hidden" name="forma_envio_code" value="pac" id="forma_envio_code">
          </div>
          <div class="formEndereco-conteiner">
            <hr class="" style="display: block;">

            <div class="row-fluid">
              <div class="control-group span9 required" style="display: block;">
                <label class="control-label font-bold" for="shippingAddressStreet">Endereço</label>
                <div class="controls">
                  <input class="input-xlarge span12" id="shippingAddressStreet" maxlength="255" value="<?=$enderecoPrincipal['end']?>" name="shippingAddressStreet" type="text">
                  <p class="help-block hide">

                  </p>
                </div>
              </div>
              <div class="control-group span3 required" style="display: block;">
                <label class="control-label font-bold" for="shippingAddressNumber">Número</label>
                <div class="controls">
                  <input class="input-mini span12" id="shippingAddressNumber" maxlength="6" value="<?=$enderecoPrincipal['num']?>" name="shippingAddressNumber" type="text">
                  <p class="help-block hide">

                  </p>
                </div>
              </div>
            </div>
            <div class="row-fluid">
              <div class="control-group" style="display: block;">
                <label class="control-label" for="shippingAddressComplement">Complemento</label>
                <div class="controls">
                  <input autocapitalize="off" autocomplete="off" autocorrect="off" value="<?=$enderecoPrincipal['com']?>" class="input-small span12" id="shippingAddressComplement" maxlength="30" name="shippingAddressComplement" spellcheck="false" type="text">
                  <p class="help-block hide">

                  </p>
                </div>
              </div>

            </div>
            <div class="row-fluid">
              <div class="control-group span6 required" style="display: block;">
                <label class="control-label font-bold" for="shippingAddressDistrict">Bairro</label>
                <div class="controls">
                  <input autocapitalize="off" autocomplete="off" autocorrect="off" value="<?=$enderecoPrincipal['bai']?>" class="input-medium span12" id="shippingAddressDistrict" maxlength="128" name="shippingAddressDistrict" spellcheck="false" type="text">
                  <p class="help-block hide">

                  </p>
                </div>
              </div>
              <div class="control-group span6 required" style="display: block;">
                <label class="control-label font-bold" for="shippingAddressCity">Cidade</label>
                <div class="controls">
                  <input autocapitalize="off" autocomplete="off" autocorrect="off" value="<?=$enderecoPrincipal['cid']?>" class="input-medium span12" id="shippingAddressCity" maxlength="128" name="shippingAddressCity" spellcheck="false" type="text">
                  <p class="help-block hide">

                  </p>
                </div>
              </div>
            </div>
            <div class="row-fluid">
              <div class="control-group span6 required" style="display: block;">
                <label class="control-label font-bold" for="shippingAddressState">Estado</label>
                <div class="controls">
                  <select class="span12" id="shippingAddressState" maxlength="2" name="shippingAddressState">
                    <option value="AC" <?=$enderecoPrincipal['est'] == 'AC' ? 'selected' : ''?>>Acre</option>
                    <option value="AL">Alagoas</option>
                    <option value="AP">Amapá</option>
                    <option value="AM">Amazonas</option>
                    <option value="BA">Bahia</option>
                    <option value="CE">Ceará</option>
                    <option value="DF">Distrito Federal</option>
                    <option value="ES">Espírito Santo</option>
                    <option value="GO">Goiás</option>
                    <option value="MA">Maranhão</option>
                    <option value="MT">Mato Grosso</option>
                    <option value="MS">Mato Grosso do Sul</option>
                    <option value="MG">Minas Gerais</option>
                    <option value="PA">Pará</option>
                    <option value="PB">Paraíba</option>
                    <option value="PR">Paraná</option>
                    <option value="PE">Pernambuco</option>
                    <option value="PI">Piauí</option>
                    <option value="RJ">Rio de Janeiro</option>
                    <option value="RN">Rio Grande do Norte</option>
                    <option value="RS">Rio Grande do Sul</option>
                    <option value="RO">Rondônia</option>
                    <option value="RR">Roraima</option>
                    <option value="SC">Santa Catarina</option>
                    <option value="SP" <?=$enderecoPrincipal['est'] == 'SP' ? 'selected' : ''?>>São Paulo</option>
                    <option value="SE">Sergipe</option>
                    <option value="TO">Tocantins</option>
                    </select>
                  <p class="help-block hide">

                  </p>
                </div>
              </div>
              <div class="control-group span6  hide required" style="display: block;">
                <label class="control-label font-bold" for="shippingAddressCountry">País</label>
                <div class="controls">
                  <input class="span12" id="shippingAddressCountry" maxlength="30" name="shippingAddressCountry" type="text" value="BRA" readonly="readonly">
                  <p class="help-block hide">

                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </fieldset>
    </div>

  </div>


  <div class="span4">

    <div class="caixa-sombreada borda-principal">
      <fieldset data-recording-ignore="events">
        <legend class=" cor-secundaria"><i class="icon-money"></i>Pagamento</legend>
        <div class="groupData" id="paymentMethods">

          <div id="paymentMethodsOptions">

            <div class="field radio">
              <input id="creditCardRadio" class="form-control" type="radio" name="changePaymentMethod" value="creditCard" checked>Cartão de Crédito</input>
            </div>

            <div class="field radio">
              <input id="boletoRadio" type="radio" name="changePaymentMethod" value="boleto">Boleto</input>
            </div>

          </div>


          <div id="creditCardData" class="paymentMethodGroup" dataMethod="creditCard">

            <div id="cardData" style="margin-top:-20px">

            <div class="control-group  required">
              <label class="control-label font-bold" for="cardNumber">Número</label>
              <div class="controls">
                <input autocomplete="nome" class="input-xlarge span12 cardDatainput" id="cardNumber" name="cardNumber" type="text">
                  <p class="help-block hide">

                  </p>
                  <span>
                      <img class="bandeiraCartao" id="bandeiraCartao" />
                  </span>
              </div>
            </div>

            <div class="control-group  required">
              <label class="control-label font-bold" for="cardNumber">Data de Vencimento (99/9999)</label>
              <div class="controls">
                  <input type="text" name="cardExpirationMonth" id="cardExpirationMonth" class="cardDatainput input-xlarge span2 month" maxlength="2" /> /
                  <input type="text" name="cardExpirationYear" id="cardExpirationYear" class="cardDatainput input-xlarge span4 year" maxlength="4" />
                  <p class="help-block hide">

                  </p>
              </div>
            </div>

            <div class="control-group  required">
              <label class="control-label font-bold" for="cvvCartao">Código de Segurança</label>
              <div class="controls">
                  <input type="text" name="cardCvv" id="cardCvv" maxlength="5" class="cardDatainput input-xlarge span12 form-control" />
                  <p class="help-block hide">

                  </p>
              </div>
            </div>

            <div class="field" id="installmentsWrapper">
              <label for="installmentQuantity">Parcelamento</label>
              <select name="installmentQuantity" id="installmentQuantity"></select>
              <input type="hidden" name="installmentValue" id="installmentValue" />
            </div>

            <div class="span12" style="margin-top:20px">

              <div class="caixa-sombreada borda-principal">
                <fieldset data-recording-ignore="events">
                  <legend class=" cor-secundaria"><i class="icon-money"></i>Dados do Titular do Cartão</legend>

                    <div id="holderDataChoice">

                      <div class="field radio">
                        <input type="radio" name="holderType" id="sameHolder" value="sameHolder" checked>mesmo que o comprador</input>
                      </div>

                      <div class="field radio">
                        <input type="radio" name="holderType" id="otherHolder" value="otherHolder">outro</input>
                      </div>

                    </div>

                    <div class="control-group field required">
                      <label class="control-label font-bold" for="cvvCartao">Data de Nascimento do Titular do Cartão</label>
                      <div class="controls">
                          <input type="text" name="creditCardHolderBirthDate" id="creditCardHolderBirthDate" maxlength="10" class="cardDatainput input-xlarge span12 form-control" />
                          <p class="help-block hide">

                          </p>
                      </div>
                    </div>

                    <div id="dadosOtherPagador" class="dadosOtherPagador">

                        <div id="holderData">

                          <div class="control-group field required">
                            <label class="control-label font-bold" for="creditCardHolderName">Nome (Como está impresso no cartão)</label>
                            <div class="controls">
                                <input type="text" name="creditCardHolderName" id="creditCardHolderName" class="cardDatainput input-xlarge span12 form-control" />
                                <p class="help-block hide">

                                </p>
                            </div>
                          </div>
                          
                          <div class="control-group field required">
                            <label class="control-label font-bold" for="creditCardHolderCPF">CPF (somente n&uacute;meros) </label>
                            <div class="controls">
                                <input type="text" name="creditCardHolderCPF" id="creditCardHolderCPF" class="cardDatainput input-xlarge span12 form-control" />
                                <p class="help-block hide">

                                </p>
                            </div>
                          </div>

                          <div class="control-group  required" id="TelP">
                            <label class="control-label font-bold" for="creditCardHolderAreaCode">Telefone </label>
                            <div class="controls">
                                <input type="text" name="creditCardHolderAreaCode" id="creditCardHolderAreaCode" class="cardDatainput input-xlarge span2 areaCode" maxlength="2" /> /
                                <input type="text" name="creditCardHolderPhone" id="creditCardHolderPhone" class="cardDatainput input-xlarge span4 phone" maxlength="9" />
                                <p class="help-block hide">

                                </p>
                            </div>
                          </div>

                  </fieldset>
                  </div>

                </div>
            </div>


              <input type="hidden" name="creditCardToken" id="creditCardToken"  />
              <input type="hidden" name="creditCardBrand" id="creditCardBrand"  />
              <center>
                <button type="button" id="creditCardPaymentButton" class="btn btn-success btn-block" onclick="pagarCartao(PagSeguroDirectPayment.getSenderHash());" value="Finalizar compra" />Finalizar compra</button>
              </center>

            </div>
          </div>

          <center>
            <div id="boletoData" name="boletoData" class="paymentMethodGroup" dataMethod="boleto">
              <button type="button" id="boletoButton" value="Gerar Boleto" class="btn btn-primary btn-block" />Gerar Boleto</button>
            </div>

            <br />

          </center>

        </div>

      </fieldset>
    </div>

</div>
</div>

<input id="session_id_field" type="hidden"/>
<input id="sender_hash" type="hidden"/>

 <div class="modal fade" id="modal-enderecos">
    <div class="modal-dialog modal-lg">
         <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                 <h4 class="modal-title">Escolha um Endereço</h4>
             </div>
             <div class="modal-body">
                 <table class="table table-border table-responsive table-hover">
                   <thead>
                    <tr>
                      <th>Cep</th>
                      <th>Endereço</th>
                      <th>Bairro</th>
                      <th>Número</th>
                      <th>Comple.</th>
                      <th>Cidade/Estado</th>
                    </tr>
                   </thead>
                   <tbody>
                     <?php foreach ($enderecos as $endereco): ?>
                        <tr class="endereco-item"
                        data-cep-id="<?=$endereco['val'];?>"
                        data-cep="<?=$endereco['cep'];?>"
                        data-end="<?=$endereco['end'];?>"
                        data-bai="<?=$endereco['bai'];?>"
                        data-num="<?=$endereco['num'];?>"
                        data-com="<?=$endereco['com'];?>"
                        data-cid="<?=$endereco['cid'];?>"
                        data-est="<?=$endereco['est'];?>"
                        >
                          <td><?=$endereco['cep'];?></td>
                          <td><?=$endereco['end'];?></td>
                          <td><?=$endereco['bai'];?></td>
                          <td><?=$endereco['num'];?></td>
                          <td><?=$endereco['com'];?></td>
                          <td><?=$endereco['cid'] . ' - ' . $endereco['est'];?></td>
                        </tr>
                     <?php endforeach;?>
                   </tbody>
                 </table>
             </div>
             <div class="modal-footer">
                 <a href="/minha/conta/meusenderecos" class="btn btn-success">Gerenciar Endereços</a>
                 <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
             </div>
         </div>
     </div>
</div>

<div id="aguarde" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title" id="modal-title">Aguarde...</h1>
      </div>
      <div class="modal-body" id="modal-body" style="font-size: 18px;">
        <a href="" id="verBoleto" target="_blank" style="display: none"><button class="btn btn-success btn-block">Ver o meu boleto</button></a>
      </div>

    </div>

  </div>
</div>

<!--<script type='text/javascript' src='http://localhost:8089/assets/js/checkout.js'></script> -->

<script type="text/javascript" src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>

<script> //Máscaras dos inputs
  jQuery(function($){
  $("#creditCardHolderBirthDate").mask("99/99/9999");
  $("#senderCPF").mask("999.999.999-99");
  $("#creditCardHolderCPF").mask("999.999.999-99");
  $("#shippingAddressPostalCode").mask("99999-999");
  $("#billingAddressPostalCode").mask("99999-999");
  });

  $(document).ready(function() {

    var cep = $('#shippingAddressPostalCode').val();

        //if ($.trim(cep) != '') {

            //var post = 'cep=' + cep.replace('-', '');

            getValorFrete2(post);

        //}
    });

    $.ajax({
      type: 'GET',
      url: '/compras/session',
      cache: false,
      success: function(data) {
        PagSeguroDirectPayment.setSessionId(data);
        $("#session_id_field").val(data);
        $('#sender_hash').val(PagSeguroDirectPayment.getSenderHash());
      }
    });
  });
</script>

<script>

$("input[name='changePaymentMethod']").on('click', function(e) {
    if (e.currentTarget.value == 'creditCard') {
      $('#boletoData').css('display', 'none');
      $('#creditCardData').css('display', 'block');
    } else if (e.currentTarget.value == 'boleto') {
      $('#creditCardData').css('display', 'none');
      $('#boletoData').css('display', 'block');
    }
});

$("input[name='holderType']").on('click', function(e) {
    if (e.currentTarget.value == 'sameHolder') {
      $('#dadosOtherPagador').css('display', 'none');
      ReInserir();
    } else if (e.currentTarget.value == 'otherHolder') {
      $('#dadosOtherPagador').css('display', 'block');
    }
});

$("input[type='text']").on('blur', function(e) {
    if ( ( $("#" + e.currentTarget.id).css('border') == '2px solid rgb(255, 0, 0)') || ($("#" + e.currentTarget.id).css('border') == '2px solid red' ) ) {
      $("#" + e.currentTarget.id).css('border', '1px solid #999');
    }
});

  function ReInserir() {
        $("#creditCardHolderName").val($("#senderName").val());
        $("#creditCardHolderCPF").val($("#senderCPF").val());
        $("#creditCardHolderAreaCode").val($("#senderAreaCode").val());
        $("#creditCardHolderPhone").val($("#senderPhone").val());
        $("#billingAddressPostalCode").val($("#shippingAddressPostalCode").val());
        $("#billingAddressStreet").val($("#shippingAddressStreet").val());
        $("#billingAddressNumber").val($("#shippingAddressNumber").val());
        $("#billingAddressComplement").val($("#shippingAddressComplement").val());
        $("#billingAddressDistrict").val($("#shippingAddressDistrict").val());
        $("#billingAddressCity").val($("#shippingAddressCity").val());
        $("#billingAddressState").val($("#shippingAddressState").val());
        $("#billingAddressCountry").val("BRA");
  }
</script>

<script>

  function parcelasDisponiveis() {
    PagSeguroDirectPayment.getInstallments({
      amount: (($("#totalValue").html()).replace(",", ".")),
      brand: $("#creditCardBrand").val(),
      maxInstallmentNoInterest: 2,

      success: function(response) {
        //console.log(response.installments);
        $("#installmentsWrapper").css('display', "block");


        var installments = response.installments[$("#creditCardBrand").val()];

        var options = '';
        for (var i in installments) {

          var optionItem     = installments[i];
          var optionQuantity = optionItem.quantity;
          var optionAmount   = optionItem.installmentAmount;
          var optionLabel    = (optionQuantity + " x R$ " + (optionAmount.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,').replace(".", ',')));

          options += ('<option value="' + optionItem.quantity + '" valorparcela="' + optionAmount +'">'+ optionLabel +'</option>');

        };

        $("#installmentQuantity").html(options);

      },

      error: function(response) {
        //console.log(response);
      },

      complete: function(response) {
      }
    });
  }

  $("#installmentQuantity").change(function() {
    var option = $(this).find("option:selected");
    if (option.length) {
      $("#installmentValue").val( option.attr("valorparcela") );
    }
  });

  function brandCard() {

    PagSeguroDirectPayment.getBrand({
      cardBin: $("#cardNumber").val(),
      success: function(response) {
        $("#creditCardBrand").val(response.brand.name);
        $("#cardNumber").css('border', '1px solid #999');

        if (response.brand.expirable) {
          $("#expiraCartao").css('display', 'block');
        } else {
          $("#expiraCartao").css('display', 'none');
        }
        if (response.brand.cvvSize > 0) {
          $("#cvvCartao").css('display', 'block');
        } else {
          $("#cvvCartao").css('display', 'none');
        }

        $("#bandeiraCartao").attr('src', 'https://stc.pagseguro.uol.com.br/public/img/payment-methods-flags/68x30/' + response.brand.name + '.png');


        parcelasDisponiveis();

      },

      error: function(response) {
        $("#cardNumber").css('border', '2px solid red');
        $("#cardNumber").focus();
      },

      complete: function(response) {

      }

    });

  }

  function showModal() {
      $("#modal-title").html("Aguarde");
      $("#modal-body").html("");
      $("#aguarde").modal("show");
  }

  //#'{url}compras/carrinho/finalizar/compra';

  function pagarBoleto(senderHash) {
    
    showModal();
    $.ajax({
      type: 'POST',
      url: '/ajax/vendas/pagamentoboleto',
      cache: false,
      data: {
        id: $("#session_id_field").val(),
        email: $("#senderEmail").val(),
        nome: $("#senderName").val(),
        cpf: $("#senderCPF").val(),
        ddd: $("#senderAreaCode").val(),
        telefone: $("#senderPhone").val(),
        cep: $("#shippingAddressPostalCode").val(),
        endereco: $("#shippingAddressStreet").val(),
        numero: $("#shippingAddressNumber").val(),
        complemento: $("#shippingAddressComplement").val(),
        bairro: $("#shippingAddressDistrict").val(),
        cidade: $("#shippingAddressCity").val(),
        estado: $("#shippingAddressState").val(),
        pais: "BRA",
        senderHash: senderHash,
      },
      success: function(data) {

        if (!(data.paymentLink)) {
          //alert(data);
          $("#modal-title").html("<font color='red'>Erro</font>");

          $("#modal-body").html("");
          //console.log(data.error);
          $.each(data.error, function (index, value) {
            if (value.code) {
              //console.log("6 " + value.code);
              tratarError(value.code);
            } else {
              //console.log("7 " + data.error);
              tratarError(data.error.code);
            }

          });
        } else {

              $.ajax({
                  type: 'POST',
                  url: '{url}compras/carrinho/finalizar/compra',
                  cache: false,
                  data: {
                    id: $("#session_id_field").val(),
                    email: $("#senderEmail").val(),
                    nome: $("#senderName").val(),
                    cpf: $("#senderCPF").val(),
                    ddd: $("#senderAreaCode").val(),
                    telefone: $("#senderPhone").val(),
                    cep: $("#shippingAddressPostalCode").val(),
                    endereco: $("#shippingAddressStreet").val(),
                    numero: $("#shippingAddressNumber").val(),
                    complemento: $("#shippingAddressComplement").val(),
                    bairro: $("#shippingAddressDistrict").val(),
                    cidade: $("#shippingAddressCity").val(),
                    estado: $("#shippingAddressState").val(),
                    pais: "BRA",
                    senderHash: senderHash,
                  },
                  success: function(data) {

                    console.log(data)

                     /*setTimeout(function (data) {
                        $("#modal-body").html("");
                        $("#modal-title").html("<font color='red'>Erro!</font>")

                        $("#modal-body").html(data);
                      }, 3500);,*/

                  }
                });

          //window.location = data.paymentLink;
          setTimeout(function () {
            $("#modal-body").html("");
            $("#modal-title").html("<font color='green'>Sucesso!</font>")

            $("#modal-body").html("Caso você não seja redirecionado para o seu boleto, clique no botão abaixo.<br /><br /><a href='" + data.paymentLink + "'><center><img src='images/boleto.png' /><br /><br /><button class='btn-success btn-block btn-lg'>Ir para o meu boleto</button></center></a>");
          }, 3500);
        }

      }
    });

  }

    function pagarCartao(senderHash) {
      showModal();

      PagSeguroDirectPayment.createCardToken({

        cardNumber: $("#cardNumber").val(),
        brand: $("#creditCardBrand").val(),
        cvv: $("#cardCvv").val(),
        expirationMonth: $("#cardExpirationMonth").val(),
        expirationYear: $("#cardExpirationYear").val(),

        success: function (response) {
          $("#creditCardToken").val(response.card.token);
        },
        error: function (response) {
          if (response.error) {
            $("#modal-title").html("<font color='red'>Erro</font>");

            $("#modal-body").html("");
            //console.log("4" + response);
            $.each(response.errors, function (index, value) {
              //console.log(value);
              tratarError(value);
            });
          }
        },
        complete: function (response) {

        }

      });


      $.ajax({
        type: 'POST',
        url: 'pagamentoCartao.php',
        cache: false,
        data: {
          id: $("#session_id_field").val(),
          email: $("#senderEmail").val(),
          nome: $("#senderName").val(),
          cpf: $("#senderCPF").val(),
          ddd: $("#senderAreaCode").val(),
          telefone: $("#senderPhone").val(),
          cep: $("#shippingAddressPostalCode").val(),
          endereco: $("#shippingAddressStreet").val(),
          numero: $("#shippingAddressNumber").val(),
          complemento: $("#shippingAddressComplement").val(),
          bairro: $("#shippingAddressDistrict").val(),
          cidade: $("#shippingAddressCity").val(),
          estado: $("#shippingAddressState").val(),
          pais: "BRA",
          senderHash: senderHash,

          enderecoPagamento: $("#billingAddressStreet").val(),
          numeroPagamento: $("#billingAddressNumber").val(),
          complementoPagamento: $("#billingAddressComplement").val(),
          bairroPagamento: $("#billingAddressDistrict").val(),
          cepPagamento: $("#billingAddressPostalCode").val(),
          cidadePagamento: $("#billingAddressCity").val(),
          estadoPagamento: $("#billingAddressState").val(),
          cardToken: $("#creditCardToken").val(),
          cardNome: $("#creditCardHolderName").val(),
          cardCPF: $("#creditCardHolderCPF").val(),
          cardNasc: $("#creditCardHolderBirthDate").val(),
          cardFoneArea: $("#creditCardHolderAreaCode").val(),
          cardFoneNum: $("#creditCardHolderPhone").val(),

          numParcelas: $("#installmentQuantity").val(),
          valorParcelas: $("#installmentValue").val(),

        },
        success: function(data) {
          //console.log(data);
          if (data.error) {
            if (data.error.code == "53037") {
              $("#creditCardPaymentButton").click();
            } else {
              $("#modal-title").html("<font color='red'>Erro</font>");

              $("#modal-body").html("");
              $.each(data.error, function (index, value) {
                if (value.code) {
                  tratarError(value.code);

                } else {
                  tratarError(data.error.code)
                }
              })
              //console.log("2 " + data);
            }
          } else {


            $.ajax({
              type: 'POST',
              url: 'getStatus.php',
              cache: false,
              data: {
                id: data.code,
              },
              success: function(status) {

                if (status == "7") {
                  //alert(data);
                  $("#modal-title").html("<font color='red'>Erro</font>");

                  $("#modal-body").html("Erro ao processar o seu pagamento.<br/> Não se preocupe pois esse valor <b>não será debitado de sua conta ou não constará em sua fatura</b><br /><br />Verifique se você possui limite suficiente para efetuar a transação e/ou tente um cartão diferente");

                } else {
                  window.location = "http://download.infoenem.com.br/pagamento-efetuado/";
                  setTimeout(function () {
                    $("#modal-body").html("");
                    $("#modal-title").html("<font color='green'>Sucesso!</font>")

                    $("#modal-body").html("Caso você não seja redirecionado para a nossa página de instruções, clique no botão abaixo.<br /><br /><a href='http://download.infoenem.com.br/pagamento-efetuado/'><center><button class='btn-success btn-block btn-lg'>Ir para a página de instruções</button></center></a>");
                  }, 1500);
                }

              }
            });


            //console.log("1 " + data);
          }

          }

      });

    }



</script>

<script>
    $(document).ready(function() {

      //PagSeguroDirectPayment.setSessionId('sessao');

      //PagSeguroDirectPayment.getPaymentMethods({});});

      $('.endereco-item').click(function() {
          $("#shippingAddressPostalCodeId").val($(this).data('cep-id'))
          $("#shippingAddressPostalCode").val($(this).data('cep'))
          $("#shippingAddressStreet").val($(this).data('end'))
          $("#shippingAddressDistrict").val($(this).data('bai'))
          $("#shippingAddressNumber").val($(this).data('num'))
          $("#shippingAddressComplement").val($(this).data('com'))
          $("#shippingAddressCity").val($(this).data('cid'))
          $("#shippingAddressState").val($(this).data('est'))
          $('#modal-enderecos').modal('hide');
      });

      $('#creditCardBrand').blur(function() {
        brandCard();
      });

      function tratarError(id) {
        if (id.charAt(0) == '2') id = id.substr(1);
        if (id == "53020" || id == '53021') {
          $("#modal-body").append("<p>Verifique telefone inserido</p>");
          $("#senderPhone").css('border', '2px solid red');

        } else if (id == "53010" || id == '53011' || id == '53012') {
          $("#modal-body").append("<p>Verifique o e-mail inserido</p>");
          $("#senderEmail").css('border', '2px solid red');

        } else if (id == "53017") {
          $("#modal-body").append("<p>Verifique o CPF inserido</p>");
          $("#senderCPF").css('border', '2px solid red');

        } else if (id == "53018" || id == "53019") {
          $("#modal-body").append("<p>Verifique o DDD inserido</p>");
          $("#senderAreaCode").css('border', '2px solid red');

        } else if (id == "53013" || id == '53014' || id == '53015') {
          $("#modal-body").append("<p>Verifique o nome inserido</p>");
          $("#senderName").css('border', '2px solid red');

        } else if (id == "53029" || id == '53030') {
          $("#modal-body").append("<p>Verifique o bairro inserido</p>");
          $("#shippingAddressDistrict").css('border', '2px solid red');

        } else if (id == "53022" || id == '53023') {
          $("#modal-body").append("<p>Verifique o CEP inserido</p>");
          $("#shippingAddressPostalCode").css('border', '2px solid red');

        } else if (id == "53024" || id == '53025') {
          $("#modal-body").append("<p>Verifique a rua inserido</p>");
          $("#shippingAddressStreet").css('border', '2px solid red');

        } else if (id == "53026" || id == '53027') {
          $("#modal-body").append("<p>Verifique o número inserido</p>");
          $("#shippingAddressNumber").css('border', '2px solid red');

        } else if (id == "53033" || id == '53034') {
          $("#modal-body").append("<p>Verifique o estado inserido</p>");
          $("#shippingAddressState").css('border', '2px solid red');

        } else if (id == "53031" || id == '53032') {
          $("#modal-body").append("<p>Verifique a cidade informada</p>");
          $("#shippingAddressCity").css('border', '2px solid red');

        } else if (id == '10001') {
          $("#modal-body").append("<p>Verifique o número do cartão inserido</p>");
          $("#cardNumber").css('border', '2px solid red');

        } else if (id == '10002' || id == '30405') {
          $("#modal-body").append("<p>Verifique a data de validade do cartão inserido</p>");
          $("#cardExpirationMonth").css('border', '2px solid red');
          $("#cardExpirationYear").css('border', '2px solid red');

        } else if (id == '10004') {
          $("#modal-body").append("<p>É obrigatorio informar o código de segurança, que se encontra no verso, do cartão</p>");
          $("#cardCvv").css('border', '2px solid red');

        } else if (id == '10006' || id == '10003' || id == '53037') {
          $("#modal-body").append("<p>Verifique o código de segurança do cartão informado</p>");
          $("#cardCvv").css('border', '2px solid red');

        } else if (id == '30404') {
          $("#modal-body").append("<p>Ocorreu um erro. Atualize a página e tente novamente!</p>");

        } else if (id == '53047') {
          $("#modal-body").append("<p>Verifique a data de nascimento do titular do cartão informada</p>");
          $("#creditCardHolderBirthDate").css('border', '2px solid red');

        } else if (id == '53053' || id == '53054') {
          $("#modal-body").append("<p>Verifique o CEP inserido</p>");
          $("#billingAddressPostalCode").css('border', '2px solid red');

        } else if (id == '53055' || id == '53056') {
          $("#modal-body").append("<p>Verifique a rua inserido</p>");
          $("#billingAddressStreet").css('border', '2px solid red');

        } else if (id == '53042' || id == '53043' || id == '53044') {
          $("#modal-body").append("<p>Verifique o nome inserido</p>");
          $("#creditCardHolderName").css('border', '2px solid red');

        } else if (id == '53057' || id == '53058') {
          $("#modal-body").append("<p>Verifique o número inserido</p>");
          $("#billingAddressNumber").css('border', '2px solid red');

        } else if (id == '53062' || id == '53063') {
          $("#modal-body").append("<p>Verifique a cidade informada</p>");
          $("#billingAddressCity").css('border', '2px solid red');

        } else if (id == '53045' || id == '53046') {
          $("#modal-body").append("<p>Verifique o CPF inserido</p>");
          $("#creditCardHolderCPF").css('border', '2px solid red');

        } else if (id == '53060' || id == '53061') {
          $("#modal-body").append("<p>Verifique o bairro inserido</p>");
          $("#billingAddressDistrict").css('border', '2px solid red');

        } else if (id == '53064' || id == '53065') {
          $("#modal-body").append("<p>Verifique o estado inserido</p>");
          $("#billingAddressState").css('border', '2px solid red');

        } else if (id == '53051' || id == '53052') {
          $("#modal-body").append("<p>Verifique telefone inserido</p>");
          $("#billingAddressState").css('border', '2px solid red');

        } else if (id == '53049' || id == '53050') {
          $("#modal-body").append("<p>Verifique o código de área informado</p>");
          $("#creditCardHolderAreaCode").css('border', '2px solid red');

        } else if (id == '53122') {
          $("#modal-body").append("<p>Enquanto na sandbox do PagSeguro, o e-mail deve ter o domínio '@sandbox.pagseguro.com.br' (ex.: comprador@sandbox.pagseguro.com.br)</p>");

        }

        // else {
        //   $("#modal-body").append("<p>"+ id + "</p>");
        // }
      }

      $('#boletoButton').click(function() {
        //alert('clicado')
          showModal();
          $.ajax({
            type: 'POST',
            url: '/compras/checkout/pagamentoboleto',
            cache: false,
            data: {
              id: $("#session_id_field").val(),
              email: $("#senderEmail").val(),
              nome: $("#senderName").val(),
              cpf: $("#senderCPF").val(),
              ddd: $("#senderAreaCode").val(),
              telefone: $("#senderPhone").val(),
              cep: $("#shippingAddressPostalCode").val(),
              endereco: $("#shippingAddressStreet").val(),
              numero: $("#shippingAddressNumber").val(),
              complemento: $("#shippingAddressComplement").val(),
              bairro: $("#shippingAddressDistrict").val(),
              cidade: $("#shippingAddressCity").val(),
              estado: $("#shippingAddressState").val(),
              pais: "BRA",
              senderHash: PagSeguroDirectPayment.getSenderHash(),
              tpPag: 2,
              gateway: 1,
              enderecoId: $("#shippingAddressPostalCodeId").val()
            },
            success: function(data) {

              if (!(data.paymentLink)) {
                //alert(data);
                $("#modal-title").html("<font color='red'>Erro</font>");

                $("#modal-body").html("");

                //console.log(data.error);
                $.each(data.error, function (index, value) {

                  if (value.code) {
                    //console.log("6 " + value.code);
                    tratarError(value.code);
                  } else {
                    //console.log("7 " + data.error);
                    tratarError(data.error.code);
                  }

                });
              } else {

                //window.location = data.paymentLink;
                setTimeout(function () {
                  $("#modal-body").html("");
                  $("#modal-title").html("<font color='green'>Sucesso!</font>")

                  $("#modal-body").html("Caso você não seja redirecionado para o seu boleto, clique no botão abaixo.<br /><br /><a href='" + data.paymentLink + "'><center><img src='images/boleto.png' /><br /><br /><button class='btn-success btn-block btn-lg'>Ir para o meu boleto</button></center></a>");
                }, 3500);
              }

            }
          });
      });

    });



</script>

