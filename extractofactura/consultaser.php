<html>

<head>
 <title></title>
 <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
 </head>
<body>
<?
if (!isset($dato)):
include("../conexion.php");
?>
  <center><h4>Consulta de Servicios</h4></center>
<form action="" method="post" width="200">
  <table border="0" align="center">
  <tr class="fondo">
       <td colspan="2"><br></td>
  </tr>
   <tr>
    <td><b>Desde:</b></td>
    <td colspan="3"><input type="text" name="desde" value="<? echo date("Y-m-d");?>" size="10" maxlegth="10"></td>
    <td><b>Hasta:</b></td>
    <td colspan="3"><input type="text" name="hasta" value="<? echo date("Y-m-d");?>" size="10" maxlegth="10"></td>
  </tr>
  <tr>
         <td><b>Zona:</b></td>
                              <td colspan="12"><select name="dato" class="cajas">
                              <option value="0">Seleccione la Zona
                                <?
                                 $consulta_z="select zona.codzona,zona.zona from zona where zona.nomina='SI' order by zona.zona";
                                 $resultado_z=mysql_query($consulta_z)or die ("consulta incorrecta");
                                while($filas_z=mysql_fetch_array($resultado_z)):
                                   ?>
                                   <option value="<?echo $filas_z["codzona"];?>"><?echo $filas_z["zona"];?>
                                  <?
                                  endwhile;
                                  ?>
                                  </select></td>
    </tr>
     <tr><td><br></td></tr>
   <tr>
    <td colspan="2">
      <input type="submit" value="Buscar" class="boton">
      <input type="reset" value="Limpiar"class="boton">
    </td>
  </tr>
</table>
</form>
<?
elseif (empty($dato)):
?>
  <script language="javascript">
    alert ("Despliegue la vista para eligir la Zona ?")
    history.back()
  </script>
    <?
else:
  include("../conexion.php");
   $consulta="select zona.zona from zona where
           zona.codzona='$dato'";
  $resultado=mysql_query($consulta)or die ("Consulta incorrecta $consulta");
  $regis=mysql_num_rows($resultado);
  if($regis!=0):
    while($filas=mysql_fetch_array($resultado)):
     ?>
          <center><h4>Datos Para la Factura</h4></center>
          <table border="0" align="center">
           <tr>
             <td><? echo $filas["zona"];?></td>
           </tr>
          </table>
          <?
     endwhile;
      $consulta1="select cobro.* from zona,cobro where
              zona.codzona=cobro.codzona and
              cobro.desde='$desde' and cobro.hasta='$hasta' and
              zona.codzona='$dato' order by cobro.codcobro";
      $resultado1=mysql_query($consulta1)or die ("Consulta incorrecta $consulta");
      $regis1=mysql_num_rows($resultado1);
      if($regis1!=0):
         ?>
           <table border="0" align="center">
               <tr  class="cajas">
                      <th>Desde</th>
                      <th>Hasta</th>
                      <th>Fecha_Proc.</th>
                      <th>Basico</th>
                      <th>Ayuda_Tran.</th>
                      <th>Extra/Retorno.</th>
                      <th>Seg_Social</th>
                      <th>Caja</th>
                      <th>Prestaciones</th>
                      <th>Admon</th>
                      <th>Total</th>
                  </tr>
               </tr>
                  <?
                  while($filas_s=mysql_fetch_array($resultado1)):
                 ?>
                  <tr  class="cajas">
                      <td>&nbsp;&nbsp;<?echo $filas_s["desde"];?></td>
                     <td>&nbsp;&nbsp;<?echo $filas_s["hasta"];?></td>
                     <td>&nbsp;&nbsp;<?echo $filas_s["fechap"];?></td>
                     <td>&nbsp;&nbsp;<?echo $filas_s["ordinaria"];?></td>
                     <td>&nbsp;&nbsp;<?echo $filas_s["ayuda"];?></td>
                     <td>&nbsp;&nbsp;<?echo $filas_s["suplemento"];?></td>
                     <td>&nbsp;&nbsp;<?echo $filas_s["seguridad"];?></td>
                     <td>&nbsp;&nbsp;<?echo $filas_s["caja"];?></td>
                     <td>&nbsp;&nbsp;<?echo $filas_s["prestacion"];?></td>
                     <td>&nbsp;&nbsp;<?echo $filas_s["admon"];?></td>
                     <td>&nbsp;&nbsp;<?echo $filas_s["total"];?></td>
                   </tr>
                 <?
                endwhile;
             ?>
             </table>
             <?
      else:
          ?>
      <script language="javascript">
        alert("Esta Zona No tiene Facturación de Servicio ?")
        history.back()
      </script>
     <?
      endif;

  else:
      ?>
      <script language="javascript">
        alert("La Zona No existe en el sistema ?")
        history.back()
      </script>
     <?
  endif;
endif;
?>
</table>

</body>
</html>
