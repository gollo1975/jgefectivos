<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<link rel="stylesheet" type="text/css" href="../estilo.css"  />
</head>

<body>
	<?php foreach ($procesoHV as $listarHV)	{	?>
<table width="750" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="3"><a href="procesos.php?opc=1"><b><< Regresar</b></a></td>
  </tr>
  <tr>
    <td width="75">&nbsp;</td>
    <td width="117">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><strong>Listado de Especifico de Hoja de Vida </strong></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><a href="procesos.php?opc=3&amp;valor=<?php echo $listarHV -> codigoPC;?>"><img src="editar.png" width="25" height="25" border = "0"/></a></td>
  </tr>
  <tr>
    <td width="96">&nbsp;</td>
    <td width="277">&nbsp;</td>
    <td colspan="5">&nbsp;</td>
  </tr>
  <tr>
    <td><strong>C&oacute;digo PC </strong></td>
    <td><a href="procesos.php?opc=2&valor=<?php echo $listarHV -> codigoPC; ?>"><?php echo $listarHV -> codigoPC; ?></a></td>
    <td width="106"><strong>Fecha Entrega</strong></td>
    <td width="267" colspan="4"><?php echo $listarHV -> fechaEntrega; ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="4">&nbsp;</td>
  </tr>

    <tr>
      <td><strong>Responsable</strong></td>
      <td><?php echo $listarHV -> empleado; ?></td>
      <td><strong>Area</strong></td>
      <td colspan="4"><?php echo $listarHV -> area;?></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="4">&nbsp;</td>
    </tr>
    <tr>
      <td><strong>Tipo PC </strong></td>
      <td><?php echo $listarHV -> tipoPC; ?></td>
      <td>&nbsp;</td>
      <td colspan="4">&nbsp;</td>
    </tr>
    <tr>
      <td><strong> CPU </strong></td>
      <td><?php echo $listarHV -> cpuMarca; ?></td>
      <td><strong>Descripcion CPU </strong></td>
      <td colspan="4"><?php echo $listarHV -> cpuDescripcion; ?></td>
    </tr>
    <tr>
      <td><strong>RAM</strong></td>
      <td><?php echo $listarHV -> ram; ?></td>
      <td>&nbsp;</td>
      <td colspan="4">&nbsp;</td>
    </tr>
    <tr>
      <td><strong>DD</strong></td>
      <td><?php echo $listarHV -> ddMarca; ?></td>
      <td><strong>Capacidad</strong></td>
      <td colspan="4"><?php echo $listarHV -> ddCapacidad; ?></td>
    </tr>
  <tr>
    <td><strong>Pantalla </strong></td>
    <td><?php echo $listarHV -> monitorMarca; ?></td>
    <td><strong>Tama&ntilde;o</strong></td>
    <td colspan="4"><?php echo $listarHV -> monitorTamano; ?></td>
  </tr>
  <tr>
    <td><strong>Impresora </strong></td>
    <td><?php echo $listarHV -> impresoraMarca; ?></td>
    <td><strong>Tipo</strong></td>
    <td colspan="4"><?php echo $listarHV -> impresoraTipo; ?></td>
  </tr>
  <tr>
    <td><strong> Scanner </strong></td>
    <td><?php echo $listarHV -> scannerMarca; ?></td>
    <td><strong>Tipo</strong></td>
    <td colspan="4"><?php echo $listarHV -> scannerTipo; ?></td>
  </tr>
  <tr>
    <td><strong>Copiadora</strong></td>
    <td><?php echo $listarHV -> copiadora; ?></td>
    <td><strong>Tel&eacute;fono</strong></td>
    <td colspan="4"><?php echo $listarHV -> telefono; ?></td>
  </tr>
  <tr>
    <td><strong>Diadema</strong></td>
    <td><?php echo $listarHV -> diadema; ?></td>
    <td><strong>Parlantes</strong></td>
    <td colspan="4"><?php echo $listarHV -> parlantes; ?></td>
  </tr>
  <tr>
    <td><strong>Teclado</strong></td>
    <td><?php echo $listarHV -> teclado; ?></td>
    <td><strong>Mouse</strong></td>
    <td colspan="4"><?php echo $listarHV -> mouse; ?></td>
  </tr>
  <tr>
    <td><strong>USB</strong></td>
    <td><?php echo $listarHV -> usbMarca; ?></td>
    <td><strong>Capacidad</strong></td>
    <td colspan="4"><?php echo $listarHV -> usbCapacidad; ?></td>
  </tr>
  <tr>
    <td><strong>SD</strong></td>
    <td><?php echo $listarHV -> sdMarca; ?></td>
    <td><strong>Capacidad</strong></td>
    <td colspan="4"><?php echo $listarHV -> sdCapacidad; ?></td>
  </tr>
  <tr>
    <td><strong>Base Portatil </strong></td>
    <td><?php echo $listarHV -> basePortatil; ?></td>
    <td><strong>Audio</strong></td>
    <td colspan="4"><?php echo $listarHV -> equipoAudio; ?></td>
  </tr>
  <tr>
    <td><strong>Camara</strong></td>
    <td><?php echo $listarHV -> camara; ?></td>
    <td>&nbsp;</td>
    <td colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Movil</strong></td>
    <td><?php echo $listarHV -> movilMarca; ?></td>
    <td><strong>Operador</strong></td>
    <td colspan="4"><?php echo $listarHV -> movilOperador; ?></td>
  </tr>
  <tr>
    <td><strong>Radio</strong></td>
    <td><?php echo $listarHV -> radio; ?></td>
    <td><strong>Regulador</strong></td>
    <td colspan="4"><?php echo $listarHV -> regulador; ?></td>
  </tr>
  <tr>
    <td><strong>UPS</strong></td>
    <td><?php echo $listarHV -> ups; ?></td>
    <td>&nbsp;</td>
    <td colspan="4">&nbsp;</td>
  </tr>
	<?php	}	?>
</table>
<p>&nbsp;</p>
<table width="750" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2"><strong>Especificos</strong></td>
  </tr>
  <tr>
    <td width="306">&nbsp;</td>
    <td width="440">&nbsp;</td>
  </tr>
  <?php foreach ($procesoHHV as $listarHHV)	{	?>
  <tr>
    <td><strong>Fecha</strong></td>
    <td><?php echo $listarHHV -> fechaProceso; ?></td>
  </tr>
  <tr>
    <td><strong>Descripci&oacute;n</strong></td>
    <td><?php echo $listarHHV -> descripcion; ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <?php }	?>
</table>
<p>&nbsp;</p>
</body>
</html>
