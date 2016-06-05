
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Panel de administrador</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel='stylesheet' href='style.css'/>
	<script language="javascript">
        var x = 0;

        function showMe(x) {
            if(x == 0) {
                document.getElementById("1").style='visibility: hidden;';
                document.getElementById("2").style='visibility: hidden;';
				document.getElementById("3").style='visibility: hidden;';
				document.getElementById("4").style='visibility: hidden;';
            }

            if(x == 1) {
                document.getElementById("1").style='visibility: visible;';
                document.getElementById("2").style='visibility: hidden;'; 
				document.getElementById("3").style='visibility: hidden;';
				document.getElementById("4").style='visibility: hidden;';
            }

            if(x == 2)  {
                document.getElementById("1").style='visibility: hidden;';
                document.getElementById("2").style='visibility: visible;';
				document.getElementById("3").style='visibility: hidden;';
				document.getElementById("4").style='visibility: hidden;';
            }
				
			if(x == 3)  {
                document.getElementById("1").style='visibility: hidden;';
                document.getElementById("2").style='visibility: hidden;';
				document.getElementById("3").style='visibility: visible;';
				document.getElementById("4").style='visibility: hidden;';
            }
			
			if(x == 4)  {
                document.getElementById("1").style='visibility: hidden;';
                document.getElementById("2").style='visibility: hidden;';
				document.getElementById("3").style='visibility: hidden;';
				document.getElementById("4").style='visibility: visible;';
            }
        }
    </script>
</head>
<body>
	<?php
		include('header.php');
		session_start();
		if((isset($_SESSION['usuario']))&&($_SESSION['type']=="admin")){
			$service = new cabecera($_SESSION['usuario']);
			$service->buildHeader();
			echo "	<div class='list'>
						<br>
						<br>
						<div class='row'>
							<div class='col-xs-3 col-md-3'>
								<button type=button class='btn2' onclick='showMe(1)'>Administrar tipos de hospedaje</button>
							</div>
							<div class='col-xs-3 col-md-3'>
								<div class='form-group' id='1' style='visibility: hidden;'>
									<select class='form-control' id='admTH'>
										<option selected disabled>Elegir operación:</option>
										<option value=1>Agregar tipo de hospedaje</option>
										<option value=2>Modificar tipo de hospedaje</option>
										<option value=3>Eliminar tipo de hospedaje</option>
									</select>
								</div>
							</div>
							<div class='col-xs-6 col-md-6'>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-3 col-md-3'>
								<button type=button class='btn2' onclick='showMe(2)'>Ver reportes</button>
							</div>
							<div class='col-xs-3 col-md-3'>
								<div class='form-group' id='2' style='visibility: hidden;'>
									<select class='form-control' id='obtRep'>
										<option selected disabled>Elegir operación:</option>
										<option value=1>Ver reporte de reservas realizadas</option>
										<option value=2>Ver reporte de pagos de premium</option>
									</select>
								</div>
							</div>
							<div class='col-xs-6 col-md-6'>
							</div>
						</div>	
						<div class='row'>
							<div class='col-xs-3 col-md-3'>
								<button type=button class='btn2' onclick='showMe(3)'>Administrar usuarios</button>
							</div>
							<div class='col-xs-3 col-md-3'>
								<div class='form-group' id='3' style='visibility: hidden;'>
									<select class='form-control' id='admUs'>
										<option selected disabled>Elegir operación:</option>
										<option value=1>Modificar usuario</option>
										<option value=2>Eliminar usuario</option>
									</select>
								</div>
							</div>
							<div class='col-xs-6 col-md-6'>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-3 col-md-3'>
								<button type=button class='btn2' onclick='showMe(4)'>Cambiar precio de servicio premium</button>
							</div>
							<div class='col-xs-3 col-md-3'>
							</div>
							<div class='col-xs-6 col-md-6'>
							</div>
						</div>
					</div>
				";
		}else{
			header('Location:index.html');
		}
	?>
	
</body>
</html>