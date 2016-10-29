<html>

<head>
  <title>Exportar detalle del servicio</title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
 </head>
 <input type="hidden" name="ivag" value="<? echo $ivag;?>">
 <input type="hidden" name="cuenta1" value="<? echo $cuenta1;?>">
 <input type="hidden" name="cuenta2" value="<? echo $cuenta2;?>">
 <input type="hidden" name="valor" value="<? echo $valor;?>">
 <input type="hidden" name="valor1" value="<? echo $valor1;?>">
 <input type="hidden" name="campo" value="<? echo $campo;?>">
  <input type="hidden" name="banco" value="<? echo $banco;?>">

<?
include ("../conexion.php");

                $consulta="select decobrozona.conse,decobrozona.cedemple, decobrozona.empleado, decobrozona.tiempo, zona.zona from zona,cobrozona,decobrozona,empleado
                 where zona.codzona=cobrozona.codzona and
                      decobrozona.cedemple=empleado.cedemple and
                      cobrozona.codigo=decobrozona.codigo and
                      zona.codzona='$campo' and
                      cobrozona.codigo='$codigo' order by decobrozona.empleado ";
                 $resultado=mysql_query($consulta) or die("Error en la busqueda de informacion $consulta ");
                 $registros=mysql_num_rows($resultado);
                  if($registros!=0):
                     header("Content-type: application/vnd.ms-excel");
                     header("Content-Disposition: attachment; filename=Detalle del servicioTE.xls");
                     header("Pragma: no-cache");
                     header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                     header("Expires: 0");
                     ?>
                        <table border="0" align="center" >
                         <tr class="cajas">
                            <td style='font-weight:bold;font-size:1.0em;'>Nro</td>
                            <td style='font-weight:bold;font-size:1.0em;'>Documento</td>
                            <td style='font-weight:bold;font-size:1.0em;'>Empleado</td>
                            <td style='font-weight:bold;font-size:1.0em;'>Tiempo Extra</td>
                            <td style='font-weight:bold;font-size:1.0em;'>Zona</td>
                         </tr>
                            <?
                            $l=1;
                          while ($filas=mysql_fetch_array($resultado)):
                           /* $aux=number_format($filas["basico"],0);
                            $aux1=number_format($filas["tiempo"],0);
                            $aux2=number_format($filas["ayuda"],0);
                            $aux3=number_format($filas["ss"],0);
                            $aux4=number_format($filas["vlreps"],0);
                            $aux5=number_format($filas["vlrpension"],0);
                            $aux6=number_format($filas["cp"],0);
                            $aux7=number_format($filas["ps"],0);
                            $aux8=number_format($filas["admon"],0);
                            $aux9=number_format($filas["iva"],0);*/
                            ?>
                            <tr class="cajas">
                              <td><? echo $l;?></td>
                              <td><? echo $filas["cedemple"];?></td>
                              <td><? echo $filas["empleado"];?></td>
                              <td><? echo $filas["tiempo"];?></td>
                              <td><? echo $filas["zona"];?></td>  
                            </tr>
                            <?
                            $l=$l+1;
                          endwhile;
                            ?>
                            </table>
                           <?
                   else:
                      ?>
                         <script language="javascript">
                            alert("No hay registros De Facturacion para esta Zona ?")
                            history.back()
                         </script>
                         <?
                   endif;
  ?>
</body>
</html>
