<?php
	include('anuncioService.php');

	$comentario = $_POST['comm'];
	$cantidad = $_POST['cantidad'];
	$inicial = $_POST['inicial'];
	$final = $_POST['final'];
	$id = $_POST['id'];
	
	
	header("Location: pagPrinc.php");
 ?>