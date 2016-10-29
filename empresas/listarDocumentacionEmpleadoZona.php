<?php session_start (); ?>
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

<table width="650" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <th colspan="6" class="titulo"><div align="center"><strong>Listado de Documentacion por Empleado </strong></div></th>
  </tr>
  <tr>
    <td width="60">&nbsp;</td>
    <td colspan="3">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="6"><a href="../menu.php"></a></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
     <td>&nbsp;</td>
    <td>&nbsp;
			<?php	
		foreach ($procesoDE as $listarDE)	{
	
			 $codigo =  $listarDE -> codemple;
		}	
		include ("conexion.php");
		$consulta = "select empleado.codemple, empleado.nomemple, empleado.nomemple1, empleado.apemple, empleado.apemple1, contrato.fechainic from empleado inner join contrato on empleado.codemple = contrato.codemple where empleado.codemple = $codigo";
		$resultado = mysqli_query ($cnn, $consulta) or die ("consulta Incorrecta");
		$fila = mysqli_fetch_array ($resultado);
		echo "<B>" . $fila["codemple"] . "&nbsp;&nbsp;&nbsp;" . $fila["nomemple"] . " " . $fila["nomemple1"] . " " . $fila["apemple"] . " " . $fila["apemple1"] . "<B>" ; ?>	</td>
    <td colspan="4">&nbsp;<?php echo "<B>Fecha de Inicio " . $fila ["fechainic"] . "<B>"?></td>

  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <table width="650" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <th><strong>Código</strong></td>
    <th width="359"><strong>Archivo</strong></td>
    <th width="269"><strong>Fecha</strong></td>

  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>

  </tr>

  <?php
  $i = 0;
  foreach ($procesoDE as $listarDE)	{
  
	  $i++;
  ?>
  <tr id="<?php echo "ide_$i";?>" style="background-color:#F0F0F0" onMouseMove="cambiar('<?php echo "ide_$i";?>','#cccccc')" onMouseOut="cambiar('<?php echo "ide_$i";?>','#F0F0F0');">
    <td>&nbsp;<?php echo $listarDE -> idDocumentacion;?></td>
    <?php $archivo = $listarDE -> archivo;?>
    <td>&nbsp;<a href="descargar.php?ubicacion=<?php echo $archivo;?>&ruta=<?php echo $listarDE -> ubicacionEmpleado;?>"><?php echo $listarDE -> descripcion;?></a></td>
	
    <td><?php echo $listarDE -> fecha;?></td>

  </tr>
  <?php }	?>
   <tr>
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
