<html>
        <head>
                <title>Impresion de Crédito</title>
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
                        $consulta="select maestro.codmaestro,maestro.dvmaestro,sucursal.sucursal,sucursal.dirsucursal,empleado.cedemple,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1,empleado.cuenta,credito.*,tipo.descripcion
                         from maestro,sucursal,zona,credito,empleado,tipo
                        where  maestro.codmaestro=sucursal.codmaestro and
                             sucursal.codsucursal=zona.codsucursal and
                              zona.codzona=empleado.codzona and
                              empleado.cedemple=credito.cedemple and
                              credito.tipocre=tipo.tipocre and
                             credito.nrocredito='$nrocredito'";
                        $resultado=mysql_query($consulta) or die("consulta incorrecta 3");
                        $registros=mysql_num_rows($resultado);
                        if ($registros==0)
                        {
                ?>
                          <script language="javascript">
                            alert("No Existen datos de credito para la impresion ?")
                            history.back()
                          </script>
                <?
                        }
                        else
                        {
                           while ($filas=mysql_fetch_array($resultado))
                            {
                            $cedula=number_format($filas["cedemple"],0);
                            $vlrsolicitado=number_format($filas["vlrsolicitado"],0);
                            $vlrinteres=number_format($filas["vlrinteres"],0);
                            $vlrentregado=number_format($filas["vlrentregado"],0);
                            $cuota=number_format($filas["cuota"],0);
                            $tcredito=number_format($filas["tcredito"],0);
                ?>
                              <table border="1" align="center" width="710">
                              <tr>
                              <td>
                              <table border="0" align="center" width="710">
                              <tr>
                              <tr><td><br></td></tr>
                               <th colspan="30"align="center"><div align="right"><u>FORMATO DE PRESTAMO</u></div><td colspan="10"><div align="center"><b>Nro_Prestamo:</b>&nbsp;<?echo $filas["nrocredito"];?></div></td>
                                </tr>
                                <tr><td><br></td></tr>
                               <tr>
                                 <tr class="cajas"><b>Fecha Imp.:</b>&nbsp;&nbsp;Medellín&nbsp;<?echo date("Y-m-d");?></tr>  <tr class="cajas"><b>Fecha Proc.:</b>&nbsp;Medellín&nbsp;<?echo $filas["fesalida"];?></tr>
                                 <td colspan="30" align="center"class="cajas">
                                 </tr>

                                 <tr>
                                 <td colspan="40" class="cajas"><b><b>Sucursal:</b>&nbsp;<?echo $filas["sucursal"];?>&nbsp;&nbsp;&nbsp;Nit:</b>&nbsp;<?echo $filas["codmaestro"];?>-<?echo $filas["dvmaestro"];?><b>&nbsp;&nbsp;Cuenta:</b>&nbsp;<?echo $filas["cuenta"];?></td>
                                </tr>
                                <tr><td>&nbsp;</td></tr>
                                 <td colspan="1" class="cajas"><b>Documento:</b>&nbsp;<?echo $cedula;?>&nbsp;</td><td colspan="45"class="cajas"><b>Empleado:</b>&nbsp;&nbsp;&nbsp;<?echo $filas["nomemple"];?>&nbsp;<?echo $filas["nomemple1"];?>&nbsp;<?echo $filas["apemple"];?>&nbsp;<?echo $filas["apemple1"];?></td>
                                 </tr>
                                   <tr><td><br></tr></td>
                                <table border="1" aling="center" width="710">
                                <tr>
                                <td>
                                <table border="0" align="center" width="710">
                                  <tr class="cajas">
                                    <td><b>Descripción</b></td>
                                    <td><b><div align="center">Vlr_Solicitado</div></b></td>
                                    <td><b><div align="center">Plazo(dias)</div></b></td>
                                    <td><b><div align="center">Vlr_Aprobado</div></b></td>
                                    <td><b><div align="center">F_Pago</div></b></td>
                                    <td><b><div align="center">Cuota</div></b></td>
                                    <td><b><div align="center">Vlr_Entregado</div></b></td>
                                  </tr>
                                  <tr class="cajas">
                                    <td><?echo $filas["descripcion"];?></td>
                                    <td align="center"><?echo $vlrsolicitado;?></td>
                                    <td align="center"><?echo $filas["plazo"];?></td>
                                    <td align="center"><?echo $vlrentregado;?></td>
                                    <td align="center"><?echo $filas["formap"];?></td>
                                    <td align="center"><?echo $cuota;?></td>
                                    <td align="center"><?echo $vlrsolicitado;?></td>
                                  </tr>
                                  <tr><td><br></tr></td>
                                  <tr><td><br></tr></td>
                                  <tr><td><br></tr></td>
                                  <tr><td><br></tr></td>
                                  <tr><td><br></tr></td>
                                  <tr><td><br></tr></td>
                                  <tr><td><br></tr></td>
                                  <tr><td><br></tr></td>
                                  <tr><td><br></tr></td>
                                    <tr>
                                   <td class="cajas"><b>Firma   y   Documento:</b></td>
                                 </tr>
                               </table>
                               </td></tr>
                               </table>
                                <?
                             }
                        }
                       ?>
                          </table>
                          </td></tr>
                        </table>
                  </body>
</html>
