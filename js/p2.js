$(document).ready(function(){
    deputados();
    buscar();
    listar();
});
function buscar(){

    $('#buscar').click(function(){
        var qtdInicial = $('#qtdInicial').val();
        if(qtdInicial == ""){
            qtdInicial = '-1';
        }
        var qtdFinal = $('#qtdFinal').val();
        if(qtdFinal == ""){
            qtdFinal = '-1';
        }

        var valorInicial = $('#valorInicial').val();
        if(valorInicial == ""){
            valorInicial = '-1';
        }
        var valorFinal = $('#valorFinal').val();
        if(valorFinal == ""){
            valorFinal = '-1';
        }

        var deputado = document.getElementById("deputado").value;
        var url = window.location.href;
        var pagina = url.split("?")[1];
        window.location.href = 'p2.php?1?'+qtdInicial+'?'+qtdFinal+'?'+deputado+'?'+valorInicial+'?'+valorFinal+'';
    });

}

function deputados(){
    $.ajax({
        url: '../php/perguntas/deputados.php',
        method: 'post',
        data: {},
        success: function(data){
            $('#deputados').html(data);
            
    }
});
}

function listar(){
    var url = window.location.href;
    var pagina = url.split("?")[1];
    var qtdInicial = url.split("?")[2];
    var qtdFinal = url.split("?")[3];
    var deputado = url.split("?")[4];
    var valorInicial = url.split("?")[5];
    var valorFinal = url.split("?")[6];
    $.ajax({
        url: '../php/perguntas/p2.listar.php',
        method: 'post',
        data: {pagina: pagina,qtdInicial:qtdInicial,qtdFinal:qtdFinal,deputado:deputado,valorInicial:valorInicial,valorFinal:valorFinal},
        success: function(data){
            deputados();
            $('#lista').html(data);
            
    }
});
}

function getPaginaUrl(){
    var url = window.location.href;
    var pagina = url.split("?")[1];
    return pagina;
  }
