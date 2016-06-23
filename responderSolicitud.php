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
	<?php
		include('header.php');
		include('anuncioService.php');
		include('cuentaOptions.php');
		session_start();
		if(isset($_SESSION['usuario'])){
			$service = new cabecera($_SESSION['usuario']);
			$service->buildHeader();
			$display=new cuentaMenu();
		}else{
			header('Location:index.html');
		}
		$idSolic=$_POST['solic'];
		$bool=true;
		$serv = new aService();
		$resp=$_POST['resp'];
		$idUser=$_SESSION['id'];
		$solic = $serv->levantarSolicitud($idSolic);
		$row=$solic->fetch_assoc();
		if($row['cantidad_personas']==1){
			$persona='persona';
		}else{
			$persona='personas';
		}
		switch($resp){
			case 'cancelar':
				if ($row['ID_usuario']==$idUser){
					$serv->cancelarSolicitudHuesped($idSolic);
				}else{
					$serv->cancelarSolicitudAutor($idSolic);
				}
			break;
			
			case 'aceptar':
				$superp=$serv->levantarSolicitudesFecha($row['fecha_inicio'], $row['fecha_fin'], $idSolic, $row['ID_anuncio']);
				if ($superp->num_rows==0){
					$serv->aceptarSolicitud($idSolic);
				}else{
					$bool=false;
					echo "
						<center>
						<br><strong><span class='content'>Al aceptar la solicitud se cancelarán las siguientes solicitudes que se superponen:</span></strong><br>
					";
						while($row2 = $superp->fetch_assoc()){
							echo "
								<br>
								<span class='content'>Reserva para ".$row2['cantidad_personas']." ".$persona.", entre el ".$row2['fecha_inicio']." y el ".$row2['fecha_fin'].", pedida por ".$row2['Username'].".</span>
								<br>
								<span class='content'>".$row2['comentario']."</span>
								<br>
							";
						}
					echo "
						<br>
						<div class='row'>
							<div class='col-xs-4 col-md-4'>
							</div>
							<div class='col-xs-2 col-md-2'>
								<a href='solicitudes.php'><button class='btn22'>Cancelar</button></a>
							</div>
							<div class='col-xs-2 col-md-2'>	
								<form action='solicSuperp.php' method='POST' enctype='multipart/form-data'>
									<input class=hidden name='solic' value='".$idSolic."'></input>
									<button type='submit' class='btn22'>Confirmar</button>
								</form>
							</div>
							<div class='col-xs-4 col-md-4'>
							</div>
						</div>
						</center>
					";
				}
			break;
			
			case 'rechazar':
				$serv->rechazarSolicitud($idSolic);
			break;
		}
		if($bool){
			if ($row['ID_usuario']==$idUser){
				echo "	
				<form id='back1' action='solicitudes.php' method='POST' enctype='multipart/form-data'>
					<input class='hidden' name='tipo' value='enviadas'>	
				</form>
				<script type='text/javascript'>
					function submitForm() {
						document.getElementById('back1').submit();
					}
					window.onload = submitForm;
				</script>
				";
			}else{
				echo "	
				<form id='back2' action='solicitudes.php' method='POST' enctype='multipart/form-data'>
					<input class='hidden' name='tipo' value='recibidas'>	
				</form>
				<script type='text/javascript'>
					function submitForm() {
						document.getElementById('back2').submit();
					}
					window.onload = submitForm;
				</script>
				";
			}
		}
	?>
</body>
</html>