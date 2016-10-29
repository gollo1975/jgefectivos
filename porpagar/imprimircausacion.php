<html>
        <head>
                <title>Impresion de causación</title>
                <link rel="stylesheet" href="../formato.css" type="text/css">
                <script language="javascript">
                        function imprimir()	{
						
                                window.print()
                        }
                </script>
        </head>
        <body onLoad="imprimir()">  <!-- sirve para cargar la funcion de imprsion-->
               <?

                        include ("../conexion.php");
                        $consulta="select maestro.codmaestro,maestro.dvmaestro,sucursal.sucursal,sucursal.dirsucursal,pagar.*,provedor.dvprove,
					provedor.nomprove,provedor.dirprove,causacion.fechac, causacion.nrocausa 'nro' from maestro,sucursal,provedor,pagar,causacion,comprobante
                        where  maestro.codmaestro=sucursal.codmaestro and
                             sucursal.codsucursal=provedor.codsucursal and
                              provedor.nitprove=pagar.nitprove and
                              pagar.nrofactura=causacion.nrofactura and
                              causacion.nrocausa='$nrocausa' order by pagar.conse DESC limit 1";
                             

//causacion.nrocausa='$nrocausa'";	vieja
//pagar.conse = '$nrocausa'";		nueva
                        $resultado=mysql_query($consulta) or die("Error al imprimir la causacion");
                        $registros=mysql_num_rows($resultado);
                        if ($registros==0)
                        {
                ?>
                          <script language="javascript">
                            alert("No Existen causaciones para esta factura de compra.")
                            history.back()
                          </script>
                <?
                        }
                        else
                        {
                           while ($filas=mysql_fetch_array($resultado))
                            {
				$nro = $filas["nro"];
                            $nit=number_format($filas["nitprove"],0);
                            $basecre=number_format($filas["basecre"],0);
                            $subtotal=number_format($filas["subtotal"],0);
                            $valor=number_format($filas["valor"],0);
                            $baserfte=number_format($filas["baserfte"],0);
                            $ivapagado=number_format($filas["ivapagado"],0);
                            $total=number_format($filas["total"],0);
                ?>
                   <table align="center" width="700">

               <tr><td width="118"><br></td></tr>
               <tr>
                  <td colspan="30" rowspan="8" class="cajas"><table width="100%" border="0" cellpadding="0" cellspacing="0">

                    <tr>
                      <td width="125" rowspan="6" valign="top" style="border-top: 1px solid; border-left: 1px solid; border-bottom: 1px solid;border-right: 1px solid;"><img src="../image/logounico.png" border="0" heigth="120" width="120"></td>
                      <td width="376" align="center" style="border-top: 1px solid; border-right: 1px solid; font-family:verdana; font-size:8pt"><b>Grupo Empresarial</b> </td>

                    </tr>
                    <tr>
                      <td align="center"  style="border-right: 1px solid;font-family:verdana; font-size:9pt"><b>JGEFECTIVOS S.A.S &quot;E.S.T.</b>&quot; </td>
                       <td style="border-top: 1px solid; border-right: 1px solid; font-family:verdana; font-size:8pt">&nbsp;</td>
				    </tr>
                    <tr>
                      <td style="border-right: 1px solid;">&nbsp;</td>
					  <td style="border-right: 1px solid;">&nbsp;</td>
                    </tr>
                    <tr>
                      <th rowspan="2" bgcolor="#c4c4c4" style="border-top: 1px solid; border-right: 1px solid; border-bottom: 1px solid;"><b>CAUSACIONES</b></th>
					  <td style="border-top: 1px solid; border-right: 1px solid; font-family:verdana; font-size:8pt">&nbsp;</td>
                    </tr>

                    <tr>
                      <td style="border-right: 1px solid; border-bottom: 1px solid;font-family:verdana; font-size:8pt">&nbsp;&nbsp;&nbsp;<b>Nro:</b>&nbsp;<?echo $nro;?></td>
                    </tr>
                    <tr>
                      <td align="center" style="border-right: 1px solid; border-bottom: 1px solid;font-family:verdana; font-size:9pt">Regimen Organizacional Interno </td>

                    </tr>

                  </table></td><td width="1" class="cajas">&nbsp;</td>
                   <table border="1" align="center" width="700">
                   <tr><td>
                <table border="0" align="center" width="700">
                               <tr>
                                 <td colspan="16"class="cajas"><b>Nit/Cédula:</b>&nbsp;<?echo $nit;?>-<?echo $filas["dvprove"];?></td>
                               </tr>
                               <tr>
                                  <td colspan="16" class="cajas"><b>Proveedor:</b>&nbsp;<?echo $filas["nomprove"];?></td>
                                </tr>
                                <tr>
                                  <td colspan="16" class="cajas"><b>Dirección:</b>&nbsp;<?echo $filas["dirprove"];?></b>&nbsp;&nbsp;<b>Fecha_Proceso:</b>&nbsp;<?echo $filas["fechac"];?></td>
                                </tr>
                                <tr>
                                 <td  class="cajas"><b>Nro_Factura:</b>&nbsp;&nbsp;<?echo $filas["nrofactura"];?></td>
                                </tr>
                               <tr><td colspan="16">-------------------------------------------------------<b>Detalle Fiscal</b>---------------------------------------------------------- </td></tr>
                                <tr>
                                  <td colspan="16" class="cajas"><b>Subtotal:</b>&nbsp;$<?echo $subtotal;?></b>&nbsp;&nbsp;<b>%Cree:</b>&nbsp;<?echo $filas["porcre"];?>&nbsp;&nbsp;<b>Valor_Cree:</b>&nbsp;$<?echo $basecre;?></td>
                                </tr>
                                 <tr>
                                  <td colspan="16" class="cajas"><b>%Descto:</b>&nbsp;<?echo $filas["dcto"];?></b>&nbsp;&nbsp;<b>Vlr_Dcto:</b>&nbsp;$<?echo $valor;?></td>
                                </tr>
                                <tr>
                                  <td colspan="16" class="cajas"><b>%Rfte:</b>&nbsp;<?echo $filas["rfte"];?></b>&nbsp;&nbsp;<b>Vlr_Rfte:</b>&nbsp;$<?echo $baserfte;?></td>
                                </tr>
                                <tr>
                                  <td colspan="16" class="cajas"><b>Iva:</b>&nbsp;$<?echo $ivapagado;?></b>&nbsp;&nbsp;<b>Total_Pagar:</b>&nbsp;$<?echo $total;?></td>
                                </tr>
                                  <tr><td>&nbsp;</td></tr>
                                 <tr>
                                 <td colspan="16" class="cajas"><b>Nota:&nbsp;</b><?echo $filas["nota"];?></td>
                                 </tr>
                                 <tr><td>&nbsp;</td></tr>
                                <tr><td>&nbsp;</td></tr>
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
