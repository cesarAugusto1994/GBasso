var sectionPagamento = 1;

var idComprador = '';

var cartoes = [];

var imgBandeira = '';

var bandeira = '';

var cvvSize = '';

var tokenCartao = '';

var parcSemJuros = 0;

var valorFrete = 0.00;

var valorSemFrete = 0.00;

var valorComFrete = 0.00;

var optPagseguro = {

    success: showPagseguroResponse,

    dataType: 'json'

};


function showPagseguroResponse(data, statusText, xhr, $form) {

    console.log(data);

    var code = data['code'];

    var mess = data['message'];

    $('.footer-modal-buttons').addClass('hidden');

    $('.modal-footer-pagseguro').addClass('relative no-padding');

    if (code == 100) {

        $('.message-container').removeClass('alert-danger').addClass('alert-success');

        var tipoPagto = $(':radio[name=tpPag]:checked').val();

        setTimeout(function() {

            $('.modal-footer-pagseguro').removeClass('relative no-padding');

            $('.message-container').addClass('hidden');

            $('.footer-modal-buttons').removeClass('hidden');

            //tipoPagto == 1 ? window.location.href  =  baseUrl + 'minha/conta/compras/detalhes/' + data['ref'] : null;

        }, 3500);

        if (tipoPagto == 2 || tipoPagto == 3) {

            var link = data['link'];

            var win = window.open(link, '_blank');

        }

    } else {

        $('.message-container').removeClass('alert-success').addClass('alert-danger');

        setTimeout(function() {

            $('.message-container').addClass('hidden');

            $('.footer-modal-buttons').removeClass('hidden');

            $('.modal-footer-pagseguro').removeClass('relative no-padding');

        }, 2400);

    }

    $('.message-container').removeClass('hidden').text(mess);

}


function getInstallments() {

    PagSeguroDirectPayment.getInstallments({
        amount: valorComFrete,
        maxInstallmentNoInterest: parcSemJuros,
        brand: bandeira,
        success: function(response) {
            console.log(response);
        },
        error: function(response) {
            console.log(response);
        },
        complete: function(response) {

            var error = response.error;

            if (!error) {

                var data = response['installments'][bandeira];

                $('#parcelas').html('');

                $.each(data, function(index, value) {

                    var qtd = value['quantity'];

                    var valor = value['installmentAmount'];

                    var $opt = $('<option />').val(qtd).attr('data-valor', value['installmentAmount']).text(qtd + 'x de ' + valor.format(2, 3, '.', ','));

                    $('#parcelas').append($opt);

                });

                $('#parcelas option:first').prop('selected', 'selected');

                $('#parcelas ').trigger('change');

                $('#parcelas').selectpicker('refresh');

            }

        }

    });
}


function createCardToken() {
    var ano = '20' + $("#ano").val();
    PagSeguroDirectPayment.createCardToken({
        brand: bandeira,
        cardNumber: $("#numCartao").val(),
        cvv: $("#codigoSeguranca").val(),
        expirationMonth: $("#mes").val(),
        expirationYear: ano,
        success: function(response) {
            console.log(response);
        },
        error: function(response) {
            console.log(response);
        },
        complete: function(response) {
            var success = typeof response.card != 'undefined' ? true : false;

            if (success) {

                tokenCartao = response.card.token;

                $('#cardToken').val(tokenCartao);

            }

        }

    });

}


function getPaymentMethods() {
    PagSeguroDirectPayment.getPaymentMethods({
        success: function(response) {
            //console.log( response );
        },
        error: function(response) {
            //console.log( response );
        },
        complete: function(response) {

            //console.log( response );

            var creditCard = response['paymentMethods']['CREDIT_CARD'];

            var i = 0;

            $.each(creditCard.options, function(index, value) {

                cartoes[i] = [];

                cartoes[i]['nome'] = value.displayName.toLowerCase();

                cartoes[i]['image'] = 'https://stc.pagseguro.uol.com.br' + value.images.SMALL.path;

                i++;

            });

            //console.log( cartoes );
        }
    });
}


function getBrand(bin) {
    PagSeguroDirectPayment.getBrand({
        cardBin: bin,
        success: function(response) {
            console.log(response);
        },
        error: function(response) {
            console.log(response);
        },
        complete: function(response) {

            console.log(response);

            var success = typeof response['brand'] != 'undefined' ? true : false;

            if (success) {

                bandeira = response.brand.name;

                cvvSize = response.brand.cvvSize;

                $('#codigoSeguranca').prop('maxlength', cvvSize);

                $.each(cartoes, function(index, value) {

                    if (value['nome'] == bandeira) {

                        imgBandeira = value['image'];

                        $('#imagemCartao').attr('src', imgBandeira);

                    }

                });

                $('.voltar').prop('disabled', false);

                $('.prosseguir').prop('disabled', false);

            } else {

                $('.voltar').prop('disabled', true);

                $('.prosseguir').prop('disabled', true);

            }
        }
    });
}


function getSessID() {

    $.ajax({

        type: 'POST',

        url: baseUrlAjaxCarrinho + 'getSessionIDPagseguro',

        dataType: 'json',

        success: function(data) {

            var code = data['code'];

            if (code == 100) {

                PagSeguroDirectPayment.setSessionId(data['id']);

                parcSemJuros = data['parcSemJuros'];

                valorSemFrete = parseFloat(data['semFrete']);

            }

            setTimeout(function() {

                idComprador = PagSeguroDirectPayment.getSenderHash();

                $('#senderHash').val(idComprador);

                $('.load-data-pagseguro').hide();

            }, 1000);

        },
        error: function(request, status, error) {

            alert('Ocorreu um erro');

        }

    });

}


function getValorFrete(post) {

    $.ajax({

        type: 'POST',

        url: baseUrl + 'ajax/carrinho/getValorFrete',

        data: post,

        dataType: 'json',

        success: function(data) {

            var error = typeof data['code'] != 'undefined' ? true : false;

            if (!error) {

                if (valorSemFrete > valorPagamento) {

                    $('.valorFrete').text('R$: ' + data['frete']);

                    valorFrete = data['cFrete'];

                } else {

                    $('.valorFrete').text('Grátis!!!');

                    valorFrete = 0.00;

                }

                valorComFrete = parseFloat(valorFrete) + parseFloat(valorPagamento);

                setTimeout(function() {

                    getInstallments();

                }, 100);

            } else {

                if (data['code'] == 102) {

                    alerta(data['message'], 102);

                    $('.valorFrete').text('Indisponível');

                } else {

                    window.location.href = baseUrl + 'minha/conta/login';

                }

            }

        },
        error: function(request, status, error) {

            alert('Ocorreu um erro');

        }

    });

}

function getValorFreteCarrinho(post) {

    $.ajax({

        type: 'POST',

        url: baseUrl + 'ajax/carrinho/getValorFreteCarrinho',

        data: post,

        dataType: 'json',

        success: function(data) {

            var error = typeof data['code'] != 'undefined' ? true : false;

            if (!error) {

                if (valorSemFrete > valorPagamento) {

                    $('.valorFrete').text('R$: ' + data['frete']);

                    valorFrete = data['cFrete'];

                } else {

                    $('.valorFrete').text('Grátis!!!');

                    valorFrete = 0.00;

                }

                valorComFrete = parseFloat(valorFrete) + parseFloat(valorPagamento);

                setTimeout(function() {

                    getInstallments();

                }, 100);

            } else {

                alerta(data['message'], 102);

                $('.valorFrete').text('Indisponível');

            }

        },
        error: function(request, status, error) {

            alert('Ocorreu um erro');

        }

    });

}



function prepareToGetValorFrete() {

    $('#servicoFrete').prop('disabled', false);

    $('#servicoFrete').selectpicker('val', 1).selectpicker('refresh');

    var cep = $('input[type=text][name=cepEntrega]').val();

    var servico = $('#servicoFrete').val();

    var post = 'cep=' + cep + '&servico=' + servico;

    getValorFrete(post);

}


$('.finalizarCompra').click(function() {

    getSessID();

    $('.load-data-pagseguro').show();

    $('#pagseguro_checkout_transparent').modal();

});


$(':radio[name=tpPag]').click(function() {

    var tipoPagto = $(':radio[name=tpPag]:checked').val();

    if (tipoPagto == 1) {

        $('.field-debito-online').hide();

        $('.field-boleto').hide();

        $('.field-cartao-credito').show();

    } else if (tipoPagto == 2) {

        $('.field-debito-online').hide();

        $('.field-cartao-credito').hide();

        $('.field-boleto').show();

    } else if (tipoPagto == 3) {

        $('.field-cartao-credito').hide();

        $('.field-boleto').hide();

        $('.field-debito-online').show();

    }

});


$('.prosseguir').click(function() {

    if (sectionPagamento == 2) {

        getPaymentMethods();

        var tipoPagto = $(':radio[name=tpPag]:checked').val();

        if (tipoPagto == 1) {

            $('.field-debito-online').hide();

            $('.field-boleto').hide();

            $('.field-cartao-credito').show();

        } else if (tipoPagto == 2) {

            $('.field-debito-online').hide();

            $('.field-cartao-credito').hide();

            $('.field-boleto').show();

        } else if (tipoPagto == 3) {

            $('.field-cartao-credito').hide();

            $('.field-boleto').hide();

            $('.field-debito-online').show();

        }

    }

    if (sectionPagamento < 3) {
        sectionPagamento++;
        $('.section-pagamento').addClass('hidden');
        $('.section-pagamento[data-section=' + sectionPagamento + ']').removeClass('hidden');
    } else {

        $('.formPagseguro').trigger('submit');

    }

});


$('.voltar').click(function() {

    sectionPagamento--;
    $('.section-pagamento').addClass('hidden');
    $('.section-pagamento[data-section=' + sectionPagamento + ']').removeClass('hidden');

});


$('#parcelas').change(function() {

    var valor = $('#parcelas option:selected').attr('data-valor');

    $('#parcelaValor').val(valor);

});


$('#numCartao').keyup(function() {

    var bin = $(this).val();

    if (bin.length == 8) {

        getBrand(bin);

    }

});


$('#codigoSeguranca').focusout(function() {

    var cvv = $(this).val();

    if (cvv.length == cvvSize) {

        getInstallments();

        createCardToken();

    }

});


$('#codigoSeguranca').keyup(function() {

    var cvv = $(this).val();

    if (cvv.length == cvvSize) {

        getInstallments();

        createCardToken();

    }

});


$('.formPagseguro').ajaxForm(optPagseguro);