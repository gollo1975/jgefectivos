<html>
        <head>
                <title>Consulta de Memorandos</title>
               <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
        </head>
        <body>
<?
                     include("../conexion.php");
                     $consulta="select empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1,empleado.cedemple from empleado where
                     empleado.cedemple='$Cedula'";
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
                         $consulta="select empleado.*,memorando.* from empleado,memorando where
                         empleado.cedemple=memorando.cedemple and empleado.cedemple='$Cedula'";
                         $resultado=mysql_query($consulta) or die("consulta incorrecta");
                         $regi=mysql_num_rows($resultado);
                         if ($regi!=0):
                            ?>
                            <center><h4>Listado de Memorandos</h4></center>
                            <table border="0"align="center">
                              <tr class="cajas">
                                <td>Para Ver por Pantalla el memorando, Presione Click sobre el Radicado ...</td>
                              </tr>
                            </table>
                            <tr><td><br></td></tr>
                             <table border="0" align="center">
                              <tr>
                                <td colspan="9" class="fondo"></td>
                                </tr>
                                <tr class="cajas">
                                     <th>Radicado</th>
                                     <th>Fecha_Proceso</th>
                                     <th>Asunto</th>
                                     <th>Firma</th>
                                     <th>Cargo</th>
                                     <th>Estado</th>
                                <?
                                     while($filas=mysql_fetch_array($resultado)):
                                     ?>
                                      <tr class="cajas">
                                           <td> <a href="../memorando/imprimir1.php?radicado=<?echo $filas["radicado"];?>"><?echo $filas["radicado"];?></a></td>
                                           <td><?echo $filas["fecha"];?></td>
                                           <td><?echo $filas["asunto"];?></td>
                                           <td><?echo $filas["firma"];?></td>
                                           <td><?echo $filas["cargo"];?></td>
                                           <td><?echo $filas["estado"];?></td>
                                       </tr>
                                        <?
                                     endwhile;
                               ?>
                               </table>
                               <?

                         else:
                           ?>
                           <script language="javascript">
                              alert("Este empleado no tiene memorandos ?")
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
                                 ?>
                </body>
</html>

