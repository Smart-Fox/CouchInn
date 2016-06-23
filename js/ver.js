var verAnuncio = function(formId,vistoId,tipo){	
	$.ajax({
		url: 'ajax/marcarVisto.php',
		data: { 
			'vId': vistoId,
			'tipo':tipo
		},
		type: 'POST',
		success: function(response){
			console.log(formId);
			formId.submit();
		}

	});
};