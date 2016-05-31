<?php

	include('regTipoService.php');

	$nombre = $_POST['tipoHosp'];
	
	$service = new regTipoService($nombre);
	$existe = $service->verificarTipo();
	echo $existe;
	switch($existe){
	
	case 0:
		$service->reagregarTipo();
		header('Location: tipoAgregado.php');
	case 1:
		header('Location: tipoRepetido.php');
	case 2:
		
		$service->registrarTipo();
		header('Location: tipoAgregado.php');
	}



?>