<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<link rel="stylesheet" type="text/css" href="../estilo.css"  />

</head>

<body>
<table width="500" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="3">Listado por tipo de Requisito </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>C&oacute;digo</td>
    <td>Solicitud</td>
    <td>Total</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
	<?php foreach ($procesoR as $listarR)	{	?>
  <tr>
    <td>&nbsp;<?php echo $listarR -> idRequisito; ?></td>
    <td>&nbsp;<?php echo $listarR -> nombreRequisito; ?></td>
    <td>&nbsp;<a href="procesos.php?opc=25&valor=<?php echo $listarR -> idRequisito; ?>"><?php echo $listarR -> total; ?></a></td>
  </tr>
	<?php	}	?>
</table>
</body>
</html>
