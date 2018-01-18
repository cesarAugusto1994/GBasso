<div class="modal fade" id="modal_endereco">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title modal-endereco-header">Novo Endereço</h4>
            </div>
            <form class="salvarEndereco" method='POST' action='{url}ajax/minha/conta/novo/endereco'>
                <div class="modal-body">
                    <div class='row'>
                        <div class='col-lg-12'>
                            <div class="col-lg-12 no-padding margin-bottom-17">
                                <div class='col-lg-5 no-padding'>
                                    <label>Destinatário</label>
                                    <input type='text' name='destinatario' class='form-control' />
                                </div>
                                <div class='col-lg-7'>
                                    <label>Pt. Referência</label>
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
                            <div class="col-lg-12 no-padding margin-bottom-17">
                                <div class='col-lg-6 no-padding'>
                                    <div class='checkbox'>
                                        <label>
                                            <input type='checkbox' name='principal' class='no-margin-top' />
                                            Endereço Principal
                                        </label>
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Salvar</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                </div>
                <input type='hidden' name='idEndereco' id='idEndereco' />
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->