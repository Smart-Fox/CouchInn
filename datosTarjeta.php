
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Compra de servicio premium</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="css/bootstrap.min.css"/>
	<link rel='stylesheet' href='style.css'/>
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
	<script src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap-filestyle.min.js"> </script>
	<script type="text/javascript" src= "js/not.js"></script>
	<script type="text/javascript" src= "js/verSolicitudes.js"></script>
	<script type="text/javascript" src= "js/ver.js"></script>
</head>
<body>
	<?php
		include('header.php');
		include('adminOptions.php');
		session_start();
		if((isset($_SESSION['usuario']))&&($_SESSION['type']=='common')){
			$service = new cabecera($_SESSION['usuario']);
			$service->buildHeader();
		}else{
			header('Location:index.html');
		}
	?>
	<div class='row'>
		<div class='col-xs-3 col-md-3'>
		</div>
		<div class='col-xs-6 col-md-6'>
			<h2>Ingrese los datos de su tarjeta de crédito</h2>
		</div>
		<div class='col-xs-3 col-md-3'>
		</div>
	</div>
	<div class='row'>
		<div class='col-xs-3 col-md-3'>
		</div>
		<div class='col-xs-6 col-md-6'>
			Tarjeta
			<select></select>
		</div>
		<div class='col-xs-3 col-md-3'>
		</div>
	</div>
	<div class='row'>
		<div class='col-xs-3 col-md-3'>
		</div>
		<div class='col-xs-6 col-md-6'>
			Número de tarjeta
			<input></input>
		</div>
		<div class='col-xs-3 col-md-3'>
		</div>
	</div>
	<div class='row'>
		<div class='col-xs-3 col-md-3'>
		</div>
		<div class='col-xs-6 col-md-6'>
			CVV
			<input></input>
		</div>
		<div class='col-xs-3 col-md-3'>
		</div>
	</div>
	<div class='row'>
		<div class='col-xs-3 col-md-3'>
		</div>
		<div class='col-xs-6 col-md-6'>
			Titular
			<input></input>
		</div>
		<div class='col-xs-3 col-md-3'>
		</div>
	</div>
	<div class='row'>
		<div class='col-xs-3 col-md-3'>
		</div>
		<div class='col-xs-6 col-md-6'>
			Vencimiento
			<select></select>
			<select></select>
		</div>
		<div class='col-xs-3 col-md-3'>
		</div>
	</div>
</body>
</html>