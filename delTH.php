
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Panel de administrador</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel='stylesheet' href='style.css'/>
	<script src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap-filestyle.min.js"> </script>
	<script type="text/javascript" src= "js/not.js"></script>
	<script type="text/javascript" src= "js/ver.js"></script>
	<script type="text/javascript" src= "js/verSolicitudes.js"></script>
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
</head>
<body>
	<?php
		include('header.php');
		include('adminOptions.php');
		session_start();
		if((isset($_SESSION['usuario']))&&($_SESSION['type']=="admin")){
			$service = new cabecera($_SESSION['usuario']);
			$service->buildHeader();
			$display=new adminMenu();
			
			include('regTipoService.php');

			$nombre = $_POST['tipoHosp'];
		
			$service = new regTipoService($nombre);
			$result=$service->revisarTipo();
			if($result){
				echo "	
				
				<div class='row'>
					<div class='col-xs-3 col-md-3'>
					</div>
					<div class='col-xs-6 col-md-6'>
						<p class='feedback'>
							El tipo de hospedaje que desea eliminar está siendo utilizado por uno o más anuncios.<br>
							De continuar con la eliminación, el tipo de hospedaje no podrá ser utilizado en nuevos anuncios, pero seguirá apareciendo en los anuncios existentes.<br>
							De necesitar restaurar el tipo de hospedaje eliminado, tiene que volver a agregarlo al sistema.
							¿Desea continuar con la eliminación?
						</p>
					</div>
					<div class='col-xs-3 col-md-3'>
					</div>
				</div>
				<div class='row'>
					<div class='col-xs-2 col-md-2'>
					</div>
					<div class='col-xs-4 col-md-4' id='feedback'>
						<a href='admTH.php'><button type=button class='btn2'>Cancelar</button></a>
					</div>
					<div class='col-xs-4 col-md-4' id='feedback'>
						<form action='delLog.php' method='POST'>
							<input class='hidden' name='tipoHosp' value='".$nombre."'></input>
							<button type=submit class='btn2'>Continuar</button>
						</form>
					</div>
					<div class='col-xs-2 col-md-2'>
					</div>
				</div>
			";
			}else{
				$service->eliminarFisico();
				header('Location: tipoEliminado.php');
			}
		}else{
			header('Location:index.html');
		}
	?>
</body>
</html>