<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="estilo.css" />

<title>Documento sin t&iacute;tulo</title>
</head>

<body >
<?php
	include ("conexion.php");
	$ct = 0;
	$inicio = $_POST["inicio"];
	$fin = $_POST["fin"];
	
	if (empty($inicio))
		
		echo "<script type='text/javascript'> alert ('Debe de Digitar la Fecha de Inicio'); history.back(); </script>";
	else if (empty ($fin))
	
		echo "<script type='text/javascript'> alert ('Debe de Digitar la Fecha de Fin'); history.back(); </script>";
	else {

		$resultado = mysqli_query ($cnn, "select fecha, count(*) 'total' from documentacionempleado where fecha >= '$inicio' and fecha <= '$fin' group by day(fecha)");
		$registros =  mysqli_num_rows ($resultado);
	
		if ($registros == 0)

			echo "<script type='text/javascript'> alert ('No Existen registros en estas fechas'); history.back(); </script>";
		else	{
?>
<br />
<br />
<br />
<table width="450" border="0" align="center">
  <tr>
    <th colspan="6">Resultado de Gestor Documental </th>
  </tr>
  <tr>
    <td colspan="6">&nbsp;</td>
  </tr>
  <tr>
    <td width="173">Fecha</td>
    <td colspan="5">Total</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="5">&nbsp;</td>
  </tr>
  <?php 
  	$ct = 0;
  	while ($filas = mysqli_fetch_array($resultado))	{	
		$ct = $ct + $filas["total"];
	?>
  <tr>
    <td>&nbsp;<?php echo $filas["fecha"];?></td>
    <td colspan="3">&nbsp;<?php echo $filas["total"];?></td>
  </tr>
  <?php	}
  	}
	}
?>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td>Total</td>
    <td colspan="3">&nbsp;<?php echo $ct;?></td>
  </tr>
  
</table>
</body>
</html>
