<html>
        <head>
                <title>Modificacion de Item del crédito</title>
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
                      function validar()
                    {
                       if (document.getElementById("codigo").value.length <=0)
                        {
                            alert ("Digite el codigo de crédito a Modificar");
                            document.getElementById("codigo").focus();
                            return;
                        }
                        document.getElementById("matitem").submit();
                    }
                </script>
        </head>
        <body>
        <?
                if (!isset($codigo))
                {
        ?>
                        <center><h4><u>Modificar Datos</u></h4></center>
                        <form action="" method="post" id="matitem">
                                <table border="0" align="center" >
                                        <tr><td><br></td></tr>
                                        <tr>
                                                <td colspan="1"><b>Código Crédito:</b></td>
                                                <td colspan="1"><input type="text" name="codigo" value="" size="10" maxlengt="13" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="codigo"></td>
                                        </tr>
                                        <tr><td><br></td></tr>
                                        <tr>
                                                <td colspan="2"><input type="button" Value="Buscar" class="boton" onclick="validar()"></td>
                                        </tr>
                                        <tr><td><br></td></tr>
                                </table>
                        </form>
        <?
                }
                else
                {
                        include("../conexion.php");
                        $consulta="select * from tipo where tipocre='$codigo'";
                        $resultado=mysql_query($consulta) or die("consulta incorrecta");
                        $registros=mysql_num_rows($resultado);
                        if ($registros==0)
                        {
        ?>
                                <script language="javascript">
                                        alert("El dato no existe en sistema ?")
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
                                        <form action="guardar.php" method="post">
                                                <table border="0" align="center">
                                                        <tr><td><br></td></tr>
                                                        <tr>
                                                                <td><b>Código:</b></td>
                                                                <td><input type="text" name="tipocre" value="<?echo $filas["tipocre"];?>" size="10" class="cajas"readonly onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="codigo"></td>
                                                        </tr>
                                                        <tr>
                                                                <td><b>Descripcion:</b></td>
                                                                <td><input type="text" name="descripcion" value="<?echo $filas["descripcion"];?>" class="cajas" size="50" maxlength="50" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="descripcion"></td>
                                                        </tr>
                                                        <tr><td><br></td></tr>
                                                       <tr>
                                                                  <td colspan="2"><input type="submit" value="Guardar" class="boton"></th>
                                                        </tr>
        <?
                                }
                        }
                }
        ?>
                                </form>
                </table>
        </body>
</html>
