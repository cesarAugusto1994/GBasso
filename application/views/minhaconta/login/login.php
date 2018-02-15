<div class="container margin-top padding-med-reset">
	<div class="row">
		<div class="col-lg-12 margin-bottom-17">
		</div>
		<ol class="breadcrumb">
			<li>
				<a href="{url}" class="breadcump">Home</a>
			</li>
			<li>
				<a href="{url}" class="breadcump">Minha Conta</a>
			</li>
			<li class="active">
				Login
			</li>
		</ol>
	</div>
	<!--<div class="row">
		<div class='col-lg-5 div-center'>
			<form class='formLogin' method='post' action='{url}ajax/minha/conta/logar' >
				<div class='col-lg-10 no-padding margin-bottom-17'>
					<h3>Já tem cadastro? Faça login aqui</h3>
					<hr />
					<div class="col-lg-12 no-padding margin-bottom-17">
						<div class='col-lg-12 no-padding'>
							<label>Usuário</label>
							<input type='email' name='user' placeholder='Digite seu usuário' class='form-control'/>
						</div>
					</div>
					<div class="col-lg-12 no-padding margin-bottom-17">
						<div class='col-lg-12 no-padding'>
							<label>Senha</label>
							<input type='password' name='pass' class='form-control' placeholder='Digite a sua senha' />
						</div>
					</div>
					<div class="col-lg-12 no-padding margin-bottom-17">
						<button type='submit' class='btn btn-success pull-right'>Logar</button>
					</div>
				</div>
			</form>
		</div>
	</div>-->
</div>



<div class="conteiner">
      <div class="secao-principal row-fluid sem-coluna">
            <div class="campos-pedido">

              <div id="login-content" class="">
                <div class="row-fluid" style="display: block;">
                  <div class="col-lg-4 hidden-xs ">

                  </div>
                  <div class="col-lg-4 col-xs-12 " style="margin-top:20px;">
										<h3 class="text-center">Realize o login para acessar a sua conta.</h3>
                    <div class="caixa-sombreada borda-principal">
                      <form action="{url}ajax/minha/conta/logar" method="post" class="formLogin" id="formLogin">
                          <fieldset data-recording-ignore="events">
                        <legend class=" cor-secundaria"><i class="icon-user"></i>Login</legend>
                        <div id="formularioEndereco" class="">

                          <div class="formEndereco-conteiner">

                            <div class="row-fluid">
                              <div class="control-group span12 required" style="display: block;">
                                <label class="control-label font-bold" for="shippingAddressStreet">E-mail</label>
                                <div class="controls">
                                  <input type="text" name="user" id="id_email_login" class="input-xlarge span12 form-control" value="" autocomplete="email" placeholder="meu@email.com.br">
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
                            <a href="/minha/conta/cadastrar" class="btn btn-default btn-block">Novo Cadastro</a>
                          </div>
                        </div>
                      </fieldset>
                      </form>
                    </div>



                  </div>


                  <div class="col-lg-4 hidden-xs ">



                  </div>
                </div>

              </div>

            </div>
      </div>
</div>






<script type='text/javascript'>
	var baseUrl   =   '{url}';
</script>
