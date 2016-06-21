<?php

$preg1 = $serv->levantarPreguntasAnuncio($row['ID_anuncio']); 
					echo "<br> <br>";
					while($rowPreg = $preg1->fetch_assoc()){   //se publican las preguntas. Faltaria un if pa q no haga todo al dope
						echo "<hr>";
						echo " 
							<div class='row'>
								<div class='col-xs-2 col-md-2'>
									<span style='color:blue'><i>Pregunta</i></span>
								</div>
								<div class='col-xs-8 col-md-8 '>
									Usuario: ".$rowPreg['Username']."
									<br>
									<strong><span class='titulo2'>".$rowPreg['texto']."</span></strong> 
								</div>
								<div class='col-xs-2 col-md-2'> 
								</div>
							</div>
						";
						$resp = $serv->levantarRespuestaAnuncio($rowPreg['pregunta_ID']);


					if($resp->num_rows>0){  //si existe una respuesta para la pregunta, se publica
						$rowResp = $resp->fetch_assoc();
							echo " 
								<div class='row'>
									<div class='col-xs-2 col-md-2'>
										<span style='color:red'><i>Respuesta</i></span>
									</div>
									<div class='col-xs-8 col-md-8 '>
										Usuario: ".$rowResp['Username']."
										<br>
										<strong><span class='titulo2'>".$rowResp['respuesta_texto']."</span></strong> 
									</div>
									<div class='col-xs-2 col-md-2'> 
									</div>
								</div>
							";

					}else{
						if ($_SESSION['id']==$row['usuario_ID']){
							echo " 
									<form action='responder.php' method='POST' enctype='multipart/form-data'>
										<div class='row'>
											<div class='col-xs-2 col-md-2'>
											</div>
											<div class='col-xs-7 col-md-7'>
												<textarea class='form-control custom'  type='text' name='respuesta' id='respuesta' placeholder='Escribe tu respuesta' required style='width: 650px; height: 50px;'></textarea> 												
												<input class='hidden' name='anunc' value= ".$id."> 
												<input class='hidden' name='idpreg' value= ".$rowPreg['pregunta_ID'].">														
											</div>
											<div class='col-xs-3 col-md-3'>											
												<button type='submit' class='btn22'>Responder</button>
											</div>
										</div>
									</form>
								";
						}
					}




			} //end del While de las preguntas

			if ($_SESSION['id']!=$row['usuario_ID']){
				echo 	"<hr>";
					echo"	<div class='row'>
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
							</div>
					";
			}



?>