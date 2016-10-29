<html>
        <head>
                <title>Descargue de Mercados</title>
                 <LINK HREF="../estilo.css" REL="stylesheet"  type="text/css">
        </head>
        <body>
                <?
                 if (!isset($cedemple)):
                         // include("../conexion.php");
                ?>
                        <center><h4><u>Matricular Dato</u></h4></center>
                         <form action="" method="post">
                           <table border="0" align="center"
                                <tr>
                                   <td colspan="9" class="fondo"><br></td>
                                </tr>
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
                      $consulta = "select count(*) from mercado";
                      $result = mysql_query ($consulta);
                      $sw = mysql_fetch_row($result);
                      if ($sw[0]>0):
                           $consulta1="select empleado.cedemple,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1,mercado.codmerca,mercado.nsaldo from empleado,mercado where
                              empleado.cedemple=mercado.cedemple and
                              mercado.nsaldo > 0 and
                              empleado.cedemple='$cedemple'";
                           $resultado1=mysql_query($consulta1) or die("Consulta de empleado incorrecta");
                           $regis=mysql_num_rows($resultado1);
                           if ($regis==0):
                              ?>
                              <script language="javascript">
                                alert("Este empleado no debe mercados en la Empresa ?")
                                history.back()
                              </script>
                               <?
                           else:
                           ?>
                            <center><h4>Registro Consultado</h4></center>
                           <?
                             while ($filas=mysql_fetch_array($resultado1)):
                                ?>
                                <form action="guardar.php" method="post">
                                  <table border="0" align="center">
                                  <tr class="fondo">
                                    <td colspan="6"><br></td>
                                  </tr>
                                  <tr>
                                     <td><b>Documento:</b></td>
                                     <td><input type="text" name="cedemple" value="<?echo $filas["cedemple"];?>" size="13"readonly class="cajas"></td>
                                   </tr>
                                    <tr>
                                      <td><b>Nombres:</b></td>
                                      <td><input type="text" name="nomemple" value="<?echo $filas["nomemple"];?>&nbsp;<?echo $filas["nomemple1"];?>" readonly class="cajas"></td>
                                      <td><b>Apellidos:</b></td>
                                      <td><input type="text" name="apemple" value="<?echo $filas["apemple"];?>&nbsp;<?echo $filas["apemple1"];?>" readonly class="cajas"></td>
                                   </tr>
                                   <tr>
                                     <td><b>Nuevo_Saldo:</b></td>
                                      <td><input type="text" name="nsaldo" value="<?echo $filas["nsaldo"];?>" size="11" maxlength="11" readonly class="cajas"></td>
                                      <td><b>Nro_Autorización:</b></td>
                                      <td><input type="text" name="codmerca" value="<?echo $filas["codmerca"];?>" size="11" maxlength="11" readonly class="cajas"></td>
                                   </tr>
                                   <tr>
                                     <td><b>Fecha:</b></td>
                                     <td><input type="text" name="fechabono" value="<? echo date("Y-m-d");?>" size="11" maxlength="10" readonly class="cajas"></td>
                                     <td><b>Abono:</b></td>
                                     <td><input type="text" name="abono" value="" size="11" maxlength="11" class="cajas"></td>
                                   </tr>
                                    <tr>
                                      <td><b>Nota:</b></td>
                                      <td colspan="15"><textarea name="nota" cols="63" rows="6" class="cajas"></textarea></td>
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
               endif;
                           ?>
       </body>
</html>
