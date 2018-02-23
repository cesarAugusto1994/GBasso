<div id="corpo">
    <div class="conteiner">

        <div class="secao-principal row-fluid sem-coluna">

        <div class="campos-pedido">
            <div class="cabecalho-interno row-fluid">
                <div class="col-md-12">
                  <h1 class="cor-secundaria">
                  Finalizar compra <small> Preencha os dados necessários para finalizar o pedido.</small>
                  </h1>
                </div>
            </div>
        </div>
        <div class="campos-pedido">

        <div class="row-fluid">
        <div class="col-md-12">
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
              if (count($carrinho) > 0):
                  $attr = '';
                  $index = 0;
                  foreach ($carrinho as $key => $value):
                  ?>

                                <tr>
                                  <td class="phone-pullleft" data-produto-id="24316594" data-produto-quantidade="1">
                                    <div class="produto-info">
                                      <a href="<?=$value['link'];?>" class="cor-secundaria">
                                              <?=$value['prod'];?>
                                        </a>
                                      <ul>
                                        <li>
                                          <span>
                                            Referencia:
                                            <strong>
                                              <?=$value['refe'];?>
                                            </strong>
                                          </span>
                                        </li>

                                      </ul>
                                    </div>
                                  </td>
                                  <td class="conteiner-qtd">
                                      <div><?=$value['qtd'];?></div>
                                  </td>
                                  <td class="conteiner-preco padding-preco">
                                    <div class="preco-produto">
                                      <strong class="preco-promocional cor-principal">
                                          R$ <?=number_format($value['valor_int'] * $value['qtd'], 2, ',', '.');?>
                                      </strong>
                                    </div>
                                  </td>
                                </tr>

                                <?php
                  $index++;
              endforeach;
              else:
                  echo "<tr><td colspan='6' style='text-align: center;'>Seu carrinho está vázio</td></tr>";
              endif;
              ?>

              <tr class="bg-dark esconder-mobile">
                <td>&nbsp;</td>
                <td class="text-right">
                  <span>Subtotal:</span>
                </td>
                <td class="padding-preco">
                  <div class="subtotal" data-subtotal="<?=$total;?>" data-float="<?=$total;?>">
                    <strong class=" cor-principal">
                      R$ <?=$total;?>
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
                    <strong class=" cor-principal" style="display: inline;">R$ <span id="valorFrete"></span></strong>
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
                  <div class="total" data-total="<?=$total;?>">
                    <strong class=" cor-principal preco-carrinho-total">R$ <span id="totalValue"><?=$total;?></span></strong>
                  </div>
                </td>
              </tr>
            </tbody></table>

          </div>
        </div>
        </div>

        <form action="#" method="POST" id="formularioCheckout">

        <div class="row-fluid" style="display: block;">
          <div class="col-lg-4 col-xs-12 ">
            <div class="caixa-sombreada borda-principal dados-cadastro">
              <fieldset data-recording-ignore="events">

                <legend class=" cor-secundaria"><i class="icon-list"></i>Cliente</legend>

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
                      <div class="control-group span12 required" style="margin-left: 0;">
                        <label class="control-label font-bold" for="senderAreaCode">Telefone</label>
                        <div class="controls">
                          <input class="input-small span3" id="senderAreaCode" name="senderAreaCode" tel="" type="tel" maxlength="3" value="<?= $ddd; ?>">
                          <input class="input-small span9" id="senderPhoneNumber" name="senderPhoneNumber" tel="" type="tel" maxlength="10" value="<?= $telefone; ?>">
                          <p class="help-block hide">

                          </p>
                        </div>
                      </div>

                    </div>
                  </div><!-- /userExtraInfo -->

              </fieldset>

            </div>
          </div>
          <div class="col-lg-4 col-xs-12 ">
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
                        <input readonly autocapitalize="off" autocomplete="off" autocorrect="off" class="input-small" id="shippingAddressPostalCode" value="<?=$enderecoPrincipal['cep']?>" name="shippingAddressPostalCode" spellcheck="false" type="tel" maxlength="9">
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
                          <input readonly class="input-xlarge span12" id="shippingAddressStreet" maxlength="255" value="<?=$enderecoPrincipal['end']?>" name="shippingAddressStreet" type="text">
                          <p class="help-block hide">

                          </p>
                        </div>
                      </div>
                      <div class="control-group span3 required" style="display: block;">
                        <label class="control-label font-bold" for="shippingAddressNumber">Número</label>
                        <div class="controls">
                          <input readonly class="input-mini span12" id="shippingAddressNumber" maxlength="6" value="<?=$enderecoPrincipal['num']?>" name="shippingAddressNumber" type="text">
                          <p class="help-block hide">

                          </p>
                        </div>
                      </div>
                    </div>
                    <div class="row-fluid">
                      <div class="control-group" style="display: block;">
                        <label class="control-label" for="shippingAddressComplement">Complemento</label>
                        <div class="controls">
                          <input readonly autocapitalize="off" autocomplete="off" autocorrect="off" value="<?=$enderecoPrincipal['com']?>" class="input-small span12" id="shippingAddressComplement" maxlength="30" name="shippingAddressComplement" spellcheck="false" type="text">
                          <p class="help-block hide">

                          </p>
                        </div>
                      </div>

                    </div>
                    <div class="row-fluid">
                      <div class="control-group span6 required" style="display: block;">
                        <label class="control-label font-bold" for="shippingAddressDistrict">Bairro</label>
                        <div class="controls">
                          <input readonly autocapitalize="off" autocomplete="off" autocorrect="off" value="<?=$enderecoPrincipal['bai']?>" class="input-medium span12" id="shippingAddressDistrict" maxlength="128" name="shippingAddressDistrict" spellcheck="false" type="text">
                          <p class="help-block hide">

                          </p>
                        </div>
                      </div>
                      <div class="control-group span6 required" style="display: block;">
                        <label class="control-label font-bold" for="shippingAddressCity">Cidade</label>
                        <div class="controls">
                          <input readonly autocapitalize="off" autocomplete="off" autocorrect="off" value="<?=$enderecoPrincipal['cid']?>" class="input-medium span12" id="shippingAddressCity" maxlength="128" name="shippingAddressCity" spellcheck="false" type="text">
                          <p class="help-block hide">

                          </p>
                        </div>
                      </div>
                    </div>
                    <div class="row-fluid">
                      <div class="control-group span6 required" style="display: block;">
                        <label class="control-label font-bold" for="shippingAddressState">Estado</label>
                        <div class="controls">
                          <select readonly class="span12" id="shippingAddressState" maxlength="2" name="shippingAddressState">
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
                            <option value="Sao Paulo" <?=$enderecoPrincipal['est'] == 'SP' || $enderecoPrincipal['est'] == 'Sao Paulo' ? 'selected' : ''?>>São Paulo</option>
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


          <div class="col-lg-4 col-xs-12 ">

            <div class="caixa-sombreada borda-principal">
              <fieldset data-recording-ignore="events">
                <legend class=" cor-secundaria"><i class="icon-money"></i>Pagamento</legend>
                <!--<form class='formPagseguro' method='POST' action='{url}compras/carrinho/finalizar/compra'>-->
                    <div class="groupData" id="paymentMethods">

                      <div id="paymentMethodsOptions">

                        <div class="field radio">
                          <label><input type="radio" id="creditCardRadio" name="changePaymentMethod" value="creditCard">Cartão de Crédito</label>
                        </div>

                        <div class="field radio">
                          <label><input type="radio" id="boletoRadio" name="changePaymentMethod" value="boleto">Boleto</label>
                        </div>


                      </div>

                      <br/>
                      <br/>

                      <div id="creditCardData" class="paymentMethodGroup" dataMethod="creditCard">

                        <div id="cardData" style="margin-top:-20px">

                        <div class="control-group  required">
                          <label class="control-label font-bold" for="cardNumber">Número</label>
                          <div class="controls">
                            <input autocomplete="nome" class="input-xlarge span12 cardDatainput" id="cardNumber" name="cardNumber" type="text" maxlength="16">
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
                              <input type="text" name="cardExpirationYear" id="cardExpirationYear" class="cardDatainput input-xlarge span4    year" maxlength="4" />
                              <p class="help-block hide">

                              </p>
                          </div>
                        </div>

                        <div class="control-group  required">
                          <label class="control-label font-bold" for="cvvCartao">Código de Segurança</label>
                          <div class="controls">
                              <input type="text" name="cardCvv" id="cardCvv" maxlength="3" class="cardDatainput input-xlarge span6 form-control"/>
                              <p class="help-block hide">

                              </p>
                          </div>
                        </div>

                        <div class="field" id="installmentsWrapper">
                          <label for="installmentQuantity">Parcelamento</label>
                          <select name="installmentQuantity" id="installmentQuantity"></select>
                          <input type="hidden" name="installmentValue" id="installmentValue" />
                          <input type="hidden" name="totalAmount" id="totalAmount" />
                        </div>

                        <div class="span12" style="margin-top:20px">

                          <div class="caixa-sombreada borda-principal">
                            <fieldset data-recording-ignore="events">
                              <legend class=" cor-secundaria"><i class="icon-money"></i>Dados do Titular do Cartão</legend>

                                <div id="holderDataChoice">

                                  <div class="field radio">
                                    <input type="radio" name="holderType" id="sameHolder" value="sameHolder">mesmo que o comprador</input>
                                  </div>

                                  <div class="field radio">
                                    <input type="radio" name="holderType" id="otherHolder" value="otherHolder">outro</input>
                                  </div>

                                </div>

                                <div class="control-group field required">
                                  <label class="control-label font-bold" for="cvvCartao">Data de Nascimento do Titular do Cartão</label>
                                  <div class="controls">
                                      <input type="text" name="creditCardHolderBirthDate" id="creditCardHolderBirthDate" maxlength="10" class="cardDatainput input-xlarge span12 form-control" />
                                      <p class="help-block">

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
                                            <input type="text" name="creditCardHolderPhone" id="creditCardHolderPhone" class="cardDatainput input-xlarge col-lg-4 col-xs-12  phone" maxlength="9" />
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
                            <button type="button" id="creditCardPaymentButton" class="btn btn-success btn-block" />Finalizar compra</button>
                          </center>
                        </div>
                      </div>
                      <center>
                        <div id="boletoData" name="boletoData" class="paymentMethodGroup" dataMethod="boleto">
                          <button id="boletoButton" class="btn btn-primary btn-block" />Gerar Boleto e Finalizar Compra</button>
                        </div>
                        <br />
                      </center>

                      <center>
                        <div>
                          <a href="http://www.grupobasso.com.br/" class="btn btn-white btn-block" />Continuar Comprando</a>
                        </div>
                        <br />
                      </center>

                    </div>
                <!--</form>-->
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
                        <table class="table table-responsive table-hover">
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
          <div class="modal-dialog modal-backdrop">

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

    </div>

    </div>
    </div>

    <input type="hidden" value="<?= $parcelasSemJuros; ?>" id="parcelas-sem-juros"/>
    <input type="hidden" value="0" id="venda-finalizada"/>

<script type="text/javascript" src="https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>
<script src="http://www.grupobasso.com.br/assets/js/checkout.js?v2"></script>
