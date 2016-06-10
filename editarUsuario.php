<?php
	include('registerService.php');
	session_start();
	$nombre = $_POST['nombre'];
	$apellido = $_POST['apellido'];
	$telefono = $_POST['telefono'];
	$id=$_SESSION['id'];
	if ($_POST['pass']!="******"){
		$password = crypt($_POST['pass'], 'radbrulz');
		$consulta=("UPDATE usuario SET Nombre='$nombre', Apellido='$apellido', Telefono='$telefono', Contraseña='$password' WHERE ID='$id';");
	}else{
		$consulta=("UPDATE usuario SET Nombre='$nombre', Apellido='$apellido', Telefono='$telefono' WHERE ID='$id';");
	}
	$conec=new dbManager();
	$conec->conectar();
	$res=$conec->ejecutarSQL($consulta);
	header('Location: perfilEditado.php');
	
?>