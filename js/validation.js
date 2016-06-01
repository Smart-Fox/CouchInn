
//alert("Llamado al JS exitoso");
/*
function validacion(){
	var user = document.getElementById('usuario').value;
	var pass = document.getElementById('password').value;
	var nombre = document.getElementById('nombre').value;
	var apellido = document.getElementById('apellido').value;
	var telefono = document.getElementById('telefono').value;
	var userName = document.getElementById('userName').value;

	if(user == ""){
		alert("Por favor ingrese el usuario");
		return false;
	}

	if(pass == ""){
		alert("Por favor ingrese la contraseña");
		return false;
	}

	if(nombre == ""){
		alert("Por favor ingrese su nombre");
		return false;
	}

	if(apellido == ""){
		alert("Por favor ingrese su apellido");
		return false;
	}

	if(telefono == ""){
		alert("Por favor ingrese un teléfono");
		return false;
	}

	if(userName == ""){
		alert("Por favor ingrese un nombre de usuario");
		return false;
	}

	if (telefono isNan(valor)) {
		return false;
	};
} */

$(document).ready(function go(){  
  
function addAlert(message) {
    $('#alerts').append('<div class="alert alert-warning alert-dismissible' + 
    	'role="alert"> <button type="button" class="close" data-dismiss="alert"'+ 
    	'aria-label="Close"><span aria-hidden="true">&times;</span></button>'+message+'</div>');
}

function onError() {
    addAlert('Lost connection to server.');
}
var emailreg = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;
    $("#btn-recuperar").click(function(){
    	if( $("#email").val() == "" ||  !emailreg.test($("#email").val())){
			addAlert("Ingrese un email valido.");
			return false;
		} 
    	if(isNaN($('#telefono').val()) || $("#telefono").val()== ""){ 
			addAlert("Ingrese un teléfono válido");
			return false; };
    	
				
	});

});

