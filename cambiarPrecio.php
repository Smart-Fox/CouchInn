<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Panel de administrador</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel='stylesheet' href='style.css'/>
	<script src="js/jquery.min.js"></script>
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
</head>
<body>
	<?php
		include('header.php');
		include('adminOptions.php');
		include('dbManager.php');
		$precio = $_POST['precio'];
		$serv=new dbManager();
		$serv->conectar();
		$consulta = ("UPDATE precio SET Valor='$precio'");
		$serv->ejecutarSQL($consulta);
		session_start();
		if((isset($_SESSION['usuario']))&&($_SESSION['type']=="admin")){
			$service = new cabecera($_SESSION['usuario']);
			$service->buildHeader();
			$display=new adminMenu();
			echo "	<div class='row'>
						<div id='feedback' class='col-xs-12 col-md-12'>
							<span>El precio de la membresía premium fue modificado exitosamente</span>
						</div>
					</div>
					<div class='row'>
						<div id='feedback' class='col-xs-12 col-md-12'>
							<a href='cambPrec.php'><button type=button class='btn2'>Volver</button></a>
						</div>
					</div>
			";
			
		}else{
			header('Location:index.html');
		}
	
	?>