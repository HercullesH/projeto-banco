<?php

class Db{
	
	private $host = "localhost";
	private $usuario = "root";
	private $senha ="";
	private $database ="teste";


	public function getHost(){
		return $this->host;
	}

	public function getUsuario(){
		return $this->usuario;
	}

	public function getSenha(){
		return $this->senha;
	}
	public function getDatabase(){
		return $this->database;
	}

	public function conecta_mysql(){
		$conexao = mysqli_connect($this->host, $this->usuario, $this->senha,$this->database);

		mysqli_set_charset($conexao, "utf8");

		if(mysqli_connect_errno()){
			echo "erro ao tentar se conectar ao banco".mysqli_connect_error();
		}

		return $conexao;
	}
}

?>