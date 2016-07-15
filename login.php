<?php
	include_once('anuncioService.php');
	include_once('userService.php');
	if (!empty($_POST['usuario']) and !empty($_POST['password'])) {
			$user = $_POST['usuario'];
			$pass = crypt($_POST['password'],'radbrulz');
			$service = new UserService($user, $pass);
			$dato = $service->dameUsuario();
			$datos = $dato->fetch_row();
			if (is_null($datos)) {
				echo "ERROR: no existe el usuario en el sistema/Los datos son incorrectos";
				header('Location: iindex.html');
			}else{
				
				session_start();
				$_SESSION['usuario'] = $datos[0];
				$_SESSION['password'] = $datos[1];
				$_SESSION['type'] = $datos[3];
				$_SESSION['id'] = $datos[4];
				$serv = new aService();
				$fecha_actual = date("Y-m-d");
				$id = $_SESSION['id'];
				$solic = $serv->solicitudesTodas();
				if($solic->num_rows>0){
					while($row = $solic->fetch_assoc()){
						$inicial = date("Y-m-d", strtotime($row['fecha_inicio']));
						$final = date("Y-m-d", strtotime($row['fecha_fin']));
						if ($row['estado']=='pendiente'){
							if ($fecha_actual >=$inicial)
								$serv->rechazarSolicitud($row['ID']);
						}
						if ($row['estado']=='aceptada'){
							if ($fecha_actual >= $inicial && $fecha_actual <= $final)
								$serv->solicitudEstadoActiva($row['ID']);
							if ($fecha_actual > $final)
								$serv->solicitudEstadoFinalizada($row['ID']);
						}
						if($row['estado'] == 'activa'){
							if ($fecha_actual > $final)
								$serv->solicitudEstadoFinalizada($row['ID']);
						}
					}
				}	
				header('Location: pagPrinc.php');
			}
		}else{
				echo "error: campos vacios";
		}
?>