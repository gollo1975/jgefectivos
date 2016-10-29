<html>

<head>
  <title>reporte de comisiones</title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
  <script language="javascript">
        function volver()// para declara funcion
        {
                pagina='reingreso.php'
                tiempo=90
                ubicacion='_self'
                setTimeout("open(pagina,ubicacion)",tiempo)
        }

</script>
 </head>

<?
  if (!isset($cedula)):
     include("../conexion.php");
  ?>
  <center><h4>Comisiones por fecha</h4></center>
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
         <td><b>Vendedor:</b></td>
                              <td colspan="12"><select name="cedula" class="cajas">
                              <option value="0">Seleccione el vendedor
                                <?
                                 $consulta_z="select cedulaven,nombreven from vendedor order by nombreven";
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
      $consu="select comision.*,vendedor.nombreven from comision,vendedor
                where vendedor.cedulaven=comision.cedulaven and
                vendedor.cedulaven='$cedula' and
                comision.fechaini='$desde' and comision.fechacorte='$hasta'";
                 $resulta=mysql_query($consu) or die("Error en la busqueda de comision  ");
                 $reg=mysql_num_rows($resulta);
                 $filas_s=mysql_fetch_array($resulta);
                 $codigo=$filas_s["codigo"];
                 if($reg!=0):
	                  ?>
	                    <table border="0" align="center">
	                     <tr>
	                       <td><b>Documento:</b>&nbsp;<? echo $filas_s["cedulaven"];?></td>
	                     </tr>
	                     <tr>
	                       <td><b>Vendedor:</b>&nbsp;<? echo $filas_s["nombreven"];?></td>
	                     </tr>
	                    </table>
	                 <?
	                $consulta="select decomision.* from decomision,comision
	                 where comision.codigo=decomision.codigo and
	                 comision.codigo='$codigo'";
	                 $resultado=mysql_query($consulta) or die("consulta incorrecta 3 ");
	                 $registros=mysql_num_rows($resultado);
                         if($registros!=0):
	                     ?>
	                     <center><h4>Detalles de la comisión</h4></center>
	                       <table border="0" align="center" >
	                         <tr class="cajas">
	                            <th>Cod_Zona</th>
	                            <th>Zona</th>
	                            <th>Desde</th>
	                            <th>Hasta</th>
	                            <th>Convenio</th>
	                            <th>Porcen.</th>
	                            <th>Cant.</th>
	                            <th>Total</th>
	                         <?
	                          while ($filas=mysql_fetch_array($resultado)):
	                            ?>
	                              <tr class="cajas">
	                              <td><? echo $filas["codzona"];?></td>
	                              <td>&nbsp;&nbsp;<? echo $filas["zona"];?></td>
	                              <td>&nbsp;&nbsp;<? echo $filas["fechaini"];?></td>
	                              <td>&nbsp;&nbsp;<? echo $filas["fechacorte"];?></td>
	                              <td>&nbsp;&nbsp;<? echo $filas["convenio"];?></td>
	                              <td>&nbsp;&nbsp;<? echo $filas["porcentaje"];?></td>
	                              <td>&nbsp;&nbsp;<? echo $filas["can"];?></td>
	                              <td>&nbsp;&nbsp;<? echo $filas["total"];?></td>

	                            </tr>
	                            <?
	                            endwhile;
	                            ?>
	                            </table>
                                    <tr><td><br></td></tr>
                                    <th><center><a href="imprimircomision.php?cedula=<?echo $cedula;?>&desde=<?echo $desde;?>&hasta=<?echo $hasta;?>" target="_blank" onclick="volver()" class="fondo"><img src="../image/printer-32.png" border="0" alt="Permite Imprimir todos las comisiones"></a></center></th>
	                            <?
	                   else:
	                      ?>
	                         <script language="javascript">
	                            alert("No hay registros De Facturacion para esta Zona ?")
	                            history.back()
	                         </script>
	                         <?
	                   endif;
                 else:
                     ?>
	             <script language="javascript">
	                 alert("No hay registros de comision en esta fecha ?")
	                 history.back()
	            </script>
	             <?
                 endif;

	  endif;
	       ?>


</body>
</html>
