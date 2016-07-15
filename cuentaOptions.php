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
									<a href='preguntas.php'><button type=button class='btn2'>Mis preguntas</button></a>
								</div>
							</div>
							<div class='col-xs-2 col-md-2'>
								<div class='centered'>
									<form method='POST' action='solicitudes.php'>
										<input class='hidden' name='tipo' value='norm'>
										<button type=submit class='btn2'>Mis solicitudes</button>
									</form>
								</div>
							</div>
							<div class='col-xs-2 col-md-2'>
								<div class='centered'>
									<form method='POST' action='misreservas.php'>
										<input class='hidden' name='tipo' value='norm'>
										<button type=submit class='btn2'>Mis reservas</button>
									</form>
								</div>
							</div>
							<div class='col-xs-2 col-md-2'>
								<div class='centered'>
									<form method='POST' action='calificaciones.php'>
										<input class='hidden' name='tipo' value='norm'>
										<button type=submit class='btn2'>Mis calificaciones</button>
									</form>
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