<?php

	include('registerService.php');

	$nombre = $_POST['nombre'];
	$apellido = $_POST['apellido'];
	$email = $_POST['email'];
	$telefono = $_POST['telefono'];
	$nomUser = $_POST['userName'];
	$password = crypt($_POST['pass'], 'radbrulz');

	$service = new registerService($nombre, $apellido, $email, $password, $telefono, $nomUser);
	$existe = $service->verificarUsuario($email);

	if ($existe) {
		header('Location: registroNoValidado.html');
	}else{
		$service->registrarUsuario();
		session_start();
		$_SESSION['usuario'] = $_POST['nombre'];
		$_SESSION['password'] = $_POST['password'];
		header('Location: registroValidado.html');
	}



?>