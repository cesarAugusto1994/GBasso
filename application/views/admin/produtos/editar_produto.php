<?php

    $status        =  '';

    $codigo        =  '';

    $nome          =  '';

    $categoria     =  '';

    $subCategoria  =  '';

    $referencia    =  '';

    $valor         =  '';

    $undMedida     =  '';

    $peso          =  '';

    $largura       =  '';

    $altura        =  '';

    $profundidade  =  '';

    $codBarras     =  '';

    $descricao     =  '';

    $descCompleta  =  '';

    $id            =  '';

    $qtdTags       =  0;

    if( isset( $info ) || count( $info ) != 1 ) {

        $id             =    $info[0]['value'];

        $status         =    $info[0]['sta'];

        $codigo         =    $info[0]['codigo'];

        $nome           =    $info[0]['nome'];

        $categoria      =    $cat[0]['cat'];

        $subCategoria   =    $cat[0]['subcat'];

        $referencia     =    $info[0]['referencia'];

        $valor          =    $info[0]['valor'];

        $undMedida      =    $info[0]['undmed'];

        $peso           =    $info[0]['peso'];

        $largura        =    $info[0]['largura'];

        $altura         =    $info[0]['altura'];

        $profundidade   =    $info[0]['prof'];

        $codBarras      =    $info[0]['ean'];

        $descricao      =    $info[0]['desc'];

        $descCompleta   =    $info[0]['descCmp'];        

    }

?>
<div id="page-wrapper">
    <div class="col-lg-10 margin-top-20">
        <div class="panel panel-default">
            <div class="panel-heading">
                Cadastrar Produtos
            </div>
            <form class='cadastrar-produto' method='POST' action='{url}admin/ajax/produtos/salvar_edicao'>
                <div class="panel-body no-padding-right no-padding-left">
                    <fieldset>
                        <div class='col-lg-4 no-padding'>
                            <div class='col-lg-12'>
                                <label>Status</label>
                                <select class='form-control selectpicker' name='status'>
                                    <option value='0'>Inativo</option>
                                    <option value='1' selected>Átivo</option>
                                </select>
                            </div>
                            <div class='col-lg-12 margin-top-default'>
                                <label>Categorias</label>
                                <select class='form-control selectpicker' name='categoria'>
                                    <option value=''>Selecione</option>
                                </select>
                            </div>
                        </div>

                        <div class='col-lg-4 no-padding'>
                            <div class='col-lg-12'>
                                <label>Código</label>
                                <input class='form-control' type='text' name='codigo' placeholder='Digite o código' value="<?php echo $codigo; ?>" />
                            </div>
                            <div class='col-lg-12 margin-top-default'>
                                <label>Sub Categoria</label>
                                <select class='form-control selectpicker' name='subcategoria' disabled>
                                    <option value=''>Selecione...</option>
                                </select>
                            </div>
                        </div>

                        <div class='col-lg-4 no-padding'>
                            <div class='col-lg-12'>
                                <label>Nome</label>
                                <input class='form-control' type='text' name='nome' placeholder='Digite o nome do produto' value="<?php echo $nome; ?>"  />
                            </div>
                            <div class='col-lg-6 margin-top-default'>
                                <label>Referência</label>
                                <input class='form-control' type='text' name='referencia' placeholder='Digite a referência' value="<?php echo $referencia; ?>" />
                            </div>                              
                            <div class='col-lg-6 margin-top-default'>
                                <label>Valor</label>
                                <input class='form-control money' type='text' name='valor' placeholder='Digite o valor do produto' value="<?php echo $valor; ?>" />
                            </div>                            
                        </div>

                        <div class='col-lg-3 margin-top-default'>
                            <label>Und. de medida</label>
                            <select class='form-control selectpicker' name='unidadeMedida'>
                                <option value=''>Selecione</option>
                            </select>
                        </div>

                        <div class='col-lg-3 margin-top-default'>
                            <label>Peso (g.)</label>
                            <input class='form-control' type='text' name='peso' placeholder='Digite o peso' value="<?php echo $peso; ?>" />
                        </div>  

                        <div class='col-lg-6 no-padding'>
                            <div class='col-lg-4 margin-top-default'>
                                <label>Largura (cm)</label>
                                <input class='form-control money' type='text' name='largura' placeholder='' value="<?php echo $largura; ?>" />
                            </div> 
                            <div class='col-lg-4 margin-top-default'>
                                <label>Altura (cm)</label>
                                <input class='form-control money' type='text' name='altura' placeholder='' value="<?php echo $altura; ?>" />
                            </div>
                            <div class='col-lg-4 margin-top-default'>
                                <label>Prof. (cm)</label>
                                <input class='form-control money' type='text' name='profundidade' placeholder='' value="<?php echo $profundidade; ?>" />
                            </div>
                        </div>

                        <div class='col-lg-6 no-padding'>
                            <div class='col-lg-12 margin-top-default'>
                                <label>Código de barras</label>
                                <input class='form-control' type='text' name='codigoBarras' placeholder='Digite o código de barras do produto' value="<?php echo $codBarras; ?>" />
                            </div> 
                        </div> 

                        <div class='col-lg-6 no-padding '>
                            <div class='col-lg-12 margin-top-default'>
                                <label>Selecione as imagens</label>
                                <input type='file' name='images[]' multiple />
                            </div> 
                        </div> 

                        <div class='divider-bottom'></div>

                        <?php 
                            if( isset( $tags ) && count( $tags ) > 0 ) {

                                $i  = 0;

                                foreach ($tags as $key ) {
                        ?>
                                    <div class='col-lg-12 content-tipos no-padding'>
                                        <div class='col-lg-3 margin-top-default'>
                                            <label>Tipo</label>
                                            <select class='form-control selectpicker' name='tipo0'>
                                                <?php

                                                    foreach ( $lista as $kkey ) {

                                                        $selected   =   $key['idlista'] == $kkey['value'] ? 'selected' : '';

                                                        echo "<option value='" . $kkey['value'] . "' " . $selected . " />" . $kkey['text'] . "</option>";

                                                    }

                                                ?>
                                            </select>
                                        </div>
                                        <div class='col-lg-3 margin-top-default'>
                                            <label>Título</label>
                                            <input type='text' class='form-control titulo-tipo' name='titulo0' placeholder='Ex: tamanhos' data-name-input='tipo0' value="<?php echo $key['titulo']; ?>" />
                                            <div class='relative hidden'>
                                                <div class='result-search-select'>
                                                    <ul class="list-group"></ul>                                      
                                                </div>
                                            </div>
                                            <input class="hTitulo" type="hidden" name="hTitulo<?php echo $i; ?>" value="<?php echo $key['idtitulo']; ?>">
                                        </div>
                                        <div class='col-lg-5 margin-top-default'>
                                            <label>Tags</label>
                                            <div class='form-control input-mask-div'>
                                                <div class="tag-option-selected">
                                                    <?php
                                                        foreach ($key['tagss'] as $kkeey ) {
                                                            echo "<a class='link-tag-selected' href='#' id-delete-tag='" . $kkeey['id'] . "' />" . $kkeey['name'] . "<span class='badge remover-tag'>x</span></a>";
                                                        }
                                                    ?>
                                                </div>
                                                <input type='text' class='input-reseted tag-tipo' name='tags0' placeholder='Ex: P, M, G, GG' />
                                            </div>                                
                                            <div class='relative hidden'>
                                                <div class='result-search-select'>
                                                    <ul class="list-group"></ul>                                      
                                                </div>
                                            </div>
                                            <?php

                                                $j  =  0;

                                                foreach ($key['tagss'] as $kkeey ) {                                                    
                                                    echo "<input class='hTag' name='hTag" . $j . "' type='hidden' value='" . $kkeey['id'] . "' />";
                                                    $j++;
                                                }

                                            ?>                                            
                                        </div>
                                        <div class='col-lg-1 margin-top-default'>
                                            <button class='btn btn-danger fa fa-trash-o btn-delete-tipos fa-2x' type='button'></button>
                                        </div>
                                    </div>
                        <?php 
                                    
                                    $i++;

                                }

                                $qtdTags   =    count( $key['tagss'] );

                            }else {
                        ?>
                            <div class='col-lg-12 content-tipos no-padding'>
                                <div class='col-lg-3 margin-top-default'>
                                    <label>Tipo</label>
                                    <select class='form-control selectpicker' name='tipo0'>
                                        <?php
                                            foreach ( $lista as $key ) {

                                                echo "<option value='" . $key['value'] . "' />" . $key['text'] . "</option>";

                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class='col-lg-3 margin-top-default'>
                                    <label>Título</label>
                                    <input type='text' class='form-control titulo-tipo' name='titulo0' placeholder='Ex: tamanhos' data-name-input='tipo0' />
                                    <div class='relative hidden'>
                                        <div class='result-search-select'>
                                            <ul class="list-group"></ul>                                      
                                        </div>
                                    </div>
                                </div>
                                <div class='col-lg-5 margin-top-default'>
                                    <label>Tags</label>
                                    <div class='form-control input-mask-div'>
                                        <div class="tag-option-selected"></div>
                                        <input type='text' class='input-reseted tag-tipo' name='tags0' placeholder='Ex: P, M, G, GG' />
                                    </div>                                
                                    <div class='relative hidden'>
                                        <div class='result-search-select'>
                                            <ul class="list-group"></ul>                                      
                                        </div>
                                    </div>                                
                                </div>
                                <div class='col-lg-1 margin-top-default'>
                                    <button class='btn btn-danger fa fa-trash-o btn-delete-tipos fa-2x' type='button'></button>
                                </div>
                            </div>
                        <?php
                            } 
                        ?>

                        <div class='col-lg-12 no-padding'>
                            <div class='col-lg-12 margin-top-default'>
                                <button class='btn btn-primary fa fa-2x btn-add-tipo fa-plus' type='button'></button>
                            </div>
                        </div>

                        <div class='divider-bottom'></div>

                        <div class='col-lg-12'>
                            <label>Descrição</label>
                            <textarea class='form-control' placeholder='Digite a descrição do produto' name='descricao' rows="7"><?php echo $descricao; ?></textarea>
                        </div>
                        
                        <div class='divider-bottom'></div>

                        <div class='col-lg-12'>
                            <label>Descrição mais completa</label>
                            <textarea class='form-control editor' name='editor1' placeholder='Digite a descrição do produto' rows="7"><?php echo $descCompleta; ?></textarea>                            
                        </div>
                    </fieldset>
                </div>
                <div class="panel-footer">
                    <button class='btn btn-success'>Cadastrar</button>
                    <button class='btn btn-danger' data-dismiss="modal">Cancelar</button>
                </div>
                <input type='hidden' value="<?php echo $qtdTags; ?>" id='qtdHTags' name='qtdHTags' />
                <input type='hidden' name='idProduto' value="<?php echo $id; ?>" />
            </form>
        </div>
    </div>
</div>
<script type='text/javascript'>

    var status        =  "<?php echo $status; ?>";

    var cat           =  "<?php echo $categoria; ?>";

    var subCat        =  "<?php echo $subCategoria; ?>";

    var undMed        =  "<?php echo $undMedida; ?>";

    var baseUrl       =  '{url}';

    var baseUrlAjax   =  '{url}admin/ajax/';

    var page          =  'editar-produtos';

    CKEDITOR.replace( 'editor1', {
        language: 'pt-br',
        uiColor: '#cdcdcd',
        filebrowserBrowseUrl: baseUrlAjax + 'upload/view',
        filebrowserUploadUrl: baseUrlAjax + 'upload/send'
    });

</script>