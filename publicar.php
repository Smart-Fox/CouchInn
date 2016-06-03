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
	<script language= "javascript" src= "js/validation.js"></script>
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
			<div class='row reg'>
				<div class='col-xs-2 col-md-2'>
				</div>
				<div class='col-xs-8 col-md-8'>
					<input type="text" name = 'titulo' id='titulo' placeholder='Título del anuncio' required>
				</div>
				<div class='col-xs-2 col-md-2'>
				</div>
			</div>
			<div class='col-xs-2 col-md-2'>
			</div>
			<div class='col-xs-5 col-md-5' style=" width:40%" >	
				<textarea rows="10" cols="80" type="text" style=" width:100%" name = 'desc' id='desc' placeholder='Descripción' required></textarea>
			</div>
			<div style="width: 30%" class='col-xs-3 col-md-3'>
				<div class='row reg'>
					<select id='tipo' class="form-control custom" name="tipo" required>
						<option selected="true" disabled="disabled" value=""> Tipo de hospedaje </option>
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
				<div class='row reg'>

					<input type="number" name = 'capacidad' id='capacidad' min="1" placeholder="Capacidad (cantidad de personas)" required>

				</div>
				<div class='row reg'>
					<select id="provSelect" name="provincia" class="form-control custom" onchange="cambiarCiudad();" required>
						<option selected="true" disabled="disabled" value=""> Seleccione una provincia </option>
						<?php
							$provincias = $serv->levantarProv();
							while ($row = $provincias->fetch_assoc()){
								echo "<option value=\"" . $row['ID']. "\">". $row['Nombre']."</option>";
							}
						?>
					</select>
				</div>
				<div class='row reg'>
					<select id="ciudadSelect" name="ciudad" class="form-control custom" required>
						<option selected="true" disabled="disabled" value=""> Seleccione una ciudad </option>
					</select>
				</div>
				<div class='row reg'>

					<input  type="file" class="filestyle" name="fileToUpload" id="fileToUpload" data-buttonBefore="true" data-input="true" data-icon="false" data-size="sm" data-buttonName="btn-primary" data-buttonText="Subir foto" data-placeholder="Ningún archivo seleccionado">

				</div>
			</div>
			<div class='row reg'>
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