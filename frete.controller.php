<?php  

	require "../frete_carga/frete.model.php";
	require "../frete_carga/frete.service.php";
	require "../frete_carga/conexao.php";

	echo "<pre>";
	print_r($_POST);
	echo "</pre>";

	$frete = new Frete();
	$frete->__set('frete', $_POST['frete']);

	$conexao = new Conexao();


	$freteService = new FreteService($conexao, $frete);
	$freteService->inserir();

	header('Location: criar_carga.php?inclusao=1');


	echo "<pre>";
	print_r($freteService);
	echo "<pre>";
?>