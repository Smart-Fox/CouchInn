
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>CouchInn</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="css/bootstrap.min.css"/>
	<link rel='stylesheet' href='style.css'/>
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
	<script src="js/jquery.min.js"></script>
	<script type="text/javascript" src= "js/objeto.js"></script>
	<script type="text/javascript">
		function mostrarFiltros(){
			document.getElementById('barra-filtros').style.display = 'inline';
			document.getElementById('botonesprinc').style.display = 'none';			
		}
	</script>
</head>
<body>
	<img src="" alt="">
	<?php
		include('anuncioService.php');
		include('header.php');
		session_start();
		if(isset($_SESSION['usuario'])){
			$service = new cabecera($_SESSION['usuario']);
			$service->buildHeader();
			$serv = new aService();
			if (!isset($_POST['tipo']) || empty($_POST['tipo'])){
				$tipo=-1;
			}else{
				$tipo=$_POST['tipo'];
			}
			if (!isset($_POST['capacidad']) || empty($_POST['capacidad'])){
				$capacidad=-1;
			}else{
				$capacidad=$_POST['capacidad'];
			}
			if (!isset($_POST['provincia']) || empty($_POST['provincia'])){
				$provincia=-1;
			}else{
				$provincia=$_POST['provincia'];
			}
			if (!isset($_POST['ciudad']) || empty($_POST['ciudad'])){
				$ciudad=-1;
			}else{
				$ciudad=$_POST['ciudad'];
			}

			if (($capacidad!=-1)||($provincia!=-1)||($ciudad!=-1)||($tipo!=-1)){
				echo "
					<script type='text/javascript'>
						window.onload = function () {
							document.getElementById('barra-filtros').style.display = 'inline'; 
							document.getElementById('botonesprinc').style.display = 'none';	
						}
					</script>
				";
			}
			$anun = $serv->levantarAnuncios($tipo, $ciudad, $provincia, $capacidad);
			echo "<center><div id='botonesprinc'><a href='publicar.php'><button type=button class='btn5'>Publicar un anuncio</button></a> <button type=button class='btn5' onclick='mostrarFiltros();'>Filtrar anuncios</button></div></center>";
			?>
			<div id='barra-filtros'>
				<form action="pagPrinc.php" method="POST" enctype="multipart/form-data">
					<div class='row barra-filtro'>
						<div class='col-xs-1 col-md-1 elem-filtro2'>
						</div>
						<div class='col-xs-2 col-md-2 elem-filtro'>
							<select id='tipo' class="form-control custom filtro" name="tipo">
							<option selected="true" value="<?php if ($tipo!=-1){echo $tipo;} ?>"> <?php if ($tipo!=-1){$aux=$serv->levantarNombreTipo($tipo); $row=$aux->fetch_assoc(); echo $row['Nombre'];} else {echo "Tipo de hospedaje";} ?></option> 
							<?php
								$tipos = $serv->levantarTipos();
								print_r($tipos);
								while ($row = $tipos->fetch_assoc()){
									echo "<option value=\"" . $row['ID']. "\">". $row['Nombre']."</option>";
								}
							?>
							</select>
						</div>
						<div class='col-xs-2 col-md-2 elem-filtro'>
							<?php
								if ($capacidad!=-1){
									echo "<input type='number' class='filtro' name = 'capacidad' id='capacidad' min='1' value='$capacidad'>";
								}else{
									echo "<input type='number' class='filtro' name = 'capacidad' id='capacidad' min='1' placeholder='Capacidad'>";
								}
							?>
						</div>
						<div class='col-xs-2 col-md-2 elem-filtro'>
							<select id="provSelect" name="provincia" class="form-control custom filtro" onchange="cambiarCiudad('p');">
								<option selected="true" value="<?php if ($provincia!=-1){echo $provincia;} ?>"> <?php if ($provincia!=-1){$aux=$serv->levantarNombreProvincia($provincia); $row=$aux->fetch_assoc(); echo $row['Nombre']; echo "<script type='text/javascript'>cambiarCiudad('p'); </script>";} else {echo "Provincia";} ?></option>
								<?php
									$provincias = $serv->levantarProv();
									while ($row = $provincias->fetch_assoc()){
										echo "<option value=\"" . $row['ID']. "\">". $row['Nombre']."</option>";
									}
								?>
							</select>
						</div>
						<div class='col-xs-2 col-md-2 elem-filtro'>
							<select id="ciudadSelect" name="ciudad" class="form-control custom filtro">
								<option selected="true" value="<?php if ($ciudad!=-1){echo $ciudad;} ?>"> <?php if ($ciudad!=-1){$aux=$serv->levantarNombreCiudad($ciudad); $row=$aux->fetch_assoc(); echo $row['nombre'];} else {echo "Ciudad";} ?></option>
							</select>
						</div>
						<div class='col-xs-1 col-md-1 elem-filtro2'>
							<button type="submit" class="btn22">Filtrar</button>
						</div>
						<div class='col-xs-1 col-md-1 elem-filtro2'>
							<a href='pagPrinc.php'><button type="button" class="btn22">Quitar<br>filtros</button></a>
						</div>
						<div class='col-xs-1 col-md-1 elem-filtro2'>
						</div>
					</div>
				</form>
			</div>
			<?php
			if($anun){
				while($row = $anun->fetch_assoc()){
					if(($row['Tipo']=="premium")||($row['Tipo']=="admin")){
						$link=$row['enlace'];
					}else{
						$link='logo.png';
					}
					if($row['activo'] == '1'){
						echo "	<form action='anuncDetalle.php' method='POST' enctype='multipart/form-data'>
									<div class='row'>
										<div class='col-xs-2 col-md-2'>
										</div>
										<div class='col-xs-8 col-md-8 anuncio'>
											<input class=hidden name='anunc' value=\"".$row['anuncio_ID']."\">
												<button type='submit' class='buttonlink'>
													<div class='row'>
														<div class='col-xs-3 col-md-3' id='img'>
															<img src= img/".$link." class='imgAnun'>
														</div>
														<div class='col-xs-9 col-md-9'>
															<h2>
																<strong><span class='titulo'>".$row['Titulo']."</span></strong>
															</h2>
														</div>
													</div>
												</button>
											</input>
										</div>
										<div class='col-xs-2 col-md-2'>
										</div>
									</div>
								</form>
						";
					}
				}
			}
			if($anun->num_rows==0){
				echo "
					<div class='row'>
						<div id='feedback' class='col-xs-12 col-md-12'>
							<span>No hay resultados</span>
						</div>
					</div>
					<div class='row'>
						<div id='feedback' class='col-xs-12 col-md-12'>
							<a href='pagPrinc.php'><button type=button class='btn2'>Volver</button></a>
						</div>
					</div>
				";
			}
		}else{
			header('Location:index.html');
		}
	?>
	
</body>
</html>