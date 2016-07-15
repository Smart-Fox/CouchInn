<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Solicitudes</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel='stylesheet' href='style.css'/>
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
	<script src="js/jquery.min.js"></script>
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
				if(isset($_POST['tipo'])){
					$serv = new aService();
					$id=$_SESSION['id'];
				}
			$service = new cabecera($_SESSION['usuario']);
			$service->buildHeader();
			$display=new cuentaMenu();
		}else{
			header('Location:index.html');
		}
		echo "
			<div class='row'>
				<div class='col-xs-4 col-md-4'>
				</div>
				<div class='col-xs-2 col-md-2'>
					<div class='centered'>
						<button type=button id='env' class='btn2' onclick='showEnv();'>Solicitudes enviadas</button>
					</div>
				</div>
				<div class='col-xs-2 col-md-2'>
					<div class='centered'>
						<button type=button id='rec' onclick='showRec();' class='btn2'>Solicitudes recibidas</button>
					</div>
				</div>
				<div class='col-xs-4 col-md-4'>
				</div>
			</div>
			<br>
		";
		$solic = $serv->solicitudesRecibidas($id);
		echo "<div id='recibidas'>";
		if($solic->num_rows>0){
			while($row = $solic->fetch_assoc()){
				$inicial = date("d/m/Y", strtotime($row['fecha_inicio']));
				$final = date("d/m/Y", strtotime($row['fecha_fin']));
				echo "	
					<div class='row'>
						<div class='col-xs-2 col-md-2'>
						</div>
						<div class='col-xs-8 col-md-8 solicitud'>
							<div class='row'>
								<div class='col-xs-4 col-md-4'>
									<strong><span>".$row['Titulo']."</span></strong>
								</div>
								<div class='col-xs-3 col-md-3'>
									<span>".$inicial." - ".$final."</span>
								</div>
								<div class='col-xs-3 col-md-3'>
									<span>Estado: ".$row['estado']."</span>
								</div>
								<div class='col-xs-2 col-md-2'>
									<form action='solicitudDetalle.php' method='POST' enctype='multipart/form-data'>
										<button type='submit' class='btn222'>
											<input class='hidden' name='idsol' value='".$row['solicitud_ID']."'>
											<input class='hidden' name='tipo' value='recibidas'>
											<span>Ver detalle</span>
										</button>
									</form>
								</div>
							</div>
						</div>
						<div class='col-xs-2 col-md-2'>
						</div>
					</div>	
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
							<strong><span class='titulo2'>No hay solicitudes recibidas</span></strong>
						</div>
						<div class='col-xs-2 col-md-2'>
						</div>
					</div>
				</center>
			";
		}
		echo "</div>";
		$solic2 = $serv->solicitudesEnviadas($id);
		echo "<div id='enviadas'>";
		if($solic2->num_rows>0){
			while($row2 = $solic2->fetch_assoc()){
				$inicial = date("d/m/Y", strtotime($row2['fecha_inicio']));
				$final = date("d/m/Y", strtotime($row2['fecha_fin']));
				echo "	
					<div class='row'>
						<div class='col-xs-2 col-md-2'>
						</div>
						<div class='col-xs-8 col-md-8 solicitud'>
							<div class='row'>
								<div class='col-xs-4 col-md-4'>
									<strong><span>".$row2['Titulo']."</span></strong>
								</div>
								<div class='col-xs-3 col-md-3'>
									<span>".$inicial." - ".$final."</span>
								</div>
								<div class='col-xs-3 col-md-3'>
									<span>Estado: ".$row2['estado']."</span>
								</div>
								<div class='col-xs-2 col-md-2'>
									<form action='solicitudDetalle.php' method='POST' enctype='multipart/form-data'>
										<button type='submit' class='btn222'>
											<input class='hidden' name='idsol' value='".$row2['solicitud_ID']."'>
											<input class='hidden' name='tipo' value='enviadas'>
											<span>Ver detalle</span>
										</button>
									</form>
								</div>
							</div>
						</div>
						<div class='col-xs-2 col-md-2'>
						</div>
					</div>
				";
			}
		}else{
			echo"
				<center>
					<div class='row'>
						<div class='col-xs-2 col-md-2'>
						</div>
						<div class='col-xs-8 col-md-8'>
							<strong><span class='titulo2'>No hay solicitudes enviadas</span></strong>
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