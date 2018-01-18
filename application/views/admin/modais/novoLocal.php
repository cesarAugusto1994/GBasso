<div class="modal fade" id="locais">
    <div class="modal-dialog" style='width: 650px;'>
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title alert-confirm-title">Locais</h4>
            </div>
            <form class='form-local' method='POST' action='{url}admin/ajax/produtos/salvarLocal'>
                <div class="modal-body">
                    <div class='row'>                    
                        <div class='col-md-12 margin-top-default no-padding'>
                            <div class='col-md-6'>
                                <label>Empresa</label>
                                <input type="text" name='empresa' id='empresa' class='form-control' />
                            </div>
                            <div class='col-md-6'>
                                <label>Endereço</label>
                                <input type="text" name='endereco' id='endereco' class='form-control' />
                                <input type="hidden" name='idLocal' id='idLocal' class='form-control' />
                            </div>
                        </div>
                    </div>
                </div>
                <div class='modal-footer no-padding'>
                    <div class='row no-margin'>
                        <div class='alert alert-success no-margin text-align-left no-radius hidden msg-form-locais'></div>
                        <div class='margin-top-default margin-bottom-10px pull-right padding-right-25 btn-form-locais'>
                            <button type='submit' class='btn btn-primary'>Salvar</button>
                            <button type='button' class='btn btn-danger' data-dismiss='modal'>Cancelar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->