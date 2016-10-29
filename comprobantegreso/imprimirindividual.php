<html>
        <head>
                <title>Impresion de comprobante de Egreso</title>
                <link rel="stylesheet" href="../formato.css" type="text/css">
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
                        $consulta="select maestro.codmaestro,maestro.dvmaestro,maestro.nomaestro,maestro.dirmaestro,maestro.telmaestro,maestro.faxmaestro,comprobante.*,banco.bancos from comprobante,maestro,banco
                        where  comprobante.codbanco=banco.codbanco and
                               comprobante.nro='$nro'";
                        $resultado=mysql_query($consulta) or die("Error de Busqueda de Comprobante");
                        $registros=mysql_num_rows($resultado);
                        if ($registros==0):
                ?>
                          <script language="javascript">
                            alert("Este Comprobante no existe en Sistema")
                            history.back()
                          </script>
                <?
                        else:
                           while ($filas=mysql_fetch_array($resultado)):
                           $aux=number_format($filas["valor"],2);
                           $nitprove=number_format($filas["nitprove"],0);
                             $codmaestro=number_format($filas["codmaestro"],0);
                ?>
                                <table border="1" align="center" width="700">
                                <tr><td>
                                <table border="0" align="center" width="690">
                                <tr>
                                    <td align="center"><b>COMPROBANTE DE EGRESO</b></td>
                                 </tr>
                                 <tr>
                                    <td align="center"><b>Nro:&nbsp;</b><?echo $filas["nro"];?></td>
                                 </tr>
                                 <tr>
                                  <td colspan="16">--------------------------------------------------------------------------------------------------------------------------------</td>
                                 </tr>
                                 <tr>
                                    <td class="cajas"><b>Razon Social:</b>&nbsp;<?echo $filas["nomaestro"];?></td>
                                 </tr>
                                 <tr>
                                    <td class="cajas"><b>Nit:</b>&nbsp;<?echo $codmaestro;?>-<?echo $filas["dvmaestro"];?></td>
                                 </tr>
                                 <tr>
                                    <td class="cajas"><b>Dirección:</b>&nbsp;<?echo $filas["dirmaestro"];?></td>
                                 </tr>
                                 <tr>
                                    <td class="cajas"><b>Teléfono:</b>&nbsp;<?echo $filas["telmaestro"];?>&nbsp;<b>Fax:</b>&nbsp;<?echo $filas["faxmaestro"];?>&nbsp;<b>Ciudad:</b>&nbsp;<?echo $filas["ciudad"];?></td>
                                 </tr>
                                  <tr>
                                 <td colspan="16">--------------------------------------------------------------------------------------------------------------------------------</td>
                                 </tr>
                                 </table>
                                 </tr></td>
                                </table>

                               <table border="1" align="center" width="700">
                                <tr> <td>
                                <table border="0" align="center">
                                 <tr>
                                    <td class="cajas"><b>Proveedor:</b>&nbsp;<?echo $filas["cliente"];?></td>
                                    <td class="cajas"><b>Nit/Cedula:</b>&nbsp;<?echo $nitprove;?>-<?echo $filas["dvprove"];?></td>
                                  </tr>
                                  <tr>
                                    <td colspan="16" class="cajas"><b>Letras:</b>&nbsp;<?echo $filas["letras"];?>&nbsp;PESOS ML.</td>
                                 </tr>
                                 <tr>
                                    <td class="cajas"><b>Ciudad y Fecha:</b>&nbsp;<?echo $filas["ciudad"];?>&nbsp;&nbsp;<?echo $filas["fecha"];?></td>
                                    <td class="cajas"><b>Vlr_Pagado:</b>&nbsp;$<?echo $aux;?></td>
                                  </tr>
                                  <tr>
                                    <td class="cajas"><b>Nro_Factura:</b>&nbsp;<?echo $filas["nrofactura"];?></td>
                                  </tr>
                                   <tr>
                                    <td colspan="16">--------------------------------------------------------------------------------------------------------------------------------</td>
                                 </tr>
                                 <tr>
                                    <td colspan="16"align="center">&nbsp;&nbsp;&nbsp;<b><u>Forma de Pago</u></b></td>
                                 </tr>
                                 <?
                                 if($filas["pago"]=='EFECTIVO'):
                                    ?>
                                         <tr>
                                            <td class="cajas"><b>Efectivo:</b>&nbsp;<?echo $filas["pago"];?></td>
                                         </tr>
                                         <tr>
                                            <td class="cajas"><b>Cheque:</b></td>
                                         </tr>
                                         <tr>
                                            <td class="cajas"><b>Banco:</b>&nbsp;<?echo $filas["bancos"];?></td><td class="cajas"><b>Tipo Cta:</b>&nbsp;<?echo $filas["cuenta"];?></td>
                                         </tr>
                                         <tr>
                                            <td class="cajas"><b>Sucursal:</b></td>
                                         </tr>
                                         <tr>
                                           <td colspan="30"class="cajas"><b>Descripción:</b>&nbsp;<?echo $filas["concepto"];?></td>
                                          </tr>
                                          <tr><td><br></td></tr>
                                          <tr><td><br></td></tr>
                                          <tr><td><br></td></tr>
                                         <tr>
                                         <td colspan="30" class="cajas"><b>Firma y Sello</b>---------------------------------------------------------------</td>
                                        </tr>
                                       <?
                                     else:
                                       if($filas["pago"]=='CHEQUE'):
                                       ?>
                                         <tr>
                                            <td class="cajas"><b>Efectivo:</b></td>
                                         </tr>
                                         <tr>
                                            <td class="cajas"><b>Cheque:</b>&nbsp;<?echo $filas["pago"];?>&nbsp;<b>Nro:</b>&nbsp;<?echo $filas["cheque"];?></td>
                                         </tr>
                                         <tr>
                                            <td class="cajas"><b>Banco:</b>&nbsp;<?echo $filas["bancos"];?></td><td class="cajas"><b>Tipo Cta:</b>&nbsp;<?echo $filas["cuenta"];?></td>
                                         </tr>
                                         <tr>
                                            <td class="cajas"><b>Sucursal:</b></td>
                                         </tr>
                                         <tr>
                                             <td class="cajas" colspan="30"><b>Descripción:</b>&nbsp;<?echo $filas["concepto"];?></td>
                                           </tr>
                                          <tr><td><br></td></tr>
                                          <tr><td><br></td></tr>
                                          <tr><td><br></td></tr>
                                         <tr>
                                         <td colspan="30" class="cajas"><b>Firma y Sello</b>---------------------------------------------------------------</td>
                                         </tr>
                                         <?
                                        else:
                                           if($filas["pago"]=='BANCO'):
                                               ?>
                                                 <tr>
                                                    <td class="cajas"><b>Efectivo:</b></td>
                                                 </tr>
                                                 <tr>
                                                    <td class="cajas"><b>Cheque:</b></td>
                                                 </tr>
                                                 <tr>
                                                    <td class="cajas"><b>Banco:</b>&nbsp;<?echo $filas["bancos"];?></td><td class="cajas"><b>Tipo Cta:</b>&nbsp;<?echo $filas["cuenta"];?></td>
                                                 </tr>
                                                 <tr>
                                                    <td class="cajas"><b>Sucursal:</b></td>
                                                 </tr>
                                                 <tr>
                                                    <td class="cajas" colspan="30"><b>Descripción:</b>&nbsp;<?echo $filas["concepto"];?></td>
                                                 </tr>
                                                  <tr><td><br></td></tr>
                                                  <tr><td><br></td></tr>
                                                  <tr><td><br></td></tr>
                                                 <tr>
                                                 <td colspan="30" class="cajas"><b>Firma y Sello</b>---------------------------------------------------------------</td>
                                                 </tr>
                                                 <?
                                             else:
                                                ?>
                                                 <tr>
                                                    <td class="cajas"><b>Efectivo:</b></td>
                                                 </tr>
                                                 <tr>
                                                    <td class="cajas"><b>Cheque:</b></td>
                                                 </tr>
                                                 <tr>
                                                    <td class="cajas"><b>Banco:</b>&nbsp;<?echo $filas["bancos"];?></td><td class="cajas"><b>Tipo Cta:</b>&nbsp;<?echo $filas["cuenta"];?></td>
                                                 </tr>
                                                 <tr>
                                                    <td class="cajas"><b>Sucursal:&nbsp;<?echo $filas["ciudad"];?></b></td>
                                                 </tr>
                                                 <tr>
                                                    <td class="cajas" colspan="30"><b>Descripción:<b><?echo $filas["concepto"];?></b></td>
                                                 </tr>
                                                  <tr><td><br></td></tr>
                                                  <tr><td><br></td></tr>
                                                  <tr><td><br></td></tr>
                                                 <tr>
                                                 <td colspan="30" class="cajas"><b>Firma y Sello</b>---------------------------------------------------------------</td>
                                                 </tr>
                                                 <?

                                             endif;
                                        endif;
                                     endif
                                    ?>
                                 <tr>
                                 </table>
                                 </tr>
                                </table>

                               <?
                             endwhile;
                        endif;
                       ?>
                 </body>
</html>
