<?php

	include('regTipoService.php');

	$nombre = $_POST['tipoHosp'];
	
	$service = new regTipoService($nombre);
	$existe = $service->verificarTipo();

	if ($existe) {
		header('Location: tipoRepetido.php');
	}else{
		$service->registrarTipo();
		header('Location: tipoAgregado.php');
	}



?>