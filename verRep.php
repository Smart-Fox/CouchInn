
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Panel de administrador</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="css/bootstrap.min.css" />
	<link href="theme/jquery-ui.css" rel="stylesheet">
	<link rel='stylesheet' href='style.css'/>
	<script src="js/jquery.min.js"></script>
	<script src="theme/jquery-ui.js"></script>
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico"/>
</head>
<body>
	<?php
		include('header.php');
		include('adminOptions.php');
		session_start();
		if((isset($_SESSION['usuario']))&&($_SESSION['type']=="admin")){
			$service = new cabecera($_SESSION['usuario']);
			$service->buildHeader();
			$display=new adminMenu();
		}else{
			header('Location:index.html');
		}
	?>
	<script>
		jQuery(function($){
			$.datepicker.regional['es'] = {
				closeText: 'Cerrar',
				prevText: '&#x3c;Ant',
				nextText: 'Sig&#x3e;',
				currentText: 'Hoy',
				monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
				'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
				monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun',
				'Jul','Ago','Sep','Oct','Nov','Dic'],
				dayNames: ['Domingo','Lunes','Martes','Mi&eacute;rcoles','Jueves','Viernes','S&aacute;bado'],
				dayNamesShort: ['Dom','Lun','Mar','Mi&eacute;','Juv','Vie','S&aacute;b'],
				dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','S&aacute;'],
				weekHeader: 'Sm',
				dateFormat: 'dd/mm/yy',
				firstDay: 1,
				isRTL: false,
				showMonthAfterYear: false,
				yearSuffix: ''};
			$.datepicker.setDefaults($.datepicker.regional['es']);
		});

		$(function() { 
			$("#inicial1").datepicker({ 
				numberOfMonths: 1,
				beforeShowDay: function(date) {
					return [true, ''];
				},
				onSelect:function(date) { 
					$('#final1').datepicker("refresh");
					$('#final1').val("");
				}
			}); 
		});
		
		$(function() { 
			$("#final1").datepicker({ 
				numberOfMonths: 1,
				beforeShowDay: function(date) {
					var currentDate = $( "#inicial1" ).datepicker( "getDate" );
					currentDate.setDate(currentDate.getDate());
					if(date<currentDate){
						return [false, ''];
					}
					return [true, ''];
				} 
			}); 
		});
		
		$(function() { 
			$("#inicial2").datepicker({ 
				numberOfMonths: 1,
				beforeShowDay: function(date) {
					return [true, ''];
				},
				onSelect:function(date) { 
					$('#final2').datepicker("refresh");
					$('#final2').val("");
				}
			}); 
		});
		
		$(function() { 
			$("#final2").datepicker({ 
				numberOfMonths: 1,
				beforeShowDay: function(date) {
					var currentDate = $( "#inicial2" ).datepicker( "getDate" );
					currentDate.setDate(currentDate.getDate());
					if(date<currentDate){
						return [false, ''];
					}
					return [true, ''];
				} 
			}); 
		});
	</script>
	<form action='reportePago.php' method='POST'>
		<div class='row' id='modTH'>
			<div id='vertcentered' class='col-xs-3 col-md-3'>
				Reporte de pagos recibidos
			</div>
			<div class='col-xs-3 col-md-3'>
				<div class='row'>
					<input type="text"  class="form-control" placeholder="Inicio" name="inicial1" id="inicial1" autocomplete='off' required>
				</div>
			</div>
			<div class='col-xs-3 col-md-3'>
				<div class='row'>
					<input type="text"  class="form-control" placeholder="Fin" name="final1" id="final1" autocomplete='off' required>
				</div>
			</div>
			<div class='col-xs-3 col-md-3' id='leftaligned'>
				<button type='submit' class='btn3'>Aceptar</button>
			</div>
		</div>
	</form>
	<form action='reporteReservas.php' method='POST'>
		<div class='row' id='modTH'>
			<div id='vertcentered' class='col-xs-3 col-md-3'>
				Reporte de solicitudes de reservas
			</div>
			<div class='col-xs-3 col-md-3'>
				<div class='row'>
					<input type="text"  class="form-control" placeholder="Inicio" name="inicial2" id="inicial2" autocomplete='off' required>
				</div>
			</div>
			<div class='col-xs-3 col-md-3'>
				<div class='row'>
					<input type="text"  class="form-control" placeholder="Fin" name="final2" id="final2" autocomplete='off' required>
				</div>
			</div>
			<div class='col-xs-3 col-md-3' id='leftaligned'>
				<button type='submit' class='btn3'>Aceptar</button>
			</div>
		</div>
	</form>
</body>
</html>