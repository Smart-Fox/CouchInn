<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Detalle de Solicitud</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel='stylesheet' href='style.css'/>
	<script src="js/jquery.min.js"></script>
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
</head>
<body>
	<?php
		include('anuncioService.php');
		include('header.php');
		session_start();
		if(isset($_SESSION['usuario'])){
			if(isset($_POST['anunc'])){
				$id=$_POST['anunc'];
				$service = new cabecera($_SESSION['usuario']);
				$service->buildHeader();
				$serv = new aService();
				$anun = $serv->levantarAnuncio($id);
				$row = $anun->fetch_assoc();
				$fecha=date('d/m/Y H:i', strtotime($row['Fecha']));
			}else{
				header('Location:pagPrinc.php');
			}
		}else{
			header('Location:index.html');
		} 
	?>
	<center>
		<?php
			$solicitud = $serv->levantarSolicitud($_POST['idsol']);

		?>
		<div class='anunciodet'>

		</div>
	</center>

</body>
</html>