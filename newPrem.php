
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Información premium</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="css/bootstrap.min.css"/>
	<link rel='stylesheet' href='style.css'/>
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
	<script src="js/jquery.min.js"></script>
</head>
<body>
	<?php
		include('header.php');
		include('adminOptions.php');
		include('dbManager.php');
		session_start();
		if(isset($_SESSION['usuario'])){
			$service = new cabecera($_SESSION['usuario']);
			$service->buildHeader();
		}else{
			header('Location:index.html');
		}
	?>
	<div class='row'>
		<div class='col-xs-2 col-md-2'>
		</div>
		<div class='col-xs-8 col-md-8'>
			<p class='prem' id='new'>
				Muchas gracias por su colaboración.<br> 
				¡Ahora puede disfrutar de su membresía premium!
			</p>
		</div>
		<div class='col-xs-2 col-md-2'>
		</div>
	</div>
	<div class='row'>
		<div class='col-xs-4 col-md-4'>
		</div>
		<div class='col-xs-4 col-md-4' id='centerbtn'>
			<a href='pagPrinc.php'><button class='btn'>Volver</button></a>
		</div>
		<div class='col-xs-4 col-md-4'>
		</div>
	</div>
	
</body>
</html>