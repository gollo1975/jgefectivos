<html>
        <head>
                <title>Consulta de Eps</title>
        </head>
        <body>
        <?
                if (!isset($campo))
                {
        ?>
                        <form action="" method="post">
                                <table border="1" align="center">
                                        <tr>
                                                <th colspan="8">Consulta Eps</th>
                                        </tr>
                                        <tr>
                                                <td>Campo de Consulta</td>
                                                <td>Valor de Consulta</td>
                                        </tr>
                                        <tr>
                                                <td>    <select name="campo">
                                                                <option value="codeps">Codigo
                                                                <option value="eps">Eps
                                                                <option value="direps">Direccion
                                                                <option value="teleps">Telefono
                                                                <option value="municipio">Municipio
                                                     </select></td>
                                                <td><input type="text" name="valor" value="" size="40" maxleng="40"></td>
                                        </tr>
                                        <tr>
                                                <th colspan="2"><input type="submit" Value="Buscar">&nbsp;<input type="reset" Value="Limpiar"></th>
                                        </tr>
                                </table>
                        </form>
        <?
                }
                elseif (!isset($valor))
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
                        if ($campo=='codeps' or $campo=='teleps')
                        {
                                $consulta="select * from eps where $campo='$valor'";
                         }
                        else
                        {
                                $consulta="select * from eps where  $campo like '%$valor%'";
                        }
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
                                                <th colspan="8">Listado de Eps</th>
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
        <?
                                }
                        }
                }
        ?>
                        </table>

        </body>
</html>
