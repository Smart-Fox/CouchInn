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
	<script type="text/javascript" src="js/bootstrap-filestyle.min.js"> </script>
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
</head>
<body>	
	<?php
		
		
		include('anuncioService.php');
		include('header.php');
		session_start();
		if(isset($_SESSION['usuario'])){
			$service = new cabecera($_SESSION['usuario']);
			$service->buildHeader();
			$serv = new aService();
			$id=$_POST['anunc'];
			$anun = $serv->levantarAnuncio($id);
			$row = $anun->fetch_assoc();
		}
	?>
	<center>	
		<h1>
			Editando anuncio
		</h1>
		<h3>
			Modifique los datos de su anuncio que desee y luego presione "Guardar"
		</h3>
		<form id="editar" action="guardarCambios.php" method="POST" enctype="multipart/form-data" onsubmit="javascript: validacion();">
			<div class='row reg'>
				<div class='col-xs-2 col-md-2'>
				</div>
				<div class='col-xs-8 col-md-8'>
					<input type="text" name = 'titulo' id='titulo' value=<?php echo $row['Titulo'];?> required>
				</div>
				<div class='col-xs-2 col-md-2'>
				</div>
			</div>
			<div class='col-xs-2 col-md-2'>
			</div>
			<div class='col-xs-5 col-md-5' style=" width:40%" >	
				<textarea rows="10" cols="80" type="text" style=" width:100%" name = 'desc' id='desc'  required><?php echo $row['Descripcion'];?></textarea>
			</div>
			<div style="width: 30%" class='col-xs-3 col-md-3'>
				<div class='row reg'>
					<select id='tipo' class="form-control custom" name="tipo" required>
						<?php $res = $serv->levantarAnuncioTipo($row['ID_tipo_hospedaje']);
						$tipo = $res->fetch_assoc();
						?>
						<option selected="true" value=<?php echo $tipo['ID'];?>><?php echo $tipo['Nombre'];?></option>
						<?php
							$tipos = $serv->levantarTipos();
							while ($fila = $tipos->fetch_assoc()){
								if($fila['ID']!=$tipo['ID']) {echo "<option value=\"" . $fila['ID']. "\">". $fila['Nombre']."</option>";
							}}
						?>
					</select>
				</div>
				<div class='row reg'>

					<input type="number" name = 'capacidad' id='capacidad' min="1" value=<?php echo $row['Capacidad'];?> required>

				</div>
				<div class='row reg'>
					<select id="provSelect" name="provincia" class="form-control custom" onchange="cambiarCiudad();" required>
						<?php 
							$res =	$serv->levantarAnuncioCiudad($row['ID_ciudad']);
							$ciudad = $res->fetch_assoc();
							$res =$serv->levantarAnuncioProv($ciudad['ID_provincia']);
							$prov = $res->fetch_assoc(); ?>
						<option selected="true" value=<?php echo $prov['ID'];?>> <?php echo $prov['Nombre'];?></option>
						<?php
							$provincias = $serv->levantarProv();
							while ($fila = $provincias->fetch_assoc()){
								if ($fila['ID']!=$prov['ID']){echo "<option value=\"" . $fila['ID']. "\">". $fila['Nombre']."</option>";
							}}
						?>
					</select>
				</div>
				<div class='row reg'>
					<select id="ciudadSelect" name="ciudad" class="form-control custom" required>
						<option selected="true" value=<?php echo $ciudad['ID'];?>> <?php echo $ciudad['nombre'];?> </option>
						<?php
							$row_ciudad= $serv->levantarCiudad($prov['ID']);
							while($fila = $row_ciudad->fetch_assoc()){
								if ($fila['ID']!=$row['ID_ciudad']){echo "<option value=\"" . $fila['ID']. "\">". $fila['nombre']."</option>";
							}}
						?>
					</select>
				</div>
				<div class='row reg'>
				<?php
					$imagen = $serv->levantarImagen($row['ID']);
					$row1 = $imagen->fetch_assoc();
					$link = $row1['enlace'];
				?>
					<input  type="file" class="filestyle" name="fileToUpload" id="fileToUpload" data-buttonBefore="true" data-input="true" data-icon="false" data-size="sm" data-buttonName="btn-primary" data-buttonText="Subir foto" data-placeholder="Ningún archivo seleccionado">

				</div>
				<input class=hidden name='anunc' value=<?php echo $row['ID']?>>	
			</div>
			</form>
			<form id="back" action='anuncDetalle.php' method='POST' enctype='multipart/form-data'>
				<input class=hidden name='anunc' value=<?php echo $row['ID']?>>			
			</form>
			<div class='row reg'>
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
