<html>
        <head>
                <title>Listado de Tipo</title>
        </head>
        <body>
        <?
                include("../conexion.php");
                $consulta="select * from tipo";
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
                                        <th colspan="9">Listado de costo</th>
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
        <?
                        }
                }
        ?>
                        </table>

        </body>
</html>
