<?php
	include('anuncioService.php');
	session_start();
	$idSolic=$_POST['solic'];
	$resp=$_POST['resp'];
	$idUser=$_SESSION['id'];
	$serv = new aService();
	$solic = $serv->levantarSolicitud($idSolic);
	$row=$solic->fetch_assoc();
	switch($resp){
		case 'cancelar':
			if ($row['ID_usuario']==$idUser){
				$serv->cancelarSolicitudHuesped($idSolic);
			}else{
				$serv->cancelarSolicitudAutor($idSolic);
			}
		break;
		
		case 'aceptar':
			
		break;
		
		case 'rechazar':
			$serv->rechazarSolicitud($idSolic);
		break;
	}
	if ($row['ID_usuario']==$idUser){
		header('Location: solicitudesEnv.php');
	}else{
		header('Location: solicitudesRec.php');
	}
?>