<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Control de Ingresos :: JGEfectivo</title>
<link rel="stylesheet" type="text/css" href="formatos/estilos.css" />
<script type="text/javascript" src="validar/validar.js"></script>
</head>
<body>
<div id="header">  </div>
<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
<form id="form1" name="form1" method="post" action="control/procesos.php?opc=92">
  <table width="300" border="0" align="center">
    <tr>
      <th colspan="2">Control de Ingreso y Salida </th>
    </tr>
    <tr>
      <td width="296">&nbsp;</td>
      <td width="294">&nbsp;</td>
    </tr>
    <tr>
      <td>Fecha</td>
      <td>Hora</td>
    </tr>
    <tr>
      <td><input name="fecha" type="text" id="fecha" size="20" maxlength="10" readonly /></td>
      <td><input name="hora" type="text" id="hora" size="20" maxlength="10" readonly /> </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Documento</td>
      <td><input name="cedula" type="text" id="cedula" size="20" maxlength="10"  onkeypress="solonumeros()"/></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <th colspan="2"><input type="submit" name="button" id="button" value="Aceptar" /></th>
    </tr>
  </table>
</form>
<div id="footer"> JG Efectivos S.A.S<p />
Empresa de Servicios Temparales <p />
Medellín - Colombia
</div>
<script type="text/javascript">

	function show()	{
		
 		var Digital=new Date()
 		var hours=Digital.getHours()
 		var minutes=Digital.getMinutes()
 		var seconds=Digital.getSeconds()
 
 		if (minutes<=9)
			minutes="0"+minutes
 
 		if (seconds<=9)

			seconds="0"+seconds
 
 		document.form1.hora.value=hours+":"+minutes+":"+seconds

 		setTimeout("show()",1000)
 	}
 	show()
 </script>
 
 <script>	

var mydate=new Date();	
var year=mydate.getYear();	
if (year < 1000)		

	year+=1900;	
	
var day=mydate.getDay();	
var month=mydate.getMonth()+1;	
if (month<10)		

	month="0"+month;	

var daym=mydate.getDate();	
if (daym<10)		

	daym="0"+daym;	
	
document.forms[0].fecha.value = year+"-"+month+"-"+daym
</script>
</body>
</html>