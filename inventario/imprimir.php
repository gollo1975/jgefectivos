<html>
        <head>
                <title>Impresion de Orden de Entrega</title>
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
                        $consulta="select maestro.codmaestro,maestro.dvmaestro,sucursal.sucursal,sucursal.dirsucursal,carpeta.*  from maestro,sucursal,zona,empleado,carpeta
                        where  maestro.codmaestro=sucursal.codmaestro and
                             sucursal.codsucursal=zona.codsucursal and
                              zona.codzona=empleado.codzona and
                              empleado.cedemple=carpeta.cedemple and
                              carpeta.nroentrega='$nroentrega'";
                        $resultado=mysql_query($consulta) or die("Error en la busqueda de carpetas");
                        $registros=mysql_num_rows($resultado);
                        if ($registros==0)
                        {
                ?>
                          <script language="javascript">
                            alert("No Existen formatos para la entrega de carpetas ?")
                            history.back()
                          </script>
                <?
                        }
                        else
                        {
                           while ($filas=mysql_fetch_array($resultado))
                            {
                            $cedula=number_format($filas["cedemple"],0);
                ?>
                              <table border="1" align="center" width="710">
                              <tr>
                              <td>
                              <table border="0" align="center" width="710">
                              <tr>
                               <tr><td><br></tr></td>
                               <tr>
                               <th colspan="30"align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u>ENTREGA DE CARPETAS</u></td><td colspan="10"><div align="center"><b>Nro_Entrega.:</b>&nbsp;<?echo $filas["nroentrega"];?></div></td>
                                </tr>
                               <tr>
                                 <tr class="cajas"><b>Fecha Imp.:</b>&nbsp;&nbsp;Medellín&nbsp;<?echo date("Y-m-d");?></tr>  <tr class="cajas"><b>Fecha Proc.:</b>&nbsp;Medellín&nbsp;<?echo $filas["fechaentrega"];?></tr>
                                 <td colspan="30" class="cajas"><b>Sucursal:</b>&nbsp;<?echo $filas["sucursal"];?>
                                 </tr>
                                 <tr>
                                 <td colspan="30" class="cajas"><b>Nit:</b>&nbsp;<?echo $filas["codmaestro"];?>-<?echo $filas["dvmaestro"];?></td>
                                </tr>
                                 <tr><td><br></tr></td>
                                <tr><td colspan="45">****************************************************************************************</td></tr>
                                 <tr><td colspan="45"><div align="center"><b><u>Datos de la Carpeta</u></b></div></td></tr> 
                                 <tr>
                                 <td class="cajas"><b>Codigo:</b>&nbsp;<?echo $filas["codemple"];?></td>
                                </tr>
                                <tr>
                                 <td class="cajas"><b>Documento:</b>&nbsp;<?echo $cedula;?></td>
                                </tr>
                                <tr>
                                 <td colspan=""class="cajas"><b>Empleado:&nbsp;</b><?echo $filas["empleado"];?></td>
                                 </tr>
                                  <tr>
                                 <td colspan=""class="cajas"><b>Zona:&nbsp;</b><?echo $filas["zona"];?></td>
                                 </tr>
                                  <tr>
                                 <td colspan=""class="cajas"><b>Responsable:&nbsp;</b><?echo $filas["responsable"];?></td>
                                 </tr>
                                   <tr><td><br></tr></td>
                                     <tr><td><br></tr></td>
                                       <tr><td><br></tr></td>
                                  <tr>
                                 <td colspan="45" class="cajas"><b>Motivo:&nbsp;</b><?echo $filas["motivo"];?></td>
                                 </tr>
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
