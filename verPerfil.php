<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Perfil</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel='stylesheet' href='style.css'/>
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
	<script src="js/jquery.min.js"></script>
	<script type="text/javascript" src= "js/objeto.js"></script>
	<script type="text/javascript" src="js/bootstrap-filestyle.min.js"> </script>
	<script type="text/javascript" src= "js/not.js"></script>
	<script type="text/javascript" src= "js/verSolicitudes.js"></script>
	<script type="text/javascript" src= "js/ver.js"></script>
</head>
<body>
	<?php
		include('header.php');
		include('anuncioService.php');
		session_start();
		if(isset($_SESSION['usuario'])){
			if(isset($_POST['id'])){
				$service = new cabecera($_SESSION['usuario']);
				$service->buildHeader();
				$id=$_POST['id'];
			}else{
				header('Location:pagPrinc.php');
			}
		}else{
			header('Location:index.html');
		}
		$serv = new aService();
		$anun = $serv->levantarAnuncioDeUsuario($id);
		$us = $serv->levantarUsuario($id);
		$rowUs = $us->fetch_assoc();
		$nomUser = $rowUs['Username'];
		
		if ($_SESSION['id'] == $id){
			include('cuentaOptions.php');
			$display=new cuentaMenu();
			$nombre = $rowUs['Nombre'];
			$apellido = $rowUs['Apellido'];
			$email = $rowUs['Email'];
			$telefono = $rowUs['Telefono'];
			$tipo = $rowUs['Tipo'];
			echo "	<div class='row'>
						<div class='col-xs-2 col-md-2'>
						</div>
						<div class='col-xs-8 col-md-8 anuncio '>
							<div class='row'>
								<div class='col-xs-4 col-md-4'>
								</div>
								<div class='col-xs-8 col-md-8'>
									<h2><strong>Perfil de Usuario <br></strong></h2>
									<h3>
										Nombre: <strong><span class='titulo2'>".$nombre."</span></strong> <strong><span class='titulo2'>".$apellido."</span></strong> <br>
										Teléfono:	<strong><span class='titulo2'>".$telefono."</span></strong> <br>
										Email: 	<strong><span class='titulo2'>".$email."</span></strong> <br>
										Tipo Usuario:	<strong><span class='titulo2'>".$tipo."</span></strong>
									</h3>
									<a href='editUser.php'><button class='btn22'>Editar</button></a>
								</div>
							</div>
						</div>
						<div class='col-xs-2 col-md-2'>
						</div>
					</div>";
			}else{
					echo "	<div class='row'>
							<div class='col-xs-2 col-md-2'>
							</div>
							<div class='col-xs-8 col-md-8 anuncio '>
								<div class='row'>
									<div class='col-xs-4 col-md-4'>
									</div>
									<div class='col-xs-8 col-md-8'>
										<h2><strong>Perfil de Usuario <br></strong></h2>
										<h3>
											Nombre de Usuario: <strong><span class='titulo'>".$nomUser."</span></strong> <br>
											<a href='pagPrinc.php'><button class='btn22'>Salir</button></a>
										</h3>
									</div>
								</div>
							</div>
							<div class='col-xs-2 col-md-2'>
							</div>
						</div>";
				}
				echo "	<div class='row'>
							<div class='col-xs-2 col-md-2'>
							</div>
							<div class='col-xs-10 col-md-10'>
								<h2><strong>Publicaciones</strong></h2>
							</div>
						</div>";
			if($anun){
				while($row = $anun->fetch_assoc()){
					echo "	<form action='anuncDetalle.php' method='POST' enctype='multipart/form-data'>
								<div class='row'>
									<div class='col-xs-2 col-md-2'>
									</div>
									<div class='col-xs-8 col-md-8 anuncio'>
										<input class=hidden name='anunc' value=\"".$row['anuncio_ID']."\">
											<button type='submit' class='buttonlink'>
												<div class='row'>
													<div class='col-xs-3 col-md-3' id='img'>
														<img src= img/".$row['enlace']." class='imgAnun'>
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
				}
			}
	?>
	
</body>
</html>