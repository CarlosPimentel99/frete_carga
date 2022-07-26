<?php

class Frete {
	private $id_frete;
	private $titulo;
	private $tp_caminhao;
	private $peso_carga;
	private $local_coleta;
	private $local_entrega;
	private $valor;
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