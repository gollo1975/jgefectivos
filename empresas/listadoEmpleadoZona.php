<?php session_start ();?>
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
<table width="950" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <th colspan="9" class="titulo"><div align="center"><strong><b>Listado de Empleados </b></strong></div></th>
  </tr>
  <tr>
    <td width="60">&nbsp;</td>
    <td colspan="6">&nbsp;</td>
    <td width="73" colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="9"><a href="../vista/menu.php"></a></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="6">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="4"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="4">&nbsp;</td>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="4">&nbsp;</td>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="4">&nbsp;</td>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td align="right"><strong>Cédula</strong></td>
    <td width="58" align="right"><strong>Codigo</strong></td>
    <td width="240"><strong>&nbsp;Nombre</strong></td>
    <td width="87"><strong>Estado</strong></td>
    <td width="73"><strong>Fecha</strong></td>
    <td width="352"><strong>Empresa</strong></td>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="3">&nbsp;</td>
  </tr>
  <?php
  $i = 0;
  foreach ($procesoE as $listarE)	{
  
	  $i++;
  ?>
  <tr id="<?php echo "ide_$i";?>" style="background-color:#F0F0F0" onmousemove="cambiar('<?php echo "ide_$i";?>','#cccccc')" onmouseout="cambiar('<?php echo "ide_$i";?>','#F0F0F0');">
    <td align="right">&nbsp;<?php echo $listarE -> cedemple;?></td>
    <td align="right"><?php echo $listarE -> codemple;?></td>
    <td>&nbsp;<?php echo utf8_encode($listarE -> nomemple);?>&nbsp;<?php echo utf8_encode($listarE -> nomemple1);?>&nbsp;<?php echo utf8_encode($listarE -> apemple);?>&nbsp;<?php echo utf8_encode($listarE -> apemple1);?></td>
    <td><?php if($listarE -> fechater == "0000-00-00") echo "ACTIVO"; else echo "INACTIVO";?></td>
    <td><?php echo $listarE -> fechater;?></td>
    <td><?php echo utf8_encode($listarE -> zona);?></td>
    <td colspan="3"><a href="procesos.php?opc=14&codzona=<?php echo $listarE -> codzona;?>&ubicacion=<?php echo $listarE -> ubicacion;?>&codemple=<?php echo $listarE -> codemple;?>&empleado=<?php echo $listarE -> nomemple;?>_<?php echo $listarE -> nomemple1;?>_<?php echo $listarE -> apemple;?>_<?php echo $listarE -> apemple1;?>"></a>&nbsp;
        <div align="left">
          <?php 
		if ($listarE -> estado == "SI")	{
		?>
          <img src="../imagen/vb.jpg" />
          <?php
			}
		?>
        </div>
      <a href="procesos.php?opc=24&valor=<?php echo $listarE -> codemple;?>"></a>&nbsp;<a href="procesos.php?opc=43&valor=<?php echo $listarE -> codemple;?>"></a></td>
  </tr>
  <?php }	?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="3">&nbsp;</td>
  </tr>
</table>
<br />
<br />
<div id="footer"></div>
</body>
</html>
