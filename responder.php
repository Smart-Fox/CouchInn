<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Perfil</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel='stylesheet' href='style.css'/>
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
	<script src="js/jquery.min.js"></script>
	<script type="text/javascript" src= "js/objeto.js"></script>
	<script type="text/javascript" src="js/bootstrap-filestyle.min.js"> </script>
</head>
<body>
	<?php
		include ('anuncioService.php');
		session_start();
		$boolean=false;
		$resp = $_POST['respuesta'];
		$idAnun = $_POST['anunc'];
		$idPreg = $_POST['idpreg'];
		$serv = new aService();
		
		$serv->publicarRespuesta($idPreg, $resp);
		unset($_POST['respuesta']);
		$boolean=true;
		if($boolean){
			echo "	
					<form id='back' action='anuncDetalle.php' method='POST' enctype='multipart/form-data'>
						<input class='hidden' name='anunc' value=".$idAnun.">	
					</form>
					<script type='text/javascript'>
						function submitForm() {
							document.getElementById('back').submit();
						}
						window.onload = submitForm;
					</script>
			";
		}
	?>			
</body>
</html>