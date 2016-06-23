<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Editar anuncio</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel='stylesheet' href='style.css'/>
	<script src="js/jquery.min.js"></script>
	<script type="text/javascript" src= "js/objeto.js"></script>
	<script type="text/javascript" src="js/bootstrap-filestyle.min.js"> </script>
	<script src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap-filestyle.min.js"> </script>
	<script type="text/javascript" src= "js/not.js"></script>
	<script type="text/javascript" src= "js/verSolicitudes.js"></script>
	<script type="text/javascript" src= "js/ver.js"></script>
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
</head>
<body>	
	<?php
		include('anuncioService.php');
		include('header.php');
		session_start();
		if(isset($_SESSION['usuario'])){
			if(isset($_POST['anunc'])){
				$id=$_POST['anunc'];
				$service = new cabecera($_SESSION['usuario']);
				$service->buildHeader();
				$serv = new aService();
				$anun = $serv->levantarAnuncio($id);
				$row = $anun->fetch_assoc();
			}else{
				header('Location:pagPrinc.php');
			}
		}else{
			header('Location:index.html');
		}
	?>
	<center>	
		<h1>
			Editar anuncio
		</h1>
		<h3>
			Modifique los datos de su anuncio que desee y luego presione "Guardar"
		</h3>
		<form id="editar" action="guardarCambios.php" method="POST" enctype="multipart/form-data" onsubmit="javascript: validacion();">
			<div class='row'>
				<div class='col-xs-2 col-md-2'>
				</div>
				<div class='col-xs-8 col-md-8'>
					<span class='labelform2'>Título:</span><br>
					<input type="text" name = 'titulo' id='titulo' value=<?php echo '"'.$row['Titulo'].'"'?> required>
				</div>
				<div class='col-xs-2 col-md-2'>
				</div>
			</div>
			<div class='row'>
				<div class='col-xs-2 col-md-2'>
				</div>
				<div class='col-xs-5 col-md-5'>
					<span class='labelform2'>Descripción:</span><br>
					<textarea type="text" name='desc' id='desc' required><?php echo $row['Descripcion'];?></textarea>
				</div>
				<div class='col-xs-3 col-md-3'>
					<div class='row'>
						<span class='labelform2'>Tipo de hospedaje:</span><br>
						<select id='tipo' class="form-control custom" name="tipo" required>
							<option selected="true" value=<?php echo $row['ID_tipo_hospedaje'];?>><?php echo $row['tipo_hospedaje_Nombre'];?></option>
							<?php
								$tipos = $serv->levantarTipos();
								while ($fila = $tipos->fetch_assoc()){
									if($fila['ID']!=$tipo['ID']) {echo "<option value=\"" . $fila['ID']. "\">". $fila['Nombre']."</option>";
								}}
							?>
						</select>
					</div>
					<div class='row'>
						<span class='labelform2'>Capacidad (cantidad de personas):</span>
						<input type="number" name = 'capacidad' id='capacidad' min="1" value=<?php echo $row['Capacidad'];?> required>
					</div>
					<div class='row'>
						<span class='labelform2'>Provincia:</span><br>
						<select id="provSelect" name="provincia" class="form-control custom" onchange="cambiarCiudad('p');" required>
							<option selected="true" value=<?php echo $row['provincia_ID'];?>> <?php echo $row['provincia_Nombre'];?></option>
							<?php
								$provincias = $serv->levantarProv();
								while ($fila = $provincias->fetch_assoc()){
									if ($fila['ID']!=$row['provincia_ID']){echo "<option value=\"" . $fila['ID']. "\">". $fila['Nombre']."</option>";
								}}
							?>
						</select>
					</div>
					<div class='row'>
						<span class='labelform2'>Ciudad:</span><br>
						<select id="ciudadSelect" name="ciudad" class="form-control custom" required>
							<option selected="true" value=<?php echo $row['ID_ciudad'];?>> <?php echo $row['ciudad_nombre'];?> </option>
							<?php
								$row_ciudad= $serv->levantarCiudad($row['provincia_ID']);
								while($fila = $row_ciudad->fetch_assoc()){
									if ($fila['ID']!=$row['ID_ciudad']){echo "<option value=\"" . $fila['ID']. "\">". $fila['nombre']."</option>";
								}}
							?>
						</select>
					</div>
					<div class='row'>
						<?php 
							$link=$row['enlace'] 
						?>
						<span class='labelform2'>Foto:</span><br>
						<input  type="file" class="filestyle" name="fileToUpload" id="fileToUpload" data-buttonBefore="true" data-input="true" data-icon="false" data-size="sm" data-buttonName="btn-primary" data-buttonText="Subir foto" data-placeholder="Ningún archivo seleccionado">
					</div>
				</div>
				<div class='col-xs-2 col-md-2'>
				</div>
				<input class=hidden name='anunc' value=<?php echo $id?>> 
			</form>
			</div>
			<form id="back" action='anuncDetalle.php' method='POST' enctype='multipart/form-data'>
				<input class=hidden name='anunc' value=<?php echo $id?>>			
			</form>
			<div class='row'>
				<div class='col-xs-4 col-md-4'>	
				</div>
				<div class='col-xs-4 col-md-4'>	
					<button id="cancelar" type=submit class='btn btn-danger' form="back">Cancelar</button>
					<button type="submit" class="btn" form="editar">Guardar</button>
				</div>
				<div class='col-xs-4 col-md-4'>
				</div>
			</div>
	</center>
</body>
</html>
