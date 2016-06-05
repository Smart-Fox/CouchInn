<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Detalle de anuncio</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel='stylesheet' href='style.css'/>
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
</head>
<body>
	<?php
		$id=$_POST['anunc'];
		include('anuncioService.php');
		include('header.php');
		session_start();
		if(isset($_SESSION['usuario'])){
			$service = new cabecera($_SESSION['usuario']);
			$service->buildHeader();
			$serv = new aService();
			$anun = $serv->levantarAnuncio($id);
			$row = $anun->fetch_assoc();
			$imagen = $serv->levantarImagen($row['ID']);
			$row1 = $imagen->fetch_assoc();
			$link = $row1['enlace'];
			$res =	$serv->levantarAnuncioCiudad($row['ID_ciudad']);
			$ciudad = $res->fetch_assoc();
			$res =	$serv->levantarAnuncioProv($ciudad['ID_provincia']);
			$prov = $res->fetch_assoc();
			$res =	$serv->levantarAnuncioAutor($row['ID_usuario']);
			$user = $res->fetch_assoc();
			$res =	$serv->levantarAnuncioTipo($row['ID_tipo_hospedaje']);
			$tipo = $res->fetch_assoc();
			$fecha=date('m/d/Y H:i', strtotime($row['Fecha']));
		} else {header('Location:index.html');} 
	?>
	<center>
		<div class='anunciodet'>
			<div class='row'>
				<div class='col-xs-1 col-md-1'>
				</div>
				<div class='col-xs-10 col-md-10'>
					<h1><strong><span> <?php echo $row['Titulo'];?></span></strong></h1>
				</div>
				<div class='col-xs-1 col-md-1'>
				</div>
			</div>
			<div class='row row-centered'>
				<div class='col-xs-6 col-md-6'>
					<img src=<?php echo "img/".$link;?> class='imgDet'>	
				</div>
				<div class='col-xs-6 col-md-6'>	
					<div class='row row-child-center'>
					<?php 
						echo "
								<div class='cont'>
									<p>".$tipo['Nombre']." para ".$row['Capacidad']." personas en ".$ciudad['nombre'].", ".$prov['Nombre'].".</p>
									<p>".$row['Descripcion']."</p>
								</div>
								<div class='pie'>
									<p>Ofrecido por ".$user['Username']."</p>
								</div>
								<div class='pie'>
									<p>".$fecha."</p><br>
								</div>
						";
					?>
					</div>
					<div class='row row-bottom'>
						<div class='col-xs-4 col-md-4'>
							<a href='pagPrinc.php'><button class='btn22'>Volver</button></a>
						</div>
						<div class='col-xs-4 col-md-4'>
							<?php
								if ($_SESSION['id']==$row['ID_usuario']) { 
									echo "
											<form action='editarPublicacion.php' method='POST' enctype='multipart/form-data'>
												<div class='row'>
													<div class='col-xs-8 col-md-8'>
														<input class='hidden' name='anunc' value= ". $id .">
														<button type='submit' class='btn22'>Editar</button>
													</div>
												</div>
											</form>
									"; 
								}
							?>
						</div>
						<div class='col-xs-4 col-md-4'>
							<form method='POST' action='verPerfil.php'>
								<input class='hidden' name='id' value='<?php echo $row['ID_usuario']; ?>'>
								<button class='btn22' type='submit'>Ver perfil</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		
	</center>
</body>
</html>