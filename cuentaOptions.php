<?php
	class cuentaMenu {
		
		public function __construct(){
			echo "
					<div class='menu'>
						<div class='row'>
							<div class='col-xs-2 col-md-2'>
								<div class='centered'>
									<form method='POST' action='verPerfil.php'>
										<input class='hidden' name='id' value=".$_SESSION['id'].">
										<button class='btn2' type='submit'>Mi perfil</button>
									</form>
								</div>
							</div>
							<div class='col-xs-2 col-md-2'>
								<div class='centered'>
									<a href='preguntasEnv.php'><button type=button class='btn2'>Mis preguntas enviadas</button></a>
								</div>
							</div>
							<div class='col-xs-2 col-md-2'>
								<div class='centered'>
									<a href='preguntasRec.php'><button type=button class='btn2'>Mis preguntas recibidas</button></a>
								</div>
							</div>
							<div class='col-xs-2 col-md-2'>
								<div class='centered'>
									<a href='solicitudesEnv.php'><button type=button class='btn2'>Mis solicitudes enviadas</button></a>
								</div>
							</div>
							<div class='col-xs-2 col-md-2'>
								<div class='centered'>
									<a href='solicitudesRec.php'><button type=button class='btn2'>Mis solicitudes recibidas</button></a>
								</div>
							</div>
							<div class='col-xs-2 col-md-2'>
								<div class='centered'>
									<a href='pagPrinc.php'><button type=button class='btn2'>Salir</button></a>
								</div>
							</div>
						</div>
					</div>
			";
		}
	}
	
?>