<html>

<head>
  <title>Utilidad del Admon</title>
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
  if (!isset($auxcodigo)):
     include("../conexion.php");
  ?>
  <center><h4><u>Utilidad por Admon</u></h4></center>
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
         <td><b>Servicios:</b></td>
                              <td colspan="5"><select name="codigo" class="cajas">
                              <option value="0">Seleccion el servicio
	                      <?
		               $consulta_s="select codcom,concepto from item";
		               $resultado_s=mysql_query($consulta_s)or die ("Error en la busqueda de Items");
		                  while($filas_s=mysql_fetch_array($resultado_s))
		                  {
		                   ?>
		                   <option value="<?echo $filas_s["codcom"];?>"> <?echo $filas_s["concepto"];?>
		                   <?
		                  }
		                ?></select></td>
    </tr>
  <tr>
         <td><b>Empresa:</b></td>
                              <td colspan="12"><select name="auxcodigo" class="cajas">
                              <option value="0">Seleccione la empresa
                                <?
                                 $consulta_z="select maestro.codmaestro,maestro.nomaestro from maestro ";
                                 $resultado_z=mysql_query($consulta_z)or die ("Error en la busqueda de empresa");
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
    <td colspan="2">
      <input type="submit" value="Buscar" class="boton">
      <input type="reset" value="Limpiar" class="boton">
    </td>
  </tr>
</table></td></tr>
</table>
</form>
<?
elseif (empty($auxcodigo)):
  ?>
  <script language="javascript">
    alert ("Despliegue la vista para eligir la empresa ?")
    history.back()
  </script>
  <?
elseif(empty($codigo)):
  ?>
  <script language="javascript">
    alert ("Despliegue la vista para el consecutivo del servicio?")
    history.back()
  </script>
    <?
else:
  include ("../conexion.php");
  $con="select item.concepto from item where  codcom='$codigo'";
  $resu=mysql_query($con) or die ("Error al buscar codigos");
  $re=mysql_affected_rows();
  $fila=mysql_fetch_array($resu);
  $concepto=$fila["concepto"];
  $con1="select maestro.nomaestro from maestro where  maestro.codmaestro='$auxcodigo'";
  $resu1=mysql_query($con1) or die ("Error al buscar empresas");
  $re1=mysql_affected_rows();
  $filas_e=mysql_fetch_array($resu1);
  $empresa=$filas_e["nomaestro"];
  $consulta="select zona.zona,factura.nrofactura,factura.fechaini,factura.fechaven,defactura.total from maestro,sucursal,zona,factura,defactura,item
   where  maestro.codmaestro=sucursal.codmaestro and
         sucursal.codsucursal=zona.codsucursal and
          zona.codzona=factura.codzona and
          factura.nrofactura=defactura.nrofactura and
          factura.fechaini between '$desde'and'$hasta' and
          defactura.codcom=item.codcom and
          maestro.codmaestro='$auxcodigo' and
          item.codcom='$codigo' order by zona.zona";
          $resultado=mysql_query($consulta) or die ("Error en la busquedas de  facturas con administracion ");
          $registros=mysql_num_rows($resultado);
          if($registros!=0):
                     header("Content-type: application/vnd.ms-excel");
                     header("Content-Disposition: attachment; filename=Utilidad de Admon.xls");
                     header("Pragma: no-cache");
                     header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                     header("Expires: 0");
                     ?>
                        <table border="0" align="center" >
                         <tr class="cajas">
                            <td style='font-weight:bold;font-size:1.0em;'>Nro</td>
                            <td style='font-weight:bold;font-size:1.0em;'>Nro_Factura</td>
                            <td style='font-weight:bold;font-size:1.0em;'>Zona</td>
                            <td style='font-weight:bold;font-size:1.0em;'>F_Inico</td>
                            <td style='font-weight:bold;font-size:1.0em;'>F_Vcto</td>
                            <td style='font-weight:bold;font-size:1.0em;'>Vlr_Admon.</td>
                         </tr>
                            <?
                            $l=1;
	                          while ($filas=mysql_fetch_array($resultado)):
         	                            ?>
	                              <tr class="cajas">
                                      <th><? echo $a;?></th>
	                              <td><? echo $filas["nrofactura"];?></td>
	                              <td><? echo $filas["zona"];?></td>
                                      <td><? echo $filas["fechaini"];?></td>
	                               <td><? echo $filas["fechaven"];?></td>
	                              <td><div align="right">$<? echo $filas["total"];?></div></td>
                             </tr>
	                            <?
                                    $a=$a+1;
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
