<html>
        <head>
                <title>Listado de Mercados</title>
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
                        $consulta="select empleado.cedemple,empleado.cedemple,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1 from empleado
                               where empleado.cedemple='$valor'";
                               $resultado=mysql_query($consulta) or die("consulta incorrecta");
                        $registros=mysql_num_rows($resultado);
                        if ($registros==0)
                        {
                ?>
                          <script language="javascript">
                            alert("No Existe informacion del empleado")
                            history.back()
                          </script>
                <?
                        }
                        else
                        {
                          while ($filas=mysql_fetch_array($resultado)):
                          ?>
                            <table border="0" align="center" width="700">
                             <tr>
                                 <th colspan="15"></th><th class="cajas">Cedula:&nbsp;&nbsp;<?echo $filas["cedemple"];?>&nbsp;<?echo $filas["nomemple"];?>&nbsp;<?echo $filas["nomemple1"];?>&nbsp;<?echo $filas["apemple"];?>&nbsp;<?echo $filas["apemple1"];?></th>
                                </tr>
                              <?
                           endwhile;
                         }
                         ?>
                         </table>
                         <br>
                         <?
                           $consulta_s="select empleado.cedemple,empleado.nomemple,empleado.apemple,mercado.* from empleado,mercado
                               where empleado.cedemple=mercado.cedemple and
                               empleado.cedemple='$valor'";
                            $resultado_s=mysql_query($consulta_s) or die("consulta incorrecta");
                            $registros_s=mysql_num_rows($resultado_s);
                            if ($registros_s==0):
                             ?>
                              <script language="javascript">
                                alert("No Existe Mercados para el empleado")
                                history.back()
                              </script>
                              <?
                            else:
                               ?>
                               <table border="1" align="center">
                               <td>
                               <table border="0" align="center" width="700">
                               <tr>
                                  <th class="cajas">Nro_Autorización</th>
                                  <th class="cajas">Fecha_Proceso</th>
                                  <th class="cajas">cupo</th>
                                  <th class="cajas">Estado</th>
                                  <th class="cajas">Autorización</th>
                                  <th class="cajas">Saldo</th>
                                  <th class="cajas">Cartera</th>
                                </tr>

                                <?
                                while ($filas_s=mysql_fetch_array($resultado_s)):
                                $aux1=number_format($filas_s["cupo"],0);
                                $aux2=number_format($filas_s["nsaldo"],0);
                                ?>

                                  <tr class="cajas">
                                    <td><?echo $filas_s["codmerca"];?></td>
                                     <td><?echo $filas_s["fecha"];?></td>
                                     <td><?echo $aux1;?></td>
                                     <td><?echo $filas_s["estado"];?></td>
                                     <td><?echo $filas_s["autoriza"];?></td>
                                     <td><?echo $aux2;?></td>
                                      <td><?echo $filas_s["historia"];?></td>
                                    </tr>
                                    <?
                                    $total=$total+$filas_s["nsaldo"];
                                 endwhile;
                                 $total=number_format($total,0);
                                  ?>
                                  </table>
                                  </td>
                                  </table>
                                  <tr><td><br></td></tr>
                                  <tr>
                                   <center><td colspan="120" align="left" valign="top" class="cajas"><b>Total Saldo:</b>&nbsp;$<?echo $total;?></td></center>
                                  </tr>
                                  <?
                             endif;
                           ?>

                   </body>
</html>
