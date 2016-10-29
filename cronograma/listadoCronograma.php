<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<link rel="stylesheet" type="text/css" href="../estilo.css"  />
</head>

<body>
<table width="750" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="5"><strong>Listado Anual de Mantenimientos Preventivos </strong></td>
  </tr>
  <tr>
    <td width="77">&nbsp;</td>
    <td width="124">&nbsp;</td>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td><a href="../../seguridad/menu.php">Retornar</a></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>C&oacute;digo</td>
    <td>Fecha</td>
    <td width="121">Hora</td>
    <td width="177">Tipo</td>
    <td width="247">Descripci&oacute;n</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <?php foreach ($procesoC as $listarC)	{	?>
  <tr>
    <td>&nbsp;<?php echo $listarC -> idCronograma; ?></td>
    <td>&nbsp;<?php echo $listarC -> fecha; ?></td>
    <td>&nbsp;<?php echo $listarC -> hora; ?></td>
    <td><?php echo $listarC -> tipo; ?></td>
    <td><?php echo $listarC -> descripcion; ?></td>
  </tr>
  <?php	}	?>
</table>
</body>
</html>
