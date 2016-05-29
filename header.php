<?php
	class cabecera {
		protected $user;

		public function __construct($us){
			$this->user = $us;
		}

		public function buildHeader(){
			if ($_SESSION['type']=="admin"){
				echo "<div class=\"header\">
						<div class='row'>
							<div id=\"logo\" class='col-xs-4 col-md-4'>
								<a href=\"pagPrinc.php\"><img src=logo.png width=200></a>
							</div>
							<div id=\"vertcentered\" class='col-xs-4 col-md-4'>
								<span>Bienvenido ", $_SESSION['usuario'], "</span>
							</div>
							<div id=\"opcionesuser\" class='col-xs-4 col-md-4'>
								<a href=\"panelAdmin.php\"><button type=button class='btn2'>Panel de administrador</button></a>
								<a href=\"cerrarSesion.php\"><button type=button class='btn2'>Cerrar Sesión</button></a>
							</div>
						</div>
					</div>";
			}else{
				echo "<div class=\"header\">
						<div class='row'>
							<div id=\"logo\" class='col-xs-4 col-md-4'>
								<a href=\"pagPrinc.php\"><img src=logo.png width=200></a>
							</div>
							<div id=\"infosesion\" class='col-xs-4 col-md-4'>
								<span>Bienvenido ", $_SESSION['usuario'], "</span>
							</div>
							<div id=\"opcionesuser\" class='col-xs-4 col-md-4'>
								<a href=\"cerrarSesion.php\"><button type=\"button\" class=\"btn\">Cerrar Sesión</button></a>
							</div>
						</div>";
			}
		}

	}
	
?>