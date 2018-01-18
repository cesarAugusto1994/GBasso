<div class="modal fade" id="modalConfigmenu">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title alert-confirm-title">Edite a ordem das Sub Categorias</h4>
            </div>
                <form class='configurar-ordem-subcat' method='POST' action='{url}admin/ajax/categorias/salvar_ordem_sub_categoria'>
                    <div class="modal-body">
                        <div class='row'>
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Sub Categoria</th>                                
                                        <th style='width: 80px;'>Ordem</th>
                                    </tr>
                                </thead>
                                <tbody id='modalConfig'>
                                    <tr>
                                        <td colspan="2" style='text-align: center;'>Nenhum dado foi encontrado</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer no-padding footer-alert-config">
                        <div class='button-confirm margin-10'>
                            <button type="submit" class="btn btn-success alert-confirm-btn alert-confirm-ok">Salvar</button>
                            <button type="button" class="btn btn-default alert-confirm-btn" data-dismiss="modal">Cancelar</button>
                            <input type='hidden' id='qtd' name='qtd' value='0' />
                        </div>
                        <div class='alert alert-success message-form message-confirm-alert center hidden'></div>
                    </div>
                </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->