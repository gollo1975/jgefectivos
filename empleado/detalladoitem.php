<html>
        <head>
                <title>Item de Costo</title>
                <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
                   <script language="javascript">
                    function ColorFoco(obj)
                    {
                        document.getElementById(obj).style.background="#9DFF9D"

                    }

                    function QuitarFoco(obj)
                    {
                        document.getElementById(obj).style.background="white"

                    }
                </script>
        </head>
        <body>

              <?
                        include("../conexion.php");
                        $consulta="select * from itemrequisito where codigo='$codcosto'";
                        $resultado=mysql_query($consulta) or die("consulta incorrecta");
                        $registros=mysql_num_rows($resultado);
                        if ($registros==0)
                        {
        ?>
                                <script language="javascript">
                                        alert("No Existen Registros")
                                        history.back()
                                </script>
        <?
                        }
                        else
                        {
                                while ($filas=mysql_fetch_array($resultado))
                                {
        ?>
                                 <center><h4><u>Datos a Modificar</u></h4></center>
                                 <form action="guardaritem.php" method="post">
                                                <table border="0" align="center">
                                                        <tr>
                                                                <td colspan="2"></td>
                                                        </tr>
                                                        <tr><td><br></td></tr>
                                                        <tr>
                                                                <td><b>Codigo:</b></td>
                                                                <td><input type="text" name="codigo" value="<?echo $filas["codigo"];?>" readonly size="5" class="cajas"></td>
                                                        </tr>
                                                        <tr>
                                                                <td><b>Centro:</b></td>
                                                                <td><input type="text" name="centro" value="<?echo $filas["descripcion"];?>"class="cajas" size="45" maxlength="40" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="centro"></td>
                                                        </tr>
                                                        <tr><td><br></td></tr>
                                                       <tr>
                                                                  <td colspan="2"><input type="submit" value="Guardar" class="boton"></td>
                                                        </tr>
        <?
                                }
                        }

        ?>
                                </form>
                </table>
        </body>
</html>
