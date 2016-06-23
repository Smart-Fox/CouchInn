<?php
	include('../anuncioService.php');
	$serv = new aService();
	$id = $_POST['userid'];
	$preguntas = $serv->getPreguntas($id);
	$respuestas = $serv->getRespuestas($id);
	$solicitudes = $serv->getSolicitud($id);
	/*$devolver['preguntas'] = $preguntas;
	$devolver['respuestas'] = $respuestas;
	$devolver['solicitudes'] = $solicitudes; */
	$devolver = array(); 
	if(!empty($preguntas)){
		while ($row = $preguntas->fetch_assoc()){
				$devolver['preguntas'][] = $row;		
		}
	}
	if(!empty($respuestas)){
		while ($row = $respuestas->fetch_assoc()){
				$devolver['respuestas'][] = $row;		
		}
	}
	if(!empty($solicitudes)){
		while ($row = $solicitudes->fetch_assoc()){
				$devolver['solicitudes'][] = $row;		
		}
	}
	echo json_encode($devolver);
?>