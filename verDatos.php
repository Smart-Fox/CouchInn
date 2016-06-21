<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Perfil</title>
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
		session_start();
		if(isset($_SESSION['usuario'])){
			if(isset($_POST['user'])){
				$service = new cabecera($_SESSION['usuario']);
				$service->buildHeader();
				$id=$_POST['user'];
			}else{
				header('Location:pagPrinc.php');
			}
		}else{
			header('Location:index.html');
		}
		$serv = new aService();
		$anun = $serv->levantarAnuncioDeUsuario($id);
		$us = $serv->levantarUsuario($id);
		$rowUs = $us->fetch_assoc();
		$nomUser = $rowUs['Username'];
		$nombre = $rowUs['Nombre'];
		$apellido = $rowUs['Apellido'];
		$email = $rowUs['Email'];
		$telefono = $rowUs['Telefono'];
		echo "	<div class='row'>
					<div class='col-xs-2 col-md-2'>
					</div>
					<div class='col-xs-8 col-md-8 anuncio '>
						<div class='row'>
							<div class='col-xs-4 col-md-4'>
							</div>
							<div class='col-xs-8 col-md-8'>
								<h2><strong>Datos del usuario <br></strong></h2>
								<h3>
									Nombre: <strong><span class='titulo2'>".$nombre."</span></strong> <strong><span class='titulo2'>".$apellido."</span></strong> <br>
									Teléfono:	<strong><span class='titulo2'>".$telefono."</span></strong> <br>
									Email: 	<strong><span class='titulo2'>".$email."</span></strong> <br>
								</h3>
								<a href='pagPrinc.php'><button class='btn22'>Salir</button></a>
							</div>
						</div>
					</div>
					<div class='col-xs-2 col-md-2'>
					</div>
				</div>
		";
	?>
	
</body>
</html>