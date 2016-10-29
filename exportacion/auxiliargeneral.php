<html>
        <head>
                <title>Listado de Empleado</title>
        </head>
        <body>
        <?
                include("../conexion.php");
                $consulta="select incapacidad.nroinca,incapacidad.fechaini,incapacidad.fechater,sucursal.sucursal,incapacidad.dias,incapacidad.estado,incapacidad.estado,incapacidad.prorroga,zona.zona,tipoinca.concepto,empleado.basico,concat(nomemple, ' ' ,nomemple1, ' ' ,apemple, ' ' , apemple1) as nombres  ,incapacidad.cedemple,eps.eps
                                from maestro,sucursal,zona,incapacidad,empleado,tipoinca,eps
                                 where maestro.codmaestro=sucursal.codmaestro and
                                 sucursal.codsucursal=zona.codsucursal and
                                 zona.codzona=incapacidad.codzona and
                                 empleado.cedemple=incapacidad.cedemple and
                                 eps.codeps=incapacidad.codeps and
                                 tipoinca.tipoinca=incapacidad.tipoinca and
     							 incapacidad.fechaini between '$Desde' and '$Hasta' and
                                 maestro.codmaestro='$Nit' order by sucursal.sucursal,zona.zona,incapacidad.fechaini";
                $resultado=mysql_query($consulta) or die("Error al buscar incapacidades");
                $registros=mysql_num_rows($resultado);
                if ($registros==0):
                  ?>
                        <script language="javascript">
                                alert("No Existen Registros de Incapacidad")
                                history.back()
                        </script>
               <?
                else:
                     header("Content-type: application/vnd.ms-excel");
                     header("Content-Disposition: attachment; filename=Incapacidades.xls");
                     header("Pragma: no-cache");
                     header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                     header("Expires: 0");
                        ?>
                                <table border="0" align="center">
                                     <tr class="cajas">
                                        <td style='font-weight:bold;font-size:1.1em;'>Item</td>
                                        <td style='font-weight:bold;font-size:1.1em;'>Nro_Incapacidad</td>
                                        <td style='font-weight:bold;font-size:1.1em;'>Documento</td>
                                        <td style='font-weight:bold;font-size:1.1em;'>Empleado</td>
                                        <td style='font-weight:bold;font-size:1.1em;'>Fecha_Inicio</td>
                                        <td style='font-weight:bold;font-size:1.1em;'>Fecha_Final</td>
                                        <td style='font-weight:bold;font-size:1.1em;'>Dias</td>
										<td style='font-weight:bold;font-size:1.1em;'>Prorroga</td>
										<td style='font-weight:bold;font-size:1.1em;'>Salario</td>
										<td style='font-weight:bold;font-size:1.1em;'>Estado</td>
                                        <td style='font-weight:bold;font-size:1.1em;'>Eps</td>
                                         <td style='font-weight:bold;font-size:1.1em;'>Concepto</td>
										 <td style='font-weight:bold;font-size:1.1em;'>Zona</td>
                                         <td style='font-weight:bold;font-size:1.1em;'>Sucursal</td>
                                     </tr>
                                 <?
                                 $i=1;
                                while ($filas=mysql_fetch_array($resultado)):
                                  ?>
                                   <tr class="cajas">
                                        <td><?echo $i;?></td>
                                        <td><div align="left"><?echo $filas["nroinca"];?></div></td>
                                        <td><?echo $filas["cedemple"];?></td>
                                        <td><?echo $filas["nombres"];?></td>
                                        <td><?echo $filas["fechaini"];?></td>
                                        <td><?echo $filas["fechater"];?></td>
                                        <td><?echo $filas["dias"];?></td>
										 <td><?echo $filas["prorroga"];?></td>
										  <td><?echo $filas["basico"];?></td>
										 <td><?echo $filas["estado"];?></td>
                                        <td><?echo $filas["eps"];?></td>
                                        <td><?echo $filas["concepto"];?></td>
										<td><?echo $filas["zona"];?></td>
                                        <td><?echo $filas["sucursal"];?></td>
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
