<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title class="titulo"> VTenis - Área do usuário </title>
	
	{css}
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
                        <div class="search col-lg-8 col-md-8 col-sm-8 col-xs-12">
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
                                        <input type="text" class="form-control border-right-reset pesquisar-data" placeholder="Procurar...">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default border-left-reset btn-search-reset" type="button">
                                                <span class="glyphicon glyphicon-search"></span>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="search col-lg-4 col-md-4 col-sm-4 col-xs-12">
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
                <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding'>
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
                                        if( !isset( $page ) ) {

                                            $page  =  '';

                                        }

                                        if( $page != 'login' ) {
                                    ?>
                                            <li class="dropdown ttmenu-full no-padding-bottom no-margin-left">
                                                <a href="{url}minha/conta/inicio">
                                                    Inicio
                                                </a>
                                            </li>
                                            <li class="dropdown ttmenu-full no-padding-bottom no-margin-left">
                                                <a href="{url}minha/conta/compras">
                                                    Compras
                                                </a>                                        
                                            </li>
                                            <li class="dropdown ttmenu-full no-padding-bottom no-margin-left">
                                                <a href="{url}minha/conta/meusdados">
                                                    Meus dados
                                                </a>                                        
                                            </li>
                                            <li class="dropdown ttmenu-full no-padding-bottom no-margin-left">
                                                <a href="{url}minha/conta/meusenderecos">
                                                    Meus endereços
                                                </a>                                        
                                            </li>
                                            <li class="dropdown ttmenu-full no-padding-bottom no-margin-left">
                                                <a href="{url}minha/conta/sair">
                                                    Sair
                                                </a>                                        
                                            </li> 
                                    <?php
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





































