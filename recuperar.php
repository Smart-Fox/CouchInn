<?php
	include('recuService.php');
	$mail = $_POST['email'];
	$service = new recuService($mail);
	$dato = $service->buscarUsuario($mail);
	if ($dato){
		header('Location: contraEnviada.html');
	} else {
		header('Location: contraFailed.html');
	}
?>