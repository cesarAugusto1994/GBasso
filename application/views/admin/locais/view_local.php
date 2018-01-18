<div id="page-wrapper">
    <div class="col-lg-9 margin-top-20">
        <div class="panel panel-default">
            <div class="panel-heading">
                Visualizar Locais
            </div>
            <div class="panel-body no-padding-right no-padding-left">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th style='width: 20px'>&nbsp;</th>
                                <th>Empresa</th>
                                <th>Local</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if( isset( $locais ) && count( $locais ) > 0 ) {

                                    foreach ( $locais as $key ) {
                            ?>
                                        <tr>
                                            <td><input type="checkbox" class='chkLocais' id="<?php echo $key['val']; ?>" /></td>
                                            <td><?php echo $key['emp']; ?></td>
                                            <td><?php echo $key['end']; ?></td>
                                        </tr>
                            <?php
                                    }

                                }else {
                                    echo "<tr><td colspan='2' style='text-align: center;'>Não existem produtos</td></tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="panel-footer">
                <button class='btn btn-primary novoLocal'>Novo</button>
                <button class='btn btn-danger editarLocal'>Editar</button>
            </div>
        </div>
    </div>
</div>
<script type='text/javascript'>

    var baseUrl       =  '{url}';

    var baseUrlAjax   =  '{url}admin/ajax/';

    var page          =  'visualizar-categorias';

</script>