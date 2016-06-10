<?php

	include('dbManager.php');
	session_start();
	if(isset($_POST['numcard'])){
		$user=$_SESSION['id'];
		$conec = new dbManager();
		$conec->conectar();
		$_SESSION['type']='premium';
		$consulta=("SELECT * FROM precio");
		$res=$conec->ejecutarSQL($consulta);
		$prec=$res->fetch_assoc();
		$date=date("Y-m-d");
		$prec=$prec['Valor'];
		$consulta = ("INSERT INTO pago(monto, fecha) VALUES ('$prec', '$date');");
		$conec->ejecutarSQL($consulta);
		$id_pago=$conec->lastId();
		$consulta=("UPDATE usuario SET Tipo='premium', ID_pago='$id_pago' WHERE ID='$user';");
		$conec->ejecutarSQL($consulta);
		header('Location:newPrem.php');
	} else {
		header('Location:pagPrinc.php');
	}
?>