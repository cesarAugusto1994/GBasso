<div id="page-wrapper">
    <div class="col-lg-10 margin-top-20">
        <div class="panel panel-default">
            <div class="panel-heading">
                Cadastrar Produtos
            </div>
            <form class='cadastrar-produto' method='POST' action='{url}admin/ajax/produtos/cadastrar'>
                <div class="panel-body no-padding-right no-padding-left">
                    <fieldset>
                        <div class='col-lg-4 no-padding'>
                            <div class='col-lg-12'>
                                <label>Status</label>
                                <select class='form-control selectpicker' name='status'>
                                    <option value='0'>Inativo</option>
                                    <option value='1' selected>Átivo</option>
                                </select>
                            </div>
                            <div class='col-lg-12 margin-top-default'>
                                <label>Categorias</label>
                                <select class='form-control selectpicker' name='categoria'>
                                    <option value=''>Selecione</option>
                                </select>
                            </div>
                        </div>

                        <div class='col-lg-4 no-padding'>
                            <div class='col-lg-12'>
                                <label>Código</label>
                                <input class='form-control' type='text' name='codigo' placeholder='Digite o código' />
                            </div>
                            <div class='col-lg-12 margin-top-default'>
                                <label>Sub Categoria</label>
                                <select class='form-control selectpicker' name='subcategoria' disabled>
                                    <option value=''>Selecione...</option>
                                </select>
                            </div>
                        </div>

                        <div class='col-lg-4 no-padding'>
                            <div class='col-lg-12'>
                                <label>Nome</label>
                                <input class='form-control' type='text' name='nome' placeholder='Digite o nome do produto' />
                            </div>
                            <div class='col-lg-6 margin-top-default'>
                                <label>Referência</label>
                                <input class='form-control' type='text' name='referencia' placeholder='Digite a referência' />
                            </div>                              
                            <div class='col-lg-6 margin-top-default'>
                                <label>Valor</label>
                                <input class='form-control money' type='text' name='valor' value="0,00" placeholder='Digite o valor do produto' />
                            </div>                            
                        </div>

                        <div class='col-lg-3 margin-top-default'>
                            <label>Und. de medida</label>
                            <select class='form-control selectpicker' name='unidadeMedida'>
                                <option value=''>Selecione</option>
                            </select>
                        </div>

                        <div class='col-lg-2 margin-top-default'>
                            <label>Peso (kg)</label>
                            <input class='form-control' type='text' name='peso' value='0,00' placeholder='Digite o peso' />
                        </div>  

                        <div class='col-lg-7 no-padding'>
                            <div class='col-lg-3 margin-top-default'>
                                <label>Largura (cm)</label>
                                <input class='form-control money' type='text' name='largura' value='0,00' placeholder='' />
                            </div> 
                            <div class='col-lg-3 margin-top-default'>
                                <label>Altura (cm)</label>
                                <input class='form-control money' type='text' name='altura' value='0,00' placeholder='' />
                            </div>
                            <div class='col-lg-3 margin-top-default'>
                                <label>Comprim. (cm)</label>
                                <input class='form-control money' type='text' name='profundidade' value='0,00' placeholder='' />
                            </div>
                            <div class='col-lg-3 margin-top-default'>
                                <label style="float: left; width: 100%;">Validar frete</label>
                                <button type='button' class='btn btn-success verificarFrete'>Verificar</button>
                            </div>                            
                        </div>

                        <div class='col-lg-6 no-padding' style='z-index: 0'>
                            <div class='col-lg-12 margin-top-default'>
                                <label>Código de barras</label>
                                <input class='form-control' type='text' name='codigoBarras' placeholder='Digite o código de barras do produto' />
                            </div> 
                        </div> 

                        <div class='col-lg-6 no-padding' style='z-index: 0'>
                            <div class='col-lg-12 margin-top-default'>
                                <label>Selecione as imagens</label>
                                <input type='file' name='images[]' multiple />
                            </div> 
                        </div> 

                        <div class='divider-bottom'></div>

                        <div class='col-lg-12 content-tipos no-padding'>
                            <div class='col-lg-3 margin-top-default'>
                                <label>Tipo</label>
                                <select class='form-control selectpicker' name='tipo0'>
                                </select>
                            </div>
                            <div class='col-lg-3 margin-top-default'>
                                <label>Título</label>
                                <input type='text' class='form-control titulo-tipo' name='titulo0' placeholder='Ex: tamanhos' data-name-input='tipo0' />
                                <div class='relative hidden'>
                                    <div class='result-search-select'>
                                        <ul class="list-group"></ul>                                      
                                    </div>
                                </div>
                            </div>
                            <div class='col-lg-5 margin-top-default'>
                                <label>Tags</label>
                                <div class='form-control input-mask-div'>
                                    <div class="tag-option-selected"></div>
                                    <input type='text' class='input-reseted tag-tipo' name='tags0' placeholder='Ex: P, M, G, GG' />
                                </div>                                
                                <div class='relative hidden'>
                                    <div class='result-search-select'>
                                        <ul class="list-group"></ul>                                      
                                    </div>
                                </div>                                
                            </div>
                            <div class='col-lg-1 margin-top-default'>
                                <button class='btn btn-danger fa fa-trash-o btn-delete-tipos fa-2x' type='button'></button>
                            </div>
                        </div>

                        <div class='col-lg-12 no-padding'>
                            <div class='col-lg-12 margin-top-default'>
                                <button class='btn btn-primary fa fa-2x btn-add-tipo fa-plus' type='button'></button>
                            </div>
                        </div>

                        <div class='divider-bottom'></div>

                        <div class='col-lg-12'>
                            <label>Descrição</label>
                            <textarea class='form-control' placeholder='Digite a descrição do produto' name='descricao' rows="7"></textarea>
                        </div>
                        
                        <div class='divider-bottom'></div>

                        <div class='col-lg-12'>
                            <label>Descrição mais completa</label>
                            <textarea class='form-control editor' name='editor1' placeholder='Digite a descrição do produto' rows="7"></textarea>
                        </div>
                    </fieldset>
                </div>
                <div class="panel-footer">
                    <button class='btn btn-success'>Cadastrar</button>
                    <button class='btn btn-danger' data-dismiss="modal">Cancelar</button>
                </div>
                <input type='hidden' value='1' id='qtdHTags' name='qtdHTags' />
            </form>
        </div>
    </div>
</div>
<script type='text/javascript'>

    var baseUrl       =  '{url}';

    var baseUrlAjax   =  '{url}admin/ajax/';

    var page          =  'cadastrar-produtos';

    CKEDITOR.replace( 'editor1', {
        language: 'pt-br',
        uiColor: '#cdcdcd',
        filebrowserBrowseUrl: baseUrlAjax + 'upload/view',
        filebrowserUploadUrl: baseUrlAjax + 'upload/send'
    });

</script>