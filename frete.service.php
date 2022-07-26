<?php

//CRUD
class FreteService {

	private $conexao;
	private $frete;

	public function __construct(Conexao $conexao, Frete $frete) {
		$this->conexao = $conexao->conectar();
		$this->frete = $frete;
	}

	public function inserir() { //create
		$query = 'insert into tb_fretes(titulo, tp_caminhao, peso_carga, local_coleta, local_entrega, valor, status) values(?, ?, ?, ?, ?, ?, 1)';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(1, $this->frete->__get('titulo'));
		$stmt->bindValue(2, $this->frete->__get('tp_caminhao'));
		$stmt->bindValue(3, $this->frete->__get('peso_carga'));
		$stmt->bindValue(4, $this->frete->__get('local_coleta'));
		$stmt->bindValue(5, $this->frete->__get('local_entrega'));
		$stmt->bindValue(6, $this->frete->__get('valor'));
		$stmt->execute();
	}

	public function recuperar() { //read
		$query = '
			select 
				f.id_frete, f.titulo, f.tp_caminhao, f.peso_carga, f.local_coleta, f.local_entrega, f.valor, f.status
			from 
				tb_fretes as f				
		';		
		$stmt = $this->conexao->prepare($query);		
		$stmt->execute();		
		return $stmt->fetchAll(PDO::FETCH_OBJ);		
	}

	public function atualizar() { //update

		$query = "update tb_fretes 
					set titulo = ?,
						tp_caminhao = ?,
						peso_carga = ?,
						local_coleta = ?,
						local_entrega = ?,
						valor = ?					    
                      where id_frete = ?";
        
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(1, $this->frete->__get('titulo'));
		$stmt->bindValue(2, $this->frete->__get('tp_caminhao'));
		$stmt->bindValue(3, floatval(str_replace(',', '.', $this->frete->__get('peso_carga'))));
		$stmt->bindValue(4, $this->frete->__get('local_coleta'));
		$stmt->bindValue(5, $this->frete->__get('local_entrega'));
		$stmt->bindValue(6, floatval(str_replace(',', '.', $this->frete->__get('valor'))));
		$stmt->bindValue(7, $this->frete->__get('id'));
		return $stmt->execute(); 
	}

	public function remover() { //delete

		$query = 'delete from tb_fretes where id_frete = ?';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(1, $this->frete->__get('id'));
		$stmt->execute();
	} 	

	public function carregar() { //read
		$query = '
			select 
				f.id_frete, f.titulo, f.tp_caminhao, f.peso_carga, f.local_coleta, f.local_entrega, f.valor, f.status
			from 
				tb_fretes as f
			where f.id_frete = ?
		';		
		$stmt = $this->conexao->prepare($query);		
		$stmt->bindValue(1, $this->frete->__get('id'));
		$stmt->execute();		
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}

	public function inativar() { //update

		$query = "update tb_fretes set status = 2 where id_frete = ?";
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(1, $this->frete->__get('id'));	
		return $stmt->execute();
	}

	public function ativar() { //update

		$query = "update tb_fretes set status = 1 where id_frete = ?";
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(1, $this->frete->__get('id'));	
		return $stmt->execute();
	}
	
}

?>