<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Página Principal</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel='stylesheet' href='style.css'/>
	<script language= "javascript" src= "js/validation.js"></script>
</head>
<body>
	<img src=logo.png width=500>
	<h1>Página Principal</h1>
	<?php
		session_start();
		if(isset($_SESSION['usuario'])){
			echo "Bienvenido ", $_SESSION['usuario'], " al sitio\n";
			echo "Usted es usuario", $_SESSION['type'], "\n";
			echo "<a href='cerrarSesion.php'><button type='button' class='btn'>Cerrar Sesión</button></a>";
		}else{
			header('Location:index.html');
		}
	?>
	
</body>
</html>