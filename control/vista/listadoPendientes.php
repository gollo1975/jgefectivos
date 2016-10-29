<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="../formato/estilo.css" />
<title>Documento sin t&iacute;tulo</title>
</head>

<body>
<table width="900" border="0" align="center">
  <tr>
    <th colspan="6">Listado de Visitantes Pendientes </th>
  </tr>
  <tr>
    <td width="98">&nbsp;</td>
    <td colspan="3">&nbsp;</td>
    <td width="0">&nbsp;</td>
    <td width="65">&nbsp;</td>
  </tr>
  <tr>
    <th colspan="6">Retornar</th>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="5">&nbsp;</td>
  </tr>
  <tr>
    <td>Identificaci&oacute;n</td>
    <td width="345">Nombre</td>
    <td width="324">Dependencia</td>
    <td colspan="3">Ingreso</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="3">&nbsp;</td>
  </tr>
  <?php foreach ($procesoVisita as $listarVisita)	{	?>
  <tr>
    <td>&nbsp;<?php echo $listarVisita -> identificacion;?></td>
    <td>&nbsp;<?php echo $listarVisita -> nombre;?></td>
    <td>&nbsp;<?php echo $listarVisita -> nombreDependencia;?></td>
    <td colspan="3">&nbsp;<?php echo $listarVisita -> horaIngreso;?>&nbsp;&nbsp;</td>
  </tr>
  <?php 	}	?>
</table>
</body>
</html>
