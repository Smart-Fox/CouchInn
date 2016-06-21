<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Preguntas enviadas</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel='stylesheet' href='style.css'/>
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
	<script src="js/jquery.min.js"></script>
	<script type="text/javascript" src= "js/objeto.js"></script>
	<script type="text/javascript" src="js/bootstrap-filestyle.min.js"> </script>
</head>
<body>
	<?php
		include('header.php');
		include('anuncioService.php');
		include('cuentaOptions.php');
		session_start();
		if(isset($_SESSION['usuario'])){
			$service = new cabecera($_SESSION['usuario']);
			$service->buildHeader();
			$display=new cuentaMenu();
			$id=$_SESSION['id'];
			$solic=$_POST['solic'];
		}else{
			header('Location:index.html');
		}
		echo "	<form action='responderSolicitud.php' method='POST' enctype='multipart/form-data'>
					<input class=hidden name='resp' value='cancelar'></input>
					<input class=hidden name='solic' value='".$solic."'></input>
					<center>
						<span class='content2'>¿Confirma que desea cancelar la reserva? Esta operación no se puede revertir.</span><br>
						<a href='miCuenta.php'><button type='button' class='btn22'>Salir</button></a>
						<button type='submit' class='btn22'>Confirmar</button>
					</center>
				</form>
		";
	?>
	
</body>
</html>