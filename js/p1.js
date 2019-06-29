$(document).ready(function(){
    nomeUsuario()
});
function nomeUsuario(){

    var pagina = getPaginaUrl()
    
$.ajax({
            url: '../php/perguntas/p1.listar.php',
            method: 'post',
            data: {pagina: pagina},
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
