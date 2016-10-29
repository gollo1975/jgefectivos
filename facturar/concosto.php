<html>
<head>
  <title>Consulta del Servicio</title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
 </head>
<?
  if (!isset($dato)):
     include("../conexion.php");
  ?>
  <center><h4>Consulta del Servicio Por Centro de Costo</h4></center>
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
  <tr>
         <td><b>Centro de Costo:</b></td>
                              <td colspan="12"><select name="dato" class="cajas">
                              <option value="0">Seleccione el centro de Costo
                                <?
                                 $consulta_c="select costo.codcosto,costo.centro from costo  order by centro";
                                 $resultado_c=mysql_query($consulta_c)or die ("consulta incorrecta");
                                while($filas_c=mysql_fetch_array($resultado_c)):
                                   ?>
                                   <option value="<?echo $filas_c["codcosto"];?>"> <?echo $filas_c["centro"];?>
                                  <?
                                  endwhile;
                                  ?>
                                  </select></td>
    </tr>
  <tr>
         <td><b>Zona:</b></td>
                              <td colspan="12"><select name="campo" class="cajas">
                              <option value="0">Seleccione la zona
                                <?
                                 $consulta_z="select * from zona where zona.nomina='SI' order by zona";
                                 $resultado_z=mysql_query($consulta_z)or die ("consulta incorrecta");
                                while($filas_z=mysql_fetch_array($resultado_z)):
                                   ?>
                                   <option value="<?echo $filas_z["codzona"];?>"> <?echo $filas_z["zona"];?>
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
elseif (empty($dato)):
?>
  <script language="javascript">
    alert ("Despliegue la vista para eligir el centro de costo ?")
    history.back()
  </script>
<?
elseif (empty($campo)):
?>
  <script language="javascript">
    alert ("Despliegue la vista para eligir la zona ?")
    history.back()
  </script>
    <?
else:
include ("../conexion.php");
      $consu="select zona.zona,costo.centro from zona,costo
                where  costo.codcosto='$dato' and
                        zona.codzona='$campo'";
                 $resulta=mysql_query($consu) or die("consulta incorrecta 1 $consu");
                 while ($filas_s=mysql_fetch_array($resulta)):
                     $zona=$filas["zona"];
                     echo $zona;
                      ?>
                     <table border="0" align="center">
                     <tr>
                       <td colspan="2"><b>Zona:&nbsp;&nbsp;</b><? echo $filas_s["zona"];?></td>
                     </tr>
                      <tr>
                       <td colspan="2"><b>Centro_Costo:&nbsp;&nbsp;</b><? echo $filas_s["centro"];?></td>
                     </tr>
                      <tr>
                       <td colspan="2"><b>Desde:&nbsp;&nbsp;</b><? echo $desde;?><b>&nbsp;&nbsp;Hasta:&nbsp;&nbsp;</b><? echo $hasta;?></td>
                     </tr>
                    </table>
                 <?
                endwhile;
                $consulta="select zonacosto.* from zona,costo,zonacosto
                 where zona.codzona=zonacosto.codzona and
                      costo.codcosto=zonacosto.codcosto and
                     zonacosto.desde between '$desde' and '$hasta' and
                     costo.codcosto='$dato'and
                      zona.codzona='$campo'";
                 $resultado=mysql_query($consulta) or die("consulta incorrecta 3 ");
                 $registros=mysql_num_rows($resultado);
                  if($registros!=0):
                     ?>
                     <center><h4>Listado de Servicio</h4></center>
                     <table border="0" align="center">
                       <tr class="cajas">
                         <td>Para Ver el datallado del centro de Costo, Presione Click sobre el NRO_SERVICIO..</td>
                       </tr>
                     </table>
                       <table border="0" align="center" >
                         <tr class="cajas">
                            <th>Nro_Servicio</th>
                            <th>&nbsp;&nbsp;Desde</th>
                            <th>&nbsp;&nbsp;Hasta</th>
                            <th>&nbsp;&nbsp;Fecha_Pro.</th>
                            <?
                          while ($filas=mysql_fetch_array($resultado)):
                            ?>
                            <tr class="cajas">
                              <td><a href="detalladocostoconsulta.php?codigo=<? echo $filas["codigo"];?>"><? echo $filas["codigo"];?></a></td>
                              <td>&nbsp;&nbsp;<? echo $filas["desde"];?></td>
                              <td>&nbsp;&nbsp;<? echo $filas["hasta"];?></td>
                              <td>&nbsp;&nbsp;<? echo $filas["fechap"];?></td>
                            </tr>
                            <?
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
  endif;
       ?>
</body>
</html>
