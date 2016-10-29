<html>
        <head>
                <title>Impresion de Recibo de Cajas</title>
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
                        $consulta="select maestro.codmaestro,maestro.dvmaestro,maestro.nomaestro,sucursal.sucursal,sucursal.dirsucursal,recibo.*,banco.bancos from maestro,sucursal,zona,factura,recibo,banco
                        where  maestro.codmaestro=sucursal.codmaestro and
                             sucursal.codsucursal=zona.codsucursal and
                              zona.codzona=factura.codzona and
                              factura.nrofactura=recibo.nrofactura and
                              recibo.codbanco=banco.codbanco and
                             recibo.nrocaja='$nrocaja'";
                        $resultado=mysql_query($consulta) or die("consulta incorrecta 3");
                        $registros=mysql_num_rows($resultado);
                        if ($registros==0)
                        {
                ?>
                          <script language="javascript">
                            alert("No Existen recibo de pago a facturas")
                            history.back()
                          </script>
                <?
                        }
                        else
                        {
                           while ($filas=mysql_fetch_array($resultado))
                            {
                            $xlr=number_format($filas["abono"],2);
                ?>
                              <table border="1" align="center" width="700">
                              <tr>
                              <td>
                              <table border="0" align="center" width="700">
                              <tr>
                               <th colspan="16"align="center">RECIBO DE CAJA</th>&nbsp;<th>Nro:&nbsp;<?echo $filas["nrocaja"];?></th>
                                </tr>
                               <tr>
                                 <tr class="cajas"><b>Fecha y ciudad de Pago</b>:&nbsp;<?echo $filas["ciudad"];?>&nbsp;<?echo $filas["fechare"];?></tr>
                                 <td colspan="20" align="center"class="cajas"><?echo $filas["nomaestro"];?>
                                 </tr>
                                 <tr>
                                 <td colspan="20" align="center"class="cajas">Nit:&nbsp;<?echo $filas["codmaestro"];?>-<?echo $filas["dvmaestro"];?></td>
                                </tr>
                                 </tr>
                                  <tr><td colspan="20">--------------------------------------------------------------------------------------------------------------------------------</td>
                                 </tr>
                                </tr>
                                  <tr><td colspan="20"><b><u><div align="center">Datos del Pagador</div></u></b></td>
                                 </tr>
                                 <tr><td><br></td></tr>
                                 <tr>
                                 <td colspan="10" class="cajas"><b>Dirección:</b>&nbsp;<?echo $filas["dir"];?>&nbsp;</td><td colspan="45"class="cajas"><b>Teléfono:</b>&nbsp;<?echo $filas["telefono"];?></td>
                                </tr>
                                <tr>
                                 <td colspan="10" class="cajas"><b>Recibido de:</b>&nbsp;<?echo $filas["zona"];?>&nbsp;</td><td colspan="45"class="cajas"><b>Nit:</b>&nbsp;<?echo $filas["nit"];?>-<?echo $filas["dv"];?></td>
                                 </tr>
                                 <tr>
                                 <td align="left"class="cajas"><b>Valor:</b>&nbsp;$<?echo $xlr;?>&nbsp;</td>
                                 </tr>
                                 <tr>
                                 <td align="left"class="cajas"><b>Nro_Factura:</b>&nbsp;<?echo $filas["nrofactura"];?></td>
                                 </tr>
                                  <tr><td>&nbsp;</td></tr>
                                 <tr>
                                 <td colspan="20" class="cajas"><b>La suma(en Letras):&nbsp;</b><?echo $filas["suma"];?>&nbsp;PESOS ML.</td>
                                 </tr>
                                  <tr><td>&nbsp;</td></tr>
                                 <tr>
                                 <td colspan="20" class="cajas"><b>Forma de Pago:&nbsp;</b><?echo $filas["pago"];?>&nbsp;<b>Cta destino:&nbsp;</b><?echo $filas["cuenta"];?>&nbsp;<b>Banco:&nbsp;</b><?echo $filas["bancos"];?></td>
                                 </tr>
                                  <tr><td>&nbsp;</td></tr>
                                 <tr>
                                 <td colspan="20" class="cajas"><b>Por Concepto de:&nbsp;</b><?echo $filas["concepto"];?></td>
                                 </tr>

                                   <tr><td>&nbsp;</td></tr>
                                 <tr>
                                  <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DEBITO</th><th colspan="2">&nbsp;<th>CREDITO</th>
                                 </tr>
                                  <tr>
                                   <td colspan="2" class="cajas">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$<?echo $xlr;?></td><td colspan="2" class="cajas">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$<?echo $xlr;?></td>
                                 </tr>
                                <tr><td><br></td></tr>
                                <tr>
                                   <td class="cajas"><b>Firma y Sello:</b></td>
                                 </tr>
                                <?
                             }
                        }
                       ?>
                          </table>
                          </td></tr>
                        </table>
                  </body>
</html>
