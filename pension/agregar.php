<html>
        <head>
                <title>Agregar Fondos</title>
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
                        if (document.getElementById("pension").value.length <=0)
                        {
                            alert ("El campo Pension no puede estar vacío");
                            document.getElementById("pension").focus();
                            return;
                        }
                        if (document.getElementById("dirpension").value.length <=0)
                        {
                            alert ("El campo Dirección no puede estar vacío");
                            document.getElementById("dirpension").focus();
                            return;
                        }

                        if (document.getElementById("telpension").value.length <=0)
                        {
                            alert ("El campo Teléfono no puede estar vacío");
                            document.getElementById("telpension").focus();
                            return;
                        }
                        if (document.getElementById("munpension").value.length <=0)
                        {
                            alert ("El campo Municipio no puede estar vacío");
                            document.getElementById("munpension").focus();
                            return;
                        }

                        document.getElementById("matpension").submit();

                    }
                </script>
        </head>
        <body>
                <?
                        if (!isset($pension))
                        {
                                include("../conexion.php");
                ?>
                <center><h4>Ingresar Fondos</h4></center>
                <form action="" method="post" id="matpension">
                        <table border="0" align="center"
                                <tr>
                                        <td colspan=2><br></td>
                                </tr>
                                <tr>
                                        <td><b>Pension</b></td>
                                        <td><input type="text" name="pension" value="" size="40" mexlength="40" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="pension">
                                </tr>
                                <tr>
                                        <td><b>Direccion</b></td>
                                        <td><input type="text" name="dirpension" value="" size="40" mexlength="40" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="dirpension">
                                </tr>
                                <tr>
                                        <td><b>Telefono</b></td>
                                        <td><input type="text" name="telpension" value="" size="10" mexlength="7" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="telpension">
                                </tr>
                                <tr>
                                        <td><b>Municipio</b></td>
                                        <td><input type="text" name="munpension" value="" size="40" mexlength="30" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="munpension">
                                </tr>
                                <tr><td><br></td></tr>
                                <tr>
                                                <td colspan="2"><input type="button" Value="Guardar" class="boton" onclick="chequearcampos()">&nbsp;<input type="reset" Value="Limpiar" class="boton"></th>
                                        </tr>
                               <tr><td><br></td></tr>
                        </table>
                </form>
                <?
                        }
                        else
                        {
                                include("../conexion.php");
                                   $consulta = "select count(*) from pension";
                                   $result = mysql_query ($consulta);
                                   $sw = mysql_fetch_row($result);
                                   $pension = strtoupper ($pension);
                                   $dirpension = strtoupper ($dirpension);
                                   $munpension = strtoupper($munpension);
                                   if ($sw[0]>0):
                                       $consulta = "select max(cast(codpension as unsigned)) + 1 from pension";
                                       $result = mysql_query($consulta);
                                       $codpe = mysql_fetch_row($result);
                                       $codp = str_pad ($codpe[0], 3, "0" , STR_PAD_LEFT);
                                       $consulta="insert into pension (codpension,pension,dirpension,telpension,munpension)
                                                        value('$codp','$pension','$dirpension','$telpension','$munpension')";
                                        $resultado=mysql_query($consulta) or die("Insercion incorrecta");
                                   else:
                                     $codp="001";
                                     $consulta="insert into pension (codpension,pension,dirpension,telpension,munpension)
                                                        value('$codp','$pension','$dirpension','$telpension','$munpension')";
                                     $resultado=mysql_query($consulta) or die("Insercion incorrecta");
                                   endif;
                ?>

                                        <script language="javascript">
                                            open ("../pie?msg=Agregado Fondo de Pension","pie");
                                              open("agregar.php","_self");
                                        </script>
                <?

                        }
                 ?>
        </body>
</html>
