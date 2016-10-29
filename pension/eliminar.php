<html>
        <head>
                <title>Eliminar Pension</title>
        </head>
        <body>
        <?
                if (!isset($codpension))
                {
        ?>
                        <form action="" method="post">
                                <table border="1" align="center">
                                        <tr>
                                                <th colspan="2">Eliminacion Pension</th>
                                        </tr>
                                        <tr>
                                                <td>Codigo</td>
                                                <td><input type="text" name="codpension" value="" size="10" maxleng="3"></td>
                                        </tr>
                                        <tr>
                                                <th colspan="2"><input type="submit" Value="Buscar">&nbsp;<input type="reset" Value="Limpiar"></th>
                                        </tr>
                                </table>
                        </form>
        <?
                }
                elseif (empty($codpension))
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
                        $consulta="select * from pension where codpension='$codpension'";
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
                                                        <th colspan="9">Datos de Eliminacion de Pension</th>
                                                </tr>
                                                <tr>
                                                        <th>Codigo</th>
                                                        <th>Pension</th>
                                                        <th>Direccion</th>
                                                        <th>Telefono</th>
                                                        <th>Municipio</th>
                                                </tr>
        <?

                                while ($filas=mysql_fetch_array($resultado))
                                {
        ?>
                                                <tr>
                                                        <td><?echo $filas["codpension"];?></td>
                                                        <td><?echo $filas["pension"];?></td>
                                                        <td><?echo $filas["dirpension"];?></td>
                                                        <td><?echo $filas["telpension"];?></td>
                                                        <td><?echo $filas["munpension"];?></td>
                                                </tr>
                                                <tr>
                                                        <th colspan="9"><input type="hidden" name="codpension" value="<?echo $filas["codpension"];?>"><input type="submit" value="Eliminar"></th>
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
