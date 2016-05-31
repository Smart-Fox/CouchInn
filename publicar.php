<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Página Principal</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel='stylesheet' href='style.css'/>
	<script src="js/jquery.min.js"></script>
	<script type="text/javascript" src= "js/objeto.js"></script>
	<script language= "javascript" src= "js/validation.js"></script>
	
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
			<div class='row' id='reg'>
				<div class='col-xs-2 col-md-2'>
				</div>
				<div class='col-xs-8 col-md-8'>
					<input type="text" name = 'titulo' id='titulo' placeholder='Titulo del anuncio' required>
				</div>
				<div class='col-xs-2 col-md-2'>
				</div>
			</div>
			<div class='col-xs-2 col-md-2'>
			</div>
			<div class='col-xs-5 col-md-5'>	
				<textarea rows="10" cols="80" type="text" name = 'desc' id='desc' placeholder='Descripción' required></textarea>
			</div>
			<div class='col-xs-3 col-md-3'>
				<div class='row' id='reg'>
					<select id='tipo' class="form-control custom" name="tipo" required>
						<option selected="true" disabled="disabled" value=""> Tipo de hospedaje </option>
						<?php
							include('anuncioService.php');
							$serv = new aService();
							$tipos = $serv->levantarTipos();
							while ($row = $tipos->fetch_assoc()){
								echo "<option value=\"" . $row['ID']. "\">". $row['Nombre']."</option>";
							}
						?>
					</select>
				</div>
				<div class='row' id='reg'>
					<input type="text" name = 'capacidad' id='capacidad' placeholder="Capacidad" required>
				</div>
				<div class='row' id='reg'>
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
				<div class='row' id='reg'>
					<select id="ciudadSelect" name="ciudad" class="form-control custom" required>
						<option selected="true" disabled="disabled" value=""> Seleccione una ciudad </option>
					</select>
				</div>
				<div class='row' id='reg'>
					<input  type="file" name="fileToUpload" id="fileToUpload" content="Subir una foto">
				</div>
			</div>
			<div class='row' id='reg'>
				<div class='col-xs-4 col-md-4'>	
				</div>
				<div class='col-xs-4 col-md-4'>	
					<button type="submit" class="btn">Publicar</button>
				</div>
				<div class='col-xs-4 col-md-4'>
				</div>
			</div>
		</form>
	</center>
</body>
</html>