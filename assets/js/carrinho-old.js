function isInt(str) {
    return /^\+?(0|[1-9]\d*)$/.test(str);
}


function getDataCarrinho(post) {

    $.ajax({

        type: 'POST',

        url: baseUrl + 'ajax/carrinho/getDataCarrinho',

        data: post,

        dataType: 'json',

        success: function(data) {

            $('.data-carrinho').text(data['qtd'] + data['total']);

        },
        error: function(request, status, error) {
            console.log("Status: " + status + "\n" + "Error: " + error);
            //alert('Ocorreu um erro 1');

        }

    });

}


function addCarrinho(post) {

    $.ajax({

        type: 'POST',

        url: baseUrl + 'ajax/carrinho_site/add',

        data: post,

        dataType: 'json',

        success: function(data) {

            var code = data['code'];

            var message = data['message'];

            if (code == 100) {

                $('.data-carrinho').text(data['qtd'] + data['total']);

                alerta(message, code);

            } else if (code == 102) {

                alerta(message, code);

            }

        },
        error: function(request, status, error) {

            console.log("Status: " + status + "\n" + "Error: " + error);

        }

    });

}


function deletarItemCarrinho(post) {

    $.ajax({

        type: 'POST',

        url: baseUrlAjaxCarrinho + 'deletar',

        data: post,

        dataType: 'json',

        success: function(data) {

            if (data['code'] == 100) {

                alerta(data['message'], 100);

                setTimeout(function() {

                    window.location.reload(true);

                }, 2000);

            } else {

                alerta(data['message'], 102);

            }

        },
        error: function(request, status, error) {

            console.log("Status: " + status + "\n" + "Error: " + error);

        }

    });

}


function getEnderecosCadastrados(post) {

    $.ajax({

        type: 'POST',

        url: baseUrl + 'ajax/minha/conta/getEnderecosCadastrados',

        data: post,

        dataType: 'json',

        success: function(data) {

            var code = typeof data['code'] != 'undefined' ? false : true;

            $('.selecioneEnderecos').find('tr').not(':first').remove();

            $('.selecioneEnderecos').find('tr').hide();

            if (code) {

                if (data.length > 0) {

                    for (var i = data.length - 1; i >= 0; i--) {

                        var $tr = $('<tr></tr>').addClass('trEndereco').attr('id', data[i]['val']);

                        var $td1 = $('<td></td>').text(data[i]['cep']);

                        var $td2 = $('<td></td>').text(data[i]['end']);

                        var $td3 = $('<td></td>').text(data[i]['bai']);

                        var $td4 = $('<td></td>').text(data[i]['num']);

                        var $td5 = $('<td></td>').text(data[i]['com']);

                        var $td6 = $('<td></td>').text(data[i]['cid'] + ' - ' + data[i]['est']);

                        $tr.append($td1).append($td2).append($td3).append($td4).append($td5).append($td6);

                        $('.selecioneEnderecos').append($tr);

                    }

                } else {

                    $('.selecioneEnderecos').find('tr').show();

                }

            } else {

                $('.selecioneEnderecos').find('tr').show();

            }

        },
        error: function(request, status, error) {

            console.log("Status: " + status + "\n" + "Error: " + error);

        }

    });

}


$('#servicoFrete').change(function() {

    var cep = $('input[type=text][name=cepEntrega]').val();

    var servico = $('#servicoFrete').val();

    if ($.trim(servico) != '') {

        var post = 'cep=' + cep + '&servico=' + servico;

        getValorFrete(post);

    }

});


$('.btn-carrinho').click(function() {

    if (page == 'resultbusca') {
        var qtd = 1;
    } else {
        var qtd = $('#quantity').val();
    }

    var id = $(this).attr('data-id');

    if (isInt(qtd) && qtd > 0) {

        var post = 'id=' + id + '&qtd=' + qtd;

        addCarrinho(post);

    } else {

        alert('Quantidade inválida');

    }

});


$('input[type=checkbox]#chkCarrinhoAll').click(function() {

    if ($(this).is(':checked')) {
        $('.chkCarrinho').prop('checked', true);
        $('.deletarProduto').prop('disabled', false);
    } else {
        $('.chkCarrinho').prop('checked', false);
        $('.deletarProduto').prop('disabled', true);
    }

});


$('input[type=checkbox].chkCarrinho').click(function() {

    var qtd = $('input[type=checkbox].chkCarrinho:checked').length;

    if (qtd > 0) {
        $('.deletarProduto').prop('disabled', false);
    } else {
        $('.deletarProduto').prop('disabled', true);
    }

});


$('.deletarProduto').click(function() {

    var i = 0;

    var post = '';

    $('input[type=checkbox].chkCarrinho:checked').each(function() {

        post += 'id' + i + '=' + $(this).attr('id') + '&';

        i++;

    });

    post += 'qtd=' + i;

    deletarItemCarrinho(post);

});


$('span.selectEndereco').click(function() {

    $('.section-pagamento').addClass('hidden');

    $('.section-endereco').removeClass('hidden');

    getEnderecosCadastrados();

});


$(document).on('click', '.trEndereco', function() {

    var idEndereco = $(this).attr('id');

    var $td = $(this).find('td');

    $('input[type=text][name=cepEntrega]').val($td.eq(0).text());

    $('span.enderecoEntrega').text($td.eq(1).text() + ' ' + $td.eq(2).text() + ' ' + $td.eq(5).text());

    $('input[type=text][name=numero]').val($td.eq(3).text());

    $('input[type=text][name=complemento]').val($td.eq(4).text());

    $('.section-endereco').addClass('hidden');

    $('.section-pagamento[data-section=2]').removeClass('hidden');

    $('#idEndereco').val(idEndereco);

    prepareToGetValorFrete();

});


getDataCarrinho();