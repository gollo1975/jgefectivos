<html>
        <head>
                <title>Listado de Empleado</title>
        </head>
        <body>
        <?
                include("../conexion.php");
                $consulta="select empleado.*,municipio.municipio,contrato.salario,contrato.fechainic,contrato.cargo,eps.eps,pension.pension from empleado,contrato,zona,eps,pension,municipio where
                       zona.codzona=empleado.codzona and
                       empleado.codemple=contrato.codemple and
                       empleado.codmuni=municipio.codmuni and
                       empleado.codeps=eps.codeps and
                       empleado.codpension=pension.codpension and
                       zona.codzona='$codzona'and
                       contrato.fechater='0000-00-00'order by empleado.nomemple,empleado.apemple";
                $resultado=mysql_query($consulta) or die("Error al buscar empleados");
                $registros=mysql_num_rows($resultado);
                if ($registros==0):
                  ?>
                        <script language="javascript">
                                alert("No Existen Registros para la exportación")
                                history.back()
                        </script>
               <?
                else:
                    header("Content-type: application/vnd.ms-excel");
                     header("Content-Disposition: attachment; filename=Empleados activos.xls");
                     header("Pragma: no-cache");
                     header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                     header("Expires: 0");
                        ?>
                                <table border="0" align="center">
                                     <tr class="cajas">
                                        <td style='font-weight:bold;font-size:1.1em;'>Nro</td>
                                        <td style='font-weight:bold;font-size:1.1em;'>Documento</td>
                                        <td style='font-weight:bold;font-size:1.1em;'>Nombre 1</td>
                                        <td style='font-weight:bold;font-size:1.1em;'>Nombre 2</td>
                                        <td style='font-weight:bold;font-size:1.1em;'>Apellido 1</td>
                                        <td style='font-weight:bold;font-size:1.1em;'>Apellido 2</td>
                                        <td style='font-weight:bold;font-size:1.1em;'>Teléfono</td>
                                        <td style='font-weight:bold;font-size:1.1em;'>Celular</td>
                                        <td style='font-weight:bold;font-size:1.1em;'>Dirección</td>
                                        <td style='font-weight:bold;font-size:1.1em;'>Municipio</td>
                                        <td style='font-weight:bold;font-size:1.1em;'>Sexo</td>
                                        <td style='font-weight:bold;font-size:1.1em;'>Fecha_Nac.</td>
                                        <td style='font-weight:bold;font-size:1.1em;'>Cuenta</td>
                                        <td style='font-weight:bold;font-size:1.1em;'>F_Ingreso</td>
                                        <td style='font-weight:bold;font-size:1.1em;'>Salario</td>
                                        <td style='font-weight:bold;font-size:1.1em;'>Cargo</td>
                                        <td style='font-weight:bold;font-size:1.1em;'>Eps</td>
                                        <td style='font-weight:bold;font-size:1.1em;'>Pensión</td>
                                     </tr>
                                 <?
                                 $i=1;
                                while ($filas=mysql_fetch_array($resultado)):
                                  ?>
                                   <tr class="cajas">
                                        <td><?echo $i;?></td>
                                        <td><?echo $filas["cedemple"];?></td>
                                        <td><?echo $filas["nomemple"];?></td>
                                        <td><?echo $filas["nomemple1"];?></td>
                                        <td><?echo $filas["apemple"];?></td>
                                        <td><?echo $filas["apemple1"];?></td>
                                        <td><?echo $filas["telemple"];?></td>
                                        <td><?echo $filas["celular"];?></td>
                                        <td><?echo $filas["diremple"];?></td>
                                        <td><?echo $filas["municipio"];?></td>
                                        <td><?echo $filas["sexo"];?></td>
                                        <td><?echo $filas["fechanac"];?></td>
                                        <td><?echo $filas["cuenta"];?></td>
                                        <td><?echo $filas["fechainic"];?></td>
                                        <td><?echo $filas["salario"];?></td>
                                        <td><?echo $filas["cargo"];?></td>
                                        <td><?echo $filas["eps"];?></td>
                                        <td><?echo $filas["pension"];?></td>
                                       </tr>
                               <?
                               $i=$i+1;
                              endwhile;
                              ?>
                            </table>
                              <?
                endif;
                ?>
        </body>
</html>
