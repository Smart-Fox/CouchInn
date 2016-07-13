<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Calificaciones</title>
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
			$idAnun=$_POST['anunc'];
			$anun = $serv->levantarAnuncio($idAnun);
			$row = $anun->fetch_assoc();
			$calif = $serv->levantarCalificacionesAnuncio($idAnun);
			
			$id=$_SESSION['id'];
			
		}else{
			header('Location:index.html');
		}
		
	?>

	<center>
			<h1 >COMENTARIOS</h1>
		<div class="" style="">
			
			
				<div class='row'>
					<div style="float:left;width:60%;margin-right:30px;margin-left: 30px">
							<?php 
								if($calif->num_rows>0){
									while ($rowComent = $calif->fetch_assoc()){
										//var_dump($rowComent);
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
															<span class='content'><strong>Comentario:</strong></span>
														</div>
														<div class='col-xs-6 col-md-6'>
															<i><span class='content'>".$rowComent['comentario']."</span></i>
														</div>
														<div class='col-xs-2 col-md-2'>
															<span class='content'><strong>Puntaje:</strong></span>
														</div>
														<div class='col-xs-1 col-md-1'>
															<i><span class='content'>".$rowComent['puntaje']."</span></i>
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
											</div>
								";
									}

									echo "<strong><u>PUNTAJE PROMEDIO: ".$serv->levantarPuntajePromedioAnuncio($idAnun)."</u></strong>";
								}else{

									echo "<center>
							<div class='row'>
								<div class='col-xs-2 col-md-2'>
								</div>
								<div class='col-xs-8 col-md-8'>
									<br>
									<strong><span class='titulo2'>No hay calificaciones para este anuncio</span></strong>
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
	</center>
	
</body>
</html>