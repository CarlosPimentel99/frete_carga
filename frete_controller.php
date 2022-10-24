<?php

	require "../frete_carga/frete.model.php";
	require "../frete_carga/frete.service.php";
	require "../frete_carga/conexao.php";


	$acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;	


	if($acao == 'inserir' ) {

		$frete = new Frete();
		$frete->__set('titulo', $_POST['titulo']);		
		$frete->__set('tp_caminhao', $_POST['tp_caminhao']);		
		$frete->__set('peso_carga', $_POST['peso_carga']);		
		$frete->__set('local_coleta', $_POST['local_coleta']);		
		$frete->__set('local_entrega', $_POST['local_entrega']);		
		$frete->__set('valor', $_POST['valor']);	
		$frete->__set('observacao', $_POST['observacao']);		

		$conexao = new Conexao();

		$freteService = new FreteService($conexao, $frete);
		$freteService->inserir();

		header('Location: criar_carga.php?inclusao=1');
	 	

	} else if($acao == 'recuperar') {
		
		$frete = new Frete();
		$conexao = new Conexao();

		$freteService = new FreteService($conexao, $frete);
		$frete = $freteService->recuperar();		
	
	} else if($acao == 'atualizar') {
		
		$frete = new Frete();
		$frete->__set('id', $_POST['id']);
		$frete->__set('titulo', $_POST['titulo']);		
		$frete->__set('tp_caminhao', $_POST['tp_caminhao']);		
		$frete->__set('peso_carga', $_POST['peso_carga']);		
		$frete->__set('local_coleta', $_POST['local_coleta']);		
		$frete->__set('local_entrega', $_POST['local_entrega']);		
		$frete->__set('valor', $_POST['valor']);
		$frete->__set('observacao', $_POST['observacao']);


		$conexao = new Conexao();

		$freteService = new FreteService($conexao, $frete);
		if($freteService->atualizar()) {
			
			if( isset($_GET['pag']) && $_GET['pag'] == 'index') {
				header('location: consultar_carga.php?msg=erro');	
			} else {
				header('location: consultar_carga.php?msg=sucesso');
			}
		}
	} else if($acao == 'remover') {

		$frete = new Frete();
		$frete->__set('id', $_GET['id']);

		$conexao = new Conexao();

		$freteService = new FreteService($conexao, $frete);
		$freteService->remover();

		if( isset($_GET['pag']) && $_GET['pag'] == 'index') {
			echo "<script>document.location='consultar_carga.php?msg=erro'</script>";
		} else {
		    echo "<script>document.location='consultar_carga.php?msg=sucesso'</script>";
		}
	
	} else if($acao == 'carregar') {		
		
		$frete = new Frete();
		$frete->__set('id', $_GET['id']);

		$conexao = new Conexao();

		$freteService = new FreteService($conexao, $frete);
		$frete = $freteService->carregar();	
	
	} else if($acao == 'inativar') {		

		$frete = new Frete();
		$frete->__set('id', $_GET['id']);

		$conexao = new Conexao();

		$freteService = new FreteService($conexao, $frete);
		$freteService->inativar();

		if( isset($_GET['pag']) && $_GET['pag'] == 'index') {
			echo "<script>document.location='consultar_carga.php'</script>";
		} else {
		    echo "<script>document.location='consultar_carga.php'</script>";
		}

	}
	else if($acao == 'ativar') {		

		$frete = new Frete();
		$frete->__set('id', $_GET['id']);

		$conexao = new Conexao();

		$freteService = new FreteService($conexao, $frete);
		$freteService->ativar();

		if( isset($_GET['pag']) && $_GET['pag'] == 'index') {
			echo "<script>document.location='consultar_carga.php'</script>";
		} else {
			echo "<script>document.location='consultar_carga.php'</script>";
		}

	}

?>