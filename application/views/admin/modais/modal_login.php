<div class="modal fade" id="alert_login_required">
    <div class="modal-dialog">
        <div class="modal-content" style='width: 450px;'>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title alert-confirm-title">Faça login novamente</h4>
            </div>
            <div class="modal-body panel-default">
                <form class='form-login' method='POST' action='{url}admin/ajax/login/logar'>
                    <fieldset>
                        <div class="form-group">
                            <input class="form-control" placeholder="Digite seu usuário" name="user" type="text" autofocus required>
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Digite sua senha" name="pass" type="password" value="" required>
                        </div>
                        <input type="hidden" name="controller" value="no-login">
                        <!--
                        <div class="checkbox">
                            <a href="#">Esqueci minha senha</a>
                        </div>
                        -->
                        <div class="alert alert-danger alert-dismissable hidden">
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                        </div>                                
                        <!-- Change this to a button or input when using this as a form -->
                        <button class="btn btn-lg btn-success btn-block">Logar</button>
                    </fieldset>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->