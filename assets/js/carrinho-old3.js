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

                }, 3500);

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


$('#informarCep').change(function() {

    new PNotify({
        title: 'Aguarde...',
        text: 'Buscando Valores de Frete',
        type: 'info',
        styling: 'fontawesome'
    });

    var cep = $(this).val();

    var servico = $('#servicoFreteCarrinho').val();

    if ($.trim(servico) != '') {

        var post = 'cep=' + cep + '&servico=' + servico;

        getValorFrete(post);

    }

});

$('#servicoFreteCarrinho').change(function(e) {

    new PNotify({
        title: 'Aguarde...',
        text: 'Buscando Valores de Frete',
        type: 'info',
        styling: 'fontawesome'
    });

    var cep = $('#informarCep').val();

    var servico = $(this).val();

    if ($.trim(servico) != '') {

        var post = 'cep=' + cep + '&servico=' + servico;

        getValorFrete(post);

    }

});


$('#servicoFrete').change(function() {
    alert('changer')

    var cep = $('input[type=text][name=cepEntregaCarrinho]').val();

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

$('.btn-carrinho-2').click(function() {

    if (page == 'resultbusca') {
        var qtd = 1;
    } else {
        var qtd = $('#quantity-relacionados').val();
    }

    var id = $(this).attr('data-id');

    if (isInt(qtd) && qtd > 0) {

        var post = 'id=' + id + '&qtd=' + qtd;

        addCarrinho(post);

    } else {

        alert('Quantidade inválida');

    }

});

$('.change-quantity').change(function() {

    var qtd = $(this).val();

    qtd = qtd > 0 ? qtd : 1;

    var id = $(this).attr('data-id');

    if (isInt(qtd) && qtd > 0) {

        var post = 'id=' + id + '&qtd=' + qtd;

        addCarrinho(post);

        setTimeout(function() {
            window.location.reload();
        }, 1500);

    } else {

        alert('Quantidade inválida');

    }

});

function tratarQuantidade() {

    minValue = parseInt($(this).attr('min'));
    maxValue = parseInt($(this).attr('max'));
    valueCurrent = parseInt($(this).val());


    alert(valueCurrent);

    name = $(this).attr('name');
    if (valueCurrent >= minValue) {
        $(".btn-number[data-type='minus'][data-field='" + name + "']").removeAttr('disabled')
    } else {
        alert('Sorry, the minimum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    if (valueCurrent <= maxValue) {
        $(".btn-number[data-type='plus'][data-field='" + name + "']").removeAttr('disabled')
    } else {
        alert('Sorry, the maximum value was reached');
        $(this).val($(this).data('oldValue'));
    }
}

$('.btn-number').click(function(e) {
    e.preventDefault();

    fieldName = $(this).attr('data-field');
    type = $(this).attr('data-type');
    var input = $("input[name='" + fieldName + "']");
    var currentVal = parseInt(input.val());
    if (!isNaN(currentVal)) {
        if (type == 'minus') {

            if (currentVal > input.attr('min')) {
                input.val(currentVal - 1).change();
            }
            if (parseInt(input.val()) == input.attr('min')) {
                $(this).attr('disabled', true);
            }

        } else if (type == 'plus') {

            if (currentVal < input.attr('max')) {
                input.val(currentVal + 1).change();
            }
            if (parseInt(input.val()) == input.attr('max')) {
                $(this).attr('disabled', true);
            }

        }
    } else {
        input.val(0);
    }
});
$('.input-number').focusin(function() {
    $(this).data('oldValue', $(this).val());
});
$('.input-number').change(function() {

    minValue = parseInt($(this).attr('min'));
    maxValue = parseInt($(this).attr('max'));
    valueCurrent = parseInt($(this).val());

    name = $(this).attr('name');
    if (valueCurrent >= minValue) {
        $(".btn-number[data-type='minus'][data-field='" + name + "']").removeAttr('disabled')
    } else {
        alert('Sorry, the minimum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    if (valueCurrent <= maxValue) {
        $(".btn-number[data-type='plus'][data-field='" + name + "']").removeAttr('disabled')
    } else {
        alert('Sorry, the maximum value was reached');
        $(this).val($(this).data('oldValue'));
    }


});
$(".input-number").keydown(function(e) {
    // Allow: backspace, delete, tab, escape, enter and .
    if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
        // Allow: Ctrl+A
        (e.keyCode == 65 && e.ctrlKey === true) ||
        // Allow: home, end, left, right
        (e.keyCode >= 35 && e.keyCode <= 39)) {
        // let it happen, don't do anything
        return;
    }
    // Ensure that it is a number and stop the keypress
    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
        e.preventDefault();
    }
});

$('.btn-carrinho-relacionados').click(function() {

    if (page == 'resultbusca') {
        var qtd = 1;
    } else {
        var qtd = $('#quantity-relacionados').val();
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