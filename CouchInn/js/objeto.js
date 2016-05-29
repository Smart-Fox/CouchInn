var cambiarCiudad = function(){
	var id = document.getElementById('provSelect').value;
	$.ajax({
		url: 'ajax/levantarCiudad.php',
		data: { 
			'idprov': id
		},
		type: 'POST',
		success: function(response){
			var obj = jQuery.parseJSON(response);
			console.log(obj);
			var sel = document.getElementById('ciudadSelect');
			while (sel.length>1){
				sel.remove(1);
			}
			for (var i = obj.length - 1; i >= 0; i--) {
				var option = document.createElement("option");
				option.value=obj[i]["ID"];
				option.text= obj[i]["nombre"];
				sel.add(option,sel.length);
			}
			

		}
	});
};