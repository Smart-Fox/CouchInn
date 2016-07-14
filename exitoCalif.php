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
		
		}else{
			header('Location:index.html');
		}
	?>

		<center>
		<div class='main'>
			<br>
			<h2><span>Se ha enviado la calificación</span></h2>
			<h2><span>¡Muchas gracias!</h2></span>
			<br>
			<a href="pagPrinc.php"><button class = 'btn'>Aceptar</button></a>
		</div>
	</center>
	
</body>
</html>