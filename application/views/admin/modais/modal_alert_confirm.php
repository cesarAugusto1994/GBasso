<div class="modal fade" id="alerta_confirm">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title alert-confirm-title">Atenção</h4>
            </div>
            <div class="modal-body">
                <div class='row'>
                    <p class='alert-confirm-message'>

                    </p>
                    <div class='input-group col-lg-12 hidden' id='campoSenha'>
                        <label>Digite sua senha</label>
                        <input class='form-control' type='password' name='password' id='password' placeholder='Confirme com sua senha' />
                    </div>
                </div>
            </div>
            <div class="modal-footer no-padding footer-alert-config">
                <div class='button-confirm margin-10'>
                    <button type="button" class="btn btn-danger  alert-confirm-btn alert-confirm-ok">Confirmar</button>
                    <button type="button" class="btn btn-default alert-confirm-btn" data-dismiss="modal">Cancelar</button>
                </div>
                <div class='alert alert-success message-form message-confirm-alert center hidden'></div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->