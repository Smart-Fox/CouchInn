<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	
	<?php

					$preg1 = $serv->levantarPreguntasAnuncio($row['ID_anuncio']); 


							//var_dump($preg1->fetch_assoc());
							echo "<br> <br>";
							while($rowPreg = $preg1->fetch_assoc()){

							echo "	<div class='row'>
										<div class='col-xs-2 col-md-2'>

										</div>

										<div class='col-xs-8 col-md-8 anuncio'>
											Usuario: ".$rowPreg['Username']."
											<br>
											<strong><span class='titulo2'>".$rowPreg['texto']."</span></strong>

										<div class='col-xs-2 col-md-2'> 
										</div>
									</div>";

							
							if ($_SESSION['id']==$row['usuario_ID']){

								echo " <form action='anuncDetalle.php' method='POST' enctype='multipart/form-data'>
									</div>
									<div class='row'>
										<div class='col-xs-2 col-md-2'>
										</div>
											<div class='col-xs-7 col-md-7'>
												<textarea class='form-control custom'  type='text' name='respuesta' id='respuesta' placeholder='Escribe tu respuesta' required style='width: 650px; height: 50px;'></textarea> 
												
												<input class='hidden' name='anunc' value= ".$id.">
												
											</div>
										<div class='col-xs-3 col-md-3'>
											
											<button type='submit' class='btn22'>Responder</button>
									
										</div>

										
									</div>
									
									</form>
									<hr>";





							}

						}
					

					if ($_SESSION['id']!=$row['usuario_ID']) { //si el usuario de la sesión es != al del anuncio
						echo 	"<hr>";
						echo   "<div class='row'>
								<div class='col-xs-2 col-md-2'>
									
								</div>
								<div class='col-xs-8 col-md-8'>
									<form id='preg' action='preguntar.php' method='POST'>
										
										<h2>Preguntas al usuario</h2>
										<br>
										<textarea class='form-control custom'  type='text' name='pregunta' id='pregunta' placeholder='Escribe tu pregunta' required style='width: 500px; height: 100px;'></textarea>
										<input class='hidden' name='anunc' value= ".$id.">
										<button type='submit' class='btn22' >Preguntar</button>
										
									</form>
									<br>
								</div>
			
								<div class='col-xs-2 col-md-2'>
									
								</div>

							</div>";
							
							

							$preg1 = $serv->levantarPreguntasAnuncio($row['ID_anuncio']); 


							//var_dump($preg1->fetch_assoc());
							echo "<br> <br>";
							while($rowPreg = $preg1->fetch_assoc()){

							echo "	<div class='row'>
										<div class='col-xs-2 col-md-2'>

										</div>

										<div class='col-xs-8 col-md-8 anuncio'>
											Usuario: ".$rowPreg['Username']."
											<br>
											<strong><span class='titulo2'>".$rowPreg['texto']."</span></strong>

										<div class='col-xs-2 col-md-2'> 
										</div>
									</div>";

							}


						
					}else{  //el usuario de la sesion es el mismo que el del anuncio
							
							echo "<hr>";
							$serv1 = new aService();
							
							echo "<br> <br>";
							echo "<h2>Consultas sobre el anuncio</h2>";


							$preg = $serv1->levantarPreguntasAnuncio($row['ID_anuncio']);
							while($rowPreg = $preg->fetch_assoc()){

							echo " 
									<div class='row'>
										<div class='col-xs-2 col-md-2'>
										</div>
										<div class='col-xs-8 col-md-8 anuncio'>
											Usuario: ".$rowPreg['Username']."
											<br>
											<strong><span class='titulo2'>".$rowPreg['texto']."</span></strong> 
										<div class='col-xs-2 col-md-2'> 
										</div>";

								


								echo " <form action='anuncDetalle.php' method='POST' enctype='multipart/form-data'>
									</div>
									<div class='row'>
										<div class='col-xs-2 col-md-2'>
										</div>
											<div class='col-xs-7 col-md-7'>
												<textarea class='form-control custom'  type='text' name='respuesta' id='respuesta' placeholder='Escribe tu respuesta' required style='width: 650px; height: 50px;'></textarea> 
												
												<input class='hidden' name='anunc' value= ".$id.">
												
											</div>
										<div class='col-xs-3 col-md-3'>
											
											<button type='submit' class='btn22'>Responder</button>
									
										</div>

										
									</div>
									
									</form>
									<hr>";
								
									
							}

						

					}
			
				?>




</body>
</html>