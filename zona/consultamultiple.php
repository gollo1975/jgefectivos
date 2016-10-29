<html>
        <head>
                <title>Consulta de Zona</title>
        </head>
        <body>
        <?
                if (!isset($campo))
                {
        ?>
                        <form action="" method="post">
                                <table border="1" align="center">
                                        <tr>
                                                <th colspan="8">Consulta Zona</th>
                                        </tr>
                                        <tr>
                                                <td>Campo de Consulta</td>
                                                <td>Valor de Consulta</td>
                                        </tr>
                                        <tr>
                                                <td>    <select name="campo">
                                                                <option value="codzona">Codigo
                                                                <option value="zona">Zona
                                                                <option value="telzona">Telefono
                                                                <option value="faxzona">Fax
                                                                <option value="dirzona">Direccion
                                                                <option value="barzona">Barrio
                                                                <option value="emailzona">Email
                                                                <option value="nitzona">Nit
                                                                <option value="nomina">Nomina
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
                        if ($campo=='codzona' or $campo=='telzona' or $campo=='faxzona' or $campo='nitzona' or $campo='$nomina')
                        {
                                $consulta="select zona.*,sucursal.* from zona,sucursal where
                                        zona.codsucursal=sucursal.codsucursal and zona.$campo='$valor'";
                        }
                        else
                        {
                                $consulta="select zona.*,sucursal.* from zona,sucursal where
                                        zona.codsucursal=sucursal.codsucursal and zona.$campo like '%$valor%'";
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
                                                <th colspan="12">Listado de Maestro</th>
                                        </tr>
                                        <tr>
                                                <th>Cod_Zona</th>
                                                   <th>Zona</th>
                                                   <th>Telefono</th>
                                                   <th>Fax</th>
                                                   <th>Direccion</th>
                                                   <th>Barrio</th>
                                                   <th>Email</th>
                                                   <th>Sucursal</th>
                                                   <th>Nit</th>
                                                   <th>Digito</th>
                                                   <th>Fecha</th>
                                                   <th>Nomina</th>
                                        </tr>
        <?
                                while ($filas=mysql_fetch_array($resultado))
                                {
        ?>
                                        <tr>
                                                <td><?echo $filas["codzona"];?></td>
                                                  <td><?echo $filas["zona"];?></td>
                                                  <td><?echo $filas["telzona"];?></td>
                                                  <td><?echo $filas["faxzona"];?></td>
                                                  <td><?echo $filas["dirzona"];?></td>
                                                  <td><?echo $filas["barzona"];?></td>
                                                  <td><?echo $filas["emailzona"];?></td>
                                                  <td><?echo $filas["sucursal"];?></td>
                                                  <td><?echo $filas["nitzona"];?></td>
                                                  <td><?echo $filas["dvzona"];?></td>
                                                  <td><?echo $filas["fechaini"];?></td>
                                                  <td><?echo $filas["nomina"];?></td>
                                        </tr>
        <?
                                }
                        }
                }
        ?>
                        </table>

        </body>
</html>
