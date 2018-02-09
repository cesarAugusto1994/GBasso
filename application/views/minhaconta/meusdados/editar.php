<div class="container margin-top padding-med-reset">
	<div class="row">
		<ol class="breadcrumb">
			<li>
				<a href="{url}minha/conta" class="breadcump">Minha conta</a>
			</li>
			<li>
				<a href="{url}minha/conta/meusdados" class="breadcump">Meus dados</a>
			</li>
			<li class="active">
				Editar
			</li>
		</ol>
	</div>
	<div class="row">
		<form class='formCadastro' method='post' action='{url}ajax/minha/conta/atualizar/usuario' >
			<div class="col-lg-6 border-left-custom">
				<div class="col-lg-11 no-padding margin-bottom-17">
					<h3>Dados Pessoais</h3>
					<hr />
					<div class='col-lg-6 no-padding'>
						<label>Nome</label>
						<input type='text' name='nome' class='form-control' value='{nome}' />
					</div>
					<div class='col-lg-6'>
						<label>Sobrenome</label>
						<input type='text' name='sobrenome' class='form-control' value='{sobrenome}' />
					</div>
				</div>
				<div class="col-lg-11 no-padding margin-bottom-17">
					<div class='col-lg-6 no-padding'>
						<label>CPF</label>
						<input type='text' name='cpf' class='form-control' value='{cpf}' />
					</div>
					<div class='col-lg-6'>
						<label>Sexo</label>
						<div class='radio no-margin'>
							<label style='margin-top: 10px;'>
								<input type="radio" <?php echo $sexo == 1 ? 'checked' : ''; ?> class='no-margin-top' name='sexo' value='1'>
								Masculino
							</label>
							<label style='margin-top: 10px; margin-left: 20px;'>
								<input type="radio" <?php echo $sexo == 2 ? 'checked' : ''; ?> class='no-margin-top' name='sexo' value='2'>
								Feminino
							</label>
						</div>
					</div>
				</div>
				<div class="col-lg-11 no-padding margin-bottom-17">
					<div class='col-lg-3 no-padding'>
						<label>Data de Nasc.</label>
						<input type='text' name='dataNasc' placeholder='DD/MM/AAAA' class='form-control' value='{data}' />
					</div>
					<div class='col-lg-9'>
						<label>E-mail</label>
						<input type='email' name='email' id='email' class='form-control' value='{email}' />
					</div>
				</div>
				<div class="col-lg-11 no-padding margin-bottom-17">
					<div class='col-lg-12 no-padding'>
						<label>Telefone</label>
						<input type='text' name='telefone_celular' class='form-control' value='' />
					</div>

				</div>
			</div>
			<div class="col-lg-6 border-left-custom">
				<div class='col-lg-11 no-padding margin-bottom-17'>
					<h3>Dados de Acesso</h3>
					<hr />
					<div class="col-lg-12 no-padding margin-bottom-17">
						<div class='col-lg-12 no-padding'>
							<label>Usuário</label>
							<input type='text' name='user' id='userLogin' class='form-control' value='{email}' readonly />
						</div>
					</div>
					<div class="col-lg-12 no-padding margin-bottom-17">
						<div class='col-lg-6 no-padding'>
							<label>Senha</label>
							<input type='password' name='pass' class='form-control' placeholder='Digite a sua senha' />
						</div>
						<div class='col-lg-6 no-padding-right margin-bottom-17'>
							<label>Repita a Senha</label>
							<input type='password' name='rePass' class='form-control' placeholder='Repita a sua senha' />
						</div>
						<span class='alert-danger text-14px'>*Sua senha não será alterada se os campos de senha não forem preenchidos</span>
					</div>
				</div>
			</div>
			<div class="col-lg-12 margin-bottom-17">
				<div class='pull-right'>
					<button type='submit' class='btn btn-success'>Atualizar</button>
					<button type='button' class='btn btn-danger cancelar-atualizacao'>Cancelar</button>
				</div>
			</div>
		</form>
	</div>
</div>
<script type='text/javascript'>
	var baseUrl   =   '{url}';
	var page      =   'editar-usuario';
</script>
