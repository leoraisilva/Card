function alteracao(valorClicado) {
    document.querySelectorAll('.Organizador, .Participante, .Visitante, .Reports, .AccountAdd, .Logout').forEach(function(selecionado) {
        selecionado.classList.remove('active');
        var item = selecionado.getAttribute('data-item');
        var manter = selecionado.classList.contains('active');
        localStorage.setItem(item, manter);
    });

    valorClicado.classList.add('active');
    var item = valorClicado.getAttribute('data-item');
    var manter = valorClicado.classList.contains('active');
    localStorage.setItem(item, manter.toString());

    var nomeValorClicado = valorClicado.classList.item(0);

    window.history.pushState({}, '', '?opcao=' + nomeValorClicado);
    location.reload();
}

document.querySelectorAll('.Organizador, .Participante, .Visitante, .Reports, .AccountAdd, .Logout').forEach(function(valor_presente) {
    valor_presente.addEventListener('click', function() {
        alteracao(valor_presente);
    });

    var item = valor_presente.getAttribute('data-item');
    var manter = localStorage.getItem(item);
    
    if (manter === 'true') {
        valor_presente.classList.add('active');
    }
});

document.addEventListener('DOMContentLoaded', function() {
    var parametro = new URLSearchParams(window.location.search);
    var classeURL = parametro.get('classe');

    if (classeURL) {
        document.querySelector('.' + classeURL).classList.add('active');
    }
});