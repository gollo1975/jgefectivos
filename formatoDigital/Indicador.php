<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<link rel="stylesheet" type="text/css" href="../estilo.css"  />
</head>
<body>
<form id="form1" name="form1" method="post" action="resultadoIndicador.php">
  <table width="400" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td colspan="2"><strong>Periodo del Indicador </strong></td>
    </tr>
    <tr>
      <td width="110">&nbsp;</td>
      <td width="286">&nbsp;</td>
    </tr>
    <tr>
      <td><strong>Retornar</strong></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><strong>Fecha Inicio </strong></td>
      <td><input name="fechaInicio" type="text" id="fechaInicio" size="20" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><strong>Fecha Fin </strong></td>
      <td><input name="fechaFin" type="text" id="fechaFin" size="20" /></td>
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
      <td colspan="2"><input type="submit" name="Submit" value="Enviar" /></td>
    </tr>
  </table>
</form>
<script>	
		<?php foreach ($procesoS as $listarS)	{	?>var mydate=new Date();	
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
	
		document.forms[0].fechaTerminacion.value = year+"-"+month+"-"+daym
</script>
</body>
</html>
