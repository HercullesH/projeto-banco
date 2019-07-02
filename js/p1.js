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
        var estado = document.getElementById("estado").value;
        var url = window.location.href;
        var pagina = url.split("?")[1];
        window.location.href = 'p1.php?1?'+estado+'?'+qtdInicial+'?'+qtdFinal+'';
    });

}



function listar(){
    var url = window.location.href;
    var pagina = url.split("?")[1];
    var estado = url.split("?")[2];
    var qtdInicial = url.split("?")[3];
    var qtdFinal = url.split("?")[4];
    document.getElementById("estado").value = estado;
    $.ajax({
        url: '../php/perguntas/p1.listar.php',
        method: 'post',
        data: {pagina: pagina,estado:estado,qtdInicial:qtdInicial,qtdFinal:qtdFinal},
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
