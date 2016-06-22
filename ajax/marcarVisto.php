<?php
	include("../anuncioService.php");
	$serv = new aService();
	$vID = $_POST['vId'];
	$tipo = $_POST['tipo'];
	if ($tipo = 'r') {
		$resultado = $serv->respuestaSeen($vID);
	} 
	
?>