<html>
        <head>
                <title>Listado de Clientes</title>
        </head>
        <body>
        <?
                include("../conexion.php");
                $consulta="select * from maestro";
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
                        <table border="1" align="center">
                                <tr>
                                        <th colspan="9">Listado de Maestro</th>
                                </tr>
                                <tr>
                                        <th>Codigo</th>
                                        <th>Dv</th>
                                        <th>Nombre</th>
                                        <th>Direccion</th>
                                        <th>Teléfono</th>
                                        <th>Fax</th>
                                        <th>Municipio</th>
                                        <th>Email</th>
                                </tr>
        <?
                        while ($filas=mysql_fetch_array($resultado))
                        {

        ?>
                                <tr>
                                        <td><?echo $filas["codmaestro"];?></td>
                                        <td><?echo $filas["dvmaestro"];?></td>
                                        <td><?echo $filas["nomaestro"];?></td>
                                        <td><?echo $filas["dirmaestro"];?></td>
                                        <td><?echo $filas["telmaestro"];?></td>
                                        <td><?echo $filas["faxmaestro"];?></td>
                                        <td><?echo $filas["munmaestro"];?></td>
                                        <td><?echo $filas["email"];?></td>
                                </tr>
        <?
                        }
                }
        ?>
                        </table>

        </body>
</html>
