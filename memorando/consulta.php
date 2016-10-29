<html>
        <head>
                <title>Consulta de Empleados</title>
        </head>
        <body>
        <?
                if (!isset($campo))
                {
        ?>
                        <form action="" method="post">
                                <table border="1" align="center">
                                        <tr>
                                                <th colspan="9">Consulta Empleado</th>
                                        </tr>
                                        <tr>
                                                <td>Campo de Consulta</td>
                                                <td>Valor de Consulta</td>
                                        </tr>
                                        <tr>
                                                <td>    <select name="campo">
                                                                <option value="0">Seleccione una Opción
                                                                <option value="codemple">Codigo Empleado
                                                                <option value="cedemple">Cedula
                                                                <option value="nomemple">Nombre
                                                                <option value="apemple">Apellido
                                                                <option value="telemple">Telefono
                                                                <option value="diremple">Direccion
                                                                <option value="municipio">Municipio
                                                                <option value="bepper">Bepper
                                                                <option value="codbeper">Codigo
                                                                <option value="celular">Celular
                                                                <option value="cuenta">Cuenta
                                                                <option value="estado">Estado
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
                        if ($campo=='codemple' or $campo=='cedemple' or $campo=='telemple' or $campo=='bepper' or $campo=='codbeper' or $campo=='celular' or $campo=='cuenta')
                        {
                                $consulta="select empleado.*,banco.*,zona.*,eps.*,pension.*,costo.* from empleado,banco,zona,eps,pension,costo where
                                empleado.codbanco=banco.codbanco and
                                empleado.codzona=zona.codzona and
                                empleado.codeps=eps.codeps and
                                empleado.codpension=pension.codpension and
                                empleado.codcosto=costo.codcosto and  empleado.$campo='$valor'";
                         }
                        else
                        {
                                $consulta="select empleado.*,banco.*,zona.*,eps.*,pension.*,costo.* from empleado,banco,zona,eps,pension,costo where
                                empleado.codbanco=banco.codbanco and
                                empleado.codzona=zona.codzona and
                                empleado.codeps=eps.codeps and
                                empleado.codpension=pension.codpension and
                                empleado.codcosto=costo.codcosto and  empleado.$campo like '%$valor%'";
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
                                                <th colspan="30">Listado de Empleados</th>
                                        </tr>
                                        <tr>
                                                <th>Cod_empleado</th>
                                                <th>Cedula</th>
                                                <th>Nombre</th>
                                                <th>Apellido</th>
                                                <th>Telefono</th>
                                                <th>Direccion</th>
                                                <th>Municipio</th>
                                                <th>Bepper</th>
                                                <th>Codigo</th>
                                                <th>Celular</th>
                                                <th>Sexo</th>
                                                <th>Fecha Nac.</th>
                                                <th>Estado Civ.</th>
                                                <th>Cuenta</th>
                                                <th>Banco</th>
                                                <th>Zona</th>
                                                <th>Eps</th>
                                                <th>Pension</th>
                                                <th>Nomina</th>
                                                <th>Costo</th>
                                                <th>Estado</th>
                                       </tr>
        <?
                                while ($filas=mysql_fetch_array($resultado))
                                {
        ?>
                                        <tr>
                                                <td><?echo $filas["codemple"];?></td>
                                                <td><?echo $filas["cedemple"];?></td>
                                                <td><?echo $filas["nomemple"];?></td>
                                                <td><?echo $filas["apemple"];?></td>
                                                <td><?echo $filas["telemple"];?></td>
                                                <td><?echo $filas["diremple"];?></td>
                                                <td><?echo $filas["municipio"];?></td>
                                                <td><?echo $filas["bepper"];?></td>
                                                <td><?echo $filas["codbeper"];?></td>
                                                <td><?echo $filas["celular"];?></td>
                                                <td><?echo $filas["sexo"];?></td>
                                                <td><?echo $filas["fechanac"];?></td>
                                                <td><?echo $filas["estcivil"];?></td>
                                                <td><?echo $filas["cuenta"];?></td>
                                                <td><?echo $filas["bancos"];?></td>
                                                <td><?echo $filas["zona"];?></td>
                                                <td><?echo $filas["eps"];?></td>
                                                <td><?echo $filas["pension"];?></td>
                                                <td><?echo $filas["nomina"];?></td>
                                                <td><?echo $filas["centro"];?></td>
                                                <td><?echo $filas["estado"];?></td>
                                      </tr>
        <?
                                }
                        }
                }
        ?>
                        </table>

        </body>
</html>
