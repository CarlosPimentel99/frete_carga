<?php
    
	$acao = 'recuperar';
	require 'usuario_controller.php';
	
	
	session_start();

	$usario_autenticado = false;
	$usuario_id = null;
	

	foreach ($usuarios as $user => $usuario) {
		if ($usuario->email == $_POST['email'] && $usuario->senha == $_POST['senha']) {
			$usario_autenticado = true;
			$usuario_id = $user['id'] ;
		}
	}

	
	if ($usario_autenticado == true) {
		$_SESSION['autenticado'] = 'SIM';
		$_SESSION['id'] = $usuario_id;
		header('Location: home_adm.php');

	} else {
		$_SESSION['autenticado'] = 'NÃO';
		header('Location: login.php?login=erro');
	}

?>