<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Página Index</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel='stylesheet' href='style.css'/>
	<script language= "javascript" src= "js/validation.js"></script>
	<script>
		function validate(field){
			if (field.className!="touched")
				field.className += "touched";
		}
	</script>
</head>

<body>
	<center>
	<div class="main">
		<img src=logo.png width=500>
		<form class='formmain' action="login.php" method="POST" onsubmit="return validacion();">
			<br>
			<br>
			<div class="row">
				<span style="color:red">Email o Contraseña incorrectos</span>
				<div class="col-xs-12 col-md-12">
					<input name="usuario" id="usuario" type="email" placeholder="E-mail" onblur='validate(this)' required>
				</div>
				</div>
			<br>
			<div class="row">
				<div class="col-xs-12 col-md-12">
					<input name="password" id="password" type="password" placeholder="contraseña" onblur='validate(this)' required>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-xs-12 col-md-12">
					<button type="submit" class="btn">Ingresar</button>
				</div>

			</div>
			<br>
			<br>
			<br>
			<div>
				<a href="olvido-contra.html"><label>Recuperar contraseña</label></a> <a href="form-registro.html"><label>Registrarse</label></a>
			</div>
		</form>
	</div>
</body>
</html>