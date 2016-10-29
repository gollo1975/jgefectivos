<html>
<img src="image/reportes.png" title="Exportar Archivos">
 <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
<table width=20%>
<tr>
   <td>
      <div class="lbmenu">
         ¿Qué desea hacer?
      </div>
      <div class="itemmenu">
        <a href="ppal/exportarempleado.php?codigo=<? echo $xzona;?>">Empleados</a><br>
        <a href="ppal/exportarnomina.php?codigo=<? echo $xzona;?>">Nomina por fecha</a> <br>
        <a href="ppal/exportarprimas.php?codigo=<? echo $xzona;?>">Primas</a> <br>
        <a href="exportacion/planillaingreso.php?CodZ=<? echo $xzona;?>">Planilla de Nomina[Ingreso]</a> <br>
        <a href="exportacion/planilladeduccion.php?CodZ=<? echo $xzona;?>">Planilla de Nomina[Egreso]</a> <br>
        <a href="ppal/detallexportacionfactura.php?codzona=<? echo $xzona;?>">Anexo Factura Venta</a> <br>
        <a href="ppal/facturacosto.php?codzona=<? echo $xzona;?>">Centro de Costo</a> <br>
        <a href="exportacion/NovedadesNomina.php?codzona=<? echo $xzona;?>">Novedades  Nómina</a> <br> 
        <a href="ppal/retiroempleado.php?codzona=<? echo $xzona;?>">Empleados Retirados</a> <br>
		<a href="exportacion/ExportarIngresosZona.php?codzona=<? echo $xzona;?>">Ingreso empleados</a> <br>
      </div>
   </td>
</tr>

</table>

</html>
