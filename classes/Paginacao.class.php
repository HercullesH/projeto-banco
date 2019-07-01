<?php

require_once('P1.class.php');
require_once('P2.class.php');
require_once('P3.class.php');


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

    public function paginarP1($estado,$pagina,$paramCount){
        $queryTeste = "SELECT COUNT(DISTINCT f.nome) as 'total' FROM consumo AS c, deputado AS d, fornecedor AS f, servico AS s 
        WHERE c.Deputado_id = d.id AND c.Servico_id = s.id AND f.cnpj = s.Fornecedor_cnpj AND d.Estado_uf = '$estado' "; 
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
            $sql = "SELECT f.nome AS NOME_FORNECEDOR, COUNT(s.Fornecedor_cnpj) AS QUANTIDADE_SERVICOS
            FROM consumo AS c, deputado AS d, fornecedor AS f, servico AS s
            WHERE c.Deputado_id = d.id AND c.Servico_id = s.id AND f.cnpj = s.Fornecedor_cnpj AND d.Estado_uf = '$estado'
            GROUP BY NOME_FORNECEDOR ORDER BY QUANTIDADE_SERVICOS DESC
            " ;
            $sql = $sql . $limite;
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



    public function paginarP2($qtdInicial,$qtdFinal,$pagina,$paramCount){
        $queryTeste = "SELECT COUNT(DISTINCT s.descricao) AS 'total'
        FROM documento AS d, consumo AS c, servico AS s, deputado AS de
        WHERE d.id = c.Documento_id AND c.Servico_id = s.id AND c.Deputado_id = de.id "; 
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
            $sql = "SELECT s.descricao AS Servico, SUM(d.valor) AS Valor, COUNT(s.descricao) AS Quantidade
            FROM documento AS d, consumo AS c, servico AS s, deputado AS de
            WHERE d.id = c.Documento_id AND c.Servico_id = s.id AND c.Deputado_id = de.id
            GROUP BY Servico
            " ;
            $sql = $sql . $limite;
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

    public function paginarP3($qtdInicial,$qtdFinal,$pagina,$paramCount){
        $queryTeste = "SELECT COUNT(DISTINCT dp.Partido_sigla) AS 'total'
        FROM documento AS d, consumo AS c, servico AS s, deputado AS de, deputadopartido AS dp
        WHERE d.id = c.Documento_id AND c.Servico_id = s.id AND c.Deputado_id = de.id AND dp.Deputado_id = de.id "; 
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
            $sql = "SELECT dp.Partido_sigla AS Partido, SUM(d.valor) AS Valor, COUNT(s.descricao) AS Quantidade
            FROM documento AS d, consumo AS c, servico AS s, deputado AS de, deputadopartido AS dp
            WHERE d.id = c.Documento_id AND c.Servico_id = s.id AND c.Deputado_id = de.id AND dp.Deputado_id = de.id
            GROUP BY Partido
            " ;
            $sql = $sql . $limite;
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

}

?>