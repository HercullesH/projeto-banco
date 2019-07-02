$(document).ready(function(){
    buscar();
    listar();
});
function buscar(){

    $('#buscar').click(function(){
        var qtdInicial = $('#dataInicial').val();
        if(qtdInicial == ""){
            qtdInicial = '-1';
        }
        var qtdFinal = $('#dataFinal').val();
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
        var url = window.location.href;
        var pagina = url.split("?")[1];
        window.location.href = 'p4.php?1?'+qtdInicial+'?'+qtdFinal+'?'+valorInicial+'?'+valorFinal+'';
    });

}

function listar(){
    var url = window.location.href;
    var pagina = url.split("?")[1];
    var dataInicial = url.split("?")[2];
    var dataFinal = url.split("?")[3];
    var valorInicial = url.split("?")[4];
    var valorFinal = url.split("?")[5];
    $.ajax({
        url: '../php/perguntas/p4.listar.php',
        method: 'post',
        data: {pagina: pagina,dataInicial:dataInicial,dataFinal:dataFinal,valorInicial:valorInicial,valorFinal:valorFinal},
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
