<html>
        <head>
                <title>Consulta de Salario</title>
        </head>
        <body>
        <?
                if (!isset($campo))
                {
        ?>
                        <form action="" method="post">
                                <table border="1" align="center">
                                        <tr>
                                                <th colspan="8">Consulta Salario</th>
                                        </tr>
                                        <tr>
                                                <td>Campo de Consulta</td>
                                                <td>Valor de Consulta</td>
                                        </tr>
                                        <tr>
                                                <td>    <select name="campo">
                                                                <option value="codsala">Codigo
                                                                <option value="desala">Descripcion
                                                                <option value="hora">Hora
                                                                <option value="pension">Pension
                                                                <option value="nomina">Nomina
                                                                <option value="salud">Salud
                                                                <option value="aporte">Aporte
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
                        if ($campo=='desala')
                        {
                                $consulta="select * from salario where  $campo like '%$valor%'";
                          }
                        else
                        {
                                $consulta="select * from salario where $campo='$valor'";
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
                                                <th>Descripcion</th>
                                                <th>Hora</th>
                                                <th>Pension</th>
                                                <th>Nomina</th>
                                                <th>Salud</th>
                                                <th>Aporte</th>
                                        </tr>
        <?
                                while ($filas=mysql_fetch_array($resultado))
                                {
        ?>
                                        <tr>
                                                <td><?echo $filas["codsala"];?></td>
                                                <td><?echo $filas["desala"];?></td>
                                                <td><?echo $filas["hora"];?></td>
                                                <td><?echo $filas["pension"];?></td>
                                                <td><?echo $filas["nomina"];?></td>
                                                <td><?echo $filas["salud"];?></td>
                                                <td><?echo $filas["aporte"];?></td>
                                        </tr>
        <?
                                }
                        }
                }
        ?>
                        </table>

        </body>
</html>
