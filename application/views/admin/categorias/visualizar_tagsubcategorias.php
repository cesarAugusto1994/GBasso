<div id="page-wrapper">
    <div class="col-lg-5 margin-top-20">
        <div class="panel panel-default">
            <div class="panel-heading">
                Visualizar Tags Categorias
            </div>
            <div class="panel-body no-padding-right no-padding-left">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>&nbsp;</th>
                                <th>Categoria</th>                                
                                <th>Sub Categoria</th>
                                <th>Nome</th>
                                <th>Exibir home</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if( isset( $cattag ) && count( $cattag ) > 0 ) {
                                    foreach ( $cattag as $key ) {
                            ?>
                                        <tr>
                                            <td><input type='checkbox' id="<?php echo $key['value']; ?>" class='chkItmSubCategoria' /> </td>
                                            <td><?php echo $key['cat']; ?></td>
                                            <td><?php echo $key['subcat']; ?></td>
                                            <td><?php echo $key['nome']; ?></td>
                                            <td><?php echo $key['home'] == 1 ? 'Exibido' : 'Não Exibido'; ?></td>
                                        </tr>
                            <?php
                                    }
                                }else {
                                    echo "<tr><td colspan='4' style='text-align: center;'>Não existem Tags Categorias</td></tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="panel-footer">
                <a href='{url}admin/categorias/nova_tag_categoria' class='btn btn-success'>Nova</a>
                <a href='#' class='btn btn-primary editar-itmsubcategorias'>Editar</a>
                <button class='btn btn-danger deletarTagCategorias' data-dismiss="modal">Deletar</button>
            </div>
        </div>
    </div>
</div>
<script type='text/javascript'>

    var baseUrl       =  '{url}';

    var baseUrlAjax   =  '{url}admin/ajax/';

    var page          =  'visualizar-subcategorias';

</script>