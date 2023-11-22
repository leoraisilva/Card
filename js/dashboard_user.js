function alteracao(valorSelecionado) {
    document.querySelectorAll('.Perfil, .Cards, .Favorito, .Report, .Configuracao, .Logout').forEach(function(valor) {
        valor.classList.remove('active');
        var item = valor.getAttribute('data-item');
        var manter = valor.classList.contains('active');
        localStorage.setItem(item, manter);
    });

    valorSelecionado.classList.add('active');
    var item = valorSelecionado.getAttribute('data-item');
    var manter = valorSelecionado.classList.contains('active');
    localStorage.setItem(item, manter.toString());

    var nomeValorClicado = valorSelecionado.classList.item(0);

    window.history.pushState({}, '', '?opcao=' + nomeValorClicado);
    location.reload();
}

document.querySelectorAll('.Perfil, .Cards, .Favorito, .Report, .Configuracao, .Logout').forEach(function(vlw_presente) {
    vlw_presente.addEventListener('click', function() {
        alteracao(vlw_presente);
    });

    var item = vlw_presente.getAttribute('data-item');
    var manter = localStorage.getItem(item);
    
    if (manter === 'true') {
        vlw_presente.classList.add('active');
    }
});

document.addEventListener('DOMContentLoaded', function() {
    var parametro = new URLSearchParams(window.location.search);
    var classeURL = parametro.get('classe');

    if (classeURL) {
        document.querySelector('.' + classeURL).classList.add('active');
    }
});