<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Solicitudes</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel='stylesheet' href='style.css'/>
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
	<script src="js/jquery.min.js"></script>
	<script type="text/javascript">
		function showRec(){
			document.getElementById('recibidas').style.display = 'inline';
			$("#rec2").addClass("selected");
			document.getElementById('enviadas').style.display = 'none';
			$("#env2").removeClass("selected");		
		}
		function showEnv(){
			document.getElementById('enviadas').style.display = 'inline';
			$("#env2").addClass("selected");
			document.getElementById('recibidas').style.display = 'none';
			$("#rec2").removeClass("selected");				
		}
	</script>
</head>
<body>
	<?php
		include('header.php');
		include('anuncioService.php');
		include('cuentaOptions.php');
		session_start();
		if(isset($_SESSION['usuario'])){
				if(isset($_POST['tipo'])){
					$serv = new aService();
					$id=$_SESSION['id'];
					if ($_POST['tipo']=='recibidas'){
						$serv->marcarLeidasSolicAutor($id);
						echo "
							<script type='text/javascript'>
								window.onload = function mostrarR(){
									document.getElementById('rec').click();
								}	
							</script>
						";
					}
					if ($_POST['tipo']=='enviadas'){
						$serv->marcarLeidasSolicHuesped($id);
						echo "
							<script type='text/javascript'>
								window.onload = function mostrarE(){
									document.getElementById('env').click();
								}	
							</script>
						";
					}
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
						<form action='solicitudes.php' method='POST' enctype='multipart/form-data'>
							<input class=hidden name='tipo' value='enviadas'>
							<button type='submit' class='btn2' id='env2'>Solicitudes enviadas</button>
						</form>
						<button type=button id='env' class='hidden' onclick='showEnv();'>
					</div>
				</div>
				<div class='col-xs-2 col-md-2'>
					<div class='centered'>
						<form action='solicitudes.php' method='POST' enctype='multipart/form-data'>
							<input class=hidden name='tipo' value='recibidas'>
							<button type='submit' class='btn2' id='rec2'>Solicitudes recibidas</button>
						</form>
						<button type=button id='rec' class='hidden' onclick='showRec();'>
					</div>
				</div>
				<div class='col-xs-4 col-md-4'>
				</div>
			</div>
		";
		$solic = $serv->solicitudesRecibidas($id);
		echo "<div id='recibidas'>";
		if($solic->num_rows>0){
			while($row = $solic->fetch_assoc()){
				$inicial = date("d/m/Y", strtotime($row['fecha_inicio']));
				$final = date("d/m/Y", strtotime($row['fecha_fin']));
				$fecha = date("d/m/Y H:i", strtotime($row['fecha_solicitud']));
				if($row['cantidad_personas']==1){
					$persona='persona';
				}else{
					$persona='personas';
				}
				echo "	
					<div class='row'>
						<div class='col-xs-2 col-md-2'>
						</div>
						<div class='col-xs-8 col-md-8 anuncio'>
							<div class='row'>
								<form action='anuncDetalle.php' method='POST' enctype='multipart/form-data'>
									<input class=hidden name='anunc' value=\"".$row['ID_anuncio']."\"></input>
									<button type='submit' class='buttonlink2'>
										<div class='col-xs-12 col-md-12'>
											<strong><span class='content'>".$row['Titulo']."</span></strong>
											<br>
											<span class='content'>Reserva para ".$row['cantidad_personas']." ".$persona.", entre el ".$inicial." y el ".$final.", pedida por ".$row['Username']." <br> ".$fecha.".</span>
											<br>
											<p class='text'>".$row['comentario']."</p>
											<span class='content'>Estado: ".$row['estado']."</span>
										</div>
									</button>
								</form>
							</div>";
				if ($row['estado']=='aceptada'){
					echo"
						<div class='row'>
							<div class='col-xs-4 col-md-4'>
							</div>
							<div class='col-xs-2 col-md-2'>
								<form action='verDatos.php' method='POST' enctype='multipart/form-data'>
									<input class=hidden name='user' value='".$row['solicitud_user']."'></input>
									<center><button type='submit' class='btn22'>Ver datos del usuario</button></center>
								</form>
							</div>
							<div class='col-xs-2 col-md-2'>	
								<form action='cancelarSolic.php' method='POST' enctype='multipart/form-data'>
									<input class=hidden name='resp' value='cancelar'></input>
									<input class=hidden name='solic' value='".$row['solicitud_ID']."'></input>
									<center><button type='submit' class='btn22'>Cancelar reserva</button></center>
								</form>
							</div>
							<div class='col-xs-4 col-md-4'>
							</div>
						</div>
					";
				}
				if ($row['estado']=='pendiente'){
					echo"
						<center>
							<div class='row'>
								<div class='col-xs-3 col-md-3'>
								</div>
								<div class='col-xs-2 col-md-2'>
									<form method='POST' action='verPerfil.php'>
										<input class='hidden' name='id' value='".$row['solicitud_user']."'>
										<button class='btn22' type='submit'>Ver perfil</button>
									</form>
								</div>
								<div class='col-xs-2 col-md-2'>
									<form action='responderSolicitud.php' method='POST' enctype='multipart/form-data'>
										<input class=hidden name='resp' value='aceptar'></input>
										<input class=hidden name='solic' value='".$row['solicitud_ID']."'></input>
										<button type='submit' class='btn22'>Aceptar</button>
									</form>
								</div>
								<div class='col-xs-2 col-md-2'>
									<form action='responderSolicitud.php' method='POST' enctype='multipart/form-data'>
										<input class=hidden name='resp' value='rechazar'></input>
										<input class=hidden name='solic' value='".$row['solicitud_ID']."'></input>
										<button type='submit' class='btn22'>Rechazar</button>
									</form>
								</div>
								<div class='col-xs-3 col-md-3'>
								</div>
							</div>
						</center>
					";
				}
				if ($row['estado'] == 'activa'){
					echo"
							<div class='row'>
								<div class='col-xs-4 col-md-4'>
								</div>
								<div class='col-xs-4 col-md-4'>
									<form action='verDatos.php' method='POST' enctype='multipart/form-data'>
										<input class=hidden name='user' value='".$row['solicitud_user']."'></input>
										<center><button type='submit' class='btn22'>Ver datos del usuario</button></center>
									</form>
								</div>
								<div class='col-xs-4 col-md-4'>
								</div>
							</div>
						";
				}
				if ($row['estado'] == 'finalizada'){
					echo"
							<div class='row'>
								<div class='col-xs-4 col-md-4'>
								</div>
								<div class='col-xs-2 col-md-2'>
									<form action='verDatos.php' method='POST' enctype='multipart/form-data'>
										<input class=hidden name='user' value='".$row['anuncio_user']."'></input>
										<center><button type='submit' class='btn22'>Ver datos del usuario</button></center>
									</form>
								</div>
								<div class='col-xs-2 col-md-2'>	
									<form action='' method='POST' enctype='multipart/form-data'>
										<input class=hidden name='solic' value='".$row['solicitud_ID']."'></input>
										<input class=hidden name='tipo' value='huesped'></input>
										<center><button type='submit' class='btn22'>Calificar Huésped</button></center>
									</form>
								</div>
								<div class='col-xs-4 col-md-4'>
								</div>
							</div>
						";
				}
				echo "
						</div>
						<div class='col-xs-2 col-md-2'>
						</div>
					</div>	
				";
			}
		}else{
			echo"
				<center>
					<div class='row'>
						<div class='col-xs-2 col-md-2'>
						</div>
						<div class='col-xs-8 col-md-8'>
							<br>
							<strong><span class='titulo2'>No hay solicitudes recibidas</span></strong>
						</div>
						<div class='col-xs-2 col-md-2'>
						</div>
					</div>
				</center>
			";
		}
		echo "</div>";
		$solic2 = $serv->solicitudesEnviadas($id);
		echo "<div id='enviadas'>";
		if($solic2->num_rows>0){
			while($row2 = $solic2->fetch_assoc()){
				$inicial = date("d/m/Y", strtotime($row2['fecha_inicio']));
				$final = date("d/m/Y", strtotime($row2['fecha_fin']));
				$fecha = date("d/m/Y H:i", strtotime($row2['fecha_solicitud']));
				if($row2['cantidad_personas']==1){
					$persona='persona';
				}else{
					$persona='personas';
				}
				echo "	
					<div class='row'>
						<div class='col-xs-2 col-md-2'>
						</div>
						<div class='col-xs-8 col-md-8 anuncio'>
							<div class='row'>
								<form action='anuncDetalle.php' method='POST' enctype='multipart/form-data'>
									<input class=hidden name='anunc' value=\"".$row2['ID_anuncio']."\"></input>
									<button type='submit' class='buttonlink2'>
										<div class='col-xs-12 col-md-12'>
											<strong><span class='content'>".$row2['Titulo']."</span></strong>
											<br>
											<span class='content'>Reserva para ".$row2['cantidad_personas']." ".$persona.", entre el ".$inicial." y el ".$final.".<br> ".$fecha."</span>
											<br>
											<p class='text'>".$row2['comentario']."</p>
											<span class='content'>Estado: ".$row2['estado']."</span>
										</div>
									</button>
								</form>
							</div>";
				if ($row2['estado']=='aceptada'){
					echo"
							<div class='row'>
								<div class='col-xs-4 col-md-4'>
								</div>
								<div class='col-xs-2 col-md-2'>
									<form action='verDatos.php' method='POST' enctype='multipart/form-data'>
										<input class=hidden name='user' value='".$row2['anuncio_user']."'></input>
										<center><button type='submit' class='btn22'>Ver datos del usuario</button></center>
									</form>
								</div>
								<div class='col-xs-2 col-md-2'>	
									<form action='cancelarSolic.php' method='POST' enctype='multipart/form-data'>
										<input class=hidden name='solic' value='".$row2['solicitud_ID']."'></input>
										<center><button type='submit' class='btn22'>Cancelar reserva</button></center>
									</form>
								</div>
								<div class='col-xs-4 col-md-4'>
								</div>
							</div>
					";
				}
				if ($row2['estado']=='pendiente'){
					echo"
							<div class='row'>
								<form action='cancelarSolic.php' method='POST' enctype='multipart/form-data'>
									<input class=hidden name='solic' value='".$row2['solicitud_ID']."'></input>
									<center><button type='submit' class='btn22'>Cancelar solicitud</button></center>
								</form>
							</div>
					";
				}
				if ($row2['estado'] == 'activa'){
					echo"
							<div class='row'>
								<div class='col-xs-4 col-md-4'>
								</div>
								<div class='col-xs-4 col-md-4'>
									<form action='verDatos.php' method='POST' enctype='multipart/form-data'>
										<input class=hidden name='user' value='".$row2['anuncio_user']."'></input>
										<center><button type='submit' class='btn22'>Ver datos del usuario</button></center>
									</form>
								</div>
								<div class='col-xs-4 col-md-4'>
								</div>
							</div>
					";
				}
				if ($row2['estado'] == 'finalizada'){
					echo"
							<div class='row'>
								<div class='col-xs-4 col-md-4'>
								</div>
								<div class='col-xs-2 col-md-2'>
									<form action='verDatos.php' method='POST' enctype='multipart/form-data'>
										<input class=hidden name='user' value='".$row2['anuncio_user']."'></input>
										<center><button type='submit' class='btn22'>Ver datos del usuario</button></center>
									</form>
								</div>";
					$aux = $serv->isCalificadoHospedaje($row2['solicitud_ID']);
					if ($aux == false) {
						echo	"<div class='col-xs-2 col-md-2'>	
									<form action='calificarAnuncio.php' method='POST' enctype='multipart/form-data'>
										<input class=hidden name='solic' value='".$row2['solicitud_ID']."'></input>
										<input class=hidden name='anunc' value='".$row2['ID_anuncio']."'></input> 
										<input class=hidden name='tipo' value='hospedaje'></input>
										<center><button type='submit' class='btn22'>Calificar Hospedaje</button></center>
									</form>
								</div>
								<div class='col-xs-4 col-md-4'>
								</div>
							</div>
					";}
				}
				echo"
						</div>
						<div class='col-xs-2 col-md-2'>
						</div>
					</div>	
				";
			}
		}else{
			echo"
				<center>
					<div class='row'>
						<div class='col-xs-2 col-md-2'>
						</div>
						<div class='col-xs-8 col-md-8'>
							<strong><span class='titulo2'>No hay solicitudes enviadas</span></strong>
						</div>
						<div class='col-xs-2 col-md-2'>
						</div>
					</div>
				</center>
			";
		}
		echo "</div>";
	?>
</body>
</html>