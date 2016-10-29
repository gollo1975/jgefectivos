<html>
<head>
  <title>Generando Aportes Sociales</title>
  <LINK REL="stylesheet"  HREF="../estilo.css" type="text/css">
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
         <td><b>Empresa:</b></td>
         <td>
           <td><select name="campo" class="cajas">
                              <option value="0">Seleccione la empresa
                                <?
                                 $consulta_z="select maestro.codmaestro,maestro.nomaestro from maestro ";
                                 $resultado_z=mysql_query($consulta_z)or die ("consulta incorrecta");
                                while($filas_z=mysql_fetch_array($resultado_z)):
                                   ?>
                                   <option value="<?echo $filas_z["codmaestro"];?>"> <?echo $filas_z["nomaestro"];?>
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
      alert("Despliegue la lista para Elegir la empresa ?")
      history.back()
    </script>
   <?
else:
   include("../conexion.php");
   $variable="select maestro.nomaestro from maestro where
                 maestro.codmaestro='$campo'";
         $resultado=mysql_query($variable)or die("consulta incorrecta uno");
        while($filas=mysql_fetch_array($resultado)):
             ?>
              <table border="0" align="center">
               <tr class="cajas">
                 <td><b>Empresa:</b>&nbsp;<?echo $filas["nomaestro"];?></td>
               </tr>
                 </table>
                <?
        endwhile;
        $con="select zona.zona,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1,empleado.cedemple,contrato.fechainic,contrato.fechater from maestro,empleado,contrato,zona,sucursal
             where maestro.codmaestro=sucursal.codmaestro and
             sucursal.codsucursal=zona.codsucursal and
             zona.codzona=empleado.codzona and
             empleado.codemple=contrato.codemple and
             contrato.fechater='0000-00-00' and
             maestro.codmaestro='$campo'order by empleado.nomemple,empleado.apemple";
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
          ?>
          <center><h4><u><u>Aporte Social</u></u></h4></center>
          <table border="1" align="center">
          <tr>
            <th class="cajas"><b>Item</b></th><th class="cajas"><b>Cedula</b></th><th class="cajas"><b>Empleado</b></th><th class="cajas"><b>Vrl_Aporte</b></th>
          </tr>
          <?

          $i=1;
          $fechaf=date("Y-m-d");
           echo ("<input type=\"hidden\" id=\"tActualizaciones\" name=\"tActualizaciones\" value=\"" . mysql_num_rows($resu) . "\">");
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
                 $suma=$filas_s["total"];
                 $tot=number_format($suma,0);
                 ?>
               <tr class="cajas">
               <th><? echo $i;?></th>
               <td class="cajas"><? echo $filas["cedemple"];?></td>
               <td class="cajas"><? echo $filas["nomemple"];?>&nbsp;<? echo $filas["nomemple1"];?>&nbsp;<? echo $filas["apemple"];?>&nbsp;<? echo $filas["apemple1"];?> </td>
               <td class="cajas" ><? echo $tot;?></td>
               </tr>
               <?
              $i=$i+1;
              $gran=$gran+$suma;
            endwhile;
            $gran=number_format($gran,0);
            ?>
            </table>
            <tr><td><br></td></tr>
            <tr>
              <center><td class="cajas"><b>Total_Aporte:&nbsp;<? echo $gran;?></b></td></center>
            <tr>
            <?
         endif;
endif;
?>
</body>

</html>
