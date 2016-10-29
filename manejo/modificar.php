<html>
        <head>
                <title>Modificacion de Item</title>
               <LINK HREF="../estilo.css" REL="stylesheet"  type="text/css">
        </head>
        <body>
        <?
                if (!isset($codmanejo))
                {
        ?>
                        <center><h4><u>Modificar Item</u></h4></center>
                        <form action="" method="post">
                                <table border="0" align="center">
                                        <tr class="fondo">
                                                <td colspan="2"><br></td>
                                        </tr>
                                        <tr>
                                                <td><b>Digite del Código:</b></td>
                                                <td><input type="text" name="codmanejo" value="" size="10" maxleng="2"></td>
                                        </tr>
                                        <tr><td><br></td></tr>
                                        <tr>
                                                <td colspan="2"><input type="submit" Value="Buscar" class="boton">&nbsp;<input type="reset" Value="Limpiar" class="boton"></th>
                                        </tr>
                                </table>
                        </form>
        <?
                }
                elseif (empty($codmanejo))
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
                        $consulta="select * from manejo where codmanejo='$codmanejo'";
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
                                        <form action="guardar.php" method="post">
                                                <table border="0" align="center">
                                                        <td class="fondo">
                                                                <td colspan="2"><br></td>
                                                        </tr>
                                                        <tr>
                                                                <td><b>Codigo</b></td>
                                                                <td><input type="text" name="codmanejo" value="<?echo $filas["codmanejo"];?>" readonly></td>
                                                        </tr>
                                                        <tr>
                                                                <td><b>Descripcion</b></td>
                                                                <td><input type="text" name="descripcion" value="<?echo $filas["descripcion"];?>" size="40" maxlength="40" class="cajas"></td>
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
