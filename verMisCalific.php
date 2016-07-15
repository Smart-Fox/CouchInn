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
			$idUser=$_SESSION['id'];
			$userCalif = $serv->levantarCalificacionesUsuario($idUser);


			
		
		}else{
			header('Location:index.html');
		}
	?>

	<center>
			<h1 >Mis calificaciones</h1> 
			
		<div class="" style="">
			
			
				<div class='row'>
					<div style="float:left;width:60%;margin-right:30px;margin-left: 30px">
							<?php 
								if($userCalif->num_rows>0){
									while ($rowUser = $userCalif->fetch_assoc()){
										$us = $serv->levantarCalificadoresDeUnUsuario($rowUser['ID_calificacion_dueño']); 
										$rowUs = $us->fetch_assoc();
										//var_dump($rowUs);
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

									echo "<center>
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
				
			</div>
	
		<br>
		<br>
	</center>
	
</body>
</html>