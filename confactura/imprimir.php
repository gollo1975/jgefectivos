<html>
        <head>
                <title>Impresion de Nota Crédito</title>
                <link rel="stylesheet" href="../formato.css" type="text/css">
                <script language="javascript">
                        function imprimir()
                        {
                                window.print()
                        }
                </script>
        </head>
        <body onload="imprimir()">  <!-- sirve para cargar la funcion de imprsion-->
               <?

                        include ("../conexion.php");
                        $consulta="select maestro.codmaestro,maestro.dvmaestro,sucursal.sucursal,sucursal.dirsucursal,notacredito.* from maestro,sucursal,zona,factura,notacredito
                        where  maestro.codmaestro=sucursal.codmaestro and
                             sucursal.codsucursal=zona.codsucursal and
                              zona.codzona=factura.codzona and
                              factura.nrofactura=notacredito.nrofactura and
                             notacredito.nronota='$nronota'";
                        $resultado=mysql_query($consulta) or die("consulta incorrecta 3");
                        $registros=mysql_num_rows($resultado);
                        if ($registros==0)
                        {
                ?>
                          <script language="javascript">
                            alert("No Existen notas de credito creadas a facturas")
                            history.back()
                          </script>
                <?
                        }
                        else
                        {
                           while ($filas=mysql_fetch_array($resultado))
                            {
                            $nit=number_format($filas["nit"],0);
                            $vlrsaldo=number_format($filas["vlrsaldo"],0);
                            $vlriva=number_format($filas["vlriva"],0);
                            $subtotal=number_format($filas["valor"],0);
                            $vlrtotal=number_format(($filas["vlrsaldo"]+$filas["vlriva"]),0);
                ?>
                              <table border="1" align="center" width="700">
                              <tr> <td>
                              <table border="0" align="center" width="700">
                                 <td class="cajas"><img src="../image/logounico.PNG" border="0" heigth="125" width="145"></td>
                                 <td colspan="5"><b>Nota Crédito:</b>&nbsp;&nbsp;<?echo $filas["nronota"];?></th>
                              </tr>
                               <tr><td colspan="16">--------------------------------------------------------------------------------------------------------------------------------- </td></tr>
                               <tr>
                                 <td colspan="16"class="cajas"><b>Nit/Cédula:</b>&nbsp;<?echo $nit;?>-<?echo $filas["dv"];?></td>
                               </tr>
                               <tr>
                                  <td colspan="16" class="cajas"><b>Cliente:</b>&nbsp;<?echo $filas["zona"];?></td>
                                </tr>
                                <tr>
                                  <td colspan="16" class="cajas"><b>Dirección:</b>&nbsp;<?echo $filas["direccion"];?></b>&nbsp;&nbsp;<b>Fecha_Proceso:</b>&nbsp;<?echo $filas["fecha"];?></td>
                                </tr>
                                <tr>
                                 <td  class="cajas"><b>Nro_Factura:</b>&nbsp;&nbsp;<?echo $filas["nrofactura"];?></td>
                                </tr>
                               <tr><td colspan="16">--------------------------------------------------------------------------------------------------------------------------------- </td></tr>
                                 <tr>
                                 <td colspan="16" class="cajas"><b>Concepto:&nbsp;</b><?echo $filas["nota"];?></td>
                                 </tr>
                                  <tr><td>&nbsp;</td></tr>
                                 <tr>
                                 <td colspan="16" class="cajas"><b>La suma(en Letras):&nbsp;</b><?echo $filas["letra"];?>&nbsp;PESOS ML.</td>
                                 </tr>
                                 <tr><td>&nbsp;</td></tr>
                                 <?if($vlrsaldo==0):
                                           ?>
                                           <tr>
                                             <td colspan="1" class="cajas"><td colspan="1" class="cajas"><div align="right"><b>Subtotal:</b>&nbsp;<?echo $subtotal;?>&nbsp;</div></td>
                                           </tr>
                                           <tr>
                                             <td colspan="1" class="cajas"><td colspan="1" class="cajas"><div align="right"><b>Iva:</b>&nbsp;&nbsp;<?echo $vlriva;?>&nbsp;</div></td>
                                           </tr>
                                           <tr>
                                             <td colspan="1" class="cajas"><td colspan="1" class="cajas"><div align="right"><b>Total:</b>&nbsp;&nbsp;<?echo $subtotal;?>&nbsp;</div></td>
                                           </tr>
                                   <?
                                   else:
                                   ?>
                                           <tr>
                                             <td colspan="1" class="cajas"><td colspan="1" class="cajas"><div align="right"><b>Subtotal:</b>&nbsp;<?echo $vlrsaldo;?>&nbsp;</div></td>
                                           </tr>
                                           <tr>
                                             <td colspan="1" class="cajas"><td colspan="1" class="cajas"><div align="right"><b>Iva:</b>&nbsp;&nbsp;<?echo $vlriva;?>&nbsp;</div></td>
                                           </tr>
                                           <tr>
                                             <td colspan="1" class="cajas"><td colspan="1" class="cajas"><div align="right"><b>Total:</b>&nbsp;&nbsp;<?echo $vlrtotal;?>&nbsp;</div></td>
                                           </tr>
                                   <?
                                   endif;
                                   ?>
                                <tr>
                                   <td class="cajas"><b>Firma y Sello:</b></td>
                                 </tr>
                                <?
                             }
                        }
                       ?>
                       </table></td> </tr>
                        </table>
                  </body>
</html>
