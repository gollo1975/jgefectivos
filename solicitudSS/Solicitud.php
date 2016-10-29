<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<link rel="stylesheet" type="text/css" href="../estilo.css"  />
</head>

<body>
<?php foreach ($proceso as $listar)	{	?>
<form id="form1" name="form1" method="post" action="procesos.php?opc=2">
  <table width="550" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td colspan="2">Solicitud</td>
    </tr>
    <tr>
      <td width="162">&nbsp;</td>
      <td width="384">&nbsp;</td>
    </tr>
    <tr>
      <td>C&eacute;dula</td>
      <td><input name="cedula" type="text" id="cedula" value = "<?php echo $listar -> cedula;?>" size="20" maxlength="10" required="required" /></td>
    </tr>
    <tr>
      <td>Nombre</td>
      <td><input name="nombre" type="text" id="nombre" value = "<?php echo $listar -> nombre;?>" size="50" maxlength="40" /></td>
    </tr>
    <tr>
      <td>Zona</td>
      <td><input name="zona" type="text" id="zona" value = "<?php echo $listar -> zona;?>" size="50" maxlength="40" />
	  <input name="fecha" type="hidden" id="fecha" size="50" maxlength="40" />
	  <input name="hora" type="hidden" id="hora" size="50" maxlength="40" />	  </td>
    </tr>
    <tr>
      <td>Solicitud</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2"><textarea name="solicitud" cols="60" rows="10" id="solicitud" required="required" ></textarea></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Recibe</td>
      <td><input name="recibe" type="text" id="recibe" size="50" maxlength="40" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2"><input type="submit" name="Submit" value="Almacenar" />
      <input type="reset" name="Submit2" value="Restablecer" /></td>
    </tr>
  </table>
</form>
<?php }	?>


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
