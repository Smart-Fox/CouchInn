<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Republicar anuncio</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel='stylesheet' href='style.css'/>
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
	<script src="js/jquery.min.js"></script>
</head>
<body>
	<?php
		include('header.php');
		session_start();
		if(isset($_SESSION['usuario'])){
			$service = new cabecera($_SESSION['usuario']);
			$service->buildHeader();
			$id=$_SESSION['id'];
			$idAnun = $_POST['anunc'];
		}else{
			header('Location:index.html');
		}
		echo "	<form action='darAltaPublic.php' method='POST' enctype='multipart/form-data'>
					<input class=hidden name='anunc' value='".$idAnun."'></input>
					<center>
						<span class='content2'>Si republica el anuncio cualquier usuario podrá acceder a él.</span><br>
						¿Desea continuar? <br><br><br>
						<a href='miCuenta.php'><button type='button' class='btn22'>Salir</button></a>
						<button type='submit' class='btn22'>Confirmar</button>
					</center>
				</form>
		";
	?>
	
</body>
</html>