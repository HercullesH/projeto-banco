<?php

class Paginacao{
    public $dados;
    public $totalDados;
    public $existeDados;
    public $inicio;
    public $fim;

    public function paginar($sql,$pagina){
        $queryTeste = "SELECT COUNT(*) as 'total' "; 
        $queryTeste .= $sql;
        $db = new Db();
        $link = $db->conecta_mysql();
        $of = $pagina - 1;
        if($of != 0){
            $of = $of * 10;	
        }
        $limite = " LIMIT 10 OFFSET $of ";
        $resultado_busca = mysqli_query($link,$queryTeste);
        $dados = mysqli_fetch_array($resultado_busca,MYSQLI_ASSOC);
        $this->totalDados = $dados['total'];
        $this->inicio = $of + 1;
        $this->fim = $pagina * 10;
    
        if($this->totalDados > $of){
            $this->existeDados = True;
            $sql = "SELECT * ".$sql.$limite ;
            $resultado_busca = mysqli_query($link,$sql);
            $this->dados = array();
            while($dados = mysqli_fetch_array($resultado_busca,MYSQLI_ASSOC)){
                $this->dados[] = $dados['elemento'];
            }
    
        }
        else{
            $this->existeDados = False;
        }
    }

}

?>