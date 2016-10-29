<?php @session_start (); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Gestor Documental :: JGEfectivo</title>
<link rel="stylesheet" type="text/css" href="../estilo.css" />
<script type="text/javascript" src="../validar.js"></script>
</head>

<body>

<div id="header">  </div>
<br /><br />
<table width="800" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="5" class="titulo"><strong>Listado de Zonas</strong></td>
  </tr>
  <tr>
    <td width="57">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="5"><a href="menu.php"></a></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Código</strong></td>
    <td width="600"><strong>Zona</strong></td>
    <td width="47"><strong>&nbsp;</strong></td>
    <td width="26">&nbsp;</td>
    <td width="64"><strong>Empleados</strong></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div align="left"></div></td>
    <td>&nbsp;</td>
  </tr>
  <?php 
  
  $i = 0;
  foreach ($procesoZ as $listarZ)	{

	  $i++;
  ?>
  <tr id="<?php echo "ide_$i";?>" style="background-color:#F0F0F0" onmousemove="cambiar('<?php echo "ide_$i";?>','#CCCCCC')" onmouseout="cambiar('<?php echo "ide_$i";?>','#F0F0F0');">
    <td>&nbsp;<?php echo $listarZ -> codzona;?></td>
    <td>&nbsp;<?php echo utf8_encode($listarZ -> zona);?></td>
    <td>&nbsp;</td>
    <td>&nbsp;
      <div align="left">
        <?php 
		if ($listarZ -> estado == "SI")	{
		?>
        <img src="vb.jpg" />
          <?php
			}
		?>
      </div></td>
    <td><a href="procesos.php?opc=13&amp;valor=<?php echo $listarZ -> codzona;?>&amp;campo=<?php echo $listarZ -> ubicacion;?>&amp;nombreZona=<?php echo $listarZ -> zona;?>"><img src="empleado.png" border="0" /></a></td>
  </tr>
  <?php }	?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<br />
<br />
<div id="footer"></div>
</body>
</html>