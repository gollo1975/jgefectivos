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
        <body onLoad="imprimir()">  <!-- sirve para cargar la funcion de imprsion-->
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
                        if ($registros==0):
                        
                ?>
                          <script language="javascript">
                            alert("No Existen notas de credito creadas a facturas")
                            history.back()
                          </script>
                <?
                        else:
                           while ($filas=mysql_fetch_array($resultado)):
                            $ValorP=$filas["vlreteiva"] + $filas["vlrfte"];
                            $ValorPagar=($filas["valor"]+ $filas["vlrbase"]);
                            $nit=number_format($filas["nit"],0);
                            $vlreteiva=number_format($filas["vlreteiva"],0);
                            $vlriva=number_format($filas["vlriva"],0);
                            $subtotal=number_format($filas["subtotal"],0);
                            $vlrfte=number_format($filas["vlrfte"],0);
                            $vlrcre=number_format($filas["vlrcre"],0);
                           $valor=number_format($filas["valor"],0);
                           $BaseD=number_format($filas["valorbase"],0);
                           $Total=number_format($ValorPagar,0);
                ?>
                              <table border="1" align="center" width="700">
                              <tr><td>
                              <table border="0" align="center" width="700">
                                 <img src="../image/logounico.png" border="0" width="125" height="115">
                                 <td colspan="25"><div align="right"><b>Nota Crédito:</b>&nbsp;&nbsp;<?echo $filas["nronota"];?></div></th>
                              </tr>
                               <tr><td colspan="16">---------------------------------------------------<b>Datos del Cliente</b>--------------------------------------------------------- </td></tr>
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
                                 <td  class="cajas"><b>Nro_Factura:</b>&nbsp;<?echo $filas["nrofactura"];?></td>
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

                                           <tr class="cajas">
                                             <td colspan="14">&nbsp;</td><td width="2"><b>Subtotal:</b></td><td width="10"><div align="right">$<?echo $subtotal;?></div></td>
                                           </tr>
                                           <tr class="cajas">
                                             <td colspan="14">&nbsp;</td><td width="2"><b>Base_Devo:</b></td><td width="10"><div align="right">$<?echo $BaseD;?></div></td>
                                           </tr>
                                            <tr class="cajas">
                                             <td colspan="14">&nbsp;</td><td width="2"><b>Dev_ReteFuente:</b></td><td width="10"><div align="right">$<?echo $vlrfte;?></div></td>
                                           </tr>
                                            <tr class="cajas">
                                             <td colspan="14">&nbsp;</td><td width="2"><b>Dev_Cree:</b></td><td width="10"><div align="right">$<?echo 0;?></div></td>
                                           </tr>
                                            <tr class="cajas">
                                             <td colspan="14">&nbsp;</td><td width="2"><b>Dev_Iva:</b></td><td width="10"><div align="right">$<?echo $vlriva;?></div></td>
                                           </tr>
                                            <tr class="cajas">
                                             <td colspan="14">&nbsp;</td><td width="2"><b>Dev_ReteIva:</b></td><td width="10"><div align="right">$<?echo $vlreteiva;?></div></td>
                                           </tr>
                                           <tr class="cajas">
                                             <td colspan="14">&nbsp;</td><td width="2"><b>Total_Devolución:</b></td><td width="10" aling="right">$<?echo $Total;?></td>
                                           </tr>
                                <tr>
                                   <td class="cajas"><b>Firma y Sello:</b></td>
                                 </tr>
                                <?
                            endwhile;
                       endif;
                       ?>
                       </table></td> </tr>
                        </table>
                  </body>
</html>
