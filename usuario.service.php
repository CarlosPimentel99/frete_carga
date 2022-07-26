<?php

//CRUD
class UsuarioService {

	private $conexao;
	private $usuario;

	public function __construct(Conexao $conexao, Usuario $usuario) {
		$this->conexao = $conexao->conectar();
		$this->usuario = $usuario;
	}

	public function inserir() { //create
		$query = 'insert into tb_usuarios(nome, email, senha)values(?, ?, ?)';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(1, $this->usuario->__get('nome'));
		$stmt->bindValue(2, $this->usuario->__get('email'));
		$stmt->bindValue(3, $this->usuario->__get('senha'));
		$stmt->execute();
	}

	public function recuperar() { //read
		$query = '
			select 
				u.id, u.nome, u.email, senha 
			from 
				tb_usuarios as u				
		';
		$stmt = $this->conexao->prepare($query);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}

	public function atualizar() { //update

		$query = "update tb_usuarios set senha = ? where id = ?";
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(1, $this->usuario->__get('senha'));
		$stmt->bindValue(2, $this->usuario->__get('id'));
		return $stmt->execute(); 
	}
	
}

?>