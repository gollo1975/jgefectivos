<html>
        <head>
                <title>Reporte de Mercados Sucursal</title>
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
                        $consulta="select sucursal.sucursal from sucursal
                                  where sucursal.codsucursal='$campo'";
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
                            <table border="0" align="center" width="750">
                             <tr>
                                 <th colspan="34"></th><td class="cajas">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?echo $filas["sucursal"];?></th>
                              </tr>
                              <tr>
                                 <th colspan="34"></th><td class="cajas">Mercados Por Sucursal</td>
                             </tr>
                              <?
                           endwhile;
                         }
                         ?>
                         </table>
                         <br>
                         <?
                           $consulta_s="select sucursal.sucursal,zona.zona,empleado.cedemple,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1,mercado.* from sucursal,zona,empleado,mercado
                                  where sucursal.codsucursal=zona.codsucursal and
                                  zona.codzona=empleado.codzona and
                                  empleado.cedemple=mercado.cedemple and
                                  mercado.nsaldo > 0 and
                                 sucursal.codsucursal='$campo' order by zona";
                            $resultado_s=mysql_query($consulta_s) or die("consulta incorrecta");
                            $registros_s=mysql_num_rows($resultado_s);
                            if ($registros_s==0):
                             ?>
                              <script language="javascript">
                                alert("No Hay registros para Mostrar")
                                history.back()
                              </script>
                              <?
                            else:
                               ?>
                               <table border="1" align="center">
                               <td>
                               <table border="0" align="center" width="750">
                               <tr>
                                  <th class="cajas">Nro_Aut.</th>
                                  <th class="cajas">Empleado</th>
                                  <th class="cajas">Fecha</th>
                                  <th class="cajas">cupo</th>
                                  <th class="cajas">Zona</th>
                                  <th class="cajas">Autorización</th>
                                  <th class="cajas">Saldo</th>
                                </tr>

                                <?
                                while ($filas_s=mysql_fetch_array($resultado_s)):
                                ?>

                                  <tr class="cajas">
                                    <td><?echo $filas_s["codmerca"];?></td>
                                    <td><?echo $filas_s["nomemple"];?>&nbsp;<?echo $filas_s["nomemple1"];?>&nbsp;<?echo $filas_s["apemple"];?>&NBSP;<?echo $filas_s["apemple1"];?></td>
                                     <td><?echo $filas_s["fecha"];?></td>
                                     <td><?echo $filas_s["cupo"];?></td>
                                     <td><?echo $filas_s["zona"];?></td>
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
                                   <tr><td><br></td></tr>
                                   <tr align="center" class="cajas">
                                   <center><td><b>Total Deuda:</b>&nbsp;<?echo $total;?></td></center>
                                  </tr>
                                  <?
                             endif;
                           ?>

                   </body>
</html>
