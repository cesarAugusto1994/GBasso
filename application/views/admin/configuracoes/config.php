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
    <div class="col-lg-2 margin-top-20 z-index-0">
        <div class="panel panel-default">
            <div class="panel-heading">
                Valor adicional para frete
            </div>
            <form class='form-config' method='POST' action='{url}admin/ajax/config/valorAdicionalFrete'>
                <div class="panel-body no-padding-right no-padding-left">
                    <fieldset>
                        <div class='col-lg-12'>
                            <label>Valor</label>
                            <input type='text' name='valor' class='form-control money' value="<?php echo $addFrete; ?>" title='Valor a ser somado no valor do frete fornecedio pelo correios' />
                        </div>
                    </fieldset>
                </div>
                <div class="panel-footer">
                    <button class='btn btn-success'>Salvar</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-lg-2 margin-top-20 z-index-0">
        <div class="panel panel-default">
            <div class="panel-heading">
                Valor mínimo para frete grátis
            </div>
            <form class='form-config' method='POST' action='{url}admin/ajax/config/valorMinFrete'>
                <div class="panel-body no-padding-right no-padding-left">
                    <fieldset>
                        <div class='col-lg-12'>
                            <label>Valor</label>
                            <input type='text' name='valor' class='form-control money' value="<?php echo $freteGratis; ?>" title='A partir desse valor, frete será grátis. Valor 0,00, não terá frete grátis' />
                        </div>
                    </fieldset>
                </div>
                <div class="panel-footer">
                    <button class='btn btn-success'>Salvar</button>
                </div>
            </form>
        </div>
    </div>  
    <div class="col-lg-2 margin-top-20 z-index-0">
        <div class="panel panel-default">
            <div class="panel-heading">
                Número de parcelas sem juros
            </div>
            <form class='form-config' method='POST' action='{url}admin/ajax/config/numeroParcelasSemJuros'>
                <div class="panel-body no-padding-right no-padding-left">
                    <fieldset>
                        <div class='col-lg-12'>
                            <label>Valor</label>
                            <div class='input-group'>
                                <input type='text' name='valor' class='form-control parcelas' value="<?php echo $parcelasSemJuros; ?>" title='O número de parcelas sem juros, ex: 3x sem juros, 4, 5, 6, 7, 8, 9 ou 10' />
                                <span class="input-group-addon exemplo-parcela"><?php echo $parcelasSemJuros; ?>x sem juros</span>
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
    <div class="col-lg-2 margin-top-20 z-index-0">
        <div class="panel panel-default">
            <div class="panel-heading">
                Cep de origem
            </div>
            <form class='form-config' method='POST' action='{url}admin/ajax/config/cepOrigem'>
                <div class="panel-body no-padding-right no-padding-left">
                    <fieldset>
                        <div class='col-lg-12'>
                            <label>Cep</label>
                            <div class='input-group'>
                                <input type='text' name='cep' class='form-control cep' value="<?php echo $cepOrigem;  ?>" title='Digite o CEP na qual será usado como CEP de origem para enviar os produtos' />
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
<script type='text/javascript'>

    var baseUrl       =  '{url}';

    var baseUrlAjax   =  '{url}admin/ajax/';

    var page          =  'cadastrar-configuracoes';

</script>