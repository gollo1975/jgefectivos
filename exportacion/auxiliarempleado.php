<html>
        <head>
                <title>Listado de Empleado</title>
        </head>
        <body>
        <?
                include("../conexion.php");
                $consulta="select zona.zona,empleado.*,banco.bancos, municipio.municipio as muni,contrato.salario,contrato.fechainic,contrato.cargo,eps.eps,pension.pension,empleado.pension as ppension, caja.nombre from caja,eps,pension,zona,empleado,contrato,municipio, banco
                        where zona.codzona=empleado.codzona and
                             empleado.codmuni=municipio.codmuni and
                             empleado.codeps=eps.codeps and
                             empleado.codpension=pension.codpension and
                             empleado.codemple=contrato.codemple and
							 contrato.codigo_caja_pk=caja.codigo_caja_pk and
                             zona.codzona='$codzona' and
							 empleado.codbanco = banco.codbanco and
                             contrato.fechater='0000-00-00'order by empleado.codemple";
                $resultado=mysql_query($consulta) or die("Error al buscar empleados");
                $registros=mysql_num_rows($resultado);
                if ($registros==0):
                  ?>
                        <script language="javascript">
                                alert("No Existen Registros")
                                history.back()
                        </script>
               <?
                else:
                     header("Content-type: application/vnd.ms-excel");
                     header("Content-Disposition: attachment; filename=Empleados Activos.xls");
                     header("Pragma: no-cache");
                     header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                     header("Expires: 0");
                        ?>
                                <table border="0" align="center">
                                     <tr class="cajas">
                                        <td style='font-weight:bold;font-size:1.1em;'>Nro</td>
                                        <td style='font-weight:bold;font-size:1.1em;'>Codigo</td>
                                        <td style='font-weight:bold;font-size:1.1em;'>Documento</td>
                                        <td style='font-weight:bold;font-size:1.1em;'>Nombre 1</td>
                                        <td style='font-weight:bold;font-size:1.1em;'>Nombre 2</td>
                                        <td style='font-weight:bold;font-size:1.1em;'>Apellido 1</td>
                                        <td style='font-weight:bold;font-size:1.1em;'>Apellido 2</td>
                                        <td style='font-weight:bold;font-size:1.1em;'>Teléfono</td>
										<td style='font-weight:bold;font-size:1.1em;'>Celular</td>
                                        <td style='font-weight:bold;font-size:1.1em;'>Dirección</td>
                                        <td style='font-weight:bold;font-size:1.1em;'>Municipio</td>
                                        <td style='font-weight:bold;font-size:1.1em;'>Barrio</td>
                                        <td style='font-weight:bold;font-size:1.1em;'>Sexo</td>
                                        <td style='font-weight:bold;font-size:1.1em;'>Fecha_Nac.</td>
										<td style='font-weight:bold;font-size:1.1em;'>Est_Civil</td>
										<td style='font-weight:bold;font-size:1.1em;'>Rh</td>
                                        <td style='font-weight:bold;font-size:1.1em;'>Cuenta</td>
										<td style='font-weight:bold;font-size:1.1em;'>Banco</td>
                                        <td style='font-weight:bold;font-size:1.1em;'>Email</td>
                                        <td style='font-weight:bold;font-size:1.1em;'>Eps</td>
                                        <td style='font-weight:bold;font-size:1.1em;'>Pension</td>
										<td style='font-weight:bold;font-size:1.1em;'>Caja_Compensacion</td>
                                        <td style='font-weight:bold;font-size:1.1em;'>F_Ingreso</td>
                                        <td style='font-weight:bold;font-size:1.1em;'>Salario</td>
                                        <td style='font-weight:bold;font-size:1.1em;'>Cargo</td>
                                        <td style='font-weight:bold;font-size:1.1em;'>Zona</td>
                                        <td style='font-weight:bold;font-size:1.1em;'>Nivel_Arp</td>
                                        <td style='font-weight:bold;font-size:1.1em;'>% Pensión</td>  
                                     </tr>
                                 <?
                                 $i=1;
                                while ($filas=mysql_fetch_array($resultado)):
                                  ?>
                                   <tr class="cajas">
                                        <td><?echo $i;?></td>
					<td><?echo $filas["codemple"];?></td>
                                        <td><div align="left"><?echo $filas["cedemple"];?></div></td>
                                        <td><?echo $filas["nomemple"];?></td>
                                        <td><?echo $filas["nomemple1"];?></td>
                                        <td><?echo $filas["apemple"];?></td>
                                        <td><?echo $filas["apemple1"];?></td>
                                        <td><?echo $filas["telemple"];?></td>
										<td><?echo $filas["celular"];?></td>
                                        <td><?echo $filas["diremple"];?></td>
                                        <td><?echo $filas["muni"];?></td>
                                        <td><?echo $filas["municipio"];?></td>
                                        <td><?echo $filas["sexo"];?></td>
                                        <td><?echo $filas["fechanac"];?></td>
										<td><?echo $filas["estcivil"];?></td>
										<td><?echo $filas["rh"];?></td>
                                        <td><?echo $filas["cuenta"];?></td>
										<td><?echo $filas["bancos"];?></td>
                                        <td><?echo $filas["email"];?></td>  
                                        <td><?echo $filas["eps"];?></td>
                                        <td><?echo $filas["pension"];?></td>
										<td><?echo $filas["nombre"];?></td>
                                        <td><?echo $filas["fechainic"];?></td>
                                        <td><?echo $filas["salario"];?></td>
                                        <td><?echo $filas["cargo"];?></td>
                                        <td><?echo $filas["zona"];?></td>
                                        <td><?echo $filas["nivel"];?></td>
                                        <td><?echo $filas["ppension"];?></td>
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
