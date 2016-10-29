<html>
        <head>
                <title>Eliminar Eps</title>
        </head>
        <body>
        <?
                if (!isset($codeps))
                {
        ?>
                        <form action="" method="post">
                                <table border="1" align="center">
                                        <tr>
                                                <th colspan="2">Eliminacion Pension</th>
                                        </tr>
                                        <tr>
                                                <td>Codigo</td>
                                                <td><input type="text" name="codeps" value="" size="10" maxleng="3"></td>
                                        </tr>
                                        <tr>
                                                <th colspan="2"><input type="submit" Value="Buscar">&nbsp;<input type="reset" Value="Limpiar"></th>
                                        </tr>
                                </table>
                        </form>
        <?
                }
                elseif (empty($codeps))
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
                        $consulta="select * from eps where codeps='$codeps'";
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
                                                        <th colspan="9">Datos de Eliminacion de Eps</th>
                                                </tr>
                                                <tr>
                                                        <th>Codigo</th>
                                                        <th>Eps</th>
                                                        <th>Direccion</th>
                                                        <th>Telefono</th>
                                                        <th>Municipio</th>
                                                </tr>
        <?

                                while ($filas=mysql_fetch_array($resultado))
                                {
        ?>
                                                <tr>
                                                        <td><?echo $filas["codeps"];?></td>
                                                        <td><?echo $filas["eps"];?></td>
                                                        <td><?echo $filas["direps"];?></td>
                                                        <td><?echo $filas["teleps"];?></td>
                                                        <td><?echo $filas["municipio"];?></td>
                                                </tr>
                                                <tr>
                                                        <th colspan="9"><input type="hidden" name="codeps" value="<?echo $filas["codeps"];?>"><input type="submit" value="Eliminar"></th>
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
