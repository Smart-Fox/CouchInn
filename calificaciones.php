<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Calificaciones</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel='stylesheet' href='theme/rateit.css'/>
	<link rel='stylesheet' href='style.css'/>
	<script src="js/jquery.min.js"></script>
	<script src="theme/jquery.rateit.min.js"></script>
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
	<script type="text/javascript">
		function showRec(){
			document.getElementById('recibidas').style.display = 'inline';
			$("#rec").addClass("selected");
			document.getElementById('enviadas').style.display = 'none';
			$("#env").removeClass("selected");		
		}
		function showEnv(){
			document.getElementById('enviadas').style.display = 'inline';
			$("#env").addClass("selected");
			document.getElementById('recibidas').style.display = 'none';
			$("#rec").removeClass("selected");				
		}
	</script>
</head>
<body>
	<center>
	<?php
		include('header.php');
		include('anuncioService.php');
		include('cuentaOptions.php');
		session_start();
		if(isset($_SESSION['usuario'])){
				if(isset($_POST['tipo'])){
					$serv = new aService();
					$id=$_SESSION['id'];
				}
			$service = new cabecera($_SESSION['usuario']);
			$service->buildHeader();
			$display=new cuentaMenu();
		}else{
			header('Location:index.html');
		}
		echo "
			<div class='row'>
				<div class='col-xs-4 col-md-4'>
				</div>
				<div class='col-xs-2 col-md-2'>
					<div class='centered'>
						<button type=button id='env' class='btn2' onclick='showEnv();'>Calificaciones de hospedaje</button>
					</div>
				</div>
				<div class='col-xs-2 col-md-2'>
					<div class='centered'>
						<button type=button id='rec' onclick='showRec();' class='btn2'>Calificaciones como huésped</button>
					</div>
				</div>
				<div class='col-xs-4 col-md-4'>
				</div>
			</div>
			<br>
		";
		$userCalif=$serv->levantarCalificacionesUsuario($_SESSION['id']);
		echo "<div id='recibidas' class='row'>"; 
		if($userCalif->num_rows>0){
			echo "	<strong>Valoración promedio</strong><br>
					<div class='rateit' data-rateit-value='".$serv->levantarPuntajePromedioUsuario($idUser)."' data-rateit-readonly='true' data-rateit-step='0.1' data-rateit-resetable='false'  data-rateit-ispreset='true'></div>
			";
			while ($rowUser = $userCalif->fetch_assoc()){
				$serv->marcarLeidaCalif($rowUser['calificacion_ID']);
				$fechainicio=date('d/m/Y', strtotime($rowUser['fecha_inicio']));
				$fechafin=date('d/m/Y', strtotime($rowUser['fecha_fin']));
				echo "		
						<div class='row'>
							<div class='col-xs-2 col-md-2'>
							</div>
							<div class='col-xs-8 col-md-8 calificacion'>
								<div class='col-xs-2 col-md-2'>
								</div>
								<div class='col-xs-8 col-md-8'>
									<span>".$rowUser['Titulo']."</span>
									<br><br><span>".$fechainicio." - ".$fechafin."</span>
									<br><br><div class='rateit' data-rateit-value='".$rowUser['puntaje']."' data-rateit-readonly='true' data-rateit-step='1' data-rateit-resetable='false'  data-rateit-ispreset='true'></div>
									<br><br><span class='content'>".$rowUser['comentario']."</span>
									<br><br><span>".$rowUser['Username']."</span><br>
								</div>
								<div class='col-xs-2 col-md-2'>
								</div>
							</div>
							<div class='col-xs-2 col-md-2'>
							</div>
						</div> <br>
				";
			}
		}else{
			echo "
				<center>
					<div class='row'>
						<div class='col-xs-2 col-md-2'>
						</div>
						<div class='col-xs-8 col-md-8'>
							<br>
							<strong><span class='titulo2'>No hay calificaciones como huésped recibidas</span></strong>
						</div>
						<div class='col-xs-2 col-md-2'>
						</div>
					</div>
				</center>
			";	
		}
		echo "</div>";
		$anun = $serv->levantarAnuncioDeUsuario($id);
		echo "<div id='enviadas' class='row'>
				<div class='col-xs-1 col-md-1'>
				</div>
				<div class='col-xs-10 col-md-10'>";
		if($anun->num_rows>0){
			while($row = $anun->fetch_assoc()){
				$calif=$calif = $serv->levantarCalificacionesAnuncio($row['anuncio_ID']);?>
				<div class='row calificacion'>
					<h3 class='calif'><b><?php echo $row['Titulo'];?></b></h3>
					<?php 
						if($calif->num_rows>0){
							echo "	Valoración promedio<br>
									<div class='rateit' data-rateit-value='".$serv->levantarPuntajePromedioAnuncio($row['anuncio_ID'])."' data-rateit-readonly='true' data-rateit-step='0.1' data-rateit-resetable='false'  data-rateit-ispreset='true'></div>
							";
							while ($rowComent = $calif->fetch_assoc()){
								$serv->marcarLeidaCalif($rowComent['calificacion_ID']);
								$usuarioQueCalifico = $serv->levantarUsuarioCalificador($rowComent['ID_calificacion_visitante']);
								$rowUsCal = $usuarioQueCalifico->fetch_assoc();
								$fechainicio=date('d/m/Y', strtotime($rowComent['fecha_inicio']));
								$fechafin=date('d/m/Y', strtotime($rowComent['fecha_fin']));
								echo "		
										<div class='row'>
											<div class='col-xs-2 col-md-2'>
											</div>
											<div class='col-xs-8 col-md-8 solicitud'>
												<span>".$fechainicio." - ".$fechafin."</span>
												<br><div class='rateit' data-rateit-value='".$rowComent['puntaje']."' data-rateit-readonly='true' data-rateit-step='1' data-rateit-resetable='false'  data-rateit-ispreset='true'></div>
												<br><span class='content'>".$rowComent['comentario']."</span>
												<br><span>".$rowUsCal['Username']."</span><br>
											</div>
											<div class='col-xs-2 col-md-2'>
											</div>
										</div> <br>
								";
							}
						}else{
							echo "	<div class='row'>
										<div class='col-xs-2 col-md-2'>
										</div>
										<div class='col-xs-8 col-md-8'>
											<span class='titulo2'>No hay calificaciones para este anuncio</span>
										</div>
										<div class='col-xs-2 col-md-2'>
										</div>
									</div>
							";	
						}
					?>
			</div><?php
			}
		}else{
			echo"
				<center>
					<div class='row'>
						<div class='col-xs-2 col-md-2'>
						</div>
						<div class='col-xs-8 col-md-8'>
							<br>
							<strong><span class='titulo2'>No hay anuncios publicados</span></strong>
						</div>
						<div class='col-xs-2 col-md-2'>
						</div>
					</div>
				</center>
			";
		}
		echo "
				<div class='col-xs-1 col-md-1'>
				</div>
			</div>";
	?>
	</center>
</body>
</html>