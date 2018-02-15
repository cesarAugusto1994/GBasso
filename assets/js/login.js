var opt1 = {

    success: showResponse1,

    dataType: 'json'

};

var opt2 = {

    success: showResponse2,

    dataType: 'json'

};

var opt3 = {

    success: showResponse3,

    dataType: 'json'

};

$('.formCadastro').ajaxForm(opt1);

$('.formLogin').ajaxForm(opt2);

$('.formLoginCheckout').ajaxForm(opt3);

function showResponse1(data, statusText, xhr, $form) {

    var message = data['message'];

    var code = data['code'];

    $('.alert').removeClass('hidden');

    if (code == 100) {

        alerta(message, 100);

        setTimeout(function() {

            window.location.href = 'http://www.grupobasso.com.br/minha/conta/login';

        }, 2400);

    } else {

        alerta(message, 102);

    }

    $('.alert').text(message).fadeIn().delay(4000).fadeOut();

}

function showResponse2(data, statusText, xhr, $form) {

    var message = data['message'];

    var code = data['code'];

    $('.alert').removeClass('hidden');

    if (code == 100) {

        alerta(message, 100);

        setTimeout(function() {

            window.location.href = baseUrl + 'minha/conta/inicio';

        }, 2400);

    } else {

        alerta(message, 102);

    }

    $('.alert').text(message).fadeIn().delay(4000).fadeOut();

}

function showResponse3(data, statusText, xhr, $form) {

    var message = data['message'];

    var code = data['code'];

    $('.alert').removeClass('hidden');

    if (code == 100) {

        alerta(message, 100);

        setTimeout(function() {

            window.location.href = '/compras/checkout';

        }, 2400);

    } else {

        alerta(message, 102);

    }

    $('.alert').text(message).fadeIn().delay(4000).fadeOut();

}

/** SECTION FOCUSOUT **/
$('#email').focusout(function() {

    var email = $(this).val();

    if ($.trim(email) != '') {

        $('#userLogin').val(email);

    }

});
