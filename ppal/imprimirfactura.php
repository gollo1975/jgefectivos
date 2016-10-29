<html>
        <head>
                <title>Impresion de Factura</title>
                <LINK  REL="stylesheet" HREF="../formato.css"  type="text/css">
                <script language="javascript">
                        function imprimir()
                        {
                                window.print()
                        }
                </script>
        </head>
        <body onload="imprimir()">  <!-- sirve para cargar la funcion de impresion-->
                <?
                        include ("../conexion.php");
                        $consulta="select maestro.dirmaestro,maestro.telmaestro,maestro.faxmaestro,maestro.codmuni 'codigo',novedadq.nota,factura.nrofactura,factura.fechaini 'fechaopcional',factura.fechaven 'fechafinal',factura.fechagra,factura.iva 'ivatotal',factura.grantotal,factura.observacion,
                                factura.resolucion 'resolu',factura.inicio,factura.final,zona.*,factura.porcentaje,factura.rfte,factura.rteiva,factura.subtotal,sucursal.cuenta1,sucursal.cuenta2,sucursal.tipocta1,sucursal.tipocta2,sucursal.banco,sucursal.banco1,municipio.municipio from sucursal,factura,zona,novedadq,municipio,departamento,maestro
                                    where maestro.codmaestro=sucursal.codmaestro and
                                          sucursal.codsucursal=zona.codsucursal and
                                           sucursal.codmuni=municipio.codmuni and
                                           municipio.codepart=departamento.codepart and
                                          zona.codzona=factura.codzona and
                                          factura.nrofactura='$nrofactura'";
                        $resultado=mysql_query($consulta) or die("Error de Busqueda de Factura $consulta" );
                        $registros=mysql_num_rows($resultado);
                         while ($filas=mysql_fetch_array($resultado)):
                               $xgran=number_format($filas["grantotal"],2);
                              $subtotal=number_format($filas["subtotal"],2);
                               $IvaP=number_format($filas["porcentaje"],0);
                              $IvaG=$filas["ivatotal"];
                              $xiva=number_format($filas["ivatotal"],2);
                              $datofte=number_format($filas["rfte"],2);
                              $datorteiva=number_format($filas["rteiva"],2);
                              $Rfte=$filas["rfte"];
                              $codigo=$filas["codigo"];
                              $Rteiva=$filas["rteiva"];
                              $nota=$filas["observacion"];
                              $nota1=$filas["nota"];
                              $CodZona=$filas["codmuni"];
                              $nitzona=number_format($filas["nitzona"]);
                             /*codigo de muni*/
                              $conZ="select municipio.municipio 'Mzona' from municipio where municipio.codmuni='$CodZona' ";
                              $resZ=mysql_query($conZ)or dier("Error al buscar datos del municipio");
                              $filaZ=mysql_fetch_array($resZ);
                              $Xzona=$filaZ["Mzona"];
                              /*codigo de sucursal*/
                              $conM="select municipio.municipio 'Empresa',departamento.departamento 'Xdatos' from municipio,departamento where municipio.codepart=departamento.codepart and municipio.codmuni='$codigo' ";
                              $res=mysql_query($conM)or dier("Error al buscar datos del municipio");
                              $fila=mysql_fetch_array($res);
                              $MuEmpresa=$fila["Empresa"];
                              $Xdatos=$fila["Xdatos"];
                               ?>
                                        <table border="1" align="center" width="710" >
                                          <tr>
                                          <td>
                                          <table border="0" align="center" width="710"
                                          <td > <img src="../image/logocompleto.jpg" border="0" width="600" height="130"></td>
                                          <tr>
                                          <td colspan="30"><div align="right"><b>FACTURA DE VENTA</b>&nbsp;&nbsp;&nbsp;</div></td></tr>
                                          <tr><td colspan="30"><div align="right"><b>Nro:&nbsp;&nbsp;<? echo $filas["nrofactura"];?></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></td></tr>

                                          </table>
                                          <table border="0" align="center" width="710" >
                                             <tr>
                                               <td class="cajas" align="center"><b>Facturación por Computador:&nbsp;<?echo $filas["resolu"];?>&nbsp;</td>
                                             </tr>
                                             <tr>
                                              <td class="cajas" align="center"><b>Numeración:</b>&nbsp;<?echo $filas["inicio"];?>&nbsp;<b>al</b>&nbsp;<?echo $filas["final"];?></td></tr>
                                             </tr>
                                             <tr><td>&nbsp;</td></tr>
                                          <table border="1" align="center" width="710" >
                                            <tr><td>
                                             <table border="0" align="center" width="710" >
                                              <tr>
                                                     <td class="cajas" align="center"><b><u>Datos del Cliente[Empresa Usuaria]</u></b></td>
                                                  </tr>
                                                   <tr>
                                                   <td>------------------------------------------------------------------------------------------------------------------------------------</td>
                                                   </tr>
                                                  <tr>
                                                     <td class="cajas" colspan="16"><b>Cliente:&nbsp;</b><?echo $filas["zona"];?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Nit/Cedula:&nbsp;&nbsp;</b><?echo $nitzona;?>-<?echo $filas["dvzona"];?></td>
                                                  </tr>
                                                  <tr>
                                                      <td class="cajas"><b>Dirección:&nbsp;</b><?echo $filas["dirzona"];?>&nbsp;&nbsp;&nbsp;<b>Teléfono:</b>&nbsp;<?echo $filas["telzona"];?>&nbsp;&nbsp;<b>Municipio:</b>&nbsp;<?echo $Xzona;?>&nbsp;&nbsp;<b>Departamento:</b>&nbsp;<?echo $Xdatos;?></td>
                                                   </tr>
                                                   <tr>
                                                      <td class="cajas"><b>Fecha_Recibido:&nbsp;</b><?echo $filas["fechagra"];?>&nbsp;&nbsp;&nbsp;&nbsp;<b>Fecha_Expedición:</b>&nbsp;&nbsp;&nbsp;&nbsp;<?echo $filas["fechaopcional"];?>&nbsp;&nbsp;&nbsp;&nbsp;<b>Fecha_Vencimiento:</b>&nbsp;<?echo $filas["fechafinal"];?></td>
                                                   </tr>
                                                    </table>
                                                  </tr></td>
                                                 </table>
                                                  <?
                                           $con="select defactura.*,item.concepto from defactura,item
                                                  where defactura.nrofactura='$nrofactura' and
                                                  defactura.codcom=item.codcom order by defactura.codcom";
                                           $resu=mysql_query($con) or die("Error de Busqueda de Factura");
                                           $regi=mysql_num_rows($resu);
                                           if($regi==0):
                                              ?>
                                              <script language="javascript">
                                                alert("No hay detallado de facturas ?")
                                                history.back()
                                              </script>
                                              <?
                                           else:
                                             ?>
                                               <table border="0" align="center" width="710" >
                                               <tr>
                                               <td class="cajas" align="center" colspan="16"><b><u>Detalle de la Factura</u></b></td>
                                               <tr>
                                                 <tr>
                                                    <td><b><div align="left">&nbsp;&nbsp;Concepto</div></td>
                                                    <td><div align="center"><b>Cantidad</div></td>
                                                    <td><b><div align="right">Vlr_Unitario&nbsp;&nbsp;</div></td>
                                                    <td><div align="right"><b>Vlr_Total&nbsp;&nbsp;</b></div></td>
                                                 </tr>
                                               <?
                                                while($fila=mysql_fetch_array($resu)):
                                                 $aux=number_format($fila["vlruni"],0);
                                                 $aux1=number_format($fila["total"],0);
                                                 $aux2=number_format($fila["cantidad"],0);
                                                  ?>
                                                  <tr>
                                                    <td  class="cajas">&nbsp;&nbsp;<?echo $fila["concepto"];?></td>
                                                    <td align="center" class="cajas"><?echo $aux2;?></td>
                                                    <td align="right" class="cajas">$<?echo $aux;?>&nbsp;&nbsp;</td>
                                                     <td  align="right" class="cajas">$<?echo $aux1;?>&nbsp;&nbsp;</td>
                                                  </tr>
                                                  <?
                                                  $l=$l+1;
                                                endwhile;

                                                 if ($l==1):
                                                    ?>
                                                    <tr><td>&nbsp;</td></tr>
                                                    <tr><td>&nbsp;</td></tr>
                                                    <tr><td>&nbsp;</td></tr>
                                                    <tr><td>&nbsp;</td></tr>
                                                    <tr><td>&nbsp;</td></tr>
                                                    <tr><td>&nbsp;</td></tr>
                                                    <tr><td>&nbsp;</td></tr>
                                                 <?
                                                 else:
                                                   if ($l==2):
                                                    ?>
                                                    <tr><td>&nbsp;</td></tr>
                                                    <tr><td>&nbsp;</td></tr>
                                                    <tr><td>&nbsp;</td></tr>
                                                    <tr><td>&nbsp;</td></tr>
                                                    <tr><td>&nbsp;</td></tr>
                                                    <tr><td>&nbsp;</td></tr>
                                                   <?
                                                    else:
                                                      if ($l==3):
                                                            ?>
                                                           <tr><td>&nbsp;</td></tr>
                                                            <tr><td>&nbsp;</td></tr>
                                                            <tr><td>&nbsp;</td></tr>
                                                            <tr><td>&nbsp;</td></tr>
                                                            <tr><td>&nbsp;</td></tr>
                                                           <?
                                                      else:
                                                          if ($l==4):
                                                            ?>
                                                           <tr><td>&nbsp;</td></tr>
                                                            <tr><td>&nbsp;</td></tr>
                                                            <tr><td>&nbsp;</td></tr>
                                                            <tr><td>&nbsp;</td></tr>
                                                           <?
                                                           else:
                                                              if ($l==5):
                                                                ?>
                                                                 <tr><td>&nbsp;</td></tr>
                                                                 <tr><td>&nbsp;</td></tr>
                                                                 <tr><td>&nbsp;</td></tr>
                                                               <?
                                                               else:
                                                                 if ($l==6):
                                                                ?>
                                                                    <tr><td>&nbsp;</td></tr>
                                                                    <tr><td>&nbsp;</td></tr>
                                                                 <?
                                                                 else:
                                                                      if ($l==7):
                                                                        ?>
                                                                        <tr><td>&nbsp;</td></tr>
                                                                       <?
                                                                       endif;
                                                                 endif;
                                                               endif;
                                                           endif;
                                                      endif;
                                                    endif;
                                                 endif;
                                                 ?>
                                                  <tr>
                                                  <td colspan="40">------------------------------------------------------------------------------------------------------------------------------------</td>
                                                </tr>
                                                  <tr>
                                                    <td colspan="2"align="right" ><b>Subtotal:&nbsp;</b></td><td colspan="10"align="right" >$<?echo $subtotal;?></td>
                                                 </tr>
                                                 <tr>
                                                    <td colspan="2"align="right" ><b>Rete Fuente:&nbsp;</b></td><td colspan="10"align="right" >-$<?echo $datofte?></td>
                                                 </tr>
                                                 <tr>
                                                  <td colspan="2"align="right" ><b>Iva&nbsp(<?echo $IvaP;?>%):&nbsp;</b></td><td colspan="10"align="right" >$<?echo $xiva;?></td>
                                                 </tr>
                                                 <tr>
                                                 <td colspan="2"align="right" ><b>Rete Iva:&nbsp;</b></td><td colspan="10"align="right" >-$<?echo $datorteiva?></td>
                                                 </tr>
                                                 <tr>
                                                     <td colspan="2"align="right" ><b>Gran Total:&nbsp;</b></td><td colspan="10"align="right" >$<?echo $xgran;?></td>
                                                 </tr>
                                                 <tr>
                                                  <td colspan="40">------------------------------------------------------------------------------------------------------------------------------------</td>
                                                </tr>

                                                 <table border="0" align="center" width="710">
                                                   <tr class="cajas"><td><b>Observación:</b>&nbsp;<?echo $nota;?></td></tr>
                                                   <tr><td><br></td></tr>
                                                  <tr><td class="cajas"><b><u>Aceptada y Firmada:</u></b>&nbsp;________________________________________</td></tr>
                                                    <tr>
                                                  <td colspan="40">------------------------------------------------------------------------------------------------------------------------------------</td>
                                                </tr>
                                                   <tr class="cajas"><td><p align="justify"><u><b>Nota Importante:</b></u>&nbsp;<?echo $nota1;?></p></td></tr>
                                                 <tr>
                                                  <td colspan="40">---------------------------------------------------------<u><b>Casa Matriz<b></u>---------------------------------------------------------</td>
                                                </tr>
                                                  <tr>
                                                      <td class="cajas"><b>Dirección:</b>&nbsp;<?echo $filas["dirmaestro"];?><b>&nbsp;&nbsp;&nbsp;PBX:&nbsp;</b><?echo $filas["telmaestro"];?><b>&nbsp;&nbsp;&nbsp;Fax:&nbsp;</b><?echo $filas["faxmaestro"];?><b>&nbsp;&nbsp;&nbsp;Municipio:&nbsp;</b><?echo $MuEmpresa;?>&nbsp;&nbsp;<b>Depto:</b>&nbsp;</b><?echo $Xdatos;?></td>
                                                   </tr>
                                                   <tr>
                                                       <td class="cajas" align="center"><b>Cta:</b>&nbsp;<?echo $filas["tipocta1"];?>&nbsp;<b>Nro:&nbsp;</b><?echo $filas["cuenta1"];?><b>&nbsp;Banco:&nbsp;</b><?echo $filas["banco"];?>&nbsp;<b>Cta:&nbsp;</b><?echo $filas["tipocta2"];?>&nbsp;<b>Nro:</b>&nbsp;<?echo $filas["cuenta2"];?><b>&nbsp;Banco:&nbsp;</b><?echo $filas["banco1"];?></td>
                                                   <tr>
                                                 </table>

                                                </table>
                                                <?
                                           endif;
                                           ?>
                                           </tr></td>
                                          </table>
                                        </td></tr>
                                       </table>
                                       <?
                            //  endif;
                         endwhile;
                         ?>
        </body>
</html>
