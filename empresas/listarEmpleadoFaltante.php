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
    <th colspan="7" class="titulo"><div align="center"><strong>Listado de Empleados Faltantes </strong></div></th>
  </tr>
  <tr>
    <td width="57">&nbsp;</td>
    <td colspan="4">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="7"><a href="../vista/menu.php"></a></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="4">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;
        <?php	
		
		$ct = 0;
		foreach ($procesoE as $listarE)	{
	
			 $codigo =  $listarE -> codzona;
			 $ct+=1;
		}	
		include ("conexion.php");
		$consulta = "select zona from zona where codzona = $codigo" ;
		$resultado = mysqli_query ($cnn, $consulta) or die ("consulta Incorrecta");
		$fila = mysqli_fetch_array ($resultado);
		echo "<B>" . $fila["zona"] . "<B>"; ?>    </td>
    <td colspan="3">&nbsp;</td>
    <?php
		$consulta = "select count(*) 'total' from ubicacionempleado where codzona = $codigo";
		$resultado = mysqli_query ($cnn, $consulta) or die ("consulta Incorrecta");
		$filac = mysqli_fetch_array ($resultado);
	?>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td width="53">&nbsp;</td>
    <?php
		$consulta = "select count(*) 'total' from empleado inner join contrato on empleado.codemple = contrato.codemple left join ubicacionempleado on empleado.codemple =  ubicacionempleado.codemple where contrato.fechater='0000:00:00' and empleado.codzona = '$codigo' and ubicacionempleado.codemple is null";
		$resultado = mysqli_query ($cnn, $consulta) or die ("consulta Incorrecta");
		$filaf = mysqli_fetch_array ($resultado);
	?>
    <td>&nbsp;<b>&nbsp;</b></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right"><strong>Cédula</strong></td>
    <td width="34">&nbsp;</td>
    <td width="471"><strong>Nombre</strong></td>
    <td colspan="3"><strong>Fecha Inicio </strong></td>
    <td width="76">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td width="50">&nbsp;</td>
    <td width="53">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <?php
  $i = 0;
  foreach ($procesoE as $listarE)	{
  
	  $i++;
  ?>
  <tr id="<?php echo "ide_$i";?>" style="background-color:#F0F0F0" onmousemove="cambiar('<?php echo "ide_$i";?>','#cccccc')" onmouseout="cambiar('<?php echo "ide_$i";?>','#F0F0F0');">
    <td align="right">&nbsp;<?php echo $listarE -> cedemple;?></td>
    <td>&nbsp;</td>
    <td><?php echo utf8_encode($listarE -> nomemple);?>&nbsp;<?php echo utf8_encode($listarE -> nomemple1);?>&nbsp;<?php echo utf8_encode($listarE -> apemple);?>&nbsp;<?php echo utf8_encode($listarE -> apemple1);?></td>
    <td colspan="3"><?php echo $listarE -> fechainic;?><a href="../control/procesos.php?opc=24&valor=<?php echo $listarE -> codemple;?>"></a></td>
    <td>&nbsp;<a href="../control/procesos.php?opc=43&valor=<?php echo $listarE -> codemple;?>"></a></td>
  </tr>
  <?php }	?>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<br />
<br />
</body>
</html>