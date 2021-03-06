<div class="container margin-top no-padding">
    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12' style='align: center;'>
        <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
            <ol class="breadcrumb" style='float: left; width: 100%;'>
                <li><a href="{url}">Inicio</a></li>
                <li class="active">Pesquisando: {pesquisa}</li>
            </ol>
            <br/>
            <br/>        
            <div style='float: left; width: 200px;'>
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <li class='{classPrevious}'>
                            <a href="{previousPage}" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <li>
                            <a href="{actual}">{offset}</a>
                        </li>
                        <li class='{classNext}'>
                            <a href="{nextPage}" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                    
                </nav>
                <p style='font-size: 13px'>Mostrando: {showing}  de {qtdmax}</p>
            </div>
        </div>
        {nodata}
        {data}
            <a href="{link}" tabindex="0" title='Visualizar o produto {name}'>
                <div class='col-lg-4 col-md-4 col-sm-4 col-xs-12 item-pesquisa'>
                    <div class="slick-fisrt slick-border" style="width: 100%; display: inline-block;">
                        <div class="row padding-padrao min-margin-right-reset">
                            <div class="col-lg-6 col-md-6 col-sm-4 col-xs-4 padding-right-reset slick-product-image">
                                <a href="{link}" tabindex="0" title='Visualizar o produto {name}'>
                                    <img style="min-width:165px;min-height:165px;max-width:165px;max-height:165px;" src="{imgprod_diretorio}" class="img-responsive">
                                </a>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-8 col-xs-8 no-padding text-produto">
                                <p class="font-poppins padding-padrao align-left">
                                    <a href="{link}" tabindex="0"> {name} </a>
                                </p>
                                <a href="{link}" tabindex="0">
                                    <p class="font-poppins-bold color-price padding-padrao align-left"> {valor}</p>
                                </a>

                                <div style="height: 80px;">
                                
                                    <div class="container-quantidade" style="margin-left:12px;width:60px;display:none;">
									    <input type="number" style="height:35px;" id="quantity-relacionados-{id}" class="form-control" value="1" min="1" max="999">
								    </div>

                                    <br/>
                                    <br/>

                                    <div class="container-add-carrinho" style="margin-left:12px;display:none;">
                                        <button class="btn btn-sm btn-success btn-carrinho-relacionados" title='Adicionar {name} ao carrinho' data-id="{id}" data-item="{id}"> Adicionar</button>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </a>
            <!--
            <div class='col-lg-4 col-md-4 col-sm-4 col-xs-12' style="border: 1px solid" style='padding-top: 20px;'>
                <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                    <a href='{link}' title='Visualizar o produto {name}'>
                        <div class='col-lg-12 col-md-12 col-sm-12'>
                            <img src='{imgprod_diretorio}' style='width: 100%; height: 200px' />
                        </div>
                        <div class='col-lg-12 col-md-12 col-sm-12'>
                            <p style='color: #23527c; font-size: 14px; padding: 10px'>{name}</p>
                        </div>
                    </a>
                    <div class='col-lg-12 col-md-12 col-sm-12' style='text-align: center;'>
                        <div class="container-quantidade" style='border: 0px;'>
                            <button class="btn btn-default btn-carrinho" title='Adicionar {name} ao carrinho' data-id="{id}"> Adicionar ao carrinho</button>
                        </div>
                    </div>
                </div>
            </div>
-->
        {/data}
    </div>
</div>

<script type="text/javascript">
    var page = 'resultbusca';
    var baseUrl  =  '{url}';
</script>