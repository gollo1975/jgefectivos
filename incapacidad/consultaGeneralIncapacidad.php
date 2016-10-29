<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>JGEfectivo :: Consulta General de Incapacidades</title>
<link href="../estilo.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../calendar.js"></script>
</head>

<body>
<div id="calendarDiv"></div>

<?php include ("../conexion.php"); ?>
<form id="form1" name="form1" method="post" action="informeGeneralIncapacidad.php">
  <table width="1000" border="0" align="center">
    <tr>
      <td colspan="5">Consulta General de Incapacidades </td>
    </tr>
    <tr>
      <td width="186">&nbsp;</td>
      <td width="199">&nbsp;</td>
      <td width="12">&nbsp;</td>
      <td width="144">&nbsp;</td>
      <td width="333">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="5">Seleccione el Campo de Consulta </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Fecha Inicio </td>
      <td><input name="fechaini" type="text" id="fechaini" size="20" maxlength="10"  class="calendarSelectDate" /></td>
      <td>&nbsp;</td>
      <td>Fecha Terminaci&oacute;n </td>
      <td><input name="fechater" type="text" id="fechater" size="20" maxlength="10"  class="calendarSelectDate" /></td>
    </tr>
    <tr>
      <td>Fecha Proceso Inicio </td>
      <td><input name="fechaPInicio" type="text" id="fechaPInicio" size="20" maxlength="10"  class="calendarSelectDate" /></td>
      <td>&nbsp;</td>
      <td>Fecha Proceso Terminaci&oacute;n </td>
      <td><input name="fechaPTerminacion" type="text" id="fechaPTerminacion" size="20" maxlength="10"  class="calendarSelectDate" /></td>
    </tr>
    <tr>
      <td>C&eacute;dula</td>
      <td><input name="cedemple" type="text" id="cedemple" size="20" maxlength="10" /></td>
      <td>&nbsp;</td>
      <td>Codigo Incapacidad </td>
      <td><input name="nroinca" type="text" id="nroinca" size="20" maxlength="10" /></td>
    </tr>
    <tr>
      <td>Eps</td>
      <td><select name="codeps" id="codeps">
	  		<option value ="">
	  		<?php 
				$consulta = "select codeps, eps from eps order by eps";
				$resultado = mysql_query ($consulta);
				while ($reg = mysql_fetch_array ($resultado))	{¨
			?>
		  <option value="<?php echo $reg ["codeps"];?>"><?php echo $reg ["eps"];?>
			<?php	}	?>
      </select>      </td>
      <td>&nbsp;</td>
      <td>Zona</td>
      <td><select name="codzona" id="codzona">
	  		<option value ="">
	  		<?php 
				$consulta = "select codzona, zona from zona  where estado = 'Activa' order by zona";
				$resultado = mysql_query ($consulta);
				while ($reg = mysql_fetch_array ($resultado))	{¨
			?>
		  <option value="<?php echo $reg ["codzona"];?>"><?php echo $reg ["zona"];?>
			<?php	}	?>	  
      </select></td>
    </tr>
    <tr>
      <td>Tipo Incapacidad </td>
      <td><select name="tipoinca" id="tipoinca">
        <option value ="">
        <?php 
				$consulta = "select tipoinca, concepto from tipoinca order by concepto";
				$resultado = mysql_query ($consulta);
				while ($reg = mysql_fetch_array ($resultado))	{
			?>
        </option>
        <option value="<?php echo $reg ["tipoinca"];?>"><?php echo $reg ["concepto"];?>
        <?php	}	?>
        </option>
      </select></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Estado</td>
      <td><select name="estado" id="estado">
	  <option value ="">
        <option value="cancelada">Cancelada</option>
        <option value="por cobrar">Por Cobrar</option>
		<option value="en transcr">En Transcripción</option>
                  </select></td>
      <td>&nbsp;</td>
      <td>Sucursal</td>
      <td><select name="codsucursal" id="codsucursal">
	  		<option value ="">
	  		<?php 
				$consulta = "select codsucursal, sucursal from sucursal order by sucursal";
				$resultado = mysql_query ($consulta);
				while ($reg = mysql_fetch_array ($resultado))	{¨
			?>
		  <option value="<?php echo $reg ["codsucursal"];?>"><?php echo $reg ["sucursal"];?>
			<?php	}	?>	  
      </select></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="5"><div align="center">
        <input type="submit" name="Submit" value="Consultar" />
      </div></td>
    </tr>
  </table>
</form>
</body>
</html>
