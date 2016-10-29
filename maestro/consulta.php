<html>
        <head>
                <title>Consulta de Maestro</title>
        </head>
        <body>
        <?
                if (!isset($campo))
                {
        ?>
                        <form action="" method="post">
                                <table border="1" align="center">
                                        <tr>
                                                <th colspan="8">Consulta Maestro</th>
                                        </tr>
                                        <tr>
                                                <td>Campo de Consulta</td>
                                                <td>Valor de Consulta</td>
                                        </tr>
                                        <tr>
                                                <td>    <select name="campo">
                                                                <option value="codmaestro">Codigo
                                                                <option value="dvmaestro">Dv
                                                                <option value="nomaestro">Nombre
                                                                <option value="dirmaestro">Direccion
                                                                <option value="telmaestro">Teléfono
                                                                <option value="faxmaestro">Fax
                                                                <option value="email">Email
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
                        if ($campo=='codmaestro' or $campo=='dvmaestro' or $campo=='telmaestro' or $campo=='faxmaestro')
                        {
                                $consulta="select * from maestro where $campo='$valor'";
                        }
                        else
                        {
                                $consulta="select * from maestro where  $campo like '%$valor%'";
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
                                                <th colspan="8">Listado de Maestro</th>
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
                }
        ?>
                        </table>

        </body>
</html>
