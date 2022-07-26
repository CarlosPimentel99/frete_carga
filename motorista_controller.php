<?php

	require "../frete_carga/motorista.model.php";
	require "../frete_carga/motorista.service.php";
	require "../frete_carga/conexao.php";


	$acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;


	if($acao == 'inserir' ) {

		$motorista = new Motorista();
		$motorista->__set('nome', $_POST['nome']);
		$motorista->__set('telefone', $_POST['telefone']);
		$motorista->__set('cpf', $_POST['cpf']);
		$motorista->__set('placa', $_POST['placa']);
		$motorista->__set('tipoMotorista', $_POST['tipoMotorista']);

		$conexao = new Conexao();

		$motoristaService = new MotoristaService($conexao, $motorista);
		$motoristaService->inserir();

		header('Location: consultar_motorista.php');
	 	

	} else if($acao == 'recuperar') {
		
		$motorista = new Motorista();
		$conexao = new Conexao();

		$motoristaService = new MotoristaService($conexao, $motorista);
		$motorista = $motoristaService->recuperar();		
	
	} else if($acao == 'atualizar') {
		
		$motorista = new Motorista();
		$motorista->__set('id', $_POST['id']);
		$motorista->__set('nome', $_POST['nome']);
		$motorista->__set('telefone', $_POST['telefone']);		
		$motorista->__set('placa', $_POST['placa']);		
		$motorista->__set('cpf', $_POST['cpf']);					

		$conexao = new Conexao();

		$motoristaService = new MotoristaService($conexao, $motorista);
		if($motoristaService->atualizar()) {
			
			if( isset($_GET['pag']) && $_GET['pag'] == 'index') {
				header('location: consultar_motorista.php?msg=erro');	
			} else {
				header('location: consultar_motorista.php?msg=sucesso');
			}
		}
	} else if($acao == 'remover') {

		$motorista = new Motorista();
		$motorista->__set('id', $_GET['id']);

		$conexao = new Conexao();

		$motoristaService = new MotoristaService($conexao, $motorista);
		$motoristaService->remover();

		if( isset($_GET['pag']) && $_GET['pag'] == 'index') {
			echo "<script>document.location='consultar_motorista.php?msg=erro'</script>";
		} else {
			echo "<script>document.location='consultar_motorista.php?msg=sucesso'</script>";
		}
	
	} else if($acao == 'carregar') {		
		
		$motorista = new Motorista();
		$motorista->__set('id', $_GET['id']);

		$conexao = new Conexao();

		$motoristaService = new MotoristaService($conexao, $motorista);
		$motorista = $motoristaService->carregar();	
	
	} /*else if($acao == 'inativar') {		

		$motorista = new Motorista();
		$motorista->__set('id', $_GET['id']);
		$conexao = new Conexao();

		$motoristaService = new MotoristaService($conexao, $motorista);
		$motoristaService->inativar();


		if( isset($_GET['pag']) && $_GET['pag'] == 'index') {
			header('location: consultar_motorista.php?msg=erro');	
		} else {
			header('location: consultar_motorista.php?msg=sucesso');
		}

	}
	else if($acao == 'ativar') {		

		$motorista = new Motorista();
		$motorista->__set('id', $_GET['id']);

		$conexao = new Conexao();

		$motoristaService = new MotoristaService($conexao, $motorista);
		$motoristaService->ativar();

		if( isset($_GET['pag']) && $_GET['pag'] == 'index') {
			header('location: consultar_motorista.php?msg=erro');	
		} else {
			header('location: consultar_motorista.php?msg=sucesso');
		}

	}*/

?>