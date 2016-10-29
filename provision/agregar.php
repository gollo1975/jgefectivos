<html>
        <head>
                <title>Registra provision</title>
                 <LINK HREF="../estilo.css" REL="stylesheet"  type="text/css">
                  <script language="javascript">
                    function ColorFoco(obj)
                    {
                        document.getElementById(obj).style.background="#9DFF9D"

                    }

                    function QuitarFoco(obj)
                    {
                        document.getElementById(obj).style.background="white"
                    }
                      function chequearcampos()
                    {
                        if (document.getElementById("cedula").value.length <=0)
                        {
                            alert ("Digite el documento del empleado.?");
                            document.getElementById("cedula").focus();
                            return;
                        }
                         document.getElementById("matprovi").submit();

                    }
                </script>
        </head>
        <body>
                <?
                 if (!isset($cedula)):
                ?>
                        <center><h4><u>Registrar Provisión</u></h4></center>
                         <form action="" method="post" id="matprovi">
                           <table border="0" align="center"
                                <tr><td><br></td></tr>
                                <tr>
                                  <td><b>Documento de Identidad:</b></td>
                                   <td><input type="text" name="cedula" value="" size="13" maxlength="11" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="cedula">
                                   </tr>
                                   <tr><td><br></td></tr>
                                   <tr><td colspan="1"><input type="button" Value="Buscar" class="boton" onclick="chequearcampos()"></td></tr>
                               </tr>
                        </table>
                   </form>
              <?
                else:
                      include("../conexion.php");
                          $consulta1="select empleado.cedemple,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1 from empleado,contrato where
                              empleado.codemple=contrato.codemple and
                              contrato.fechater='0000-00-00' and
                              empleado.cedemple='$cedula'";
                           $resultado1=mysql_query($consulta1) or die("Consulta de empleado incorrecta");
                           $regis=mysql_num_rows($resultado1);
                           if ($regis==0):
                              ?>
                              <script language="javascript">
                                alert("El documento digitado no aparece en sistema ? ?")
                                history.back()
                              </script>
                               <?
                           else:
                           ?>
                            <center><h4><u>Detalle del Registro</u></h4></center>
                           <?
                             while ($filas=mysql_fetch_array($resultado1)):
                                ?>
                                <form action="guardar.php" method="post">
                                  <table border="0" align="center">
                                  <tr><td><br></td></tr>
                                  <tr>
                                     <td><b>Documento:</b></td>
                                     <td><input type="text" name="cedula" value="<?echo $filas["cedemple"];?>" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="cedula" size="13"readonly class="cajas"></td>
                                   </tr>
                                    <tr>
                                      <td><b>Empleado:</b></td>
                                      <td><input type="text" name="empleado" value="<?echo $filas["nomemple"];?>&nbsp;<?echo $filas["nomemple1"];?>&nbsp;<?echo $filas["apemple"];?>&nbsp;<?echo $filas["apemple1"];?>" size="45" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="empleado"readonly class="cajas"></td>
                                   <tr>
                                     <td><b>Vlr_Provision:</b></td>
                                     <td><input type="text" name="valor" value="" size="13" maxlength="11" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="valor"></td>
                                   </tr>
                                   <tr>
                                    <td><b>Periodo:</b></td>
                                          <td><select name="periodo" class="cajasletra">
                                                <option value="0">Seleccione el periodo  
                                                <option value="01-15">01-15
                                                <option value="16-30">16-30
                                            </select></td>
                                       </tr>
                                    <tr>
		                            <td><b>Motivo:</b></td>
		                            <td colspan="9"><textarea name="nota" cols="45" rows="4" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="nota"></textarea></td></tr>
	                           <tr>
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
