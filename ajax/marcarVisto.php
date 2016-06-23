<?php
	include("../anuncioService.php");
	$serv = new aService();
	$vID = $_POST['vId'];
	$tipo = $_POST['tipo'];
	switch($tipo){
		case("r"): 	
			$resultado = $serv->respuestaSeen($vID);
		break;
		case("p"):
			$resultado = $serv->preguntaSeen($vID);
		break;
		case("sr"):
			$resultado = $serv->solicitudRSeen($vID);
		break;
	}
	
	

	
?>