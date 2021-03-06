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

    <style type="text/css">
    .navbar-nav {  margin-top: 0;}
    .cd-dropdown-content {display: inline-block;}
    .cd-dropdown {position: absolute;  margin-top: 30px;}
    body,.table tbody tr td {font-size: 12px;}
    .navbar .nav>li>a {color: white;text-shadow: none;}
    .navbar-default { height: 40px;}
    .sidemenu { width: 90%; }
    </style>

    {js}

    <script type='text/javascript' src='http://www.grupobasso.com.br/assets/js/jquery-form.js'></script>

</head>


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
                    <!--<ul class="topBarNav pull-right">
                        <li class="dropdown">
                        <?php if($logado): ?>

                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="false"> <i class="glyphicon glyphicon-user mr-5"></i><span>Minha Conta</span> </a>
                            <ul class="dropdown-menu w-150" role="menu">
                                <li><a href="http://www.grupobasso.com.br/minha/conta/inicio">Painel</a></li>
                                <li><a href="http://www.grupobasso.com.br/minha/conta/compras">Minhas Compras</a></li>
                                <li class="divider"></li>
                                <li><a href="http://www.grupobasso.com.br/minha/conta/meusdados">Minhas Informções</a>
                                </li>
                                <li><a href="http://www.grupobasso.com.br/minha/conta/meusenderecos">Meus Endereços</a>
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
                  -->
                    <ul class="topBarNav pull-right">
                      <li><a><img width="15px" src="http://www.grupobasso.com.br/assets/images/whatapp.png"/>&nbsp;&nbsp;Ligue ou Converse pelo WhatsApp</a></li>
                      <li><a title="Santo André - Rua Cel. Alfredo Fláquer, 686 - bassosa@grupobasso.com.br" target="_blank" href="https://api.whatsapp.com/send?phone=+5511952540191&text=Ola%20Grupo%20Basso">11 95254-0191 </a></li>
                      <li><a title="São Bernardo do Campo - Av. Getulio Vargas, 1510 - bassosbc@grupobasso.com.br" target="_blank" href="https://api.whatsapp.com/send?phone=+55119525416176&text=Ola%20Grupo%20Basso">11 95254-1617</a></li>
                      <li><a title="São Caetano do Sul - Rua Heloisa Pamplona, 428 - bassosc@grupobasso.com.br" target="_blank" href="https://api.whatsapp.com/send?phone=+5511941460806&text=Ola%20Grupo%20Basso">11 94146-0806</a></li>
                      <li></li>
                    </ul>
                </div>
            </nav>
        </div>

        <div id="cabecalho" class="logo-centro " style="margin-top:50px;margin-bottom:20px;">

              <div class="conteiner">
                <div class="row-fluid">
                  <div class="conteudo-topo span3 hidden-phone">
                    <div class="superior row-fluid">
                      <div class="span12">

                            <?php if(!$logado): ?>
                                <a href="/minha/conta/login" class="bem-vindo cor-secundaria">
                                  Bem-vindo, <span class="cor-principal">identifique-se</span> para fazer pedidos
                                </a>
                            <?php else: ?>
                                <a class="bem-vindo cor-secundaria">
                                  Bem-vindo, <span class="cor-principal"><?= '' ?></span>
                                </a>
                            <?php endif; ?>


                      </div>
                    </div>
                    <div class="inferior row-fluid">
                      <div class="span12">

                        <div class="busca borda-alpha">

                            <span role="status" aria-live="polite" class="ui-helper-hidden-accessible"></span>
                            <input id="auto-complete" type="text" name="q" placeholder="Digite o que você procura" value="{pesq}" class="ui-autocomplete-input pesquisar-data">
                            <button class="botao botao-busca icon-search fundo-secundario btn-search-reset"></button>

                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="span6">
                    <h1 class="logo cor-secundaria">
                      <a href="/" title="Grupo Basso">
                          <img src="{url}assets/images/logo.png" alt="Grupo Basso">
                      </a>
                    </h1>
                  </div>

                  <div class="conteudo-topo span3 hidden-phone">
                    <div class="superior row-fluid">
                      <div class="span12">
                          <ul class="acoes-conta">
                              <li>
                                <i class="icon-list fundo-principal"></i>
                                <a href="{url}minha/conta/compras" class="cor-secundaria">Meus Pedidos</a>
                              </li>
                              <li>
                                <i class="icon-user fundo-principal"></i>
                                <a href="{url}minha/conta/inicio" class="cor-secundaria">Minha Conta</a>
                              </li>
                              <?php if($logado): ?>
                              <li>
                                <i class="icon-user fundo-principal"></i>
                                <a href="{url}minha/conta/sair" style="color:red;" class="cor-secundaria">Sair</a>
                              </li>
                            <?php endif; ?>
                          </ul>
                      </div>
                    </div>

                      <div class="inferior row-fluid">
                          <div class="span12">
                              <div class="carrinho vazio">

                                  <a href="{url}compras/carrinho">
                                    <i class="icon-shopping-cart fundo-principal"></i>
                                    <strong class="qtd-carrinho  cor-secundaria" style="display: none;">0</strong>
                                    <span style="display: none;">
                                        <b class=" cor-secundaria"><span>Meu Carrinho</span></b>
                                      <span class="cor-secundaria">Produto adicionado</span>
                                    </span>
                                      <span class='cor-secundaria data-carrinho'>0 itens: R$ 0,00</span>
                                  </a>

                                  <div class="carrinho-interno-ajax">

                                  </div>
                              </div>
                          </div>
                      </div>

                  </div>

                </div>

              </div>
              <span id="delimitadorBarra"></span>
        </div>

        <!--<div class="col-lg-12" style="margin-top:30px;">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4 text-center">
                    <a href="/"> <img alt="" width="100px" height="100px" class="img img-rounded" style="margin: -10px auto 25px" src="{url}assets/images/logo.png"></a>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-8 text-center">
                        <div class="row grid-space-1">


<div class="conteiner">
<div class="row-fluid">
<div class="conteudo-topo span3 hidden-phone">
<div class="superior row-fluid">
    <div class="span12">
    
        
        <a href="https://www.biellissima.com.br/conta/login" class="bem-vindo cor-secundaria">
            Bem-vindo, <span class="cor-principal">identifique-se</span> para fazer pedidos
        </a>
        
    
    </div>
</div>
<div class="inferior row-fluid">
    <div class="span12">

    <div class="busca borda-alpha">
        <span role="status" aria-live="polite" class="ui-helper-hidden-accessible"></span>
        <input id="auto-complete" type="text" name="q" placeholder="Digite o que você procura" value="{pesq}" autocomplete="off" class="ui-autocomplete-input pesquisar-data">
        <button class="botao botao-busca icon-search fundo-secundario btn-search-reset" type="button"></button>

    </div>
    </div>
</div>
</div>

        <div class="span6">
        <h1 class="logo cor-secundaria">
            <a href="https://www.biellissima.com.br/" title="BIELLÍSSIMA">
                <img alt=""  src="{url}assets/images/logo.png"/>
            </a>
        </h1>
        </div>

<div class="conteudo-topo span3 hidden-phone">
<div class="superior row-fluid">
    <div class="span12">
    
        <ul class="acoes-conta">
        
            <li>
            <i class="icon-list fundo-principal"></i>
            <a href="https://www.biellissima.com.br/conta/pedido/listar" class="cor-secundaria">Meus Pedidos</a>
            </li>

        
            <li>
            <i class="icon-user fundo-principal"></i>
            <a href="#" class="cor-secundaria">Minha Conta</a>

                        </div>
                </div>

            </div>
        </div>
-->
    </div>

    <!--
    <?php if(isset($categorias)): ?>
        <nav class="navbar navbar-main navbar-default" role="navigation" style="opacity: 1;">
          <div class="container-fluid">
             <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>

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
            </div>

          </div>
        </nav>
    <?php endif;  ?>
                    -->
    </div>




    <header id="header">
        <div class="container">
            <div class="row">

              <?php if((isset($mostrar_categorias) && true == $mostrar_categorias) || !isset($mostrar_categorias)): ?>

                <div class='col-lg-3 col-md-3 col-sm-12 col-xs-12' style="padding-right:0">
                    <div class="cd-dropdown-wrapper" style="background-color:#6666">
                        <a style="font-size:14px;background-color:#6666" class="cd-dropdown-trigger categorias-menu" href="{url}pesquisar/resultado/Todas as categorias/">CATEGORIAS</a>
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
                                                <a style="font-size:12px" href="{url}pesquisar/resultado/<?php echo $key['text']; ?>"><?php echo $key['text']; ?></a>
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
                                                                                        echo "<li><a  style='font-size:12px' href='" . $url . "pesquisar/resultado/" . $key['text'] . "/" . $tags['nome'] . "'>" . $tags['nome'] . "</a></li>";

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
                <div class='col-lg-9 col-md-9 col-sm-12 col-xs-12' style="padding-left:0">
                    <div class="hovermenu ttmenu dark-style menu-red-gradient" style="text-align:center">
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

                                </ul>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>

              <?php endif; ?>

              <?php if(isset($mostrar_menu_conta) && $mostrar_menu_conta): ?>

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
                                                <a href="http://www.grupobasso.com.br/minha/conta/sair">
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

              <?php endif; ?>

            </div>
        </div>
    </header>



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
