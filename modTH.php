<?php

	include('regTipoService.php');

	$nombre = $_POST['tipoHosp'];
	$oldnom = $_POST['oldtype'];
	
	$service2 = new regTipoService($nombre);
	$existe=$service2->verificarTipo();
	
	switch($existe){
		
		case 0:
			header('Location: tipoModRepeDel.php');
			break;
			
		case 1:
			header('Location: tipoModRepe.php');
			break; 
			
		case 2:
			$service = new regTipoService($oldnom);
			$service->modificarTipo($nombre);
			header('Location: tipoModificado.php');
			break;
	}
?>