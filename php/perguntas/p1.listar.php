<?php

require_once('../../classes/Database.class.php');
require_once('../../classes/Paginacao.class.php');

function listar($pagina){
    $paginacao = new Paginacao();
    $db = new Db();
    $link = $db->conecta_mysql();
    $of = $pagina -1;
    $of = $of * 10;	
    //escreva a query apenas a partir do from e sempre coloquem esse where  = 1, após isso vao la para o final dessa pagina
    $sql = "FROM pagina WHERE 1 ";
    // abaixo casos de como funcionaria com filtro
    // if (isset($filtro)){
    //     $sql. = "AND idade > 15";
    // }
    // if (isset($filtro)){
    //     $sql. = "AND idade > 15";
    // }
    $paginacao->paginar($sql,$pagina);
    return $paginacao;
}
// pelo amor de Deus nao toque nessa parte

$pagina = $_POST['pagina'];

$proximo = $pagina +1;
$anterior = $pagina -1;

echo '<div class="row">';
if($pagina == 1){
    $paginacao = listar($pagina);
    $inicio = $paginacao->inicio;
    $fim = $paginacao->fim;

    echo '<div class="col-md-4" > </div> <div class="col-md-4">A consulta retornou '.$paginacao->totalDados.' registros.</div>';

    if ($paginacao->existeDados == True){
        echo '<div class="col-md-4"><a href="p1.php?'.$proximo.'" class="btn btn-success"> >> </a></div>';
    }
    
} else{

    $paginacao = listar($pagina);
    $inicio = $paginacao->inicio;
    $fim = $paginacao->fim;

    echo '<div class="col-md-4"><a href="p1.php?'.$anterior .'" class="btn btn-success"> << </a></div>';

    echo '<div class="col-md-4">A consulta retornou '.$paginacao->totalDados.' registros</div>';
    $paginacao = listar($proximo);
    if ($paginacao->existeDados == True){
        echo '<div class="col-md-4"><a href="p1.php?'.$proximo .'" class="btn btn-success"> >> </a></div>';
    }
    else{
        $fim = $paginacao->totalDados;

    }
    
}
echo '</div>';
echo '<div class = "row"><div class = "col-md-4"></div><div class = "col-md-4">Listando de '.$inicio.' a '.$fim.'</div><div class = "col-md-4"></div></div>';
$paginacao = listar($pagina);

// so altere o código a partir daqui
foreach($paginacao->dados as $i => $dado){
    echo '<div class="row" style="margin-top:15px;" >
        <div class="col-md-6">'.$dado.'</div>
            </div>';
}



?>