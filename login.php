
<?php


	include('anuncioService.php');
	include('userService.php');

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
				$fecha_actual = date("d/m/Y");
				$id = $_SESSION['id'];
				$solic = $serv->solicitudesRecibidas($id);
				if($solic->num_rows>0){
					while($row = $solic->fetch_assoc()){
						$inicial = date("d/m/Y", strtotime($row['fecha_inicio']));
						$final = date("d/m/Y", strtotime($row['fecha_fin']));

						if ($row['estado']=='aceptada'){
							if ($fecha_actual >= $inicial && $fecha_actual <= $final)
								$serv->solicitudEstadoActiva($row['solicitud_ID']);

							if ($fecha_actual > $final)
								$serv->solicitudEstadoFinalizada($row['solicitud_ID']);
						}

						if($row['estado'] == 'activa'){
							if ($fecha_actual > $final)
								$serv->solicitudEstadoFinalizada($row['solicitud_ID']);
						}

					}
				}

				$solic2 = $serv->solicitudesEnviadas($id);
				if($solic2->num_rows>0){
					while($row2 = $solic2->fetch_assoc()){
						$inicial = date("d/m/Y", strtotime($row2['fecha_inicio']));
						$final = date("d/m/Y", strtotime($row2['fecha_fin']));
						if ($row2['estado']=='aceptada'){
							if ($fecha_actual >= $inicial && $fecha_actual <= $final)
								$serv->solicitudEstadoActiva($row2['solicitud_ID']);
							if ($fecha_actual > $final)
								$serv->solicitudEstadoFinalizada($row2['solicitud_ID']);
						}

						if($row2['estado'] == 'activa'){
							if ($fecha_actual > $final)
								$serv->solicitudEstadoFinalizada($row2['solicitud_ID']);
						}
					}

				}
	
				header('Location: pagPrinc.php');
			}

		}else{
				echo "error: campos vacios";
		}


?>