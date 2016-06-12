<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Solicitar reserva</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="css/bootstrap.min.css" />
	<link rel='stylesheet' href='style.css'/>
	<script src="js/jquery.min.js"></script>
	<script type="text/javascript" src= "js/objeto.js"></script>
	<script type="text/javascript" src="js/bootstrap-filestyle.min.js"> </script>
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
</head>
<body>	
	<?php
		include('header.php');
		session_start();
		if(isset($_SESSION['usuario'])){
			if(isset($_POST['anunc'])){
				$id=$_POST['anunc'];
				$service = new cabecera($_SESSION['usuario']);
				$service->buildHeader();
			}
		}else{
			header('Location:index.html');
		}
	?>
	<center>
		<h3>
			Complete todos los datos de su reserva y luego presione "Solicitar"
		</h3>
		<form action="solicitarReserva.php" method="POST" enctype="multipart/form-data">
			<div class='row'>
				<div class='col-xs-2 col-md-2'>
				</div>
				<div class='col-xs-5 col-md-5'>
					<span class='labelform2'>Comentario:</span><br>
					<textarea type="text" name='desc' id='desc' placeholder='Cualquier información que considere relevante' required></textarea>
				</div>
				<div class='col-xs-3 col-md-3'>
					<div class='row'>
						<span class='labelform2'>Cantidad de personas:</span>
						<input type="number" name = 'cantidad' id='cantidad' min="1" placeholder="Ej: 3" required>
					</div>
					<div class='row'>
						<span class='labelform2'>Fecha inicio:</span><br>
					</div>
					<div class='row'>
						<span class='labelform2'>Fecha fin:</span><br>
					</div>
				</div>
				<div class='col-xs-2 col-md-2'>
				</div>
			</div>
			<div class='row'>
				<div class='col-xs-4 col-md-4'>	
				</div>
				<div class='col-xs-4 col-md-4'>	
					<a href='pagPrinc.php'><button id="cancelar" type=button class='btn btn-danger'>Cancelar</button></a>
					<button type="submit" class="btn">Reservar</button>
				</div>
				<div class='col-xs-4 col-md-4'>
				</div>
			</div>
		</form>
	</center>
</body>
</html>