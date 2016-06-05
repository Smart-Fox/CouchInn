
<?php
	
	include('userService.php');

	
	if (!empty($_POST['usuario']) and !empty($_POST['password'])) {

			$user = $_POST['usuario'];
			$pass = ($_POST['password']);
			$service = new UserService($user, $pass);
			$dato = $service->dameUsuario();

			if (is_null($dato)) {
				echo "ERROR: no existe el usuario en el sistema/Los datos son incorrectos";
				#header('Location: index.html');
			}else{
				session_start();
				$_SESSION['usuario'] = $user;
				$_SESSION['password'] = $pass;
				header('Location: pagPrinc.html');
			}

		}else{
				echo "error: campos vacios";
		}


?>