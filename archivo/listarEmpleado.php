<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>JGEfectivo</title>
<link rel="stylesheet" type="text/css" href="../estilo.css" />
<script type="text/javascript" src="../validar.js"></script>
</head>

<body>

  <br />
  <br />
<form id="form1" name="form1" method="post" action="../control/procesos.php?opc=36">
  <table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td colspan="6" class="titulo"><strong>Listado de Empleados sin beneficiarios asignados </strong></td>
    </tr>
    <tr>
      <td colspan="6">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="6"><a href="../vista/menu.php"></a></td>
    </tr>
    <tr>
      <td colspan="6">&nbsp;</td>
    </tr>
    <tr>
      <td width="80"><strong>Cédula</strong></td>
      <td width="344"><strong>Empleado</strong></td>
      <td width="404"><strong>Zona</strong></td>
      <td width="168"><strong>Fecha Inicio</strong></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <?php 
  $i = 0;
  foreach ($procesoE as $listarE)	{
  
	  $i++;
  ?>
    <tr>
      <td class="informacion">&nbsp;<?php echo $listarE -> cedemple;?>&nbsp;</td>
      <td>&nbsp;<?php echo utf8_encode($listarE -> nombre);?></td>
      <td><?php echo utf8_encode($listarE -> zona);?></td>
      <td><?php echo $listarE -> fechainic;?></td>
    </tr>
    <?php }	?>
    <tr>
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
    </tr>
  </table>
</form>
<br />
<br />
</body>
</html>