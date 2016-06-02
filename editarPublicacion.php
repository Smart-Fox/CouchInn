<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Página Principal</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel='stylesheet' href='style.css'/>
	<script src="js/jquery.min.js"></script>
	<script type="text/javascript" src= "js/objeto.js"></script>
	<script language= "javascript" src= "js/validation.js"></script>
	<script type="text/javascript" src="js/bootstrap-filestyle.min.js"> </script>
</head>
<body>	
	<?php
		
		
		include('anuncioService.php');
		include('header.php');
		session_start();
		if(isset($_SESSION['usuario'])){
			$service = new cabecera($_SESSION['usuario']);
			$service->buildHeader();
			$serv = new aService();
			$id=$_POST['anunc'];
			$anun = $serv->levantarAnuncio($id);
			$row = $anun->fetch_assoc();
			var_dump($row);


		}
	?>
	<center>
		
		<h1>
			Editando anuncio
		</h1>
		<h3>
			Modifique los datos de su anuncio que desee y luego presione "Guardar"
		</h3>
		
	</center>
</body>
</html>
