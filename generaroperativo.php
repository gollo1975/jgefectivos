<html>
<img src="image/empresas.png" title="Administrar Información">

<table width=20%>
<tr>
   <td>
      <div class="lbmenu">
         ¿Qué desea hacer?
      </div>
      <div class="itemmenu">
         <a href="compensacion/menu.php">Item Factura</a> <br>
         <a href="factura/ProcesoFacturacion.php">Factura de Venta</a> <br>
         <a href="factura/Modificar.php">Modificar Factura Venta</a> <br>
         <a href="nomina/periodo.php">Periodo de Nómina</a><br>
         <a href="facturar/menu.php">Facturar Servicio</a> <br>
         <a href="extractofactura/agregar.php">Detallado de Factura_Venta</a><br>
         <a href="defactura/menu.php">Item Detallado</a><br>
         <?if ($Auxiliar==''):?>
              <a href="nomina/menu1.php">Nómina</a><br>
         <?else:?>
            <a href="nomina/MenuAuxiliar.php?Auxiliar=<?echo $Auxiliar;?>">Nómina</a><br>
         <?endif;?>
          <a href="empacadores/menu.php">Empacadores</a><br>
         <a href="facturar/menu.php">Facturar Servicio</a> <br>
         <a href="defactura/menu.php">Item Detallado</a><br>
       </div>
   </td>
</tr>
</table>

</html>
