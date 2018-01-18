<div class="container margin-top padding-med-reset">
	<div class="row">
		<div class="col-lg-12 margin-bottom-17">	
		<h1 class='no-margin' style='color: #000;'>Faça login </h1>
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
	<div class="row">
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
	</div>
</div>
<script type='text/javascript'>
	var baseUrl   =   '{url}';
</script>





