<html>

<head>
<title>Aporte Social</title>
 <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<?
 if(!isset($campo)):
 include("../conexion.php");
?>
   <center><h4><u>Aportes Sociales</u></h4></center>
   <form action="" method="post">
     <table border="0" align="center">
       <tr><td><br></td></tr>
       <tr>
         <td><b>Sucursal:</b></td>
         <td>
           <td><select name="campo" class="cajas">
                              <option value="0">Seleccione la sucursal
                                <?
                                 $consulta_z="select sucursal.codsucursal,sucursal.sucursal from sucursal ";
                                 $resultado_z=mysql_query($consulta_z)or die ("Error al buscar sucursales");
                                while($filas_z=mysql_fetch_array($resultado_z)):
                                   ?>
                                   <option value="<?echo $filas_z["codsucursal"];?>"> <?echo $filas_z["sucursal"];?>
                                  <?
                                  endwhile;
                                  ?>
                                  </select></td>
       </tr>
        <tr><td><br></td></tr>
        <tr>
          <td colspan="5"><input type="submit" value="Buscar" class="boton">
        </td></tr>
     </table>
   </form>
 <?

elseif(empty($campo)):
   ?>
    <script language="javascript">
      alert("Despliegue la lista para Elegir la sucursal?")
      history.back()
    </script>
   <?
else:
   include("../conexion.php");
        $con="select zona.zona,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1,empleado.cedemple,contrato.fechainic,contrato.fechater from empleado,contrato,zona,sucursal
             where sucursal.codsucursal=zona.codsucursal and
             zona.codzona=empleado.codzona and
             empleado.codemple=contrato.codemple and
             contrato.fechater='0000-00-00' and
             sucursal.codsucursal='$campo'order by empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1";
        $resu=mysql_query($con)or die("Error de Busqueda");
        $reg=mysql_num_rows($resu);
        if ($reg==0):
          ?>
           <script language="javascript">
             alert("No hay aportes sociales en este rango de fechas ?")
             history.back()
           </script>
          <?
        else:
         header("Content-type: application/vnd.ms-excel");
             header("Content-Disposition: attachment; filename=Aporte Social.xls");
             header("Pragma: no-cache");
             header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
             header("Expires: 0");
             ?>
             <table border="0" align="center">
                 <tr class="cajas">
                        <td style='font-weight:bold;font-size:1.1em;'>Item</td>
                        <td style='font-weight:bold;font-size:1.1em;'>Documento</td>
                        <td style='font-weight:bold;font-size:1.1em;'>Empleado</td>
                        <td style='font-weight:bold;font-size:1.1em;'>Zona</td>
                        <td style='font-weight:bold;font-size:1.1em;'>Valor</td>
                 </tr>
             <?
                 $i=1;
                 $fechaf=date("Y-m-d");
            while($filas=mysql_fetch_array($resu)):
               $fechai=$filas["fechainic"];
               $aux=$filas["cedemple"];
               $consulta="select sum(consignacion.valor)'total',consignacion.nrocon from empleado,consignacion
                       where empleado.cedemple=consignacion.cedemple and
                       consignacion.fechapro between '$fechai' and '$fechaf' and
                       empleado.cedemple='$aux'group by consignacion.cedemple";
                 $resul=mysql_query($consulta) or die("Error de Busqueda de aportes");
                 $registro=mysql_affected_rows();
                 $filas_s=mysql_fetch_array($resul);
                 ?>
               <tr class="cajas">
               <th><? echo $i;?></th>
               <td style='font-weight;font-size:0.9em;'><div align="left"><?echo $filas["cedemple"];?></div></td>
               <td style='font-weight;font-size:0.8em;'><?echo $filas["nomemple"];?>&nbsp;<?echo $filas["nomemple1"];?>&nbsp;<?echo $filas["apemple"];?>&nbsp;<?echo $filas["apemple1"];?></td>
               <td style ='font-weight;font-size:0.9em;'><?echo $filas["zona"];?></td>
              <td style ='font-weight;font-size:0.9em;'><?echo $filas_s["total"];?></td>
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
