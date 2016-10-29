<html>

<head>
  <title>Autorizaciones de Prestamo</title>
     <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">

</head>

<?
  if (!isset($desde)):
    include ("../conexion.php");
  ?>
  <center><h4><u>Autorizaciones de Prestamo</u></h4></center>
<form action="" method="post" width="200">
  <table border="1" align="center">
  <tr><td>
   <table border="0" align="center">
  <tr class="fondo">
       <th colspan="8"><br></th>
  </tr>
  <tr>
    <td><b>Desde:&nbsp;</b></td>
    <td colspan="3"><input type="text" name="desde" value="<? echo date("Y-m-d");?>" size="10" maxlegth="10"></td>
    <td><b>Hasta:&nbsp;</b></td>
    <td colspan="3"><input type="text" name="hasta" value="<? echo date("Y-m-d");?>" size="10" maxlegth="10"></td>
  </tr>
   <tr>
     <td><b>Zona:</b></td>
         <td colspan="5"><select name="campo" class="cajas">
                              <option value="0">Seleccione la zona
                                <?
                                 $consulta_z="select zona.codzona,zona.zona from zona where zona.nomina='SI'and zona.estado='ACTIVA' order by zona";
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
    <th colspan="2">
      <input type="submit" value="Buscar">
    </th>
  </tr>
</table></td></tr>
</table>
</form>
<?
elseif (empty($campo)):
?>
  <script language="javascript">
    alert ("Seleccion de la lista una zona para el registro.. ?")
    history.back()
  </script>
    <?
else:
  include ("../conexion.php");
      $consulta="select prestamoempresa.* from zona,prestamoempresa
                 where  zona.codzona=prestamoempresa.codzona and
                    prestamoempresa.fechap between '$desde'and'$hasta' and
                    zona.codzona='$campo'order by prestamoempresa.fechap";
                   $resultado=mysql_query($consulta) or die("Error al buscra datos de la información ");
                   $registros=mysql_num_rows($resultado);
                   if($registros!=0):
                           ?>
                           <center><h4><u>Autorización Prestamo</u></h4></center>
                           <td class="cajas"><div align="center"><h5>Presione click en el Nro_prestamo para verlo por pantalla</h5></div></td>
                        <table border="0" align="center">
                          <tr><td><br></td></tr>
                          <tr>
                              <th>Item</th>
                               <th>&nbsp;&nbsp;</th>
                              <th>Nro_Prestamo</th>
                              <th>Documento</th>
                              <th>Emppleado</th>
                              <th>F_Proceso</th>
                              <th>Vlr_Prestamo</th>
                              <th>Cuota</th>
                              <th>Dias</th>
                              <th>Estado</th>
                           </tr>
                           <? $a=1;
                             while ($filas=mysql_fetch_array($resultado)):
                             $valor=number_format($filas["vlrprestamo"],0);
                             $cuota=number_format($filas["cuota"],0);
                               ?>
                                <tr class="cajas">
                                   <th><?echo $a;?></th>
                                   <th><a href="detalladoPrestamo.php?nroprestamo=<?echo $filas["nroprestamo"];?>&desde=<?echo $desde;?>&hasta=<?echo $hasta;?>&campo=<?echo $campo;?>&campo=<?echo $campo;?>"><img src="../image/mod.jpg" border="0" alt="Permite Modificar el Registro"></th>
                                   <td><a href="../ppal/imprimirprestamo.php?nroprestamo=<?echo $filas["nroprestamo"];?>"><?echo $filas["nroprestamo"];?></a></td>
                                   <td><?echo $filas["cedemple"];?></td>
                                   <td><?echo $filas["nombres"];?></td>
                                   <td><?echo $filas["fechap"];?></td>
                                   <td><?echo $valor;?></td>
                                   <td><?echo $cuota;?></td>
                                   <td><?echo $filas["dias"];?></td>
                                   <td><?echo $filas["estado"];?></td>
                                </tr>
                               <? $a=$a+1;
                               $suma=$suma+$filas["vlrprestamo"];
                             endwhile;
                             $suma=number_format($suma,0);
                                 ?>
                         </table>
                         <div align="center"><b>Total_Valor:&nbsp;$<?echo $suma;?></b></div>
     <?
                   else:
                      ?>
                         <script language="javascript">
                            alert("No hay autorizaciones en este rango de fechas... ?")
                            history.back()
                         </script>
                         <?
                   endif;
 endif;
       ?>


</body>
</html>
