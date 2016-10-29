<html>
        <head>
                <title>Reporte de Mercados por Zona</title>
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
                        $consulta="select zona.zona from zona
                                 where zona.codzona='$campo'";
                        $resultado=mysql_query($consulta) or die("consulta incorrecta");
                        $registros=mysql_num_rows($resultado);
                        if ($registros==0)
                        {
                ?>
                          <script language="javascript">
                            alert("No Existe registro en esta consulta")
                            history.back()
                          </script>
                <?
                        }
                        else
                        {
                          while ($filas=mysql_fetch_array($resultado)):
                          ?>
                            <table border="0" align="center" width="730">
                             <tr>
                                 <th colspan="40"></th><td class="cajas">Zona:&nbsp;<?echo $filas["zona"];?>
                                </tr>
                              <?
                           endwhile;
                         }
                         ?>
                         </table>
                         <br>
                         <?
                           $consulta_s="select zona.zona,empleado.cedemple,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1,mercado.* from zona,empleado,mercado
                                  where zona.codzona=empleado.codzona and
                                  empleado.cedemple=mercado.cedemple and
                                  mercado.nsaldo>0 and
                                  mercado.fecha between '$desde' and '$hasta' and
                                  zona.codzona='$campo'";
                            $resultado_s=mysql_query($consulta_s) or die("consulta incorrecta");
                            $registros_s=mysql_num_rows($resultado_s);
                            if ($registros_s==0):
                             ?>
                              <script language="javascript">
                                alert("No Existe Mercados en esta zona")
                                history.back()
                              </script>
                              <?
                            else:
                               ?>
                               <table border="1" align="center">
                               <td>
                               <table border="0" align="center" width="730">
                               <tr>
                                  <th class="cajas">Nro_Aut.</th>
                                  <th class="cajas">Empleado</th>
                                  <th class="cajas">Fecha_Proceso</th>
                                  <th class="cajas">cupo</th>
                                  <th class="cajas">Estado</th>
                                  <th class="cajas">Autorizado</th>
                                  <th class="cajas">Saldo</th>
                                </tr>

                                <?
                                while ($filas_s=mysql_fetch_array($resultado_s)):
                                ?>

                                  <tr class="cajas" align="center">
                                    <td><?echo $filas_s["codmerca"];?></td>
                                     <td><?echo $filas_s["nomemple"];?>&nbsp;<?echo $filas_s["nomemple1"];?>&nbsp;<?echo $filas_s["apemple"];?>&nbsp;<?echo $filas_s["nomemple1"];?></td>
                                     <td><?echo $filas_s["fecha"];?></td>
                                     <td><?echo $filas_s["cupo"];?></td>
                                     <td><?echo $filas_s["estado"];?></td>
                                     <td><?echo $filas_s["autoriza"];?></td>
                                     <td><?echo $filas_s["nsaldo"];?></td>
                                    </tr>
                                    <?
                                    $total=$total+$filas_s["nsaldo"];
                                 endwhile;
                                  ?>
                                  </table>
                                  </td>
                                  </table>
                                  <tr><td>&nbsp;</td></tr>
                                  <center><td class="cajas"><b>Total Deuda:</b>&nbsp;&nbsp;<?echo $total?></td></center>

                                  <?
                             endif;
                           ?>

                   </body>
</html>
