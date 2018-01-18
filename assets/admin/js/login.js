var opt = {

    success:   showResponse,

    dataType:  'json'

}; 

$( '.form-login' ).ajaxForm( opt );

function showResponse(data, statusText, xhr, $form)  {

    var message  =  data['message'];

    var code     =  data['code'];

    $( '.alert' ).removeClass( 'hidden' );

    if( code == 100 || code == 101 ) {

    	$( '.alert' ).removeClass( 'alert-danger' ).addClass( 'alert-success' );

	    setTimeout( function () {

            if( code == 100 )
	    	    window.location.href  =  baseUrl + 'admin';
            else
                $( '.modal' ).trigger( 'click' );

	    }, 2400);

    }else {

    	$( '.alert' ).removeClass( 'alert-success' ).addClass( 'alert-danger' );

    }

    $( '.alert' ).text( message ).fadeIn().delay( 4000 ).fadeOut();

}