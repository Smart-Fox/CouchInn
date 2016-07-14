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
			$serv = new aService();
			$idUser=$_POST['solicUser'];
			$userCalifica = $_POST['usuarioQueCalifica'];
			$userCalif = $serv->levantarCalificacionesUsuario($idUser);
			$id=$_SESSION['id'];
		}else{
			header('Location:index.html');
		}
	?>
	<center>
		<h1>CALIFICACIÓN</h1> 
		<h1>usuario:  <?php  $us = $serv->levantarUsuario($idUser); $rowUs = $us->fetch_assoc(); echo $rowUs['Username'] ?></h1>
		<div class="" style="">
			<?php  $us = $serv->levantarUsuario($userCalifica); $rowUs = $us->fetch_assoc();  ?>
			<div class='row'>
				<?php 
					if($userCalif->num_rows>0){
						while ($rowUser = $userCalif->fetch_assoc()){
							echo "		
									<div class='row'>
										<div class='col-xs-2 col-md-2'>
										</div>
										<div class='col-xs-8 col-md-8 anuncio'>
											Usuario: <b>".$rowUs['Username']."</b>
											<div class='row'>
											<br>
												<div class='col-xs-1 col-md-1'>
												</div>
												<div class='col-xs-2 col-md-2'>
													<span class='content'><strong>Comentario:</strong></span>
												</div>
												<div class='col-xs-6 col-md-6'>
													<i><span class='content'>".$rowUser['comentario']."</span></i>
												</div>
												<div class='col-xs-2 col-md-2'>
													<span class='content'><strong>Puntaje:</strong></span>
												</div>
												<div class='col-xs-1 col-md-1'>
													<i><span class='content'>".$rowUser['puntaje']."</span></i>
												</div>
											</div>
											<div class='row'>
												<div class='col-xs-3 col-md-3'>
												</div>
												<div class='col-xs-6 col-md-6'>
													</div>
												<div class='col-xs-3 col-md-3'>
												</div>
											</div>
										</div>
									</div><br> 
							";
						}
						echo "<strong><u>PUNTAJE PROMEDIO: ".$serv->levantarPuntajePromedioUsuario($idUser)."</u></strong>";
					}else{
						echo "
							<center>
								<div class='row'>
									<div class='col-xs-2 col-md-2'>
									</div>
									<div class='col-xs-8 col-md-8'>
										<br>
										<strong><span class='titulo2'>No hay calificaciones para este usuario</span></strong>
									</div>
									<div class='col-xs-2 col-md-2'>
									</div>
								</div>
							</center>
						";	
					}
				?>
			</div>
		</div>
	</center>
</body>
</html>