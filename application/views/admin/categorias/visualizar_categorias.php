<div id="page-wrapper">
    <div class="col-lg-5 margin-top-20">
        <div class="panel panel-default">
            <div class="panel-heading">
                Visualizar categorias
            </div>
            <div class="panel-body no-padding-right no-padding-left">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>&nbsp;</th>
                                <th>Nome</th>                                
                                <th>Descrição</th>
                                <th>Exibir home</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if( isset( $cat ) && count( $cat ) > 0 ) {

                                    foreach ( $cat as $key ) {
                            ?>
                                        <tr>
                                            <td><input type='checkbox' id="<?php echo $key['value']; ?>" class='chkCategoria' /> </td>
                                            <td><?php echo $key['nome']; ?></td>
                                            <td><?php echo $key['descricao']; ?></td>
                                            <td><?php echo $key['home']; ?></td>
                                            <td><?php echo $key['status']; ?></td>
                                        </tr>
                            <?php
                                    }

                                }else {
                                    echo "<tr><td colspan='5' style='text-align: center;'>Não existem categorias</td></tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="panel-footer">
                <a href='{url}admin/categorias/nova_categoria' class='btn btn-success'>Nova</a>
                <a href='#' class='btn btn-primary editar-categorias'>Editar</a>
                <button class='btn btn-danger deletarCategorias'>Deletar</button>
                <button class='btn btn-default configurarCatMenu'>Config. Menu</button>
            </div>
        </div>
    </div>
</div>
<script type='text/javascript'>

    var baseUrl       =  '{url}';

    var baseUrlAjax   =  '{url}admin/ajax/';

    var page          =  'visualizar-categorias';

</script>