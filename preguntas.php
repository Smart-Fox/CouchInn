<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Preguntas</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel='stylesheet' href='style.css'/>
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
	<script src="js/jquery.min.js"></script>
	<script type="text/javascript" src= "js/objeto.js"></script>
	<script src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap-filestyle.min.js"> </script>
	<script type="text/javascript" src= "js/not.js"></script>
	<script type="text/javascript" src= "js/ver.js"></script>
	<script type="text/javascript" src= "js/verSolicitudes.js"></script>
	<script type="text/javascript" src="js/bootstrap-filestyle.min.js"></script>
	<script type="text/javascript">
		function showRec(){
			document.getElementById('recibidas').style.display = 'inline';
			$("#rec").addClass("selected");
			document.getElementById('enviadas').style.display = 'none';
			$("#env").removeClass("selected");			
		}
		function showEnv(){
			document.getElementById('enviadas').style.display = 'inline';
			$("#env").addClass("selected");
			document.getElementById('recibidas').style.display = 'none';
			$("#rec").removeClass("selected");			
		}
	</script>
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
		echo"
			<div class='row'>
				<div class='col-xs-4 col-md-4'>
				</div>
				<div class='col-xs-2 col-md-2'>
					<div class='centered'>
						<button type=button id='env' class='btn2' onclick='showEnv();'>Preguntas enviadas</button>
					</div>
				</div>
				<div class='col-xs-2 col-md-2'>
					<div class='centered'>
						<button type=button id='rec' class='btn2' onclick='showRec();'>Preguntas recibidas</button>
					</div>
				</div>
				<div class='col-xs-4 col-md-4'>
				</div>
			</div>
		";
		$serv = new aService();
		$preg = $serv->preguntasRecibidas($id);
		echo "<div id='recibidas'>";
		if($preg->num_rows>0){
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
		}else{
			echo"
				<center>
					<div class='row'>
						<div class='col-xs-2 col-md-2'>
						</div>
						<div class='col-xs-8 col-md-8'>
							<strong><span class='titulo2'>No hay preguntas recibidas</span></strong>
						</div>
						<div class='col-xs-2 col-md-2'>
						</div>
					</div>
				</center>
			";
		}
		echo "</div>";
		$preg2 = $serv->preguntasEnviadas($id);
		echo "<div id='enviadas'>";
		if($preg2->num_rows>0){
			while($row2 = $preg2->fetch_assoc()){
				echo "	<form action='anuncDetalle.php' method='POST' enctype='multipart/form-data'>
							<div class='row'>
								<div class='col-xs-2 col-md-2'>
								</div>
								<div class='col-xs-8 col-md-8 anuncio'>
									<input class=hidden name='anunc' value=\"".$row2['ID_anuncio']."\">
										<button type='submit' class='buttonlink'>
											<div class='row'>
												<div class='col-xs-12 col-md-12'>
													<strong><span class='titulo2'>".$row2['texto']."</span></strong>
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
		}else{
			echo"
				<center>
					<div class='row'>
						<div class='col-xs-2 col-md-2'>
						</div>
						<div class='col-xs-8 col-md-8'>
							<br>
							<strong><span class='titulo2'>No hay preguntas enviadas</span></strong>
						</div>
						<div class='col-xs-2 col-md-2'>
						</div>
					</div>
				</center>
			";
		}
		echo "</div>";
	?>
	
</body>
</html>