<html>

<head>
  <title>Facturas de Venta</title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
 </head>

<?
  if (!isset($desde)):
    ?>
          <center><h4><u>Facturas de Venta</u></h4></center>
        <form action="" method="post" width="200" id="f1" name="f1">
            <table border="0" align="center">
            <tr><td><br></td></tr>
           <tr>
            <td><b>Desde:</b></td>
            <td colspan="3"><input type="text" name="desde" value="<? echo date("Y-m-d");?>" size="12" class="cajas" maxlegth="10" id="desde"></td>
            <td><b>Hasta:</b></td>
            <td colspan="3"><input type="text" name="hasta" value="<? echo date("Y-m-d");?>" size="12" class="cajas" maxlegth="10" id="hasta"></td>
          </tr>
             <tr><td><br></td></tr>
           <tr>
            <td colspan="5">
              <input type="submit" value="Buscar" class="boton">
            </td>
          </tr>
        </table></td></tr>
        </table>
        </form>
<?
elseif (empty($desde)):
?>
  <script language="javascript">
    alert ("Error en la fecha de Inicio ?")
    history.back()
  </script>
    <?
else:
include ("../conexion.php");
      $consu="select zona.zona from zona
                where zona.codzona='$codigo'";
                 $resulta=mysql_query($consu) or die("consulta incorrecta 1  ");
                 while ($filas_s=mysql_fetch_array($resulta)):
                      ?>
                     <table border="0" align="center">
                     <tr>
                       <td colspan="2"><? echo $filas_s["zona"];?></td>
                     </tr>
                    </table>
                 <?
                endwhile;
                $consulta="select factura.* from factura,zona
                 where zona.codzona=factura.codzona and
                factura.fechaini between '$desde' and '$hasta' and
                 zona.codzona='$codigo'";
                 $resultado=mysql_query($consulta) or die("consulta incorrecta 3 ");
                 $registros=mysql_num_rows($resultado);
                  if($registros!=0):
                     ?>
                     <center><h4><u>Listado de Facturas</u></h4></center>
                     <table border="0" align="center">
                       <tr class="cajas">
                         <td>Para Ver el datallado de la Factura, Presione Click sobre el NRO_SERVICIO..</td>
                      </tr>
                     </table>
                      <table border="0" align="center">
                       <tr class="cajas">
                         <td>Para Ver los recibos de Pagos, Presione Click sobre el NRO_FACTURA..</td>
                      </tr>
                     </table>

                       <table border="0" align="center" >
                         <tr >
                           <th class="cajas">Item</th>
                           <th class="cajas">Nro_Servicio</th>
                            <th class="cajas">Nro_Factura</th>
                            <th class="cajas">Desde</th>
                            <th class="cajas">&nbsp;Hasta</th>
                            <th class="cajas">&nbsp;&nbsp;Fecha_Pro.</th>
                             <th class="cajas">&nbsp;&nbsp;SubTotal</th>
                            <th class="cajas">&nbsp;&nbsp;Iva</th>
                            <th class="cajas">&nbsp;&nbsp;Gran Total</th>
                             <th class="cajas">&nbsp;&nbsp;Saldo</td>
                            <th class="cajas">&nbsp;&nbsp;Estado</td>

                        <?
                        $l=1;
                          while ($filas=mysql_fetch_array($resultado)):
                          $subtotal=number_format($filas["subtotal"],0);
                          $iva=number_format($filas["iva"],0);
                          $grantotal=number_format($filas["grantotal"],0);
                          $nsaldo=number_format($filas["nsaldo"],0);
                            ?>
                            <tr class="cajas">
                              <th><?echo $l;?></th>
                              <td><a href="../facturar/imprimirdetallecaja.php?codigo=<? echo $filas["codigo"];?>"><? echo $filas["codigo"];?></a></td>
                               <td>&nbsp;<a href="informerecibo.php?nrofactura=<? echo $filas["nrofactura"];?>"><? echo $filas["nrofactura"];?></a></td>
                              <td>&nbsp;<? echo $filas["fechaini"];?></td>
                              <td>&nbsp;&nbsp;<? echo $filas["fechaven"];?></td>
                              <td>&nbsp;&nbsp;<? echo $filas["fechagra"];?></td>
                              <td>&nbsp;&nbsp;<? echo $subtotal;?></td>
                              <td>&nbsp;&nbsp;<? echo $iva;?></td>
                              <td>&nbsp;&nbsp;<? echo $grantotal;?></td>
                              <td>&nbsp;&nbsp;<? echo $nsaldo;?></td>
                              <td>&nbsp;&nbsp;<? echo $filas["estado"];?></td>
                            </tr>
                            <?
                            $l=$l+1;
                            $aux=$aux+$filas["subtotal"];
                            $aux1=$aux1+$filas["iva"];
                            $aux2=$aux2+$filas["grantotal"];
                            $suma=$suma+$filas["nsaldo"];
                            endwhile;
                            $suma=number_format($suma,0);
                            $aux=number_format($aux,0);
                            $aux1=number_format($aux1,0);
                            $aux2=number_format($aux2,0);
                            ?>
                            </table>
                            <tr>
                              <center><td class="cajas"><b>Subtotal:</b>&nbsp;<?echo $aux;?><b>&nbsp;Total Iva:</b>&nbsp;<?echo $aux1;?><b>&nbsp;Gran Total:</b>&nbsp;<?echo $aux2;?><b>&nbsp;Total Cartera:</b>&nbsp;<?echo $suma;?></td></center>
                            </tr>
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
