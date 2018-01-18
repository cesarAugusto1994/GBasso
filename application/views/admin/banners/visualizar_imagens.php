<div id="page-wrapper">
    <div class="col-lg-10 margin-top-20">
        <div class="panel panel-default">
            <div class="panel-heading">
                Gerenciar images de banners
            </div>
            <div class="panel-body no-padding-right no-padding-left">
                <?php
                    
                    $disabled  = '';

                    if( count( $imagens ) > 0 ) {

                        $i  =  0;

                        $disabled   =   $local == 1 ? "" : "disabled=''";

                        foreach ( $imagens as $key ) {
                ?>
                            <div class="col-lg-2 content-img-banners">
                <?php
                                if( $local == 1 ) {
                ?>
                                    <div class="col-lg-12 no-padding">
                                        <div class="input-group">
                                            <span class="input-group-addon">Ordem</span>
                                            <input type="text" class="form-control setOrdemBanner" id="<?php echo $key['value']; ?>" value="<?php echo $key['ordem']; ?>">
                                        </div>
                                    </div>
                <?php
                                }
                ?>
                                <div class="col-lg-12 no-padding checkbox">
                                    <label>
                                        <input type="checkbox" <?php echo $disabled; ?> class="imgDeleteBanner" id="<?php echo $key['value']; ?>">
                                        Deletar
                                    </label>
                                </div>
                                <div class="select-img-banner">
                                    <img src="<?php echo $url . $key['imagem']; ?>" class="img-selected">
                                </div>
                            </div>
                <?php

                            if( $i == 5 ) {

                                echo "<div class='divider-bottom'></div>";

                                $i  = -1;

                            }

                            $i++;

                        }

                    }

                ?>
            </div>
            <div class="panel-footer">
                <button class='btn btn-danger deletarImagemBanner' <?php echo $disabled; ?>>Deletar</button>
            </div>            
        </div>
    </div>
</div>
<script type='text/javascript'>

    var baseUrl       =  '{url}';

    var baseUrlAjax   =  '{url}admin/ajax/';

    var page          =  'banners-visualizar-imagens';

</script>