<div id="page-wrapper">
    <div class="col-lg-5 margin-top-20">
        <div class="panel panel-default">
            <div class="panel-heading">
                Visualizar Sub Menus
            </div>
            <div class="panel-body no-padding-right no-padding-left">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>&nbsp;</th>
                                <th>Menu</th> 
                                <th>Nome</th>                                
                                <th>Link</th>
                                <th>Ordem</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if( count( $subMenus ) > 0 ) {
                                    foreach ($subMenus as $key ) {
                            ?>
                                        <tr>
                                            <td><input type='checkbox' class='chkEditarSubMenu' id="<?php echo $key['value']; ?>" /></td>
                                            <td><?php echo $key['menu']; ?></td>
                                            <td><?php echo $key['name']; ?></td>
                                            <td><?php echo $key['link']; ?></td>
                                            <td><?php echo $key['ordem']; ?></td>
                                            <td><?php echo $key['status']; ?></td>
                                        </tr>
                            <?php
                                    }
                                }else {
                                    echo "<tr><td colspan='6' style='text-align: center;'>Não existem sub menus</td></tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="panel-footer">
                <button class='btn btn-default cadSubMenu'>Cad. Sub Menus</button>
                <button class='btn btn-primary editarSubMenu'>Editar Sub Menus</button>
                <button class='btn btn-danger deletarSubMenu'>Deletar Sub Menus</button>
            </div>
        </div>
    </div>
</div>
<script type='text/javascript'>

    var baseUrl       =  '{url}';

    var baseUrlAjax   =  '{url}admin/ajax/';

    var page          =  'visualizar-submenus';

</script>