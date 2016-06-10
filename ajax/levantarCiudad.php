<?php
		include('../anuncioService.php');
		$serv = new aService();
		$id = $_POST['idprov'];
		$ciudades = $serv->levantarCiudad($id);
		$devolver = array();
		if (!empty($ciudades)){
			while ($row = $ciudades->fetch_assoc()){
					$devolver[] = $row;		
			}
		}
		echo json_encode($devolver);
?>