<?php
    
    $hAtivo      =  '';

    $hInativo    =  'selected';

    $categoria   =  0;

    $nome        =  '';

    $action      =  $url . 'admin/ajax/categorias/cadastrar_subCategoria';

    if( isset( $subcat ) ) {

        if( count( $subcat ) == 1 ) {

            $action      =  $url . 'admin/ajax/categorias/salvar_edicao_subCategoria';

            $categoria   =   $subcat[0]['vCat'];

            $nome        =   $subcat[0]['nome'];

            if( $subcat[0]['home'] == 1 ) {

                $hAtivo    =  'selected';

                $hInativo  =  '';

            }

        }

    } 

?>

<div id="page-wrapper">
    <div class="col-lg-5 margin-top-20">
        <div class="panel panel-default">
            <div class="panel-heading">
                Cadastrar Categoria
            </div>
            <form class='cadastrar-subcategoria' method='POST' action="<?php echo $action; ?>">
                <div class="panel-body no-padding-right no-padding-left">
                    <fieldset>
                        <div class='col-lg-12 no-padding'>
                            <div class='col-lg-3'>
                                <label>Categoria</label>
                                <select class='form-control selectpicker' name='categoria'>
                                    <option value=''>Selecione...</option>
                                    <?php
                                        foreach ($cat as $key ) {

                                            $selected  =  $categoria == $key['value'] ? 'selected' : '';

                                            echo "<option value='" . $key['value'] . "' " . $selected . " >" . $key['text'] . "</option>";

                                        }
                                    ?>
                                </select>
                            </div>
                            <div class='col-lg-3'>
                                <label>Home</label>
                                <select class='form-control selectpicker' name='home'>
                                    <option value='0' <?php echo $hAtivo; ?> >Não exibido</option>
                                    <option value='1' <?php echo $hInativo; ?> >É exibido</option>
                                </select>
                            </div>
                            <div class='col-lg-6'>
                                <label>Nome</label>
                                <input type="text" class='form-control' name='nome' placeholder='Digite o nome' value="<?php echo $nome; ?>" />
                                <input type="hidden" class='form-control' name='idSubCat' value="<?php echo $id; ?>" />
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

    var page          =  'subcategorias';

</script>