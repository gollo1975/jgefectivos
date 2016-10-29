<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>JGEfectivo :: Consulta General de Incapacidades</title>
<link href="../estilo.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php include ("../conexion.php"); 
	$consulta = "select  incapacidad.nroinca,
incapacidad.cedemple,
concat(empleado.nomemple, ' ', empleado.nomemple1, ' ', empleado.apemple, ' ', empleado.apemple1) 'nombre',
timestampdiff (year, empleado.fechanac, current_date()) 'edad',
empleado.sexo,
incapacidad.fechapro,
incapacidad.fechaini, 
incapacidad.fechater, 
incapacidad.dias, 
incapacidad.codeps, 
eps.eps, 
incapacidad.estado,
control.codigo, 
control.concepto 'conceptoc', 
tipoinca.concepto, 
zona.zona, 
sucursal.sucursal, 
round(empleado.basico / 30 * incapacidad.dias) 'valor'
from incapacidad inner join empleado on incapacidad.cedemple = empleado.cedemple
inner join eps on incapacidad.codeps = eps.codeps
    inner join zona on zona.codzona = empleado.codzona
    inner join sucursal on zona.codsucursal = sucursal.codsucursal
    inner join tipoinca on incapacidad.tipoinca = tipoinca.tipoinca
    inner join control on incapacidad.codigo = control.codigo";
	
	$sw = 0;
	
	if (!empty($fechaini))	{
	
		$consulta .= " where incapacidad.fechaini >= '$fechaini'";
		$sw = 1;
	}
	if (!empty($fechater))	{
	
		if ($sw == 1)	{
		
			$consulta .= " and incapacidad.fechater <= '$fechater'";
		}
		else	{
		
			$consulta .= " where incapacidad.fechater <= '$fechater'";
			$sw = 1;
		}
	}
	if (!empty($cedemple))	{
	
		if ($sw == 1)	{
		
			$consulta .= " and empleado.cedemple = '$cedemple'";
		}
		else	{
		
			$consulta .= " where empleado.cedemple = '$cedemple'";
			$sw = 1;
		}
	}
	if (!empty($nroinca))	{
	
		if ($sw == 1)	{
		
			$consulta .= " and incapacidad.nroinca = '$nroinca'";
		}
		else	{
		
			$consulta .= " where incapacidad.nroinca = '$nroinca'";
			$sw = 1;
		}
	}
	if (!empty($codeps))	{
	
		if ($sw == 1)	{
		
			$consulta .= " and eps.codeps = '$codeps'";
		}
		else	{
		
			$consulta .= " where eps.codeps = '$codeps'";
			$sw = 1;
		}
	}
	if (!empty($estado))	{
	
		if ($sw == 1)	{
		
			$consulta .= " and incapacidad.estado = '$estado'";
		}
		else	{
		
			$consulta .= " where incapacidad.estado = '$estado'";
			$sw = 1;
		}
	}
	if (!empty($codzona))	{
	
		if ($sw == 1)	{
		
			$consulta .= " and zona.codzona = '$codzona'";
		}
		else	{
		
			$consulta .= " where zona.codzona = '$codzona'";
			$sw = 1;
		}
	}
	if (!empty($codsucursal))	{
	
		if ($sw == 1)	{
		
			$consulta .= " and sucursal.codsucursal = '$codsucursal'";
		}
		else	{
		
			$consulta .= " where sucursal.codsucursal = '$codsucursal'";
			$sw = 1;
		}
	}
	if (!empty($tipoinca))	{
	
		if ($sw == 1)	{
		
			$consulta .= " and tipoinca.tipoinca = '$tipoinca'";
		}
		else	{
		
			$consulta .= " where tipoinca.tipoinca = '$tipoinca'";
			$sw = 1;
		}
	}
	
	if (!empty($fechaPInicio))	{
	
		if ($sw == 1)	{
		
			$consulta .= " and incapacidad.fechapro >= '$fechaPInicio'";
		}
		else	{
		
			$consulta .= " where incapacidad.fechapro >= '$fechaPInicio'";
			$sw = 1;
		}
	}
	
	if (!empty($fechaPTerminacion))	{
	
		if ($sw == 1)	{
		
			$consulta .= " and incapacidad.fechapro <= '$fechaPTerminacion'";
		}
		else	{
		
			$consulta .= " where incapacidad.fechapro >= '$fechaPTerminacion'";
			$sw = 1;
		}
	}
	
	$resultado = mysql_query ($consulta);
?>
<table width="1300" border="0" align="center" class="formato">
  <tr>
    <td colspan="12">Resultado de Incapacidades </td>
  </tr>
  <tr>
    <td width="19">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>	
	<td width="35">&nbsp;</td>
	<td width="42">&nbsp;</td>
    <td width="32">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
	<td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3"><a href="consultaGeneralIncapacidad.php">Continuar Consulta </a></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td>&nbsp;</td>	
    <td>&nbsp;</td>
    <td>&nbsp;</td>
	<td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td width="22">&nbsp;</td>
    <td width="56">&nbsp;</td>
    <td width="191">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
	<td width="61">&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td>&nbsp;</td>	
	<td width="46">&nbsp;</td>
    <td width="19">&nbsp;</td>
    <td width="50">&nbsp;</td>
    <td width="80">&nbsp;</td>
    <td width="61">&nbsp;</td>
	<td width="60">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td></td>
	<td>Nro </td>
    <td>C&eacute;dula</td>
    <td>Nombre</td>
	<td>Edad</td>
	<td>Sexo</td>
    <td>Proceso</td>
    <td>Inicia</td>
    <td>Termina</td>
    <td>Dias</td>
	<td>Valor</td>
    <td>EPS</td>
    <td>Estado</td>
    <td>Zona</td>
	<td>Diagnostico</td>	
	<td>Concepto</td>	
    <td width="84">Tipo Inc </td>
    <td width="236">Sucursal</td>
  </tr>
  <tr>
  <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
	<td>&nbsp;</td>
    <td>&nbsp;</td>
	<td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  
	<?php 
	$i=0;
	while ($reg = mysql_fetch_array ($resultado))	{
		$i++;
	?>
  <tr  class="formato">
  
  <td>&nbsp;<?php echo $i;?></td>
    <td align="right">&nbsp;<?php echo $reg ["nroinca"];?></td>
    <td>&nbsp;<?php echo $reg ["cedemple"];?></td>
    <td>&nbsp;<?php echo $reg ["nombre"];?></td>
	<td>&nbsp;<?php echo $reg ["edad"];?></td>
	<td>&nbsp;<?php echo $reg ["sexo"];?></td>
	<td>&nbsp;<?php echo $reg ["fechapro"];?></td>
    <td>&nbsp;<?php echo $reg ["fechaini"];?></td>
    <td>&nbsp;<?php echo $reg ["fechater"];?></td>
    <td>&nbsp;<?php echo $reg ["dias"];?></td>
	<td>&nbsp;<?php echo $reg ["valor"];?></td>
    <td>&nbsp;<?php echo $reg ["eps"];?></td>
    <td>&nbsp;<?php echo $reg ["estado"];?></td>
    <td>&nbsp;<?php echo $reg ["zona"];?></td>
	<td>&nbsp;<?php echo $reg ["codigo"];?></td>	
	<td>&nbsp;<?php echo $reg ["conceptoc"];?></td>	
    <td>&nbsp;<?php echo $reg ["concepto"];?></td>
    <td><?php echo $reg ["sucursal"];?></td>
  </tr>
  
<?php	}	?>
</ol>
</table>
</body>
</html>
