<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Página Principal</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="css/bootstrap.min.css" />
	<link rel='stylesheet' href='style.css'/>
	<script src="js/jquery.min.js"></script>
	<script type="text/javascript" src= "js/objeto.js"></script>
	<script type="text/javascript" src="js/bootstrap-filestyle.min.js"> </script>
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
	<center>
		<h1>
			Publicar un anuncio
		</h1>
		<h3>
			Complete todos los datos de su anuncio y luego presione "Publicar"
		</h3>
		<form action="publicarAnuncio.php" method="POST" enctype="multipart/form-data" onsubmit="javascript: validacion();">
			<div class='row'>
				<div class='col-xs-2 col-md-2'>
				</div>
				<div class='col-xs-8 col-md-8'>
					<span class='labelform2'>Título:</span><br>
					<input type="text" name = 'titulo' id='titulo' placeholder='Ej: Cabaña en medio del bosque' required>
				</div>
				<div class='col-xs-2 col-md-2'>
				</div>
			</div>
			<div class='row'>
				<div class='col-xs-2 col-md-2'>
				</div>
				<div class='col-xs-5 col-md-5'>
					<span class='labelform2'>Descripción:</span><br>
					<textarea type="text" name='desc' id='desc' placeholder='Cualquier información que considere relevante' required></textarea>
				</div>
				<div class='col-xs-3 col-md-3'>
					<div class='row'>
						<span class='labelform2'>Tipo de hospedaje:</span><br>
						<select id='tipo' class="form-control custom" name="tipo" required>
							<option selected="true" disabled="disabled" value=""> Seleccionar </option>
							<?php
								include('anuncioService.php');
								$serv = new aService();
								$tipos = $serv->levantarTipos();
								print_r($tipos);
								while ($row = $tipos->fetch_assoc()){
									echo "<option value=\"" . $row['ID']. "\">". $row['Nombre']."</option>";
								}
							?>
						</select>
					</div>
					<div class='row'>
						<span class='labelform2'>Capacidad (cantidad de personas):</span>
						<input type="number" name = 'capacidad' id='capacidad' min="1" placeholder="Ej: 3" required>
					</div>
					<div class='row'>
						<span class='labelform2'>Provincia:</span><br>
						<select id="provSelect" name="provincia" class="form-control custom" onchange="cambiarCiudad('p');" required>
							<option selected="true" disabled="disabled" value=""> Seleccionar </option>
							<?php
								$provincias = $serv->levantarProv();
								while ($row = $provincias->fetch_assoc()){
									echo "<option value=\"" . $row['ID']. "\">". $row['Nombre']."</option>";
								}
							?>
						</select>
					</div>
					<div class='row'>
						<span class='labelform2'>Ciudad:</span><br>
						<select id="ciudadSelect" name="ciudad" class="form-control custom" required>
							<option selected="true" disabled="disabled" value=""> Seleccionar </option>
						</select>
					</div>
					<div class='row'>
						<span class='labelform2'>Foto:</span><br>
						<input  type="file" class="filestyle" name="fileToUpload" id="fileToUpload" data-buttonBefore="true" data-input="true" data-icon="false" data-size="sm" data-buttonName="btn-primary" data-buttonText="Subir foto" data-placeholder="Ningún archivo seleccionado" required>
					</div>
				</div>
				<div class='col-xs-2 col-md-2'>
				</div>
			</div>
			<div class='row'>
				<div class='col-xs-4 col-md-4'>	
				</div>
				<div class='col-xs-4 col-md-4'>	

					<a href='pagPrinc.php'><button id="cancelar" type=button class='btn btn-danger'>Cancelar</button></a>

					<button type="submit" class="btn">Publicar</button>
				</div>
				<div class='col-xs-4 col-md-4'>
				</div>
			</div>
		</form>
	</center>
</body>
</html>