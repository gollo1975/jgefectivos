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
    <td colspan="6"><strong>Listado de Solicitudes </strong></td>
  </tr>
  <tr>
    <td width="75">&nbsp;</td>
    <td width="99">&nbsp;</td>
    <td colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td>C&oacute;digo</td>
    <td>Fecha</td>
    <td width="105">Hora</td>
    <td width="205">Nombre</td>
    <td width="186">Recibe</td>
    <td width="76">Estado</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <?php foreach ($proceso as $listar)	{	?>
  <tr>
    <td>&nbsp;<a href="procesos.php?opc=26&valor=<?php echo $listarS -> idSolicitud; ?>"><?php echo $listar -> idSolicitud; ?></a></td>
    <td>&nbsp;<?php echo $listar -> fecha; ?></td>
    <td>&nbsp;<?php echo $listar -> hora; ?></td>
    <td><?php echo $listar -> nombre; ?></td>
    <td><?php echo $listar -> recibe; ?></td>
    <td><?php echo $listar -> estado; ?></td>
  </tr>
  <?php	}	?>
</table>
</body>
</html>
