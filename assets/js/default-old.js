function alerta(message, code) {
    var classe = (code == 100) ? 'alert alert-succes' : 'alert alert-danger';
    $('#alert-message').attr('class', classe).text(message);
    $('#alert-only').modal();
    setTimeout(function() {
        $('#alert-only').trigger('click');
    }, 2400);
}

$('.btn-search-reset').click(function() {
    var selected = $('.btn-search-reset').find('option:selected').text();
    var text = $('.pesquisar-data').val();
    window.location.href = baseUrl + 'pesquisar/resultado/' + selected + '/' + text + '/1';
});

$('.pesquisar-data').keypress(function(e) {
    if (e.which == 13) {
        var selected = $('.btn-search-reset').find('option:selected').text();
        var text = $('.pesquisar-data').val();
        window.location.href = baseUrl + 'pesquisar/resultado/' + selected + '/' + text + '/1';
    }
});