<html>

<head>
  <title>Editar relación</title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
 </head>

<?
  if (!isset($cedula)):
     include("../conexion.php");
  ?>
  <center><h4><u>Editar relación</u></h4></center>
<form action="" method="post" width="200">
    <table border="0" align="center">
    <tr><td><br></td></tr>

  <tr>
         <td><b>Vendedor:</b></td>
                              <td colspan="12"><select name="cedula" class="cajas">
                              <option value="0">Seleccione el vendedor
                                <?
                                 $consulta_z="select cedulaven,nombreven from vendedor where estado='ACTIVO' order by nombreven";
                                 $resultado_z=mysql_query($consulta_z)or die ("Error en la busqueda de vendedor");
                                while($filas_z=mysql_fetch_array($resultado_z)):
                                   ?>
                                   <option value="<?echo $filas_z["cedulaven"];?>"> <?echo $filas_z["nombreven"];?>
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
elseif (empty($cedula)):
?>
  <script language="javascript">
    alert ("Despliegue la vista para eligir el vendedor ?")
    history.back()
  </script>
    <?
else:
include ("../conexion.php");
      $consu="select vendedor.nombreven from vendedor
                where vendedor.cedulaven='$cedula'";
                 $resulta=mysql_query($consu) or die("Error en la busqueda de comision  ");
                 $reg=mysql_num_rows($resulta);
                 $filas_s=mysql_fetch_array($resulta);
                 if($reg!=0):
	                  ?>
	                    <table border="0" align="center">
	                     <tr>
	                       <td><b>Documento:</b>&nbsp;<? echo $cedula;?></td>
	                     </tr>
	                     <tr>
	                       <td><b>Vendedor:</b>&nbsp;<? echo $filas_s["nombreven"];?></td>
	                     </tr>
	                    </table>
	                 <?
	                $consulta="select relacioncomision.* from relacioncomision,vendedor
	                 where relacioncomision.cedulaven=vendedor.cedulaven and
	                 vendedor.cedulaven='$cedula'";
	                 $resultado=mysql_query($consulta) or die("Error al buscar relación de zonas ");
	                 $registros=mysql_num_rows($resultado);
                         if($registros!=0):
	                     ?>
	                     <center><h4><u>Relacion de Zonas</u></h4></center>
	                       <table border="0" align="center" >
	                         <tr class="cajas">
                                  <th>Item</th>
                                   <th>Registro</th>
	                            <th>Cod_Zona</th>
	                            <th>Zona</th>
	                            <th>F_Proceso</th>
	                            <th>Comisión</th>
	                            <th>Compartida</th>
	                         <?     $a=1;
	                          while ($filas=mysql_fetch_array($resultado)):
	                            ?>
	                              <tr class="cajas">
                                      <th><? echo $a;?></th>
                                      <td><a href="cambiorelacion.php?nro=<? echo $filas["nro"];?>&codzona=<?echo $filas["codzona"];?>&cedula=<?echo $cedula;?>"><div align="center"><? echo $filas["nro"];?></div></a></td>
	                              <td><? echo $filas["codzona"];?></td>
	                              <td><? echo $filas["zona"];?></td>
                                       <td><? echo $filas["fechap"];?></td>
	                              <td><? echo $filas["comision"];?>%</td>
	                              <td><? echo $filas["compartida"];?></td>


	                            </tr>
	                            <?  $a=$a+1;
	                            endwhile;
	                            ?>
	                            </table>
                                <?
	                   else:
	                      ?>
	                         <script language="javascript">
	                            alert("No hay relacion de zonas para este venededor ?")
	                            history.back()
	                         </script>
	                         <?
	                   endif;
                 else:
                     ?>
	             <script language="javascript">
	                 alert("El vendedor no existe en sistema <?echo $cedula;?> ?")
	                 history.back()
	            </script>
	             <?
                 endif;

	  endif;
	       ?>


</body>
</html>
