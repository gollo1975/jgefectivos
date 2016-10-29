    <html>
        <head>
                <title>Agregar tallas de dotación</title>
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
                        if (document.getElementById("camisa").value.length <=0)
                        {
                            alert ("Digite la talla de la camisa ");
                            document.getElementById("camisa").focus();
                            return;
                        }
                        if (document.getElementById("pantalon").value.length <=0)
                        {
                            alert ("Digite la talla del pantalón ?");
                            document.getElementById("pantalon").focus();
                            return;
                        }
                        if (document.getElementById("zapato").value.length <=0)
                        {
                            alert ("Digite la talla de los zapatos ?");
                            document.getElementById("zapato").focus();
                            return;
                        }
                         document.getElementById("matalla").submit();

                    }
                </script>
        </head>
        <body>
        <?
                if (!isset($cedemple))
                {
        ?>
                          <center><h4><u>Matricula Dotación </u></h4></center>
                           <form action="" method="post">
                                <table border="0" align="center">
                                  <tr><td><br></td></tr> 
                                 <tr>
                                                <td><b>Digite el Documento:</b></td>
                                                <td><input type="text" name="cedemple" value="" size="15" maxleng="15" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="cedemple"></td>
                                        </tr>
                                        <tr><td><br></td></tr>
                                        <tr>
                                                <td colspan="2"><input type="submit" Value="Buscar" class="boton">&nbsp;<input type="reset" Value="Limpiar" class="boton"></th>
                                        </tr>
                                </table>
                                  
                        </form>
        <?
                }
                elseif (empty($cedemple))
                {
        ?>
                        <script language="javascript">
                                alert("Digite un Valor a Buscar")
                                history.back()
                        </script>

              <?
                }
                else
                {
                        include("../conexion.php");
                        $consulta="select empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1 from empleado
                         where empleado.cedemple='$cedemple'";
                        $resultado=mysql_query($consulta) or die("consulta incorrecta");
                        $registros=mysql_num_rows($resultado);
                        if ($registros==0):
        ?>
                                <script language="javascript">
                                        alert("Este documento no existe en sistema ?")
                                        history.back()
                                </script>
        <?
                        else:
                            $con="select talla.cedemple from talla,empleado
                            where  talla.cedemple=empleado.cedemple and
                                   empleado.cedemple='$cedemple'";
                            $resu=mysql_query($con) or die("Error en la busqueda de tallas");
                            $regi=mysql_num_rows($resu);
                            if ($regi==0):
                                while ($filas=mysql_fetch_array($resultado)):
                                  ?>
                                             <center><h4><u>Matricula Dotación</u></h4></center>
                                             <form action="guardartalla.php" method="post" id="matalla">
                                                <table border="0" align="center">
                                                         <tr><td><br></td></tr> 
                                                              <tr>
                                                                        <td><b>Cedula:</b> </td>
                                                                        <td><input type="text" name="cedula" value="<?echo $cedemple;?>" size="13" readonly class="cajas"></td>
                                                                </tr>
                                                                <tr>
                                                                        <td><b>Empleado:</b></td>
                                                                        <td><input type="text" name="nombre" value="<?echo $filas["nomemple"];?>&nbsp;<?echo $filas["nomemple1"];?>&nbsp;<?echo $filas["apemple"];?>&nbsp;<?echo $filas["apemple1"];?>" size="50" class="cajas"></td>
                                                                </tr>
                                                                <tr>
                                                                        <td><b>Camisa:</b></td>
                                                                        <td><input type="text" name="camisa" value="" size="5" class="cajas" maxlength="5" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="camisa"></td>
                                                                </tr>
                                                                <tr>
                                                                        <td><b>Pantalón:</b></td>
                                                                        <td><input type="text" name="pantalon" value="" size="5" class="cajas" maxlength="5" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="pantalon"></td>
                                                                </tr>
                                                                <tr>
                                                                        <td><b>Zapato:</b></td>
                                                                        <td><input type="text" name="zapato" value="" size="5" class="cajas" maxlength="5" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="zapato"></td>
                                                                </tr>
                                                                <tr>

                                                                <tr><td><br></td></tr>
                                                                <tr>
                                                                        <td colspan="2"><input type="button" Value="Guardar" class="boton" onclick="chequearcampos()">&nbsp;<input type="reset" Value="Limpiar" class="boton"></th>
                                                                </tr>
                                                                 <tr><td><br></td></tr>
                                             </table>
                                          </form>
        <?
                                endwhile;
                             else:
                                  ?>
                                <script language="javascript">
                                        alert("Este empleado ya tiene la dotacion Grabada, debe de modificarla ?")
                                        history.back()
                                </script>
                                  <?
                             endif;
                        endif;
                }
        ?>
        </body>
</html>
