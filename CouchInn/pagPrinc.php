
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
	<?php
		include('header.php');
		session_start();
		if(isset($_SESSION['usuario'])){
			$service = new cabecera($_SESSION['usuario']);
			$service->buildHeader();
			echo "<a href='publicar.html'><button type=button class='btn'>Publicar anuncio</button></a>";
		}else{
			header('Location:index.html');
		}
	?>
	
</body>
</html>