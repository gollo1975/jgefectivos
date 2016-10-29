 function Eliminar(Url) {
	  
	if(confirm("Seguro que desea eliminar")) {
		 
	 	window.location=Url;
 	}
}

//*****Validacion de Numeros

function solonumeros()	{
	
	if(( event.keyCode >= 97 && event.keyCode <= 122) || (event.keyCode >=65 && event.keyCode <=90))	{
		
		event.keyCode=0;
	}
}

//*****Validacion de Texto

function sololetras(e)	{
		
	tecla = (document.all) ? e.keyCode : e.which; 
    if (tecla==8) return true; 
    patron =/[A-ZÑa-zñ\s]/; 
    te = String.fromCharCode(tecla); 
    return patron.test(te); 
} 

//*****Index

function inicioCategoria() {
	
  form1.descripcion.value="";
  form1.descripcion.focus() 
}

//*****Rol

function inicioRol() {
	
  form1.nombreRol.focus() 
}

function validarRol() {

	var form=document.form1;
	if (form.nombreRol.value==0) 	{
		
		alert("Ingrese el Nombre del Rol");
		form.nombreRol.value="";
		form.nombreRol.focus();
		return false;
	}
	else if (form.nombreRol.value.length < 5) {
		
		alert("Nombre de Rol es Incorrecto");
		form.nombreRol.focus();
		return false;
	}
	else {
		
		return true
	}
}


//*****Jornada

function inicioJornada() {
	
  form1.nombreJornada.focus() 
}

function validarJornada() {

	var form=document.form1;
	if (form.nombreJornada.value==0) 	{
		
		alert("Ingrese el Nombre de la Jornada");
		form.nombreJornada.value="";
		form.nombreJornada.focus();
		return false;
	}
	else if (form.nombreJornada.value.length < 5) {
		
		alert("Nombre de la Jornada es Incorrecto");
		form.nombreJornada.focus();
		return false;
	}
	else {
		
		return true
	}
}

//*****Horario

function inicioHorario () {
	
  form1.nombreHorario.focus() 
}

function validarHorario() {

	var form=document.form1;
	if (form.nombreHorario.value==0) 	{
		
		alert("Ingrese el Nombre del Horario");
		form.nombreHorario.value="";
		form.nombreHorario.focus();
		return false;
	}
	else if (form.nombreHorario.value.length < 5) {
		
		alert("Nombre del Horario es Incorrecto");
		form.nombreHorario.focus();
		return false;
	}
	else if (form.horarioInicial.value==0) 	{
		
		alert("Ingrese el Horario de Inicio de Jarnada");
		form.horarioInicial.value="";
		form.horarioInicial.focus();
		return false;
	}
	else if (form.horarioInicial.value.length < 4) {
		
		alert("Horario Inicial es Incorrecto");
		form.horarioInicial.focus();
		return false;
	}
	else if (form.horarioFinal.value==0) 	{
		
		alert("Ingrese el Horario de Final de Jarnada");
		form.horarioFinal.value="";
		form.horarioFinal.focus();
		return false;
	}
	else if (form.horarioFinal.value.length < 4) {
		
		alert("Horario Final es Incorrecto");
		form.horarioFinal.focus();
		return false;
	}
	else {
		
		return true
	}
}


//*****Ausencia

function inicioAusencia () {
	
  form1.codEmple.focus() 
}

function validarAusencia () {

	var form=document.form1;
	if (form.fechaSolicitud.value==0) 	{
		
		alert("Ingrese fecha Solicitud");
		form.fechaSolicitud.value="";
		form.fechaSolicitud.focus();
		return false;
	}
	else if (form.fechaSolicitud.value.length < 10) {
		
		alert("fecha Solicitud es Incorrecto");
		form.fechaSolicitud.focus();
		return false;
	}
	else if (form.fechaPermiso.value==0) 	{
		
		alert("Ingrese fecha de Permiso");
		form.fechaPermiso.value="";
		form.fechaPermiso.focus();
		return false;
	}
	else if (form.fechaPermiso.value.length < 10) {
		
		alert("fecha Permiso es Incorrecto");
		form.fechaPermiso.focus();
		return false;
	}
	else if (form.totalHoras.value==0) 	{
		
		alert("Ingrese Total de Horas del Permiso");
		form.totalHoras.value="";
		form.totalHoras.focus();
		return false;
	}
	else if (form.Departamento.value==0) 	{
		
		alert("Ingrese Departamento del Empleado solicitante");
		form.Departamento.value="";
		form.Departamentoo.focus();
		return false;
	}
	else if (form.Departamento.value.length < 5) {
		
		alert("Departamento Permiso es Incorrecto");
		form.Departamento.focus();
		return false;
	}
	else {
		
		return true
	}
}


/*function eliminar(url)
{
	if (confirm("Realmente desea eliminar este registro ?"))
	{
		window.location=url;		
	}
}
*/
function cambiar(id,color) {
	
	document.getElementById(id).style.backgroundColor=color;
}
	

//*****Cambio Acceso

function inicioAcceso () {
	
  form1.contrasena.focus() 
}

function validarAcceso () {

	var form=document.form1;
	if (form.contrasena.value==0) 	{
		
		alert("La Contrasena Anterior no es Valida");
		form.contrasena.value="";
		form.contrasena.focus();
		return false;
	}
	else if (form.contrasena.length < 8) {
		
		alert("La contrasena ingresada en Incorrecta");
		form.contrasena.focus();
		return false;
	}
	else if (form.contrasenaNueva.value==0) 	{
		
		alert("La Contrasena Nueva no es Valida");
		form.contrasenaNueva.value="";
		form.contrasenaNueva.focus();
		return false;
	}
	else if (form.contrasenaNueva.length < 8) {
		
		alert("La contrasena Nueva ingresada en Incorrecta");
		form.contrasenaNueva.focus();
		return false;
	}
	else if (form.contrasenaConfirmacion.value==0) 	{
		
		alert("La Contrasena de Confirmacion no es Valida");
		form.contrasenaConfirmacion.value="";
		form.contrasenaConfirmacion.focus();
		return false;
	}
	else if (form.contrasenaNueva.value != form.contrasenaConfirmacion.value)	{
		
		alert("La Contrasena y la Confirmacion son incorrectas");
		form.contrasenaNueva.value="";
		form.contrasenaConfirmacion.value="";
		form.contrasenaNueva.focus();
		return false;
	}
	else {
		
		return true
	}
}