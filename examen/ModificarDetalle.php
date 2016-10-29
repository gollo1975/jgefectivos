<html>
        <head>
                <title>Editar Registro</title>
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
                        $consulta="select *,zona.zona from parametroexamen,zona where parametroexamen.codzona='$codzona' and parametroexamen.codzona=zona.codzona";
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
                                 <form action="GrabarRelacion.php" method="post">
                                                <table border="0" align="center">
                                                        <tr>
                                                                <td colspan="2"></td>
                                                        </tr>
                                                        <tr><td><br></td></tr>
                                                        <tr>
                                                                <td><b>CodZona:</b></td>
                                                                <td><input type="text" name="codzona" value="<?echo $filas["codzona"];?>" readonly size="5" class="cajas"></td>
                                                        </tr>
                                                        <tr>
                                                                <td><b>Zona:</b></td>
                                                                <td><input type="text" name="zona" value="<?echo $filas["zona"];?>"class="cajas" size="50" readonly  onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="zona"></td>
                                                        </tr>
                                                         <tr>
                                                                <td><b>Tipo_Pago:</b></td>
                                                                  <td><select name="Pago" class="cajas">
                                                                  <option value="<?echo $filas["tipopago"];?>" selected><?echo $filas["tipopago"];?>
                                                                  <option value="USUARIA">USUARIA
                                                                  <option value="TEMPORAL">TEMPORAL
                                                                  <option value="EMPLEADO">EMPLEADO
                                                                  </select></td>
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
