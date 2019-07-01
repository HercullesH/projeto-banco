$(document).ready(function(){
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
        var url = window.location.href;
        var pagina = url.split("?")[1];
        window.location.href = 'p2.php?1?'+qtdInicial+'?'+qtdFinal+'';
    });

}

function listar(){
    var url = window.location.href;
    var pagina = url.split("?")[1];
    var qtdInicial = url.split("?")[2];
    var qtdFinal = url.split("?")[3];
    $.ajax({
        url: '../php/perguntas/p2.listar.php',
        method: 'post',
        data: {pagina: pagina,qtdInicial:qtdInicial,qtdFinal:qtdFinal},
        success: function(data){
            $('#lista').html(data);
            
    }
});
}

function getPaginaUrl(){
    var url = window.location.href;
    var pagina = url.split("?")[1];
    return pagina;
  }
