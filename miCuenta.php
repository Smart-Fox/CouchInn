<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Mi cuenta</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="css/bootstrap.min.css"/>
	<link rel='stylesheet' href='style.css'/>
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/jquery.min.1.9.js"></script>
	<script src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap-filestyle.min.js"></script>
</head>
<body>

<?php
	include('header.php');
	include('cuentaOptions.php');
	session_start();
	if(isset($_SESSION['usuario'])){
		$service = new cabecera($_SESSION['usuario']);
		$service->buildHeader();
		$display=new cuentaMenu();
	}else{
		header('Location:index.html');
	}
?>
	
</body>
</html>