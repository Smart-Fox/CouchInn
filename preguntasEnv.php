<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Preguntas enviadas</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel='stylesheet' href='style.css'/>
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
	<script src="js/jquery.min.js"></script>
	<script type="text/javascript" src= "js/objeto.js"></script>
	<script type="text/javascript" src="js/bootstrap-filestyle.min.js"> </script>
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
			$id=$_SESSION['id'];
		}else{
			header('Location:index.html');
		}
		$serv = new aService();
		$preg = $serv->preguntasEnviadas($id);
		if($preg){
			while($row = $preg->fetch_assoc()){
				echo "	<form action='anuncDetalle.php' method='POST' enctype='multipart/form-data'>
							<div class='row'>
								<div class='col-xs-2 col-md-2'>
								</div>
								<div class='col-xs-8 col-md-8 anuncio'>
									<input class=hidden name='anunc' value=\"".$row['ID_anuncio']."\">
										<button type='submit' class='buttonlink'>
											<div class='row'>
												<div class='col-xs-12 col-md-12'>
													<strong><span class='titulo2'>".$row['texto']."</span></strong>
												</div>
											</div>
										</button>
									</input>
								</div>
								<div class='col-xs-2 col-md-2'>
								</div>
							</div>
						</form>
				";
			}
		}
	?>
	
</body>
</html>