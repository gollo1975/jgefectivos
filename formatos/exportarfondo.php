<html>
        <head>
                <title>Variación de Salario</title>
        </head>
         <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
        <body>
        <?
  if (!isset($fondo)):
     include("../conexion.php");
  ?>
  <center><h4><u>Auxilios por Fondos</u></h4></center>
<form action="" method="post" width="200">
    <table border="0" align="center">
    <tr><td><br></td></tr>
  <tr>
   <td><b>Desde:</b></td>
    <td colspan="3"><input type="text" name="desde" value="<? echo date("Y-m-d");?>" size="10" maxlegth="10"></td>
    <td><b>Hasta:</b></td>
    <td colspan="3"><input type="text" name="hasta" value="<? echo date("Y-m-d");?>" size="10" maxlegth="10"></td>
  </tr>
  <tr>
         <td><b>Nombre del Fondo:</b></td>
                              <td colspan="12"><select name="fondo" class="cajas">
                              <option value="0">Seleccione el fondo
                                <?
                                 $consulta_z="select itemfondo.codigo,itemfondo.concepto from itemfondo order by concepto";
                                 $resultado_z=mysql_query($consulta_z)or die ("consulta incorrecta");
                                while($filas_z=mysql_fetch_array($resultado_z)):
                                   ?>
                                   <option value="<?echo $filas_z["codigo"];?>"> <?echo $filas_z["concepto"];?>
                                  <?
                                  endwhile;
                                  ?>
                                  </select></td>
    </tr>
     <tr><td><br></td></tr>
   <tr>
    <td colspan="2">
      <input type="submit" value="Buscar" class="boton">
      <input type="reset" value="Limpiar" class="boton">
    </td>
  </tr>
</table></td></tr>
</table>
</form>
<?
elseif (empty($fondo)):
  ?>
  <script language="javascript">
    alert("Seleccione el fondo de la lista ?")
    history.back()
  </script>
  <?
  else:
      include("../conexion.php");
      $consulta="select fondos.* from fondos,itemfondo
      where itemfondo.codigo=fondos.codigo and
      itemfondo.codigo='$fondo' and
      fondos.fechap between '$desde' and '$hasta'order by fechap";
      $resultado=mysql_query($consulta)or die ("Consulta incorrecta");
      $registro=mysql_num_rows($resultado);
      if($registro==0):
                  ?>
                        <script language="javascript">
                                alert("No Existen Registros")
                                history.back()
                        </script>
               <?
      else:
                     header("Content-type: application/vnd.ms-excel");
                     header("Content-Disposition: attachment; filename=Auxilios por fondo.xls");
                     header("Pragma: no-cache");
                     header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                     header("Expires: 0");
                        ?>
                   <table border="0" align="center">
                        <tr class="cajas">
                        <td style='font-weight:bold;font-size:1.1em;'>Item</td>
                        <td style='font-weight:bold;font-size:1.1em;'>Radicado</td>
                        <td style='font-weight:bold;font-size:1.1em;'>Documento</td>
                        <td style='font-weight:bold;font-size:1.1em;'>Empleado</td>
                        <td style='font-weight:bold;font-size:1.1em;'>Vlr_Fondo</td>
                        <td style='font-weight:bold;font-size:1.1em;'>Zona</td>
                         <td style='font-weight:bold;font-size:1.1em;'>Fecha_Proceso</td>
                        </tr>
                 <?
                 $i=1;
             while($filas_s=mysql_fetch_array($resultado)):
               ?>
                <tr  class="cajas">
                 <td><?echo $i;?></td>
                 <td style='font-weight;font-size:0.9em;'><div align="left"><?echo $filas_s["radicado"];?></div></td>
                 <td style='font-weight;font-size:0.9em;'><div align="left"><?echo $filas_s["cedemple"];?></div></td>
                 <td style='font-weight;font-size:0.8em;'><?echo $filas_s["empleado"];?></td>
                 <td style='font-weight;font-size:0.9em;'><?echo $filas_s["vlrfondo"];?></td>
                 <td style='font-weight;font-size:0.9em;'><?echo $filas_s["zona"];?></td>
                 <td style='font-weight;font-size:0.9em;'><?echo $filas_s["fechap"];?></td>
               </tr>
                <?
                $i=$i+1;
            endwhile;
            ?>
            </table>
             <?
      endif;
 endif;
                ?>
        </body>
</html>
