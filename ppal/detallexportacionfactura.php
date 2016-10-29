<html>

<head>
  <title>Exportar detallado del servicio</title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
 </head>

<?
  if (!isset($desde)):

  ?>
  <center><h4><u>Detalle de Servicio</u></h4></center>
<form action="" method="post" width="200">
    <table border="0" align="center">
    <tr><td><br></td></tr>
   <tr>
    <td><b>Desde:</b></td>
    <td colspan="3"><input type="text" name="desde" value="<? echo date("Y-m-d");?>" size="12" maxlength="10" id="desde"></td>
    <td><b>Hasta:</b></td>
    <td colspan="3"><input type="text" name="hasta" value="<? echo date("Y-m-d");?>" size="12" maxlength="10" id="hasta"></td>
  </tr>
  <tr>
     <tr><td><br></td></tr>
   <tr>
    <td colspan="5">
      <input type="submit" value="Buscar" class="boton">
      <input type="reset" value="Limpiar" class="boton">
    </td>
  </tr>
</table></td></tr>
</table>
</form>
<?
elseif (empty($desde)):
?>
  <script language="javascript">
    alert ("Digite la fecha de inic ?")
    history.back()
  </script>
    <?
else:
include ("../conexion.php");
      $consu="select zona.zona,zona.prestacion,zona.caja,zona.admon,zona.vacacion,zona.iva,sucursal.banco,sucursal.banco1,sucursal.cuenta1,sucursal.cuenta2,sucursal.tipocta1,sucursal.tipocta2 from zona,sucursal
                where sucursal.codsucursal=zona.codsucursal and zona.codzona='$codzona'";
                 $resulta=mysql_query($consu) or die("consulta incorrecta 1  ");
                 while ($filas_s=mysql_fetch_array($resulta)):
                     $ivag=$filas_s["iva"];
                     $cuenta1=$filas_s["cuenta1"];
                     $cuenta2=$filas_s["cuenta2"];
                     $valor=$filas_s["tipocta1"];
                     $valor1=$filas_s["tipocta2"];
                     $presta=$filas_s["prestacion"];
                     $vacacion=$filas_s["vacacion"];
                     $caja=$filas_s["caja"];
                     $admon1=$filas_s["admon"];
                     $arp=$filas_s["ss"];
                     $arp=$filas_s["vlreps"];
                     $arp=$filas_s["vlrpension"];
                     $banco=$filas_s["banco"];
                     $banco1=$filas_s["banco1"];
                       ?>
                      <td><input type="hidden" name="valor" value="<? echo $filas_s["tipocta1"];?>"></td>
                      <td><input type="hidden" name="valor1" value="<? echo $filas_s["tipocta2"];?>"></td>
                     <table border="0" align="center">
                     <tr>
                       <td colspan="2"><? echo $filas_s["zona"];?></td>
                     </tr>
                    </table>
                 <?
                endwhile;
                $consulta="select cobrozona.* from cobrozona,zona
                 where zona.codzona=cobrozona.codzona and
                 cobrozona.desde between '$desde' and '$hasta' and
                 zona.codzona='$codzona'";
                 $resultado=mysql_query($consulta) or die("consulta incorrecta 3 ");
                 $registros=mysql_num_rows($resultado);
                  if($registros!=0):
                     ?>
                     <center><h4>Listado de Servicio</h4></center>
                     <table border="0" align="center">
                       <tr class="cajas">
                         <td>Para exportar el [DETALLE DEL SERVICIO], Presione Click sobre el Nro_Servicio..</td>
                       </tr>
                     </table>
                       <table border="0" align="center" >
                         <tr class="cajas">
                            <th>Nro_Servicio</th>
                            <th>&nbsp;&nbsp;Desde</th>
                            <th>&nbsp;&nbsp;Hasta</th>
                            <th>&nbsp;&nbsp;Fecha_Pro.</th>
                            <th>&nbsp;&nbsp;Total</th>
                            <th>&nbsp;&nbsp;Incapacidad</th>
                            <th>&nbsp;&nbsp;Anticipo</th>
                            <th>&nbsp;&nbsp;Otros Dcto</th>
                            <th>&nbsp;&nbsp;Ajuste</td>
                            <th>&nbsp;&nbsp;Menor Vlr</th>
                            <th>&nbsp;&nbsp;Subtotal</th>
                            <th>&nbsp;&nbsp;Iva</th>
                            <th>&nbsp;&nbsp;Gran Total</th>
                         <?
                          while ($filas=mysql_fetch_array($resultado)):
                            ?>
                              <tr class="cajas">
							  <td><a href="../exportacion/detalladozonaconsulta.php?codigo=<? echo $filas["codigo"];?>&campo=<?echo $codzona;?>&admon1=<?echo $admon1;?>&social1=<?echo $social1;?>&ivag=<? echo $ivag;?>&valor=<?echo $valor;?>&valor1=<?echo $valor1;?>&cuenta1=<? echo $cuenta1;?>&cuenta2=<? echo $cuenta2;?>&presta=<? echo $presta;?>&caja=<? echo $caja;?>&banco=<? echo $banco;?>&banco1=<? echo $banco1;?>"><? echo $filas["codigo"];?></a></td>
                              <td>&nbsp;&nbsp;<? echo $filas["desde"];?></td>
                              <td>&nbsp;&nbsp;<? echo $filas["hasta"];?></td>
                              <td>&nbsp;&nbsp;<? echo $filas["fechap"];?></td>
                              <td>&nbsp;&nbsp;<? echo $filas["total"];?></td>
                              <td>&nbsp;&nbsp;<? echo $filas["incapacidad"];?></td>
                              <td>&nbsp;&nbsp;<? echo $filas["anticipo"];?></td>
                              <td>&nbsp;&nbsp;<? echo $filas["otros"];?></td>
                              <td>&nbsp;&nbsp;<? echo $filas["ajuste"];?></td>
                              <td>&nbsp;&nbsp;<? echo $filas["menorvlr"];?></td>
                              <td>&nbsp;&nbsp;<? echo $filas["subtotal"];?></td>
                              <td>&nbsp;&nbsp;<? echo $filas["ivatotal"];?></td>
                              <td>&nbsp;&nbsp;<? echo $filas["grantotal"];?></td>
                            </tr>
                            <?
                            endwhile;
                            ?>
                            </table>
                            <?
                   else:
                      ?>
                         <script language="javascript">
                            alert("No hay registros De Facturacion para esta Zona ?")
                            history.back()
                         </script>
                         <?
                   endif;
  endif;
       ?>


</body>
</html>
