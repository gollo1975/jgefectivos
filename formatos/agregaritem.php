<html>
        <head>
                <title>Item de Formatos</title>
                <LINK  REL="stylesheet" HREF="../estilo.css" type="text/css">
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
                        if (document.getElementById("codcosto").value.length <=0)
                        {
                            alert ("El campo [CODIGO] no puede estar vacío");
                            document.getElementById("codcosto").focus();
                            return;
                        }
                        if (document.getElementById("centro").value.length <=0)
                        {
                            alert ("El campo [DESCRPCION] no puede estar vacío ?");
                            document.getElementById("centro").focus();
                            return;
                        }
                         document.getElementById("matcentro").submit();

                    }
                </script>
        </head>
        <body>
                <?
                        if (!isset($codcosto))
                        {
                                include("../conexion.php");
                ?>
            <center><h4><u>Item de Formatos</u></h4></center>
             <form action="" method="post" id="matcentro">
                        <table border="0" align="center"
                                <tr>
                                        <td colspan="2"></td>
                                </tr>
                                 <tr><td><br></td></tr>
                                <tr>
                                        <td><b>Codigo:</b> </td>
                                        <td><input type="text" name="codcosto" value="" size="10" class="cajas" mexlength="10"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="codcosto">
                                </tr>
                                <tr>
                                        <td><b>Descripción:</b></td>
                                        <td><input type="text" name="centro" value="" size="40" mexlength="60" class="cajas"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="centro">
                                </tr>
                                <tr><td><br></td></tr>
                  <tr>
                                                <td colspan="2"><input type="button" Value="Guardar" class="boton" onclick="chequearcampos()">&nbsp;<input type="reset" Value="Limpiar" class="boton"></td>
                                        </tr>
                        </table>

                </form>
                   <?
                        }
                        else
                        {
                                include("../conexion.php");
                                $centro=strtoupper($centro);
                                $consulta="select * from itemfondo where codigo='$codcosto'";
                                $resultado=mysql_query($consulta) or die("consulta incorrecta");
                                $registros=mysql_num_rows($resultado);
                                if ($registros==0)
                                {
                                        $consulta="insert into itemfondo(codigo,concepto)
                                                        value('$codcosto','$centro')";
                                        $resultado=mysql_query($consulta) or die("Insercion incorrecta");
                                       echo "<script language=\"javascript\">";
                                       echo "open (\"../pie.php?msg=Se Grabo registros del Código Nro: $codcosto,$centro\",\"pie\");";
                                       echo "open(\"agregaritem.php\",\"_self\");";
                                       echo "</script>";
                          }
                                else
                                {
                ?>

                                        <script language="javascript">
                                                alert("El Registro ya Existe en la Base de Datos ?")
                                                open("agregaritem.php","_self")
                                        </script>
                 <?
                                }
                        }
                 ?>
        </body>
</html>
