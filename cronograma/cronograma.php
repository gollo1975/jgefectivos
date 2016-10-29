<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Formato de Solicitud Digital</title>
<link rel="stylesheet" type="text/css" href="../estilo.css"  />
<script type="text/javascript" src="calendar.js"></script>
</head>

<body>
<div id="calendarDiv"></div>
<form id="form1" name="form1" method="post" action="procesos.php?opc=1">
  <table width="700" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td colspan="4"><strong>Planificacion de Mantenimientos Preventivos </strong></td>
    </tr>
    <tr>
      <td width="192">&nbsp;</td>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td><a href="../../seguridad/menu.php"><strong>Retornar</strong></a></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><strong>Fecha</strong></td>
      <td><input name="fecha" type="text" id="fecha" size="20" class="calendarSelectDate" maxlength="10" readonly /></td>
      <td><strong>Hora</strong></td>
      <td><input name="hora" type="text" id="hora" size="20" maxlength="10"  /></td>
    </tr>
    <tr>
      <td><strong>Proceso</strong></td>
      <td width="214"><select name="tipo" id="tipo">
        <option value="Copias de Seguridad">Copias de Seguridad 
        <option value="Mantenimiento">Mantenimiento        
      </select>      </td>
      <td width="105">&nbsp;</td>
      <td width="189">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="2">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><strong>Descripci&oacute;n</strong></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="4"><textarea name="descripcion" cols="75" rows="10" id="descripcion"></textarea></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>
        <input type="submit" name="Submit" value="Procesar" />      </td>
      <td><input type="reset" name="Submit2" value="Restablecer" /></td>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>
</body>
</html>
