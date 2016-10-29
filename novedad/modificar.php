<html>
        <head>
                <title>Modificar  Novedades</title>
                <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
        </head>
        <body>
                <?
                 if (!isset($cedemple)):
                         // include("../conexion.php");
                ?>
                        <center><h4><u>Modificar Novedades</u></h4></center>
                         <form action="" method="post">
                           <table border="0" align="center"
                                <tr><td><br></td></tr>
                                <tr>
                                  <td><b>Documento de Identidad:</b></td>
                                   <td><input type="text" name="cedemple" value="" size="11" maxlength="11">
                                   </tr>
                                   <tr><td><br></td></tr>

                                   <tr><td colspan="1"><input type="submit" Value="Buscar" class="boton"></td></tr>
                               </tr>
                        </table>
                        
                   </form>
                <?
                elseif(empty($cedemple)):
                  ?>
                    <script language="javascript">
                       alert("Digite el documento del empleado " )
                       history.back()
                     </script>
              <?
                else:
                      include("../conexion.php");
                       $consulta1="select empleado.cedemple,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1,novedad.novedad 'nove',novedad.consecutivo,novedad.fecha,novedad.estado from empleado,novedad where
                           novedad.cedemple=empleado.cedemple and
                            empleado.cedemple='$cedemple'";
                           $resultado1=mysql_query($consulta1) or die("Consulta de empleado incorrecta");
                           $regis=mysql_num_rows($resultado1);
                           if ($regis==0):
                              ?>
                              <script language="javascript">
                                alert("Este empleado no tiene novedades?")
                                history.back()
                              </script>
                               <?
                           else:
                                ?>
                                    <center><h4><u>Datos a Modificar</u></h4></center>
                                   <?
                                     while ($filas=mysql_fetch_array($resultado1)):
                                        ?>
                                        <form action="guardarmo.php" method="post">
                                          <table border="0" align="center">
                                          <tr class="fondo">
                                            <td colspan="6"><br></td>
                                          </tr>
                                          <tr>
                                             <td><b>Radicado:</b></td>
                                             <td><input type="text" name="consecutivo" value="<?echo $filas["consecutivo"];?>"  class="cajas" readonly></td>
                                           </tr>
                                          <tr>
                                             <td><b>Cedula:</b></td>
                                             <td><input type="text" name="cedemple" value="<?echo $filas["cedemple"];?>" class="cajas"  readonly></td>
                                           </tr>
                                            <tr>
                                              <td><b>Nombre:</b></td>
                                              <td><input type="text" name="nomemple" value="<?echo $filas["nomemple"];?>&nbsp;<?echo $filas["nomemple1"];?>" class="cajas" readonly class="cajas"></td>
                                              <td><b>Apellido:</b></td>
                                              <td><input type="text" name="apemple" value="<?echo $filas["apemple"];?>&nbsp;<?echo $filas["apemple1"];?>"  class="cajas" readonly class="cajas"></td>
                                           </tr>
                                           <tr>
                                             <td><b>Novedad:</b></td>
                                              <td colspan="5"><textarea name="novedad" cols="59" rows="5" class="cajas"><? echo $filas["nove"];?></textarea></td></tr>
                                             </tr>
                                           <tr>
                                             <td><b>Fecha:</b></td>
                                             <td><input type="text" name="fecha" value="<? echo date("Y-m-d");?>" size="11" maxlength="10"  class="cajas"  readonly></td>
                                           </tr>
                                            <tr>
                                             <td><b>Estado:</b></td>
                                             <td><input type="text" name="estado" value="<? echo $filas["estado"];?>" size="11" maxlength="11"  class="cajas" ></td>
                                           </tr>
                                           <tr><td><br></td></tr>
                                           <tr>
                                             <td colspan="6"><input type="submit" value="Guardar" class="boton"></td>
                                           </tr>
                                       </table>
                                    </form>
                            <?
                                    endwhile;

                        endif;
               endif;
                           ?>
       </body>
</html>
