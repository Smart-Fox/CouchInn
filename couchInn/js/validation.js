
//alert("Llamado al JS exitoso");

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
}