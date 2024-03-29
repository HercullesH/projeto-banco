<?php

require_once('../../classes/Database.class.php');
require_once('../../classes/Paginacao.class.php');
require_once('../../classes/P1.class.php');

function listar($estado,$pagina,$qtdInicial,$qtdFinal){
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
    $paginacao->paginarP1($estado,$pagina,'f.nome',$qtdInicial,$qtdFinal);
    return $paginacao;
}
// pelo amor de Deus nao toque nessa parte
$estado = $_POST['estado'];
$pagina = $_POST['pagina'];
$qtdInicial = $_POST['qtdInicial'];
$qtdFinal = $_POST['qtdFinal'];



$proximo = $pagina +1;
$anterior = $pagina -1;

echo '<div class="row">';
if($pagina == 1){
    $paginacao = listar($estado,$pagina,$qtdInicial,$qtdFinal);
    $inicio = $paginacao->inicio;
    $fim = $paginacao->fim;

    echo '<div class="col-md-4" > </div> <div class="col-md-4">A consulta retornou '.$paginacao->totalDados.' registros.</div>';

    if ($paginacao->totalDados > 10){
        echo '<div class="col-md-4"><a href="p1.php?'.$proximo.'?'.$estado.'?'.$qtdInicial.'?'.$qtdFinal.'" class="btn btn-danger"> >> </a></div>';
    }
    
} else{

    $paginacao = listar($estado,$pagina,$qtdInicial,$qtdFinal);
    $inicio = $paginacao->inicio;
    $fim = $paginacao->fim;

    echo '<div class="col-md-4"><a href="p1.php?'.$anterior.'?'.$estado.'?'.$qtdInicial.'?'.$qtdFinal.'" class="btn btn-danger"> << </a></div>';

    echo '<div class="col-md-4">A consulta retornou '.$paginacao->totalDados.' registros</div>';
    $paginacao = listar($estado,$proximo,$qtdInicial,$qtdFinal);
    if ($paginacao->existeDados == True){
        echo '<div class="col-md-4"><a href="p1.php?'.$proximo .'?'.$estado.'?'.$qtdInicial.'?'.$qtdFinal.'" class="btn btn-danger"> >> </a></div>';
    }
    else{
        $fim = $paginacao->totalDados;

    }
    
}
echo '</div>';
echo '<div class = "row"><div class = "col-md-4"></div><div class = "col-md-4">Listando de '.$inicio.' a '.$fim.'</div><div class = "col-md-4"></div></div>';
$paginacao = listar($estado,$pagina,$qtdInicial,$qtdFinal);

echo '<table class="table table-striped table-dark" style="margin-top:15px;">
        <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Nome do fornecedor</th>
        <th scope="col">Quantidade de serviços</th>
        </tr>
    </thead>
    <tbody>';
$cont = 0;
if($paginacao->totalDados > 0){
    foreach($paginacao->dados as $i => $dado){
        $cont += 1;
        echo '<tr>
            <th scope="row">'.(string) $cont.'</th>
            <td>'.$dado->nome_fornecedor.'</td>
            <td>'.$dado->quantidade_servicos.'</td>
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