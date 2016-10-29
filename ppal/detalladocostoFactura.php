<html>

<head>
  <title>Exportar detalle del centro de costo</title>
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

                $consulta="select dezonacosto.* from zona,zonacosto,dezonacosto
                 where zona.codzona=zonacosto.codzona and
                       zonacosto.codigo=dezonacosto.codigo and
                       zona.codzona='$campo' and
                       dezonacosto.codigo='$codigo'";
                 $resultado=mysql_query($consulta) or die("Error en la busqueda de informacion $consulta ");
                 $registros=mysql_num_rows($resultado);
                  if($registros!=0):
                     header("Content-type: application/vnd.ms-excel");
                     header("Content-Disposition: attachment; filename=Detalle del servicio.xls");
                     header("Pragma: no-cache");
                     header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                     header("Expires: 0");
                     ?>
                        <table border="0" align="center" >
                         <tr class="cajas">
                            <td style='font-weight:bold;font-size:1.0em;'>Nro</td>
                            <td style='font-weight:bold;font-size:1.0em;'>Documento</td>
                            <td style='font-weight:bold;font-size:1.0em;'>Empleado</td>
                            <td style='font-weight:bold;font-size:1.0em;'>Básico</td>
                            <td style='font-weight:bold;font-size:1.0em;'>Tiempo Extra</td>
                            <td style='font-weight:bold;font-size:1.0em;'>Total Auxilio</td>
                            <td style='font-weight:bold;font-size:1.0em;'>Ayuda_Trans.</td>
                            <td style='font-weight:bold;font-size:1.0em;'>Vlr_Arp</td>
                            <td style='font-weight:bold;font-size:1.0em;'>Vlr_Eps</td>
                            <td style='font-weight:bold;font-size:1.0em;'>Vlr_Pensión</td>
                            <td style='font-weight:bold;font-size:1.0em;'>Caja</td>
                            <td style='font-weight:bold;font-size:1.0em;'>Sena</td>
                            <td style='font-weight:bold;font-size:1.0em;'>Icbf</td>
                            <td style='font-weight:bold;font-size:1.0em;'>Prestaciones</td>
                            <td style='font-weight:bold;font-size:1.0em;'>Vacación</td>
                            <td style='font-weight:bold;font-size:1.0em;'>Admon</td>
                            <td style='font-weight:bold;font-size:1.0em;'>Iva</td>
                            <td style='font-weight:bold;font-size:1.0em;'>Novedad</td>
                            <td style='font-weight:bold;font-size:1.0em;'>%Arp</td>
                            <td style='font-weight:bold;font-size:1.0em;'>%Eps</td>
                            <td style='font-weight:bold;font-size:1.0em;'>%Pensión</td>
                            <td style='font-weight:bold;font-size:1.0em;'>Cargo</td>
                         </tr>
                            <?
                            $l=1;
                          while ($filas=mysql_fetch_array($resultado)):
                            ?>
                            <tr class="cajas">
                              <td><? echo $l;?></td>
                              <td><? echo $filas["cedemple"];?></td>
                              <td><? echo $filas["empleado"];?></td>
                              <td><? echo $filas["basico"];?></td>
                              <td><? echo $filas["tiempo"];?></td>
                              <td><? echo $filas["tauxilio"];?></td> 
                              <td><? echo $filas["ayuda"];?></td>
                              <td><? echo $filas["ss"];?></td>
                              <td><? echo $filas["vlreps"];?></td>
                              <td><? echo $filas["vlrpension"];?></td>
                              <td><? echo $filas["cp"];?></td>
                              <td><? echo $filas["vlrsena"];?></td>
                              <td><? echo $filas["vlricbf"];?></td>
                              <td><? echo $filas["ps"];?></td>
                              <td><? echo $filas["vacacion"];?></td> 
                              <td><? echo $filas["admon"];?></td>
                              <td><? echo $filas["iva"];?></td>
                              <td><div align="right"><? echo $filas["nove"];?></div></td>
                              <td><div align="right"><? echo $filas["nivelr"];?></div></td>
                              <td><div align="right"><? echo $filas["peps"];?></div></td>
                              <td><div align="right"><? echo $filas["ppension"];?></div></td>
                              <td><? echo $filas["cargo"];?></td>
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
