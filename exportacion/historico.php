<html>
        <head>
                <title>Listado de memorandos</title>
        </head>
        <body>
        <?
                include("../conexion.php");
                $consulta="select empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1,memorando.radicado,memorando.fecha,memorando.ciudad,memorando.cedemple,memorando.asunto,contrato.fechater from empleado,contrato,memorando
                        where empleado.codemple=contrato.codemple and
                              empleado.cedemple=memorando.cedemple order by memorando.fecha";
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
                     header("Content-Disposition: attachment; filename=Listado de memorandos.xls");
                     header("Pragma: no-cache");
                     header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                     header("Expires: 0");
                        ?>
                                <table border="0" align="center">
                                     <tr class="cajas">
                                       <td style='font-weight:bold;font-size:1.1em;'>Item</td>
                                        <td style='font-weight:bold;font-size:1.1em;'>Radicado</td>
                                        <td style='font-weight:bold;font-size:1.1em;'>Documento</td>
                                        <td style='font-weight:bold;font-size:1.1em;'>Asociado</td>
                                        <td style='font-weight:bold;font-size:1.1em;'>Ciudad</td>
                                        <td style='font-weight:bold;font-size:1.1em;'>Fecha_Pro.</td>
                                        <td style='font-weight:bold;font-size:1.1em;'>Asunto</td>
                                        <td style='font-weight:bold;font-size:1.1em;'>Fecha_Ret.</td>
                                     </tr>
                                 <?
                                 $i=1;
                                while ($filas=mysql_fetch_array($resultado)):
                                  ?>
                                   <tr class="cajas">
                                        <td><?echo $i;?></td>
                                        <td><?echo $filas["radicado"];?></td>
                                        <td><?echo $filas["cedemple"];?></td>
                                        <td><? echo $filas["nomemple"];?>&nbsp;<? echo $filas["nomemple1"];?>&nbsp;<? echo $filas["apemple"];?>&nbsp;<? echo $filas["apemple1"];?></td>
                                        <td><?echo $filas["ciudad"];?></td>
                                        <td><?echo $filas["fecha"];?></td>
                                        <td><?echo $filas["asunto"];?></td>
                                         <td><?echo $filas["fechater"];?></td>
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
