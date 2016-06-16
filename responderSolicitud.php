<?php
	include('anuncioService.php');
	session_start();
	$idSolic=$_POST['solic'];
	$resp=$_POST['resp'];
	$idUser=$_SESSION['id'];
	
	$conec=new dbManager();
	$conec->conectar();
	$res=$conec->ejecutarSQL($consulta);
	$serv = new aService();
	$solic = $serv->levantarSolicitud($idSolic);
	$row=$solic->fetch_assoc();
	
	
	
	if ($row['ID_usuario']==$idUser){
		header('Location: solicitudesEnv.php');
	}else{
		header('Location: solicitudesRec.php');
	}
?>