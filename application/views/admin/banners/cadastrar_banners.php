<div id="page-wrapper">
    <div class="col-lg-10 margin-top-20">
        <div class="panel panel-default">
            <div class="panel-heading">
                Cadastrar Banner Rotativo
            </div>
            <form class='cadastrar-banner' action='{url}admin/ajax/banners/cadastrar' method="post" enctype="multipart/form-data">
                <div class="panel-body no-padding-right no-padding-left">
                    <fieldset>
                        <div class='col-lg-4 no-padding'>
                            <div class='col-lg-12'>
                                <label>Local banner</label>
                                <select class='form-control selectpicker localBanner' name='localBanner'>
                                    <option value='1'>Banner Rotativo</option>
                                    <option value='2'>Banner 1</option>
                                    <option value='3'>Banner 2</option>
                                    <option value='4'>Banner 3</option>
                                    <option value='5'>Banner 4</option>
                                    <option value='6'>Banner 5</option>
                                    <option value='7'>Banner 6</option>
                                </select>
                            </div>
                        </div>                    
                        <div class='col-lg-7 no-padding'>
                            <div class='col-lg-12'>
                                <label>Selecione as imagens</label>
                                <input type='file' name='images[]' id='imagens' multiple />
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="panel-footer">
                    <button class='btn btn-success'>Cadastrar</button>
                    <button class='btn btn-danger' data-dismiss="modal">Cancelar</button>
                </div>
                <input type='hidden' value='1' id='typeBanner' />
            </form>
        </div>
    </div>
</div>
<script type='text/javascript'>

    var baseUrl       =  '{url}';

    var baseUrlAjax   =  '{url}admin/ajax/';

    var page          =  'cadastrar-banner-rotativo';

</script>