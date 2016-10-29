<html>
        <head>
                <title>Listado de Manejo</title>
        </head>
        <body>
        <?
                include("../conexion.php");
                $consulta="select * from manejo";
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
                                        <th colspan="9">Listado de Manejo</th>
                                </tr>
                                <tr>
                                        <th>Codigo</th>
                                        <th>descripcion</th>
                                </tr>
        <?
                        while ($filas=mysql_fetch_array($resultado))
                        {

        ?>
                                <tr>
                                        <td><?echo $filas["codmanejo"];?></td>
                                        <td><?echo $filas["descripcion"];?></td>
                              </tr>
        <?
                        }
                }
        ?>
                        </table>

        </body>
</html>
