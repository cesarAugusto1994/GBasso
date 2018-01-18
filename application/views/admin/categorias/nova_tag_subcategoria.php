<?php

    $error      =  0;

    $idCat      =  '';

    $idSubCat   =  '';

    $nome       =  '';

    $sExibido   =  'selected';

    $sNExibido  =  '';

    $action     =  $url . 'admin/ajax/categorias/salvar_tag_categoria';

    $idItm      =  '';

    if( isset( $tag ) ) {

        if( count( $tag ) == 1 ) {

            $idItm       =  $id;

            $action      =  $url . 'admin/ajax/categorias/salvar_edicao_tag_categoria';

            $idCat       =  $tag[0]['idCat'];

            $idSubCat    =  $tag[0]['idSubcat'];

            $nome        =  $tag[0]['nome'];

            if( $tag[0]['home'] == 0 ) {

                $sExibido    =  '';

                $sNExibido   =  'selected';

            }

        }else {

            $error  =  1;

        }

    }else {

        $error  =  1;

    }

?>
<div id="page-wrapper">
    <div class="col-lg-5 margin-top-20">
        <div class="panel panel-default">
            <div class="panel-heading">
                Cadastrar Tag de Categoria
            </div>
            <form class='cadastrar-tagcategoria' method='POST' action="<?php echo $action; ?>">
                <div class="panel-body no-padding-right no-padding-left">
                    <fieldset>
                        <div class='col-lg-12 no-padding'>
                            <div class='col-lg-4'>
                                <label>Sub Categoria</label>
                                <select class='form-control selectpicker' name='categoria'>
                                    <option value=''>Selecione...</option>
                                    <?php
                                        foreach ($categorias as $key ) {

                                            $selected  =  $idCat == $key['value'] ? 'selected' : '';

                                            echo "<option value='" . $key['value'] . "' " . $selected . " >" . $key['text'] . "</option>";

                                        }
                                    ?>
                                </select>
                            </div>                        
                            <div class='col-lg-4'>
                                <label>Sub Categoria</label>
                                <select class='form-control selectpicker' name='subcategoria' disabled>
                                    <option value=''>Selecione...</option>
                                </select>
                            </div>
                            <div class='col-lg-4'>
                                <label>Home</label>
                                <select class='form-control selectpicker' name='home'>
                                    <option value='0' <?php echo $sExibido; ?>>Não exibido</option>
                                    <option value='1' <?php echo $sNExibido; ?>>É exibido</option>
                                </select>
                            </div>
                            <div class='col-lg-6 margin-top-default'>
                                <label>Nome</label>
                                <input type="text" class='form-control' name='nome' placeholder='Digite o nome' value="<?php echo $nome; ?>" />
                            </div>                          
                        </div>
                    </fieldset>
                </div>
                <div class="panel-footer">
                    <button class='btn btn-success'>Cadastrar</button>
                    <button class='btn btn-danger' data-dismiss="modal">Cancelar</button>
                    <input type='hidden' id='selecteSubCat' value="<?php echo $idSubCat; ?>" />
                    <input type='hidden' id='idTag' name='idTag' value="<?php echo $idItm; ?>" />
                </div>
            </form>
        </div>
    </div>
</div>
<script type='text/javascript'>

    var baseUrl       =  '{url}';

    var baseUrlAjax   =  '{url}admin/ajax/';

    var page          =  'tagcategoria';

</script>