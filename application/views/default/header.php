<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title> Grupo Basso </title>

    {css}

    <link rel='stylesheet' type='text/css' href='http://www.grupobasso.com.br/assets/css/menu-new.css' /> 

    <link rel='stylesheet' type='text/css' href='http://www.grupobasso.com.br/assets/css/style.css' /> 

    <link rel='stylesheet' type='text/css' href='http://www.grupobasso.com.br/assets/css/pnotify.custom.min.css' /> 

    <link rel='stylesheet' type='text/css' href='https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.11.0/css/alertify.min.css' /> 
    
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

        .navbar .nav>li>a {
            color: black;
        }

        .navbar-default {
            height: 40px;
        }
      

    </style>

    {js}

    <script type='text/javascript' src='http://www.grupobasso.com.br/assets/js/jquery-form.js'></script>



</head><!--/head-->


<body class="homepage">
    <?php if( isset( $inc ) ) echo $inc ?>


<div class="container">

    <div class="row">

        <div class="col-lg-12">
            <nav class="topBar">
                <div class="container">
                    <ul class="list-inline pull-left">
                        <li><a href="/"><b>Grupo Basso</b></a></li>
                    </ul>
                    <ul class="topBarNav pull-right">
                        <li class="dropdown">
                        <?php if($logado): ?>

                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="false"> <i class="glyphicon glyphicon-user mr-5"></i><span>Minha Conta</span> </a>
                            <ul class="dropdown-menu w-150" role="menu">
                                <li><a href="/minha/conta/inicio">Painel</a></li>
                                <li><a href="/minha/conta/compras">Minhas Compras</a></li>
                                <li class="divider"></li>
                                <li><a href="/minha/conta/meusdados">Minhas Informções</a>
                                </li>
                                <li><a href="/minha/conta/meusenderecos">Meus Endereços</a>
                                </li>
                                <li class="divider"></li>
                                <li><a style="color: red" href="/minha/conta/sair">Sair</a>
                                </li>
                            </ul>
                           
                        <?php else: ?>

                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="false"> <i class="glyphicon glyphicon-user"></i><span>Minha Conta<i class="glyphicon glyphicon-down ml-5"></i></span> </a>
                            <ul id="login-dp" class="dropdown-menu">
                                <li>
                                    <div class="row">
                                            <div class="col-md-12">
                                                Login
                                                
                                                <form class="formLogin" method="post" action="http://www.grupobasso.com.br/ajax/minha/conta/logar">
                                                        <div class="form-group">
                                                            <label class="sr-only" for="user">E-mail</label>
                                                            <input type="email" class="form-control" name="user" id="user" placeholder="E-mail" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="sr-only" for="pass">Senha</label>
                                                            <input name="pass" type="password" class="form-control" id="pass" placeholder="Senha" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <button type="submit" class="btn btn-primary btn-block">Entrar</button>
                                                        </div>
                                                </form>
                                            </div>
                                            <div class="bottom text-center">
                                                <a href="http://www.grupobasso.com.br/minha/conta/cadastrar"><b>Cadastre-se</b></a>
                                            </div>
                                    </div>
                                </li>
                            </ul>

                        <?php endif; ?>
                        </li>
                        <li>
                        <a href="{url}compras/carrinho" 
                        data-close-others="false"> <i class="fa fa-shopping-basket mr-5"></i> <span class="">
                                <i class="fa fa-cart"></i>Carrinho<sup class="text-primary">(<span class='data-carrinho'>0 itens: R$ 0,00</span>)</sup>
                            </span></a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>

        <div class="col-lg-12" style="margin-top:60px;">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4 text-center">
                    <a href="/"> <img alt="" width="100px" height="100px" class="img img-rounded" style="margin: -10px auto 50px" src="{url}assets/images/logo.png"></a>
                </div>
                <!-- end col -->
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-8 text-center">
                        <div class="row grid-space-1">

                            <div class="col-md-3 col-sm-4">

                                <select style="height: 53px" class="form-control input-lg btn-search-reset" name="category">
                                    <option>Todas as categorias</option>
                                    {catss}
                                        <option value='{value}'>{name}</option>
                                    {/catss}
                                </select>

                            </div>

                            <div class="col-md-5 col-sm-7">

                                <div id="custom-search-input">
                                    <div class="input-group col-md-12">
                                        <input name="q" value='{pesq}' type="text" class="form-control input-lg pesquisar-data" placeholder="Buscar" />
                                        <span class="input-group-btn">
                                            <button class="btn btn-info btn-lg btn-search-reset" type="button">
                                                <i class="glyphicon glyphicon-search"></i>
                                            </button>
                                        </span>
                                    </div>
                                </div>

                            </div>

                        </div>
                </div>
                
    <!-- end col -->
            </div>
  <!-- end  row -->
        </div>
    </div>
    
    
        <nav class="navbar navbar-main navbar-default" role="navigation" style="opacity: 1;">
          <div class="container-fluid">
            <!-- Brand and toggle -->
             <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
        
            <!-- Collect the nav links,  -->
            <div class="collapse navbar-collapse navbar-1" style="margin-top: 0px;">            
              <ul class="nav navbar-nav">                  
                <li class="dropdown megaDropMenu">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="false">Categorias </a>
                  <ul class="dropdown-menu row">

                    <?php
                        if( count( $categorias ) > 0 ) {

                            $categs = array_chunk($categorias, 3);

                            foreach($categs as $index) {

                    ?>

                            <li class="col-sm-4 col-xs-12">
                                <ul class="list-unstyled"><?php
                            foreach ( $index as $key ) {
                                if( count( $key['subcat'] ) > 0 ) { 
                                ?><li class="title-item-menu"><?= $key['text'] ?></li>
                                    <?php foreach ($key['subcat'] as $innerKey ) {
                                        foreach ($innerKey[ 'tags' ] as $tags) {
                                            echo "<li><a href='" . $url . "pesquisar/resultado/" . $key['text'] . "/" . $tags['nome'] . "'>" . $tags['nome'] . "</a></li>";

                                        } ?>
                                    <?php } } else { ?><li><a href="{url}pesquisar/resultado/<?= $key['text']; ?>"><?= $key['text'] ?></a></li>
                                    <?php
                                }
                            }

                    ?>
                            
                                </ul>
                            </li>
                            
                            <?php

                        }

                        }
                    ?>
                    
                  </ul>
                </li>

                  
                <?php if( isset( $menus ) && count( $menus ) > 0 ) {
                    foreach ($menus as $key ) { 
                        if($key['name'] == 'Cadastre-se' || $key['name'] == 'Logar') {
                            continue;
                        }
                        
                        ?>
                    <li><a href="<?= '/' . $key['link'] ?>"><?= $key['name'] ?></a></li>
                <?php } } ?>

              </ul>
            </div><!-- /.navbar-collapse -->
          </div>
        </nav>

    </div>

    <!--
    <header id="header">
        <div class="container">
            <div class="row">

                <div class="row">

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
                                <select class="selectpicker index-big btn-search-reset">$class  =  count( $key['subcat'] ) > 0  ? 'has-children' : '';
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

                </div>

                <div class="row">

                <div class='col-lg-3 col-md-3 col-sm-12 col-xs-12'>
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
                                                                                <!--<li class="see-all"><a href="<?php echo $url . 'pesquisar/resultado/Todas as categorias/' . $key['text']; ?>">All Accessories</a></li>--><!--
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
                <div class='col-lg-9 col-md-9 col-sm-12 col-xs-12'>
                    <div class="hovermenu ttmenu dark-style menu-red-gradient">
                        <div role="navigation" class="navbar navbar-default">
                            <div>
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
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
                                                
                                                if($key['name'] == 'Cadastre-se' || $key['name'] == 'Logar') {
                                                    continue;
                                                }

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

                                    <li class="dropdown ttmenu-full no-padding-bottom no-margin-left">
                                        <a id="logar-dropdown" class="no-border" href="http://www.grupobasso.com.br/minha/conta/login" class="dropdown-toggle" data-toggle="dropdown">Minha Conta</a>
                                        <ul class="dropdown-menu dropdown-lr animated slideInRight" role="menu" style="width:300px;background-color:beige;">
                                            <div class="col-lg-12" style="background-color:white;border: 1px solid;border-top:none;">
                                                <br/>
                                                <br/>
                                                <form class="formLogin" method="post" action="http://www.grupobasso.com.br/ajax/minha/conta/logar">
                                                    <div class="form-group">
                                                        <label for="user">Usuário</label>
                                                        <input type="email" name="user" id="user" tabindex="1" class="form-control" value="" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="pass">Senha</label>
                                                        <input type="password" name="pass" id="pass" tabindex="2" class="form-control" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-xs-7">
                                                                <button type="submit" name="login-submit" id="login-submit" tabindex="4" class="btn btn-success">Entrar</button>
                                                            </div>
                                                            <div class="col-xs-5">

                                                                <a href="http://www.grupobasso.com.br/minha/conta/cadastrar" tabindex="5" class="btn btn-link forgot-password">Cadastre-se!</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </ul>
                                    </li>

                                </ul>
                            </div>
                            </div>
                        </div>
                    </div>            
                </div>

                </div>                
            </div>
        </div>		
    </header> -->


    <script type="text/javascript">
    ! function($, n, e) {
      var o = $();
      $.fn.dropdownHover = function(e) {
        return "ontouchstart" in document ? this : (o = o.add(this.parent()), this.each(function() {
          function t(e) {
            o.find(":focus").blur(), h.instantlyCloseOthers === !0 && o.removeClass("open"), n.clearTimeout(c), i.addClass("open"), r.trigger(a)
          }
          var r = $(this),
            i = r.parent(),
            d = {
              delay: 100,
              instantlyCloseOthers: !0
            },
            s = {
              delay: $(this).data("delay"),
              instantlyCloseOthers: $(this).data("close-others")
            },
            a = "show.bs.dropdown",
            u = "hide.bs.dropdown",
            h = $.extend(!0, {}, d, e, s),
            c;
          i.hover(function(n) {
            return i.hasClass("open") || r.is(n.target) ? void t(n) : !0
          }, function() {
            c = n.setTimeout(function() {
              i.removeClass("open"), r.trigger(u)
            }, h.delay)
          }), r.hover(function(n) {
            return i.hasClass("open") || i.is(n.target) ? void t(n) : !0
          }), i.find(".dropdown-submenu").each(function() {
            var e = $(this),
              o;
            e.hover(function() {
              n.clearTimeout(o), e.children(".dropdown-menu").show(), e.siblings().children(".dropdown-menu").hide()
            }, function() {
              var t = e.children(".dropdown-menu");
              o = n.setTimeout(function() {
                t.hide()
              }, h.delay)
            })
          })
        }))
      }, $(document).ready(function() {
        $('[data-hover="dropdown"]').dropdownHover()
      })
    }(jQuery, this);
  </script>
    





































