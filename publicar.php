<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Página Principal</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel='stylesheet' href='style.css'/>
	<script src="js/jquery.min.js"></script>
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
		<form action="publicarAnuncio.php" method="POST" onsubmit="return validacion();">
			<br><br>
			<input type="text" name = 'Título' id='titulo' placeholder='Titulo del anuncio' required>
			<br><br>

			<input type="text" name = 'Descripcion' id='desc' placeholder='Descripcion' required>
			<br><br>

			<input type="number" name = 'Capacidad' id='capacidad' min="1" required>
			<br><br>

			<select class="form-control custom" required>
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
			<br>

			<select id="provSelect" class="form-control custom" required>
				<option selected="true" disabled="disabled" value=""> Seleccione una provincia </option>
				<?php
					
					$provincias = $serv->levantarProv();
					while ($row = $provincias->fetch_assoc()){
						echo "<option value=\"" . $row['ID']. "\">". $row['Nombre']."</option>";
					}
				?>
			</select>
			<br>

			<select class="form-control custom" required>
				<option selected="true" disabled="disabled" value=""> Seleccione una ciudad </option>
				

			</select>
			</form>
			<br>
			<button type="submit" class="btn">Publicar</button>
			<script type="text/javascript"> 
			$('#provSelect').change( function(){ 
				var idprov = $('#provSelect option:selected')[0].value;
				$.ajax({
    				url: '<?php levantarCiudad('idprov'); ?>anuncioService.php',
    				data: { "idprov": "1"},
    				success: function(response) { alert(response); }
					});

				})
					
			</script>
	</center>

	
</body>
</html>