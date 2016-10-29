<LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
<?
include("../conexion.php");
        $consulta="select fondos.* from fondos,itemfondo
        where itemfondo.codigo=fondos.codigo and
              fondos.fechap between '$desde' and '$hasta' and
              itemfondo.codigo='$codigo'";
            $resultado=mysql_query($consulta)or die ("Consulta incorrecta");
            $registro=mysql_num_rows($resultado);
if($registro!=0):
  ?>
    <div align="center"><b>Nombre del Fondo:</b>&nbsp;<?echo $fondo;?></div>
    <center><h4><u>Listado de Auxilio</u></h4></center>
        <table border="0" align="center">
        <tr><td><br></td></tr>
        <tr class="cajas">
             <th>Item</th>
             <th>Radicado</th>
             <th>Ducumento</th>
             <th>Asociado</th>
             <th>VlrFondo</th>
             <th>F_Pago</th>
             <th>F_Proceso</th>
             <th>Zona</th>
             </tr>
            <?
            $i=1;
             while($filas=mysql_fetch_array($resultado)):
             $valor=number_format($filas["vlrfondo"],0);
           ?>
             <tr class="cajas">
               <th><?echo $i;?></th>
               <td><?echo $filas["radicado"];?></td>
               <td><?echo $filas["cedemple"];?></td>
               <td><?echo $filas["empleado"];?></td>
               <td><?echo $valor;?></td>
               <td><?echo $filas["fechap"];?></td>
               <td><?echo $filas["fechagra"];?></td>
               <td><?echo $filas["zona"];?></td>
            </tr>
               <?
               $con=$con+$filas["vlrfondo"];
               $i=$i + 1;
             endwhile;
              $con=number_format($con,2);
             ?>
             </table>
             <div align="center"><b>Vlr_Total:&nbsp;</b><?echo $con;?></div>
         <tr>

          </tr>
             <?
else:

?>
  <script language="javascript">
    alert("No hay Asociados para este fondo en este rango de fechas ?")
    history.back()
  </script>
  <?
endif;
?>
