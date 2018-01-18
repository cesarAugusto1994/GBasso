<div id="page-wrapper">
    <div class="col-lg-10 margin-top-20">
        <div class="panel panel-default">
            <div class="panel-heading">
                Visualizar Vendas
            </div>
            <div class="panel-body no-padding-right no-padding-left">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th style='width: 40px;'><input type='checkbox' id='selectAllVendas' /></th>
                                <th style='width: 80px;'>Ref.</th> 
                                <th>Cliente</th>                                
                                <th style='width: 100px;'>Valor</th>
                                <th style='width: 100px;'>Frete</th>
                                <th style='width: 100px;'>Gateway</th>
                                <th style='width: 160px;'>Data</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if( isset( $vendas ) && count( $vendas ) > 0 ) {

                                    foreach ($vendas as $key => $value) {
                            ?>
                                        <tr id="<?php echo 'tr' . $value['valu']; ?>">
                                            <td><input type='checkbox' class='selectVendas' id="<?php echo $value['valu']; ?>" /></td>
                                            <td><?php echo $value['refe']; ?></td>
                                            <td><?php echo $value['usua']; ?></td>
                                            <td><?php echo $value['valo']; ?></td>
                                            <td><?php echo $value['fret']; ?></td>
                                            <td><?php echo $value['gatw']; ?></td>
                                            <td><?php echo $value['data']; ?></td>
                                        </tr>
                            <?php
                                    }

                                }else {

                                    echo "<tr><td colspan='8' class='text-center'>Não existem vendas</td></tr>";

                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="panel-footer">
                <button class='btn btn-default rastrear'>Rastrear</button>
                <button class='btn btn-default codigoRastreamento'>Informar Cód. Rastreamento</button>
                <button class='btn btn-default infoVendas'>Info Vendas</button>
            </div>
        </div>
    </div>
</div>
<script type='text/javascript'>

    var baseUrl       =  '{url}';

    var baseUrlAjax   =  '{url}admin/ajax/';

    var page          =  'visualizar-vendas';

</script>