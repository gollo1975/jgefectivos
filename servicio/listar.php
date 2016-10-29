<html>
        <head>
                <title>Listado de Servicio</title>
        </head>
        <body>
        <?
                include("../conexion.php");
                $consulta="select * from servicio";
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
                                        <th colspan="9">Listado de Servicio</th>
                                </tr>
                                <tr>
                                        <th>Codigo</th>
                                        <th>Servicio</th>
                                </tr>
        <?
                        while ($filas=mysql_fetch_array($resultado))
                        {

        ?>
                                <tr>
                                        <td><?echo $filas["codservi"];?></td>
                                        <td><?echo $filas["servicio"];?></td>
                              </tr>
        <?
                        }
                }
        ?>
                        </table>

        </body>
</html>
