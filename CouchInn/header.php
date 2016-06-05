<?php
	class cabecera {
		protected $user;

		public function __construct($us){
			$this->user = $us;
		}

		public function buildHeader(){

			echo "<div class=\"wrapper\"><div><div id=\"logo\"><a href=\"pagPrinc.php\"><img src=logo.png width=500></a></div><div id=\"infosesion\">
		<span>Bienvenido ", $_SESSION['usuario'], "</span><a href=\"cerrarSesion.php\"><button type=\"button\" class=\"btn\">Cerrar Sesión</button></a></div></div>";
			
		}

	}
	
?>