<?php
    
    $action     =   $url . 'admin/ajax/categorias/cadastrar';

    $nome       =   '';

    $descricao  =   '';

    $hInativo   =  '';

    $hAtivo     =  'selected';

    $sInativo   =  '';

    $sAtivo     =  'selected';

    if( isset( $cat ) ) {

        if( count( $cat ) == 1  ) {

            $action     =  $url . 'admin/ajax/categorias/salvar_edicao_categoria';

            $nome       =  $cat[0]['nome'];

            $descricao  =  $cat[0]['descricao'];

            if( $cat[0]['fHome'] ==  0 ) {

                $hInativo  =  'selected';

                $hAtivo    =  '';

            }else {

                $hInativo  =  '';

                $hAtivo    =  'selected';

            }

            if( $cat[0]['fStatus'] ==  0 ) {

                $sInativo  =  'selected';

                $sAtivo    =  '';

            }else {

                $sInativo  =  '';

                $sAtivo    =  'selected';

            }

        }else {

            echo "<script>alert('Categoria não encontrada');</script>";

        }

    }

?>

<div id="page-wrapper">
    <div class="col-lg-5 margin-top-20">
        <div class="panel panel-default">
            <div class="panel-heading">
                Cadastrar Categoria
            </div>
            <form class='cadastrar-categoria' method='POST' action="<?php echo $action; ?>">
                <div class="panel-body no-padding-right no-padding-left">
                    <fieldset>
                        <div class='col-lg-12 no-padding'>
                            <div class='col-lg-3'>
                                <label>Status</label>
                                <select class='form-control selectpicker' name='status'>
                                    <option value='0' <?php echo $sInativo; ?> >Inativo</option>
                                    <option value='1' <?php echo $sAtivo; ?> >Átivo</option>
                                </select>
                            </div>
                            <div class='col-lg-3'>
                                <label>Home</label>
                                <select class='form-control selectpicker' name='home'>
                                    <option value='0' <?php echo $hInativo; ?> >Não exibido</option>
                                    <option value='1' <?php echo $hAtivo; ?> >É exibido</option>
                                </select>
                            </div>
                            <div class='col-lg-6'>
                                <label>Nome</label>
                                <input type="text" class='form-control' name='nome' placeholder='Digite o nome' value="<?php echo $nome; ?>" />
                            </div>
                            <div class='col-lg-12 margin-top-default'>
                                <label>Descrição</label>
                                <input type="text" class='form-control' name='descricao' placeholder='Digite a descrição da categoria' value="<?php echo $descricao; ?>" />
                                <input type="hidden" class='form-control' name='idcat' value="<?php echo $id; ?>" />
                            </div>                            
                        </div>
                    </fieldset>
                </div>
                <div class="panel-footer">
                    <button class='btn btn-success'>Cadastrar</button>
                    <button class='btn btn-danger' data-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script type='text/javascript'>

    var baseUrl       =  '{url}';

    var baseUrlAjax   =  '{url}admin/ajax/';

    var page          =  'categorias';

</script>





