<?php
	include('anuncioService.php');

	$comentario = $_POST['comm'];
	$cantidad = $_POST['cantidad'];
	$inicial = $_POST['inicial'];
	$final = $_POST['final'];
	$idAnunc = $_POST['id'];
	$serv= new aService();
	$res= $serv->enviarSolicitud($inicial, $final, $idAnunc, $cantidad, $comentario);
	header("Location: solicEnviada.php");
 ?>