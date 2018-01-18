/**
* OPtions para enviar formulários
*
**/
var opt = {

    success:   gravarCategoria,

    dataType:  'json'

};

$( '.cadastrar-categoria' ).ajaxForm( opt );

$( '.cadastrar-subcategoria' ).ajaxForm( opt );

$( '.cadastrar-tagcategoria' ).ajaxForm( opt );

$( '.configurar-ordem-subcat' ).ajaxForm( opt );


/**
* SECTIONS FUNCTION
*
* 
*/
function gravarCategoria(data, statusText, xhr, $form)  {

    var code  =  data['code'];

    if( code == 100 ) {

        var mess  =  data['message'];

        if( page == 'visualizar-categorias' ) {

            $( '#modalConfigmenu' ).trigger( 'click' );

        }

        alerta( mess, 100 );

    	$( $form ).get( 0 ).reset();

    	$( $form ).find( 'select' ).selectpicker( 'refresh' );

        setTimeout( function () {

            if( page == 'categorias' ){
                window.location.href  =  baseUrl + 'admin/categorias/visualizar_categorias';
            }else if( page == 'subcategorias' ){
                window.location.href  =  baseUrl + 'admin/categorias/visualizar_subcategorias';
            }else if( page == 'tagcategoria' ){
                window.location.href  =  baseUrl + 'admin/categorias/visualizar_tagsubcategorias';
            }

        }, 2000);
    	
    }else if( code == 102 ) {

        var mess  =  data['message'];

        alerta( mess, 102 );

    }else {

        $( 'input[type=text]' ).prop( 'disabled', true );

        modalLogin();

    };  

}


function getConfigMenuCategoria( post ) {

    $.ajax({

        type: 'POST',

        url: baseUrlAjax + 'categorias/getConfigMenuCategoria',

        data: post,

        dataType: 'json',

        success: function( data ) {

            var code  =  data['code'];    

            if( code == 100 ) {

                $( '#modalConfig' ).find( 'tr' ).not( ':first' ).remove();                

                if( data['subcat'].length > 0 ) {

                    $( '#modalConfig' ).find( 'tr' ).hide();

                    data  =  data['subcat'];

                    var j  =  0;

                    for (var i = data.length - 1; i >= 0; i--) {

                        var id       =  data[i]['value'];

                        var subCat   =  data[i]['subcat'];

                        var ordem    =  data[i]['ordem'];

                        var $input   =  $( '<input />' ).attr({ 'type' : 'text', 'name' : 'ordem' + j }).css({ 'width' : '80px', 'text-align' : 'center' }).val( ordem );

                        var $hInput  =  $( '<input />' ).attr({ 'type' : 'hidden', 'name' : 'id' + j }).val( id );

                        var $tr      =  $( '<tr></tr>' );

                        var $td1     =  $( '<td></td>' ).text( subCat );

                        var $td2     =  $( '<td></td>' ).append( $input ).append( $hInput );

                        $tr.append( $td1 ).append( $td2 );

                        $( '#modalConfig' ).append( $tr );

                        j++;

                    };

                    $( '#qtd' ).val( data.length );

                }else {

                    $( '#modalConfig' ).find( 'tr' ).show();

                }

                $( '#modalConfigmenu' ).modal();

            }else if( code == 102 ) {

                var mess  =  data['message'];

                alerta( mess, 102 );

            }else {

                $( 'input[type=text]' ).prop( 'disabled', true );

                modalLogin();

            };  
            
        },error: function(request, status, error){

            alert( 'Ocorreu um erro' );

        }

    });
 
}


/**
* SECTION CLICK
*
*/
$( '.configurarCatMenu' ).click( function () {

    var qtd  =  $( 'input[type=checkbox].chkCategoria:checked' ).length

    if( qtd != 1 ) {

        alerta( 'Selecione 1 categoria', 102 );

    }else {

        var id    =  $( 'input[type=checkbox].chkCategoria:checked' ).attr( 'id' );

        var post  =  'idCat=' + id;

        getConfigMenuCategoria( post );        

    }    

});



$( '.deletarTagCategorias' ).click( function () {

    var post  =  '';

    var i     =  0;

    $( 'input[type=checkbox].chkItmSubCategoria' ).each( function () {

        if( $( this ).is( ':checked' ) ) {

            var id   =   $( this ).attr( 'id' );

            if( $.isNumeric( id ) ) {

                post  +=  'id' + i + '=' + $( this ).attr( 'id' ) + '&';

                i++;

            }

        }

    });

    if( i == 0 ) {

        alerta( 'Selecione uma ou mais tags válidas', 102 );

    }else {

        post  +=  'qtd=' + i;

        sendPost( baseUrlAjax + 'categorias/deletarTagsCategorias', post, true );

    }

});



$( '.deletarCategorias' ).click( function () {

    var post  =  '';

    var i     =  0;

    $( 'input[type=checkbox].chkCategoria' ).each( function () {

        if( $( this ).is( ':checked' ) ) {

            var id   =   $( this ).attr( 'id' );

            if( $.isNumeric( id ) ) {

                post  +=  'id' + i + '=' + $( this ).attr( 'id' ) + '&';

                i++;

            }

        }

    });

    if( i == 0 ) {

        alerta( 'Selecione uma ou mais categorias válidas', 102 );

    }else {

        post  +=  'qtd=' + i;

        sendPost( baseUrlAjax + 'categorias/deletarCategorias', post, true );

    }

});


$( '.editar-itmsubcategorias' ).click( function () {

    var qtd  =  $( 'input[type=checkbox].chkItmSubCategoria:checked' ).length

    if( qtd != 1 ) {

        alerta( 'Para editar, selecione apenas 1 tag por vez', 102 );

    }else {

        var id  =  $( 'input[type=checkbox].chkItmSubCategoria:checked' ).attr( 'id' );

        window.location.href  =  baseUrl + 'admin/categorias/editarTagCategoria/' + id;

    }

});


$( '.editar-categorias' ).click( function () {

    var qtd  =  $( 'input[type=checkbox].chkCategoria:checked' ).length

    if( qtd != 1 ) {

        alerta( 'Para editar, selecione apenas 1 categoria por vez', 102 );

    }else {

        var id  =  $( 'input[type=checkbox].chkCategoria:checked' ).attr( 'id' );

        window.location.href  =  baseUrl + 'admin/categorias/editarCategoria/' + id;

    }

});


$( '.deletarSubCategorias' ).click( function () {

    var post  =  '';

    var i     =  0;

    $( 'input[type=checkbox].chkSubCategoria' ).each( function () {

        if( $( this ).is( ':checked' ) ) {

            var id   =   $( this ).attr( 'id' );

            if( $.isNumeric( id ) ) {

                post  +=  'id' + i + '=' + $( this ).attr( 'id' ) + '&';

                i++;

            }

        }

    });

    if( i == 0 ) {

        alerta( 'Selecione uma ou mais Sub Categorias válidas', 102 );

    }else {

        post  +=  'qtd=' + i;

        sendPost( baseUrlAjax + 'categorias/deletarSubCategorias', post, true );

    }

});


$( '.editar-subcategorias' ).click( function () {

    var qtd  =  $( 'input[type=checkbox].chkSubCategoria:checked' ).length

    if( qtd > 1 || !$.isNumeric( qtd ) ) {

        alerta( 'Para editar, selecione apenas 1 Sub Categoria por vez', 102 );

    }else {

        var id  =  $( 'input[type=checkbox].chkSubCategoria:checked' ).attr( 'id' );

        window.location.href  =  baseUrl + 'admin/categorias/editarSubCategoria/' + id;

    }

});



/**
* SECTIONS CHANGE
*
* Manipula entradas do teclado
*
*
*/
$( 'select[name=categoria]' ).change( function () {

    var subCat  =  $( '#selecteSubCat' ).val();

    var id    =   $( this ).val();

    var post  =   'idCat=' + id;

    var url   =   baseUrlAjax + 'produtos/getSubCategorias';

    preencheSelect( $( 'select[name=subcategoria]' ) , url, post );

    if( $.trim( subCat ) != '' ) {

        setTimeout( function () {

            $( 'select[name=subcategoria]' ).selectpicker( 'val', $.trim( subCat ) );

        }, 1200);

    }

});

$( 'select[name=categoria]' ).trigger( 'change' );

