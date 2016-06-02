
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Página principal</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel='stylesheet' href='style.css'/>
	<script language= "javascript" src= "js/validation.js"></script>
</head>
<body>
	<img src="" alt="">
	<?php
		include('anuncioService.php');
		include('header.php');
		session_start();
		if(isset($_SESSION['usuario'])){
			$service = new cabecera($_SESSION['usuario']);
			$service->buildHeader();
			echo "<a href='publicar.php'><button type=button class='btn'>Publicar anuncio</button></a> <br><br>";
			$serv = new aService();
			$anun = $serv->levantarAnuncios();
			while($row = $anun->fetch_assoc()){
				$imagen = $serv->levantarImagen($row['ID']);
				$row1 = $imagen->fetch_assoc();
				$link = $row1['enlace'];
				echo "	<form action='anuncDetalle.php' method='POST' enctype='multipart/form-data'>
							<div class='row'>
								<div class='col-xs-8 col-md-8' id='zoom'>
									<input class=hidden name='anunc' value=\"".$row['ID']."\">
										<button type='submit' class='buttonlink'>
											<h1>
												<strong><span class=col-xs-12 col-md-12 >".$row['Titulo']."</span></strong>
												<img src= img/".$link." class=imgAnun width='200'>
											</h1>
										</button>
									</input>
								</div>
							</div>
						</form>";
			}
		}else{
			header('Location:index.html');
		}
	?>
	
</body>
</html>