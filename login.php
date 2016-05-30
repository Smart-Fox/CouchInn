
<?php
	
	include('userService.php');

	
	if (!empty($_POST['usuario']) and !empty($_POST['password'])) {

			$user = $_POST['usuario'];
			$pass = crypt($_POST['password'],'radbrulz');
			$service = new UserService($user, $pass);
			$dato = $service->dameUsuario();
			$datos = $dato->fetch_row();
			if (is_null($datos)) {
				echo "ERROR: no existe el usuario en el sistema/Los datos son incorrectos";
				#header('Location: index.html');
			}else{
				session_start();
				$_SESSION['usuario'] = $datos[0];
				$_SESSION['password'] = $datos[1];
				$_SESSION['type'] = $datos[3];
				$_SESSION['id'] = $datos[4];
				
				header('Location: pagPrinc.php');
			}

		}else{
				echo "error: campos vacios";
		}


?>