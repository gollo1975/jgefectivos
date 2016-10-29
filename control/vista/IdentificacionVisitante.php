<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="../formato/estilo.css" />
<script type="text/javascript" src="../validar/validar.js"></script>
<title>Documento sin t&iacute;tulo</title>
</head>

<body onload="foco()">
<?php	if (!isset($_POST["identificacion"]))	{	?>
<form id="form1" name="form1" method="post" action="">
  <table width="500" border="0" align="center">
    <tr>
      <th colspan="2">Verificaci&oacute;n de Identificaci&oacute;n Visitantes </th>
    </tr>
    <tr>
      <td width="174">&nbsp;</td>
      <td width="316">&nbsp;</td>
    </tr>
    <tr>
      <th colspan="2">Retornar</th>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Identificaci&oacute;n</td>
      <td><input name="identificacion" type="text" id="identificacion" size="20" maxlength="10" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <th colspan="2"><input type="submit" name="Submit" value="Consultar" />&nbsp;&nbsp;
      <input type="reset" name="Submit2" value="Restablecer" /></th>
    </tr>
  </table>
</form>
<br />
<br />
<table width="750" border="0" align="center">
  <tr>
    <th colspan="6">Listado de Visitantes Registrados </th>
  </tr>
  <tr>
    <td width="92">&nbsp;</td>
    <td width="347">&nbsp;</td>
    <td width="94">&nbsp;</td>
    <td width="81">&nbsp;</td>
    <td width="79">&nbsp;</td>
    <td width="31">&nbsp;</td>
  </tr>
  <tr>
    <td>Identificaci&oacute;n</td>
    <td>Nombre</td>
    <td>Fecha</td>
    <td>Hora</td>
    <td>&nbsp;</td>
    <td>C&oacute;digo </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <?php foreach ($procesoVisitante as $listarVisitante){?>
  <tr>
    <td>&nbsp;<?php echo $listarVisitante -> identificacion;?></td>
    <td>&nbsp;<?php echo $listarVisitante -> nombre;?></td>
    <td>&nbsp;<?php echo $listarVisitante -> fecha;?></td>
    <td>&nbsp;<?php echo $listarVisitante -> horaIngreso;?></td>
    <td>&nbsp;</td>
    <td>&nbsp;<a href="../control/fachada.php?opc=17&valor=<?php echo $listarVisitante -> identificacion;?>"><?php echo $listarVisitante -> codigoVisitante;?></a></td>
  </tr>
  <?php	}	?>
</table>
<?php	}	
		else	{
		
			$identificacion = $_POST["identificacion"];
			if (empty($identificacion))
			
				echo "<script type='text/javascript'> alert('Debe de Digitar una Identificacion'); history.back();</script>";
			else	{
				
				include ("../conexion/conexion.php");
				$resultado = mysqli_query ($cnn, "select visitante.identificacion, visitante.nombre from visitante inner join detallevisitante on visitante.identificacion = detallevisitante.identificacion where visitante.identificacion = '$identificacion' and detallevisitante.horaSalida = '00:00:00'");
				$registros = mysqli_num_rows ($resultado);
				$filas = mysqli_fetch_array($resultado);
				$nombre = $filas ["nombre"];
				if ($registros == 0)	{
				
					include ("../conexion/conexion.php");
					$resultado = mysqli_query ($cnn, "select identificacion, nombre from visitante where visitante.identificacion = '$identificacion'");
					$registros = mysqli_num_rows ($resultado);
					$filas = mysqli_fetch_array($resultado);
					$nombre = $filas ["nombre"];
					if ($registros == 0)	{
					
						?>
							<script type = "text/javascript">
								window.location.href = "../control/fachada.php?opc=10&identificacion=<?php echo $identificacion;?>";
							</script>
						<?php
					}
					else {
						
						?>
							<script type = "text/javascript">
								window.location.href = "../control/fachada.php?opc=13&identificacion=<?php echo $identificacion;?>&nombre=<?php echo $nombre;?>";
							</script>
						<?php
					}			
				}
				else	{
				
					echo "<script type = 'text/javascript'> alert ('el Visitante aun no ha salido'); history.back (); </script>";
				}
			}
		}
?>
</body>
</html>
