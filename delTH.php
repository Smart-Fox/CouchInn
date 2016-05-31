<?php

	include('regTipoService.php');

	$nombre = $_POST['tipoHosp'];
		
	$service = new regTipoService($nombre);
	$service->eliminarTipo();
	header('Location: tipoEliminado.php');
	

?>