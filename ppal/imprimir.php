<html>
        <head>
                <title>Impresion de autorizacion</title>
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
                        $consulta="select empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1,mercado.*,maestro.codmaestro,maestro.nomaestro from maestro,sucursal,zona,empleado,mercado
                        where maestro.codmaestro=sucursal.codmaestro and
                              sucursal.codsucursal=zona.codsucursal and
                              zona.codzona=empleado.codzona and
                             empleado.cedemple=mercado.cedemple and
                        mercado.codmerca='$codmerca'";
                        $resultado=mysql_query($consulta) or die("consulta incorrecta 3");
                        $registros=mysql_num_rows($resultado);
                        if ($registros==0)
                        {
                ?>
                          <script language="javascript">
                            alert("No Existe la autorización del Detallado")
                            history.back()
                          </script>
                <?
                        }
                        else
                        {
                           while ($filas=mysql_fetch_array($resultado))
                            {
                             $aux1=number_format($filas["cupo"],0);
                ?>
                              <table border="1" align="center" width="700">
                              <tr>
                              <td>
                              <table border="0" align="center" width="700">
                              <tr>
                               <th colspan="16">FORMATO PARA RETIRO DE MERCADO</th>&nbsp;<th>NRO</th>
                                </tr>
                               <tr>
                                 <tr class="cajas">Fecha_Imp.&nbsp;<?echo date("Y-m-d");?></tr>
                                 <td colspan="16" align="center"class="cajas"><b>Empresa:</b>&nbsp;<?echo $filas["nomaestro"];?>
                                 <td colspan="16" align="center"class="cajas">&nbsp;<?echo $filas["codmerca"];?></td>
                                 </tr>
                                 <tr>
                                 <td colspan="16" align="center"class="cajas"><b>Nit:</b>&nbsp;<?echo $filas["codmaestro"];?></td>
                                </tr>
                                 <tr><td><br></td></tr>
                                <tr>
                                 <td><b>Documento:</b></td>
                                   <td class="cajas"><?echo $filas["cedemple"];?></td>
                                   <td><b>Asociado:</b></td>
                                   <td class="cajas" >&nbsp;<?echo $filas["nomemple"];?>&nbsp;<?echo $filas["nomemple1"];?>&nbsp;<?echo $filas["apemple"];?>&nbsp;<?echo $filas["apemple1"];?></td>
                                 </tr>
                                 <tr>
                                   <td><b>Fecha_Solicitud:</b></td>
                                   <td class="cajas"><?echo $filas["fecha"];?></td>
                                   <td><b>Vlr_Autorizado:</b></th>
                                   <td class="cajas">&nbsp;$<?echo $aux1;?></td>
                                 </tr>
                                 <tr><td><br></td></tr>
                                 <tr><td><br></td></tr>
                                 <tr>
                                   <th>&nbsp;AUTORIZADO POR</th><th colspan="2">&nbsp;<th>FIRMA Y SELLO</th>
                                 </tr>
                                  <tr><td><br></td></tr>
                                   <tr><td><br></td></tr>
                                   <tr><td><br></td></tr>
                                 <tr>
                                   <td colspan="3" class="cajas">&nbsp;&nbsp;&nbsp;<?echo $filas["autoriza"];?></td><th>-------------------------------</th>
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
