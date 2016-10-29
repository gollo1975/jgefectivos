<html>
        <head>
                <title>Listado</title>
        </head>
        <body>
        <?
                include("../conexion.php");
                $consulta="select * from listado";
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
                                        <th colspan="9">Listado de Compensación</th>
                                </tr>
                                <tr>
                                        <th>Codigo</th>
                                        <th>Concepto</th>
                                </tr>
        <?
                        while ($filas=mysql_fetch_array($resultado))
                        {

        ?>
                                <tr>
                                        <td><?echo $filas["codcomp"];?></td>
                                        <td><?echo $filas["concepto"];?></td>
                              </tr>
        <?
                        }
                }
        ?>
                        </table>

        </body>
</html>
