<div class="modal fade" id="estoque">
    <div class="modal-dialog">
        <div class="modal-content" style='width: 500px;'>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title alert-confirm-title">Estoque</h4>
            </div>
            <form class='form-estoque' method='POST' action='{url}admin/ajax/produtos/salvarEstoque'>
                <div class="modal-body">
                    <div class='row'>                    
                        <div class='col-md-12 margin-top-default no-padding'>
                            <div class='col-md-4'>
                                <label>Qtde</label>
                                <input type="text" name='qtd' id='qtd' class='form-control money' value='0,00' />
                            </div>
                            <div class='col-md-4'>
                                <label>Qtde Mínima</label>
                                <input type="text" name='qtdMin' id='qtdMin' class='form-control money' value='0,00' />
                            </div>
                            <div class='col-md-4'>
                                <label>Qtde Máxima</label>
                                <input type="text" name='qtdMax' id='qtdMax' class='form-control money' value='0,00' />
                            </div>
                        </div>
                        <input type="hidden" name='idProduto' id='idProdutoEstoque' class='form-control' />
                    </div>
                </div>
                <div class='modal-footer no-padding'>
                    <div class='row no-margin'>
                        <div class='alert alert-success no-margin text-align-left no-radius hidden msg-form-estoque'></div>
                        <div class='margin-top-default margin-bottom-10px pull-right padding-right-25 btn-form-estoque'>
                            <button type='submit' class='btn btn-primary'>Salvar</button>
                            <button type='button' class='btn btn-danger' data-dismiss='modal'>Cancelar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->