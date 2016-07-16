<?php

	include('regTipoService.php');

	$nombre = $_POST['tipoHosp'];
	$service = new regTipoService($nombre);
	$result=$service->revisarTipo();
	$service->eliminarLogico();
	header('Location: tipoEliminado.php');
	
?>