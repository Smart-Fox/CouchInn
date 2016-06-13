<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Solicitar reserva</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="css/bootstrap.min.css" />
	<link href="theme/jquery-ui.css" rel="stylesheet">
	<link rel='stylesheet' href='style.css'/>
	<script src="js/jquery.min.js"></script>
	<script src="theme/jquery-ui.js"></script>
	<script type="text/javascript" src= "js/objeto.js"></script>
	<script type="text/javascript" src="js/bootstrap-filestyle.min.js"> </script>
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico"/>
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
				dateFormat: 'yy/mm/dd',
				firstDay: 1,
				isRTL: false,
				showMonthAfterYear: false,
				yearSuffix: ''};
			$.datepicker.setDefaults($.datepicker.regional['es']);
			var dateToday=new Date();
			$("#final").datepicker();
			$("#inicial").datepicker({  
			  minDate: dateToday,   
			  onSelect:function(ui, event) { $('#final').datepicker("option","minDate",ui);}  
			  });
		});			
		
		var rangesS=[];
		var rangesE=[];

		$(function cargarFechas() {
			var inicialArray = eval();
			var finalArray = eval();
			for(i=0;i<finalArray.length;i++){
				var from=inicialArray[i].fecha.split("-");
				var from2=finalArray[i].fecha.split("-");
				rangesS[i]= new Date(from[0],from[1]-1,from[2]);
				rangesE[i]= new Date(from2[0],from2[1]-1,from2[2]);
			}
		});

		$(function() { 
			$("#inicial").datepicker({ 
				numberOfMonths: 2,
				beforeShowDay: function(date) {
					var dateToday=new Date();
					dateToday.setDate(dateToday.getDate()-1);
					for(var i=0; i<rangesS.length; i++) {
						if(date<dateToday){
							return [false, ''];
						}else{
							if(date >= rangesS[i] && date <= rangesE[i]){
								return [true, '']; 
							}
						}
					}
					return [false, ''];
				} 
			}); 
		});

		$(function() { 
			$("#final").datepicker({ 
				numberOfMonths: 2,
				beforeShowDay: function(date) {
					var dateToday=new Date();
					dateToday.setDate(dateToday.getDate()-1);
					for(var i=0; i<rangesS.length; i++) {
						if(date<dateToday){
							return [false, ''];
						}else{
							if(date >= rangesS[i] && date <= rangesE[i]){
								return [true, '']; 
							}
						}
					}
					return [false, ''];
				} 
			}); 
		});
	</script>
</head>
<body>	
	<?php
		include('header.php');
		session_start();
		if(isset($_SESSION['usuario'])){
			if(isset($_POST['anunc'])){
				$id=$_POST['anunc'];
				$service = new cabecera($_SESSION['usuario']);
				$service->buildHeader();
			}
		}else{
			header('Location:index.html');
		}
	?>
	<center>
		<h3>
			Complete todos los datos de su reserva y luego presione "Solicitar"
		</h3>
		<form action="solicitarReserva.php" method="POST" enctype="multipart/form-data">
			<div class='row'>
				<div class='col-xs-2 col-md-2'>
				</div>
				<div class='col-xs-5 col-md-5'>
					<span class='labelform2'>Comentario:</span><br>
					<textarea type="text" name='desc' id='desc' placeholder='Cualquier información que considere relevante' required></textarea>
				</div>
				<div class='col-xs-3 col-md-3'>
					<div class='row'>
						<span class='labelform2'>Cantidad de personas:</span>
						<input type="number" name = 'cantidad' id='cantidad' min="1" placeholder="Ej: 3" required>
					</div>
					<div class='row'>
						<span class='labelform2'>Fecha inicio:</span>
						<input type="text"  class="form-control" placeholder="Fecha Inicial" name="inicial" id="inicial">
					</div>
					<div class='row'>
						<span class='labelform2'>Fecha fin:</span>
						<input type="text" class="form-control" placeholder="Fecha Final" name="final" id="final">
					</div>
				</div>
				<div class='col-xs-2 col-md-2'>
				</div>
			</div>
			<div class='row'>
				<div class='col-xs-4 col-md-4'>	
				</div>
				<div class='col-xs-4 col-md-4'>	
					<a href='pagPrinc.php'><button id="cancelar" type=button class='btn btn-danger'>Cancelar</button></a>
					<button type="submit" class="btn">Reservar</button>
				</div>
				<div class='col-xs-4 col-md-4'>
				</div>
			</div>
		</form>
	</center>
</body>
</html>