<?php
	class cabecera {
		protected $user;
		public function __construct($us){
			$this->user = $us;
		}
		public function buildHeader(){
			echo "	
					<nav class='navbar navbar-default navbar-fixed-top'>
						<div class=\"header\">
							<div class='row'>
								<div id=\"logo\" class='col-xs-4 col-md-4'>
									<a href=\"pagPrinc.php\"><img src=logo.png width=200></a>
								</div>
								<div id=\"vertcentered2\" class='col-xs-4 col-md-4'>
									<span>Bienvenido ", $_SESSION['usuario'], "</span>
								</div>";
			switch ($_SESSION['type']){
				case ("admin"):
					echo "
							<div id=\"opcionesuser\" class='col-xs-4 col-md-4'>
								<a href='miCuenta.php'><button class='btn22' type='button'>Mi<br>cuenta</button></a>
								<a href=\"panelAdmin.php\"><button type=button class='btn22'>Panel de<br>administrador</button></a>
								<a href=\"cerrarSesion.php\"><button type=button class='btn22'>Cerrar<br>Sesión</button></a>
							</div>
					";
					break;
				case ("premium"):
					echo "	
							<div id=\"opcionesuser\" class='col-xs-4 col-md-4'>
								<a href='miCuenta.php'><button class='btn2' type='button'>Mi cuenta</button></a>
								<a href=\"cerrarSesion.php\"><button type=\"button\" class=\"btn2\">Cerrar Sesión</button></a>
							</div>
					";
					break;
				case ("common"):
					echo "	
							<div id=\"opcionesuser\" class='col-xs-4 col-md-4'>
								<a href='miCuenta.php'><button class='btn22' type='button'>Mi cuenta</button></a>
								<a href='infoPremium.php'><button type='button' class='btn22'>Comprar premium</button></a>
								<a href='cerrarSesion.php'><button type='button' class='btn22'>Cerrar Sesión</button></a>
							</div>
					";
					break;
			}
			echo"		
					</div>
				</div>
			</nav>";
			
		}

	}
	
?>