<?php
	include('anuncioService.php');
	$comment = $_POST['desc'];
	$puntaje = $_POST['puntaje'];
	$res = $_POST['reserva'];
	$t = $_POST['tipo'];
	$service = new aService();
	if ($t == 'hospedaje') {
		$r = $service->calificarHospedaje($comment,$puntaje,$res);
		header('Location: exitoCalif.php');
	} else {
		$r = $service->calificarHuesped($comment,$puntaje,$res);
		header('Location: exitoCalif.php');
	}
?>