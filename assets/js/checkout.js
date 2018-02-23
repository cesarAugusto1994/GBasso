function ReInserir() {
    $("#creditCardHolderName").val($("#senderName").val());
    $("#creditCardHolderCPF").val($("#senderCPF").val());
    $("#creditCardHolderAreaCode").val($("#senderAreaCode").val());
    $("#creditCardHolderPhone").val($("#senderPhoneNumber").val());
    $("#billingAddressPostalCode").val($("#shippingAddressPostalCode").val());
    $("#billingAddressStreet").val($("#shippingAddressStreet").val());
    $("#billingAddressNumber").val($("#shippingAddressNumber").val());
    $("#billingAddressComplement").val($("#shippingAddressComplement").val());
    $("#billingAddressDistrict").val($("#shippingAddressDistrict").val());
    $("#billingAddressCity").val($("#shippingAddressCity").val());
    //$("#billingAddressState").val($("#shippingAddressState").val());

    $('#billingAddressState option')
        .removeAttr('selected')
        .filter('[value="' + $("#shippingAddressState").val() + '"]')
        .attr('selected', true);

    $("#billingAddressCountry").val("BRA");
}

$(document).ready(function() {

    $("#creditCardHolderBirthDate").mask("99/99/9999");
    $("#senderCPF").mask("999.999.999-99");
    $("#creditCardHolderCPF").mask("999.999.999-99");
    $("#shippingAddressPostalCode").mask("99999-999");
    $("#billingAddressPostalCode").mask("99999-999");

    $("#senderAreaCode").mask("99");
    $("#senderPhoneNumber").mask("99999-9999");

    $('#boletoData').css('display', 'none');
    $('#creditCardData').css('display', 'none');

    $.ajax({
        type: 'GET',
        url: '/compras/session',
        cache: false,
        success: function(data) {
            PagSeguroDirectPayment.setSessionId(data);
            $("#session_id_field").val(data);
            $('#sender_hash').val(PagSeguroDirectPayment.getSenderHash());
        }
    });

    $('.campo-requerido').keypress(function() {

        const self = $(this);

        console.log('Action');

        self.parent().parent().removeClass('has-warning');
        self.parent().parent().find('.alert').html('');

    });

    $('.endereco-item').click(function() {
        $("#shippingAddressPostalCodeId").val($(this).data('cep-id'))
        $("#shippingAddressPostalCode").val($(this).data('cep'))
        $("#shippingAddressStreet").val($(this).data('end'))
        $("#shippingAddressDistrict").val($(this).data('bai'))
        $("#shippingAddressNumber").val($(this).data('num'))
        $("#shippingAddressComplement").val($(this).data('com'))
        $("#shippingAddressCity").val($(this).data('cid'))
            //$("#shippingAddressState").val($(this).data('est'))

        $('#shippingAddressState option')
            .removeAttr('selected')
            .filter('[value="' + $(this).data('est') + '"]')
            .attr('selected', true)

        $('#modal-enderecos').modal('hide');
    });

    var freteValor = window.localStorage.getItem('freteValor');
    $("#valorFrete").html(freteValor.replace(".", ','));

    var valorTotal = $("#totalValue").html().replace(',', ".");
    $("#totalValue").html((+valorTotal + +freteValor).toFixed(2).replace(".", ','))

    $('#cardNumber').blur(function() {
        brandCard();
    });


    function parcelasDisponiveis() {
        PagSeguroDirectPayment.getInstallments({
            amount: (($("#totalValue").html()).replace(",", ".")),
            brand: $("#creditCardBrand").val(),
            maxInstallmentNoInterest: $("#parcelas-sem-juros").val(),

            success: function(response) {
                //console.log(response.installments);
                $("#installmentsWrapper").css('display', "block");


                var installments = response.installments[$("#creditCardBrand").val()];

                var options = '';
                for (var i in installments) {

                    var optionItem = installments[i];
                    var optionQuantity = optionItem.quantity;
                    var optionAmount = optionItem.installmentAmount;
                    var optionLabel = (optionQuantity + " x R$ " + (optionAmount.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,').replace(".", ',')));

                    options += ('<option value="' + optionItem.quantity + '" totalAmount="' + optionItem.totalAmount + '" valorparcela="' + optionAmount + '">' + optionLabel + '</option>');

                };

                $("#installmentQuantity").html(options);
                $("#installmentValue").val(installments[0].installmentAmount);
                $("#totalAmount").val(installments[0].totalAmount);

            },

            error: function(response) {
                console.log(response);
            },

            complete: function(response) {}
        });
    }

    $("#installmentQuantity").change(function() {
        var option = $(this).find("option:selected");
        if (option.length) {
            $("#installmentValue").val(option.attr("valorparcela"));
            $("#totalAmount").val(option.attr("totalAmount"));
        }
    });

    function brandCard() {

        PagSeguroDirectPayment.getBrand({
            cardBin: $("#cardNumber").val(),
            success: function(response) {
                $("#creditCardBrand").val(response.brand.name);
                $("#cardNumber").css('border', '1px solid #999');

                if (response.brand.expirable) {
                    $("#expiraCartao").css('display', 'block');
                } else {
                    $("#expiraCartao").css('display', 'none');
                }
                if (response.brand.cvvSize > 0) {
                    $("#cvvCartao").css('display', 'block');
                } else {
                    $("#cvvCartao").css('display', 'none');
                }

                $("#bandeiraCartao").attr('src', 'https://stc.pagseguro.uol.com.br/public/img/payment-methods-flags/68x30/' + response.brand.name + '.png');


                parcelasDisponiveis();

            },

            error: function(response) {
                $("#cardNumber").css('border', '2px solid red');
                $("#cardNumber").focus();
            },

            complete: function(response) {

            }

        });

    }

    function tratarError(id) {
        if (id.charAt(0) == '2') id = id.substr(1);
        if (id == "53020" || id == '53021') {
            $("#modal-body").append("<p>Verifique telefone inserido</p>");
            $("#senderPhoneNumber").css('border', '2px solid red');

        } else if (id == "53010" || id == '53011' || id == '53012') {
            $("#modal-body").append("<p>Verifique o e-mail inserido</p>");
            $("#senderEmail").css('border', '2px solid red');

        } else if (id == "53017") {
            $("#modal-body").append("<p>Verifique o CPF inserido</p>");
            $("#senderCPF").css('border', '2px solid red');

        } else if (id == "53018" || id == "53019") {
            $("#modal-body").append("<p>Verifique o DDD inserido</p>");
            $("#senderAreaCode").css('border', '2px solid red');

        } else if (id == "53013" || id == '53014' || id == '53015') {
            $("#modal-body").append("<p>Verifique o nome inserido</p>");
            $("#senderName").css('border', '2px solid red');

        } else if (id == "53029" || id == '53030') {
            $("#modal-body").append("<p>Verifique o bairro inserido</p>");
            $("#shippingAddressDistrict").css('border', '2px solid red');

        } else if (id == "53022" || id == '53023') {
            $("#modal-body").append("<p>Verifique o CEP inserido</p>");
            $("#shippingAddressPostalCode").css('border', '2px solid red');

        } else if (id == "53024" || id == '53025') {
            $("#modal-body").append("<p>Verifique a rua inserido</p>");
            $("#shippingAddressStreet").css('border', '2px solid red');

        } else if (id == "53026" || id == '53027') {
            $("#modal-body").append("<p>Verifique o número inserido</p>");
            $("#shippingAddressNumber").css('border', '2px solid red');

        } else if (id == "53033" || id == '53034') {
            $("#modal-body").append("<p>Verifique o estado inserido</p>");
            $("#shippingAddressState").css('border', '2px solid red');

        } else if (id == "53031" || id == '53032') {
            $("#modal-body").append("<p>Verifique a cidade informada</p>");
            $("#shippingAddressCity").css('border', '2px solid red');

        } else if (id == '10001') {
            $("#modal-body").append("<p>Verifique o número do cartão inserido</p>");
            $("#cardNumber").css('border', '2px solid red');

        } else if (id == '10002' || id == '30405') {
            $("#modal-body").append("<p>Verifique a data de validade do cartão inserido</p>");
            $("#cardExpirationMonth").css('border', '2px solid red');
            $("#cardExpirationYear").css('border', '2px solid red');

        } else if (id == '10004') {
            $("#modal-body").append("<p>É obrigatorio informar o código de segurança, que se encontra no verso, do cartão</p>");
            $("#cardCvv").css('border', '2px solid red');

        } else if (id == '10006' || id == '10003' || id == '53037') {
            $("#modal-body").append("<p>Verifique o código de segurança do cartão informado</p>");
            $("#cardCvv").css('border', '2px solid red');

        } else if (id == '30404') {
            $("#modal-body").append("<p>Ocorreu um erro. Atualize a página e tente novamente!</p>");

        } else if (id == '53047') {
            $("#modal-body").append("<p>Verifique a data de nascimento do titular do cartão informada</p>");
            $("#creditCardHolderBirthDate").css('border', '2px solid red');

        } else if (id == '53053' || id == '53054') {
            $("#modal-body").append("<p>Verifique o CEP inserido</p>");
            $("#billingAddressPostalCode").css('border', '2px solid red');

        } else if (id == '53055' || id == '53056') {
            $("#modal-body").append("<p>Verifique a rua inserido</p>");
            $("#billingAddressStreet").css('border', '2px solid red');

        } else if (id == '53042' || id == '53043' || id == '53044') {
            $("#modal-body").append("<p>Verifique o nome inserido</p>");
            $("#creditCardHolderName").css('border', '2px solid red');

        } else if (id == '53057' || id == '53058') {
            $("#modal-body").append("<p>Verifique o número inserido</p>");
            $("#billingAddressNumber").css('border', '2px solid red');

        } else if (id == '53062' || id == '53063') {
            $("#modal-body").append("<p>Verifique a cidade informada</p>");
            $("#billingAddressCity").css('border', '2px solid red');

        } else if (id == '53045' || id == '53046') {
            $("#modal-body").append("<p>Verifique o CPF inserido</p>");
            $("#creditCardHolderCPF").css('border', '2px solid red');

        } else if (id == '53060' || id == '53061') {
            $("#modal-body").append("<p>Verifique o bairro inserido</p>");
            $("#billingAddressDistrict").css('border', '2px solid red');

        } else if (id == '53064' || id == '53065') {
            $("#modal-body").append("<p>Verifique o estado inserido</p>");
            $("#billingAddressState").css('border', '2px solid red');

        } else if (id == '53051' || id == '53052') {
            $("#modal-body").append("<p>Verifique telefone inserido</p>");
            $("#billingAddressState").css('border', '2px solid red');

        } else if (id == '53049' || id == '53050') {
            $("#modal-body").append("<p>Verifique o código de área informado</p>");
            $("#creditCardHolderAreaCode").css('border', '2px solid red');

        } else if (id == '53122') {
            $("#modal-body").append("<p>Enquanto na sandbox do PagSeguro, o e-mail deve ter o domínio '@sandbox.pagseguro.com.br' (ex.: comprador@sandbox.pagseguro.com.br)</p>");

        }

        // else {
        //   $("#modal-body").append("<p>"+ id + "</p>");
        // }
    }

    $('#boletoButton').click(function(e) {

        var telefone = $("#senderPhoneNumber");
        var ddd = $("#senderAreaCode");

        if (!ddd.val()) {
            e.preventDefault();
            ddd.focus();
            alerta('Informe o DDD do Telefone', 'error');

            return false;
        }

        if (!telefone.val()) {
            e.preventDefault();
            telefone.focus();
            alerta('Informe o Telefone', 'error');
            return false;
        }

        showModal();

        e.preventDefault();

        $.ajax({
            type: 'POST',
            url: '/compras/checkout/pagamentoboleto',
            cache: false,
            data: {
                id: $("#session_id_field").val(),
                email: $("#senderEmail").val(),
                nome: $("#senderName").val(),
                cpf: $("#senderCPF").val(),
                ddd: $("#senderAreaCode").val(),
                //ddd: $("#senderAreaCode").val(),
                telefone: $("#senderPhoneNumber").val(),
                cep: $("#shippingAddressPostalCode").val(),
                endereco: $("#shippingAddressStreet").val(),
                numero: $("#shippingAddressNumber").val(),
                complemento: $("#shippingAddressComplement").val(),
                bairro: $("#shippingAddressDistrict").val(),
                cidade: $("#shippingAddressCity").val(),
                estado: $("#shippingAddressState").val(),
                pais: "BRA",
                senderHash: PagSeguroDirectPayment.getSenderHash(),
                tpPag: 2,
                gateway: 1,
                cep: $("#shippingAddressPostalCode").val(),
                enderecoId: $("#shippingAddressPostalCodeId").val(),
                servico: window.localStorage.getItem('freteId'),
            },
            success: function(data) {

                console.log(data);

                if (!(data.link)) {
                    //alert(data);
                    $("#modal-title").html("<font color='red'>Erro</font>");

                    $("#modal-body").html(data.message);

                    //console.log(data.error);
                    $.each(data.error, function(index, value) {

                        if (value.code) {
                            //console.log("6 " + value.code);
                            tratarError(value.code);
                        } else {
                            //console.log("7 " + data.error);
                            tratarError(data.error.code);
                        }

                    });
                } else {

                    setTimeout(function() {

                        window.location.href = 'http://www.grupobasso.com.br/compras/checkout/compra-finalizada?link=' + data.link;

                        $("#modal-body").html("");
                        $("#modal-title").html("<font color='green'>Sucesso!</font>")

                        $("#modal-body").html("Sua compra foi finalizada com sucesso, estamos aguardando a confirmação da operadora.<br /><br /><p>Caso você não seja redirecionado para o seu boleto, clique no botão abaixo.</p><br /><br /><a href='" + data.link + "'><center><br /><br /><button class='btn-success btn-block btn-lg'>Ir para o meu boleto</button></center></a>");
                    }, 3500);
                }

            }
        });

    });

    function showModal() {
        $("#modal-title").html("Aguarde");
        $("#modal-body").html("");
        $("#aguarde").modal("show");
    }

    function camposRequeridos() {

        const msg = 'Este campo é requerido.';

        var cardNumber = $("#cardNumber");
        var cardExpirationMonth = $("#cardExpirationMonth");
        var cardExpirationYear = $("#cardExpirationYear");
        var cardCvv = $("#cardCvv");
        var installmentQuantity = $("#installmentQuantity");
        var creditCardHolderBirthDate = $("#creditCardHolderBirthDate");

        var campos = [cardNumber, cardExpirationMonth, cardExpirationYear, cardCvv, installmentQuantity, creditCardHolderBirthDate];
        var prosseguir = true;

        $.each(campos, function(i, campo) {

            if (!campo.val()) {
                showAlert(msg, 501)
                campo.addClass('campo-requerido');
                campo.parent().parent().addClass('has-warning');
                campo.parent().append('<div class="alert alert-danger">' + msg + '</div>');
                campo.focus();
                prosseguir = false;
            }

        });

        return prosseguir;

    }

    function showAlert(msg, code) {

        var classe = (code == 100) ? 'success' : 'error';

        var notification = alertify.notify(msg, classe, 5, function() {});

    }

    function pagarCartao(senderHash) {

        var podeProsseguir = camposRequeridos();

        if (!podeProsseguir) {
            return false;
        }

        showModal();

        PagSeguroDirectPayment.createCardToken({

            cardNumber: $("#cardNumber").val(),
            brand: $("#creditCardBrand").val(),
            cvv: $("#cardCvv").val(),
            expirationMonth: $("#cardExpirationMonth").val(),
            expirationYear: $("#cardExpirationYear").val(),

            success: function(response) {
                $("#creditCardToken").val(response.card.token);

                $.ajax({
                    type: 'POST',
                    url: '/compras/checkout/pagamentocartao',
                    cache: false,
                    data: {
                        id: $("#session_id_field").val(),
                        email: $("#senderEmail").val(),
                        nome: $("#senderName").val(),
                        cpf: $("#senderCPF").val(),
                        ddd: $("#senderAreaCode").val(),
                        telefone: $("#senderPhoneNumber").val(),
                        cep: $("#shippingAddressPostalCode").val(),
                        endereco: $("#shippingAddressStreet").val(),
                        numero: $("#shippingAddressNumber").val(),
                        complemento: $("#shippingAddressComplement").val(),
                        bairro: $("#shippingAddressDistrict").val(),
                        cidade: $("#shippingAddressCity").val(),
                        estado: $("#shippingAddressState").val(),
                        pais: "BRA",
                        senderHash: senderHash,

                        enderecoPagamento: $("#billingAddressStreet").val(),
                        numeroPagamento: $("#billingAddressNumber").val(),
                        complementoPagamento: $("#billingAddressComplement").val(),
                        bairroPagamento: $("#billingAddressDistrict").val(),
                        cepPagamento: $("#billingAddressPostalCode").val(),
                        cidadePagamento: $("#billingAddressCity").val(),
                        estadoPagamento: $("#billingAddressState").val(),
                        cardToken: $("#creditCardToken").val(),
                        cardNome: $("#creditCardHolderName").val(),
                        cardCPF: $("#creditCardHolderCPF").val(),
                        cardNasc: $("#creditCardHolderBirthDate").val(),
                        cardFoneArea: $("#creditCardHolderAreaCode").val(),
                        cardFoneNum: $("#creditCardHolderPhone").val(),

                        numParcelas: $("#installmentQuantity").val(),
                        valorParcelas: $("#installmentValue").val(),

                        tpPag: 1,
                        enderecoId: $("#shippingAddressPostalCodeId").val(),
                        servico: window.localStorage.getItem('freteId'),

                        total: $("#totalValue").html().replace(',', ".")
                    },
                    success: function(data) {
                        //console.log(data);
                        if (data.error) {
                            console.log(data.error)
                            if (data.error.code == "53037") {
                                $("#creditCardPaymentButton").click();
                            } else {
                                $("#modal-title").html("<font color='red'>Erro</font>");

                                $("#modal-body").html("");
                                $.each(data.error, function(index, value) {
                                        if (value.code) {
                                            tratarError(value.code);

                                        } else {
                                            tratarError(data.error.code)
                                        }
                                    })
                                    //console.log("2 " + data);
                            }
                        } else {

                            $("#venda-finalizada").val(1);


                            $.ajax({
                                type: 'POST',
                                url: '/compras/session',
                                cache: false,
                                data: {
                                    id: data.code,
                                },
                                success: function(status) {

                                    if (status == "7") {
                                        //alert(data);
                                        $("#modal-title").html("<font color='red'>Erro</font>");

                                        $("#modal-body").html("Erro ao processar o seu pagamento.<br/> Não se preocupe pois esse valor <b>não será debitado de sua conta ou não constará em sua fatura</b><br /><br />Verifique se você possui limite suficiente para efetuar a transação e/ou tente um cartão diferente");

                                    } else {
                                        //window.location = "http://www.grupobasso.com.br/minha/conta/compras";
                                        window.location.href = 'http://www.grupobasso.com.br/compras/checkout/compra-finalizada?type=credit-card';
                                        setTimeout(function() {
                                            $("#modal-body").html("");
                                            $("#modal-title").html("<font color='green'>Sucesso!</font>")

                                            $("#modal-body").html("Caso você não seja redirecionado para a nossa página de instruções, clique no botão abaixo.<br /><br /><a href='http://www.grupobasso.com.br/compras/checkout/compra-finalizada?type=credit-card'><center><button class='btn-success btn-block btn-lg'>Ir para a página de minhas compras</button></center></a>");
                                        }, 1500);
                                    }

                                }
                            });

                        }

                    }

                });
            },
            error: function(response) {
                if (response.error) {
                    $("#modal-title").html("<font color='red'>Erro</font>");

                    $("#modal-body").html("");
                    //console.log("4" + response);
                    $.each(response.errors, function(index, value) {
                        //console.log(value);
                        tratarError(value);
                    });
                }
            },
            complete: function(response) {

            }

        });

    }

    $('#creditCardPaymentButton').click(function(e) {

        var telefone = $("#senderPhoneNumber");
        var ddd = $("#senderAreaCode");

        if (!ddd.val()) {
            e.preventDefault();
            ddd.focus();
            alerta('Informe o DDD do Telefone', 'error');

            return false;
        }

        if (!telefone.val()) {
            e.preventDefault();
            telefone.focus();
            alerta('Informe o Telefone', 'error');

            return false;
        }

        pagarCartao(PagSeguroDirectPayment.getSenderHash());
    });

    $("input[name='changePaymentMethod']").on('click', function(e) {
        if (e.currentTarget.value == 'creditCard') {
            $('#boletoData').css('display', 'none');
            $('#creditCardData').css('display', 'block');
        } else if (e.currentTarget.value == 'boleto') {
            $('#creditCardData').css('display', 'none');
            $('#boletoData').css('display', 'block');
        }
    });

    $("input[name='holderType']").on('click', function(e) {
        if (e.currentTarget.value == 'sameHolder') {
            $('#dadosOtherPagador').css('display', 'none');
            $("#creditCardHolderBirthDate").val($("#nascimento").val());
            ReInserir();
        } else if (e.currentTarget.value == 'otherHolder') {
            $('#dadosOtherPagador').css('display', 'block');
        }
    });

    $("input[type='text']").on('blur', function(e) {
        if (($("#" + e.currentTarget.id).css('border') == '2px solid rgb(255, 0, 0)') || ($("#" + e.currentTarget.id).css('border') == '2px solid red')) {
            $("#" + e.currentTarget.id).css('border', '1px solid #999');
        }
    });

    $('#aguarde').on('hidden.bs.modal', function() {
        if ($("#venda-finalizada").val() == 1) {
            window.location.reload();
        }
    });

});