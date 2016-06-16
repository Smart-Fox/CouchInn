<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Detalle de anuncio</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel='stylesheet' href='style.css'/>
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
				$fecha=date('m/d/Y H:i', strtotime($row['Fecha']));
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
				<div class='col-xs-10 col-md-10'>
					<h1><strong><span> <?php echo $row['Titulo'];?></span></strong></h1>
				</div>
				<div class='col-xs-1 col-md-1'>
				</div>
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
									echo "
											<form action='editarPublicacion.php' method='POST' enctype='multipart/form-data'>
												<input class='hidden' name='anunc' value= ". $id .">
												<button type='submit' class='btn22'>Editar</button>
											</form>
									"; 
								}else{
									echo "
											<form action='reservar.php' method='POST' enctype='multipart/form-data'>
												<input class='hidden' name='anunc' value= ". $id .">
												<button type='submit' class='btn22'>Reservar</button> 
											</form>
									";
								}
							?>
						</div>
						<div class='col-xs-4 col-md-4'>
							<form method='POST' action='verPerfil.php'>
								<input class='hidden' name='id' value='<?php echo $row['usuario_ID']; ?>'>
								<button class='btn22' type='submit'>Ver perfil</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		<?php
			if ($_SESSION['id']!=$row['usuario_ID']) { //si el usuario de la sesión es != al del anuncio
				echo 	"<hr>";
				echo"	<div class='row'>
							<div class='col-xs-2 col-md-2'>
								</div>
							<div class='col-xs-8 col-md-8'>
								<form id='preg' action='preguntar.php' method='POST'>
									<h2>Preguntas al usuario</h2>
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
				$preg1 = $serv->levantarPreguntasAnuncio($row['ID_anuncio']); 
				echo "<br> <br>";
				while($rowPreg = $preg1->fetch_assoc()){   //se publican las preguntas. Faltaria un if pa q no haga todo al dope
					echo "<hr>";
					echo " 
						<div class='row'>
							<div class='col-xs-2 col-md-2'>
								<span style='color:blue'><i>Pregunta</i></span>
							</div>
							<div class='col-xs-8 col-md-8 '>
								Usuario: ".$rowPreg['Username']."
								<br>
								<strong><span class='titulo2'>".$rowPreg['texto']."</span></strong> 
							</div>
							<div class='col-xs-2 col-md-2'> 
							</div>
						</div>
					";
					$resp = $serv->levantarRespuestaAnuncio($rowPreg['pregunta_ID']);
					if($resp->num_rows>0){  //si existe una respuesta para la pregunta, se publica
						$rowResp = $resp->fetch_assoc();
						echo " 
							<div class='row'>
								<div class='col-xs-2 col-md-2'>
									<span style='color:red'><i>Respuesta</i></span>
								</div>
								<div class='col-xs-8 col-md-8 '>
									Usuario: ".$rowResp['Username']."
									<br>
									<strong><span class='titulo2'>".$rowResp['respuesta_texto']."</span></strong> 
								</div>
								<div class='col-xs-2 col-md-2'> 
								</div>
							</div>
						";
					}
				}
			}else{  //el usuario de la sesion es el mismo que el del anuncio
				echo "<hr>";
				$serv1 = new aService();
				echo "<br> <br>";
				echo "<h2>Consultas sobre el anuncio</h2>";
				$preg = $serv1->levantarPreguntasAnuncio($row['ID_anuncio']);
				//var_dump($preg->fetch_assoc());
				while($rowPreg = $preg->fetch_assoc()){
					echo "<hr>";
					echo " 
							<div class='row'>
								<div class='col-xs-2 col-md-2'>
									<span style='color:blue'><i>Pregunta</i></span>
								</div>
								<div class='col-xs-8 col-md-8 '>
									Usuario: ".$rowPreg['Username']."
									<br>
									<strong><span class='titulo2'>".$rowPreg['texto']."</span></strong> 
								</div>
								<div class='col-xs-2 col-md-2'> 
								</div>
							</div>";
						$resp = $serv1->levantarRespuestaAnuncio($rowPreg['pregunta_ID']);
						//var_dump($resp->fetch_assoc());
						//var_dump($resp->num_rows==0);
						if($resp->num_rows>0){  //si existe una respuesta para la pregunta, se publica
							echo "<hr>";
							$rowResp = $resp->fetch_assoc();
							echo " 
								<div class='row'>
									<div class='col-xs-2 col-md-2'>
										<span style='color:red'><i>Respuesta</i></span>
									</div>
									<div class='col-xs-8 col-md-8 '>
										Usuario: ".$rowResp['Username']."
										<br>
										<strong><span class='titulo2'>".$rowResp['respuesta_texto']."</span></strong> 
									</div>
									<div class='col-xs-2 col-md-2'> 
									</div>
								</div>
							";
						}else{		// si no existe se deja el campo para responder junto al boton.
							echo " 
								<form action='responder.php' method='POST' enctype='multipart/form-data'>
									<div class='row'>
										<div class='col-xs-2 col-md-2'>
										</div>
										<div class='col-xs-7 col-md-7'>
											<textarea class='form-control custom'  type='text' name='respuesta' id='respuesta' placeholder='Escribe tu respuesta' required style='width: 650px; height: 50px;'></textarea> 												
											<input class='hidden' name='anunc' value= ".$id."> 
											<input class='hidden' name='idpreg' value= ".$rowPreg['pregunta_ID'].">														
										</div>
										<div class='col-xs-3 col-md-3'>											
											<button type='submit' class='btn22'>Responder</button>
										</div>
									</div>
								</form>
							";
						}
				}
			}
			
		?>
		</div>
	</center>
</body>
</html>