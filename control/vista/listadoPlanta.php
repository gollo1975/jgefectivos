<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="../formato/estilo.css" />
<script type="text/javascript" src="../validar/validar.js"> </script>
<title>Documento sin t&iacute;tulo</title>
</head>

<body onload="foco()">
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
    <th>Identificaci&oacute;n</td>
    <th>Nombre</td>
    <th>Fecha</td>
    <th>Hora</td>
    <th>&nbsp;</td>
    <th>&nbsp;</td>
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
  <tr class="cajas">
    <td>&nbsp;<?php echo $listarEmpleado -> identificacion;?></td>
    <td>&nbsp;<?php echo $listarEmpleado -> nombre;?></td>
    <td>&nbsp;<?php echo $listarEmpleado -> fecha;?></td>
    <td>&nbsp;<?php echo $listarEmpleado -> horaIngreso;?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <?php	}	?>
</table>
</body>
</html>
