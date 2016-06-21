<?php
	include('anuncioService.php');
	$idSolic=$_POST['solic'];
	$serv = new aService();
	$solic = $serv->levantarSolicitud($idSolic);
	$row=$solic->fetch_assoc();
	$superp=$serv->levantarSolicitudesFecha($row['fecha_inicio'], $row['fecha_fin'], $idSolic);
	$serv->aceptarSolicitud($idSolic);
	while($row2 = $superp->fetch_assoc()){
		$serv->rechazarSolicitud($row2['ID']);
	}
	header('Location: solicitudesRec.php');
?>
