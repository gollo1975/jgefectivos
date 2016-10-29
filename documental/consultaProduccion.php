<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="estilo.css" />
<script type="text/javascript" src="calendar.js"> </script>
<title>Documento sin t&iacute;tulo</title>
</head>

<body onload="foco()">
<div id="calendarDiv"></div>
<form id="form1" name="form1" method="post" action="listadoProduccion.php">
  <table width="750" border="0" align="center">
    <tr>
      <th colspan="4">Producci&oacute;n Gestor Documental </th>
    </tr>
    <tr>
      <td width="137">&nbsp;</td>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <th colspan="4">Retornar</th>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td>Fecha de Inicio </td>
      <td width="149"><input name="inicio" type="text" id="inicio" class="calendarSelectDate" size="20" maxlength="10" onkeypress = "solonumeros ()" /></td>
      <td width="173">Fecha Terminaci&oacute;n </td>
      <td width="269"><input name="fin" type="text" id="fin" class="calendarSelectDate" size="20" maxlength="10" onkeypress = "solonumeros ()" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <th colspan="4"><input type="submit" name="Submit" value="Consultar" />&nbsp;&nbsp;
      <input type="reset" name="Submit2" value="Restablecer" /></th>
    </tr>
  </table>
</form>
<br />
<br />
<br />
</body>
</html>
