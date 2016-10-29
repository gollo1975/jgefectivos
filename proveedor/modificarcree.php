<html>
        <head>
                <title>Modificacion del centro de  costo</title>
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
                        $consulta="select * from cree where codigocre='$NroCree'";
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
                                 <center><h4><u>Editar Actividades</u></h4></center>
                                 <form action="guardarcree.php" method="post">
                                                <table border="0" align="center">
                                                        <tr>
                                                                <td colspan="2"></td>
                                                        </tr>
                                                        <tr><td><br></td></tr>
                                                        <tr>
                                                                <td><b>Codigo:</b></td>
                                                                <td><input type="text" name="codigo" value="<?echo $filas["codigocre"];?>" readonly size="10" class="cajas"></td>
                                                        </tr>
                                                        <tr>
                                                                <td><b>Centro:</b></td>
                                                                <td><input type="text" name="concepto" value="<?echo $filas["concepto"];?>"class="cajas" size="60" maxlength="60" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="concepto"></td>
                                                        </tr>
                                                          <tr>
                                                                <td><b>Tarifa:</b></td>
                                                                <td><input type="text" name="valor" value="<?echo $filas["valor"];?>"class="cajas" size="10" maxlength="10" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="valor"></td>
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
