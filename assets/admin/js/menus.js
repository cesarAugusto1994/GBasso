/** SECTION FUNCTION **/
var opt = {

    success:   gravarMenu,

    dataType:  'json'

};

$( '.cadastrar-menu' ).ajaxForm( opt );

function gravarMenu(data, statusText, xhr, $form)  {

    var code  =  data['code'];

    if( code == 100 ) {

        var mess  =  data['message'];

        showMessageInModal( mess, 100 );

        setTimeout( function () {

	    	$( $form ).get( 0 ).reset();

	    	$( $form ).find( 'select' ).selectpicker( 'refresh' );    	
	    	
        	$( '.closeModal' ).trigger( 'click' );

        	window.location.reload( true );

        }, 3000);
    	
    }else if( code == 102 ) {

        var mess  =  data['message'];

        showMessageInModal( mess, 102 );

    }else {

        $( 'input[type=text]' ).prop( 'disabled', true );

        modalLogin();

    };  

}


/** SECTION CLICK **/
$( '.cadMenu' ).click( function () {

	$( '#cadastrarMenu' ).modal();

});

$( '.cadSubMenu' ).click( function () {

	$( '#cadastrarSubMenu' ).modal();

});

$( '.cadItemMenu' ).click( function () {

	$( '#cadastrarItemMenu' ).modal();

});



$( '.editarMenu' ).click( function () {

	var qtd  =  $( 'input[type=checkbox].chkEditarMenu:checked' ).length;

	if( qtd != 1 ) {

		alerta( 'Selecione apenas 1 item para ser editado' );

	}else {

		var $tr     =   $( 'input[type=checkbox].chkEditarMenu:checked' ).parent().parent();	

		var id      =   $( 'input[type=checkbox].chkEditarMenu:checked' ).attr( 'id' );

		var nome    =   $tr.find( 'td:eq(1)' ).text();

		var link    =   $tr.find( 'td:eq(2)' ).text();

		var desc    =   $tr.find( 'td:eq(3)' ).text();

		var ordem   =   $tr.find( 'td:eq(4)' ).text();

		var status  =   $tr.find( 'td:eq(5)' ).text();

		status      =   $.trim( status ) == 'Ativo' ? 1 : 0;

		$( 'input[name=nome]' ).val( nome );

		$( 'input[name=link]' ).val( link );

		$( 'input[name=descricao]' ).val( desc );

		$( 'input[name=ordem]' ).val( ordem );

		$( 'select[name=status]' ).selectpicker( 'val', status );

		$( '#idMenu' ).val( id );

		$( '#cadastrarMenu' ).modal();

	}

});


$( '.editarSubMenu' ).click( function () {

	var qtd  =  $( 'input[type=checkbox].chkEditarSubMenu:checked' ).length;

	if( qtd != 1 ) {

		alerta( 'Selecione apenas 1 item para ser editado' );

	}else {

		var $tr     =   $( 'input[type=checkbox].chkEditarSubMenu:checked' ).parent().parent();	

		var id      =   $( 'input[type=checkbox].chkEditarSubMenu:checked' ).attr( 'id' );

		var menu    =   $tr.find( 'td:eq(1)' ).text();

		var nome    =   $tr.find( 'td:eq(2)' ).text();

		var link    =   $tr.find( 'td:eq(3)' ).text();		

		var ordem   =   $tr.find( 'td:eq(4)' ).text();

		var status  =   $tr.find( 'td:eq(5)' ).text();

		status      =   $.trim( status ) == 'Ativo' ? 1 : 0;

		$( 'input[name=nome]' ).val( nome );

		$( 'input[name=link]' ).val( link );

		$( 'input[name=ordem]' ).val( ordem );

		var menu  =  $('select[name=menu] option').filter( function () { return $( this ).html() == menu; }).val();

		$( 'select[name=menu]' ).selectpicker( 'val', menu );

		$( 'select[name=status]' ).selectpicker( 'val', status );

		$( '#idSubMenu' ).val( id );

		$( '#cadastrarSubMenu' ).modal();

	}

});


$( '.editarItemMenu' ).click( function () {

	var qtd  =  $( 'input[type=checkbox].chkEditarItemMenu:checked' ).length;

	if( qtd != 1 ) {

		alerta( 'Selecione apenas 1 item para ser editado' );

	}else {

		var $tr     =   $( 'input[type=checkbox].chkEditarItemMenu:checked' ).parent().parent();	

		var id      =   $( 'input[type=checkbox].chkEditarItemMenu:checked' ).attr( 'id' );

		var menu    =   $tr.find( 'td:eq(1)' ).text();

		var nome    =   $tr.find( 'td:eq(2)' ).text();

		var link    =   $tr.find( 'td:eq(3)' ).text();		

		var ordem   =   $tr.find( 'td:eq(4)' ).text();

		var status  =   $tr.find( 'td:eq(5)' ).text();

		status      =   $.trim( status ) == 'Ativo' ? 1 : 0;

		$( 'input[name=nome]' ).val( nome );

		$( 'input[name=link]' ).val( link );

		$( 'input[name=ordem]' ).val( ordem );

		var menu  =  $('select[name=submenu] option').filter( function () { return $( this ).html() == menu; }).val();

		$( 'select[name=submenu]' ).selectpicker( 'val', menu );

		$( 'select[name=status]' ).selectpicker( 'val', status );

		$( '#idItemMenu' ).val( id );

		$( '#cadastrarItemMenu' ).modal();

	}

});


$( '.deletarMenu' ).click( function () {

	var qtd  =  $( 'input[type=checkbox].chkEditarMenu:checked' ).length;

	if( qtd < 1 ) {

		alerta( 'Selecione 1 ou mais itens para deletar' );

	}else {

		var post  =   '';

		var i     =   0;

		$( 'input[type=checkbox].chkEditarMenu:checked' ).each( function () {

			post +=  'id' + i + '=' + $( this ).attr( 'id' ) + '&';

			i++;

		});

		post  +=  'qtd=' + i;

		sendPost( baseUrlAjax + 'menus/deletarMenus', post, true );

	}

});


$( '.deletarSubMenu' ).click( function () {

	var qtd  =  $( 'input[type=checkbox].chkEditarSubMenu:checked' ).length;

	if( qtd < 1 ) {

		alerta( 'Selecione 1 ou mais itens para deletar' );

	}else {

		var post  =   '';

		var i     =   0;

		$( 'input[type=checkbox].chkEditarSubMenu:checked' ).each( function () {

			post +=  'id' + i + '=' + $( this ).attr( 'id' ) + '&';

			i++;

		});

		post  +=  'qtd=' + i;

		sendPost( baseUrlAjax + 'menus/deletarSubMenus', post, true );

	}

});

$( '.deletarItemMenu' ).click( function () {

	var qtd  =  $( 'input[type=checkbox].chkEditarItemMenu:checked' ).length;

	if( qtd < 1 ) {

		alerta( 'Selecione 1 ou mais itens para deletar' );

	}else {

		var post  =   '';

		var i     =   0;

		$( 'input[type=checkbox].chkEditarItemMenu:checked' ).each( function () {

			post +=  'id' + i + '=' + $( this ).attr( 'id' ) + '&';

			i++;

		});

		post  +=  'qtd=' + i;

		sendPost( baseUrlAjax + 'menus/deletarItemMenus', post, true );

	}

});
























