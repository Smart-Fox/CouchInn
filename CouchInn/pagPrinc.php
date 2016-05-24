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
	<h1>Página Principal</h1>
	<?php
		session_start();
		if(isset($_SESSION['usuario'])){
			echo "Bienvenido ", $_SESSION['usuario'], " al sitio";
			echo "Usted es usuario", $_SESSION['type'];
		}else{
			echo "sesion no iniciada";
		}
	?>
</body>
</html>