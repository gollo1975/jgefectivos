<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<link rel="stylesheet" type="text/css" href="../estilo.css"  />
</head>
<?php $var2 = $_REQUEST["UsuarioFinal"]; ?>
<body>
<table width="750" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="3"><strong>Listado de Solicitudes </strong></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong><a href="procesos.php?opc=24&UsuarioFinal=<?php echo $UsuarioFinal;?>">Retornar</a></strong></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="75">&nbsp;</td>
    <td width="117">&nbsp;</td>
    <td width="500">&nbsp;</td>
	<td width="700">&nbsp;</td>
	<td width="75">&nbsp;</td>
  </tr>
  <tr>
    <td><strong>C&oacute;digo</strong></td>
    <td><strong>Fecha</strong></td>
    <td><strong>Proceso</strong></td>
	<td><strong>Requerimiento</strong></td>
	<td><strong>Estado</strong></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
	<?php foreach ($procesoS as $listarS)	{	?>
  <tr>
    <td>&nbsp;<a href="procesos.php?opc=26&valor=<?php echo $listarS -> idSolicitud; ?>&UsuarioFinal=<?php echo $var2;?>"><?php echo $listarS -> idSolicitud; ?></a></td>
    <td>&nbsp;<?php echo $listarS -> fecha; ?></td>
    <td>&nbsp;<?php echo $listarS -> nombreProceso; ?></td>
	<td>&nbsp;<?php echo $listarS -> solicitud; ?></td>
	<td>&nbsp;<?php echo $listarS -> estado; ?></td>
  </tr>
	<?php	}	?>
</table>
</body>
</html>
