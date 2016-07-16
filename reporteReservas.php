
 <!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Panel de administrador</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="css/bootstrap.min.css" />
	<link href="theme/jquery-ui.css" rel="stylesheet">
	<link rel='stylesheet' href='style.css'/>
	<script src="js/jquery.min.js"></script>
	<script src="theme/jquery-ui.js"></script>
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico"/>
</head>
<body>
	<center>
	<?php
		include_once('header.php');
		include_once('adminOptions.php');
		session_start();
		if((isset($_SESSION['usuario']))&&($_SESSION['type']=="admin")){
			$service = new cabecera($_SESSION['usuario']);
			$service->buildHeader();
			$display=new adminMenu();
		}else{
			header('Location:index.html');
		}
		if((isset($_POST['inicial2']))&&(isset($_POST['final2']))){
			include_once('reportesService.php');
			$inicial = $_POST['inicial2'];
			$final = $_POST['final2'];
			$res=reporteReservas($inicial, $final);
		}
		else{
			header('Location:pagPrinc.php');
		}
	?>
	<div>
		<?php
			if ($res->num_rows>0){
				echo"	
							<div class='row'>
								<strong>
								<div class='col-xs-2 col-md-2'>
									<span>Fecha de la solicitud</span>
								</div>
								<div class='col-xs-2 col-md-2'>
									<span>Anuncio</span>
								</div>
								<div class='col-xs-2 col-md-2'>
									<span>Usuario</span>
								</div>
								<div class='col-xs-2 col-md-2'>
									<span>Fecha inicial</span>
								</div>
								<div class='col-xs-2 col-md-2'>
									<span>Fecha final</span>
								</div>
								<div class='col-xs-2 col-md-2'>
									<span>Estado de la solicitud</span>
								</div>
								</strong>
							</div>
				";
				while($row = $res->fetch_assoc()){
					$fecha = date("d/m/Y", strtotime($row['fecha_solicitud']));
					$fechainicial=date("d/m/Y", strtotime($row['fecha_inicio']));
					$fechafinal=date("d/m/Y", strtotime($row['fecha_fin']));
					echo"
							<div class='row'>
								<div class='col-xs-2 col-md-2'>
									<span>".$fecha."</span>
								</div>
								<div class='col-xs-2 col-md-2'>
									<span>".$row['Titulo']."</span>
								</div>
								<div class='col-xs-2 col-md-2'>
									<span>".$row['Username']."</span>
								</div>
								<div class='col-xs-2 col-md-2'>
									<span>".$fechainicial."</span>
								</div>
								<div class='col-xs-2 col-md-2'>
									<span>".$fechafinal."</span>
								</div>
								<div class='col-xs-2 col-md-2'>
									<span>".$row['estado']."</span>
								</div>
							</div>
					";
				}
			}else{
				echo "No hay solicitudes registradas entre las fechas solicitadas.";
			}
		?>
	</div>
	</center>
</body>
</html>