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

    <div class="campos-pedido">

      <div id="login-content" class="">
        <div class="row-fluid identificacao">
          <div class="span12">
            <hr class="sem-margem">
            <div class="identificacao-inner">
              <h3 class="identificacao-title">Se já possui cadastro basta acessar com o seu usuário e senha.</h3>
              <form action="{url}ajax/minha/conta/logar" method="post" class="formLoginCheckout" id="formLoginCheckout">
                <div class="form-horizontal">
                  <div class="control-group">
                    <div class="email-box">
                      <label for="id_email" class="control-label hide">E-mail</label>
                      <input type="text" name="user" id="email" autocomplete="email" value="<?= $email; ?>" required placeholder="meu@email.com.br">
                    </div>
                  </div>
                  <div class="login-data">
                    <div class="control-group">
                      <button type="submit" id="id_botao_login" class="botao principal" data-loading-text="<i class='icon-refresh icon-animate'></i>" autocomplete="off">Entrar</button>
                      <div class="senha-box">
                        <label for="id_senha" class="control-label hide">Senha</label>
                        <input type="password" name="pass" id="pass" placeholder="Senha" required autocomplete="current-password">
                      </div>
                      <!--<a href="https://localhost:8089/conta/login?next=/checkout/#recuperar_senha" class="esqueci-senha">
                        <i class="icon-lock"></i> Esqueci minha senha
                      </a>-->
                      <a href="javascript:;" class="fazer-cadastro">
                        <i class="icon-list"></i> Novo cadastro
                      </a>
                    </div>
                    <input type="hidden" name="next" value="/checkout/">
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
                  <div class="subtotal" data-subtotal="364,80" data-float="364.8">
                    <strong class="cor-principal">
                      R$ <?= $total; ?>
                    </strong>
                  </div>
                </td>
              </tr>
              <tr class="bg-dark esconder-mobile tr-checkout-frete hide" style="display: table-row;">
                <td>&nbsp;</td>
                <td class="text-right">
                  <span>Frete:</span>
                </td>
                <td class="padding-preco">
                  <div class="frete-preco">
                    <small class="muted" style="display: none;">(defina abaixo)</small>
                    <strong class="titulo cor-principal hide" style="display: inline;">R$ 0,00</strong>
                  </div>
                </td>
              </tr>

              
              
                <tr class="bg-dark esconder-mobile desconto-tr hide" style="">
                  <td>&nbsp;</td>
                  <td class="text-right">
                    <span>Desconto à vista:</span>
                    <small class="hide texto-aplicar-total muted">(frete não incluso)</small>
                  </td>
                  <td class="padding-preco">
                    <div class="desconto-preco">
                      <strong class="titulo cor-principal">R$ 0,00</strong>
                    </div>
                  </td>
                </tr>
              
              <tr class="bg-dark tr-checkout-total hide" style="display: table-row;">
                <td colspan="2" class="text-right hidden-phone">
                  <span>Total:</span>
                </td>
                <td class="padding-preco">
                  <span class="visible-phone">Total:</span>
                  <div class="total" data-total="364.8">
                    <strong class="titulo cor-principal preco-carrinho-total">R$ <?= $total; ?></strong>
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

      
      <form action="http://www.grupobasso.com.br/compras/checkout" method="POST" id="formularioCheckout">
      
        <div class="row-fluid hide" data-recording-disable="">
          <div class="span4">
            <div class="caixa-sombreada borda-principal dados-cadastro">
              <fieldset data-recording-ignore="events">

                
                <legend class="titulo cor-secundaria"><i class="icon-list"></i>Novo cadastro ou <a href="javascript:;" class="titulo cor-secundaria fazer-login-btn" style="text-decoration: underline;">identifique-se</a></legend>
                

                

                  <input id="id_tipo" name="tipo" type="hidden" value="PF">
                  <input id="id_tipo_usuario" name="tipo_usuario" type="hidden" value="PF">

                  <div class="control-group  required">
                    <label class="control-label font-bold" for="id_email">E-mail</label>
                    <div class="controls">
                      <input autocomplete="email" class="input-xlarge span12" id="id_email" maxlength="128" name="email" type="text">
                        <p class="help-block hide">
                          
                        </p>
                    </div>
                  </div>

                  <div class="row-fluid">
                    <div class="control-group span6  required">
                      <label class="control-label font-bold" for="id_senha">Criar senha</label>
                      <div class="controls">
                        <input class="input-small span12" id="id_senha" maxlength="32" name="senha" type="password">
                          <p class="help-block hide">
                            
                          </p>
                      </div>
                    </div>

                    <div class="control-group span6  required">
                      <label class="control-label font-bold" for="id_confirmacao_senha">Confirmar senha</label>
                      <div class="controls">
                        <input class="input-small span12" id="id_confirmacao_senha" maxlength="32" name="confirmacao_senha" type="password">
                          <p class="help-block hide">
                            
                          </p>
                      </div>
                    </div>
                  </div>
                  <div id="userExtraInfo">
                  <ul id="tipoCadastro" class="row-fluid tipo-cadastro divisor borda-alpha">
                    <li class="span6 active">
                      <a href="#tipoFisica" id="tabCadastroPessoaFisica" class="cor-secundaria" data-toggle="tab" data-value="PF">
                        <b>
                          <i class="icon-check icon-fixed-width"></i>
                          <i class="icon-check-empty icon-fixed-width"></i>&nbsp; Pessoa Física
                        </b>
                      </a>
                    </li>
                    <li class="span6">
                      <a href="#tipoJuridica" id="tabCadastroPessoaJuridica" class="cor-secundaria" data-toggle="tab" data-value="PJ">
                        <b>
                          <i class="icon-check icon-fixed-width"></i>
                          <i class="icon-check-empty icon-fixed-width"></i>&nbsp; Pessoa Jurídica
                        </b>
                      </a>
                    </li>
                  </ul>

                  <div class="row-fluid campos-top">
                    <div class="control-group  required">
                      <label class="control-label font-bold" for="id_nome">Nome completo</label>
                      <div class="controls">
                        <input autocomplete="name" class="input-xlarge span12" id="id_nome" maxlength="255" name="nome" type="text">
                        <p class="help-block hide">
                          
                        </p>
                      </div>
                    </div>
                  </div>

                  <div class="tab-content">
                    <div class="row-fluid tab-pane fade active" id="tipoFisica">

                      <div class="control-group span6  required">
                        <label class="control-label font-bold" for="id_cpf">CPF</label>
                        <div class="controls">
                          <input autocapitalize="off" autocomplete="off" autocorrect="off" class="input-small span12" id="id_cpf" maxlength="14" name="cpf" spellcheck="false" type="tel">
                            <p class="help-block hide">
                              
                            </p>
                        </div>
                      </div>

                      <div class="campo-checkout-sexo control-group span6  required" style="margin-left: 0; clear: both;">
                        <label class="control-label font-bold" for="id_sexo">Sexo</label>
                        <div class="controls">
                          <select class="input-medium span12" id="id_sexo" name="sexo">
<option value="" selected="selected"> - Selecione - </option>
<option value="m">Masculino</option>
<option value="f">Feminino</option>
</select>
                            <p class="help-block hide">
                              
                            </p>
                        </div>
                      </div>

                      <div class="campo-checkout-nascimento control-group span6  required">
                        <label class="control-label font-bold" for="id_data_nascimento">Data de nascimento</label>
                        <div class="controls">
                          <input autocapitalize="off" autocomplete="off" autocorrect="off" class="input-small span12" id="id_data_nascimento" name="data_nascimento" spellcheck="false" type="text" maxlength="10">
                            <p class="help-block ">
                              
                            </p>
                        </div>
                      </div>
                    </div>

                    <div class="tab-pane fade in" id="tipoJuridica">
                      <div class="row-fluid">
                        <div class="control-group span6  required">
                          <label class="control-label font-bold" for="id_cnpj">CNPJ</label>
                          <div class="controls">
                            <input autocapitalize="off" autocomplete="off" autocorrect="off" class="input-medium span12" id="id_cnpj" maxlength="18" name="cnpj" spellcheck="false" type="text">
                              <p class="help-block hide">
                                
                              </p>
                          </div>
                        </div>
                        <div class="control-group span6">
                          <label class="control-label" for="id_%s">Inscrição Estadual</label>
                          <div class="controls">
                            <input autocapitalize="off" autocomplete="off" autocorrect="off" class="input-medium span12" id="id_ie" maxlength="128" name="ie" spellcheck="false" type="text">
                              <p class="help-block hide">
                                
                              </p>
                          </div>
                        </div>
                      </div>
                      <div class="control-group  required">
                        <label class="control-label font-bold" for="id_razao_social">Razão Social</label>
                        <div class="controls">
                          <input class="input-big span12" id="id_razao_social" maxlength="128" name="razao_social" type="text">
                            <p class="help-block hide">
                              
                            </p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row-fluid campos-bot">
                      <div class="control-group span6  required" style="margin-left: 0;">
                        <label class="control-label font-bold" for="id_telefone_celular">Celular</label>
                        <div class="controls">
                          <input autocapitalize="off" autocomplete="off" autocorrect="off" class="input-small span12" id="id_telefone_celular" name="telefone_celular" spellcheck="false" tel="" type="tel" maxlength="15">
                            <p class="help-block hide">
                              
                            </p>
                        </div>
                      </div>
                      <div class="control-group span6">
                        <label class="control-label" for="id_telefone_principal">Telefone fixo</label>
                        <div class="controls">
                          <input autocapitalize="off" autocomplete="off" autocorrect="off" class="input-small span12" id="id_telefone_principal" name="telefone_principal" spellcheck="false" type="tel" maxlength="15">
                            <p class="help-block hide">
                              
                            </p>
                        </div>
                      </div>
                      <div class="control-group span6  hide" style="margin-left: 0;">
                        <label class="control-label" for="id_telefone_comercial">Telefone comercial</label>
                        <div class="controls">
                          <input autocapitalize="off" autocomplete="off" autocorrect="off" class="input-small span12" id="id_telefone_comercial" name="telefone_comercial" spellcheck="false" type="tel" maxlength="15">
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
                <legend class="titulo cor-secundaria"><i class="icon-map-marker"></i>Entrega</legend>

                <div id="formularioEndereco">
                  <div id="exibirFormasEnvio" class="hide pull-right" style="margin-bottom: 15px; margin-top: 25px; display: block;">
                    <a href="javascript:;" class="btn btn-small"><i class="icon-pencil"></i> Alterar entrega</a>
                  </div>
                  <div class="formEndereco-conteiner">
                    <div class="control-group  required" style="margin-bottom: 20px;">
                      <label class="control-label font-bold" for="id_cep">CEP</label>
                      <div class="controls">
                        <input autocapitalize="off" autocomplete="off" autocorrect="off" class="input-small" id="id_cep" name="cep" spellcheck="false" type="tel" value="29980000" maxlength="9">
                          <p class="help-block hide">
                            
                          </p>
                      </div>
                      <div class="envio-erro alert alert-errors alert-error hide" style="margin: 10px 0px; display: none;">
                        CEP não informado
                      </div>
                      <ul class="hide borda-alpha">
                      </ul>
                    </div>
                  </div>

                  <div id="formasEnvio" class="hide" style="display: block;">
                    <ul class="hide borda-alpha"></ul>
                    
                    <div class="formas envio accordion borda-alpha" id="formas-envio-wrapper">
                    <div class="accordion-group pac forma-envio hide forma-envio-ativo" id="envio2" data-id="2" data-nome="Frete Grátis" data-code="pac" data-valor="0" style="display: block;"><label for="formaEnvio2-pac" class="accordion-heading Frete Grátis"><span class="radio-conteiner"><input type="radio" name="forma_envio" value="2" id="formaEnvio2-pac" checked="checked" data-codigo="pac" data-prazo="9"></span><span class="forma-conteiner"><span class="helper"></span><div class="text-content"><span class="cor-secundaria"><span class="cor-principal envio-preco">R$ 0,00</span><b class="envio-prazo-entrega">9 dias</b></span></div><span class="envio-nome cor-secundaria" id="envio-nome-2">Frete Grátis</span></span></label></div><div class="accordion-group sedex forma-envio hide" id="envio1" data-id="1" data-nome="SEDEX" data-code="sedex" data-valor="41" style="display: none;"><label for="formaEnvio1-sedex" class="accordion-heading SEDEX"><span class="radio-conteiner"><input type="radio" name="forma_envio" value="1" id="formaEnvio1-sedex" data-codigo="sedex" data-prazo="4"></span><span class="forma-conteiner"><span class="helper"></span><div class="text-content"><span class="cor-secundaria"><span class="cor-principal envio-preco">R$ 41,00</span><b class="envio-prazo-entrega">4 dias</b></span></div><span class="envio-nome cor-secundaria" id="envio-nome-1">SEDEX</span></span></label></div></div>
                    <p class="warning-text">
                      Dias úteis, após confirmação do pagamento.
                    </p>
                    <input type="hidden" name="forma_envio_code" value="pac" id="forma_envio_code">
                  </div>

                  <div class="formEndereco-conteiner">
                    <hr class="hide" style="display: block;">
                    
                    <div class="row-fluid">
                      <div class="control-group span9  hide required" style="display: block;">
                        <label class="control-label font-bold" for="id_endereco">Endereço</label>
                        <div class="controls">
                          <input class="input-xlarge span12" id="id_endereco" maxlength="255" name="endereco" type="text">
                            <p class="help-block hide">
                              
                            </p>
                        </div>
                      </div>

                      <div class="control-group span3  hide required" style="display: block;">
                        <label class="control-label font-bold" for="id_numero">Número</label>
                        <div class="controls">
                          <input class="input-mini span12" id="id_numero" maxlength="6" name="numero" type="text">
                            <p class="help-block hide">
                              
                            </p>
                        </div>
                      </div>
                    </div>

                    <div class="row-fluid">
                      <div class="control-group span6  hide" style="display: block;">
                        <label class="control-label" for="id_complemento">Complemento</label>
                        <div class="controls">
                          <input autocapitalize="off" autocomplete="off" autocorrect="off" class="input-small span12" id="id_complemento" maxlength="30" name="complemento" spellcheck="false" type="text">
                            <p class="help-block hide">
                              
                            </p>
                        </div>
                      </div>

                      <div class="control-group span6  hide" style="display: block;">
                        <label class="control-label" for="id_referencia">Referência</label>
                        <div class="controls">
                          <input class="span12" id="id_referencia" maxlength="255" name="referencia" type="text">
                            <p class="help-block hide">
                              
                            </p>
                        </div>
                      </div>
                    </div>

                    <div class="row-fluid">
                      <div class="control-group span6  hide required" style="display: block;">
                        <label class="control-label font-bold" for="id_bairro">Bairro</label>
                        <div class="controls">
                          <input autocapitalize="off" autocomplete="off" autocorrect="off" class="input-medium span12" id="id_bairro" maxlength="128" name="bairro" spellcheck="false" type="text">
                            <p class="help-block hide">
                              
                            </p>
                        </div>
                      </div>
                      <div class="control-group span6  hide required" style="display: block;">
                        <label class="control-label font-bold" for="id_cidade">Cidade</label>
                        <div class="controls">
                          <input autocapitalize="off" autocomplete="off" autocorrect="off" class="input-medium span12" id="id_cidade" maxlength="128" name="cidade" spellcheck="false" type="text" readonly="readonly">
                            <p class="help-block hide">
                              
                            </p>
                        </div>
                      </div>
                    </div>

                    <div class="row-fluid">
                      <div class="control-group span6  hide required" style="display: block;">
                        <label class="control-label font-bold" for="id_estado">Estado</label>
                        <div class="controls">
                          <select class="span12" id="id_estado" maxlength="2" name="estado" readonly="readonly">
<option value="AC">Acre</option>
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
<option value="SP">São Paulo</option>
<option value="SE">Sergipe</option>
<option value="TO">Tocantins</option>
</select>
                            <p class="help-block hide">
                              
                            </p>
                        </div>
                      </div>
                      <div class="control-group span6  hide required" style="display: block;">
                        <label class="control-label font-bold" for="id_pais_id">País</label>
                        <div class="controls">
                          <input class="span12" id="id_pais_id" maxlength="30" name="pais_id" type="text" value="BRA" readonly="readonly">
                            <p class="help-block hide">
                              
                            </p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </fieldset>
            </div>

            
            <div class="caixa-sombreada borda-principal">
              <fieldset data-recording-ignore="events">
                <legend class="titulo cor-secundaria"><i class="icon-comment"></i>Deixe uma Mensagem ou Personalize seu Pedido!</legend>
                <div id="formularioObservacao" class="control-group required">
                  <p class="help-block font-bold">Gostaria de enviar alguma observação?</p>
                  <textarea rows="3" class="input-block-level sem-margem" name="cliente_obs" form="formularioCheckout"></textarea>
                </div>
              </fieldset>
            </div>
            

          </div>

          <div class="span4">
            <div class="caixa-sombreada borda-principal" id="formas-pagamento-wrapper">
              <fieldset data-recording-ignore="events">
                <legend class="titulo cor-secundaria"><i class="icon-money"></i>Pagamento</legend>
                <div class="formas pagamento accordion borda-alpha" id="formasPagamento">
                  <input type="hidden" name="pagamento_banco_id" value="">
                  
                  
                    
                      
                        
                        
                          
                          

    

    
    <div class="accordion-group deposito">
        <div class="accordion-heading" data-toggle="collapse" data-target="#escolha-banco-itau" data-parent="#formasPagamento" id="pagamento7">
            <span class="radio-conteiner">
                <input type="radio" name="forma_pagamento" id="radio-banco-itau" value="7" data-pagamento-banco-id="2" data-desconto-valor="8.0" data-desconto-tipo="porcentagem" data-desconto-aplicar-total="False">
            </span>
            <span class="forma-conteiner with-discount">
                <span class="helper"></span>
                <img src="https://cdn.awsli.com.br/production/static/loja/estrutura/v1/img/bandeiras/forma-banco-itau.png" alt="Banco Itaú">
                
                    
                        
                        <span class="cor-secundaria pagamento-desconto">
                            Desconto de
                            <b class="cor-principal">8%</b>
                        </span>
                        
                    
                
            </span>
        </div>
        <div id="escolha-banco-itau" class="collapse">
            <div class="accordion-inner">
                <div class="text-right">
                    <span>Valor</span>
                    <h5 class="titulo cor-principal text-right pagamento-valor preco-carrinho-total">R$ 364,80</h5>
                </div>
            </div>
        </div>
    </div>
    

    

    

    

    

    

    


                        
                      
                        
                        
                          <input type="hidden" value="16" id="forma-pagamento-padrao">
                          
<style>
  .ps_dados_fatura .spinner { position: relative; }
  .ps_dados_fatura .spinner:before { content: ''; position: absolute; bottom: 10px; right: -30px; width: 16px; height: 16px; margin-top: -10px; margin-left: -10px; border-radius: 50%; border: 2px solid rgba(0, 0, 0, .3); border-top-color: rgba(0, 0, 0, .6); animation: spin .6s linear infinite; -webkit-animation: spin .6s linear infinite; }
</style>
<script src="https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>
<script type="application/javascript">
  var pstransparente_placeholder_card, pstransparente_valor_total, pstransparente_card_bin;
  function iniciarPagseguroTransparente(card_bin) {
    $.ajax({
      url: '/checkout/pstransparente/iniciar_pagamento',
      method: 'POST',
      dataType: 'json',
      success: function(data) {
        $('#pstransparente_session_id').val(data.session_id);
        PagSeguroDirectPayment.setSessionId(data.session_id);
        if(card_bin) {
          identificarBandeiraPagseguroTransparente(card_bin);
        }
      },
      error: function(data) {
        console.log(data);
        $('#exibirFormasPagamento a').click();
        alert('Forma de pagamento indisponível no momento. Tente novamente');
      }
    });
  };
  function identificarBandeiraPagseguroTransparente(card_bin) {
    PagSeguroDirectPayment.getBrand({
      cardBin: card_bin,
      success: function(data) {
        $("#pstransparente_cartao_bandeira").val(data.brand.name);
        atualizarParcelasPagseguroTransparente();
      },
      error: function(data) {
        console.log(data);
        if(!$('#pstransparente_session_id').val()) {
          iniciarPagseguroTransparente();
        };
      },
      complete: function(data) {
        //tratamento comum para todas chamadas
      }
    });
  };
  function atualizarParcelasPagseguroTransparente() {
    var valor_total = $('.resumo-compra .total').data('total');
    var parcela_sem_juros = 6;
    var parcela_com_juros = 10;
    var pagseguro_installments_config = {
      amount: valor_total,
      brand: $("#pstransparente_cartao_bandeira").val(),
      success: function(data) {
        // Object.keys(data.installments)[0] para sempre pegar o nome do primeiro objeto, independente de qual seja
        var installment_nome = Object.keys(data.installments)[0];
        if(installment_nome) {
          var option, $pstransparente_cartao_parcelas = $('#pstransparente_cartao_parcelas');
          var installment = data.installments[installment_nome];
          $pstransparente_cartao_parcelas.html('<option>Selecione...</option>');
          for(i = 0; i < installment.length; i++) {
            if (parcela_com_juros && parcela_com_juros <= i) {
                break;
            }
            option = '<option value="' + installment[i].quantity + '" data-valor-total="' + installment[i].totalAmount + '" data-valor-parcela="' + installment[i].installmentAmount + '" data-sem-juros="' + installment[i].interestFree + '">' + installment[i].quantity + 'x de R$ ' + formatar_decimal_br(installment[i].installmentAmount) + '</option>';
            if(installment[i].interestFree) {
              option = option.replace('</option>', ' sem juros</option>');
            }
            $pstransparente_cartao_parcelas.append(option);
          }
        }
      },
      error: function(data) {
        console.log(data);
        if(data.error) {
          var $pstransparente_cartao_parcelas = $('#pstransparente_cartao_parcelas');
          $pstransparente_cartao_parcelas.html('<option>Indisponível</option>');
          if(valor_total == 0) {
            $pstransparente_cartao_parcelas.html('<option>Valor total inválido</option>');
          }
        }
      },
      complete: function(data) {
        //tratamento comum para todas chamadas
      }
    };
    if (parcela_sem_juros > 1) {
      pagseguro_installments_config.maxInstallmentNoInterest = parcela_sem_juros;
    }
    PagSeguroDirectPayment.getInstallments(pagseguro_installments_config);
  };
  function enviaPagamentoPagseguroTransparente() {
    var dataExpiracao = $('.ps_cartao_data_expiracao').val().split('/');
    PagSeguroDirectPayment.createCardToken({
      cardNumber: $('.ps_cartao_numero').val().replace(/\ /g, ''),
      brand: $('#pstransparente_cartao_bandeira').val(),
      cvv: $('.ps_cartao_cvv').val(),
      expirationMonth: dataExpiracao[0],
      expirationYear: '20' + dataExpiracao[1],
      success: function(data) {
        $('#pstransparente_comprador_hash').val(PagSeguroDirectPayment.getSenderHash());
        $('#pstransparente_cartao_token').val(data.card.token);
        $(".ps_cartao_numero").val('');
        $(".ps_cartao_cvv").val('');
        $(".ps_cartao_data_expiracao").val('');
        $(".ps_cartao_nome").val();
        $('#formularioCheckout').submit();
      },
      error: function(data) {
        if (!data.hasOwnProperty('cause')) {
          $('#finalizarCompra').button('reset');
          alert('Ocorreu um erro no envio dos dados do cartão. Por favor, verifique os dados e tente de novo.');
          return false;
        }
        var mensagensErro = "";
        var dePara = {'cartao': '.ps_cartao_numero', 'nome': '.ps_cartao_nome', 'mes': '.ps_cartao_data_expiracao', 'ano': '.ps_cartao_data_expiracao', 'cvv': '.ps_cartao_cvv'};
        var mensagensGerais = [];
        for (var indice = 0; indice < data['cause'].length; indice++) {
          if (mensagensErro.hasOwnProperty(data['cause'][indice].code)) {
            var mensagem = mensagensErro[data['cause'][indice].code];
            var referencia = mensagem['referencia'];
            if (referencia == 'geral') {
              mensagensGerais.push(mensagem['mensagem'])
            }
            else {
              var $campo = $(dePara[referencia]);
              campoPagamentoInvalido($campo, mensagem['mensagem'])
            }
          }
        }
        if (mensagensGerais.length > 0) {
          alert(mensagensGerais.join('\n'))
        }
        $('#finalizarCompra').button('reset');
        return false;
      }
    });
  }
  $(window).ready(function () {
    $('.formas.pagamento .accordion-heading + div#escolha-pstransparente').on('show', function () {
      if(!$('#pstransparente_session_id').val()) {
        iniciarPagseguroTransparente();
      }
    });
    var cartaoTerceiro = false;
    var enderecoDiferente = false;

    if (typeof String.prototype.trim !== 'function') {
      String.prototype.trim = function () {
        return this.replace(/^\s+|\s+$/g, '');
      };
    }
    var camposObrigatorios = [
      '.ps_cartao_nome', '.ps_cartao_numero', '.ps_cartao_data_expiracao', '.ps_cartao_cvv',
      '#pstransparente_cartao_parcelas', '#pstransparente_cartao_bandeira'
    ];
    var camposObrigatoriosTitularCartao = [
      '#ps_dono_cartao_cpf', '#ps_dono_cartao_data_nascimento', '#ps_dono_cartao_telefone'
    ];
    var camposObrigatoriosEnderecoTitularCartao = [
      '#ps_dono_cartao_cep', '#ps_dono_cartao_rua', '#ps_dono_cartao_numero', '#ps_dono_cartao_bairro', '#ps_dono_cartao_cidade', '#ps_dono_cartao_estado'
    ];
    var $escolhaPSTransparente = $('#escolha-pstransparente');
    $('#ps_dono_cartao_cpf').mask('000.000.000-00', {clearIfNotMatch: true});
    $('#ps_dono_cartao_cep').mask('00000-000', {clearIfNotMatch: true});
    $('#ps_dono_cartao_data_nascimento').mask('00/00/0000', {clearIfNotMatch: true});
    $('#ps_dono_cartao_telefone').mask('(00) 0000-00009', {clearIfNotMatch: true});
    $(".ps_cartao_data_expiracao").mask("00/00", {clearIfNotMatch: true});
    $('#ps_check_dados_titular').change(function () {
      if ($(this).prop('checked')) {
        $('.ps_dados_titular').slideDown();
        cartaoTerceiro = true;
      }
      else {
        $('.ps_dados_titular').slideUp();
        cartaoTerceiro = false;
      }
    }).change();
    $('#ps_check_dados_fatura').change(function () {
      if ($(this).prop('checked')) {
        $('.ps_dados_fatura').slideDown();
        enderecoDiferente = true;
      }
      else {
        $('.ps_dados_fatura').slideUp();
        enderecoDiferente = false;
      }
    }).change();
    $('#ps_cartao_nome').bind('change keyup input', function () {
      if (this.value.match(/[^a-zA-ZÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ ]/g)) {
        this.value = this.value.replace(/[^a-zA-ZÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ ]/g, '');
      }
    });
    $('#ps_cartao_numero').bind('change keyup input', function () {
      var card_bin = $(this).val().replace(' ', '').slice(0,6);
      if(card_bin.length >= 6 && card_bin != pstransparente_card_bin) {
        pstransparente_card_bin = card_bin;
        if(!$('#pstransparente_session_id').val()) {
          iniciarPagseguroTransparente(card_bin);
        } else {
          identificarBandeiraPagseguroTransparente(card_bin);
        }
      }
    });
    $('#ps_dono_cartao_cep').keyup(function () {
      var cep = $(this).val();
      var cep_container = $(this).parent();
      var new_cep = '';
      for (var i = 0; i < cep.length; ++i) {
        var new_key = cep.charAt(i);
        if (((new_key < "0") || (new_key > "9")) && new_key !== "") {
          var check = false;
        } else {
          new_cep = new_cep + new_key;
        }
      }
      if (new_cep.length >= 8) {
        $(cep_container).addClass('spinner');
        var params = {
          'data': {
            'cep': $(this).val()
          },
          'dataType': 'json',
          'type': 'get',
          'success': function (data) {
            if (data.logradouro) {
              address = data.logradouro.split(/ - /g)[0];
              $('#ps_dono_cartao_rua').val(address);
              $('#ps_dono_cartao_numero').focus();
            }
            if (data.bairro) {
              $('#ps_dono_cartao_bairro').val(data.bairro);
            }
            if (data.cidade) {
              $('#ps_dono_cartao_cidade').val(data.cidade);
            }
            if (data.estado) {
              $('#ps_dono_cartao_estado option[value="' + data.estado + '"]').prop('selected', true);
            }
          },
          'error': function () {
            $('#id_dono_cartao_rua').focus();
          },
          'ttl': 3600,
          'complete': function () {
            $(cep_container).removeClass('spinner');
          }
        };
        $.ajax("//api.awsli.com.br/v2/cep", params);
      }
    });
    if ($escolhaPSTransparente.length > 0) {
      pstransparente_placeholder_card = new Card({
        form: '#escolha-pstransparente',
        container: '.pstransparente-placeholder-card',
        formSelectors: {
          numberInput: '.ps_cartao_numero',
          expiryInput: '.ps_cartao_data_expiracao',
          cvcInput: '.ps_cartao_cvv',
          nameInput: '.ps_cartao_nome'
        },
        messages: {
          monthYear: 'mm/aa'
        },
        placeholders: {
          name: 'Nome Completo'
        }
      });
    }
    $("#formas-pagamento-wrapper").on("click", "#finalizarCompra", function (event) {
      if (!$("#radio-pstransparente").is(":checked")) {
        return true;
      }
      zeraValidacao();
      var validacao_ok = true;
      for (var campo in camposObrigatorios) {
        var $campo = $(camposObrigatorios[campo]);
        if ($campo.val() == "") {
          campoPagamentoInvalido($campo);
          validacao_ok = false;
        }
        else if (camposObrigatorios[campo] == ".ps_cartao_data_expiracao") {
          var partes = $campo.val().split("/");
          if (partes.length != 2) {
            campoPagamentoInvalido($campo, "informe mês e ano");
            validacao_ok = false;
          }
          if (parseInt(partes[0]) < 1 || parseInt(partes[0]) > 12) {
            campoPagamentoInvalido($campo, "mês deve ser entre 01 e 12");
            validacao_ok = false;
          }
          var ano = parseInt(String(new Date().getFullYear()).slice(2));
          if (parseInt(partes[1]) < ano) {
            campoPagamentoInvalido($campo, "ano deve ser " + ano + " ou mais");
            validacao_ok = false;
          }
        }
      }
      if (cartaoTerceiro) {
        for (var campoTitular in camposObrigatoriosTitularCartao) {
          var $campoTitular = $(camposObrigatoriosTitularCartao[campoTitular]);
          if ($campoTitular.val() == "") {
            campoPagamentoInvalido($campoTitular);
            validacao_ok = false;
          }
        }
      }
      if (enderecoDiferente) {
        for (var campoEndereco in camposObrigatoriosEnderecoTitularCartao) {
          var $campoEndereco = $(camposObrigatoriosEnderecoTitularCartao[campoEndereco]);
          if ($campoEndereco.val() == "") {
            campoPagamentoInvalido($campoEndereco);
            validacao_ok = false;
          }
        }
      }
      event.preventDefault();
      if (validacao_ok) {
        try {
          enviaPagamentoPagseguroTransparente();
        }
        catch (err) {
          $('#finalizarCompra').button('reset');
          alert('Ocorreu um erro inesperado na página. Por favor, informe o erro abaixo para o SAC da loja:\nErro técnico\n' + err);
        }
      } else {
        $('#finalizarCompra').button('reset');
      }
    });

    function zeraValidacao() {
      var $control = $(".control-group");
      $control.removeClass("error");
      $control.find(".help-block.erro").hide();
    }

    zeraValidacao();
    if ($("#radio-pstransparente").is(":checked")) {
      $("#escolha-pstransparente").addClass("in");
    }

    $('.preco-carrinho-total').on("valor_total_alterado", function(e, data) {
      if($("#radio-pstransparente").is(":checked")) {
        if(pstransparente_valor_total != data.total && $("#pstransparente_session_id").val()) {
          //Math.round(data.total * 100);
          pstransparente_valor_total = data.total;
          atualizarParcelasPagseguroTransparente();
        }
      }
    });
    $("#pstransparente_cartao_parcelas").change(function() {
      var $this = $(this);
      var $option = $this.find("option[value='" + $this.val() + "']");
      $("#pstransparente_cartao_parcelas_sem_juros").val($option.data("sem-juros"));
      $("#pstransparente_cartao_valor_parcela").val($option.data("valor-parcela"));
      if($option.data("sem-juros") || !$option.val()) {
        var valor_total = $('.resumo-compra .total').data('total');
      } else {
        var valor_total = $option.data("valor-parcela") * $this.val();
      }
      alteraValorTotal(valor_total, true);
    });

    $('#id_tipo').on('tipo_cadastro', function(event, value) {
      if(value === 'PJ') {
        $('#ps_check_dados_titular').prop('checked', true);
        $('#ps_check_dados_titular').prop('readonly', true);
        $('#ps_check_dados_titular').attr('onclick', 'return false');
        $('#ps_check_dados_titular').parent().find('.ps_check_dados_titular_pf').removeClass('hide');
        $('#ps_check_dados_titular').parent().find('.ps_check_dados_titular_pj').addClass('hide');
        $('#ps_check_dados_titular').change();
      } else {
        $('#ps_check_dados_titular').prop('readonly', false);
        $('#ps_check_dados_titular').removeAttr('onclick');
        $('#ps_check_dados_titular').parent().find('.ps_check_dados_titular_pf').addClass('hide');
        $('#ps_check_dados_titular').parent().find('.ps_check_dados_titular_pj').removeClass('hide');
      }
    });
  });
</script>

<div class="accordion-group pstransparente">
    <div class="accordion-heading" data-toggle="collapse" data-target="#escolha-pstransparente" data-parent="#formasPagamento" id="pagamento16">
        <span class="radio-conteiner">
            <input type="radio" name="forma_pagamento" id="radio-pstransparente" value="16">
        </span>
        <span class="forma-conteiner">
            <span class="helper"></span>
            <img src="https://cdn.awsli.com.br/production/static/loja/estrutura/v1/img/bandeiras/pstransparente.png" alt="Pague com PagSeguro">
            
        </span>
    </div>
    <div id="escolha-pstransparente" class="collapse">
        <input type="hidden" id="pstransparente_session_id" name="pstransparente_session_id">
        <input type="hidden" id="pstransparente_comprador_hash" name="pstransparente_comprador_hash">
        <input type="hidden" id="pstransparente_cartao_token" name="pstransparente_cartao_token">
        <input type="hidden" id="pstransparente_cartao_bandeira" name="pstransparente_cartao_bandeira">
        <div class="accordion-inner">
            <div class="pstransparente-placeholder-card placeholder-card" data-jp-card-initialized="true" style="height: 148px; width: 0px;"><div class="jp-card-container" style="transform: scale(0);"><div class="jp-card"><div class="jp-card-front"><div class="jp-card-logo jp-card-elo"><div class="e">e</div><div class="l">l</div><div class="o">o</div></div><div class="jp-card-logo jp-card-visa">Visa</div><div class="jp-card-logo jp-card-visaelectron">Visa<div class="elec">Electron</div></div><div class="jp-card-logo jp-card-mastercard">Mastercard</div><div class="jp-card-logo jp-card-maestro">Maestro</div><div class="jp-card-logo jp-card-amex"></div><div class="jp-card-logo jp-card-discover">discover</div><div class="jp-card-logo jp-card-dinersclub"></div><div class="jp-card-logo jp-card-dankort"><div class="dk"><div class="d"></div><div class="k"></div></div></div><div class="jp-card-logo jp-card-jcb"><div class="j">J</div><div class="c">C</div><div class="b">B</div></div><div class="jp-card-lower"><div class="jp-card-shiny"></div><div class="jp-card-cvc jp-card-display">•••</div><div class="jp-card-number jp-card-display">•••• •••• •••• ••••</div><div class="jp-card-name jp-card-display">Nome Completo</div><div class="jp-card-expiry jp-card-display" data-before="mm/aa" data-after="valid
thru">••/••</div></div></div><div class="jp-card-back"><div class="jp-card-bar"></div><div class="jp-card-cvc jp-card-display">•••</div><div class="jp-card-shiny"></div></div></div></div></div>
            <div class="clearfix">
                <div class="span8">
                    <div class="control-group">
                        <div class="controls">
                            <label class="control-label" for="ps_cartao_numero">Número do Cartão</label>
                            <input type="text" class="ps_cartao_numero span12" placeholder="•••• •••• •••• ••••" id="ps_cartao_numero" autocomplete="cc-number">
                            <span class="help-block erro" style="display: none;">Este campo é obrigatório</span>
                        </div>
                    </div>
                </div>
                <div class="span4">
                    <div class="control-group">
                        <div class="controls">
                            <label class="control-label" for="ps_cartao_data_expiracao">Validade</label>
                            <input type="text" placeholder="mm/aa" class="ps_cartao_data_expiracao span12" id="ps_cartao_data_expiracao" autocomplete="cc-exp" maxlength="5">
                            <span class="help-block erro" style="display: none;">Este campo é obrigatório</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <label class="control-label" for="ps_cartao_nome">Nome do Titular
                        <small style="margin-left: 5px;">(Como escrito no cartão)</small>
                    </label>
                    <input name="pstransparente_cartao_nome" type="text" class="ps_cartao_nome span12" placeholder="" id="ps_cartao_nome" autocomplete="cc-name">
                    <span class="help-block erro" style="display: none;">Este campo é obrigatório</span>
                </div>
            </div>
            <div class="clearfix">
                <div class="span5">
                    <div class="control-group">
                        <div class="controls">
                            <label class="control-label nowrap" for="ps_cartao_cvv">Cód. de Segurança</label>
                            <div class="input-append">
                                <input type="text" placeholder="CCV" class="ps_cartao_cvv span7" id="ps_cartao_cvv" autocomplete="cc-csc">
                                <span class="add-on" data-toggle="tooltip" data-placement="right" title="" data-original-title="Últimos 3 digitos no verso do cartão"><i class="icon-question-sign"></i></span>
                            </div>
                            <span class="help-block erro" style="display: none;">Este campo é obrigatório</span>
                        </div>
                    </div>
                </div>
                <div class="span7">
                    <div class="control-group">
                        <div class="controls">
                            <label class="control-label" for="pstransparente_cartao_parcelas">Parcelas</label>
                            <select id="pstransparente_cartao_parcelas" name="pstransparente_cartao_parcelas" class="span12">
                              <option value="1">Digite o número do cartão</option>
                            </select>
                            <span class="help-block erro" style="display: none;">Escolha uma opção de parcelas</span>
                            <input type="hidden" value="false" name="pstransparente_cartao_parcelas_sem_juros" id="pstransparente_cartao_parcelas_sem_juros">
                            <input type="hidden" value="" id="pstransparente_cartao_valor_parcela" name="pstransparente_cartao_valor_parcela">
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="clearfix">
                <div class="control-group">
                    <div class="controls">
                        <label class="checkbox">
                            <input type="checkbox" name="ps_check_dados_titular" id="ps_check_dados_titular">
                            <span class="ps_check_dados_titular_pf ">Titular do cartão é diferente do cadastro</span>
                            <span class="ps_check_dados_titular_pj hide">Dados pessoais do titular do cartão</span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="ps_dados_titular hide" style="">
                <div class="clearfix">
                    <div class="span6">
                        <div class="control-group">
                            <div class="controls">
                                <label class="control-label" for="ps_dono_cartao_cpf">CPF do titular</label>
                                <input name="ps_dono_cartao_cpf" id="ps_dono_cartao_cpf" type="text" class="span12" value="" maxlength="14">
                            </div>
                        </div>
                    </div>
                    <div class="span6">
                        <div class="control-group">
                            <div class="controls">
                                <label class="control-label" for="ps_dono_cartao_data_nascimento">Data de Nascimento</label>
                                <input name="ps_dono_cartao_data_nascimento" id="ps_dono_cartao_data_nascimento" class="span12" type="text" value="" maxlength="10">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix">
                    <div class="span6">
                        <div class="control-group">
                            <div class="controls">
                                <label class="control-label" for="ps_dono_cartao_telefone">Telefone</label>
                                <input name="ps_dono_cartao_telefone" id="ps_dono_cartao_telefone" class="span12" type="text" value="" maxlength="15">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix">
                <div class="control-group">
                    <div class="controls">
                        <label class="checkbox">
                            <input type="checkbox" name="ps_check_dados_titular" id="ps_check_dados_fatura">
                            Endereço do titular diferente do endereço de entrega
                        </label>
                    </div>
                </div>
            </div>
            <div class="ps_dados_fatura hide" style="">
                <div class="clearfix">
                    <div class="span6">
                        <div class="control-group">
                            <div class="controls">
                                <label class="control-label" for="ps_dono_cartao_cep">CEP</label>
                                <input name="ps_dono_cartao_cep" id="ps_dono_cartao_cep" class="span12" type="text" value="" maxlength="9">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix">
                    <div class="span9">
                        <div class="control-group">
                            <div class="controls">
                                <label class="control-label" for="ps_dono_cartao_rua">Endereço</label>
                                <input name="ps_dono_cartao_rua" id="ps_dono_cartao_rua" class="span12" type="text" value="">
                            </div>
                        </div>
                    </div>
                    <div class="span3">
                        <div class="control-group">
                            <div class="controls">
                                <label class="control-label" for="ps_dono_cartao_numero">Número</label>
                                <input name="ps_dono_cartao_numero" id="ps_dono_cartao_numero" class="span12" type="text" value="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix">
                    <div class="span6">
                        <div class="control-group">
                            <div class="controls">
                                <label class="control-label" for="ps_dono_cartao_complemento">Complemento</label>
                                <input name="ps_dono_cartao_complemento" id="ps_dono_cartao_complemento" class="span12" type="text" value="">
                            </div>
                        </div>
                    </div>
                    <div class="span6">
                        <div class="control-group">
                            <div class="controls">
                                <label class="control-label" for="ps_dono_cartao_bairro">Bairro</label>
                                <input name="ps_dono_cartao_bairro" id="ps_dono_cartao_bairro" class="span12" type="text" value="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix">
                    <div class="span6">
                        <div class="control-group">
                            <div class="controls">
                                <label class="control-label" for="ps_dono_cartao_cidade">Cidade</label>
                                <input name="ps_dono_cartao_cidade" id="ps_dono_cartao_cidade" class="span12" type="text" value="">
                            </div>
                        </div>
                    </div>
                    <div class="span6">
                        <div class="control-group">
                            <div class="controls">
                                <label class="control-label" for="ps_dono_cartao_estado">Estado</label>
                                <select class="span12" id="ps_dono_cartao_estado" name="ps_dono_cartao_estado">
                                    <option value="AC">Acre</option>
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
                                    <option value="SP">São Paulo</option>
                                    <option value="SE">Sergipe</option>
                                    <option value="TO">Tocantins</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="text-right">
                <span>Valor</span>
                <h5 class="titulo cor-principal text-right pagamento-valor preco-carrinho-total">R$ 364,80</h5>
            </div>
            
<div class="payment-country-origin pull-right">
  <small class="muted">
    Esta compra está sendo feita no <strong>Brasil</strong>.
    <img src="https://cdn.awsli.com.br/production/static/loja/estrutura/v1/img/flags/24/BR.png" alt="BR">
  </small>
</div>

        </div>
    </div>
</div>

                        
                      
                        
                        
                          
                          
<div class="accordion-group paypal">
    <div class="accordion-heading" data-toggle="collapse" data-target="#escolha-paypal" data-parent="#formasPagamento" id="pagamento3">
        <span class="radio-conteiner">
            <input type="radio" name="forma_pagamento" id="radio-paypal" value="3">
        </span>
        <span class="forma-conteiner">
            <span class="helper"></span>
            <img src="https://cdn.awsli.com.br/production/static/loja/estrutura/v1/img/bandeiras/paypal.png" alt="Pague com PayPal">
            
        </span>
    </div>
    <div id="escolha-paypal" class="collapse">
        <div class="accordion-inner">
            <ul class="bandeiras-pagamento">
                <li><i class="icone-pagamento visa" title="Visa"></i></li>
                <li><i class="icone-pagamento mastercard" title="Mastercard"></i></li>
                <li><i class="icone-pagamento amex" title="Amex"></i></li>
                <li><i class="icone-pagamento elo" title="Elo"></i></li>
                <li><i class="icone-pagamento hiper" title="Hiper"></i></li>
            </ul>
            <div class="text-right">
                <span>Valor</span>
                <h5 class="titulo cor-principal text-right pagamento-valor preco-carrinho-total">R$ 364,80</h5>
                
            </div>
        </div>
    </div>
</div>

                        
                      
                    
                  
                </div>
                <div id="exibirFormasPagamento" class="hide text-center" style="margin: -10px 0 25px;">
                  <a href="javascript:;" class="btn btn-small"><i class="icon-pencil"></i> Alterar forma de pagamento</a>
                </div>
                <div class="acao-editar" style="text-align: center;">
                  <button type="submit" id="finalizarCompra" class="botao principal grande disabled" data-loading-text="<i class='icon-refresh icon-animate'></i> Finalizando..." autocomplete="off" readonly="readonly"><i class="icon-ok"></i>Finalizar compra</button>
                  
                  <div class="selo-ssl hidden-phone">
                    <img src="https://cdn.awsli.com.br/production/static/img/struct/stamp_encryptssl_cart.png" alt="Compra 100% Segura">
                  </div>
                  
                </div>
              </fieldset>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>

  <div id="modalLogin" class="modal hide fade" role="dialog" aria-hidden="true" data-recording-ignore="events">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i></button>
      <span class="titulo cor-secundaria">Login</span>
    </div>
    <form action="https://www.biellissima.com.br/conta/login" method="post">
      <div class="modal-body borda-principal form-horizontal">
        <div class="control-group">
          <label for="id_email" class="control-label">Email</label>
          <div class="controls">
            <input type="text" name="email" id="id_email" autocomplete="email">
          </div>
        </div>
        <div class="control-group">
          <label for="id_senha" class="control-label">Senha</label>
          <div class="controls">
            <input type="password" name="senha" id="id_senha">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <a href="https://www.biellissima.com.br/conta/login?next=/checkout/#modalRecuperarSenha" class="botao hidden-phone">
          <i class="icon-lock cor-secundaria"></i> Esqueceu a senha?
        </a>
        <button type="button" class="botao" data-dismiss="modal">Fechar</button>
        <button type="submit" class="botao principal">Enviar dados</button>
        <input type="hidden" name="next" value="/checkout/">
      </div>
    </form>
  </div>

  

  <script>
    $('#tipoCadastro li a').click(function() {
      var val = $(this).attr('data-value');
      $("#id_tipo").val(val);
      $("#id_tipo_usuario").val(val);
    });
  </script>


              
            </div>
          

          <div class="secao-secundaria">
            
            
          </div>
        </div>