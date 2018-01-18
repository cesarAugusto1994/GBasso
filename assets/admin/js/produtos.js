/**
* OPtions para enviar formulários
*
**/
var opt = {

    success:   gravarProdutos,

    dataType:  'json',

    beforeSerialize: function(form, options) {  

        for (instance in CKEDITOR.instances)

            CKEDITOR.instances[instance].updateElement();

    }    

}; 

var opt2 = {

    success:   gravarEstoque,

    dataType:  'json'

}; 

var opt3 = {

    success:   gravarLocal,

    dataType:  'json'

}; 

$( '.cadastrar-produto' ).ajaxForm( opt );

$( '.form-estoque' ).ajaxForm( opt2 );

$( '.form-local' ).ajaxForm( opt3 );


/**
 * SECTIONS FUNCTION
 *
 * 
 *
 *
 */
function gravarProdutos(data, statusText, xhr, $form)  {

    var code  =  data['code'];

    if( code == 100 ) {

        window.location.href  =  baseUrl + 'admin/produtos/images/' +  data['id'];

    }else if( code == 102 ) {

        var mess  =  data['message'];

        alerta( mess, 102 );

    }else {

        $( 'input[type=text]' ).prop( 'disabled', true );

        modalLogin();

    };  

}

function gravarEstoque(data, statusText, xhr, $form)  {

    var code  =  data['code'];

    if( code == 103 ) {

        modalLogin();

    }else {

        var mess  =  data['message'];

        $( '.btn-form-estoque' ).addClass( 'hidden' );

        if( code == 100 ) {            

            $( '.msg-form-estoque' ).removeClass( 'alert-danger' ).addClass( 'alert-success' );            

            setTimeout( function () {

                window.location.reload( true );

            }, 2000); 

        }else {

            $( '.msg-form-estoque' ).removeClass( 'alert-success' ).addClass( 'alert-danger' );

        }

        $( '.msg-form-estoque' ).text( mess ).removeClass( 'hidden' );

        setTimeout( function () {

            $( '.msg-form-estoque' ).text( mess ).addClass( 'hidden' );

            $( '.btn-form-estoque' ).removeClass( 'hidden' );

        }, 2300); 

    }
 
}

function gravarLocal(data, statusText, xhr, $form)  {

    var code  =  data['code'];

    if( code == 103 ) {

        modalLogin();

    }else {

        var mess  =  data['message'];

        $( '.btn-form-locais' ).addClass( 'hidden' );

        if( code == 100 ) {            

            $( '.msg-form-locais' ).removeClass( 'alert-danger' ).addClass( 'alert-success' );            

            setTimeout( function () {

                window.location.reload( true );

            }, 2000); 

        }else {

            $( '.msg-form-locais' ).removeClass( 'alert-success' ).addClass( 'alert-danger' );

        }

        $( '.msg-form-locais' ).text( mess ).removeClass( 'hidden' );

        setTimeout( function () {

            $( '.msg-form-locais' ).text( mess ).addClass( 'hidden' );

            $( '.btn-form-locais' ).removeClass( 'hidden' );

        }, 2300); 

    }
 
}

//Limpa campos das linhas do tipo
function limparCamposTipo( $tpContent, remove ) {

    var $select     =   $tpContent.find( 'select' );

    remove ? $tpContent.find( '.bootstrap-select' ).remove() : null;

    $select.find( 'option:first' ).prop( 'selected' );

    $select.selectpicker( 'refresh' );

    $tpContent.find( 'input[type=text]' ).val( '' );    

    $tpContent.find( '.tag-option-selected' ).html( '' );

    $tpContent.find( 'input[type=hidden]' ).remove();

}

//Re configura os name dos tipos
function reBuildTipos() {

    var i  =  0;

    $( '.content-tipos' ).find( 'select' ).each( function () {

        $( this ).attr( 'name', 'tipo' + i );

        i++;

    });

    i  =  0;

    $( '.content-tipos' ).find( '.titulo-tipo' ).each( function () {

        $( this ).attr({ 'name' : 'titulo' + i, 'data-name-select' : 'tipo' + i });

        i++;

    });

    i  =  0;

    $( '.content-tipos' ).find( '.tag-tipo' ).each( function () {

        $( this ).attr( 'name', 'tag' + i );

        i++;

    });

    i  =  0;

    $( '.content-tipos' ).find( '.hTag' ).each( function () {

        $( this ).attr( 'name', 'hTag' + i );

        i++;

    }); 

    $( '#qtdHTags' ).val( i );

    i  =  0;

    $( '.content-tipos' ).find( '.hTitulo' ).each( function () {

        $( this ).attr( 'name', 'hTitulo' + i );

        i++;

    });

}

/** Grava uma determinada lista no banco de dados **/
function gravarLista( $element, lista, formDataSend ) {

    var urlAction  =  '';

    var myClass    =  '';

    switch( lista ) {
        case 1  :  
            
            urlAction  =  baseUrlAjax + 'produtos/gravarListaTitulo';

            myClass    =  'hTitulo';

        break;
        default :  
            
            urlAction  =  baseUrlAjax + 'produtos/gravarListaTag';

            myClass    =  'hTag';

        break;
    }

    $.ajax({

        type: 'POST',

        url: urlAction,

        data: formDataSend,

        dataType: 'json',

        success: function( data ) {

            var code   =   data['code'];

            if( code == 100 ) {

                if( myClass != 'hTag' ) $element.find( 'input[type=hidden].' + myClass ).remove();

                var id       =   data['id'];

                var $input   =   $( '<input />' ).attr({ 'type' : 'hidden', 'name' : 'input', 'class' : myClass }).val( id );

                var text     =   $element.find( 'input[type=text].tag-tipo' ).val();

                $element.append( $input );

                $element.find( '.relative' ).addClass( 'hidden' );

                if( myClass == 'hTag' ) {

                    var $a     =  $( '<a></a>' ).attr({ 'href' : '#', 'id-delete-tag' : id, 'class' : 'link-tag-selected' }).text( text );

                    var $span  =  $( '<span></span>' ).addClass( 'badge remover-tag' ).text( 'x' );

                    $a.append( $span );

                    $element.find( '.tag-option-selected' ).append( $a );

                    $element.find( 'input[type=text].tag-tipo' ).val( '' );

                }

                reBuildTipos();

            }else if( code == 102 ) {

                var message   =   data['message'];

                alerta( message, code );

            }else {

                $element.find( '.relative' ).addClass( 'hidden' );

                $( 'input[type=text]' ).prop( 'disabled', true );

                modalLogin();

            };
            
        },error: function(request, status, error){

            alerta( 'Ocorreu um erro', 102 );

        }

    });
 
}



/** Obtem as imagens do produto **/
function getImages( post ) {

    $.ajax({

        type: 'POST',

        url: baseUrlAjax + 'produtos/getImages',

        data: post,

        dataType: 'json',

        success: function( data ) {

            var code  =   (typeof data['code'] != 'undefined' ) ? data['code'] : false;

            if( typeof code === "boolean" ) {

                var j  =  1;

                for (var i = data.length -1; i >= 0; i--) {

                    var url           =   baseUrl + data[i]['url'];

                    var imgDefault    =   data[i]['default'];

                    var $div          =   $( '<div></div>' ).addClass( 'col-lg-2 content-img' );

                    var $innerDiv     =   $( '<div></div>' ).addClass( 'select-img' );
                    
                    var $img          =   $( '<img />' ).attr({ 'src' : url, 'class' : 'img-selected' });

                    var $divChk       =   $( '<div></div>' ).addClass( 'col-lg-12 no-padding checkbox' );

                    var $divChk1      =   $( '<div></div>' ).addClass( 'col-lg-12 no-padding checkbox' );

                    var $checkbox     =   $( '<input />' ).attr({ 'type' : 'checkbox', 'class' : 'img-checked', 'id' : data[i]['id'] });

                    var $checkboxDel  =   $( '<input />' ).attr({ 'type' : 'checkbox', 'class' : 'img-delete', 'id' : data[i]['id'] });

                    var $label        =   $( '<label></label>' );

                    var $labelDel      =   $( '<label></label>' );

                    if( imgDefault == 1 ) $checkbox.prop( 'checked', true );

                    $label.append( $checkbox ).append( 'Imagem Principal' );

                    $labelDel.append( $checkboxDel ).append( 'Deletar' );

                    $divChk.append( $label );

                    $divChk1.append( $labelDel );

                    $div.append( $divChk ).append( $divChk1 ).append( $innerDiv.append( $img ) );

                    $( '.content-image-select' ).append( $div );

                    if( j == 6 ) {

                        var $line  =  $( '<div></div>' ).addClass( 'divider-bottom' );

                        $( '.content-image-select' ).append( $line );

                        j  = 0;

                    }

                    j++;

                };

            }else if( code == 102 ) {

                var message   =   data['message'];

                alerta( message, code );

            };
            
        },error: function(request, status, error){

            alerta( 'Ocorreu um erro', 102 );

        }

    });
 
}



/** Seta a imagem como padrão **/
function setImageDefault( post ) {

    $.ajax({

        type: 'POST',

        url: baseUrlAjax + 'produtos/setImageDefault',

        data: post,

        dataType: 'json',

        success: function( data ) {

            var code  =  data['code'];    

            var mess  =  data['message'];

            if( code == 100 ) {

                alerta( mess, 100 );

            }else if( code == 102 ) {                

                alerta( mess, 102 );

            }else {

                $( 'input[type=text]' ).prop( 'disabled', true );

                modalLogin();

            };  
            
        },error: function(request, status, error){

            alerta( 'Ocorreu um erro', 102 );

        }

    });
 
}


function deletarImagensProdutos( post ) {

    $.ajax({

        type: 'POST',

        url: baseUrlAjax + 'produtos/deletarImagensProdutos',

        data: post,

        dataType: 'json',

        success: function( data ) {

            var code  =  data['code'];

            var mess  =  data['message'];

            if( code == 100 ) {

                alerta( mess, 100 );

                $( 'input[type=checkbox].img-delete:checked' ).each( function () {

                    $( this ).parent().parent().parent().fadeOut( 1000 ).delay( 2000 ).remove();

                });

            }else if( code == 102 ) {                

                alerta( mess, 102 );

            }else {

                $( 'input[type=text]' ).prop( 'disabled', true );

                modalLogin();

            };  
            
        },error: function(request, status, error){

            alerta( 'Ocorreu um erro', 102 );

        }

    });
 
}


function deletarProdutos( post ) {

    $.ajax({

        type: 'POST',

        url: baseUrlAjax + 'produtos/deletarProdutos',

        data: post,

        dataType: 'json',

        success: function( data ) {

            var code  =  data['code'];

            var mess  =  data['message'];

            if( code == 100 ) {

                alerta( mess, 100 );

                $( 'input[type=checkbox].chkProdutosDeletar:checked' ).each( function () {

                    $( this ).parent().parent().fadeOut( 1000 ).delay( 2000 ).remove();

                });

            }else if( code == 102 ) {

                alerta( mess, 102 );

            }else {

                $( 'input[type=text]' ).prop( 'disabled', true );

                modalLogin();

            };  
            
        },error: function(request, status, error){

            alerta( 'Ocorreu um erro', 102 );

        }

    });
 
}

function validarFrete( post ) {

    $.ajax({

        type: 'POST',

        url: baseUrlAjax + 'produtos/validarFrete',

        data: post,

        dataType: 'json',

        success: function( data ) {

            $( '.info1' ).text( 'Valor: ' + data['Valor'] );

            $( '.info2' ).text( 'Erro: ' + data['Error'] );

            $( '#verificarFrete' ).modal();
            
        },error: function(request, status, error){

            alerta( 'Ocorreu um erro', 102 );

        }

    });
 
}

function getEstoqueProduto( post ) {

    $.ajax({

        type: 'POST',

        url: baseUrlAjax + 'produtos/gestEstoque',

        data: post,

        dataType: 'json',

        success: function( data ) {

            var code  =  typeof data['code'] == 'undefined' ? false : true;

            if( !code ) {

                $( '#qtd' ).val( data['qtd'] );

                $( '#qtdMin' ).val( data['qtdMin'] );

                $( '#qtdMax' ).val( data['qtdMax'] );

                $( '#estoque' ).modal();

            }else {

                if( data['code'] == 102 ) {

                    alerta( data['message'], 102 );

                }else {

                    modalLogin();                    

                }

            }
            
        },error: function(request, status, error){

            alerta( 'Ocorreu um erro', 102 );

        }

    });
 
}

function getLocal( post ) {

    $.ajax({

        type: 'POST',

        url: baseUrlAjax + 'produtos/getLocal',

        data: post,

        dataType: 'json',

        success: function( data ) {

            var code  =  typeof data['code'] == 'undefined' ? false : true;

            if( !code ) {

                $( '#empresa' ).val( data[0]['emp'] );

                $( '#endereco' ).val( data[0]['end'] );

                $( '.form-local' ).attr( 'action', baseUrlAjax + 'produtos/salvarEdicaoLocal' );

                $( '#locais' ).modal();

            }else {

                if( data['code'] == 102 ) {

                    alerta( data['message'], 102 );

                }else {

                    modalLogin();                    

                }

            }
            
        },error: function(request, status, error){

            alerta( 'Ocorreu um erro', 102 );

        }

    });
 
}

/**
 * SECTIONS CLICK
 *
 * Manipula clicks
 */
$( '.verificarFrete' ).click( function () {

    var peso         =   $( 'input[type=text][name=peso]' ).val();

    var largura      =   $( 'input[type=text][name=largura]' ).val();

    var altura       =   $( 'input[type=text][name=altura]' ).val();

    var comprimento  =   $( 'input[type=text][name=profundidade]' ).val();

    var post  =  'peso=' + peso + '&largura=' + largura + '&altura=' + altura + '&comprimento=' + comprimento;

    validarFrete( post );

});

$( '.deletarProdutos' ).click( function () {

    var qtd  =   $( 'input[type=checkbox].chkProdutosDeletar:checked' ).length;

    if( qtd > 0 ) {

        var i     =  0;

        var post  =  '';

        $( 'input[type=checkbox].chkProdutosDeletar:checked' ).each( function () {

            var id  =  $( this ).attr( 'id' );

            post   +=  'id' + i + '=' + id + '&';

            i++;

        });

        post  +=  'qtd=' + qtd;

        deletarProdutos( post );

    }else {

        alerta( 'Selecione no mínimo 1 ou mais produtospara serem deletados', 102 );

    }

});


$( '.deletar-imagem-produto' ).click( function () {

    var qtd  =   $( 'input[type=checkbox].img-delete:checked' ).length;

    if( qtd > 0 ) {

        var i          =  0;

        var post       =  '';

        var idProduto  =  $( '#idProduto' ).val();

        $( 'input[type=checkbox].img-delete:checked' ).each( function () {

            var id  =  $( this ).attr( 'id' );

            post   +=  'id' + i + '=' + id + '&';

            i++;

        });

        post  +=  'qtd=' + qtd + '&idProduto=' + idProduto;

        deletarImagensProdutos( post );

    }else {

        alerta( 'Selecione no mínimo 1 imagem para ser deletada', 102 );

    }

});


$( '.editar-produtos' ).click( function () {

    var qtd  =  $( 'input[type=checkbox].chkProdutosDeletar:checked' ).length;

    if( qtd == 1 ) {

        var id  =  $( 'input[type=checkbox].chkProdutosDeletar:checked' ).attr( 'id' );

        window.location.href  =  baseUrl + 'admin/produtos/editar/' + id ;

    }else {

        alerta( 'Selecione apenas 1 produto', 102 );

    }


});


//Incrementa linha de Tipos no cadastro de produtos
$( '.btn-add-tipo' ).click( function () {

    var $tpContent  =   $( '.content-tipos:last' ).clone();

    limparCamposTipo( $tpContent, true );

    $( '.content-tipos:last' ).after( $tpContent );

    reBuildTipos();

});


$( document ).on( 'click', 'input[type=checkbox].img-checked', function () {

    if( $( this ).is( ':checked' ) ) {

        $( '.img-checked' ).not( this ).prop( 'checked', false );

        var post  =   'id='  + $( '#idProduto' ).val();

        post     +=   '&img=' + $( this ).attr( 'id' );

        setImageDefault( post );

    }

});


$( document ).on( 'click', '.btn-delete-tipos', function () {

    var qtd  =   $( '.content-tipos' ).length;

    if( qtd > 1 ) {

        $( this ).parent().parent().remove();

    }else {

        limparCamposTipo( $( '.content-tipos' ), false );

    };

    reBuildTipos();

});


$( document ).on( 'click', '.link-tag-selected', function (e) {

    e.preventDefault();

    return false;

});

$( document ).on( 'click', '.remover-tag', function () {

    var $a     =   $( this ).parent();

    var $elem  =   $( this ).parent().parent().parent().parent();
 
    var idTag  =   $a.attr( 'id-delete-tag' );

    if( $.isNumeric( idTag ) ) {

        $elem.find( 'input[type=hidden][value=' + idTag + ']' ).remove();

        $a.remove();

        reBuildTipos();

    }else {

        alerta( 'Ocorreu um erro ao deletar a tag', 102 );

    }

});


//Grava em banco de dados a lista de titulos
$( document ).on( 'click', '.lista-titulos', function () {

    var id      =  $( this ).attr( 'id' );

    var text    =  $( this ).text();

    var $elem   =  $( this ).parent().parent().parent().parent();

    var select  =  'tipo' + $elem.find( 'input[type=text].titulo-tipo' ).attr( 'name' ).replace(/[^0-9]/g,'' );

    var idLista =  $( 'select[name=' + select + ']' ).val();    

    var $input  =  '';

    if( $.isNumeric( id ) ) {

        if( id == 0 ) {

            var post  =  'idLista=' + idLista + '&titulo=' + text;

            gravarLista( $elem, 1, post )

        }else {

            $input  =  $elem.find( 'input[type=hidden].hTitulo' );

            $elem.find( '.relative' ).addClass( 'hidden' );

            if( $input.length == 0 ) {

                $input   =   $( '<input />' ).attr({ 'type' : 'hidden', 'name' : 'input', 'class' : 'hTitulo' }).val( id );

                $elem.append( $input );

            }else {

                $input.val( id );

            }

            $elem.find( '.titulo-tipo' ).val( text );

            reBuildTipos();

        }

    }else {

        alerta( 'Ocorreu um erro', 102 );

    }

});


//Grava em banco de dados a lista de titulos
$( document ).on( 'click', '.lista-tags', function () {

    var id        =   $( this ).attr( 'id' );

    var text      =   $( this ).text();

    var $elem     =   $( this ).parent().parent().parent().parent();

    var input     =   'hTitulo' + $elem.find( 'input[type=text].tag-tipo' ).attr( 'name' ).replace(/[^0-9]/g,'' );

    var idTitulo  =   $( 'input[type=hidden][name=' + input + ']' ).val();

    var $input    =   '';

    if( $.isNumeric( id ) ) {

        if( id == 0 ) {

            var post      =   'idTitulo=' + idTitulo + '&tag=' + text;

            gravarLista( $elem, 2, post );

        }else {

            $input  =  $elem.find( 'input[type=hidden].hTag' );

            $elem.find( '.relative' ).addClass( 'hidden' );

            $input   =   $( '<input />' ).attr({ 'type' : 'hidden', 'name' : 'input', 'class' : 'hTag' }).val( id );

            $elem.append( $input );

            var $a     =  $( '<a></a>' ).attr({ 'href' : '#', 'id-delete-tag' : id, 'class' : 'link-tag-selected' }).text( text );

            var $span  =  $( '<span></span>' ).addClass( 'badge remover-tag' ).text( 'x' );

            $a.append( $span );

            $elem.find( '.tag-option-selected' ).append( $a );

            $elem.find( 'input[type=text].tag-tipo' ).val( '' );

            reBuildTipos();

        }

    }else {

        alerta( 'Ocorreu um erro', 102 );

    }

});


$( document ).on( 'click', '.input-mask-div', function () {

    $( this ).find( 'input[type=text]' ).focus();

});


$( '.estoqueProduto' ).click( function () {

    var qtd  =  $( 'input[type=checkbox].chkProdutosDeletar:checked' ).length;

    if( qtd != 1 ) {

        alerta( 'Selecione apenas 1 produto por vez', 102 );

    }else {

        var id     =   $( 'input[type=checkbox].chkProdutosDeletar:checked' ).attr( 'id' );

        var post   =   'id=' + id;

        $( '#idProdutoEstoque' ).val( id );

        getEstoqueProduto( post );

    }

});


$( '.novoLocal' ).click( function () {

    $( '.form-local' ).attr( 'src', baseUrlAjax + 'produtos/salvarLocal' );

    $( '#locais' ).modal();

});


$( '.editarLocal' ).click( function () {

    var qtd  =  $( 'input[type=checkbox].chkLocais:checked' ).length;

    if( qtd != 1 ) {

        alerta( 'Selecione apenas 1 local por vez', 102 );

    }else {

        var id     =   $( 'input[type=checkbox].chkLocais:checked' ).attr( 'id' );

        var post   =   'id=' + id;

        $( '#idLocal' ).val( id );

        getLocal( post );

    }

});


/**
* SECTIONS KEY UP
*
* Manipula entradas do teclado
*
*
*/
$( document ).on( 'keyup', '.titulo-tipo', function () {

    var text     =   $( this ).val();

    var select   =   'tipo' + $( this ).attr( 'name' ).replace(/[^0-9]/g,'' );

    var idLista  =   $( 'select[name=' + select + ']' ).val();

    var post     =   'idLista=' + idLista + '&titulo=' + text;

    var url      =   baseUrlAjax + 'produtos/getListaTitulos';

    var $ul      =   $( this ).next().find( 'ul' );        

    if( $.trim( text ) != '' ) {

        getListas( $ul, text, 'list-group-item lista-titulos', url, post );

    }else {

        $ul.html( '' );

        $ul.parent().parent().addClass( 'hidden' );

    }

});


$( document ).on( 'keyup', '.tag-tipo', function () {

    var text      =   $( this ).val();

    var input     =   'hTitulo' + $( this ).attr( 'name' ).replace(/[^0-9]/g,'' );

    var idTitulo  =   $( 'input[type=hidden][name=' + input + ']' ).val();

    var post      =   'idTitulo=' + idTitulo + '&tag=' + text;

    var url       =   baseUrlAjax + 'produtos/getListaTags';

    var $ul       =   $( this ).parent().next().find( 'ul' );        

    if( $.trim( text ) != '' ) {

        getListas( $ul, text, 'list-group-item lista-tags', url, post );

    }else {

        $ul.html( '' );

        $ul.parent().parent().addClass( 'hidden' );

    }

});


/**
 * SECTIONS CHANGE
 *
 * Manipula entradas do teclado
 */
$( 'select[name=categoria]' ).change( function () {

    var id    =   $( this ).val();

    var post  =   'idCat=' + id;

    var url   =   baseUrlAjax + 'produtos/getSubCategorias';

    preencheSelect( $( 'select[name=subcategoria]' ) , url, post )

});


if( page == 'cadastrar-produtos' ) {

    preencheSelect( $( 'select[name=tipo0]' ), baseUrlAjax + 'produtos/getListaTipos', '' );

    preencheSelect( $( 'select[name=categoria]' ), baseUrlAjax + 'produtos/getCategorias', '' );

    preencheSelect( $( 'select[name=unidadeMedida]' ), baseUrlAjax + 'produtos/getUnidadeMedida', '' );

}else if( page == 'editar-imagens-produtos' ) {

    var post  =   'id=' + $( '#idProduto' ).val();

    getImages( post );

}else if( page == 'editar-produtos' ) {

    //preencheSelect( $( 'select[name=tipo0]' ), baseUrlAjax + 'produtos/getListaTipos', '' );

    preencheSelect( $( 'select[name=categoria]' ), baseUrlAjax + 'produtos/getCategorias', '' );

    preencheSelect( $( 'select[name=unidadeMedida]' ), baseUrlAjax + 'produtos/getUnidadeMedida', '' );

    setTimeout( function () {

        if( $.trim( undMed ) != '' ) {

            $( 'select[name=unidadeMedida]' ).selectpicker( 'val', $.trim( undMed ) );

        }

        if( $.trim( cat ) != '' ) {

            $( 'select[name=categoria]' ).selectpicker( 'val', $.trim( cat ) ).trigger( 'change' );

            setTimeout( function () {

                $( 'select[name=subcategoria]' ).selectpicker( 'val', $.trim( subCat ) );

            }, 2400);

        }

    }, 2400);

}








