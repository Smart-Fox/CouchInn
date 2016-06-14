<?php

	include('regTipoService.php');

	$nombre = $_POST['tipoHosp'];
	
	$service = new regTipoService($nombre);
	$existe = $service->verificarTipo();
	switch($existe){
		case 0:
			$service->reagregarTipo();
			header('Location: tipoAgregado.php');
			break;
		case 1:
			header('Location: tipoRepetido.php');
			break;
		case 2:
			$service->registrarTipo();
			header('Location: tipoAgregado.php');
			break;
	}
	
?>