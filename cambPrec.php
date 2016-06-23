<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Panel de administrador</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="css/bootstrap.min.css"/>
	<link rel='stylesheet' href='style.css'/>
	<script src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap-filestyle.min.js"> </script>
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
	<script>
		function validarPrec() {
			var num = document.getElementById("precio").value;
			var pattern = /^-?\d+\.?\d*$/ ;
			if (!num.match(pattern))
				document.getElementById("precio").setCustomValidity("Ingrese un precio válido, decimales separados por un punto '.' ");
			else{
				document.getElementById("precio").setCustomValidity("");
			}
		}
	</script>
</head>
<body>
	<?php
		include('header.php');
		include('adminOptions.php');
		include('anuncioService.php');
		session_start();
		if((isset($_SESSION['usuario']))&&($_SESSION['type']=="admin")){
			$service = new cabecera($_SESSION['usuario']);
			$service->buildHeader();
			$display=new adminMenu();
			$con=new dbManager();
			$con->conectar();
			$consulta=("SELECT * from precio");
			$res=$con->ejecutarSQL($consulta);
			$precio=$res->fetch_assoc();
		}else{
			header('Location:index.html');
		}
	?>
	<div class='row' id='modTH'>
			<div id='vertcentered' class='col-xs-4 col-md-4'>
				Precio actual de la membresía premium
			</div>
			<div class='col-xs-4 col-md-4'>
				<div id='vertcent2'>
					<?php echo "$".$precio['Valor']; ?>
				</div>
			</div>
			<div class='col-xs-2 col-md-2'>
			</div>
			<div class='col-xs-2 col-md-2' id='leftaligned'>
			</div>
		</div>
	
	<form action="cambiarPrecio.php" method="POST" enctype="multipart/form-data" >
		<div class='row' id='modTH'>
			<div id='vertcentered' class='col-xs-4 col-md-4'>
				Cambiar el precio de la membresía premium
			</div>
			<div class='col-xs-4 col-md-4'>
				<input name='precio' id='precio' type='text' placeholder='Ingrese el nuevo precio' onchange='validarPrec()' required>
			</div>
			<div class='col-xs-2 col-md-2'>
			</div>
			<div class='col-xs-2 col-md-2' id='leftaligned'>
				<button type='submit' class='btn3'>Aceptar</button>
			</div>
		</div>
	</form>
	</div>
</body>
</html>