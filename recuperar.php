<?php
	include('recuService.php');

	if (!empty($_POST['email']) {

			$mail = $_POST['email'];
			$service = new recuService($mail);
			$dato = $service->buscarUsuario($mail);
			if ($dato) {
				$contra = $service->recuperaContraseña($mail);
				#sumar pagina intermedia que notifique envio de mail
				#header('Location: index.html');
			} else {header('Location: index.html');} 

		} else { echo "campo vacios";}


?>