<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<link rel="stylesheet" type="text/css" href="../estilo.css"  />
</head>

<body>
<table width="1200" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="6"><strong>Listado de Solicitudes</strong> </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td><strong><a href="../../seguridad/menu.php">Retornar</a><a href="../../seguridad/index.php"></a></strong></td>
    <td>&nbsp;</td>
    <td colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td width="69">&nbsp;</td>
    <td width="100">&nbsp;</td>
    <td colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td><strong>C&oacute;digo</strong></td>
    <td><strong>Fecha</strong></td>
	<td><strong>Hora</strong></td>
	<td width="92"><strong>Fecha Termina</strong></td>
	<td width="92"><strong>Hora Termina</strong></td>
    <td width="290"><strong>Proceso</strong></td>
    <td width="223"><strong>Dependencia</strong></td>
    <td width="222"><strong>Solicitante</strong></td>
    <td width="92"><strong>Estado</strong></td>
	<td width="270"><strong>Usuario Cierra</strong></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="3">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
	<?php foreach ($procesoS as $listarS)	{	?>
  <tr>
    <td>&nbsp;<a href="procesos.php?opc=33&valor=<?php echo $listarS -> idSolicitud; ?>"><?php echo $listarS -> idSolicitud; ?></a></td>
    <td>&nbsp;<?php echo $listarS -> fecha; ?></td>
	<td>&nbsp;<?php echo $listarS -> hora; ?></td>
	<td>&nbsp;<?php echo $listarS -> fechaTerminacion; ?></td>
	<td>&nbsp;<?php echo $listarS -> horaTermina; ?></td>
    <td>&nbsp;<?php echo $listarS -> nombreProceso; ?></td>
    <td><?php echo $listarS -> nombreRequisito; ?></td>
    <td><?php echo $listarS -> solicitante; ?></td>
    <td><?php echo $listarS -> estado; ?></td>
	<td><?php echo $listarS -> usuarioFinalizado; ?></td>
  </tr>
	<?php	}	?>
</table>
</body>
</html>
