
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Panel de administrador</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel='stylesheet' href='style.css'/>
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
</head>
<body>
	<?php
		include('header.php');
		session_start();
		if(isset($_SESSION['usuario'])){
			$service = new cabecera($_SESSION['usuario']);
			$service->buildHeader();
			echo "	<div class='row'>
						<div id='feedback' class='col-xs-12 col-md-12'>
							<span>La solicitud fue enviada exitosamente. Cuando su solicitud sea aceptada o rechazada recibirá una notificación.</span>
						</div>
					</div>
					<div class='row'>
						<div id='feedback' class='col-xs-12 col-md-12'>
							<a href='pagPrinc.php'><button type=button class='btn2'>Volver</button></a>
						</div>
					</div>
			";
			
		}else{
			header('Location:index.html');
		}
	?>
</body>
</html>