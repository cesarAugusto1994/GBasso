/**
* OPtions para enviar formulários
*
**/
var opt = {
    success:   gravarBanners,
    dataType:  'json'
};

$( '.cadastrar-banner' ).ajaxForm( opt );


/**
* SECTIONS FUNCTION
*
* 
*
*
*/
function gravarBanners(data, statusText, xhr, $form)  {

    var code  =  data['code'];    

    if( code == 100 ) {

        var id    =  data['id'];

        window.location.href  =  baseUrl + 'admin/banners/visualizar/imagens/' + id;

    }else if( code == 102 ) {

        var mess  =  data['message'];

        alerta( mess, 102 );

    }else {

        $( 'input[type=text]' ).prop( 'disabled', true );

        modalLogin();

    };  

}


function deletarBanners( post ) {

    $.ajax({

        type: 'POST',

        url: baseUrlAjax + 'banners/deletarBanners',

        data: post,

        dataType: 'json',

        success: function( data ) {

            var code  =  data['code'];

            var mess  =  data['message'];

            if( code == 100 ) {

                alerta( mess, 100 );

                $( 'input[type=checkbox].imgDeleteBanner:checked' ).each( function () {

                    $( this ).parent().parent().parent().fadeOut( 1000 ).delay( 2000 ).remove();

                });

            }else if( code == 102 ) {

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


function salvarOrdem( post ) {

    $.ajax({

        type: 'POST',

        url: baseUrlAjax + 'banners/salvarOrdem',

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

            alert( 'Ocorreu um erro' );

        }

    });
 
}


/** SECTION CLICK **/
$( 'input[type=checkbox].chkBanners' ).click( function () {

    if( $( this ).is( ':checked' ) ) {

        $( '#visualizarBanners' ).find( 'input[type=checkbox].chkBanners' ).not( this ).prop({ 'checked' : false });

    }else {

        $( 'input[type=checkbox].chkBanners' ).prop({ 'checked' : false });

    }

});

$( '.deletarImagemBanner' ).click( function () {

    var qtd  =   $( 'input[type=checkbox].imgDeleteBanner:checked' ).length;

    if( qtd > 0 ) {

        var i     =  0;

        var post  =  '';

        $( 'input[type=checkbox].imgDeleteBanner:checked' ).each( function () {

            var id  =  $( this ).attr( 'id' );

            post   +=  'id' + i + '=' + id + '&';

            i++;

        });

        post  +=  'qtd=' + qtd;

        deletarBanners( post );

    }else {

        alerta( 'Selecione no mínimo 1 ou mais imagens para deletar', 102 );

    }

});

$( '.visualizarImagensBanners' ).click( function () {

    var qtd  =   $( 'input[type=checkbox].chkBanners:checked' ).length;

    if( qtd > 0 ) {

        var id  =  $( 'input[type=checkbox].chkBanners:checked' ).attr( 'id' );

        window.location.href  =  baseUrl + 'admin/banners/visualizar/imagens/' + id;

    }else {

        alerta( 'Selecione no máximo 1 linha', 102 );

    }


});


/** SECTION KEY UP **/
$( 'input[type=text].setOrdemBanner' ).keyup( function () {

    var ordem  =   $( this ).val();

    var id     =   $( this ).attr( 'id' );

    if( !$.isNumeric( ordem ) || ordem < 1 ) {

        alerta( 'A ordem necessita ser um número inteiro maior que 0', 102 );

    }else {

        var post  =  'id=' + id + '&ordem=' + ordem;

        salvarOrdem( post );

    }

});


/** SECTION CHANGE **/
$( '.localBanner' ).change( function () {

    var banner  =  $( this ).val();

    if( banner == 1 ) {

        $( '#imagens' ).prop( 'multiple', true );

    }else {

        $( '#imagens' ).prop( 'multiple', false );

    }

});




























