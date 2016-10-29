<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Centro de Costos</title>
<link href="../estilo.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="600" border="0" align="center">
  <tr>
    <td colspan="4"><strong>Centro de Costos </strong></td>
  </tr>
  <tr>
    <td width="66">&nbsp;</td>
    <td width="463">&nbsp;</td>
    <td width="24">&nbsp;</td>
    <td width="25">&nbsp;</td>
  </tr>
  <tr>
    <td><strong>C&oacute;digo</strong></td>
    <td><strong>Nombre</strong></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <?php foreach ($procesoCC as $listarCC)	{	?>
  <tr>
    <td>&nbsp;<?php echo $listarCC -> codcosto;?></td>
    <td>&nbsp;<?php echo $listarCC -> centro;?></td>
    <td><a href="procesos.php?opc=3&amp;valor=<?php echo $listarCC -> codcosto;?>"><img src="../image/borrar.png" width="16" height="16" border = "0" /></a></td>
    <td><a href="procesos.php?opc=4&amp;valor=<?php echo $listarCC -> codcosto;?>"><img src="../image/mod.png" width="16" height="16" border = "0" /></a></td>
  </tr>
  <?php	}	?>
</table>
</body>
</html>
