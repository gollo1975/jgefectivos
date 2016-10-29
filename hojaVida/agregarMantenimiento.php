<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="../estilo.css" type="text/css" rel="stylesheet" />
<title>Documento sin t&iacute;tulo</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="procesos.php?opc=5">
  <table width="750" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td colspan="6"><strong>Mantenimientos de Equipos </strong></td>
    </tr>
	<tr>
      <td width="137">&nbsp;</td>
      <td colspan="5">&nbsp;</td>
    </tr>
	<tr>
      <td width="137"><a href="procesos.php?opc=2&amp;valor=<?php echo $_REQUEST["valor"]; ?>"><b><< Regresar</b></a></td>
      <td colspan="5">&nbsp;</td>
    </tr>
    <tr>
      <td width="137">&nbsp;</td>
      <td colspan="5">&nbsp;</td>
    </tr>
    <?php foreach ($procesoHV as $listarHV)	{	?>
    <tr>
      <td><strong>Equipo</strong></td>
      <td width="200"><a href="procesos.php?opc=2&amp;valor=<?php echo $listarHV -> codigoPC; ?>">
        <input name="codigoPC" type="text" id="codigoPC" value="<?php echo $listarHV -> codigoPC;?>" readonly />
      </a></td>
      <td width="95"><strong>Fecha</strong></td>
      <td width="121"><input name="fechaProceso" type="text" id="fechaProceso" size="10" value="<?php echo date("Y-m-d");?>" readonly="readonly" /></td>
      <td width="74">&nbsp;</td>
      <td width="119"><a href="procesos.php?opc=2&amp;valor=<?php echo $listarHV -> codigoPC; ?>"></a></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="5">&nbsp;</td>
    </tr>
    <tr>
      
        <td><strong>Responsable</strong></td>
        <td colspan="3"><input name="empleado" type="text" id="empleado" value="<?php echo $listarHV -> empleado;?>" size="40" />
        </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><strong>Tipo PC </strong></td>
      <td><input name="tipoPC" type="text" id="tipoPC" value="<?php echo $listarHV -> tipoPC;?>" />      </td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><strong>Fecha de Compra </strong></td>
      <td><input name="fechaCompra" type="text" id="fechaCompra" value="<?php echo $listarHV -> fechaCompra;?>" /></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><strong> CPU </strong></td>
      <td><input name="cpuMarca" type="text" id="cpuMarca" value="<?php echo $listarHV -> cpuMarca;?>" /></td>
      <td><strong>Descripcion CPU </strong></td>
      <td><input name="cpuDescripcion" type="text" id="cpuDescripcion" value="<?php echo $listarHV -> cpuDescripcion;?>" /></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><strong>RAM</strong></td>
      <td><input name="ram" type="text" id="ram" value="<?php echo $listarHV -> ram;?>" /></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><strong>DD</strong></td>
      <td><input name="ddMarca" type="text" id="ddMarca" value="<?php echo $listarHV -> ddMarca;?>" /></td>
      <td><strong>Capacidad</strong></td>
      <td><input name="ddCapacidad" type="text" id="ddCapacidad" value="<?php echo $listarHV -> ddCapacidad;?>" /></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><strong>Pantalla </strong></td>
      <td><input name="monitorMarca" type="text" id="monitorMarca" value="<?php echo $listarHV -> monitorMarca;?>" /></td>
      <td><strong>Tama&ntilde;o</strong></td>
      <td><input name="monitorTamano" type="text" id="monitorTamano" value="<?php echo $listarHV -> monitorTamano;?>" /></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><strong>Impresora </strong></td>
      <td><input name="impresoraMarca" type="text" id="impresoraMarca" value="<?php echo $listarHV -> impresoraMarca;?>" /></td>
      <td><strong>Tipo</strong></td>
      <td><input name="impresoraTipo" type="text" id="impresoraTipo" value="<?php echo $listarHV -> impresoraTipo;?>" /></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><strong> Scanner </strong></td>
      <td><input name="scannerMarca" type="text" id="scannerMarca" value="<?php echo $listarHV -> scannerMarca;?>" /></td>
      <td><strong>Tipo</strong></td>
      <td><input name="scannerTipo" type="text" id="scannerTipo" value="<?php echo $listarHV -> scannerTipo;?>" /></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><strong>Copiadora</strong></td>
      <td><input name="copiadora" type="text" id="copiadora" value="<?php echo $listarHV -> copiadora;?>" /></td>
      <td><strong>Tel&eacute;fono</strong></td>
      <td><input name="telefono" type="text" id="telefono" value="<?php echo $listarHV -> telefono;?>" /></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><strong>Diadema</strong></td>
      <td><input name="diadema" type="text" id="diadema" value="<?php echo $listarHV -> diadema;?>" /></td>
      <td><strong>Parlantes</strong></td>
      <td><input name="parlantes" type="text" id="parlantes" value="<?php echo $listarHV -> parlantes;?>" /></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><strong>Teclado</strong></td>
      <td><input name="teclado" type="text" id="teclado" value="<?php echo $listarHV -> teclado;?>" /></td>
      <td><strong>Mouse</strong></td>
      <td><input name="mouse" type="text" id="mouse" value="<?php echo $listarHV -> mouse;?>" /></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><strong>USB</strong></td>
      <td><input name="usbMarca" type="text" id="usbMarca" value="<?php echo $listarHV -> usbMarca;?>" /></td>
      <td><strong>Capacidad</strong></td>
      <td><input name="usbCapacidad" type="text" id="usbCapacidad" value="<?php echo $listarHV -> usbCapacidad;?>" /></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><strong>SD</strong></td>
      <td><input name="sdMarca" type="text" id="sdMarca" value="<?php echo $listarHV -> sdMarca;?>" /></td>
      <td><strong>Capacidad</strong></td>
      <td><input name="sdCapacidad" type="text" id="sdCapacidad" value="<?php echo $listarHV -> sdCapacidad;?>" /></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><strong>Base Portatil </strong></td>
      <td><input name="basePortatil" type="text" id="basePortatil" value="<?php echo $listarHV -> basePortatil;?>" /></td>
      <td><strong>Audio</strong></td>
      <td><input name="equipoAudio" type="text" id="equipoAudio" value="<?php echo $listarHV -> equipoAudio;?>" /></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><strong>Camara</strong></td>
      <td><input name="camara" type="text" id="camara" value="<?php echo $listarHV -> camara;?>" /></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><strong>Movil</strong></td>
      <td><input name="movilMarca" type="text" id="movilMarca" value="<?php echo $listarHV -> movilMarca;?>" /></td>
      <td><strong>Operador</strong></td>
      <td><input name="movilOperador" type="text" id="movilOperador" value="<?php echo $listarHV -> movilOperador;?>" /></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><strong>Radio</strong></td>
      <td><input name="radio" type="text" id="radio" value="<?php echo $listarHV -> radio;?>" /></td>
      <td><strong>Regulador</strong></td>
      <td><input name="regulador" type="text" id="regulador" value="<?php echo $listarHV -> regulador;?>" /></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><strong>UPS</strong></td>
      <td><input name="ups" type="text" id="ups" value="<?php echo $listarHV -> ups;?>" /></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <?php 	}	?>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><strong>Descripci&oacute;n de </strong></td>
      <td>&nbsp;</td>
      <td colspan="4" rowspan="2"><textarea name="descripcion" cols="40" rows="5" id="descripcion"></textarea></td>
    </tr>
    <tr>
      <td><strong>Cambios</strong></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
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
    </tr>
    <tr>
      <td colspan="6"><label>
        <input type="submit" name="Submit" value="Actualizar" />
      </label></td>
    </tr>
  </table>
</form>
</body>
</html>
