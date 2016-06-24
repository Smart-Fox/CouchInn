<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Panel de administrador</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="css/bootstrap.min.css"/>
	<link rel='stylesheet' href='style.css'/>
	<script src="js/jquery.min.js"></script>
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
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
		}else{
			header('Location:index.html');
		}
	?>
	<div class='row modTH2' id='modTH'>
		<div id='vertcentered3' class='col-xs-3 col-md-3'>
			Lista de hospedajes actuales
		</div>
		<div class='col-xs-4 col-md-4'>
			<div class='listaT'>
				<?php
					$serv = new aService();
					$tipos = $serv->levantarTipos();
					while ($row = $tipos->fetch_assoc()){
						echo "<li>" . $row['Nombre']. "</li>";
					}
				?>
			</div>
		</div>
		<div class='col-xs-3 col-md-3'>
		</div>
		<div class='col-xs-2 col-md-2'>
		</div>
	</div>
	<form action='newTH.php' method='POST'>
		<div class='row' id='modTH'>
			<div id='vertcentered' class='col-xs-3 col-md-3'>
				Agregar un nuevo tipo de hospedaje
			</div>
			<div class='col-xs-4 col-md-4'>
				<input name='tipoHosp' id='tipoHosp' type='text' placeholder='Ingrese el nuevo tipo de hospedaje' required>
			</div>
			<div class='col-xs-3 col-md-3'>
			</div>
			<div class='col-xs-2 col-md-2' id='leftaligned'>
				<button type='submit' class='btn3'>Aceptar</button>
			</div>
		</div>
	</form>
	<form action='modTH.php' method='POST'>
		<div class='row' id='modTH'>
			<div id='vertcentered' class='col-xs-3 col-md-3'>
				Modificar un tipo de hospedaje existente
			</div>
			<div class='col-xs-4 col-md-4'>
				<select class='form-control custom' id='radb' name='oldtype' required>
					<option selected disabled>Seleccionar tipo de hospedaje a modificar</option>
					<?php
						$serv1 = new aService();
						$tipos1 = $serv1->levantarTipos();
						while ($row1 = $tipos1->fetch_assoc()){
							echo "<option value=\"" . $row1['Nombre']. "\">". $row1['Nombre']."</option>";
						}
					?>
				</select>
			</div>
			<div class='col-xs-3 col-md-3'>
				<input name='tipoHosp' id='tipoHosp' type='text' placeholder='Ingrese el nuevo tipo de hospedaje' required>
			</div>
			<div class='col-xs-2 col-md-2' id='leftaligned'>
				<button type='submit' class='btn3'>Aceptar</button>
			</div>
		</div>
	</form>
	<form action='delTH.php' method='POST'>
		<div class='row' id='modTH'>
			<div id='vertcentered' class='col-xs-3 col-md-3'>
				Eliminar un tipo de hospedaje existente
			</div>
			<div class='col-xs-4 col-md-4'>
				<select class='form-control custom' id='radb' name='tipoHosp' required>
					<option selected disabled>Seleccionar tipo de hospedaje a eliminar</option>
					<?php
						$serv2 = new aService();
						$tipos2 = $serv2->levantarTipos();
						while ($row2 = $tipos2->fetch_assoc()){
							echo "<option value=\"" . $row2['Nombre']. "\">". $row2['Nombre']."</option>";
						}
					?>
				</select>
			</div>
			<div class='col-xs-3 col-md-3'>
			</div>
				<div class='col-xs-2 col-md-2' id='leftaligned'>
				<button type='submit' class='btn3'>Aceptar</button>
			</div>
		</div>
	</form>
</body>
</html>