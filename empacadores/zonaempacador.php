<html>

<head>
  <title>Consulta del Servicio</title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
 </head>

<?
  if (!isset($campo)):
     include("../conexion.php");
  ?>
  <center><h4>Consulta del Servicio Por Zona</h4></center>
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
elseif (empty($campo)):
?>
  <script language="javascript">
    alert ("Despliegue la vista para eligir la zona ?")
    history.back()
  </script>
    <?
else:
include ("../conexion.php");
      $consu="select zona.zona from zona
                where zona.codzona='$campo'";
                 $resulta=mysql_query($consu) or die("consulta incorrecta 1  ");
                 while ($filas_s=mysql_fetch_array($resulta)):
                      ?>
                     <table border="0" align="center">
                     <tr>
                       <td colspan="2"><? echo $filas_s["zona"];?></td>
                     </tr>
                    </table>
                 <?
                endwhile;
                $consulta="select empacador.* from empacador,zona
                 where zona.codzona=empacador.codzona and
                empacador.desde between '$desde' and '$hasta' and
                 zona.codzona='$campo'";
                 $resultado=mysql_query($consulta) or die("consulta incorrecta 3 ");
                 $registros=mysql_num_rows($resultado);
                  if($registros!=0):
                     ?>
                     <center><h4>Listado de Servicio</h4></center>
                     <table border="0" align="center">
                       <tr class="cajas">
                         <td>Para Ver el datallado de Cobro, Presione Click sobre el NRO_SERVICIO..</td>
                       </tr>
                     </table>
                       <table border="0" align="center" >
                         <tr class="cajas">
                            <th>Nro_Servicio</th>
                            <th>&nbsp;&nbsp;Desde</th>
                            <th>&nbsp;&nbsp;Hasta</th>
                            <th>&nbsp;&nbsp;Fecha_Pro.</th>
                            <th>&nbsp;&nbsp;Total</th>
                            <th>&nbsp;&nbsp;Incapacidad</th>
                            <th>&nbsp;&nbsp;Ajuste</th>
                            <th>&nbsp;&nbsp;Mayor Vlr Fac.</th>
                            <th>&nbsp;&nbsp;Subtotal</th>
                            <th>&nbsp;&nbsp;Iva</th>
                            <th>&nbsp;&nbsp;Gran Total</th>
                         <?
                          while ($filas=mysql_fetch_array($resultado)):
                            ?>
                            <tr class="cajas">
                              <td><a href="detalladozona.php?codigo=<? echo $filas["codigo"];?>"><? echo $filas["codigo"];?></a></td>
                              <td>&nbsp;&nbsp;<? echo $filas["desde"];?></td>
                              <td>&nbsp;&nbsp;<? echo $filas["hasta"];?></td>
                              <td>&nbsp;&nbsp;<? echo $filas["fechap"];?></td>
                              <td>&nbsp;&nbsp;<? echo $filas["subtotal"];?></td>
                              <td>&nbsp;&nbsp;<? echo $filas["incapacidad"];?></td>
                              <td>&nbsp;&nbsp;<? echo $filas["ajuste"];?></td>
                              <td>&nbsp;&nbsp;<? echo $filas["mayor"];?></td>
                              <td>&nbsp;&nbsp;<? echo $filas["total"];?></td>
                              <td>&nbsp;&nbsp;<? echo $filas["iva"];?></td>
                              <td>&nbsp;&nbsp;<? echo $filas["grantotal"];?></td>
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
