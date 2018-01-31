<?php
    $number  =   array( 'one', 'two', 'three' );
?>
<div class="container margin-top">
    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 padding-left-reset slide-content-viewer">
        <div class="row row-banner">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 "></div>
            <div class="container-carousel col-lg-8 col-md-8 col-sm-8 col-xs-8">
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                    <?php
                        if( count( $banner1 ) > 0 ){
                            $i  = 0;
                            echo '<ol class="carousel-indicators">';                            
                            foreach ( $banner1 as $key ) {
                                $class  =  $i == 0 ? 'active' : '';
                    ?>                
                                <li data-target="#carousel-example-generic" data-slide-to="<?php echo $i; ?>" class="<?php echo $class; ?>"> </li>
                    <?php
                                $i++;
                            }

                            echo "</ol>";
                    ?>
                            <div class="carousel-inner" role="listbox">
                    <?php
                            $i  =  0;
                            foreach ( $banner1 as $key ) {
                                $classe  =  $i == 0 ? 'active' : '';
                    ?>
                                <div class="item <?php echo $classe; ?>">
                                    <img src="<?php echo $url . $key['imagem']; ?>" alt="...">
                                    <div class="carousel-caption"></div>
                                </div>
                    <?php
                                $i++;
                            }
                        }
                    ?>
                    </div>
                    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="row margin-top margin-right-reset margin-left-reset "> 
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 padding-left-reset side-blocks banners-custom1">
                <div class="background-blue pull-left width banners-custom1 img-all-size">
                    <?php if( count( $banner2 ) > 0 ){ ?>
                        <img src="<?php echo $banner2[0]['imagem']; ?>" class='border-cinza' />
                    <?php } ?>
                </div>   
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 no-padding side-blocks banners-custom1">
                <div class="background-green pull-left width banners-custom1 img-all-size">
                    <?php if( count( $banner3 ) > 0 ){ ?>
                        <img src="<?php echo $banner3[0]['imagem']; ?>" class='border-cinza'  />
                    <?php } ?> 
                </div>   
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 padding-right-reset banners-custom1 side-blocks">
                <div class="background-orange pull-left width banners-custom1 img-all-size">
                    <?php if( count( $banner4 ) > 0 ){ ?>
                        <img src="<?php echo $banner4[0]['imagem']; ?>" class='border-cinza'  />
                    <?php } ?> 
                </div>   
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-5 col-xs-3 no-padding content-produtos-viewer"> 
        <div class="produtos pull-left">
            <span class="font-poppins-bold border-right-regular padding-padrao font-big titulo-produtos pull-left"> PRODUTOS </span>
            <span class="padding-padrao  pull-right slick-arrows relative">  </span>  
        </div>
        <div class="slick-slider width clear">
            <?php
                //############# START DESTAQUES ##############

                $i  = 0;

                foreach ($dest as $key ) {

                    $class  =  $i % 2 === 0 ? 'slick-fisrt' : 'slick-second';

            ?>
                    <div class="<?php echo $class; ?> slick-border">
                        <div class="row padding-padrao min-margin-right-reset">
                            <div class="col-lg-6 col-md-6 padding-right-reset slick-product-image">
                                <a href="<?php echo $key['link']; ?>">
                                    <img src="<?php echo $key['image']; ?>" class="img-responsive" />
                                </a>
                            </div>
                            <div class="col-lg-6 col-md-6 no-padding text-produto">
                                <p class="font-poppins padding-padrao align-left">
                                    <a href="<?php echo $key['link']; ?>"> <?php echo $key['nome']; ?> </a>
                                </p>
                                <p class="font-poppins-bold color-price padding-padrao align-left"> <?php echo 'R$ ' . $key['valor']; ?></p>
                            </div>
                        </div>
                    </div>
            <?php
                    $i++;

                }
            ?>

        </div>


    </div>

    <?php if( count( $ofertas ) > 0 ) { ?>
        <div class="col-lg-12 no-padding margin-top">

                <div class="row margin-left-reset margin-right-reset">
                    <div class="produtos-oferta pull-left">

                        <span class="font-poppins-bold border-right-regular padding-padrao font-big titulo-produtos-oferta pull-left"> OFERTA DO DIA </span>

                        <span class="padding-padrao slick-arrows-oferta pull-right relative">  </span>  

                    </div> 
                </div>

                <div class="slick-slider-oferta width clear border-reset no-relative">
                    <?php 
                        foreach ($ofertas as $key ) {
                    ?>
                    <div class="slick-first col-lg-6 col-md-12 padding-padrao min-media-no-padding">

                        <div class="row padding-top-bottom no-margin border-regular">
                            <div class="col-lg-5 col-md-6 no-padding">
                                <div class="col-lg-12 col-md-12 slick-product-image-oferta">
                                    <a href="<?php echo $key['link']; ?>"><img src="<?php echo $key['image']; ?>" class="img-responsive" /></a>
                                </div>
                            </div> 
                            <div class="col-lg-7 col-md-6 padding-left-reset height all-detalhes-oferta">
                                <div class="col-lg-12 col-md-12 no-padding text-produto-oferta">
                                    <div class="slick-container-texto-oferta">
                                        <p class="font-poppins align-left no-margin slick-titulo-oferta"><a href="<?php echo $key['link']; ?>"><?php echo $key['nome']; ?></a></p>
                                        <p class="font-poppins-bold-oferta color-price slick-preco-oferta align-left no-margin"> 
                                            <?php echo $key['valor']; ?> 
                                            <span class="preco-antigo-oferta font-poppins color-black"> 
                                                <?php echo $key['moreValor']; ?> 
                                            </span>
                                        </p>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12 no-padding margin-top">
                                    <p class="font-poppins color-black desc-oferta"> <?php echo $key['desc']; ?></p>
                                </div>
                            </div>   
                        </div>
                    </div>
                    <?php
                        }
                    ?>
                </div>
        </div>
    <?php } ?>

    <?php if( count( $maisVendidos ) > 0 ) { ?>
        <div class="col-lg-12 no-padding margin-top mais-vendidos">
            <div class="produtos-relativos pull-left">
                <span class="font-poppins-bold border-right-regular padding-padrao font-big titulo-produtos-relativos pull-left"> 
                    <div class="pull-left"> MAIS VENDIDOS </div> 
                    <div class="pull-right">
                        <?php 
                            $categorias  =   $maisVendidos['categorias'];
                            $i  = 0;
                            foreach ($categorias as $key ) {
                                $class  =  $i == 0 ? 'categoria-active' : '';
                        ?>
                                <span class="categoria-<?php echo $number[$i]; ?> font-poppins pointer <?php echo $class; ?>"> <?php echo $key['name']; ?></span> 
                        <?php
                                $i++;
                            }
                        ?>
                    </div>
                </span>
                <span class="padding-padrao slick-arrows-mais-vendidos pull-right relative">  </span>  
            </div>
            <?php
                $i  = 0;
                foreach ($categorias as $key ) {

                    $class  =  $i == 0 ? 'slick-active-mais-vendido' : '';

                    $style  =  $i > 0 ? 'display-none' : '';
            ?>
                    <div class="slick-slider-mais-vendidos-<?php echo $number[$i]; ?> width clear border-reset <?php echo $style; ?> <?php echo $class; ?>">
                        <?php
                            $produtos  =  $maisVendidos['produtos'][$key['id']];
                            foreach ($produtos as $key ) {
                        ?>
                                <div class="slick-first-mais-vendido">
                                    <div class="row padding-padrao padding-bottom-reset  min-margin-right-reset relative">
                                        <div class="col-lg-12 col-md-12 slick-product-image-relativos">
                                            <a href="<?php echo $key['link']; ?>"><img src="<?php echo $key['image']; ?>" class="img-responsive" /></a>
                                        </div>
                                        <div class="col-lg-12 col-md-12 text-produto-relativos">
                                            <div class="slick-container-texto-relativos">
                                                <p class="font-poppins align-center no-margin slick-titulo"><a href="<?php echo $key['link']; ?>"> <?php echo $key['nome']; ?> </a></p>

                                                <p class="font-poppins-bold-relativos color-price slick-preco align-center no-margin"> <?php echo $key['valor']; ?> </p>
                                            </div>
                                        </div>
                                    </div>                    
                                </div>
                        <?php
                            }
                        ?>
                    </div>
            <?php
                    $i++;
                }
            ?>
        </div>
    <?php } ?>

    <div class="col-lg-12 no-padding margin-top">
        <div class="col-lg-4 col-md-4 padding-left-reset container-left-sale img-all-size banners-custom2">
            <?php if( count( $banner5 ) > 0 ){ ?>
                <img src="<?php echo $banner5[0]['imagem']; ?>" />
            <?php } ?> 
        </div>
        <div class="col-lg-8 col-md-8 padding-right-reset container-right-sale img-all-size banners-custom2">
            <?php if( count( $banner6 ) > 0 ){ ?>
                <img src="<?php echo $banner6[0]['imagem']; ?>" />
            <?php } ?> 
        </div>
    </div>

    <?php if( count( $novosProdutos ) > 0 ) { ?>
        <div class="col-lg-12 no-padding margin-top novos-produtos">
            <div class="produtos-relativos pull-left">
                <span class="font-poppins-bold border-right-regular padding-padrao font-big titulo-produtos-relativos pull-left"> 
                    <div class="pull-left"> NOVOS PRODUTOS </div> 
                    <div class="pull-right"> 
                        <?php 
                            $categorias  =   $novosProdutos['categorias'];
                            $i  = 0;
                            foreach ($categorias as $key ) {
                                $class  =  $i == 0 ? 'categoria-novos-active' : '';
                        ?>
                                <span class="categoria-novos-<?php echo $number[$i]; ?> font-poppins pointer <?php echo $class; ?>"> <?php echo $key['name']; ?></span> 
                        <?php
                                $i++;
                            }
                        ?>
                    </div>
                </span>
                <span class="padding-padrao slick-arrows-novos pull-right relative">  </span>  
            </div>
            <?php
                $i  = 0;
                foreach ( $categorias as $key ) {
                    $class  =  $i == 0 ? 'slick-novos-active' : '';

                    $style  =  $i > 0 ? 'display-none' : '';
            ?>
                    <div class="slick-slider-novos-<?php echo $number[$i]; ?> width clear border-reset <?php echo $class; ?> <?php echo $style; ?>">
                        <?php
                            $produtos  =  $novosProdutos['produtos'][$key['id']];
                            foreach ($produtos as $key ) {
                        ?>              
                                <div class="slick-first-mais-vendido">
                                    <div class="row padding-padrao padding-bottom-reset  min-margin-right-reset relative">
                                        <div class="col-lg-12 col-md-12 slick-product-image-relativos">
                                            <a href="<?php echo $key['link']; ?>"><img src="<?php echo $key['image']; ?>" class="img-responsive" /></a>
                                        </div>
                                        <div class="col-lg-12 col-md-12 text-produto-relativos">
                                            <div class="slick-container-texto-relativos">
                                                <p class="font-poppins align-center no-margin slick-titulo"><a href="{url}produtos"> <?php echo $key['nome']; ?> </a></p>
                                                <p class="font-poppins-bold-relativos color-price slick-preco align-center no-margin"> <?php echo $key['valor']; ?> </p>
                                            </div>
                                        </div>
                                    </div>                
                                </div> 
                        <?php
                            }
                        ?>             
                    </div>
            <?php
                    $i++;
                }
            ?>          
        </div>
    <?php } ?>

    <?php if( count( $novosProdutos ) > 0 ) { ?>
        <div class="col-lg-12 no-padding margin-top mais-vistos">
            <div class="produtos-relativos pull-left">
                <span class="font-poppins-bold border-right-regular padding-padrao font-big titulo-produtos-relativos pull-left"> 
                    <div class="pull-left"> MAIS VISTOS </div> 
                </span>
                <span class="padding-padrao slick-arrows-vistos pull-right relative">  </span>  
            </div>
            <div class="col-lg-3 col-sm-3 container-vistos-img">
                <div class="vistos-img img-all-size banners-custom3">    
                    <?php if( count( $banner7 ) > 0 ){ ?>
                        <img src="<?php echo $banner7[0]['imagem']; ?>" />
                    <?php } ?> 
                </div>
            </div>
            <div class="slick-slider-vistos border-reset col-lg-9 col-sm-9">
                <?php
                    $i  =  1;
                    foreach ($maisProcurados as $key ) {
                        if( $i == 1 ) {
                ?>
                            <div class="slick-first-mais-vistos slick-vistos">
                                <div class="row row-vistos padding-padrao padding-bottom-reset  min-margin-right-reset relative">
                                    <div class="col-lg-6 col-md-7 padding-right-reset slick-vistos-product-image">
                                        <a href="<?php echo $key['link']; ?>"><img src="<?php echo $key['image']; ?>" class="img-responsive" /></a>
                                    </div>
                                    <div class="col-lg-6 col-md-5 no-padding text-vistos-produto">
                                        <p class="font-poppins padding-padrao align-left"><a href="<?php echo $key['link']; ?>"> <?php echo $key['nome']; ?> </a></p>

                                        <p class="font-poppins-bold color-price padding-padrao align-left"> <?php echo $key['valor']; ?> </p>
                                    </div>
                                </div>
                <?php 
                        }else if( $i == 2 ) {
                ?>
                                <div class="row row-vistos padding-padrao padding-bottom-reset  min-margin-right-reset relative">
                                    <div class="col-lg-6 col-md-7 padding-right-reset slick-vistos-product-image">
                                        <a href="<?php echo $key['link']; ?>"><img src="<?php echo $key['image']; ?>" class="img-responsive" /></a>
                                    </div>
                                    <div class="col-lg-6 col-md-5 no-padding text-vistos-produto">
                                        <p class="font-poppins padding-padrao align-left"><a href="<?php echo $key['link']; ?>"> <?php echo $key['nome']; ?> </a></p>

                                        <p class="font-poppins-bold color-price padding-padrao align-left"> <?php echo $key['valor']; ?> </p>
                                    </div>
                                </div>

                <?php
                        }else if( $i == 3 ) {
                ?>
                                <div class="row row-vistos padding-padrao padding-bottom-reset  min-margin-right-reset relative">
                                    <div class="col-lg-6 col-md-7 padding-right-reset slick-vistos-product-image">
                                        <a href="<?php echo $key['link']; ?>"><img src="<?php echo $key['image']; ?>" class="img-responsive" /></a>
                                    </div>
                                    <div class="col-lg-6 col-md-5 no-padding text-vistos-produto">
                                        <p class="font-poppins padding-padrao align-left"><a href="<?php echo $key['link']; ?>"> <?php echo $key['nome']; ?> </a></p>

                                        <p class="font-poppins-bold color-price padding-padrao align-left"> <?php echo $key['valor']; ?> </p>
                                    </div>
                                </div>
                                
                            </div>
                <?php     
                            $i  = 0;

                        }

                        $i++;

                    } 
                ?>


                <?php
                    /*
                    $i  =  1;
                    foreach ($maisProcurados as $key ) {

                        if( $i == 1 || ( $i > 1 && $i % 3 == 0 ) ) {
                            echo '<div class="slick-first-mais-vistos slick-vistos">';
                        }
                ?>
                        <div class="row row-vistos padding-padrao padding-bottom-reset min-margin-right-reset relative">
                            <div class="col-lg-6 col-md-7 padding-right-reset slick-vistos-product-image">
                                <a href="<?php echo $key['link']; ?>"><img src="<?php echo $key['image']; ?>" class="img-responsive" /></a>
                            </div>
                            <div class="col-lg-6 col-md-5 no-padding text-vistos-produto">
                                <p class="font-poppins padding-padrao align-left"><a href="<?php echo $key['link']; ?>"> <?php echo $key['nome']; ?> </a></p>
                                <p class="font-poppins-bold color-price padding-padrao align-left"> <?php echo $key['valor']; ?> </p>
                            </div>
                        </div>
                <?php
                        if( ( $i > 1 && $i % 3 == 0 ) ) {
                            echo '</div>';
                        }

                        $i++;
                    }
                    */
                ?>
            </div>
        </div>
    <?php } ?>

</div>


<script type="text/javascript">
    var page = 'home';
    var baseUrl  =  '{url}';
</script>

<script>
    var sidemenu = $('.sidemenu');

    var maxSize = 503;

    var width = (window.innerWidth > 0) ? window.innerWidth : screen.width;

    if (width <= 1024) {
        maxSize = 400;
    }

    if (sidemenu.length > 5) {

        var setHeight = maxSize / sidemenu.length;

        $.each(sidemenu, function(index, menu) {
            $(menu).css('height', setHeight);
            $('.cd-dropdown-content a, .cd-dropdown-content ul a').css('height', setHeight);
            $('.cd-dropdown-content a, .cd-dropdown-content ul a').css('padding-top', 0);
        })
    }
</script>

    

    