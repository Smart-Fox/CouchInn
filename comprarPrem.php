
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Compra de servicio premium</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="css/bootstrap.min.css"/>
	<link rel='stylesheet' href='style.css'/>
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
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
		<div class='col-xs-2 col-md-2'>
		</div>
		<div class='col-xs-8 col-md-8'>
			<h3 class='prem'>Para realizar el pago de $<?php echo $prec['Valor']?> para adquirir la membresía premium, ingrese los datos de su tarjeta de crédito</h3>
		</div>
		<div class='col-xs-2 col-md-2'>
		</div>
	</div>
	<div class='row'>
		<div class='col-xs-3 col-md-3'>
		</div>
		<div class='col-xs-6 col-md-6'>
			Tarjeta
			<select></select>
		</div>
		<div class='col-xs-3 col-md-3'>
		</div>
	</div>
	<div class='row'>
		<div class='col-xs-3 col-md-3'>
		</div>
		<div class='col-xs-6 col-md-6'>
			Número de tarjeta
			<input></input>
		</div>
		<div class='col-xs-3 col-md-3'>
		</div>
	</div>
	<div class='row'>
		<div class='col-xs-3 col-md-3'>
		</div>
		<div class='col-xs-6 col-md-6'>
			CVV
			<input></input>
		</div>
		<div class='col-xs-3 col-md-3'>
		</div>
	</div>
	<div class='row'>
		<div class='col-xs-3 col-md-3'>
		</div>
		<div class='col-xs-6 col-md-6'>
			Titular
			<input></input>
		</div>
		<div class='col-xs-3 col-md-3'>
		</div>
	</div>
	<div class='row'>
		<div class='col-xs-3 col-md-3'>
		</div>
		<div class='col-xs-6 col-md-6'>
			Vencimiento
			<select></select>
			<select></select>
		</div>
		<div class='col-xs-3 col-md-3'>
		</div>
	</div>
</body>
</html>