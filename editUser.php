<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Editar perfil</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel='stylesheet' href='style.css'/>
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
	<script src='ajax/jquery.min.js'></script>
	<script src='ajax/jquery.validate.min.js'></script>
	<script type="text/javascript" src="js/jquery-1.2.6.min.js"></script>
	<script src="js/jquery.min.js"></script>
	<script type="text/javascript">
		window.onload = function () {
			document.getElementById("pass").onchange = validatePassword;
			document.getElementById("pass2").onchange = validatePassword;
			document.getElementById("pass").onchange = validatePasswordLength;
			document.getElementById("nombre").onchange = validateNombre;
			document.getElementById("apellido").onchange = validateApellido;
			document.getElementById("telefono").onchange = validateTelefono;
		}
		function validatePassword(){
			var pass1=document.getElementById("pass").value;
			var pass2=document.getElementById("pass2").value;
			if(pass1!=pass2){
				document.getElementById("pass2").setCustomValidity("Las contraseñas no coinciden");
				$("#statusp2").html("<font color=red>Las contraseñas no coinciden</font>");
			}else{
				document.getElementById("pass2").setCustomValidity('');
				$("#statusp2").html("");
			}
		}
		
		function validatePasswordLength(){
			var pass1=document.getElementById("pass").value;
			if(pass1.length<6){
				document.getElementById("pass").setCustomValidity("Ingrese una contraseña de 6 o más caracteres");
				$("#statusp").html("<font color=red>La contraseña debe tener 6 o más caracteres</font>");
			}else{
				document.getElementById("pass").setCustomValidity('');
				$("#statusp").html("");
			}
		}
		
		function validateNombre(){
			var nomb = document.getElementById("nombre").value;
			var letters = /^[A-Za-zñÑáéíóúÜ\s]+$/;
			if (!nomb.match(letters)){
				document.getElementById("nombre").setCustomValidity("Utilice sólo letras y espacios");
				$("#statusn").html("<font color=red>Utilice sólo letras y espacios</font>");
			}else{
				document.getElementById("nombre").setCustomValidity("");
				$("#statusn").html("");
			}
		}
		
		function validateApellido(){
			var ape = document.getElementById("apellido").value;
			var letters = /^[A-Za-zñÑáéíóúÜ\s]+$/;
			if (!ape.match(letters)){
				document.getElementById("apellido").setCustomValidity("Utilice sólo letras y espacios");
				$("#statusa").html("<font color=red>Utilice sólo letras y espacios</font>");
			}else{
				document.getElementById("apellido").setCustomValidity("");
				$("#statusa").html("");
			}
		}
		
		function validateTelefono(){
			var tel = document.getElementById('telefono').value;
			if (isNaN(tel)){
				document.getElementById("telefono").setCustomValidity("Ingrese solo números");
				$("#statust").html("<font color=red>Ingrese solo números sin espacios, guiones ni paréntesis</font>");
			}else{
				document.getElementById("telefono").setCustomValidity("");
				$("#statust").html("");
			}
		}
		
		function validate(field){
			if (field.className!="touched")
				field.className += "touched";
		}
		
	</script>
</head>

<body>
	<center>
	<?php
		include('header.php');
		include('anuncioService.php');
		session_start();
		if(isset($_SESSION['usuario'])){
			$service = new cabecera($_SESSION['usuario']);
			$service->buildHeader();
		}else{
			header('Location:index.html');
		}
		$serv = new aService();
		$us = $serv->levantarUsuario($_SESSION['id']);
		$row = $us->fetch_assoc();
	?>
	<h2>Editar perfil</h2>
	<h3>Edite los campos que desee, y luego presione "Guardar"</h3>
	<form id='editar' action="editarUsuario.php" method="POST" onsubmit="return validacion();">
		<div class='row reg'>
			<div class='col-xs-5 col-md-5'>
				<span class='labelform'>Nombre</span>
			</div>
			<div class='col-xs-2 col-md-2'>
			<input type="text" name = 'nombre' id='nombre' placeholder='Nombre' onblur='validate(this)' value='<?php echo $row['Nombre'] ?>' required>
			</div>
			<div class='col-xs-5 col-md-5'>
				<td width="400" align="left"><div id="statusn" class='status'></div></td>
			</div>
		</div>
		<div class='row reg'>
			<div class='col-xs-5 col-md-5'>
				<span class='labelform'>Apellido</span>
			</div>
			<div class='col-xs-2 col-md-2'>
				<input type="text" name = 'apellido' id='apellido' placeholder='Apellido' onblur='validate(this)' value='<?php echo $row['Apellido'] ?>'required>
			</div>
			<div class='col-xs-5 col-md-5'>
				<td width="400" align="left"><div id="statusa" class='status'></div></td>
			</div>
		</div>
		<div class='row reg'>
			<div class='col-xs-5 col-md-5'>
				<span class='labelform'>Teléfono</span>
			</div>
			<div class='col-xs-2 col-md-2'>
				<input type="text" name = 'telefono' id='telefono' placeholder='Teléfono' onblur='validate(this)' value='<?php echo $row['Telefono'] ?>' required>
			</div>
			<div class='col-xs-5 col-md-5'>
				<td width="400" align="left"><div id="statust" class='status'></div></td>
			</div>
		</div>
		<div class='row reg'>
			<div class='col-xs-5 col-md-5'>
				<span class='labelform'>Nueva contraseña</span>
			</div>
			<div class='col-xs-2 col-md-2'>
				<input type="password" name= 'pass' id = 'pass' value='******' onblur='validate(this)'>
			</div>
			<div class='col-xs-5 col-md-5'>
				<td width="400" align="left"><div id="statusp" class='status'></div></td>
			</div>
		</div>
		<div class='row reg'>
			<div class='col-xs-5 col-md-5'>
				<span class='labelform'>Confirmar contraseña</span>
			</div>
			<div class='col-xs-2 col-md-2'>
				<input type="password" name= 'pass2' id = 'pass2' value='******' onblur='validate(this)'>
			</div>
			<div class='col-xs-5 col-md-5'>
				<td width="400" align="left"><div id="statusp2" class='status'></div></td>
			</div>
		</div>
	</form>
	<form id="back" action='verPerfil.php' method='POST' enctype='multipart/form-data'>
		<input class='hidden' name='id' value='<?php echo $_SESSION['id']; ?>'>		
	</form>
	<div class='row reg'>
		<div class='col-xs-4 col-md-4'>	
		</div>
		<div class='col-xs-4 col-md-4 centered'>	
			<button id="cancelar" type='submit' class='btn btn-danger' form="back">Cancelar</button>
			<button type="submit" class="btn" form="editar">Guardar</button>
		</div>
		<div class='col-xs-4 col-md-4'>
		</div>
	</div>
</center>
</body>
</html>