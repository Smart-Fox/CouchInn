<?php
	class cabecera {
		protected $user;
		public function __construct($us){
			$this->user = $us;
		}
		public function buildHeader(){
			echo "	
					<script type=\"text/javascript\" >
						$(document).ready(function()
						{
							$(\"#notificationLink\").click(function(){
								$(\"#notificationContainer\").fadeToggle(300);
								$(\"#notification_count\").fadeOut(\"slow\");
								return false;
							});
							$(document).click(function(){
								$(\"#notificationContainer\").hide();
							});
							$(\"#notificationContainer\").click(function(){
								return false;
							});
						});
					</script>
					<nav class='navbar navbar-default navbar-fixed-top'>
						<div class='header'>
							<div class='row'>
								<div id='logo' class='col-xs-4 col-md-4'>
									<a href=\"pagPrinc.php\"><img src=logo.png width=200></a>
								</div>
								<div id='vertcentered2' class='col-xs-4 col-md-4'>
									<span>Bienvenido ", $_SESSION['usuario'], "</span>
								</div>
								<div id='opcionesuser' class='col-xs-4 col-md-4'>
									<div id='notification_li'>
										<span id='notification_count'>5</span>
										<a href=# id='notificationLink'>
											<button class='btn22' type='button' id='notifbtn' onclick='getNotificaciones(".$_SESSION['id'].");'>
												<img src='theme/images/notif.png' width=30>
											</button>
										</a>
										<div id='notificationContainer'>
											<div id='notificationTitle'>Notificaciones</div>
											<div id='notificationsBody' class='notifications'></div>
										</div>
									</div>
									<form method='POST' action='verPerfil.php' class='headerform'>
										<input class='hidden' name='id' value=".$_SESSION['id'].">
										<button class='btn22' type='submit'>Mi<br>cuenta</button>
									</form>
					";
			switch ($_SESSION['type']){
				case ("admin"):
					echo "				
									<a href=\"panelAdmin.php\"><button type=button class='btn22'>Panel de<br>administrador</button></a>
					";
					break;
				case ("common"):
					echo "			
									<a href='infoPremium.php'><button type='button' class='btn22'>Comprar premium</button></a>
					";
					break;
			}
			echo"					<a href='cerrarSesion.php'><button type=button class='btn22'>Cerrar<br>Sesión</button></a>
								</div>
							</div>
						</div>
					</nav>
			";
		}
	}
?>