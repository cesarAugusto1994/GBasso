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
              <h3 class="identificacao-title">Login</h3>
              <form action="{url}ajax/minha/conta/logar" method="post" class="formLoginCheckout" id="formLoginCheckout">
                <div class="form-horizontal">

                  <div class="control-group">
                      <label for="id_email_login">E-mail</label>
                      <input type="text" name="user" id="id_email_login" class="form-control" autocomplete="email" placeholder="meu@email.com.br">
                       <label for="id_senha">Senha</label>
                        <input type="password" class="form-control" name="pass" id="pass" placeholder="Senha" required autocomplete="current-password">
                      <br/>
                      <br/>
                      <button type="submit" class="btn btn-success btn-block">Continuar</button>
                       
                      <a href="http://www.grupobasso.com.br/minha/conta/cadastrar" class="btn btn-primary btn-block">Novo Cadastro</a>
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
  </div>
</div>

  </div>
</div>



