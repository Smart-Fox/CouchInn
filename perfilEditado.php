<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Editar perfil</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="css/bootstrap.min.css"/>
	<link rel='stylesheet' href='style.css'/>
	<script language= "javascript" src= "js/validation.js"></script>
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
</head>
<body>
	<?php
		include('header.php');
		session_start();
		if(isset($_SESSION['usuario'])){
			$service = new cabecera($_SESSION['usuario']);
			$service->buildHeader();
		}else{
			header('Location:index.html');
		}
	?>
	<div class='row'>
		<div id='feedback' class='col-xs-12 col-md-12'>
			<span>Los datos de perfil fueron actualizados exitosamente</span>
		</div>
	</div>
	<div class='row'>
		<div id='feedback' class='col-xs-12 col-md-12'>
			<form id="back" action='verPerfil.php' method='POST' enctype='multipart/form-data'>
				<input class='hidden' name='id' value='<?php echo $_SESSION['id']; ?>'>	
				<button type=submit class='btn2'>Volver</button>				
			</form>
		</div>
	</div>
</body>
</html>