<html>
        <head>
                <title>Listado de Empleado</title>
        </head>
        <body>
        <?
                include("../conexion.php");
                $consulta="select empleado.*,banco.*,zona.*,eps.*,pension.*,costo.* from empleado,banco,zona,eps,pension,costo where
                        empleado.codbanco=banco.codbanco and
                        empleado.codzona=zona.codzona and
                        empleado.codeps=eps.codeps and
                        empleado.codpension=pension.codpension and
                        empleado.codcosto=costo.codcosto";
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
                                        <th colspan="20">Listado de Empleados</th>
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
        ?>
                        </table>

        </body>
</html>
