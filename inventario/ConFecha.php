<html>
<head>
<title>Consulta de Facturas</title>
 <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<?
if (empty($desde)):
?>
<center><h4><u>Carpetas por Fechas</u></h4></center>
  <form  action="" method="post">
    <table border="0" align="center">
      <tr><td></td></tr>
       <tr>
        <td><b>Fecha_Inicio:</b></td>
         <td><input type="text" name="desde" value="<? echo date("Y-m-d");?>" size="10" maxlength="10" class="cajas"></td>
       </tr>
       <tr>
        <td><b>Fecha Final:</b></td>
         <td><input type="text" name="hasta" value="<? echo date("Y-m-d");?>" size="10" maxlength="10" class="cajas"></td>
       </tr>

       <tr><td><br></td></tr>
       <tr>
         <td colspan="2">
           <input type="submit" value="Buscar" class="boton">
           <input type="reset" value="Limpiar"class="boton"> </td>
       </tr>
    </table>

  </form>
  <?
elseif (empty($desde)):
   ?>
   <script language="javascript">
     alert("Debe colocar la fecha inicio")
     history.back()
   </script>
   <?
   else:
     include("../conexion.php");
     $variable="select carpeta.* from carpeta
        where carpeta.fechaentrega between '$desde' and '$hasta' order by zona,empleado";
         $resultado=mysql_query($variable)or die("Error al buscar datos de la carpeta");
        $registro=mysql_num_rows($resultado);
        if ($registro==0):
          ?>
          <script language="javascript">
            alert("No hay registros en este rango de fechas ?")
            history.back()
          </script>
         <?
         else:
         ?>
         <div align="center"><h4>Listados de Entregas</h4></div>
         <table border="0" align="center">
          <tr class="cajas">
             <th>Item</th>
             <th >Nro_Entrega</th>
              <th >Documento</th>
              <th >Empleado</th>
              <th >Zona</th>
              <th >Responsable</th>
              <th >Estado</th>
              <th >F_Entrega</th>
              <th >Motivo</th>
           </tr>
              <?
              $a=1;
             while($filas_s=mysql_fetch_array($resultado)):
             ?>
               <tr class="cajas">
               <th><?echo $a;?></th>
                <td><?echo $filas_s["nroentrega"];?></td>
                 <td><?echo $filas_s["cedemple"];?></td>
                 <td><?echo $filas_s["empleado"];?></td>
                 <td><?echo $filas_s["zona"];?></td>
                 <td><?echo $filas_s["responsable"];?></td>
                 <td><?echo $filas_s["estado"];?></td>
                 <td><?echo $filas_s["fechaentrega"];?></td>
                 <td><?echo $filas_s["motivo"];?></td>
                 </tr>
                <?
                $a=$a+1;
              endwhile;
              ?>
             </table>
              <?
           endif;
 endif;
 ?>
</table>
</body>
</html>
