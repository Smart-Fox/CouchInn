
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>CouchInn</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="css/bootstrap.min.css"/>
	<link rel='stylesheet' href='style.css'/>
	<script language= "javascript" src= "js/validation.js"></script>
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
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
			if($anun){

			while($row = $anun->fetch_assoc()){
				$autor= $serv->levantarAnuncioAutor($row['ID_usuario']);
					$row2=$autor->fetch_assoc();
					if(($row2['Tipo']=="premium")||($row2['Tipo']=="admin")){
						$imagen = $serv->levantarImagen($row['ID']);
						$row1=$imagen->fetch_assoc();
						$link = $row1['enlace'];
					}else{
						$link='logo.png';
					}
					echo "	<form action='anuncDetalle.php' method='POST' enctype='multipart/form-data'>
								<div class='row'>
									<div class='col-xs-2 col-md-2'>
									</div>
									<div class='col-xs-8 col-md-8 anuncio'>
										<input class=hidden name='anunc' value=\"".$row['ID']."\">
											<button type='submit' class='buttonlink'>
												<div class='row'>
													<div class='col-xs-3 col-md-3' id='img'>
														<img src= img/".$link." class='imgAnun'>
													</div>
													<div class='col-xs-9 col-md-9'>
														<h2>
															<strong><span class='titulo'>".$row['Titulo']."</span></strong>
														</h2>
													</div>
												</div>
											</button>
										</input>
									</div>
									<div class='col-xs-2 col-md-2'>
									</div>
								</div>
							</form>";
			}}
		}else{
			header('Location:index.html');
		}
	?>
	
</body>
</html>