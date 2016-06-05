<?php
	class adminMenu {
		
		public function __construct(){
			echo "
					<div class='menu'>
						<br>
						<br>
						<div class='row'>
							<form method='POST'>
								<div class='col-xs-2 col-md-2'>
									<div class='centered'>
										<a href='admTH.php'><button type=button class='btn2'>Administrar tipos de hospedaje</button></a>
									</div>
								</div>
								<div class='col-xs-2 col-md-2'>
									<div class='centered'>
										<a href='verRep.php'><button type=button class='btn2'>Ver reportes</button></a>
									</div>
								</div>
								<div class='col-xs-2 col-md-2'>
									<div class='centered'>	
										<a href='admUs.php'><button type=button class='btn2'>Administrar usuarios</button></a>
									</div>
								</div>
								<div class='col-xs-2 col-md-2'>
									<div class='centered'>
										<a href='admPub.php'><button type=button class='btn2'>Administrar publicaciones</button></a>
									</div>
								</div>
								<div class='col-xs-2 col-md-2'>
									<div class='centered'>
										<a href='cambPrec.php'><button type=button class='btn2'>Cambiar precio premium</button></a>
									</div>
								</div>
							</form>
						</div>
					</div>
				";
		}
	}
	
?>