<div id="page-wrapper">
    <div class="col-lg-10 margin-top-20">
        <div class="panel panel-default">
            <div class="panel-heading">
                Gerenciar images do produto: {name}
            </div>
            <div class="panel-body no-padding-right no-padding-left">
                <div class='content-image-select'></div>
                <input type='hidden' id='idProduto' value='{id}' />
            </div>
            <div class='col-lg-12 margin-bottom-10px margin-top-20'>
                <button class='btn btn-danger deletar-imagem-produto'>Deletar</button>
            </div>            
        </div>
    </div>
</div>
<script type='text/javascript'>

    var baseUrl       =  '{url}';

    var baseUrlAjax   =  '{url}admin/ajax/';

    var page          =  'editar-imagens-produtos';

</script>