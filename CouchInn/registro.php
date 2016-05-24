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
		echo 'ERROR: El usuario ya existe en el sistema';
	}else{
		$service->registrarUsuario();
		echo "registro exitoso";
		#header('Location: pagPrinc.html');
	}



?>