<?php

require_once('P1.class.php');
require_once('P2.class.php');
require_once('P3.class.php');
require_once('Deputado.class.php');


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

    public function paginarP1($estado,$pagina,$paramCount,$qtdInicial,$qtdFinal){
        $count = "SELECT COUNT(*) as 'total' FROM(";
        $queryTeste = "SELECT f.nome AS NOME_FORNECEDOR, COUNT(s.Fornecedor_cnpj) AS QUANTIDADE_SERVICOS
        FROM consumo AS c, deputado AS d, fornecedor AS f, servico AS s
        WHERE c.Deputado_id = d.id AND c.Servico_id = s.id AND f.cnpj = s.Fornecedor_cnpj AND d.Estado_uf = '$estado'
        GROUP BY NOME_FORNECEDOR HAVING 1";

            if($qtdInicial != '-1'){
                $queryTeste .= " AND QUANTIDADE_SERVICOS >= '$qtdInicial'";
            }
            if($qtdFinal != '-1'){
                $queryTeste .= " AND QUANTIDADE_SERVICOS <= '$qtdFinal'";
            }
        $order = " ORDER BY QUANTIDADE_SERVICOS DESC) as tabela "; 
        $cont = $count . $queryTeste . $order;
        $db = new Db();
        $link = $db->conecta_mysql();
        $of = $pagina - 1;
        if($of != 0){
            $of = $of * 10;	
        }
        $limite = " LIMIT 10 OFFSET $of ";
        $resultado_busca = mysqli_query($link,$cont);
        $dados = mysqli_fetch_array($resultado_busca,MYSQLI_ASSOC);
        $this->totalDados = $dados['total'];
        $this->inicio = $of + 1;
        $this->fim = $pagina * 10;
    
        if($this->totalDados > $of){
            $this->existeDados = True;
            $sql = $queryTeste ." ORDER BY QUANTIDADE_SERVICOS DESC " .$limite;
            $resultado_busca = mysqli_query($link,$sql);
            $this->dados = array();
            while($dados = mysqli_fetch_array($resultado_busca,MYSQLI_ASSOC)){
                $p1 = new P1();
                $p1->nome_fornecedor = $dados['NOME_FORNECEDOR'];
                $p1->quantidade_servicos = $dados['QUANTIDADE_SERVICOS'];
                $this->dados[] = $p1;
            }
    
        }
        else{
            $this->existeDados = False;
        }
    }



    public function paginarP2($qtdInicial,$qtdFinal,$pagina,$deputado,$valorInicial,$valorFinal){
        $count = "SELECT COUNT(*) as 'total' FROM(";
        $queryTeste = "SELECT s.descricao AS Servico, SUM(d.valor) AS Valor, COUNT(s.descricao) AS Quantidade
        FROM documento AS d, consumo AS c, servico AS s, deputado AS de
        WHERE d.id = c.Documento_id AND c.Servico_id = s.id AND c.Deputado_id = de.id ";
        if($deputado != "TODOS"){
            $queryTeste .= " AND de.id = '$deputado' ";
        }
        
        $queryTeste .= "GROUP BY Servico HAVING 1"; 
        if($qtdInicial != '-1'){
            $queryTeste .= " AND Quantidade >= '$qtdInicial'";
        }
        if($qtdFinal != '-1'){
            $queryTeste .= " AND Quantidade <= '$qtdFinal'";
        }

        if($valorInicial != '-1'){
            $queryTeste .= " AND Valor >= '$valorInicial'";
        }
        if($valorFinal != '-1'){
            $queryTeste .= " AND Valor <= '$valorFinal'";
        }
        $order = " ORDER BY Valor DESC) as tabela "; 
        $cont = $count . $queryTeste . $order;
        $db = new Db();
        $link = $db->conecta_mysql();
        $of = $pagina - 1;
        if($of != 0){
            $of = $of * 10;	
        }

        $limite = " LIMIT 10 OFFSET $of ";
        $resultado_busca = mysqli_query($link,$cont);
        $dados = mysqli_fetch_array($resultado_busca,MYSQLI_ASSOC);
        $this->totalDados = $dados['total'];
        $this->inicio = $of + 1;
        $this->fim = $pagina * 10;
    
        if($this->totalDados > $of){
            $this->existeDados = True;

            $sql = $queryTeste .' ORDER BY Valor DESC '. $limite;
            $resultado_busca = mysqli_query($link,$sql);
            $this->dados = array();
            while($dados = mysqli_fetch_array($resultado_busca,MYSQLI_ASSOC)){
                $p2 = new P2();
                $p2->servico = $dados['Servico'];
                $p2->valor = $dados['Valor'];
                $p2->quantidade = $dados['Quantidade'];
                $this->dados[] = $p2;
            }
    
        }
        else{
            $this->existeDados = False;
        }
    }

    public function paginarP3($qtdInicial,$qtdFinal,$pagina,$valorInicial,$valorFinal){
        $count = "SELECT COUNT(*) as 'total' FROM(";
        $queryTeste = "SELECT dp.Partido_sigla AS Partido, SUM(d.valor) AS Valor, COUNT(s.descricao) AS Quantidade
        FROM documento AS d, consumo AS c, servico AS s, deputado AS de, deputadopartido AS dp
        WHERE d.id = c.Documento_id AND c.Servico_id = s.id AND c.Deputado_id = de.id AND dp.Deputado_id = de.id
        GROUP BY Partido HAVING 1 "; 

        if($qtdInicial != '-1'){
            $queryTeste .= " AND Quantidade >= '$qtdInicial'";
        }
        if($qtdFinal != '-1'){
            $queryTeste .= " AND Quantidade <= '$qtdFinal'";
        }

        if($valorInicial != '-1'){
            $queryTeste .= " AND Valor >= '$valorInicial'";
        }
        if($valorFinal != '-1'){
            $queryTeste .= " AND Valor <= '$valorFinal'";
        }
        $db = new Db();
        $link = $db->conecta_mysql();
        $of = $pagina - 1;
        if($of != 0){
            $of = $of * 10;	
        }

        $limite = " LIMIT 10 OFFSET $of ";
        $order = ") as tabela "; 
        $cont = $count . $queryTeste . $order;
        $resultado_busca = mysqli_query($link,$cont);
        $dados = mysqli_fetch_array($resultado_busca,MYSQLI_ASSOC);
        $this->totalDados = $dados['total'];
        $this->inicio = $of + 1;
        $this->fim = $pagina * 10;
    
        if($this->totalDados > $of){
            $this->existeDados = True;
            $sql = $queryTeste . $limite;
            $resultado_busca = mysqli_query($link,$sql);
            $this->dados = array();
            while($dados = mysqli_fetch_array($resultado_busca,MYSQLI_ASSOC)){
                $p3 = new P3();
                $p3->partido = $dados['Partido'];
                $p3->valor = $dados['Valor'];
                $p3->quantidade = $dados['Quantidade'];
                $this->dados[] = $p3;
            }
    
        }
        else{
            $this->existeDados = False;
        }
    }

    public function paginarP4($dataInicial,$dataFinal,$pagina,$valorInicial,$valorFinal){
        $count = "SELECT COUNT(*) as 'total' FROM(";
        if($dataInicial =="-1"){
            $dataInicial = "2018-01-01";
        }

        if($dataFinal =="-1"){
            $dataFinal = "2018-12-30";
        }
        $queryTeste = "SELECT dp.Partido_sigla AS Partido, SUM(d.valor) AS Valor
        FROM documento AS d, consumo AS c, deputadopartido AS dp
        WHERE d.id = c.Documento_id AND c.Deputado_id = dp.Deputado_id AND d.dataEmissao >= '$dataInicial' AND d.dataEmissao <= '$dataFinal'
        GROUP BY Partido HAVING 1"; 

        if($valorInicial != '-1'){
            $queryTeste .= " AND Valor >= '$valorInicial'";
        }
        if($valorFinal != '-1'){
            $queryTeste .= " AND Valor <= '$valorFinal'";
        }

        $db = new Db();
        $link = $db->conecta_mysql();
        $of = $pagina - 1;
        if($of != 0){
            $of = $of * 10;	
        }

        $limite = " LIMIT 10 OFFSET $of ";
        $order = ") as tabela "; 
        $cont = $count . $queryTeste . $order;
        $resultado_busca = mysqli_query($link,$cont);
        $dados = mysqli_fetch_array($resultado_busca,MYSQLI_ASSOC);
        $this->totalDados = $dados['total'];
        $this->inicio = $of + 1;
        $this->fim = $pagina * 10;
    
        if($this->totalDados > $of){
            $this->existeDados = True;
            $sql = $queryTeste . $limite;
            $resultado_busca = mysqli_query($link,$sql);
            $this->dados = array();
            while($dados = mysqli_fetch_array($resultado_busca,MYSQLI_ASSOC)){
                $p4 = new P4();
                $p4->partido = $dados['Partido'];
                $p4->valor = $dados['Valor'];
                $this->dados[] = $p4;
            }
    
        }
        else{
            $this->existeDados = False;
        }
    }

    function loadDeputados(){
        $db = new Db();
        $link = $db->conecta_mysql();
        $sql = "SELECT * FROM deputado ORDER BY nome ASC" ;
            $resultado_busca = mysqli_query($link,$sql);
            while($dados = mysqli_fetch_array($resultado_busca,MYSQLI_ASSOC)){
                $deputado = new Deputado();
                $deputado->nome = $dados['nome'];
                $deputado->id = $dados['id'];
                $this->dados[] = $deputado;
            }
    }

}

?>