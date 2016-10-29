<html>
        <head>
                <title>Impresion de aportes Sociales</title>
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
                        $consulta="select empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1,empleado.cuenta,entrega.*,sucursal.sucursal,maestro.codmaestro,maestro.nomaestro,maestro.dvmaestro from maestro,sucursal,zona,empleado,entrega
                        where maestro.codmaestro=sucursal.codmaestro and
                              sucursal.codsucursal=zona.codsucursal and
                              zona.codzona=empleado.codzona and
                             empleado.cedemple=entrega.cedemple and
                        entrega.nroentrega='$nroentrega'";
                        $resultado=mysql_query($consulta) or die("consulta incorrecta 3");
                        $registros=mysql_num_rows($resultado);
                        if ($registros==0)
                        {
                ?>
                          <script language="javascript">
                            alert("No Existe registro en la consulta ?")
                            history.back()
                          </script>
                <?
                        }
                        else
                        {
                           while ($filas=mysql_fetch_array($resultado))
                            {
                            $cedula=number_format($filas["cedemple"],0);
                            $valor=number_format($filas["valor"],0);
                ?>
                              <table border="1" align="center" width="700">
                              <tr>
                              <td>
                              <table border="0" align="center" width="700">
                              <tr>
                               <th colspan="3"><u>ENTREGA DE APORTES SOCIALES</u></th>&nbsp;<th>Nro_Recibo:&nbsp;<?echo $filas["nroentrega"];?></th>
                                </tr>
                                 <tr><td><br></td></tr>
                                 <tr>
                                 <td colspan="16" align="center"class="cajas"><b>Empresa:</b>&nbsp;<?echo $filas["nomaestro"];?>&nbsp;<b>Nit:</b>&nbsp;<?echo $filas["codmaestro"];?><b>-</b>&nbsp;<?echo $filas["dvmaestro"];?>
                                </tr>
                               <tr>

                                 <td colspan="16" align="center"class="cajas"><b>Sucursal:</b>&nbsp;<?echo $filas["sucursal"];?>
                                </tr>
                                <tr><td><br></td></tr>
                                <tr>
                                 <td><b>Documento:</b></td>
                                   <td class="cajas"><?echo $cedula;?></td>
                                   <td><b>Asociado:</b></td>
                                   <td class="cajas"><?echo $filas["nomemple"];?>&nbsp;<?echo $filas["nomemple1"];?>&nbsp;<?echo $filas["apemple"];?>&nbsp;<?echo $filas["apemple1"];?></td>
                                 </tr>
                                 <tr>
                                   <td><b>Fecha_Ingreso:</b></td>
                                   <td class="cajas"><?echo $filas["fechainic"];?></td>
                                   <td><b>Fecha_Corte:</b></td>
                                   <td class="cajas"><?echo $filas["fechafinal"];?></td>
                                 </tr>
                                 <tr>
                                   <td><b>Fecha_Proceso:</b></td>
                                   <td class="cajas"><?echo $filas["fechagra"];?></td>
                                   <td><b>Cuenta:</b></td>
                                   <td class="cajas"><?echo $filas["cuenta"];?></td>
                                   </tr>
                                   <tr>
                                   <td><b>F_Impresión:</b></td>
                                   <td class="cajas"><?echo date("Y-m-d");?></td>
                                   </tr>
                                 <tr><td><br></td></tr>
                                 <tr><td><br></td></tr>
                                 <tr>
                                   <th>&nbsp;</th><th colspan="2">&nbsp;<th>Valor:&nbsp;&nbsp;$<?echo $valor;?></th>
                                 </tr>
                                  <tr><td><br></td></tr>
                                   <tr><td><br></td></tr>
                                   <tr><td><br></td></tr>
                                 <tr>
                                   <td colspan="3" class="cajas">&nbsp;&nbsp;&nbsp;<?echo $filas["nota"];?></td><td>Firma asociado:___________________</td>
                                </tr>
                                <tr><td><br></td></tr>
                                <tr><td><br></td></tr>
                                <?
                             }
                        }
                       ?>
                          </table>
                          </td></tr>
                        </table>
                  </body>
</html>
