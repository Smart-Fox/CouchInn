<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Detalle de anuncio</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel='stylesheet' href='style.css'/>
	<script src="js/jquery.min.js"></script>
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
	<script>
		window.onload = function(){
			document.getElementById('preg').reset();
			document.getElementById('respuesta').reset();
		}
	</script>
</head>
<body>
	<?php
		include('anuncioService.php');
		include('header.php');
		session_start();
		if(isset($_SESSION['usuario'])){
			if(isset($_POST['anunc'])){
				$id=$_POST['anunc'];
				$service = new cabecera($_SESSION['usuario']);
				$service->buildHeader();
				$serv = new aService();
				$anun = $serv->levantarAnuncio($id);
				$row = $anun->fetch_assoc();
				$fecha=date('d/m/Y H:i', strtotime($row['Fecha']));
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
				<div class='col-xs-1 col-md-1'>
				</div>
				<div class='col-xs-9 col-md-9'>
					<h1><strong><span> <?php echo $row['Titulo'];?></span></strong></h1>
				</div>
				<div class='col-xs-2 col-md-2'>
					<form action='verCalificAnuncio.php' method='POST' enctype='multipart/form-data'>
						<input class='hidden' name='anunc' value=<?php echo "$id" ?>>
						<button type='submit' class="btn22"><h2><strong><span> <?php echo "Calificación";?></span></strong> </h2></button>
					</form>
				</div>
				<h2><strong><span class=''><?php  echo $serv->levantarPuntajePromedio($id);  ?></span></strong></h2>
			</div>
			<div class='row row-anuncio'>
				<div class='col-xs-6 col-md-6 col-anunc'>
					<img src=<?php echo "img/".$row['enlace'];?> class='imgDet'>	
				</div>
				<div class='col-xs-6 col-md-6 col-anunc'>	
					<div class='row row-contenido'>
					<?php 
						if ($row['Capacidad']==1){
							$persona='persona';
						}
						else{
							$persona='personas';
						}
						echo "
								<div class='contenido'>
									<p>".$row['tipo_hospedaje_Nombre']." para ".$row['Capacidad']." ".$persona." en ".$row['ciudad_nombre'].", ".$row['provincia_Nombre'].".</p>
									<p>".$row['Descripcion']."</p>
								</div>
								<div class='pie'>
									<p>Ofrecido por ".$row['usuario_Username']." <br> ".$fecha."</p>
								</div>
						";
					?>
					</div>
					<div class='row row-pie'>
						<div class='col-xs-4 col-md-4'>
							<a href='pagPrinc.php'><button class='btn22'>Salir</button></a>
						</div>
						<div class='col-xs-4 col-md-4'>
							<?php
								if ($_SESSION['id']==$row['usuario_ID']) { 
									$serv->marcarPregLeida($id);
									echo "
											<form action='editarPublicacion.php' method='POST' enctype='multipart/form-data'>
												<input class='hidden' name='anunc' value= ". $id .">
												<button type='submit' class='btn22'>Editar</button>
											</form>
									"; 
								}else{
									$aux = $serv->sinCalificacionesPendientes($_SESSION['id']);
									if ($aux == true) {
									echo "
											<form action='reservar.php' method='POST' enctype='multipart/form-data'>
												<input class='hidden' name='anunc' value= ". $id .">
												<button type='submit' class='btn22'>Reservar</button> 
											</form>
									";}
								}
							?>
						</div>
						<div class='col-xs-4 col-md-4'>
							<?php
								if($_SESSION['id']==$row['usuario_ID']){  //si es el mismo usuario que le aparezca la opcion de eliminar anuncio
									if ($row['activo'] == '1'){
									echo "
										<form action='confirBajaAnunc.php' method='POST' enctype='multipart/form-data'>
											<input class='hidden' name='anunc' value= ".$id.">
											<button type='submit' class='btn22'>Despublicar anuncio</button>
										</form>
										";
									}else{
										echo "
												<form action='confirAltaAnunc.php' method='POST' enctype='multipart/form-data'>
													<input class='hidden' name='anunc' value= ".$id.">
													<button type='submit' class='btn22'>Republicar anuncio</button>
												</form>
										";
									}
								}else{
									echo "
										<form method='POST' action='verPerfil.php'>
											<input class='hidden' name='id' value='".$row['usuario_ID']."'>
											<button class='btn22' type='submit'>Ver perfil</button>
										</form>
									";
								}
							?>
						</div>
					</div>
				</div>
			</div>

		
		</div>
			<?php

					$preg1 = $serv->levantarPreguntasAnuncio($row['ID_anuncio']);
					if($_SESSION['id']!=$row['usuario_ID']){
						echo "<br><h2>Preguntas al usuario</h2><br>";
					}else{
						if($preg1->num_rows>0){
							echo "<br><h2>Preguntas</h2><br>";
						}
					}
					if ($preg1->num_rows>0){
						while($row2 = $preg1->fetch_assoc()){
							$fecha=date('d/m/Y H:i', strtotime($row2['pregunta_fecha']));
							echo "		
										<div class='row'>
											<div class='col-xs-2 col-md-2'>
											</div>
											<div class='col-xs-8 col-md-8 anuncio'>
												<div class='row'>
													<br>
													<div class='col-xs-1 col-md-1'>
													</div>
													<div class='col-xs-2 col-md-2'>
														<span class='content'><strong>Pregunta:</strong></span>
													</div>
													<div class='col-xs-6 col-md-6'>
														<span class='content'>".$row2['texto']."</span>
													</div>
													<div class='col-xs-2 col-md-2'>
														<span class='content'>".$fecha."</span>
													</div>
													<div class='col-xs-1 col-md-1'>
													</div>
												</div>
												<div class='row'>
													<div class='col-xs-3 col-md-3'>
													</div>
													<div class='col-xs-6 col-md-6'>
														<span class='content'>Enviada por ".$row2['Username']."</span>
													</div>
													<div class='col-xs-3 col-md-3'>
													</div>
												</div>
							";
							$resp = $serv->levantarRespuestaAnuncio($row2['pregunta_ID']);
							if($resp->num_rows>0){  //si existe una respuesta para la pregunta, se publica
								$rowResp = $resp->fetch_assoc();
								$fecha=date('d/m/Y H:i', strtotime($rowResp['respuesta_fecha']));
								echo "
										<br>	
										<div class='row'>
											<div class='col-xs-1 col-md-1'>
											</div>
											<div class='col-xs-2 col-md-2'>
												<span class='content'><strong>Respuesta:</strong></span>
											</div>
											<div class='col-xs-6 col-md-6'>
												<span class='content'>".$rowResp['respuesta_texto']."</span>
											</div>
											<div class='col-xs-2 col-md-2'>
												<span class='content'>".$fecha."</span>
											</div>
											<div class='col-xs-1 col-md-1'>
											</div>
										</div>
								";
								if($_SESSION['id']==$row2['pregunta_ID_usuario']){
									$serv->marcarRespLeida($row2['pregunta_ID']);
								}
							}else{
								if ($_SESSION['id']==$row['usuario_ID']){
									echo " 	<br>					
											<form action='responder.php' method='POST' enctype='multipart/form-data'>
												<div class='row'>
													<div class='col-xs-1 col-md-1'>
													</div>
													<div class='col-xs-10 col-md-10'>
														<textarea class='form-control custom'  type='text' name='respuesta' id='respuesta' placeholder='Escribe tu respuesta' required style='width: 100%; height: 50px;'></textarea> 												
														<input class='hidden' name='anunc' value='".$row2['ID_anuncio']."'> 
														<input class='hidden' name='idpreg' value='".$row2['pregunta_ID']."'>														
													</div>
													<div class='col-xs-1 col-md-1'>											
													</div>
												</div>
												<div class='row'>
													<center><button type='submit' class='btn22'>Responder</button>
												</div>
											</form>
									";
								}
							}
							echo"
									<br>
									</div>
									<div class='col-xs-2 col-md-2'>
									</div>
								</div>
							";
						}
					}
					if ($_SESSION['id']!=$row['usuario_ID']){  //si no es el usuario autor del anuncio, se publica el campo para Preguntar
						echo"	<div class='row'>
									<div class='col-xs-2 col-md-2'>
										</div>
									<div class='col-xs-8 col-md-8'>
										<form id='preg' action='preguntar.php' method='POST'>
											<br>
											<textarea class='form-control custom'  type='text' name='pregunta' id='pregunta' placeholder='Escribe tu pregunta' required style='width: 500px; height: 100px;'></textarea>
											<input class='hidden' name='anunc' value= ".$id.">
											<button type='submit' class='btn22' >Preguntar</button>
										</form>
										<br>
									</div>
									<div class='col-xs-2 col-md-2'>
									</div>
								</div>
						";
					}
			if (!isset($_POST['reloaded'])){ //esto es horrible, pero es lo que se me ocurrio a las 12 de la noche... recarga la pagina para que se actualicen las notificaciones
				echo "	
					<form id='back' action='anuncDetalle.php' method='POST' enctype='multipart/form-data'>
						<input class='hidden' name='anunc' value=".$id.">
						<input class='hidden' name='reloaded' value='1'>
					</form>
					<script type='text/javascript'>
						function submitForm() {
							document.getElementById('back').submit();
						}
						window.onload = submitForm;
					</script>
				";
			}
			?>
	</center>
</body>
</html>