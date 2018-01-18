/**
* Options para enviar formulários
*
**/
var opt = {

    success:   gravarConfig,

    dataType:  'json'  

}; 

$( '.form-config' ).ajaxForm( opt );

$( 'input[type=text].parcelas' ).mask( '99' );

$( 'input[type=text].cep' ).mask( '99999-999' );

/**
 * SECTIONS FUNCTION
 *
 */
function gravarConfig(data, statusText, xhr, $form)  {

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

}


/**
 * Section for click
 *
 */
 $( 'input[type=text].parcelas' ).keyup( function () {

    var valor  =   $( this ).val();

    $( '.exemplo-parcela' ).text( valor + 'x sem juros' );

 })






