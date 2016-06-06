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
			<div class='row row-anunc'>
				<div class='col-xs-6 col-md-6'>
					<img src=<?php echo "img/".$row['enlace'];?> class='imgDet'>	
				</div>
				<div class='col-xs-6 col-md-6 col-desc'>	
					<div class='row row-child-center'>
					<?php 
						if ($row['Capacidad']==1){
							$persona='persona';
						}
						else{
							$persona='personas';
						}
						echo "
								<div class='cont'>
									<span class='text'>
										<p>".$row['tipo_hospedaje_Nombre']." para ".$row['Capacidad']." ".$persona." en ".$row['ciudad_nombre'].", ".$row['provincia_Nombre'].".</p>
										<p>".$row['Descripcion']."</p>
									</span>
								</div>
								<div class='pie'>
									<p>Ofrecido por ".$row['usuario_Username']." <br> ".$fecha."</p>
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
								if ($_SESSION['id']==$row['usuario_ID']) { 
									echo "
											<form action='editarPublicacion.php' method='POST' enctype='multipart/form-data'>
												<input class='hidden' name='anunc' value= ". $id .">
												<button type='submit' class='btn22'>Editar</button>
											</form>
									"; 
								}else{
									echo "
											<form action='solicitarReserva.php' method='POST' enctype='multipart/form-data'>
												<input class='hidden' name='anunc' value= ". $id .">
												<button type='submit' class='btn22' disabled='disable'>Reservar</button> <!-- deshabilitado hasta que se implemente el solicitar reserva -->
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
		</div>
	</center>
</body>
</html>