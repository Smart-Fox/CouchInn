
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Compra de servicio premium</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="css/bootstrap.min.css"/>
	<link rel='stylesheet' href='style.css'/>
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
	<script src='ajax/jquery.min.js'></script>
	<script src='ajax/jquery.validate.min.js'></script>
	<script type="text/javascript" src="js/jquery-1.2.6.min.js"></script>
	<script type="text/javascript">
		function msgnumcard() {
			var num = document.getElementById("numcard").value;
			var pattern = /^[0-9]{13,16}$/;
			if (!num.match(pattern)){
				document.getElementById("numcard").setCustomValidity("Ingrese un número de tarjeta válido, sin espacios");
				$("#statust").html("<font color=red>Ingrese un número de tarjeta válido, sin espacios</font>");
			}else{
				document.getElementById("numcard").setCustomValidity("");
			}
		}
		function msgcvv() {
			var num = document.getElementById("cvv").value;
			var pattern = /^[0-9]{3,4}$/;
			if (!num.match(pattern)){
				document.getElementById("cvv").setCustomValidity("Ingrese el código de seguridad de su tarjeta (3 dígitos VISA/Mastercard, 4 dígitos American Express)");
				$("#statusc").html("<font color=red>Ingrese el CVV de su tarjeta (3 o 4 dígitos)</font>");
			}else{
				document.getElementById("cvv").setCustomValidity("");
			}
		}
		function msgnamecard() {
			var name = document.getElementById("namecard").value;
			var pattern = /^[A-Z a-zñÑáéíóúÜ]{6,22}$/;
			if (!name.match(pattern)){
				document.getElementById("namecard").setCustomValidity("Ingrese el nombre del titular de la tarjeta (solo letras y espacios)");
				$("#statusn").html("<font color=red>Utilice sólo letras y espacios</font>");
			}else{
				document.getElementById("namecard").setCustomValidity("");
			}
		}
		function validate(field){
			if (field.className!="touched")
				field.className += "touched";
		}
	</script>
</head>
<body>
	<?php
		include('header.php');
		include('adminOptions.php');
		include('dbManager.php');
		session_start();
		if((isset($_SESSION['usuario']))&&($_SESSION['type']=='common')){
			$service = new cabecera($_SESSION['usuario']);
			$service->buildHeader();
		}else{
			header('Location:index.html');
		}
		$conec = new dbManager();
		$conec->conectar();
		$consulta = "SELECT * FROM precio";
		$resulSQL= $conec->ejecutarSQL($consulta);
		$prec=$resulSQL->fetch_assoc();
	?>
	<div class='row'>
		<div class='col-xs-2 col-md-2'>
		</div>
		<div class='col-xs-8 col-md-8'>
			<h3 class='prem'>Para realizar el pago de $<?php echo $prec['Valor']?> para adquirir la membresía premium, ingrese los datos de su tarjeta de crédito</h3>
		</div>
		<div class='col-xs-2 col-md-2'>
		</div>
	</div>
	<form action="pagoPrem.php" method="POST" enctype="multipart/form-data" id='pagoprem'>
		<div class='row'>
			<div class='col-xs-3 col-md-3'>
			</div>
			<div class='col-xs-2 col-md-2'>
				<span class='labelform'>Tarjeta</span>
			</div>
			<div class='col-xs-3 col-md-3'>
				<select id='card' class="form-control custom" name="card" required>
					<option selected="true" value="VISA">VISA</option>
					<option value="American">American Express</option>
					<option value="Mastercard">Mastercard</option>
				</select>
			</div>
			<div class='col-xs-4 col-md-4'>
			</div>
		</div>
		<div class='row'>
			<div class='col-xs-3 col-md-3'>
			</div>
			<div class='col-xs-2 col-md-2'>
				<span class='labelform'>Número de tarjeta</span>
			</div>
			<div class='col-xs-3 col-md-3'>
				<input type="text" name='numcard' id='numcard' onchange='msgnumcard()' placeholder='Ej: 1234567890123456' onblur='validate(this)' autocomplete='off' required>
			</div>
			<div class='col-xs-4 col-md-4'>
				<td width="350" align="left"><div id="statust" class='status'></div></td>
			</div>
		</div>
		<div class='row'>
			<div class='col-xs-3 col-md-3'>
			</div>
			<div class='col-xs-2 col-md-2'>
				<span class='labelform'>CVV (Código de seguridad)</span>
			</div>
			<div class='col-xs-3 col-md-3'>
				<input type="text" name='cvv' id='cvv' onchange='msgcvv()' placeholder='Ej: 123' onblur='validate(this)' autocomplete='off' required>
			</div>
			<div class='col-xs-4 col-md-4'>
				<td width="350" align="left"><div id="statusc" class='status'></div></td>
			</div>
		</div>
		<div class='row'>
			<div class='col-xs-3 col-md-3'>
			</div>
			<div class='col-xs-2 col-md-2'>
				<span class='labelform'>Titular</span>
			</div>
			<div class='col-xs-3 col-md-3'>
				<input type="text" name='namecard' id='namecard' onchange='msgnamecard()' placeholder='Ej: Jose Perez' onblur='validate(this)' autocomplete='off' required>
			</div>
			<div class='col-xs-4 col-md-4'>
				<td width="350" align="left"><div id="statusn" class='status'></div></td>
			</div>
		</div>
		<div class='row'>
			<div class='col-xs-3 col-md-3'>
			</div>
			<div class='col-xs-2 col-md-2'>
				<span class='labelform'>Vencimiento</span>
			</div>
			<div class='col-xs-3 col-md-3'>
				<select id='mes' class="form-control custom" name="mes" required>
					<option selected="true" value="01">01</option>
					<option value="02">02</option>
					<option value="03">03</option>
					<option value="04">04</option>
					<option value="05">05</option>
					<option value="06">06</option>
					<option value="07">07</option>
					<option value="08">08</option>
					<option value="09">09</option>
					<option value="10">10</option>
					<option value="11">11</option>
					<option value="12">12</option>
				</select>
				<select id='año' class="form-control custom" name="año" required>
					<option selected="true" value="2016">2016</option>
					<option value="2017">2017</option>
					<option value="2018">2018</option>
					<option value="2019">2019</option>
					<option value="2020">2020</option>
					<option value="2021">2021</option>
					<option value="2022">2022</option>
					<option value="2023">2023</option>
					<option value="2024">2024</option>
				</select>
			</div>
			<div class='col-xs-4 col-md-4'>
			</div>
		</div>
		<div class='row'>
			<div class='col-xs-3 col-md-3'>
			</div>
			<div class='col-xs-2 col-md-2'>
				<a href="pagPrinc.php"><button id="cancelar" class="btn">Volver</button></a>
			</div>
			<div class='col-xs-2 col-md-2'>
				<button type='submit' class="btn"> Enviar </button>
			</div>
			<div class='col-xs-2 col-md-2'>
				<button class="btn" type="reset" onClick="window.location.reload()">Limpiar</button>
			</div>
			<div class='col-xs-3 col-md-3'>
			</div>
		</div>
	</form>
</body>
</html>