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
					var forma = 'form_'+obj['respuestas'][i].ID_anuncio;
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
					b.setAttribute('form',"form"+i);
					var mensaje = document.createElement("form");
					mensaje.action = "anuncDetalle.php";
					mensaje.method ="POST";
					mensaje.enctype='multipart/form-data'
					mensaje.id = "form"+i;
					var lab = document.createElement("span");
					lab.innerHTML = "Tiene una nueva pregunta";
					mensaje.appendChild(lab);
					mensaje.appendChild(input);
					mensaje.appendChild(b);
					contenedor.appendChild(mensaje);

				}
			}
				if(obj['solicitudes']){
				for (var i = 0; i < obj['solicitudes'].length; i++) {
					var input = document.createElement("input");
					input.className = "hidden";
					input.name = "anunc";
					input.setAttribute('value',obj['solicitudes'][i].ID_anuncio);
					var b = document.createElement("button");
					b.type = "submit";
					b.name = "sumbit";
					b.classList="btn";
					b.innerHTML="Ver";
					b.setAttribute('form',"form"+i);
					var mensaje = document.createElement("form");
					mensaje.action = "solicitudesRec.php";
					mensaje.method ="POST";
					mensaje.enctype='multipart/form-data'
					mensaje.id = "form"+i;
					var lab = document.createElement("span");
					lab.innerHTML = "Tiene una nueva solicitud de reserva";
					mensaje.appendChild(lab);
					mensaje.appendChild(input);
					mensaje.appendChild(b);
					contenedor.appendChild(mensaje);

				}
			}
		}
	});
};