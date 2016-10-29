<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="../estilo.css" type="text/css" rel="stylesheet" />
<title>Documento sin t&iacute;tulo</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="procesos.php?opc=10">
  <table width="750" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr>
		<td><a href="index.php"><b><< Regresar</b></a></td>
	</tr>
	<tr>
		<td><a href="index.php"><b>&nbsp;</a></td>
	</tr>
    <tr>
      <td colspan="6"><strong>Mantenimientos de Equipos </strong></td>
    </tr>
    <tr>
      <td width="125">&nbsp;</td>
      <td colspan="5">&nbsp;</td>
    </tr>
    <tr>
      <td><strong>Equipo</strong></td>
      <td width="240"><input name="codigoPC" type="text" id="codigoPC" /></td>
      <td width="128"><strong>Fecha</strong></td>
      <td width="77"><input name="fechaProceso" type="text" id="fechaProceso" value="<?php echo date("Y-m-d");?>" size="20" maxlength="10" readonly="readonly" /></td>
      <td width="66">&nbsp;</td>
      <td width="110"><a href="procesos.php?opc=2&amp;valor=<?php echo $listarHV -> codigoPC; ?>"></a></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="5">&nbsp;</td>
    </tr>
    <tr>
      <td><strong>Fecha de Compra </strong></td>
      <td colspan="5"><input name="fechaCompra" type="text" id="fechaCompra" value="<?php echo date("Y-m-d");?>" size="20" maxlength="10" /></td>
    </tr>
    <tr>
  
        <td><strong>Responsable</strong></td>
        <td colspan="3"><input name="empleado" type="text" id="empleado" size="40" />        </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><strong>Area</strong></td>
      <td><input name="area" type="text" id="area" size="40" /></td>
      <td>&nbsp;</td>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td><strong>Tipo PC </strong></td>
      <td><input name="tipoPC" type="text" id="tipoPC" />      </td>
      <td>&nbsp;</td>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td><strong> CPU </strong></td>
      <td><input name="cpuMarca" type="text" id="cpuMarca" /></td>
      <td><strong>Descripcion CPU </strong></td>
      <td colspan="3"><input name="cpuDescripcion" type="text" id="cpuDescripcion" /></td>
    </tr>
    <tr>
      <td><strong>RAM</strong></td>
      <td><input name="ram" type="text" id="ram" /></td>
      <td>&nbsp;</td>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td><strong>DD</strong></td>
      <td><input name="ddMarca" type="text" id="ddMarca" /></td>
      <td><strong>Capacidad</strong></td>
      <td colspan="3"><input name="ddCapacidad" type="text" id="ddCapacidad" /></td>
    </tr>
    <tr>
      <td><strong>Pantalla </strong></td>
      <td><input name="monitorMarca" type="text" id="monitorMarca" /></td>
      <td><strong>Tama&ntilde;o</strong></td>
      <td colspan="3"><input name="monitorTamano" type="text" id="monitorTamano" /></td>
    </tr>
    <tr>
      <td><strong>Impresora </strong></td>
      <td><input name="impresoraMarca" type="text" id="impresoraMarca" /></td>
      <td><strong>Tipo</strong></td>
      <td colspan="3"><input name="impresoraTipo" type="text" id="impresoraTipo" /></td>
    </tr>
    <tr>
      <td><strong> Scanner </strong></td>
      <td><input name="scannerMarca" type="text" id="scannerMarca" /></td>
      <td><strong>Tipo</strong></td>
      <td colspan="3"><input name="scannerTipo" type="text" id="scannerTipo" /></td>
    </tr>
    <tr>
      <td><strong>Copiadora</strong></td>
      <td><input name="copiadora" type="text" id="copiadora" /></td>
      <td>&nbsp;</td>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td><strong>Tel&eacute;fono</strong></td>
      <td><input name="telefono" type="text" id="telefono" /></td>
      <td>&nbsp;</td>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td><strong>Diadema</strong></td>
      <td><input name="diadema" type="text" id="diadema" /></td>
      <td>&nbsp;</td>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td><strong>Parlantes</strong></td>
      <td><input name="parlantes" type="text" id="parlantes" /></td>
      <td>&nbsp;</td>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td><strong>Teclado</strong></td>
      <td><input name="teclado" type="text" id="teclado" /></td>
      <td><strong>Mouse</strong></td>
      <td colspan="3"><input name="mouse" type="text" id="mouse" /></td>
    </tr>
    <tr>
      <td><strong>USB</strong></td>
      <td><input name="usbMarca" type="text" id="usbMarca" /></td>
      <td><strong>Capacidad</strong></td>
      <td colspan="3"><input name="usbCapacidad" type="text" id="usbCapacidad" /></td>
    </tr>
    <tr>
      <td><strong>SD</strong></td>
      <td><input name="sdMarca" type="text" id="sdMarca" /></td>
      <td><strong>Capacidad</strong></td>
      <td colspan="3"><input name="sdCapacidad" type="text" id="sdCapacidad" /></td>
    </tr>
    <tr>
      <td><strong>Base Portatil </strong></td>
      <td><input name="basePortatil" type="text" id="basePortatil" /></td>
      <td>&nbsp;</td>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td><strong>Audio</strong></td>
      <td><input name="equipoAudio" type="text" id="equipoAudio" /></td>
      <td>&nbsp;</td>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td><strong>Camara</strong></td>
      <td><input name="camara" type="text" id="camara" /></td>
      <td>&nbsp;</td>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td><strong>Movil</strong></td>
      <td><input name="movilMarca" type="text" id="movilMarca" /></td>
      <td><strong>Operador</strong></td>
      <td colspan="3"><input name="movilOperador" type="text" id="movilOperador" /></td>
    </tr>
    <tr>
      <td><strong>Radio</strong></td>
      <td><input name="radio" type="text" id="radio" /></td>
      <td><strong>Regulador</strong></td>
      <td colspan="3"><input name="regulador" type="text" id="regulador" /></td>
    </tr>
    <tr>
      <td><strong>UPS</strong></td>
      <td><input name="ups" type="text" id="ups" /></td>
      <td>&nbsp;</td>
      <td colspan="3">&nbsp;</td>
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
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="6"><label>
        <input type="submit" name="Submit" value="Almacenar" />
      </label></td>
    </tr>
  </table>
</form>
</body>
</html>
