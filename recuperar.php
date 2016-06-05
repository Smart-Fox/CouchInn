<?php
	include('recuService.php');

	if (!empty($_POST['email']) and !empty($_POST['telefono'])) {

			$mail = $_POST['email'];
			$tel = $_POST['telefono'];
			$service = new recuService($mail, $tel);
			$dato = $service->buscarUsuario($mail);
			if ($dato) {
				$contra = $service->recuperaContraseña($mail);
				print_r($contra);
				#header('Location: index.html');
			} else {header('Location: index.html');} 

		} else { echo "campos vacios";}


?>