/**
* SECTION VARIABLES GLOBALS
* Todas as variáveis globais padrões para o sistema
*
**/
var heightScreen  =   $( window ).height();

//Obtem a altura do menu do top
var heightMenu    =   $( '.navbar-default' ).height() + 2;

//Variável guarda o nome de um método para que possa ser executado depois que uma determinada tarefa for realizada
var execFunction  =   '';



/**
* SECTION VERIFY PLUGIN IS LOADED
* Verifica se um plugin está carregado
*
**/
if( jQuery().filestyle ) {

    $( ':file' ).filestyle({ icon: false });

    $( 'div.bootstrap-filestyle' ).children().val( 'Selecione as imagens' );  

   	$( 'span.group-span-filestyle' ).children().addClass( 'btn btn-primary' ).text( 'Selecione' );

}


if( jQuery().priceFormat ) {

    $( 'input[type=text].money' ).priceFormat({     
        limit: 10,
        centsLimit: 2, 
        prefix: '', 
        suffix: '',
        centsSeparator: ',', 
        thousandsSeparator: '.',
        allowNegative: false
    });

}


/** 
* SECTION MODAIS 
* Todos os métodos chamados para inicializar qualquer modal
*
**/
function modalLogin() {

	$( '#alert_login_required' ).modal();

    $( 'input[type=text]' ).prop( 'disabled', false );

}


function alerta( message, code ) {

    var classe  =  ( code == 100 ) ? 'alert alert-succes' : 'alert alert-danger';

    $( '#alert-message' ).attr( 'class', classe ).text( message );

    $( '#alert-only' ).modal();

}

function closeAllModal() {
    $( '.modal' ).hide( 'false' );
}



/** 
* SECTION DEFAULT 
* Todos os métodos chamados para inicializar qualquer modal
*
**/

//Seta a ultura padrão para a DIV que contém os formulários do sistema
$( '#page-wrapper' ).css({ 'min-height' : heightScreen - heightMenu });

//Monitora se o navegador está sendo redimencionado, e altera a altura da div
$( window ).bind( 'resize', function () {

	heightScreen  =   $( window ).height();

	$( '#page-wrapper' ).css({ 'min-height' : heightScreen - heightMenu });

});


/** Preenche um select com dados retornados do banco de dados **/
function preencheSelect( $select, urlAction, formDataSend ) {

    $.ajax({

        type: 'POST',

        url: urlAction,

        data: formDataSend,

        dataType: 'json',

        success: function( data ) {

            var code  =   (typeof data['code'] != 'indefined' ) ? data['code'] : false;

            if( typeof code != "boolean" ) {

                $select.find( 'option' ).not( ':first' ).remove();

            	if( data.length > 0 ) {

            		for( var i = 0; i < data.length; i++ ) {

            			var $option  =  $( '<option />' ).val( data[i]['value'] ).text( data[i]['text'] )

            			$select.append( $option );

            		}

            		$select.prop( 'disabled', false );        		

            	}

            	$select.selectpicker( 'refresh' );

            }else if( code == 102 ) {

                var message   =   data['message'];

                alerta( message, code );

            }else {

                $( 'input[type=text]' ).prop( 'disabled', true );

                modalLogin();

            };

            
        },error: function(request, status, error){

        	alert( 'Ocorreu um erro' );

        }

    });
 
}



function createListGroupTipos( text, myClass, id ) {

	var $li  =  $( '<li></li>' ).addClass( myClass );

	$li.attr( 'id', id );

	$li.text( text );

	return $li;

};


/** Cria uma lista com os dados pesquisados nos campos da lista de tipos **/
function getListas( $element, text, myClass, urlAction, formDataSend ) {

    $.ajax({

        type: 'POST',

        url: urlAction,

        data: formDataSend,

        dataType: 'json',

        success: function( data ) {

			var code  =   (typeof data['code'] != 'indefined' ) ? data['code'] : false;

			if( typeof code != "boolean" ) {

                $element.html( '' );               

				if( data.length > 0 ) {

					for (var i = 0; i < data.length; i++) {

						var $li   =   createListGroupTipos( data[i]['text'], myClass, data[i]['value'] );
						
						$element.append( $li );

					};

				}else {

					var $li  =  createListGroupTipos( text, myClass, 0 );
					
					$element.append( $li );

				};

				$element.parent().parent().removeClass( 'hidden' );				

			}else {

				$element.parent().parent().addClass( 'hidden' );

                $( 'input[type=text]' ).prop( 'disabled', true );

                modalLogin();

			};
            
        },error: function(request, status, error){

        	alert( 'Ocorreu um erro' );

        }

    });
 
}



/** Envia dados via POST **/
function sendPost( urlAction, formDataSend, refresh ) {

    $.ajax({

        type: 'POST',

        url: urlAction,

        data: formDataSend,

        dataType: 'json',

        success: function( data ) {

            var code  =   data['code'];

            var mess  =   data['message'];

            if( code == 100 ) {
                
                alerta( mess, 100  );

                if( refresh ) {

                    setTimeout( function () {
                        window.location.reload( true );
                    }, 2000);

                }

            }else if( code == 102 ) {

                alerta( mess, 102  );

            }else {

                $element.parent().parent().addClass( 'hidden' );

                $( 'input[type=text]' ).prop( 'disabled', true );

                modalLogin();

            };
            
        },error: function(request, status, error){

            alert( 'Ocorreu um erro' );

        }

    });
 
}


function showMessageInModal( message, code ) {

    var $footerPanel  =  $( '.message-alert' ).parent();

    var alertClass    =  code == 100 ? 'message-alert alert alert-success' : 'message-alert alert alert-danger';

    $( '.message-alert' ).attr( 'class', alertClass ).text( message );

    $footerPanel.addClass( 'no-padding' );

    $footerPanel.find( 'div' ).addClass( 'hidden' );

    $footerPanel.find( 'p' ).removeClass( 'hidden' );

    setTimeout( function () {

        $footerPanel.find( 'p' ).addClass( 'hidden' );

        $footerPanel.find( 'div' ).removeClass( 'hidden' );

        $footerPanel.removeClass( 'no-padding' );

    }, 3000);

}












 