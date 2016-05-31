<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Panel de administrador</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel='stylesheet' href='style.css'/>
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
		}else{
			header('Location:index.html');
		}
	?>
			
	<form action='newTH.php' method='POST'>
		<div class='row' id='modTH'>
			<div id='vertcentered' class='col-xs-3 col-md-3'>
				Agregar un nuevo tipo de hospedaje
			</div>
			<div class='col-xs-4 col-md-4'>
				<input name='tipoHosp' id='tipoHosp' type='text' placeholder=' Ingrese el nuevo tipo de hospedaje'>
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
						$conn = new mysqli('localhost', 'root', '', 'couchinn') or die ('Cannot connect to db');
						$result = $conn->query("select Nombre from tipo_hospedaje");
						while ($row = $result->fetch_assoc()) {
						unset($name);
						$name = $row['Nombre']; 
						echo '<option value="'.$name.'">'.$name.'</option>';
						}
					?>
				</select>
			</div>
			<div class='col-xs-3 col-md-3'>
				<input name='tipoHosp' id='tipoHosp' type='text' placeholder=' Ingrese el nuevo tipo de hospedaje'>
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
				<select class='form-control custom' id='radb' required>
					<option selected disabled>Seleccionar tipo de hospedaje a eliminar</option>
					<?php
						$conn = new mysqli('localhost', 'root', '', 'couchinn') or die ('Cannot connect to db');
						$result = $conn->query("select * from tipo_hospedaje");
						while ($row = $result->fetch_assoc()) {
						unset($id, $name);
						$id = $row['ID'];
						$name = $row['Nombre']; 
						echo '<option value="'.$id.'">'.$name.'</option>';
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