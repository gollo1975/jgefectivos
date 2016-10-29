<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<link rel="stylesheet" type="text/css" href="../estilo.css"  />
</head>
<body>
<?php
	include ("conexion.php");
	
	$consulta1 = "select count(*) 'total' from solicitud where fecha >= '$fechaInicio' and fecha <= '$fechaFin'";
	$resultado1 = mysqli_query ($cnn, $consulta1);
	$registros1 = mysqli_num_rows ($resultado1);
	$filas1 = mysqli_fetch_array ($resultado1);
	/*********************************************/
	$consulta2 = "select count(*) 'total2' from solicitud where fecha >= '$fechaInicio' and fecha <= '$fechaFin' and estado = 'Cerrado'";
	$resultado2 = mysqli_query ($cnn, $consulta2);
	$registros2 = mysqli_num_rows ($resultado2);
	$filas2 = mysqli_fetch_array ($resultado2);

?>

<form id="form1" name="form1" method="post" action="">
  <table width="400" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td colspan="2"><strong>Indicador</strong></td>
    </tr>
    <tr>
      <td width="112">&nbsp;</td>
      <td width="284">&nbsp;</td>
    </tr>
    <tr>
      <td><strong>Retornar</strong></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><strong>Total Solicitudes </strong></td>
      <td><?php echo $filas1 ["total"];?></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><strong>Total Soluciones </strong></td>
      <td><?php echo $filas2 ["total2"];?></td>
    </tr>
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td><strong>Efectividad</strong></td>
      <td><?php echo $filas2 ["total2"] * 100 / $filas1 ["total"];?>&nbsp;%</td>
    </tr>
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2"><input type="submit" name="Submit" value="Enviar" /></td>
    </tr>
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
  </table>
</form>
</body>
</html>
