<?php

//CRUD
class MotoristaService {

	private $conexao;
	private $motorista;

	public function __construct(Conexao $conexao, Motorista $motorista) {
		$this->conexao = $conexao->conectar();
		$this->motorista = $motorista;
	}

	/*public function inserir() { //create
		$query = 'insert into tb_fretes(titulo, tp_caminhao, peso_carga, local_coleta, local_entrega, valor, status) values(?, ?, ?, ?, ?, ?, 1)';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(1, $this->frete->__get('titulo'));
		$stmt->bindValue(2, $this->frete->__get('tp_caminhao'));
		$stmt->bindValue(3, $this->frete->__get('peso_carga'));
		$stmt->bindValue(4, $this->frete->__get('local_coleta'));
		$stmt->bindValue(5, $this->frete->__get('local_entrega'));
		$stmt->bindValue(6, $this->frete->__get('valor'));
		$stmt->execute();
	}*/

	public function recuperar() { //read
		$query = 'select m.id, m.nome, m.telefone, m.cpf, m.placa, m.tipoMotorista, m.status  FROM motoristas m';		
		$stmt = $this->conexao->prepare($query);		
		$stmt->execute();		
		return $stmt->fetchAll(PDO::FETCH_OBJ);		
	}

	public function atualizar() { //update

		$query = "update motoristas 
					set nome = ?,
						telefone = ?,
						cpf = ?,
						placa = ?
                      where id = ?";
        
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(1, $this->motorista->__get('nome'));
		$stmt->bindValue(2, $this->motorista->__get('telefone'));
		$stmt->bindValue(3, str_replace('-', '', str_replace('.', '', $this->motorista->__get('cpf'))));
		$stmt->bindValue(4, $this->motorista->__get('placa'));	
		$stmt->bindValue(5, $this->motorista->__get('id'));
		return $stmt->execute(); 
		echo "Executo";
	}

	public function remover() { //delete

		$query = 'delete from motoristas where id = ?';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(1, $this->motorista->__get('id'));
		$stmt->execute();
	}

	public function carregar() { //read
		$query = '
			select m.id, m.nome, m.telefone, m.cpf, m.placa, m.status  FROM motoristas m
			where m.id = ?
		';		
		$stmt = $this->conexao->prepare($query);		
		$stmt->bindValue(1, $this->motorista->__get('id'));
		$stmt->execute();		
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}

	/*public function inativar() { //update


		$query = "update motoristas set status = 2 where id = ?";
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(1, $this->motorista->__get('id'));	
		return $stmt->execute();
	}

	public function ativar() { //update

		$query = "update motoristas set status = 1 where id = ?";
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(1, $this->motorista->__get('id'));	
		return $stmt->execute();
	}*/
	
}

?>