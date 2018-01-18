<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title class="titulo"> Grupo Basso </title>
	
	{css}

    <style>
        .navbar-nav {
            margin-top: 0;
        }
        
        .cd-dropdown-content {
            display: inline-block;
        }
        
        .cd-dropdown {
            position: absolute;
            margin-top: 12px;
        }

        body,
        .table tbody tr td {
            font-size: 12px;
        }
    </style>

    {js}

</head><!--/head-->


<body class="homepage">
    <?php if( isset( $inc ) ) echo $inc ?>

    <header id="header">
        <div class="container">
            <div class="row height-fix">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                    <div class="logo">
                        <a href='{url}'>
                            <img alt="" width="100px" height="100px" style="margin: 0 auto" src="{url}assets/images/logo.png">
                        </a>
                    </div>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9" style="z-index: 1;">
                    <div class="header-search">
                        <div class="search col-lg-8 col-md-8 col-sm-8 col-xs-8">
                            <div class="col-lg-5 col-md-5 col-sm-4 col-xs-12">
                                <select class="selectpicker index-big btn-search-reset">
                                    <option>Todas as categorias</option>
                                    {catss}
                                        <option value='{value}'>{name}</option>
                                    {/catss}
                                </select>
                            </div>

                            <div class="col-lg-7 col-md-7 col-sm-8 col-xs-12 margin-min">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" class="form-control border-right-reset pesquisar-data" value='{pesq}' placeholder="Procurar...">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default border-left-reset btn-search-reset" type="button">
                                                <span class="glyphicon glyphicon-search"></span>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="search col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            <a href='{url}compras/carrinho'>
                                <div class="padding-padrao background-blue carrinho pull-left">
                                    <i class="fa fa-shopping-cart fa-lg"></i>
                                </div>
                            </a>
                            <div class="pull-left margin-left">
                                <a href='{url}compras/carrinho'>Meu Carrinho</a> <br>
                                <a href='{url}compras/carrinho'><span class='data-carrinho'>0 itens: R$ 0,00</span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class='col-lg-3 col-md-3 col-sm-3 col-xs-3 no-padding'>
                    <div class="cd-dropdown-wrapper">
                        <a class="cd-dropdown-trigger categorias-menu" href="{url}pesquisar/resultado/Todas as categorias/">CATEGORIAS</a>
                        <nav class="cd-dropdown" style='width: 100%'>
                            <h2>Title</h2>
                            <a href="#0" class="cd-close">Close</a>
                            <ul class="cd-dropdown-content">
                                <?php
                                    if( count( $categorias ) > 0 ) {
                                        foreach ( $categorias as $key ) {
                                            $class  =  count( $key['subcat'] ) > 0  ? 'has-children' : '';
                                ?>
                                            <li class="<?php echo $class; ?> sidemenu">
                                                <a href="{url}pesquisar/resultado/<?php echo $key['text']; ?>"><?php echo $key['text']; ?></a>
                                                <?php
                                                    if( count( $key['subcat'] ) > 0 ) {
                                                ?>
                                                        <ul class="cd-secondary-dropdown is-hidden">
                                                            <li class="go-back"><a href="#0">Menu</a></li>
                                                            <li class="see-all"><a href="<?php echo $url . 'pesquisar/resultado/' . $key['text']; ?>">Mostrar tudo para a categoria <?php echo $key['text']; ?></a></li>
                                                            <?php 
                                                                if( count( $key['subcat'] ) > 0 ) {
                                                                    foreach ($key['subcat'] as $innerKey ) {
                                                            ?>
                                                                        <li class="has-children">
                                                                            <a href="#"><?php echo $innerKey[ 'nome' ]; ?></a>
                                                                            <ul class="is-hidden">
                                                                                <li class="go-back"><a href="#0">Clothing</a></li>
                                                                                <!--<li class="see-all"><a href="<?php echo $url . 'pesquisar/resultado/Todas as categorias/' . $key['text']; ?>">All Accessories</a></li>-->
                                                                                <?php
                                                                                    foreach ($innerKey[ 'tags' ] as $tags) {
                                                                                        echo "<li><a href='" . $url . "pesquisar/resultado/" . $key['text'] . "/" . $tags['nome'] . "'>" . $tags['nome'] . "</a></li>";

                                                                                    }
                                                                                ?>
                                                                            </ul>
                                                                        </li>
                                                            <?php
                                                                    }
                                                                }
                                                            ?>
                                                        </ul>
                                                <?php
                                                    }
                                                ?>
                                            </li>
                                <?php

                                        }

                                    }

                                ?>
                            </ul> 
                        </nav> 
                    </div> 
                </div>
                <div class='col-lg-9 col-md-9 col-sm-8 col-xs-9 no-padding'>
                    <div class="hovermenu ttmenu dark-style menu-red-gradient">
                        <div role="navigation" class="navbar navbar-default">
                            <div class="navbar-header">
                                <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>
                            <div class="navbar-collapse collapse">
                                <ul class="nav navbar-nav">
                                    <?php
                                        if( isset( $menus ) && count( $menus ) > 0 ) {
                                            foreach ($menus as $key ) {
                                    ?>
                                                <li class="dropdown ttmenu-full no-padding-bottom no-margin-left">
                                                    <a class="no-border" href="{url}<?php echo $key['link']; ?>">
                                                        <?php echo $key['name']; ?>
                                                        <?php if( count( $key['subMenus'] ) > 0) { ?><b class="dropme"></b><?php } ?>
                                                    </a>
                                                    <?php
                                                        if( count( $key['subMenus'] ) > 0 ) {
                                                            echo '<ul class="dropdown-menu" style="border-right: 1px solid #CDCDCD; border-left: 1px solid #CDCDCD; border-bottom: 1px solid #CDCDCD;"><li style="background-color: #FFF"><div class="col-lg-12" style="background-color: #FFF">';
                                                            foreach ($key['subMenus'] as $kkey ) {
                                                    ?>
                                                                <div class='col-lg-6'>
                                                                    <a class='no-border' style='width: 100%; float: left; padding: 20px; font-size: 1.4em; color: #0c4ea6;' href="<?php echo $kkey['link']; ?>"><?php echo $kkey['name']; ?></a>
                                                                    <?php
                                                                        foreach ( $kkey['item'] as $kkeyy ) {
                                                                            echo '<a style="float: left; width: 100%; padding: 10px;" class="no-border linkitens" href="{url}' . $kkeyy['link'] . '">' . $kkeyy['name'] . '</a>';
                                                                        }
                                                                    ?>                                                                
                                                                </div>
                                                    <?php
                                                            }
                                                            echo '</div></li></ul>';
                                                        }
                                                    ?>
                                                </li>
                                    <?php
                                            }
                                        }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>            
                </div>                
            </div>
        </div>		
    </header> <!--/header-->





































