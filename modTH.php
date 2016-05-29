<?php

	include('regTipoService.php');

	$nombre = $_POST['tipoHosp'];
	$oldnom = $_POST['oldtype'];
	
	$service = new regTipoService($oldnom);
	$service->modificarTipo($nombre);
	header('Location: tipoModificado.php');
	

?>