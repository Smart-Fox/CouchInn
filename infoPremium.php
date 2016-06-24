
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Información premium</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="css/bootstrap.min.css"/>
	<link rel='stylesheet' href='style.css'/>
	<script src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap-filestyle.min.js"></script>
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico"/>
</head>
<body>
	<?php
		include('header.php');
		include('adminOptions.php');
		include('dbManager.php');
		session_start();
		if((isset($_SESSION['usuario']))&&($_SESSION['type']=='common')){
			$service = new cabecera($_SESSION['usuario']);
			$service->buildHeader();
		}else{
			header('Location:index.html');
		}
		$conec = new dbManager();
		$conec->conectar();
		$consulta = "SELECT * FROM precio";
		$resulSQL= $conec->ejecutarSQL($consulta);
		$prec=$resulSQL->fetch_assoc();
	?>
	<div class='row'>
		<div class='col-xs-3 col-md-3'>
		</div>
		<div class='col-xs-6 col-md-6'>
			<h2 class='prem'>Comprar membresía premium</h2>
		</div>
		<div class='col-xs-3 col-md-3'>
		</div>
	</div>
	
	<div class='row'>
		<div class='col-xs-2 col-md-2'>
		</div>
		<div class='col-xs-8 col-md-8'>
			<p class='prem'>	La membresía premium se compra por única vez, a un precio de $<?php echo $prec['Valor']; ?>.
				Con la compra de la membresía premium, usted colabora con el mantenimiento de este sitio.
				La membresía premium incluye la posibilidad de que sus anuncios, tanto en la página principal como en los resultados de búsquedas, incluyan una miniatura de la foto publicada.
				Actualmente sólo se permiten pagos con tarjeta de crédito.
			</p>
		</div>
		<div class='col-xs-2 col-md-2'>
		</div>
	</div>
	<div class='row'>
		<div class='col-xs-4 col-md-4'>
		</div>
		<div class='col-xs-2 col-md-2'>
			<a href='pagPrinc.php'><button class='btn'>Volver</button></a>
		</div>
		<div class='col-xs-2 col-md-2'>
			<a href='comprarPrem.php'><button class='btn'>Comprar</button></a>
		</div>
		<div class='col-xs-4 col-md-4'>
		</div>
	</div>
	
</body>
</html>