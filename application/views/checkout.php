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
      
        <tbody><tr>
          <td class="phone-pullleft" data-produto-id="16256999" data-produto-quantidade="1">
            <div class="produto-info">
              Bolsa Tiracolo Vermelha Ellus com Stickers
              <ul>
                <li>
                  <span>
                    SKU:
                    <strong>
                      45ZW706
                    </strong>
                  </span>
                </li>
                
                  
                
              </ul>
            </div>
          </td>
          <td class="conteiner-qtd">
            <div>1</div>
          </td>
          <td class="conteiner-preco padding-preco">
            <div class="preco-produto">
              <strong class="preco-promocional cor-principal ">
                R$ 369,90
              </strong>
            </div>
          </td>
        </tr>
      
      <tr class="bg-dark esconder-mobile">
        <td>&nbsp;</td>
        <td class="text-right">
          <span>Subtotal:</span>
        </td>
        <td class="padding-preco">
          <div class="subtotal" data-subtotal="369,90" data-float="369.9">
            <strong class=" cor-principal">
              R$ 369,90
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
      
      
        <tr class="bg-dark esconder-mobile desconto-tr" style="">
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
          <span class="visible-phone">Total:</span>
          <div class="total" data-total="369.9">
            <strong class=" cor-principal preco-carrinho-total">R$ 369,90</strong>
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
            <label class="control-label font-bold" for="id_email">Nome</label>
            <div class="controls">
              <input autocomplete="email" value="" class="input-xlarge span12" id="nome" maxlength="128" name="nome" type="text">
                <p class="help-block hide">
                  
                </p>
            </div>
          </div>
          <div class="control-group  required">
            <label class="control-label font-bold" for="id_email">E-mail</label>
            <div class="controls">
              <input autocomplete="email" class="input-xlarge span12" id="id_email" maxlength="128" name="email" type="text">
                <p class="help-block hide">
                  
                </p>
            </div>
          </div>
          <div class="control-group  required">
            <label class="control-label font-bold" for="id_cpf">CPF</label>
            <div class="controls">
              <input autocapitalize="off" autocomplete="off" autocorrect="off" class="input-small span12" id="id_cpf" maxlength="14" name="cpf" spellcheck="false" type="tel">
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
        <legend class=" cor-secundaria"><i class="icon-map-marker"></i>Entrega</legend>
        <div id="formularioEndereco" class="">
          <div id="exibirFormasEnvio" class="hide pull-right" style="margin-bottom: 15px; margin-top: 25px; display: block;">
            <a href="javascript:;" class="btn btn-small"><i class="icon-pencil"></i> Alterar entrega</a>
          </div>
          <div class="formEndereco-conteiner">
            <div class="control-group  required" style="margin-bottom: 20px;">
              <label class="control-label font-bold" for="id_cep">CEP</label>
              <div class="controls">
                <input autocapitalize="off" autocomplete="off" autocorrect="off" class="input-small" id="id_cep" name="cep" spellcheck="false" type="tel" value="29980000" maxlength="9">
                <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modal-mensagem">Meus Endereços</button>
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
                <label class="control-label font-bold" for="id_endereco">Endereço</label>
                <div class="controls">
                  <input class="input-xlarge span12" id="id_endereco" maxlength="255" name="endereco" type="text">
                  <p class="help-block hide">
                    
                  </p>
                </div>
              </div>
              <div class="control-group span3 required" style="display: block;">
                <label class="control-label font-bold" for="id_numero">Número</label>
                <div class="controls">
                  <input class="input-mini span12" id="id_numero" maxlength="6" name="numero" type="text">
                  <p class="help-block hide">
                    
                  </p>
                </div>
              </div>
            </div>
            <div class="row-fluid">
              <div class="control-group span6 " style="display: block;">
                <label class="control-label" for="id_complemento">Complemento</label>
                <div class="controls">
                  <input autocapitalize="off" autocomplete="off" autocorrect="off" class="input-small span12" id="id_complemento" maxlength="30" name="complemento" spellcheck="false" type="text">
                  <p class="help-block hide">
                    
                  </p>
                </div>
              </div>
              <div class="control-group span6 " style="display: block;">
                <label class="control-label" for="id_referencia">Referência</label>
                <div class="controls">
                  <input class="span12" id="id_referencia" maxlength="255" name="referencia" type="text">
                  <p class="help-block hide">
                    
                  </p>
                </div>
              </div>
            </div>
            <div class="row-fluid">
              <div class="control-group span6 required" style="display: block;">
                <label class="control-label font-bold" for="id_bairro">Bairro</label>
                <div class="controls">
                  <input autocapitalize="off" autocomplete="off" autocorrect="off" class="input-medium span12" id="id_bairro" maxlength="128" name="bairro" spellcheck="false" type="text">
                  <p class="help-block hide">
                    
                  </p>
                </div>
              </div>
              <div class="control-group span6 required" style="display: block;">
                <label class="control-label font-bold" for="id_cidade">Cidade</label>
                <div class="controls">
                  <input autocapitalize="off" autocomplete="off" autocorrect="off" class="input-medium span12" id="id_cidade" maxlength="128" name="cidade" spellcheck="false" type="text">
                  <p class="help-block hide">
                    
                  </p>
                </div>
              </div>
            </div>
            <div class="row-fluid">
              <div class="control-group span6 required" style="display: block;">
                <label class="control-label font-bold" for="id_estado">Estado</label>
                <div class="controls">
                  <select class="span12" id="id_estado" maxlength="2" name="estado">
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
    
  </div>
  <div class="span4">
    <div class="caixa-sombreada borda-principal" id="formas-pagamento-wrapper">
      <fieldset data-recording-ignore="events">
        <legend class=" cor-secundaria"><i class="icon-money"></i>Pagamento</legend>
        <div class="formas pagamento accordion borda-alpha" id="formasPagamento" data-recording-disable="">
          <input type="hidden" id="cart_selected_shipping" name="cart_selected_shipping" value="2">
          <input type="hidden" id="cart_selected_payment" name="cart_selected_payment" value="">
          <input type="hidden" id="payment_bank_id" name="payment_bank_id">
          <input type="hidden" id="payment_session_id" name="payment_session_id">
          <input type="hidden" id="payment_session_name" name="payment_session_name">
          <input type="hidden" id="payment_token" name="payment_token">
          <input type="hidden" id="payment_bin" name="payment_bin">
          <input type="hidden" id="payment_last_digits" name="payment_last_digits">
          <input type="hidden" id="payment_system_id" name="payment_system_id">
          <input type="hidden" id="payment_system_name" name="payment_system_name">
          <input type="hidden" id="payment_fingerprint" name="payment_fingerprint">
          <input type="hidden" id="payment_installments" name="payment_installments">
          <input type="hidden" id="payment_installments_value" name="payment_installments_value">
          <input type="hidden" id="payment_address_active" name="payment_address_active">
          <input type="hidden" id="payment_address_postalCode" name="payment_address_postalCode">
          <input type="hidden" id="payment_address_street" name="payment_address_street">
          <input type="hidden" id="payment_address_number" name="payment_address_number">
          <input type="hidden" id="payment_address_complement" name="payment_address_complement">
          <input type="hidden" id="payment_address_neighborhood" name="payment_address_neighborhood">
          <input type="hidden" id="payment_address_city" name="payment_address_city">
          <input type="hidden" id="payment_address_state" name="payment_address_state">
          <input type="hidden" id="payment_address_country" name="payment_address_country" value="BR">
          <input type="hidden" id="payment_client_active" name="payment_client_active">
          <input type="hidden" id="payment_client_name" name="payment_client_name">
          <input type="hidden" id="payment_client_document" name="payment_client_document">
          <input type="hidden" id="payment_client_birthday" name="payment_client_birthday">
          <input type="hidden" id="payment_client_phone" name="payment_client_phone">
          
            
              
<div class="accordion-group cartao pagamento_selecao_conteiner">
<div class="accordion-heading" data-toggle="collapse" data-target="#escolha-cartao" data-parent="#formasPagamento" id="pagamentoCartao">
<span class="radio-conteiner">
<input type="radio" name="forma_pagamento" id="radio-cartao" data-code="cartao" value="">
</span>
<span class="forma-conteiner">
<span class="helper"></span>
<ul class="bandeiras-pagamento">
<li><i class="icone-pagamento mastercard" title="Mastercard"></i></li>
<li><i class="icone-pagamento visa" title="Visa"></i></li>
<li><i class="icone-pagamento hipercard" title="Hipercard"></i></li>
<li><i class="icone-pagamento elo" title="Elo"></i></li>
<li><i class="icone-pagamento misc" title="Outros"></i></li>
</ul>
</span>
</div>
<div id="escolha-cartao" class="pagamento_selecao_info in collapse" style="height: auto;">
<div class="accordion-inner">
<div class="cartao-placeholder-card placeholder-card" data-code="cartao" data-jp-card-initialized="true" style="height: 148.154px; width: 288.077px;"><div class="jp-card-container" style="transform: scale(0.823077);"><div class="jp-card"><div class="jp-card-front"><div class="jp-card-logo jp-card-elo"><div class="e">e</div><div class="l">l</div><div class="o">o</div></div><div class="jp-card-logo jp-card-visa">Visa</div><div class="jp-card-logo jp-card-visaelectron">Visa<div class="elec">Electron</div></div><div class="jp-card-logo jp-card-mastercard">Mastercard</div><div class="jp-card-logo jp-card-maestro">Maestro</div><div class="jp-card-logo jp-card-amex"></div><div class="jp-card-logo jp-card-discover">discover</div><div class="jp-card-logo jp-card-dinersclub"></div><div class="jp-card-logo jp-card-dankort"><div class="dk"><div class="d"></div><div class="k"></div></div></div><div class="jp-card-logo jp-card-jcb"><div class="j">J</div><div class="c">C</div><div class="b">B</div></div><div class="jp-card-lower"><div class="jp-card-shiny"></div><div class="jp-card-cvc jp-card-display">•••</div><div class="jp-card-number jp-card-display">•••• •••• •••• ••••</div><div class="jp-card-name jp-card-display">Nome Completo</div><div class="jp-card-expiry jp-card-display" data-before="mm/aa" data-after="valid
thru">••/••</div></div></div><div class="jp-card-back"><div class="jp-card-bar"></div><div class="jp-card-cvc jp-card-display">•••</div><div class="jp-card-shiny"></div></div></div></div></div>
<div class="control-group" id="bandeiras-manual">
<div class="controls">
  <label class="control-label">Selecione uma Bandeira</label>
  <ul class="bandeiras-pagamento">
    <li data-name="Mastercard" data-class="jp-card-mastercard" class="hide"><i class="icone-pagamento mastercard" title="Mastercard"></i></li>
    <li data-name="Visa" data-class="jp-card-visa" class="hide"><i class="icone-pagamento visa" title="Visa"></i></li>
    <li data-name="Hipercard" data-class="jp-card-hipercard" class="hide"><i class="icone-pagamento hipercard" title="Hipercard"></i></li>
    <li data-name="Elo" data-class="jp-card-elo" class="hide"><i class="icone-pagamento elo" title="Elo"></i></li>
    <li data-name="Diners" data-class="jp-card-dinersclub" class="hide"><i class="icone-pagamento diners" title="Diners"></i></li>
    <li data-name="American Express" data-class="jp-card-amex" class="hide"><i class="icone-pagamento amex" title="American Express"></i></li>
  </ul>
</div>
</div>
<div class="clearfix">
<div class="span8">
  <div class="control-group">
    <div class="controls">
      <label class="control-label" for="cartao_cartao_numero">Número do Cartão</label>
      <input type="tel" class="cartao_cartao_numero cartao_dados_numero span12" placeholder="•••• •••• •••• ••••" id="cartao_cartao_numero" autocomplete="cc-number">
      <span class="help-block erro">Este campo é obrigatório</span>
    </div>
  </div>
</div>
<div class="span4">
  <div class="control-group">
    <div class="controls">
      <label class="control-label" for="cartao_cartao_data_expiracao">Validade</label>
      <input type="tel" maxlength="5" placeholder="mm/aa" class="cartao_cartao_data_expiracao cartao_dados_expiracao span12" id="cartao_cartao_data_expiracao" autocomplete="cc-exp">
      <span class="help-block erro">Este campo é obrigatório</span>
    </div>
  </div>
</div>
</div>
<div class="control-group">
<div class="controls">
  <label class="control-label" for="cartao_cartao_nome">Nome do Titular
    <small style="margin-left: 5px;">(Como escrito no cartão)</small>
  </label>
  <input type="text" class="cartao_cartao_nome cartao_dados_nome span12" placeholder="" id="cartao_cartao_nome" autocomplete="cc-name">
  <span class="help-block erro">Este campo é obrigatório</span>
</div>
</div>
<div class="clearfix">
<div class="span5">
  <div class="control-group">
    <div class="controls">
      <label class="control-label nowrap" for="cartao_cartao_cvv">Cód. de Segurança</label>
      <div class="input-append" style="margin-bottom: 0;">
        <input type="tel" placeholder="CCV" class="cartao_cartao_cvv cartao_dados_cvv span7" id="cartao_cartao_cvv" autocomplete="cc-csc">
        <span class="add-on" data-toggle="tooltip" data-placement="right" title="" data-original-title="Últimos 3 digitos no verso do cartão"><i class="icon-question-sign"></i></span>
      </div>
      <span class="help-block erro">Este campo é obrigatório</span>
    </div>
  </div>
</div>
<div class="span7">
  <div class="control-group">
    <div class="controls aguardar-valor">
      <label class="control-label" for="cartao_cartao_parcelas">Parcelas</label>
      <select id="cartao_cartao_parcelas" class="cartao_dados_parcelas span12"><option value="">Digite o número do cartão</option></select>
      <span class="help-block erro">Escolha uma opção de parcela</span>
    </div>
  </div>
</div>
</div>

<div class="clearfix">
<div class="control-group group_cartao_dados_titular">
  <div class="controls">
    <label class="checkbox">
      <input type="checkbox" class="cartao_dados_titular_check" id="cartao_check_dados_titular">
      <span class="cartao_check_dados_titular_pf cartao_dados_titular_pf ">Titular do cartão é diferente do cadastro</span>
      <span class="cartao_check_dados_titular_pj cartao_dados_titular_pj hide">Dados pessoais do titular do cartão</span>
    </label>
  </div>
</div>
</div>
<div class="cartao_dados_titular hide">
<div class="clearfix">
  <div class="span6">
    <div class="control-group">
      <div class="controls">
        <label class="control-label" for="cartao_dono_cartao_cpf">CPF do titular</label>
        <input id="cartao_dono_cartao_cpf" type="text" class="cartao_dados_cpf input-cpf span12" value="" maxlength="14">
      </div>
    </div>
  </div>
  <div class="span6">
    <div class="control-group">
      <div class="controls">
        <label class="control-label" for="cartao_dono_cartao_data_nascimento">Data de Nascimento</label>
        <input id="cartao_dono_cartao_data_nascimento" class="cartao_dados_nascimento input-data-nascimento span12" type="text" value="" maxlength="10">
      </div>
    </div>
  </div>
</div>
<div class="clearfix">
  <div class="span6">
    <div class="control-group">
      <div class="controls">
        <label class="control-label" for="cartao_dono_cartao_telefone">Telefone</label>
        <input id="cartao_dono_cartao_telefone" class="cartao_dados_telefone input-telefone span12" type="text" value="" maxlength="15">
      </div>
    </div>
  </div>
</div>
</div>
<div class="clearfix">
<div class="control-group group_cartao_endereco">
  <div class="controls">
    <label class="checkbox">
      <input type="checkbox" class="cartao_endereco_check" id="cartao_check_dados_fatura">
      Endereço do titular diferente do de entrega
    </label>
  </div>
</div>
</div>
<div class="cartao_dados_fatura hide">
<div class="clearfix">
  <div class="span6">
    <div class="control-group">
      <div class="controls">
        <label class="control-label" for="cartao_dono_cartao_cep">CEP</label>
        <input id="cartao_dono_cartao_cep" class="span12 input-cep cartao_endereco_cep" type="text" value="" maxlength="9">
      </div>
    </div>
  </div>
</div>
<div class="clearfix">
  <div class="span9">
    <div class="control-group">
      <div class="controls">
        <label class="control-label" for="cartao_dono_cartao_rua">Endereço</label>
        <input id="cartao_dono_cartao_rua" class="span12 cartao_endereco_rua" type="text" value="">
      </div>
    </div>
  </div>
  <div class="span3">
    <div class="control-group">
      <div class="controls">
        <label class="control-label" for="cartao_dono_cartao_numero">Número</label>
        <input id="cartao_dono_cartao_numero" class="span12 cartao_endereco_numero" type="text" value="">
      </div>
    </div>
  </div>
</div>
<div class="clearfix">
  <div class="span6">
    <div class="control-group">
      <div class="controls">
        <label class="control-label" for="cartao_dono_cartao_complemento">Complemento</label>
        <input id="cartao_dono_cartao_complemento" class="span12 cartao_endereco_compl" type="text" value="">
      </div>
    </div>
  </div>
  <div class="span6">
    <div class="control-group">
      <div class="controls">
        <label class="control-label" for="cartao_dono_cartao_bairro">Bairro</label>
        <input id="cartao_dono_cartao_bairro" class="span12 cartao_endereco_bairro" type="text" value="">
      </div>
    </div>
  </div>
</div>
<div class="clearfix">
  <div class="span6">
    <div class="control-group">
      <div class="controls">
        <label class="control-label" for="cartao_dono_cartao_cidade">Cidade</label>
        <input id="cartao_dono_cartao_cidade" class="span12 cartao_endereco_cidade" type="text" value="">
      </div>
    </div>
  </div>
  <div class="span6">
    <div class="control-group">
      <div class="controls">
        <label class="control-label" for="cartao_dono_cartao_estado">Estado</label>
        <select class="span12 cartao_endereco_estado" id="cartao_dono_cartao_estado">
          <option value="">Selecione</option>
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
<h5 class=" cor-principal text-right pagamento-valor preco-carrinho-total">R$ 369,90</h5>
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

            
            
              
                <input type="hidden" value="cartao" class="forma-pagamento-padrao">
              
              
            
              
                <input type="hidden" value="cartao" class="forma-pagamento-padrao">
              
              
            
              
                <input type="hidden" value="cartao" class="forma-pagamento-padrao">
              
              
            
              
                <input type="hidden" value="cartao" class="forma-pagamento-padrao">
              
              
            
              
                <input type="hidden" value="cartao" class="forma-pagamento-padrao">
              
              
            
              
                <input type="hidden" value="cartao" class="forma-pagamento-padrao">
              
              
            
              
                <input type="hidden" value="cartao" class="forma-pagamento-padrao">
              
              
            
              
                
              
              
                
                  





<div class="accordion-group bank-2 pagamento_selecao_conteiner" style="display: none;">
<div class="accordion-heading" data-toggle="collapse" data-target="#escolha-bank-2" data-parent="#formasPagamento" id="pagamento2">
  <span class="radio-conteiner">
    <input type="radio" name="forma_pagamento" id="radio-bank-2" data-code="deposito" value="202" data-bank-id="2" data-desconto-valor="8.0">
  </span>
  <span class="forma-conteiner with-discount">
    <span class="helper"></span>
    <img src="https://cdn.awsli.com.br/production/static/loja/estrutura/v1/img/bandeiras/forma-banco-itau.png" alt="Pague com Banco Itaú">
    
      
        <span class="cor-secundaria">
          Desconto de
          <b class="cor-principal">
            8%
          </b>
        </span>
      
    
  </span>
</div>
<div id="escolha-bank-2" class="collapse pagamento_selecao_info">
  <div class="accordion-inner">
    <div class="text-right">
      <span>Valor</span>
      <h5 class=" cor-principal text-right pagamento-valor preco-carrinho-total">R$ 369,90</h5>
    </div>
  </div>
</div>
</div>
















                
              
            
              
                
              
              
                
                  
<div class="accordion-group paypal pagamento_selecao_conteiner" style="display: none;">
<div class="accordion-heading" data-toggle="collapse" data-target="#escolha-paypal" data-parent="#formasPagamento" id="pagamento12">
<span class="radio-conteiner">
<input type="radio" name="forma_pagamento" id="radio-paypal" data-code="paypal" value="12">
</span>
<span class="forma-conteiner">
<span class="helper"></span>

<img src="https://cdn.awsli.com.br/production/static/loja/estrutura/v1/img/bandeiras/paypal.png" alt="Pague com PayPal">


</span>
</div>
<div id="escolha-paypal" class="collapse pagamento_selecao_info ">
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
<h5 class=" cor-principal text-right pagamento-valor preco-carrinho-total">R$ 369,90</h5>

  <span class="forma-pagamento-parcela">Em até <span class="">6x</span> sem juros</span>

</div>
</div>
</div>
</div>

                
              
            
          
        </div>
        <div id="exibirFormasPagamento" class="hide text-center" style="margin: -10px 0px 25px; display: block;">
          <a href="javascript:;" class="btn btn-small"><i class="icon-pencil"></i> Alterar forma de pagamento</a>
        </div>
        <div class="acao-editar" style="text-align: center;">
          <button type="button" id="finalizarCompra" class="botao principal grande disabled" data-loading-text="<i class='icon-refresh icon-animate'></i> Finalizando..." autocomplete="off" readonly="readonly"><i class="icon-ok"></i>Finalizar compra</button>
          
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
<div id="modalLogin" class="modal hide fade" role="dialog" aria-hidden="true">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i></button>
<span class=" cor-secundaria">Login</span>
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


      
    </div>
  

  <div class="secao-secundaria">
    
    
  </div>
</div>
</div>


 <div class="modal fade" id="modal-mensagem">
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
                     <?php foreach($enderecos as $endereco) : ?>
                        <tr class="endereco-item"
                        data-cep="<?= $endereco['cep']; ?>"
                        data-end="<?= $endereco['end']; ?>"
                        data-bai="<?= $endereco['bai']; ?>"
                        data-num="<?= $endereco['num']; ?>"
                        data-com="<?= $endereco['com']; ?>"
                        data-cid="<?= $endereco['cid']; ?>"
                        data-est="<?= $endereco['est']; ?>"
                        >
                          <td><?= $endereco['cep']; ?></td>
                          <td><?= $endereco['end']; ?></td>
                          <td><?= $endereco['bai']; ?></td>
                          <td><?= $endereco['num']; ?></td>
                          <td><?= $endereco['com']; ?></td>
                          <td><?= $endereco['cid'] . ' - ' . $endereco['est']; ?></td>
                        </tr>
                     <?php endforeach; ?>
                   </tbody>
                 </table>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
             </div>
         </div>
     </div>
</div>

<script>
    $(document).ready(function() {

      $('.endereco-item').click(function() {
          $("#id_endereco").val($(this).data('end'))
      });

    });
</script>
