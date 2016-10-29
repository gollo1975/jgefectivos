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
                        $consulta="select maestro.codmaestro,maestro.dvmaestro,maestro.nomaestro,abono.*,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1,empleado.diremple,empleado.telemple from maestro,abono,empleado,credito
                        where empleado.cedemple=credito.cedemple and
                              credito.nrocredito=abono.nrocredito and
                             abono.codabono='$nroabono'";
                        $resultado=mysql_query($consulta) or die("Error de busqueda de recibo de caja $consulta ");
                        $registros=mysql_num_rows($resultado);

                           while ($filas=mysql_fetch_array($resultado))
                            {
                            $xlr=number_format($filas["abono"],2);
                            $saldo=number_format($filas["nuevo"],2);
                ?>
                              <table border="1" align="center" width="700">
                              <tr><td>
                              <table border="0" align="center" width="700">
                              <tr>
                               <td colspan="16"align="center"><b>RECIBO DE ABONO</b></th>&nbsp;<th>Nro:&nbsp;<?echo $filas["codabono"];?></td>
                                </tr>
                                <tr>
                                   <td colspan="25">------------------------------------------------------------------------------------------------------------------</td>
                                </tr>
                               <tr>
                                 <td class="cajas" align="left"><b>Fecha_Abono:</b>&nbsp;:<?echo $filas["fecha"];?></td>
                               <tr>
                                 <td colspan="25" class="cajas"><b>Empresa:</b>&nbsp;<?echo $filas["nomaestro"];?>
                                </tr>
                                 <tr>
                                 <td colspan="16"class="cajas"><b>Nit:</b>&nbsp;<?echo $filas["codmaestro"];?>-<?echo $filas["dvmaestro"];?></td>
                                </tr>
                                <tr>
                                 <td colspan="16"class="cajas"><b>Nro_Prestamo:</b>&nbsp;<?echo $filas["nrocredito"];?></td>
                                </tr>
                               <tr>
                                   <td colspan="25">------------------------------------------------------------------------------------------------------------------</td>
                                </tr>
                                <tr>
                                   <td colspan="25" align="center"><b>Datos del Cliente</b></td>
                                </tr>
                                 <td colspan="4" class="cajas"><b>Dirección:</b>&nbsp;:<?echo $filas["diremple"];?>&nbsp;</td><td colspan="45"class="cajas"><b>Teléfono:</b>&nbsp;:<?echo $filas["telemple"];?></td>
                                 </tr>
                                  <tr><td>&nbsp;</td></tr>
                                 <tr>
                                 <td colspan="4" class="cajas"><b>Cliente:</b>&nbsp;:<?echo $filas["nomemple"];?>&nbsp;<?echo $filas["nomemple1"];?>&nbsp;<?echo $filas["apemple"];?>&nbsp;<?echo $filas["apemple1"];?>&nbsp;</td><td colspan="45"class="cajas"><b>Nit/Cedula:</b>&nbsp;:<?echo $filas["cedemple"];?></td>
                                 </tr>
                                  <tr><td>&nbsp;</td></tr>
                                 <tr>
                                 <td colspan="4" class="cajas"><b>Vlr_Abono:</b>&nbsp;&nbsp;<?echo $xlr;?></td><td colspan="30"class="cajas"><b>Nuevo_Saldo:</b>&nbsp;<?echo $saldo;?></td>
                                 </tr>
                                  <tr><td>&nbsp;</td></tr>
                                  <tr><td>&nbsp;</td></tr>
                                 <tr>
                                 <td colspan="5" class="cajas"><b>Por Concepto de:&nbsp;</b><?echo $filas["concepto"];?></td>
                                 </tr> 
                                  <tr><td>&nbsp;</td></tr>

                                 <tr>
                                  <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DEBITO</th><th colspan="2">&nbsp;<th>CREDITO</th>
                                 </tr>
                                  <tr>
                                   <td colspan="2" class="cajas">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?echo $xlr;?></td><td colspan="2" class="cajas">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?echo $xlr;?></td>
                                 </tr>
                                <tr><td><br></td></tr>
                                <tr><td><br></td></tr>
                                <tr>
                                   <td class="cajas"><b>Firma y Sello:</b></td>
                                 </tr>
                                <?
                             }
                       ?>
                        </table>
                        </tr></td>
                          </table>
                  </body>
</html>
