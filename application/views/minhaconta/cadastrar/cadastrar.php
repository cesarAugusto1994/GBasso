<div class="container margin-top padding-med-reset">
	<div class="row">
		<div class="col-lg-12 margin-bottom-17">	
		<h1 class='no-margin' style='color: #000;'>Cadastrar-se </h1>
		</div>
		<ol class="breadcrumb">
			<li>
				<a href="{url}" class="breadcump">Home</a>
			</li>
			<li class="active">
				Cadastrar
			</li>			
		</ol>
	</div>
	<div class="row">
		<div class="col-lg-6 border-left-custom">
			<form class='formCadastro' method='post' action='{url}ajax/minha/conta/cadastrar' >
				<div class="col-lg-11 no-padding margin-bottom-17">
					<h3>Dados Pessoais</h3>
					<hr />			
					<div class='col-lg-6 no-padding'>
						<label>Nome</label>
						<input type='text' name='nome' class='form-control' />
					</div>
					<div class='col-lg-6'>
						<label>Sobrenome</label>
						<input type='text' name='sobrenome' class='form-control' />
					</div>	
				</div>
				<div class="col-lg-11 no-padding margin-bottom-17">
					<div class='col-lg-6 no-padding'>
						<label>CPF</label>
						<input type='text' name='cpf' class='form-control' />
					</div>			
					<div class='col-lg-6'>
						<label>Sexo</label>
						<div class='radio'>
							<label style='margin-top: 10px;'>
								<input type="radio" class='no-margin-top' name='sexo' checked value='1'>
								Masculino							
							</label>
							<label style='margin-top: 10px; margin-left: 20px;'>
								<input type="radio" class='no-margin-top' name='sexo' value='2'>
								Feminino							
							</label>						
						</div>
					</div>
				</div>
				<div class="col-lg-11 no-padding margin-bottom-17">
					<div class='col-lg-3 no-padding'>
						<label>Data de Nasc.</label>
						<input type='text' name='dataNasc' placeholder='DD/MM/AAAA' class='form-control' />
					</div>			
					<div class='col-lg-9'>
						<label>E-mail</label>
						<input type='email' name='email' id='email' class='form-control' />
					</div>	
				</div>
				<div class='col-lg-11 no-padding margin-bottom-17'>
					<h3>Endereço</h3>
					<hr />
					<div class="col-lg-12 no-padding margin-bottom-17">
						<div class='col-lg-5 no-padding'>
							<label>Destinatário</label>
							<input type='text' name='destinatario' class='form-control' />
						</div>
						<div class='col-lg-7'>
							<label>Ponto de Referência</label>
							<input type='text' name='pontoReferencia' class='form-control' />
						</div>	
					</div>					
					<div class="col-lg-12 no-padding margin-bottom-17">
						<div class='col-lg-3 no-padding'>
							<label>Cep</label>
							<input type='text' name='cep' class='form-control' />
						</div>
						<div class='col-lg-9'>
							<label>Endereço</label>
							<input type='text' name='endereco' class='form-control' />
						</div>	
					</div>
					<div class="col-lg-12 no-padding margin-bottom-17">
						<div class='col-lg-6 no-padding'>
							<label>Bairro</label>
							<input type='text' name='bairro' class='form-control' />
						</div>
						<div class='col-lg-3'>
							<label>Número</label>
							<input type='text' name='numero' class='form-control' />
						</div>
						<div class='col-lg-3'>
							<label>Comple.</label>
							<input type='text' name='comple' class='form-control' />
						</div>
					</div>
					<div class="col-lg-12 no-padding margin-bottom-17">
						<div class='col-lg-6 no-padding'>
							<label>Cidade</label>
							<input type='text' name='cidade' readonly class='form-control' />
						</div>
						<div class='col-lg-6'>
							<label>Estado</label>
							<input type='text' name='estado' readonly class='form-control' />
						</div>	
					</div>
				</div>
				<div class='col-lg-11 no-padding margin-bottom-17'>
					<h3>Dados de Acesso</h3>
					<hr />
					<div class="col-lg-12 no-padding margin-bottom-17">
						<div class='col-lg-12 no-padding'>
							<label>Usuário</label>
							<input type='text' name='user' id='userLogin' class='form-control' readonly />
						</div>
					</div>
					<div class="col-lg-12 no-padding margin-bottom-17">
						<div class='col-lg-6 no-padding'>
							<label>Senha</label>
							<input type='password' name='pass' class='form-control' placeholder='Digite a sua senha' />
						</div>	
						<div class='col-lg-6 no-padding-right'>
							<label>Repita a Senha</label>
							<input type='password' name='rePass' class='form-control' placeholder='Repita a sua senha' />
						</div>						
					</div>				
					<div class="col-lg-12 no-padding margin-bottom-17">
						<button type='submit' class='btn btn-success'>Cadastrar-se</button>
						<button type='button' class='btn btn-danger cancelar-cadastro'>Cancelar</button>
					</div>
				</div>
			</form>
		</div>
		<div class='col-lg-5 pull-right margin-right-45'>
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
	</div>
</div>
<script type='text/javascript'>
	var baseUrl   =   '{url}';

	$("input[name='cep']").focusout( function() {
                // endpoint ajax para requisição de cep 
                var urlTeste = 'http://viacep.com.br/ws/'+this.value+'/json/';
                // jquery para pegar os dados json 
                $.getJSON(urlTeste, function ( response ) {
                    $("input[name='bairro']").attr( 'value', response.bairro );
                    $("input[name='cidade']").attr( 'value', response.localidade );
                    $("input[name='estado']").attr( 'value', response.uf );
                   	$("input[name='endereco']").attr( 'value', response.logradouro);
                   	$("input[name='numero']").focus();
                   	console.log( response );
                });
            });


</script>





