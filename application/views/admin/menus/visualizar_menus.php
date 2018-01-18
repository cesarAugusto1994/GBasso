<div id="page-wrapper">
    <div class="col-lg-5 margin-top-20">
        <div class="panel panel-default">
            <div class="panel-heading">
                Visualizar Menus
            </div>
            <div class="panel-body no-padding-right no-padding-left">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>&nbsp;</th>
                                <th>Nome</th>                                
                                <th>Link</th>
                                <th>Descrição</th>
                                <th>Ordem</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if( count( $menus ) > 0 ) {
                                    foreach ($menus as $key ) {
                            ?>
                                        <tr>
                                            <td><input type='checkbox' class='chkEditarMenu' id="<?php echo $key['value']; ?>" /></td>
                                            <td><?php echo $key['name']; ?></td>
                                            <td><?php echo $key['link']; ?></td>
                                            <td><?php echo $key['desc']; ?></td>
                                            <td><?php echo $key['ordem']; ?></td>
                                            <td><?php echo $key['status']; ?></td>
                                        </tr>
                            <?php
                                    }
                                }else {
                                    echo "<tr><td colspan='5' style='text-align: center;'>Não existem menus</td></tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="panel-footer">
                <button class='btn btn-default cadMenu'>Cad. Menus</button>
                <button class='btn btn-primary editarMenu'>Editar Menus</button>
                <button class='btn btn-danger deletarMenu'>Deletar Menus</button>
            </div>
        </div>
    </div>
</div>
<script type='text/javascript'>

    var baseUrl       =  '{url}';

    var baseUrlAjax   =  '{url}admin/ajax/';

    var page          =  'visualizar-categorias';

</script>