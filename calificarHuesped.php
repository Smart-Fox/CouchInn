<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Calificando huésped</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel='stylesheet' href='theme/rateit.css'/>
	<link rel='stylesheet' href='style.css'/>
	<script src="js/jquery.min.js"></script>
	<script src="theme/jquery.rateit.min.js"></script>
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
	<script type="text/javascript">
		window.onload = function () {
			document.getElementById("puntaje").style.display='block';
			document.getElementById("puntaje").style.visibility='hidden';
			document.getElementById("puntaje").style.width='1px';
			document.getElementById("puntaje").style.height='1px';
			document.getElementById("puntaje").style.marginTop='-15px';
		}
	</script>
</head>
<body>
	<?php
		include('anuncioService.php');
		include('header.php');
		session_start();
			if(isset($_SESSION['usuario'])){
			if(isset($_POST['anun'])){
				$id=$_POST['user'];
				$service = new cabecera($_SESSION['usuario']);
				$service->buildHeader();
				$serv = new aService();
				$user = $serv->levantarUsuario($id);	
				$rowUs = $user->fetch_assoc();
				
			}else{
				header('Location:pagPrinc.php');
			}
		}else{
			header('Location:index.html');
		}
	?>
	<center>
		<div class="anunciodet" style="display:inline-block">
			<h1 style="margin:0">Calificar huésped</h1>
			<form action="calificar.php" method="POST" >
				<div class='row'>
					<div>
						<span class='labelform2'>Comentario:</span>
						<textarea style="height:100px" type="text" name='desc' id='desc' placeholder='Cualquier información que considere relevante' required></textarea>
					</div>
					<div>
						<span class='labelform2' id='error'>Puntaje:</span><br>
						<div class="rateit" data-rateit-backingfld="#puntaje" data-rateit-step='1' data-rateit-resetable="false" data-rateit-ispreset="false"></div>
						<input type="rating" name='puntaje' id="puntaje" required>
					</div>
					<input class=hidden name='tipo' value='huesped'></input>
					<input class=hidden name='reserva' value=<?php echo "'".$_POST['solic']."'"?>></input>
				</div>
				<button type="submit" class="btn">Enviar</button>
			</form>
		</div>


		
		
			<?php
			$nombre = $rowUs['Nombre'];
			$apellido = $rowUs['Apellido'];
			$email = $rowUs['Email'];
			$telefono = $rowUs['Telefono'];
			echo "	<div class='row anunciodet'>
						<div class='col-xs-2 col-md-2'>
						</div>
						<div class='col-xs-8 col-md-8  '>
							<div class='row'>
								<div class='col-xs-4 col-md-4'>
								</div>
								<div class='col-xs-8 col-md-8'>
									<h2><strong>Perfil del huésped <br></strong></h2>
									<h3>
										Nombre: <strong><span class='titulo2'>".$nombre."</span></strong> <strong><span class='titulo2'>".$apellido."</span></strong> <br>
										Teléfono:	<strong><span class='titulo2'>".$telefono."</span></strong> <br>
										Email: 	<strong><span class='titulo2'>".$email."</span></strong> <br>
									</h3>
								</div>
							</div>
						</div>
						<div class='col-xs-2 col-md-2'>
						</div>
					</div>";
			
			?>
		</center>
	

</body>


</html>