<? include("../conexion.php");
$FechaA=date("Y-m-d");
$ConE="select factura.nrofactura,zona.zona,zona.nitzona,factura.fechaini,factura.fechaven,factura.grantotal,factura.nsaldo from factura,zona
       where zona.codzona=factura.codzona and
             factura.nsaldo >0 and
             factura.fechaven <= '$FechaA' order by zona.zona";
$Res=mysql_query($ConE)or die ("Error en la exportacion de facturas");
$registro=mysql_affected_rows();
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Cartera  X Cacturas.xls");
header("Pragma: no-cache");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Expires: 0");
?>
<table border="0" align="center">
    <tr class="cajas">
         <td style='font-weight:bold;font-size:1.1em;'>Item</td>
         <td style='font-weight:bold;font-size:1.1em;'>Nro_Factura</td>
         <td style='font-weight:bold;font-size:1.1em;'>Nit</td>
         <td style='font-weight:bold;font-size:1.1em;'>Zona</td>
         <td style='font-weight:bold;font-size:1.1em;'>F_Proceso</td>
         <td style='font-weight:bold;font-size:1.1em;'>F_Vcto</td>
         <td style='font-weight:bold;font-size:1.1em;'>Vlr_Total</td>
         <td style='font-weight:bold;font-size:1.1em;'>Saldo</td>
   </tr>
   <?
   $i=1;
   while($filas_s=mysql_fetch_array($Res)):
        ?>
        <tr  class="cajas">
             <td><?echo $i;?></td>
             <td style='font-weight;font-size:0.9em;'><div align="left"><?echo $filas_s["nrofactura"];?></div></td>
             <td style='font-weight;font-size:0.9em;'><div align="left"><?echo $filas_s["nitzona"];?></div></td>
             <td width="440" style='font-weight;font-size:0.9em;'><?echo $filas_s["zona"];?></d>
             <td style='font-weight;font-size:0.9em;'><?echo $filas_s["fechaini"];?></d>
             <td style='font-weight;font-size:0.9em;'><?echo $filas_s["fechaven"];?></d>
             <td style='mso-number-format:"#,##0.00"''font-weight;font-size:0.9em;'><?echo $filas_s["grantotal"];?></td>
             <td style='mso-number-format:"#,##0.00"''font-weight;font-size:0.9em;'><?echo $filas_s["nsaldo"];?></td>
        </tr>
        <?
        $i=$i+1;
   endwhile;
   ?>
</table>
</body>
</html>
