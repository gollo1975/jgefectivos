<html>
        <head>
                <title>Procesos Disciplinarios</title>
                <link rel="stylesheet" href="../estilo.css" type="text/css">
        </head>
        <body>
                      <?
                 if (!isset($desde)):
                         include("../conexion.php");
                ?>
                   <center><h4><u>Procesos Disciplinarios</u></h4></center>
                   <form action="" method="post">
                           <table border="0" align="center"
                            <tr>
                              <td colspan="9"></td>
                            </tr>
                            <tr><td><br></td></tr>
                            <tr>
                              <td><b>Fecha_Inicio:&nbsp;</b></td>
                              <td><input type="text" name="desde" value="<?echo date("Y-m-d");?>" size="10" maxlength="10"></td>
                            </tr>
                            <tr>
                              <td><b>Fecha_Final:&nbsp;</b></td>
                              <td><input type="text" name="hasta" value="<? echo date("Y-m-d");?>" size="10" maxlength="10"></td>
                            </tr>
                            <tr>
      			    <td><b>Zona:</b></td>
                              <td><select name="codigo" class="cajas">
                              <option value="0">Seleccione la zona
                                <?
                                 $consulta_z="select codzona,zona from zona where nomina='SI' order by zona";
                                 $resultado_z=mysql_query($consulta_z)or die ("consulta incorrecta");
                                while($filas_z=mysql_fetch_array($resultado_z)):
                                   ?>
                                   <option value="<?echo $filas_z["codzona"];?>"> <?echo $filas_z["zona"];?>
                                  <?
                                  endwhile;
                                  ?>
                                  </select></td>
                            </tr>
                           <tr><td><br></td></tr>
                             <tr>
                               <td colspan="6"><input type="submit" value="Buscar" class="boton"> &nbsp;<input type="reset" value="Limpiar" class="boton"></td>
                             </tr>
                        </table>

                   </form>
                  <?
                elseif(empty($desde)):
                  ?>
                    <script language="javascript">
                       alert("Digite la fecha de Inicio" )
                       history.back()
                     </script>
                    <?
                     elseif(empty($codigo)):
                  ?>
                    <script language="javascript">
                       alert("Seleccion de la lista la zona para la busqueda." )
                       history.back()
                     </script>
              <?
                 else:
                      include("../conexion.php");
                      $consulta1="select zona.zona from zona where
                                zona.codzona='$codigo'";
                             $resultado1=mysql_query($consulta1) or die("Error al buscar zona");
                           $regis=mysql_num_rows($resultado1);
                             ?>
                             <center><h4>Procesos Disciplinarios</h4></center>
                            <table border="0" align="center">
                                <?
                             while($filas=mysql_fetch_array($resultado1)):
                             ?>
                               <tr class="cajas">
                                <td><?echo $filas["zona"];?></td>
                               </tr>
                                <?
                              endwhile;
                              ?>
                              </table>
                              <?
                              $consulta="select zona.zona,empleado.cedemple,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1 ,
                              memorando.* from zona,empleado,memorando where
                              zona.codzona=empleado.codzona and
                              empleado.cedemple=memorando.cedemple and
                              memorando.fecha between '$desde'and'$hasta' and
                              zona.codzona='$codigo' order by empleado.cedemple";
                              $resultado=mysql_query($consulta) or die("Consulta de empleado incorrecta");
                              $regist=mysql_num_rows($resultado);
                              if ($regist==0):
                              ?>
                              <script language="javascript">
                                alert("No hay registro en la busqueda ?")
                                history.back()
                              </script>
                               <?
                           else:
                             ?>
                             <table border="0" align="center">
                               <tr class="cajas">
                                 <td>Para ver el Memorando por Pantalla, Presione Click en el registro [Radicado]</td>
                               </tr>
                             </table>
                             <table border="0" align="center">
                                <tr class="cajas">
                              <th>Item</th>
                              <th>Radicado</th>
                              <th>Cedula</th>
                              <th>Nombres</th>
                              <th>Apellidos</th>
                               <th>F_Memorando</th>
                               <th>Motivo</th>

                             </tr>
                              <?
                              $a=1;
                              while($filas_s=mysql_fetch_array($resultado)):
                             ?>
                               <tr class="cajas">
                               <th><?echo $a;?></th>
                               <td><a href="imprimir1.php?radicado=<?echo $filas_s["radicado"];?>"><?echo $filas_s["radicado"];?></a></td>
                               <td><?echo $filas_s["cedemple"];?></td>
                               <td><?echo $filas_s["nomemple"];?>&nbsp;<?echo $filas_s["nomemple1"];?></td>
                               <td><?echo $filas_s["apemple"];?>&nbsp;<?echo $filas_s["apemple1"];?></td>
                               <td><?echo $filas_s["fecha"];?></td>
                               <td><?echo $filas_s["asunto"];?></td>
                               <td><?echo $filas_s["concepto"];?></td>
                               </tr>
                                <?$a=$a+1;
                              endwhile;
                              ?>
                              </table>
                              <?
                           endif;
                        endif;
                                           ?>
       </body>
</html>
