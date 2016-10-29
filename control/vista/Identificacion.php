<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="../formato/estilo.css" />
<script type="text/javascript" src="../validar/validar.js"> </script>
<title>Documento sin t&iacute;tulo</title>
</head>

<body onload="foco()">
<form id="form1" name="form1" method="post" action="../control/fachada.php?opc=52" onsubmit = "return validarIdentificacion ()">
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
      <td>Identificaci&oacute;n</td>
      <td><input name="identificacion" type="text" id="identificacion" size="20" maxlength="10" onkeypress = "solonumeros ()" /></td>
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
<table width="750" border="0" align="center">
  <tr>
    <th colspan="6">Listado de Empleados Registrados </th>
  </tr>
  <tr>
    <td width="92">&nbsp;</td>
    <td width="347">&nbsp;</td>
    <td width="94">&nbsp;</td>
    <td width="81">&nbsp;</td>
    <td width="79">&nbsp;</td>
    <td width="31">&nbsp;</td>
  </tr>
  <tr>
    <td>Identificaci&oacute;n</td>
    <td>Nombre</td>
    <td>Fecha</td>
    <td>Hora</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <?php foreach ($procesoEmpleado as $listarEmpleado)	{	?>
  <tr>
    <td>&nbsp;<?php echo $listarEmpleado -> identificacion;?></td>
    <td>&nbsp;<?php echo $listarEmpleado -> nombre;?></td>
    <td>&nbsp;<?php echo $listarEmpleado -> fecha;?></td>
    <td>&nbsp;<?php echo $listarEmpleado -> horaIngreso;?></td>
    <td>&nbsp;</td>
    <td>&nbsp;<a href="../control/fachada.php?opc=53&valor=<?php echo $listarEmpleado -> identificacion;?>">S</a></td>
  </tr>
  <?php	}	?>
</table>
</body>
</html>
