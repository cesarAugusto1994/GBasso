<div class="conteiner">
      <div class="secao-principal row-fluid sem-coluna">
          <div class="campos-pedido">
            <div class="cabecalho-interno row-fluid hide">
              <div class="span12">
                  <h1 class="cor-secundaria">
                    Finalizar compra <small> Preencha os dados necessários para finalizar o pedido.</small>
                  </h1>
              </div>
            </div>
            <div class="campos-pedido">

              <div id="login-content" class="">
                <div class="row-fluid" style="display: block;">
                  <div class="col-lg-4 hidden-xs ">

                  </div>
                  <div class="col-lg-4 col-xs-12 " style="margin-top:60px;">
                    <div class="caixa-sombreada borda-principal">
                      <form action="{url}ajax/minha/conta/logar" method="post" class="formLoginCheckout" id="formLoginCheckout">
                          <fieldset data-recording-ignore="events">
                        <legend class=" cor-secundaria"><i class="icon-user"></i>Login</legend>
                        <div id="formularioEndereco" class="">

                          <div class="formEndereco-conteiner">

                            <div class="row-fluid">
                              <div class="control-group span12 required" style="display: block;">
                                <label class="control-label font-bold" for="shippingAddressStreet">E-mail</label>
                                <div class="controls">
                                  <input type="text" name="user" id="id_email_login" class="input-xlarge span12 form-control" value="<?= $email; ?>" autocomplete="email" placeholder="meu@email.com.br">
                                </div>
                              </div>
                            </div>

                            <div class="row-fluid">
                              <div class="control-group span12 required" style="display: block;">
                                <label class="control-label font-bold" for="shippingAddressNumber">Senha</label>
                                <div class="controls">
                                  <input type="password" class="form-control input-mini span12" name="pass" id="pass" placeholder="Senha" required autocomplete="current-password">
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
          </div>
      </div>
</div>
