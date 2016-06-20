<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Preguntas enviadas</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel='stylesheet' href='style.css'/>
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
	<script src="js/jquery.min.js"></script>
	<script type="text/javascript" src= "js/objeto.js"></script>
	<script type="text/javascript" src="js/bootstrap-filestyle.min.js"> </script>
</head>
<body>
	<?php
		include('header.php');
		include('anuncioService.php');
		include('cuentaOptions.php');
		session_start();
		if(isset($_SESSION['usuario'])){
			$service = new cabecera($_SESSION['usuario']);
			$service->buildHeader();
			$display=new cuentaMenu();
			$id=$_SESSION['id'];
		}else{
			header('Location:index.html');
		}
		$serv = new aService();
		$solic = $serv->solicitudesRecibidas($id);
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
											<span class='content'>Reserva para ".$row['cantidad_personas']." ".$persona.", entre el ".$inicial." y el ".$final.".</span>
											<br>
											<span class='content'>Pedido por ".$row['Username'].".</span>
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
							<strong><span class='titulo2'>No hay solicitudes recibidas</span></strong>
						</div>
						<div class='col-xs-2 col-md-2'>
						</div>
					</div>
				</center>
			";
		}
	?>
	
</body>
</html>