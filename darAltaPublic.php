<?php
	include('anuncioService.php');
	session_start();
	$idAnun = $_POST['anunc'];
	$serv = new aService();
	$serv->activarAnuncio($idAnun);
	header('Location: pagPrinc.php');

?>