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
    <th colspan="8">Listado General Visitas </th>
  </tr>
  <tr>
    <td width="89">&nbsp;</td>
    <td colspan="5">&nbsp;</td>
    <td width="1">&nbsp;</td>
    <td width="70">&nbsp;</td>
  </tr>
  <tr>
    <th colspan="8">Retornar</th>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="7">&nbsp;</td>
  </tr>
  <tr>
    <td><b>Identificaci&oacute;n</b></td>
    <td width="246"><b>Nombre</b></td>
    <td width="108"><b>Fecha</b></td>
    <td width="198"><b>Dependencia</b></td>
    <td width="80"><b>Ingreso</b></td>
    <td width="70"><b>Salida</b></td>
    <td colspan="2"><b>Tiempo</b> </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <?php foreach ($procesoVisita as $listarVisita)	{	?>
  <tr class="cajas">
    <td>&nbsp;<?php echo $listarVisita -> identificacion;?></td>
    <td>&nbsp;<?php echo $listarVisita -> nombre;?></td>
    <td><?php echo $listarVisita -> fecha;?></td>
    <td>&nbsp;<?php echo $listarVisita -> nombreDependencia;?></td>
    <td>&nbsp;<?php echo $listarVisita -> horaIngreso;?></td>
    <td>&nbsp;<?php echo $listarVisita -> horaSalida;?></td>
    <td colspan="2">&nbsp;<?php echo $listarVisita -> tiempoTotal;?></td>
  </tr>
  <?php 	}	?>
</table>
</body>
</html>
