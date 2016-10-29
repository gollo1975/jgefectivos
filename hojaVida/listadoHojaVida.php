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
    <td colspan="4">Listado de Hojas de Vida </td>
  </tr>
  <tr>
    <td width="75">&nbsp;</td>
    <td width="117">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3"><a href="index.php"><b><< Regresar</b></a></td>
  </tr>
  <tr>
    <td width="75">&nbsp;</td>
    <td width="117">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>C&oacute;digo PC </td>
    <td>Fecha Entrega </td>
    <td width="291">Responsable</td>
    <td width="267">Area</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
	<?php foreach ($procesoHV as $listarHV)	{	?>
  <tr>
    <td>&nbsp;<a href="procesos.php?opc=2&valor=<?php echo $listarHV -> codigoPC; ?>"><?php echo $listarHV -> codigoPC; ?></a></td>
    <td>&nbsp;<?php echo $listarHV -> fechaEntrega; ?></td>
    <td>&nbsp;<?php echo $listarHV -> empleado; ?></td>
    <td>&nbsp;<?php echo $listarHV -> area;?></td>
  </tr>
	<?php	}	?>
</table>
</body>
</html>
