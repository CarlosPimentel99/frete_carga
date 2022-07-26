<?php  

	require "../frete_carga/motorista.model.php";
	require "../frete_carga/motorista.service.php";
	require "../frete_carga/conexao.php";

	echo "<pre>";
	print_r($_POST);
	echo "</pre>";

	$motorista = new Motorista()	;
	$motorista->__set('motorista', $_POST['motorista']);

	$conexao = new Conexao();


	$motoristaService = new MotoristaService($conexao, $motorista);
	$motoristaService->inserir();

	header('Location: consultar_carga.php');


	echo "<pre>";
	print_r($motoristaService);
	echo "<pre>";
?>