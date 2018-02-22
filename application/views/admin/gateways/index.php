<?php

    $addFrete     =  '0,00';

    $freteGratis  =  '0,00';

    $parcelas     =  '0';

    $cep          =  '00000-000';

    if( count( $confs ) > 0 ) {

        foreach ($confs as $key => $value ) {
                
            if( $value['id'] == 1 )  
                $addFrete     =  $value['addFrete'];
            else if( $value['id'] == 2 )    
                $freteGratis  =  $value['freteGratis'];
            else if( $value['id'] == 3 )  
                $parcelas     =  $value['parcelas'];
            else if( $value['id'] == 4 )  
                $cep          =  $value['cep'];
        }

    }

?>
<div id="page-wrapper">

    <div class="row">

    <div class="col-lg-12">
        <div class="tabs-container">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#tab-1"> Pagseguro</a></li>
            </ul>
            <div class="tab-content">
                <div id="tab-1" class="tab-pane active">
                    <div class="panel-body">

                        <div class"row">

                            <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        Conexão API
                                    </div>
                                    <form class='form-config' method='POST' action='{url}admin/ajax/config/apiPagseguro'>
                                        <div class="panel-body no-padding-right no-padding-left">
                                            <fieldset>
                                                <div class='col-lg-10'>
                                                    <label>Usuario</label>
                                                    <div class='input-group'>
                                                        <input type='text' name='usuario_api' required class='form-control' value="<?php echo $usuarioApiPagseguro;  ?>" />
                                                    </div>
                                                </div>
                                                <div class='col-lg-10'>
                                                    <label>Token</label>
                                                    <div class='input-group'>
                                                        <input type='text' name='token_api' required class='form-control' value="<?php echo $tokenApiPagseguro; ?>" />
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </div>
                                        <div class="panel-footer">
                                            <button class='btn btn-success'>Salvar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>   
                            

                        </div>
                        
                    </div>
                </div>
                <div id="tab-2" class="tab-pane">
                    <div class="panel-body">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>


      
</div>
<script type='text/javascript'>

    var baseUrl       =  '{url}';

    var baseUrlAjax   =  '{url}admin/ajax/';

    var page          =  'cadastrar-configuracoes';

</script>