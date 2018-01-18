<?php 
    //print_r( $categorias ); exit;
    function countProdutosInCat( $produtos = array(), $categoria ) {

        $cat  =   0;

        if( count( $produtos ) > 0 ) {
            foreach ( $produtos as $key => $value ) {
                if( $value['cat'] == $categoria ) {
                    $cat++;
                    unset( $produtos[$key] );
                }
            }
        }
        return $cat;
    }
?>

<div class="container margin-top no-padding">
    <div class='col-lg-3 no-padding'>
        <h2 class='no-margin'>Categorias</h2>
        <ul class="list-group margin-top-15">           
            <?php
                $prod  =  $produtos;
                if( count( $categorias ) > 0 ) {
                    foreach ($categorias as $key ) {
                        $cat  = $key['value'];
            ?>
                        <li class="list-group-item">
                            <span class="badge"><?php echo countProdutosInCat( $prod, $cat ); ?></span>
                            <a href="<?php echo $url . mb_strtolower( $key['nome'], 'UTF-8') . '/' . $cat; ?>"><?php echo $key['nome']; ?></a>
                        </li>
            <?php
                    }
                } 
            ?>
        </ul>
    </div>
    <ol class="breadcrumb">
        <li><a href="{url}">&nbsp;&nbsp;&nbsp;&nbsp;Home</a></li>
        <?php 
            $i  = 0;
            foreach($broadcrumb as $key => $value) {

                if( $i == ( count( $broadcrumb ) - 1 ) ) {
                    $tag  =   "<li class='active'>" . $value['name'] . "</li>";
                }else {
                    $tag  =   "<li><a href='" . $value['link'] . "'>". $value['name'] . "</a></li>";

                }

                echo $tag;

                $i++;

            }
        ?>
    </ol>      
    <?php if( count( $produtos ) > 0 ) { ?>     
        <div class="col-lg-9 no-padding no-padding">     
            <?php
                foreach ($produtos as $key ) {
            ?>
                    <div class="col-lg-2">
                        <div class="row padding-bottom-reset  min-margin-right-reset relative">
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
    <?php } ?>
</div>


<script type="text/javascript">
    var page = 'resultados_busca';
</script>

    

    