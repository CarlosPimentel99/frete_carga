<?php  

	require "../frete_carga/usuario.model.php";
	require "../frete_carga/usuario.service.php";
	require "../frete_carga/conexao.php";

	echo "<pre>";
	print_r($_POST);
	echo "</pre>";

	$usuario = new Tarefa();
	$usuario->__set('usuario', $_POST['usuario']);

	$conexao = new Conexao();


	$usuarioService = new UsuarioService($conexao, $usuario);
	$usuarioService->inserir();

	header('Location: nova_tarefa.php?inclusao=1');


	echo "<pre>";
	print_r($usuarioService);
	echo "<pre>";
?>