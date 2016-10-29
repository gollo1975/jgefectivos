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
  <table width="1150" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td colspan="9" class="titulo"><strong>Listado de Empleados </strong></td>
    </tr>
    <tr>
      <td colspan="9">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="9"><a href="../vista/menu.php"></a></td>
    </tr>
    <tr>
      <td colspan="9">&nbsp;</td>
    </tr>
    <tr>
      <td width="75"><strong>Cédula</strong></td>
      <td width="255"><strong>Empleado</strong></td>
      <td width="341"><strong>Zona</strong></td>
      <td width="104"><strong>Municipio</strong></td>
      <td width="257"><strong>Nombre Hijo </strong></td>
      <td width="78"><strong>Nacimiento</strong></td>
      <td width="36" align="right"><strong>Edad</strong></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
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
      <td><?php echo utf8_encode($listarE ->municipio);?></td>
      <td><?php echo  utf8_encode($listarE -> nombrehijo);?></td>
      <td><?php echo $listarE -> fechanac;?></td>
      <td class="informacion"><?php echo $listarE -> edad;?></td>
    </tr>
    <?php }	?>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
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
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>
<br />
<br />
</body>
</html>