<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Calificando anuncio</title>
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
		<div class="anunciodet" style="display:inline-block">
			<h1 style="margin:0">Calificar hospedaje</h1>
			<form action="calificar.php" method="POST" >
				<div class='row'>
					<div>
						<span class='labelform2'>Comentario:</span>
						<textarea style="height:100px" type="text" name='desc' id='desc' placeholder='Cualquier información que considere relevante' required></textarea>
					</div>
					<div>
						<span class='labelform2'>Puntaje:</span>
						<input type="rating" name='puntaje' id="puntaje" required>
						<div class="rateit" data-rateit-backingfld="#puntaje" data-rateit-step='1' data-rateit-resetable="false" data-rateit-ispreset="false">
						</div>
					</div>
					<input class=hidden name='tipo' value='hospedaje'></input>
					<input class=hidden name='reserva' value='<?php echo $_POST['solic']; ?>'></input>
					</div>
				<button type="submit" class="btn">Enviar</button>
			</form>
		</div>
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