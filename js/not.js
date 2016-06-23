var getNotificaciones = function(id){
	$.ajax({
		url: 'ajax/getNot.php',
		data: {
			'userid': id
		},
		type: 'POST',
		success: function(response){
			var obj = jQuery.parseJSON(response);
			var contenedor = document.getElementById('notificationsBody');
			while (contenedor.firstChild) {
				contenedor.removeChild(contenedor.firstChild);
			}
			if(obj['respuestas']){
				for (var i = 0; i < obj['respuestas'].length; i++) {
					var input = document.createElement("input");
					input.className = "hidden";
					input.name = "anunc";
					input.value = obj['respuestas'][i].ID_anuncio;
					var b = document.createElement("button");
					b.type = 'submit';
					b.classList= "btn";
					b.innerHTML= "Ver";
					var forma = 'form_'+i+'r';
					b.setAttribute('onclick','verAnuncio('+forma+','+obj["respuestas"][i].ID+',"r")');
					var mensaje = document.createElement("form");
					mensaje.action = "anuncDetalle.php";
					mensaje.method ="POST";
					mensaje.id = forma;
					var lab = document.createElement("span");
					lab.innerHTML = "Su pregunta ha sido respondida";
					mensaje.appendChild(lab);
					mensaje.appendChild(input);
					mensaje.appendChild(b);
					contenedor.appendChild(mensaje);

				}
			}
				if(obj['preguntas']){
				for (var i = 0; i < obj['preguntas'].length; i++) {
					var input = document.createElement("input");
					input.className = "hidden";
					input.name = "anunc";
					input.setAttribute('value',obj['preguntas'][i].ID_anuncio);
					var b = document.createElement("button");
					b.type = "submit";
					b.classList="btn";
					b.innerHTML="Ver";
					console.log(obj['preguntas'][i]);
					var forma = 'form_'+i+'p';
					b.setAttribute('onclick','verAnuncio('+forma+','+obj["preguntas"][i].ID+',"p")');
					var mensaje = document.createElement("form");
					mensaje.action = "anuncDetalle.php";
					mensaje.method ="POST";
					mensaje.id = forma;
					var lab = document.createElement("span");
					lab.innerHTML = "Tiene una nueva pregunta";
					mensaje.appendChild(lab);
					mensaje.appendChild(input);
					mensaje.appendChild(b);
					contenedor.appendChild(mensaje);

				}
			}
				if(obj['solicitudes']){
					var lab = document.createElement("span");
					if(obj['solicitudes'].length>1){
						lab.innerHTML = "Tiene nuevas solicitudes de reserva";
					} else { 
						lab.innerHTML = "Tiene una nueva solicitud de reserva";
					 }
					var b = document.createElement("button");
					b.type = "submit";
					b.classList="btn";
					b.innerHTML="Ver";
					b.setAttribute('form',"f1");
					console.log(obj["solicitudes"]);
					b.setAttribute('onclick','verSolicitudes("f1",'+obj["solicitudes"][0].ID_usuario+',"sr")');
					var input = document.createElement("input");
					input.className = "hidden";
					input.name = "tipo";
					input.setAttribute('value','recibidas');
					var mensaje = document.createElement("form");
					mensaje.action = "solicitudes.php";
					mensaje.method ="POST";
					mensaje.id = "f1";
					mensaje.appendChild(input);
					mensaje.appendChild(lab);
					mensaje.appendChild(b);
					contenedor.appendChild(mensaje);

				
			}
		}
	});
};