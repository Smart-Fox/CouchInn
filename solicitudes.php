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
									console.log('hola');
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
									console.log('hola');
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
						<button type=button id='env' class='btn2' onclick='showEnv();'>Solicitudes enviadas</button>
					</div>
				</div>
				<div class='col-xs-2 col-md-2'>
					<div class='centered'>
						<button type=button id='rec' class='btn2' onclick='showRec();'>Solicitudes recibidas</button>
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
											<span class='content'>Reserva para ".$row['cantidad_personas']." ".$persona.", entre el ".$inicial." y el ".$final.", pedida por ".$row['Username']." el ".$row['fecha_solicitud'].".</span>
											<br>
											<span class='content'>".$row['comentario']."</span>
											<br>
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
											<span class='content'>Reserva para ".$row2['cantidad_personas']." ".$persona.", entre el ".$inicial." y el ".$final.".</span>
											<br>
											<span class='content'>".$row2['comentario']."</span>
											<br>
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