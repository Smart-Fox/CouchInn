<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Detalle de anuncio</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel='stylesheet' href='style.css'/>
	<script language= "javascript" src= "js/validation.js"></script>
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
			
		} else {header('Location:index.html');} ?>
			<div class='row'>
				<div class='col-xs-1 col-md-1'>
				</div>
				<div class='col-xs-9 col-md-9'>
					<h1><strong><span> <?php echo $row['Titulo'];?></span></strong></h1>
				</div>
				<div class='col-xs-2 col-md-2'>
				</div>
			</div>
			<div class='row'>
				<div class='col-xs-1 col-md-1'>
				</div>
				<div class='col-xs-5 col-md-5'>
					<img src=<?php echo "img/".$link;?> class='imgDet'>	
				</div>
				<div class='col-xs-5 col-md-3'>		
					<?php echo "Tipo de Hospedaje: ".$tipo['Nombre']."
							<br>
							Capacidad: ".$row['Capacidad']."
							<br>
							Descripción: ".$row['Descripcion']."
							<br>
							Provincia: ".$prov['Nombre']."
							<br>
							Ciudad:	".$ciudad['nombre']."
							<br>
							Autor: ".$user['Username']."
							<br>
							Fecha publicación: ".$row['Fecha']."
							<br>"?>
				</div>
				<div class='col-xs-1 col-md-1'>
				</div>
			</div>
			<div class='row'>
				<div class='col-xs-3 col-md-3'>
				</div>
				<div class='col-xs-2 col-md-2'>
					<a href='pagPrinc.php'><button class='btn'>Volver</button></a>
				</div>
				<div class='col-xs-2 col-md-2'>
					<?php
						if($_SESSION['id']==$row['ID_usuario']){
							echo "	<form action='editarPublicacion.php' method='POST' enctype='multipart/form-data'>
										<div class='row'>
											<div class='col-xs-8 col-md-8'>
												<input class='hidden' name='anunc' value=".$id." >
													<button type='submit' class='btn'>Editar</button>
												</input>
											</div>
										</div>
									</form>
							";
						}
					?>
				</div>
				<div class='col-xs-2 col-md-2'>
					<a href='verPerfil.php?id=<?php echo $row['ID_usuario']?>'><button class='btn'>Ver perfil del usuario</button></a>
				</div>
				<div class='col-xs-3 col-md-3'>
				</div>
			</div>
		
	
</body>
</html>