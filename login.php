
<?php
	
	include('userService.php');

	
	if (!empty($_POST['usuario']) and !empty($_POST['password'])) {

			$user = $_POST['usuario'];
			$pass = crypt($_POST['password'],'radbrulz');
			$service = new UserService($user, $pass);
			$dato = $service->dameUsuario();
			if (is_null($dato)) {
				echo "ERROR: no existe el usuario en el sistema/Los datos son incorrectos";
				#header('Location: index.html');
			}else{
				session_start();
				$_SESSION['usuario'] = $dato[0];
				$_SESSION['password'] = $dato[1];
				$_SESSION['type'] = $dato[3];
				header('Location: pagPrinc.php');
			}

		}else{
				echo "error: campos vacios";
		}


?>