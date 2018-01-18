<div id="page-wrapper">
    <div class="col-lg-5 margin-top-20">
        <div class="panel panel-default">
            <div class="panel-heading">
                Visualizar Item Menus
            </div>
            <div class="panel-body no-padding-right no-padding-left">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>&nbsp;</th>
                                <th>Sub Menu</th> 
                                <th>Nome</th>                                
                                <th>Link</th>
                                <th>Ordem</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if( count( $itemMenus ) > 0 ) {
                                    foreach ($itemMenus as $key ) {
                            ?>
                                        <tr>
                                            <td><input type='checkbox' class='chkEditarItemMenu' id="<?php echo $key['value']; ?>" /></td>
                                            <td><?php echo $key['submenu']; ?></td>
                                            <td><?php echo $key['name']; ?></td>
                                            <td><?php echo $key['link']; ?></td>
                                            <td><?php echo $key['ordem']; ?></td>
                                            <td><?php echo $key['status']; ?></td>
                                        </tr>
                            <?php
                                    }
                                }else {
                                    echo "<tr><td colspan='6' style='text-align: center;'>Não existem item de menus</td></tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="panel-footer">
                <button class='btn btn-default cadItemMenu'>Cad. Item Menus</button>
                <button class='btn btn-primary editarItemMenu'>Editar Item Menus</button>
                <button class='btn btn-danger deletarItemMenu'>Deletar Item Menus</button>
            </div>
        </div>
    </div>
</div>
<script type='text/javascript'>

    var baseUrl       =  '{url}';

    var baseUrlAjax   =  '{url}admin/ajax/';

    var page          =  'visualizar-itemmenus';

</script>