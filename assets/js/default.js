function alerta(message, code) {
    var classe = (code == 100) ? 'alert alert-succes' : 'alert alert-danger';
    var newClass = (code == 100) ? 'success' : 'error';
    var newClassLabel = (code == 100) ? 'Sucesso' : 'Erro';
    //$('#alert-message').attr('class', classe).text(message);
    //$('#alert-only').modal();
    //setTimeout(function() {
    //$('#alert-only').trigger('click');
    //}, 2400);

    /*
    new PNotify({
        title: newClassLabel + '!',
        text: message,
        type: newClass,
        styling: 'fontawesome'
    });
    */

    var notification = alertify.notify(message, newClass, 2, function() { console.log('dismissed'); });

}
/*
$('.btn-search-reset').click(function() {
    var selected = $('.btn-search-reset').find('option:selected').text();
    var text = $('.pesquisar-data').val();
    window.location.href = baseUrl + 'pesquisar/resultado/' + selected + '/' + text + '/1';
});
*/
$('.pesquisar-data').keypress(function(e) {
    if (e.which == 13) {
        var selected = $('.btn-search-reset').find('option:selected').text();
        var text = $('.pesquisar-data').val();
        window.location.href = baseUrl + 'pesquisar/resultado/' + selected + '/' + text + '/1';
    }
});

$('.btn-search-reset').change(function() {
    var selected = $('.btn-search-reset').find('option:selected').text();
    var text = $('.pesquisar-data').val();
    window.location.href = baseUrl + 'pesquisar/resultado/' + selected + '/' + text + '/1';
})

$(document).ready(function() {

    $('.item-pesquisa').mouseover(function() {
        $(this).find('.container-quantidade').show();
        $(this).find('.container-add-carrinho').show();
    });

    $('.item-pesquisa').mouseleave(function() {
        $(this).find('.container-quantidade').hide();
        $(this).find('.container-add-carrinho').hide();
    });

});