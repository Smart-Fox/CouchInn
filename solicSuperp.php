<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>CouchInn</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="css/bootstrap.min.css"/>
	<link rel='stylesheet' href='style.css'/>
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
	<script src="js/jquery.min.js"></script>
	<script type="text/javascript" src= "js/objeto.js"></script>
	<script type="text/javascript" src="js/bootstrap-filestyle.min.js"> </script>
</head>
<body>
<?php
	include('anuncioService.php');
	$bool=false;
	$idSolic=$_POST['solic'];
	$serv = new aService();
	$solic = $serv->levantarSolicitud($idSolic);
	$row=$solic->fetch_assoc();
	$superp=$serv->levantarSolicitudesFecha($row['fecha_inicio'], $row['fecha_fin'], $idSolic, $row['ID_anuncio']);
	$serv->aceptarSolicitud($idSolic);
	while($row2 = $superp->fetch_assoc()){
		$serv->rechazarSolicitud($row2['solicitud_ID']);
	}
	$bool=true;
	if($bool){
		echo "	
			<form id='back2' action='solicitudes.php' method='POST' enctype='multipart/form-data'>
				<input class='hidden' name='tipo' value='recibidas'>	
			</form>
			<script type='text/javascript'>
				function submitForm() {
						document.getElementById('back2').submit();
				}
				window.onload = submitForm;
			</script>
			";
	}
	?>
</body>
</html>
