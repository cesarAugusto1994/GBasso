    <div class="container">        
        <div class="row">
            <div class="col-md-4 col-md-offset-4 margin-top-70">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Acesso restrito</h3>
                    </div>
                    <div class="panel-body">
                        <form class='form-login' method='POST' action='{url}admin/ajax/login/logar'>
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Digite seu usuário" name="user" type="text" autofocus required>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Digite sua senha" name="pass" type="password" value="" required>
                                </div>
                                <input type="hidden" name="controller" value="login">
                                <div class="checkbox">
                                    <a href="#">Esqueci minha senha</a>
                                </div>
                                <div class="alert alert-danger alert-dismissable hidden">
                                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                </div>                                
                                <!-- Change this to a button or input when using this as a form -->
                                <button class="btn btn-lg btn-success btn-block">Login</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


