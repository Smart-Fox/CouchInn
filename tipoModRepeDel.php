
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Panel de administrador</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel='stylesheet' href='style.css'/>
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
	<script src="js/jquery.min.js"></script>
</head>
<body>
	<?php
		include('header.php');
		include('adminOptions.php');
		session_start();
		if((isset($_SESSION['usuario']))&&($_SESSION['type']=="admin")){
			$service = new cabecera($_SESSION['usuario']);
			$service->buildHeader();
			$display=new adminMenu();
			echo "	<div class='row'>
						<div id='feedback' class='col-xs-12 col-md-12'>
							<p>El tipo de hospedaje ingresado fue eliminado anteriormente del sistema, pero aun está siendo utilizado por uno o más anuncios, <br>
							por lo que no está disponible para realizar la modificación.<br>
							Si desea utilizar nuevamente el tipo de hospedaje eliminado, vuelva a agregarlo al sistema.<br>
							No fue modificado el tipo de hospedaje original.</p>
						</div>
					</div>
					<div class='row'>
						<div id='feedback' class='col-xs-12 col-md-12'>
							<a href='admTH.php'><button type=button class='btn2'>Volver</button></a>
						</div>
					</div>
			";
			
		}else{
			header('Location:index.html');
		}
	?>
</body>
</html>