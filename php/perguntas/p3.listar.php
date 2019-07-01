<?php

require_once('../../classes/Database.class.php');
require_once('../../classes/Paginacao.class.php');
require_once('../../classes/P3.class.php');
function listar($qtdInicial,$qtdFinal,$pagina){
    $paginacao = new Paginacao();
    $db = new Db();
    $link = $db->conecta_mysql();
    $of = $pagina -1;
    $of = $of * 10;	
    // abaixo casos de como funcionaria com filtro
    // if (isset($filtro)){
    //     $sql. = "AND idade > 15";
    // }
    // if (isset($filtro)){
    //     $sql. = "AND idade > 15";
    // }
    $paginacao->paginarP3($qtdInicial,$qtdFinal,$pagina,'f.nome');
    return $paginacao;
}
// pelo amor de Deus nao toque nessa parte
$qtdInicial = $_POST['qtdInicial'];
$qtdFinal = $_POST['qtdFinal'];
$pagina = $_POST['pagina'];

$proximo = $pagina +1;
$anterior = $pagina -1;

echo '<div class="row">';
if($pagina == 1){
    $paginacao = listar($qtdInicial,$qtdFinal,$pagina);
    $inicio = $paginacao->inicio;
    $fim = $paginacao->fim;
    echo '<div class="col-md-4" > </div> <div class="col-md-4">A consulta retornou '.$paginacao->totalDados.' registros.</div>';
    if($paginacao->totalDados > 10){
        if ($paginacao->existeDados == True){
            echo '<div class="col-md-4"><a href="p3.php?'.$proximo.'?'.$qtdInicial.'?'.$qtdFinal.'" class="btn btn-success"> >> </a></div>';
        }

    }


    
} else{

    $paginacao = listar($qtdInicial,$qtdFinal,$pagina);
    $inicio = $paginacao->inicio;
    $fim = $paginacao->fim;

    echo '<div class="col-md-4"><a href="p3.php?'.$anterior.'?'.$qtdInicial.'?'.$qtdFinal.'" class="btn btn-success"> << </a></div>';

    echo '<div class="col-md-4">A consulta retornou '.$paginacao->totalDados.' registros</div>';
    $paginacao = listar($qtdInicial,$qtdFinal,$proximo);
    if ($paginacao->existeDados == True){
        echo '<div class="col-md-4"><a href="p3.php?'.$proximo .'?'.$qtdInicial.'?'.$qtdFinal.'" class="btn btn-success"> >> </a></div>';
    }
    else{
        $fim = $paginacao->totalDados;

    }
    
}
echo '</div>';
echo '<div class = "row"><div class = "col-md-4"></div><div class = "col-md-4">Listando de '.$inicio.' a '.$fim.'</div><div class = "col-md-4"></div></div>';
$paginacao = listar($qtdInicial,$qtdFinal,$pagina);

echo '<table class="table table-striped table-dark" style="margin-top:15px;">
        <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Partido</th>
        <th scope="col">Valor do serviço</th>
        <th scope="col">Quantidade do serviço</th>
        </tr>
    </thead>
    <tbody>';
$cont = 0;
if($paginacao->totalDados > 0){
    foreach($paginacao->dados as $i => $dado){
        $cont += 1;
        echo '<tr>
            <th scope="row">'.(string) $cont.'</th>
            <td>'.$dado->partido.'</td>
            <td>'.$dado->valor.'</td>
            <td>'.$dado->quantidade.'</td>
            </tr>';
    }
}
else{
    echo '<tr>
        <th scope="row">'.(string) $cont.'</th>
        <td>Não encontrado</td>
        <td>Não encontrado</td>
        </tr>';
}

echo '</table>'


?>