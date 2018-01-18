
/**
 * SECTION FOR FUNCTIONS
 *
 */
function getInfoRastreio( post ) {

    $.ajax({

        type: 'POST',

        url: baseUrl + 'admin/ajax/vendas/getInfoRastreio',

        data: post,

        dataType: 'json',

        success: function( data ) {

		    var error  =  typeof data['code'] != 'undefined' ? true : false;

		    console.log( data );

		    if( !error ) {

		    	$( '.tbodyRastreamento' ).find( 'tr' ).not( ':first' ).remove();

		    	$( '.tbodyRastreamento' ).find( 'tr' ).hide();

		    	if( data.length > 0 ) {		    		

		    		for (var i = 0; i < data.length; i++) {

		    			var $tr    =   $( '<tr></tr>' );
		    			
		    			var $td1   =   $( '<td></td>' ).html( data[i]['data'] );

		    			var $td2   =   $( '<td></td>' ).html( data[i]['local'] );

		    			var $td3   =   $( '<td></td>' ).html( data[i]['situacao'] );

		    			$tr.append( $td1 ).append( $td2 ).append( $td3 );

		    			$( '.tbodyRastreamento' ).append( $tr );

		    		}

		    	}else {

		    		$( '.tbodyRastreamento' ).find( 'tr' ).show();

		    	}

		    	$( '#infoRastreio' ).modal();

		    }else {

		    	var code  =  data['code'];

				if( code == 102 ) {

			        var mess  =  data['message'];

			        alerta( mess, 102 );

			    }else if( code == 103 ) {

			        modalLogin();

			    };  

		    }

        },error: function(request, status, error){

        	alert( 'Ocorreu um erro' );

        }

    });
 
}

function setCodigoRastreamento( post ) {

    $.ajax({

        type: 'POST',

        url: baseUrl + 'admin/ajax/vendas/setCodigoRastreamento',

        data: post,

        dataType: 'json',

        success: function( data ) {

		    var code  =  data['code'];

		    var mess  =  data['message'];

		    if( code == 100 ) {

		    	$( '.msg-inserir-rastreio' ).text( mess ).removeClass( 'hidden' );

		    	$( '.button-inserir-codigo' ).addClass( 'hidden' );

		    	setTimeout( function () {

		    		$( '.msg-inserir-rastreio' ).addClass( 'hidden' );

		    		$( '.button-inserir-codigo' ).removeClass( 'hidden' );

		    		$( '#inserirCodeRastreamento' ).trigger( 'click' );

		    	}, 2400);		    	

		    }else if( code == 102 ) {		        

		        alerta( mess, 102 );

		    }else if( code == 103 ) {

		        modalLogin();

		    }

        },error: function(request, status, error){

        	alert( 'Ocorreu um erro' );

        }

    });
 
}

function getInfoVendas( post ) {

    $.ajax({

        type: 'POST',

        url: baseUrl + 'admin/ajax/vendas/getInfoVendas',

        data: post,

        dataType: 'json',

        success: function( data ) {

		    var code  =  data['code'];

		    if( code == 100 ) {

		    	$( '.list-produtos' ).find( '.dados-compra' ).not( ':first' ).remove();

		    	var produtos  =   data['produtos'];

	    		var nome      =   data['nome'];

	    		var cpf       =   data['cpf'];

	    		var email     =   data['email'];

	    		$( '.nome' ).text( nome );

	    		$( '.cpf' ).text( cpf );

	    		$( '.email' ).text( email );

				$( '.cep').text( data['endereco'][0]['cep'] );

				$( '.endereco').text( data['endereco'][0]['end'] + ', ' + data['endereco'][0]['num'] + ' compl.: ' + data['endereco'][0]['com'] );

				$( '.bairro').text( data['endereco'][0]['bai'] );

				$( '.cidade').text( data['endereco'][0]['cid'] + ' ' + data['endereco'][0]['est'] );

				$( '.servico').text( data['servico'] );

	    		for (var i = 0; i < produtos.length; i++) {

	    			var $div   =   i == 0  ? $( '.dados-compra:last' ) : $( '.dados-compra:last' ).clone();

	    			var nome    =   produtos[i]['name'];

	    			var valor   =   produtos[i]['valo'];

	    			var qtde    =   produtos[i]['qtd'];

	    			$div.find( '.nome-produto' ).text( nome );

	    			$div.find( '.qtd-produtos' ).text( qtde );

	    			$div.find( '.valor-produtos' ).text( valor );

	    			if( i != 0 ) {

	    				$( '.list-produtos' ).append( $div );

	    			}

	    		}


	    		$( '#infoVenda' ).modal();

		    }else if( code == 102 ) {

		    	var mess  =  data['message'];

		        alerta( mess, 102 );

		    }else if( code == 103 ) {

		        modalLogin();

		    }

        },error: function(request, status, error){

        	alert( 'Ocorreu um erro' );

        }

    });
 
}


/**
 * SECTION FOR CLICK
 *
 */
$( '.rastrear' ).click( function () {

	var qtd  =   $( 'input[type=checkbox].selectVendas:checked' ).length;

	if( qtd == 1 ) {

		var post  =  'id=' + $( 'input[type=checkbox].selectVendas:checked' ).attr( 'id' );

		getInfoRastreio( post );
		
	}else {

		alerta( 'Selecione apenas 1 venda para rastrear', 102 );

	}

});

$( '.codigoRastreamento' ).click( function () {

	var qtd  =   $( 'input[type=checkbox].selectVendas:checked' ).length;

	if( qtd == 1 ) {

		$( '#inserirCodeRastreamento' ).modal();
		
	}else {

		alerta( 'Selecione apenas 1 venda por vez', 102 );

	}	

});


$( '.salvarCodigoRastreio' ).click( function () {

	var qtd  =   $( 'input[type=checkbox].selectVendas:checked' ).length;

	if( qtd == 1 ) {

		var post  =  'id=' + $( 'input[type=checkbox].selectVendas:checked' ).attr( 'id' );

		post     +=  '&code=' + $( '#codeRastreamento' ).val();

		setCodigoRastreamento( post );
		
	}else {

		closeAllModal();

		alerta( 'Selecione apenas 1 venda por vez', 102 );

	}	

});


$( '.infoVendas' ).click( function () {

	var qtd  =   $( 'input[type=checkbox].selectVendas:checked' ).length;

	if( qtd == 1 ) {

		var post  =  'id=' + $( 'input[type=checkbox].selectVendas:checked' ).attr( 'id' );

		getInfoVendas( post );
		
	}else {

		closeAllModal();

		alerta( 'Selecione apenas 1 venda por vez', 102 );

	}	

});



