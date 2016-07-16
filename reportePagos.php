<?php
	include_once('reportesService.php');
	$inicial = $_POST['inicial'];
	$final = $_POST['final'];
	$res=reportePagos($inicial, $final);
 ?>
