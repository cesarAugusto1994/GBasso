$( 'input[name=cep]' ).mask( '99999-999' );

$( 'input[name=cpf]' ).mask( '999.999.999-99' );

var op1 = {

    success:   showResponse1,

    dataType:  'json'

}; 

/*
* SECTION FUNCTIONS
*
*/
$( '.salvarEndereco' ).ajaxForm( op1 );

function showResponse1(data, statusText, xhr, $form)  {

    var message  =  data['message'];

    var code     =  data['code'];

    if( code == 100 ) {

        alerta( message, 100 );

        setTimeout( function () {

            window.location.reload( true );

        },  2400);

    }else {

        alerta( message, 102 );

    }

}

function getCompras() {

    $.ajax({

        type: 'POST',

        url: baseUrlAjax + 'minha/conta/getCompras',

        dataType: 'json',

        success: function( data ) {

            var code  =  data['code'];

            if( code == 100 ) {

                var data  =   data['data'];

                if( data.length > 0 ) {

                    $( '.compras > tr' ).hide();

                    $( '.compras' ).find( 'tr' ).not( ':first' ).remove();

                    for (var i = data.length - 1; i >= 0; i-- ) {

                        var $tr   =  $( '<tr></tr>' ).attr({ 'id' : data[i]['valu'], 'class' : 'tr-minhaconta', 'title' : 'Visualizar detalhes da venda', 'data-ref' : data[i]['refe'] });

                        var $td1  =  $( '<td></td>' ).text( data[i]['refe'] );

                        var $td2  =  $( '<td></td>' ).text( data[i]['stat'] );

                        var $td3  =  $( '<td></td>' ).text( data[i]['valo'] );

                        var $td4  =  $( '<td></td>' ).text( data[i]['data'] );                        

                        if( page ==  'compras' ) {

                            var $td5  =  $( '<td></td>' ).text( data[i]['fret'] );

                            $tr.append( $td1 ).append( $td2 ).append( $td5 ).append( $td3 ).append( $td4 );

                        }else {

                            $tr.append( $td1 ).append( $td2 ).append( $td3 ).append( $td4 );

                        }

                        $( '.compras' ).append( $tr );

                    }

                }

            }else {

                window.location.href  =  baseUrl + 'minha/conta/login';

            }

        },error: function(request, status, error){

        	alert( 'Ocorreu um erro' );

        }

    });
 
}

function getDetalhesCompra( post ) {

    $.ajax({

        type: 'POST',

        url: baseUrlAjax + 'minha/conta/getDetalheCompra',

        data: post,

        dataType: 'json',

        success: function( data ) {

            var code  =  data['code'];

            if( code == 100 ) {

                var produtos  =  data['prod'];

                var data      =  data['data'];

                $( '.produtosVenda, .compras' ).html( '' );

                if( data.length > 0 && produtos.length > 0 ) {

                    for (var i = data.length - 1; i >= 0; i--) {

                        var $tr   =  $( '<tr></tr>' );

                        var $td1  =  $( '<td></td>' ).text( data[i]['refe'] );

                        var $td2  =  $( '<td></td>' ).text( data[i]['stat'] );

                        var $td3  =  $( '<td></td>' ).text( data[i]['valo'] );

                        var $td4  =  $( '<td></td>' ).text( data[i]['data'] );

                        $tr.append( $td1 ).append( $td2 ).append( $td3 ).append( $td4 );

                        $( '.compras' ).html( $tr );

                    }

                    for (var i = produtos.length - 1; i >= 0; i--) {
                        
                        var $tr   =  $( '<tr></tr>' );

                        var $td1  =  $( '<td></td>' ).text( produtos[i]['code'] );

                        var $td2  =  $( '<td></td>' ).text( produtos[i]['name'] );

                        var $td3  =  $( '<td></td>' ).text( produtos[i]['valo'] );

                        $tr.append( $td1 ).append( $td2 ).append( $td3 );

                        $( '.produtosVenda' ).append( $tr );

                    }

                }

            }else if( code == 102 ) {

                alerta( data['message'], 102 );

            }else {

                window.location.href  =  baseUrl + 'minha/conta/login';

            }

        },error: function(request, status, error){

            alert( 'Ocorreu um erro' );

        }

    });
 
}

function getCep( post ) {

    $.ajax({

        type: 'POST',

        url: baseUrlAjax + 'minha/conta/getCep',

        data: post,

        dataType: 'json',

        success: function( data ) {

            var code  =  typeof data['code'] != 'undefined' ? false : true ;            

            if( code && typeof data['end'] != 'undefined' ) {

                var cep  =  data;

                $( 'input[name=endereco]' ).val( cep['end'] );

                $( 'input[name=bairro]' ).val( cep['bai'] );

                $( 'input[name=cidade]' ).val( cep['cid'] );

                $( 'input[name=estado]' ).val( cep['est'] );

            }else {

                alerta( 'Cep não encontrado', 102 );

            }

        },error: function(request, status, error){

            alert( 'Ocorreu um erro' );

        }

    });
 
}

function getCepById( post ) {

    $.ajax({

        type: 'POST',

        url: baseUrlAjax + 'minha/conta/getEnderecoById',

        data: post,

        dataType: 'json',

        success: function( data ) {

            if( typeof data[0]['end'] != 'undefined' ) {

                var cep  =  data[0];

                $( 'input[name=cep]' ).val( cep['cep'] );

                $( 'input[name=endereco]' ).val( cep['end'] );

                $( 'input[name=bairro]' ).val( cep['bai'] );

                $( 'input[name=cidade]' ).val( cep['cid'] );

                $( 'input[name=estado]' ).val( cep['est'] );

                $( 'input[name=numero]' ).val( cep['num'] );

                $( 'input[name=comple]' ).val( cep['com'] );

                $( 'input[name=destinatario]' ).val( cep['des'] );

                $( 'input[name=pontoReferencia]' ).val( cep['ptr'] );

                principal   =   cep['pri'] == 'Sim' ? true : false;

                $( 'input[type=checkbox][name=principal]' ).prop( 'checked', principal );

                $( '.salvarEndereco' ).attr( 'action', baseUrlAjax + 'minha/conta/atualizar/endereco' );                

                $( '#modal_endereco' ).modal();

            }else if( typeof data['code'] != 'undefined' && data['code'] == 102 ) {

                alerta( 'Endereço inválido', 102 );

            }else {

                window.location.href  =  baseUrl + 'minha/conta/login';

            }

        },error: function(request, status, error){

            alert( 'Ocorreu um erro' );

        }

    });
 
}

function deletarEnderecos( post ) {

    $.ajax({

        type: 'POST',

        url: baseUrlAjax + 'minha/conta/deletarEnderecos',

        data: post,

        dataType: 'json',

        success: function( data ) {

            if( data['code'] == 100 ) {

                alerta( data['message'], 100 );

                setTimeout( function () {

                    window.location.reload( true );

                }, 2400);

            }else if( data['code'] == 102 ) {

                alerta( data['message'], 102 );

            }else {

                window.location.href  =  baseUrl + 'minha/conta/login';

            }

        },error: function(request, status, error){

            alert( 'Ocorreu um erro' );

        }

    });
 
}



/*
* SECTION CLICK
*
*/
$( '.deletarEndereco' ).click( function () {

    var qtd  =  $( 'input[type=checkbox].chkEndereco:checked' ).length;

    if( qtd > 0 ) {

        var post  =  'qtd=' + qtd;

        var i     =  0;

        $( 'input[type=checkbox].chkEndereco:checked' ).each( function () {

            post +=  '&id' + i + '=' + $( this ).attr( 'id' );

            i++;

        });

        deletarEnderecos( post );

    }else {

        alerta( 'Selecione no mínimo 1 endereço', 102 );

    }
});

$( '.editarEndereco' ).click( function () {

    var qtd  =  $( 'input[type=checkbox].chkEndereco:checked' ).length;

    if( qtd == 1 ) {

        var id    =   $( 'input[type=checkbox].chkEndereco:checked' ).attr( 'id' );

        var post  =   'id=' + id;

        $( '#idEndereco' ).val( id );

        getCepById( post );

    }else {

        alerta( 'Selecione apenas 1 endereço por vez', 102 );

    }

});

$( document ).on( 'click', '.tr-minhaconta', function () {

    var ref  =  $( this ).attr( 'data-ref' );

    window.location.href  =  baseUrl + 'minha/conta/compras/detalhes/' + ref;

});

$( '.cancelar-atualizacao' ).click( function () {

    window.location.href  =  baseurl + 'minha/conta';

});

$( '.novoEndereco' ).click( function () {

    $( '.modal-endereco-header' ).text( 'Novo Endereço' );

    $( '.salvarEndereco' ).attr( 'action', baseUrlAjax + 'minha/conta/novo/endereco' );

    $( '#modal_endereco' ).modal();

});



/*
* SECTION KEY UP
*
*/
$( 'input[name=cep]' ).keyup( function () {

    var cep  =  $( this ).val().replace(/[^0-9]/g,'' );

    if( cep.length == 8 ) {

        var post  =  'cep=' + cep;

        getCep( post );

    }

});


/**
* Executa os métodos com base no parametro PAGE que determina qual a página está sendo acessada
*
*/
if( page == 'home' ) {

    getCompras();

}else if( page == 'detalhes-compras' ) {

    var post  =  'ref=' + $.trim( $( '.breadcrumb >li:last' ).text() );

    getDetalhesCompra( post );

}else if( page ==  'compras' ) {

    getCompras();

}












