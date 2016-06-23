var verSolicitudes = function(formId,vistoId,tipo){	
	$.ajax({
		url: 'ajax/marcarVisto.php',
		data: { 
			'vId': vistoId,
			'tipo':tipo
		},
		type: 'POST',
		success: function(response){
			var f = document.getElementById(formId);
			f.submit();
		}

	});
};