<html>
        <head>
                <title>Consulta de Sucursal</title>
        </head>
        <body>
        <?
                if (!isset($campo))
                {
        ?>
                        <form action="" method="post">
                                <table border="1" align="center">
                                        <tr>
                                                <th colspan="8">Consulta Sucursal</th>
                                        </tr>
                                        <tr>
                                                <td>Campo de Consulta</td>
                                                <td>Valor de Consulta</td>
                                        </tr>
                                        <tr>
                                                <td>    <select name="campo">
                                                                <option value="codsucursal">Codigo
                                                                <option value="sucursal">Sucursal
                                                                <option value="dirsucursal">Direccion
                                                                <option value="telsucursal">Telefono
                                                                <option value="faxsucursal">Fax
                                                                <option value="musucursal">Municipio
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
                        if ($campo=='codsucursal' or $campo=='telmaestro' or $campo=='faxmaestro')
                        {
                                $consulta="select sucursal.*,departamento.*,maestro.* from sucursal,departamento,maestro where
                                        sucursal.codepart=departamento.codepart and sucursal.codmaestro=maestro.codmaestro and sucursal.$campo='$valor'";
                        }
                        else
                        {
                                $consulta="select sucursal.*,departamento.*,maestro.* from sucursal,departamento,maestro where
                                        sucursal.codepart=departamento.codepart and sucursal.codmaestro=maestro.codmaestro and sucursal.$campo like '%$valor%'";
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
                                                <th>Cod_Sucursal</th>
                                                   <th>Sucursal</th>
                                                   <th>Dirección</th>
                                                   <th>teléfono</th>
                                                   <th>Fax</th>
                                                   <th>Municipio</th>
                                                   <th>Departamento</th>
                                                   <th>Email</th>
                                                   <th>Maestro</th>
                                        </tr>
        <?
                                while ($filas=mysql_fetch_array($resultado))
                                {
        ?>
                                        <tr>
                                                <td><?echo $filas["codsucursal"];?></td>
                                                  <td><?echo $filas["sucursal"];?></td>
                                                  <td><?echo $filas["dirsucursal"];?></td>
                                                  <td><?echo $filas["telsucursal"];?></td>
                                                  <td><?echo $filas["faxsucursal"];?></td>
                                                  <td><?echo $filas["munmaestro"];?></td>
                                                  <td><?echo $filas["departamento"];?></td>
                                                  <td><?echo $filas["email"];?></td>
                                                  <td><?echo $filas["nomaestro"];?></td>
                                        </tr>
        <?
                                }
                        }
                }
        ?>
                        </table>

        </body>
</html>
