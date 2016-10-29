function foco () {
	
  form1.identificacion.focus () 
}

function validarIdentificacion () {

	var form = document.form1;
	if (form.identificacion.value == 0) 	{
		
		alert ("Ingrese el numero de Identificacion");
		form.identificacion.value = "";
		form.identificacion.focus ();
		
		return false;
		
	}
	else if (form.identificacion.value.length < 6) {
		
		alert ("Identificacion Incorrecto");
		form.identificacion.focus ();
		
		return false;
		
	}
	else {
		
		return true
		
	}
}

function solonumeros ()	{
	
	if(( event.keyCode >= 97 && event.keyCode <= 122) || (event.keyCode >=65 && event.keyCode <=90))	{
		
		event.keyCode=0;
	}
}