<?php
	class cabecera {
		protected $user;
		public function __construct($us){
			$this->user = $us;
		}
		public function buildHeader(){

			echo "	<script type=\"text/javascript\" >
						$(document).ready(function()
						{
							$(\"#notificationLink\").click(function()
							{
							$(\"#notificationContainer\").fadeToggle(300);
							$(\"#notification_count\").fadeOut(\"slow\");
							return false;
							});
							$(document).click(function()
							{
							$(\"#notificationContainer\").hide();
							});

							//Popup on click
							$(\"#notificationContainer\").click(function()
							{
							return false;
							});

							});
							</script>
					<nav class='navbar navbar-default navbar-fixed-top'>
						<div class=\"header\">
							<div class='row'>
								<div id=\"logo\" class='col-xs-3 col-md-3'>
									<a href=\"pagPrinc.php\"><img src=logo.png width=200></a>
								</div>";
			switch ($_SESSION['type']){
				case ("admin"):
					echo "	<div id=\"vertcentered2\" class='col-xs-3 col-md-3' style='text-align:right'>
									<span>Bienvenido ", $_SESSION['usuario'], "</span>
								</div>
							<div id=\"opcionesuser\" class='col-xs-5 col-md-5' style='float:right'>		
								<div id=\"notification_li\" style=\"float:left\">
								<span id=\"notification_count\"></span>
								<a href=# id=\"notificationLink\"><button class='btn22' type='button' onclick=\"getNotificaciones(".$_SESSION['id'].");\"> Notificaciones</button></a>
								<div id=\"notificationContainer\">
								<div id=\"notificationTitle\">Notificaciones</div>
								<div id=\"notificationsBody\" class=\"notifications\"></div>
								</div>
								</div>
								<form method='POST' action='verPerfil.php' class='headerform'>
										<input class='hidden' name='id' value=".$_SESSION['id'].">
										<button class='btn22' type='submit'>Mi<br>cuenta</button>
								</form>
								<a href=\"panelAdmin.php\"><button type=button class='btn22'>Panel de<br>administrador</button></a>
								<a href=\"cerrarSesion.php\"><button type=button class='btn22'>Cerrar<br>Sesión</button></a>
							</div>
					";
					break;
				case ("premium"):
					echo "	<div id=\"vertcentered2\" class='col-xs-5 col-md-5'>
									<span>Bienvenido ", $_SESSION['usuario'], "</span>
								</div>
							<div id=\"opcionesuser\" class='col-xs-4 col-md-4' style=\"float:right\">
								<div id=\"notification_li\" style=\"float:left\">
								<span id=\"notification_count\"></span>
								<a href=# id=\"notificationLink\"><button class='btn22' type='button' onclick=\"getNotificaciones(".$_SESSION['id'].");\"> Notificaciones</button></a>
								<div id=\"notificationContainer\">
								<div id=\"notificationTitle\">Notificaciones</div>
								<div id=\"notificationsBody\" class=\"notifications\"></div>
								</div>
								</div>
								<form method='POST' action='verPerfil.php' class='headerform'>
									<input class='hidden' name='id' value=".$_SESSION['id'].">
									<button class='btn22' type='submit'>Mi cuenta</button>
								</form>
								
								<a href='cerrarSesion.php'><button type='button' class='btn22'>Cerrar Sesión</button></a>
							</div>
					";
					break;
				case ("common"):
					echo "	<div id=\"vertcentered2\" class='col-xs-4 col-md-4' style='text-align:right'>
									<span>Bienvenido ", $_SESSION['usuario'], "</span>
								</div>
							<div id=\"opcionesuser\" class='col-xs-4 col-md-4' style='float:right'>		
								<div id=\"notification_li\" style=\"float:left\">
								<span id=\"notification_count\"></span>
								<a href=# id=\"notificationLink\"><button class='btn22' type='button' onclick=\"getNotificaciones(".$_SESSION['id'].");\"> Notificaciones</button></a>
								<div id=\"notificationContainer\">
								<div id=\"notificationTitle\">Notificaciones</div>
								<div id=\"notificationsBody\" class=\"notifications\"></div>
								</div>
								</div>
								<form method='POST' action='verPerfil.php' class='headerform'>
									<input class='hidden' name='id' value=".$_SESSION['id'].">
									<button class='btn22' type='submit'>Mi<br> cuenta</button>
								</form>
								<a href='infoPremium.php'><button type='button' class='btn22'>Comprar<br> premium</button></a>
								<a href='cerrarSesion.php'><button type='button' class='btn22'>Cerrar<br> Sesión</button></a>
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