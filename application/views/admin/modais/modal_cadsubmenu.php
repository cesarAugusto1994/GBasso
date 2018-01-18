<div class="modal fade" id="cadastrarSubMenu">
    <div class="modal-dialog">
        <div class="modal-content" style='width: 850px;'>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title alert-confirm-title">Cadastrar Menu</h4>
            </div>
            <form class='cadastrar-menu' method='POST' action='{url}admin/ajax/menus/cadastrarSubMenu'>
                <div class="modal-body panel-default">
                    <fieldset>
                        <div class="col-lg-4">
                            <label>Menu</label>
                            <select class='form-control selectpicker' name='menu'>
                                {menus}
                                    <option value='{value}'>{name}</option>
                                {/menus}
                            </select>
                        </div>
                        <div class="col-lg-4">
                            <label>Nome</label>
                            <input class="form-control" name="nome" type="text">
                        </div>
                        <div class="col-lg-4">
                            <label>Link</label>
                            <input class="form-control" name="link" type="text">
                        </div>
                        <div class="col-lg-4 margin-top-20">
                            <label>Ordem</label>
                            <input class="form-control" name="ordem" type="text" value='1'>
                        </div>
                        <div class="col-lg-4 margin-top-20">
                            <label>Status</label>
                            <select class='form-control selectpicker' name='status'>
                                <option value='1' selected>Ativo</option>
                                <option value='0'>Inativo</option>
                            </select>
                        </div>
                        <input type='hidden' name='idSubMenu' id='idSubMenu' />
                    </fieldset>
                </div>
                <div class="modal-footer panel-default">
                    <p class='message-alert alert alert-danger hidden' style='border-radius: 0; margin: 0; text-align: left;'></p>
                    <div class="col-lg-12">
                        <button type='submit' class='btn btn-success'>Cadastrar</button>
                        <button type='button' class='btn btn-danger closeModal' data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->