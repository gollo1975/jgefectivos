<html>
        <head>
                <title>Eliminar Tipo</title>
        </head>
        <body>
        <?
                if (!isset($tipocre))
                {
        ?>
                        <form action="" method="post">
                                <table border="1" align="center">
                                        <tr>
                                                <th colspan="2">Eliminacion Tipo</th>
                                        </tr>
                                        <tr>
                                                <td>Tipo</td>
                                                <td><input type="text" name="tipocre" value="" size="10" maxleng="10"></td>
                                        </tr>
                                        <tr>
                                                <th colspan="2"><input type="submit" Value="Buscar">&nbsp;<input type="reset" Value="Limpiar"></th>
                                        </tr>
                                </table>
                        </form>
        <?
                }
                elseif (empty($tipocre))
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
                        $consulta="select * from tipo where tipocre='$tipocre'";
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
        ?>
                                <form action="borrar.php" method="post">
                                        <table border="1" align="center">
                                                <tr>
                                                        <th colspan="9">Datos de Eliminacion de tipo</th>
                                                </tr>
                                                <tr>
                                                        <th>Tipo</th>
                                                        <th>Descripcion</th>
                                                </tr>
        <?

                                while ($filas=mysql_fetch_array($resultado))
                                {
        ?>
                                                <tr>
                                                        <td><?echo $filas["tipocre"];?></td>
                                                        <td><?echo $filas["descripcion"];?></td>
                                                </tr>
                                                <tr>
                                                        <th colspan="9"><input type="hidden" name="tipocre" value="<?echo $filas["tipocre"];?>"><input type="submit" value="Eliminar"></th>
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
