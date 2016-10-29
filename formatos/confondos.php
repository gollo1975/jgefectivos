<html>
        <head>
                <title>Auxilios por Fondo</title>
               <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
        </head>
        <body>
        <?
                if (!isset($cedemple)):
                 ?>
                     <center><h4><u>Auxilios por fondo</u></h4></center>
                      <form action="" method="post">
                                <table border="0" align="center">
                                           <tr>
                                                <td colspan="2" class="fondo"></td>
                                        </tr>
                                        <tr><td><br></td></tr>
                                        <tr>
                                                <td><b>Digite el Documento:</b></td>
                                                <td><input type="text" name="cedemple" value="" size="12" maxleng="12"></td>
                                        </tr>
                                        <tr><td><br></td></tr>
                                        <tr>
                                                <td colspan="2"><input type="submit" Value="Buscar" class="boton">&nbsp;<input type="reset" Value="Limpiar" class="boton"></td>
                                        </tr>
                                </table>

                        </form>
        <?

                elseif (empty($cedemple)):
                  ?>
                    <script language="javascript">
                       alert("Digite el documento del Empleado")
                       history.back()
                    </script>

              <?
                 else:
                     include("../conexion.php");
                     $consulta="select empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1,empleado.cedemple from empleado where
                     empleado.cedemple='$cedemple'";
                     $resultado=mysql_query($consulta) or die("consulta incorrecta");
                     $registros=mysql_num_rows($resultado);
                     if ($registros!=0):
                        ?>
                         <table border="0" align="center">
                            <?
                            while($filas_s=mysql_fetch_array($resultado)):
                             ?>
                               <tr>
                                 <td><?echo $filas_s["cedemple"];?>:&nbsp;<?echo $filas_s["nomemple"];?>&nbsp;<?echo $filas_s["nomemple1"];?>&nbsp;<?echo $filas_s["apemple"];?>&nbsp;<?echo $filas_s["apemple1"];?>
                               </tr>
                             <?
                            endwhile;
                          ?>
                          </table>
                          <?
                         include("../conexion.php");
                         $consulta="select fondos.* from empleado,fondos
                         where empleado.cedemple=fondos.cedemple and empleado.cedemple='$cedemple'";
                         $resultado=mysql_query($consulta) or die("Error al consultar fondos");
                         $regi=mysql_num_rows($resultado);
                         if ($regi!=0):
                            ?>
                            <center><h4><u>Listado de Auxilios</u></h4></center>
                            <table border="0"align="center">
                              <tr class="cajas">
                                <td>Para ver por pantalla, Presione Click sobre el Radicado ...</td>
                              </tr>
                            </table>
                            <tr><td><br></td></tr>          
                             <table border="0" align="center">
                              <tr>
                                <td colspan="9" class="fondo"></td>
                                </tr>
                                <tr class="cajas">
                                     <th>Radicado</th>
                                     <th>Fondo</th>
                                     <th>Documento</th>
                                     <th>Vlr_Fondo</th>
                                     <th>Zona</th>
                                     <th>F_Pago</th>
                                     <th>F_Proceso</th>

                                <?
                                     while($filas=mysql_fetch_array($resultado)):
                                     ?>
                                      <tr class="cajas">
                                           <td> <a href="imprimirfondo.php?nro=<?echo $filas["radicado"];?>"><?echo $filas["radicado"];?></a></td>
                                           <td><?echo $filas["fondo"];?></td>
                                           <td><?echo $filas["documento"];?></td>
                                           <td><?echo $filas["vlrfondo"];?></td>
                                           <td><?echo $filas["zona"];?></td>
                                            <td><?echo $filas["fechap"];?></td>
                                           <td><?echo $filas["fechagra"];?></td>
                                       </tr>
                                        <?
                                     endwhile;
                               ?>
                               </table>
                               <?

                         else:
                           ?>
                           <script language="javascript">
                              alert("Este empleado no ha generados fondos ?")
                              history.back()
                           </script>
                           <?
                         endif;
                     else:
                         ?>
                           <script language="javascript">
                              alert("Este documento no existe en el sistema  ?")
                              history.back()
                           </script>
                           <?
                     endif;
                  endif;
                                  ?>
                </body>
</html>

