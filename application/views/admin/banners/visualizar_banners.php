<div id="page-wrapper">
    <div class="col-lg-9 margin-top-20">
        <div class="panel panel-default">
            <div class="panel-heading">
                Visualizar Produtos
            </div>
            <div class="panel-body no-padding-right no-padding-left">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th width='40'>&nbsp;</th>
                                <th>Local</th>
                            </tr>
                        </thead>
                        <tbody id='visualizarBanners'>
                            <?php
                                if( isset( $banner ) && count( $banner ) > 0 ) {
                                    $i = 1;
                                    foreach ( $banner as $key ) {
                            ?>
                                        <tr>
                                            <td><input type='checkbox' class='chkBanners' id="<?php echo $key['value']; ?>" /></td>
                                            <td><?php echo $key['local']; ?></td>
                                        </tr>
                            <?php
                                        $i++;
                                    }
                                }else {
                                    echo "<tr><td colspan='2' style='text-align: center;'>Não existem banners</td></tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="panel-footer">
                <a href='{url}admin/banners/cadastrar' class='btn btn-success'>Novo</a>
                <a href='#' class='btn btn-primary visualizarImagensBanners'>Editar</a>
            </div>
        </div>
    </div>
</div>
<script type='text/javascript'>

    var baseUrl       =  '{url}';

    var baseUrlAjax   =  '{url}admin/ajax/';

    var page          =  'visualizar-categorias';

</script>