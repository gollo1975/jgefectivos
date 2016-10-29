<html>
        <head>
                <title>Consulta de Pension</title>
        </head>
        <body>
        <?
                if (!isset($campo))
                {
        ?>
                        <form action="" method="post">
                                <table border="1" align="center">
                                        <tr>
                                                <th colspan="8">Consulta Pension</th>
                                        </tr>
                                        <tr>
                                                <td>Campo de Consulta</td>
                                                <td>Valor de Consulta</td>
                                        </tr>
                                        <tr>
                                                <td>    <select name="campo">
                                                                <option value="codpension">Codigo
                                                                <option value="pension">Pension
                                                                <option value="dirpension">Direccion
                                                                <option value="telpension">Telefono
                                                                <option value="munpension">Municipio
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
                        if ($campo=='codpension' or $campo=='telpension')
                        {
                                $consulta="select * from pension where $campo='$valor'";
                         }
                        else
                        {
                                $consulta="select * from pension where  $campo like '%$valor%'";
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
                                                <th colspan="8">Listado de Salario</th>
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
        <?
                                }
                        }
                }
        ?>
                        </table>

        </body>
</html>
