<?php

class Motorista {
	private $id;
	private $nome;
	private $telefone;
	private $cpf;
	private $placa;	
	private $tipoMotorista;
	private $status;

	public function __get($atributo) {
		return $this->$atributo;
	}

	public function __set($atributo, $valor) {
		$this->$atributo = $valor;
		return $this;
	}
}

?>