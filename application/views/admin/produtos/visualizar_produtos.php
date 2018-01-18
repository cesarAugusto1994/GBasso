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
                                <th>&nbsp;</th>
                                <th>Nome</th>
                                <th>Sub Categoria</th>
                                <th>Código</th>
                                <th>Referência</th>
                                <th>Status</th>
                                <th>Valor</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if( isset( $produtos ) && count( $produtos ) > 0 ) {

                                    foreach ( $produtos as $key ) {
                            ?>
                                        <tr>
                                            <td><input type='checkbox' id="<?php echo $key['value']; ?>" class='chkProdutosDeletar' /> </td>
                                            <td><?php echo $key['nome']; ?></td>
                                            <td><?php echo $key['subcat']; ?></td>
                                            <td><?php echo $key['codigo']; ?></td>
                                            <td><?php echo $key['referencia']; ?></td>
                                            <td><?php echo $key['status']; ?></td>
                                            <td><?php echo $key['valor']; ?></td>
                                        </tr>
                            <?php
                                    }

                                }else {
                                    echo "<tr><td colspan='8' style='text-align: center;'>Não existem produtos</td></tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="panel-footer">
                <a href='{url}admin/produtos/cadastrar' class='btn btn-success'>Novo</a>
                <a href='#' class='btn btn-primary editar-produtos'>Editar</a>
                <button class='btn btn-info estoqueProduto'>Estoque</button>
                <button class='btn btn-danger deletarProdutos'>Deletar</button>                
            </div>
        </div>
    </div>
</div>
<script type='text/javascript'>

    var baseUrl       =  '{url}';

    var baseUrlAjax   =  '{url}admin/ajax/';

    var page          =  'visualizar-categorias';

</script>