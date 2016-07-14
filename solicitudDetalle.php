<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Detalle de Solicitud</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel='stylesheet' href='style.css'/>
	<script src="js/jquery.min.js"></script>
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
</head>
<body>
	<?php
		include('anuncioService.php');
		include('header.php');
		session_start();
		if(isset($_SESSION['usuario'])){
			if(isset($_POST['idsol'])){
				$id=$_POST['idsol'];
				$tipo = $_POST['tipo'];
				$service = new cabecera($_SESSION['usuario']);
				$service->buildHeader();
				$serv = new aService();
				$sol = $serv->levantarSolicitud($id);
				$row = $sol->fetch_assoc();
				$anun = $serv->levantarAnuncio($row['ID_anuncio']);
				$anun_row = $anun->fetch_assoc();
				$inicial = date("d/m/Y", strtotime($row['fecha_inicio']));
				$final = date("d/m/Y", strtotime($row['fecha_fin']));
				$fecha = date("d/m/Y H:i", strtotime($row['fecha_solicitud']));
				$user = $serv->levantarUsuario($row['ID_usuario']);
				$user_row = $user->fetch_assoc();
				$host = $serv->levantarUsuario($anun_row['ID_usuario']);
				$host_row = $host->fetch_assoc();
				if($row['cantidad_personas']==1){
					$persona='persona';
				}else{
					$persona='personas';
				}
			}else{
				header('Location:pagPrinc.php');
			}
		}else{
			header('Location:index.html');
		} 
	?>
	<center>

		<div class='anunciodet'>
			<div class='row row-titulo'>
				<div class='col-xs-10 col-md-10'>
					<h2><span><strong><?php echo $anun_row['Titulo'];?></strong> </span></h2>
				</div>
			</div>
			<div>
			<br>
			<div>
				<span class='content'>Reserva para <?php echo $row['cantidad_personas']." ".$persona; ?> entre el 
				<?php echo $inicial." y el ".$final.", pedida por ".$user_row['Username']?>
					<br> <?php echo $fecha ?></span>
					<br>
					<span>Estado: <?php echo $row['estado']?></span>
					<br>
					<p class='text'>Comentarios: <?php echo $row['comentario']?></p>	
			</div>

			<?php
				if ($tipo =='enviadas'){
					if ($row['estado']=='aceptada'){
						echo"
							<div class='row'>
								<div class='col-xs-4 col-md-4'>
								</div>
								<div class='col-xs-2 col-md-2'>
									<form action='verDatos.php' method='POST' enctype='multipart/form-data'>
										<input class=hidden name='user' value='".$host_row['ID_usuario']."'></input>
										<center><button type='submit' class='btn22'>Ver datos del usuario</button></center>
									</form>
								</div>
								<div class='col-xs-2 col-md-2'>	
									<form action='cancelarSolic.php' method='POST' enctype='multipart/form-data'>
										<input class=hidden name='resp' value='cancelar'></input>
										<input class=hidden name='solic' value='".$row['ID']."'></input>
										<center><button type='submit' class='btn22'>Cancelar reserva</button></center>
									</form>
								</div>
								<div class='col-xs-4 col-md-4'>
								</div>
							</div>
						";
				} elseif ($row['estado']=='pendiente'){
					echo"
						<center>
								<div class='row'>
									<form action='cancelarSolic.php' method='POST' enctype='multipart/form-data'>
										<input class=hidden name='solic' value='".$row['solicitud_ID']."'></input>
										<center><button type='submit' class='btn22'>Cancelar solicitud</button></center>
									</form>
								</div>
						</center>
					";
				} elseif ($row['estado'] == 'activa'){
					echo"
							<div class='row'>
								<div class='col-xs-4 col-md-4'>
								</div>
								<div class='col-xs-4 col-md-4'>
									<form action='verDatos.php' method='POST' enctype='multipart/form-data'>
										<input class=hidden name='user' value='".$host_row['ID']."'></input>
										<center><button type='submit' class='btn22'>Ver datos del usuario</button></center>
									</form>
								</div>
								<div class='col-xs-4 col-md-4'>
								</div>
							</div>
						";
				} elseif ($row['estado'] == 'finalizada'){
					echo"
							<div class='row'>
								<div class='col-xs-4 col-md-4'>
								</div>
								<div class='col-xs-2 col-md-2'>
									<form action='verDatos.php' method='POST' enctype='multipart/form-data'>
										<input class=hidden name='user' value='".$host_row['ID']."'></input>
										<center><button type='submit' class='btn22'>Ver datos del usuario</button></center>
									</form>
								</div>";
								$aux = $serv->isCalificadoHospedaje($row['solicitud_ID']);
							if ($aux == false) {
								echo	"<div class='col-xs-2 col-md-2'>	
									<form action='calificarAnuncio.php' method='POST' enctype='multipart/form-data'>
										<input class=hidden name='solic' value='".$row['solicitud_ID']."'></input>
										<input class=hidden name='anunc' value='".$row['ID_anuncio']."'></input> 
										<input class=hidden name='tipo' value='hospedaje'></input>
										<center><button type='submit' class='btn22'>Calificar Hospedaje</button></center>
									</form>
								</div>
								<div class='col-xs-4 col-md-4'>
								</div>
							</div>
					";}
				}
				echo "
						</div>
						<div class='col-xs-2 col-md-2'>
						</div>
						<div class='col-xs-2 col-md-2'>	
									<form action='solicitudes.php' method='POST' enctype='multipart/form-data'>
										<input class=hidden name='tipo' value='enviadas'>
										<center><button type='submit' class='btn22'>Volver</button></center>
									</form>
								</div>
					</div>	
				";}
				elseif ($tipo == 'recibidas' ) {
							if ($row['estado']=='aceptada'){
						echo"
							<div class='row'>
								<div class='col-xs-4 col-md-4'>
								</div>
								<div class='col-xs-2 col-md-2'>
									<form action='verDatos.php' method='POST' enctype='multipart/form-data'>
										<input class=hidden name='user' value='".$row['ID_usuario']."'></input>
										<center><button type='submit' class='btn22'>Ver datos del usuario</button></center>
									</form>
								</div>
								<div class='col-xs-2 col-md-2'>	
									<form action='cancelarSolic.php' method='POST' enctype='multipart/form-data'>
										<input class=hidden name='resp' value='cancelar'></input>
										<input class=hidden name='solic' value='".$row['ID']."'></input>
										<center><button type='submit' class='btn22'>Cancelar reserva</button></center>
									</form>
								</div>
								<div class='col-xs-4 col-md-4'>
								</div>
							</div>
						";
				} elseif ($row['estado']=='pendiente'){
					echo"
						<center>
							<div class='row'>
								<div class='col-xs-3 col-md-3'>
								</div>
								<div class='col-xs-2 col-md-2'>
									<form method='POST' action='verPerfil.php'>
										<input class='hidden' name='id' value='".$row['ID_usuario']."'>
										<button class='btn22' type='submit'>Ver perfil</button>
									</form>
								</div>
								<div class='col-xs-2 col-md-2'>
									<form action='responderSolicitud.php' method='POST' enctype='multipart/form-data'>
										<input class=hidden name='resp' value='aceptar'></input>
										<input class=hidden name='solic' value='".$row['ID']."'></input>
										<button type='submit' class='btn22'>Aceptar</button>
									</form>
								</div>
								<div class='col-xs-2 col-md-2'>
									<form action='responderSolicitud.php' method='POST' enctype='multipart/form-data'>
										<input class=hidden name='resp' value='rechazar'></input>
										<input class=hidden name='solic' value='".$row['ID']."'></input>
										<button type='submit' class='btn22'>Rechazar</button>
									</form>
								</div>
								<div class='col-xs-3 col-md-3'>
									<form action='verCalificUsuario.php' method='POST' enctype='multipart/form-data'>
										<input class=hidden name='solicUser' value='".$row['ID_usuario']."'></input>
										<input class=hidden name='usuarioQueCalifica' value='".$row['ID_usuario']."'></input>
										<button type='submit' class='btn22'>Ver calificación ".$user_row['Username']."</button>
									</form>
								</div>
							</div>
						</center>
					";
				} elseif ($row['estado'] == 'activa'){
					echo"
							<div class='row'>
								<div class='col-xs-4 col-md-4'>
								</div>
								<div class='col-xs-4 col-md-4'>
									<form action='verDatos.php' method='POST' enctype='multipart/form-data'>
										<input class=hidden name='user' value='".$row['ID_usuario']."'></input>
										<center><button type='submit' class='btn22'>Ver datos del usuario</button></center>
									</form>
								</div>
								<div class='col-xs-4 col-md-4'>
								</div>
							</div>
						";
				} elseif ($row['estado'] == 'finalizada'){
					echo"
							<div class='row'>
								<div class='col-xs-4 col-md-4'>
								</div>
								<div class='col-xs-2 col-md-2'>
									<form action='verDatos.php' method='POST' enctype='multipart/form-data'>
										<input class=hidden name='user' value='".$row['ID']."'></input>
										<center><button type='submit' class='btn22'>Ver datos del usuario</button></center>
									</form>
								</div>";
								$aux = $serv->isCalificadoHuesped($row['solicitud_ID']);
								if($aux == false){
								echo "<div class='col-xs-2 col-md-2'>	
									<form action='calificarHuesped.php' method='POST' enctype='multipart/form-data'>
										<input class=hidden name='solic' value='".$row['ID']."'></input>
										<input class=hidden name='user' value='".$row['ID_usuario']."'></input> 
										<input class=hidden name='anun' value='".$row['ID_anuncio']."'></input> 
										<input class=hidden name='tipo' value='huesped'></input>
										<center><button type='submit' class='btn22'>Calificar Huésped</button></center>
									</form>
								</div>
								<div class='col-xs-4 col-md-4'>
								</div>
							</div>
						";}
				}
				echo "
						</div>
						<div class='col-xs-2 col-md-2'>
						</div>
						<div class='col-xs-2 col-md-2'>	
									<form action='solicitudes.php' method='POST' enctype='multipart/form-data'>
										<input class=hidden name='tipo' value='recibidas'>
										<center><button type='submit' class='btn22'>Volver</button></center>
									</form>
								</div>
					</div>	
				";
				}
			
		 ?>
		</div>
	</center>

</body>
</html>