<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Despublicar anuncio</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel='stylesheet' href='style.css'/>
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
	<script src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap-filestyle.min.js"> </script>
	<script type="text/javascript" src= "js/not.js"></script>
	<script type="text/javascript" src= "js/ver.js"></script>
	<script type="text/javascript" src= "js/verSolicitudes.js"></script>
	<script type="text/javascript" src= "js/objeto.js"></script>
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
		echo "	<form action='darBajaPublic.php' method='POST' enctype='multipart/form-data'>
					<input class=hidden name='anunc' value='".$idAnun."'></input>
					<center>
						<span class='content2'>Si oculta el anuncio dejará de ser visible por el resto de los usuarios. Sólo usted tendrá acceso al mismo desde su perfil.</span><br>
						¿Desea continuar? <br><br><br>
						<a href='miCuenta.php'><button type='button' class='btn22'>Salir</button></a>
						<button type='submit' class='btn22'>Confirmar</button>
					</center>
				</form>
		";
	?>
	
</body>
</html>