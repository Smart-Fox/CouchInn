
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
	<script type="text/javascript" src="js/bootstrap-filestyle.min.js"> </script>
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
			echo "<a href='publicar.php'><button type=button class='btn'>Publicar anuncio</button></a> <br><br>";
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
			$anun = $serv->levantarAnuncios($tipo, $ciudad, $provincia, $capacidad);
			?>
			<form action="pagPrinc.php" method="POST" enctype="multipart/form-data">
				<div class='row'>
					<div class='col-xs-2 col-md-2'>
					</div>
					<div class='col-xs-2 col-md-2'>
						<select id='tipo' class="form-control custom" name="tipo">
						<option selected="true" disabled="disabled" value=""> Tipos </option>
						<?php
							$tipos = $serv->levantarTipos();
							print_r($tipos);
							while ($row = $tipos->fetch_assoc()){
								echo "<option value=\"" . $row['ID']. "\">". $row['Nombre']."</option>";
							}
						?>
						</select>
					</div>
					<div class='col-xs-2 col-md-2'>
						<input type="number" name = 'capacidad' id='capacidad' min="1" placeholder="Capacidad">
					</div>
					<div class='col-xs-2 col-md-2'>
						<select id="provSelect" name="provincia" class="form-control custom" onchange="cambiarCiudad('p');">
							<option selected="true" disabled="disabled" value=""> Provincia </option>
							<?php
								$provincias = $serv->levantarProv();
								while ($row = $provincias->fetch_assoc()){
									echo "<option value=\"" . $row['ID']. "\">". $row['Nombre']."</option>";
								}
							?>
						</select>
					</div>
					<div class='col-xs-2 col-md-2'>
						<select id="ciudadSelect" name="ciudad" class="form-control custom">
							<option selected="true" disabled="disabled" value=""> Ciudad </option>
						</select>
					</div>
					<div class='col-xs-2 col-md-2'>
						<button type="submit" class="btn">Filtrar</button>
					</div>
				</div>
			</form>
			<?php
			if($anun){
			while($row = $anun->fetch_assoc()){
				if(($row['Tipo']=="premium")||($row['Tipo']=="admin")){
					$link=$row['enlace'];
				}else{
					$link='logo.png';
				}
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
						</form>";
			}}
		}else{
			header('Location:index.html');
		}
	?>
	
</body>
</html>