<?php

	require "../frete_carga/usuario.model.php";
	require "../frete_carga/usuario.service.php";
	require "../frete_carga/conexao.php";


	$acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

	if($acao == 'inserir' ) {
		$usuario = new Usuario();
		$usuario->__set('usuario', $_POST['usuario']);

		$conexao = new Conexao();

		$usuarioService = new UsuarioService($conexao, $usuario);
		$usuarioService->inserir();

		header('Location: nova_usuario.php?inclusao=1');
	
	} else if($acao == 'recuperar') {
		
		$usuario = new Usuario();
		$conexao = new Conexao();

		$usuarioService = new UsuarioService($conexao, $usuario);
		$usuarios = $usuarioService->recuperar();
	
	} else if($acao == 'atualizar') {

		$usuario = new Usuario();
		$usuario->__set('id', $_POST['id'])
			->__set('usuario', $_POST['usuario']);

		$conexao = new Conexao();

		$usuarioService = new UsuarioService($conexao, $usuario);
		if($usuarioService->atualizar()) {
			
			if( isset($_GET['pag']) && $_GET['pag'] == 'index') {
				header('location: nova_usuario.php?msg=sucesso');	
			} else {
				header('location: nova_usuario.php?msg=erro');
			}
		}
	} 

?>