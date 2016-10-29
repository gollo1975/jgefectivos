<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="../formato/estilo.css" />
<script type="text/javascript" src="../validar/validar.js"> </script>
<script type="text/javascript" src="../validar/calendar.js"></script>
<title>Documento sin t&iacute;tulo</title>
</head>

<body onload="foco()">
<div id="calendarDiv"></div>
<form id="form1" name="form1" method="post" action="../control/fachada.php?opc=60" onsubmit = "return validarIdentificacion ()">
  <table width="500" border="0" align="center">
    <tr>
      <th colspan="2">Verificaci&oacute;n de Identificaci&oacute;n Planta </th>
    </tr>
    <tr>
      <td width="174">&nbsp;</td>
      <td width="316">&nbsp;</td>
    </tr>
    <tr>
      <th colspan="2">Retornar</th>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><b>Fecha de Procesos:</b></td>
      <td><input name="valor" type="text" id="valor" class="calendarSelectDate" size="20" maxlength="10" onkeypress = "solonumeros ()" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <th colspan="2"><input type="submit" name="Submit" value="Consultar" />&nbsp;&nbsp;
      <input type="reset" name="Submit2" value="Restablecer" /></th>
    </tr>
  </table>
</form>
<br />
<br />
<br />
</body>
</html>
