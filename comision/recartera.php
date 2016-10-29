<html>

<head>
  <title>Reporte de comisiones por cartera</title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
  <script language="javascript">
        function volver()// para declara funcion
        {
                pagina='recartera.php'
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
  <center><h4><u>Pago Cartera</u></h4></center>
<form action="" method="post" width="200">
    <table border="0" align="center">
    <tr><td><br></td></tr>
  <tr>
    <td><b>Desde:</b></td>
    <td><input type="text" name="desde" value="<?echo date("Y-m-d");?>" size="12" maxlength="10" class="cajas"></td>
    <td><b>Hasta:</b></td>
    <td><input type="text" name="hasta" value="<?echo date("Y-m-d");?>" size="12" maxlength="10" class="cajas"></td>
  </tr>
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
      $consu="select vendedor.nombreven from vendedor
                where vendedor.cedulaven='$cedula' ";
                 $resulta=mysql_query($consu) or die("Error en la busqueda vendedor  ");
                 $reg=mysql_num_rows($resulta);
                 $filas_s=mysql_fetch_array($resulta);
                  ?>
	           <table border="0" align="center">
	                <tr>
	                       <td class="cajas"><b>Documento:</b>&nbsp;<? echo $cedula;?></td>
	                     </tr>
	                     <tr>
	                       <td class="cajas"><b>Vendedor:</b>&nbsp;<? echo $filas_s["nombreven"];?></td>
	                     </tr>
	            </table>
	                <?
                         $con="select carterazona.*,vendedor.nombreven from carterazona,vendedor
	                where vendedor.cedulaven=carterazona.cedulaven and
	                vendedor.cedulaven='$cedula' and
                        carterazona.fechap between '$desde' and '$hasta' order by  carterazona.codigo";
	                 $resul=mysql_query($con) or die("Error en la busqueda de comision  ");
	                 $regis=mysql_num_rows($resul);
                         if($regis != 0):
	                     ?>
	                     <center><h4><u>Detalles de la comisión</u></h4></center>
	                       <table border="0" align="center" >
	                         <tr class="cajas">
                                  <th>Item</th>
	                            <th>Cod_Pago</th>
	                            <th>Desde</th>
	                            <th>Hasta</th>
	                         <?$a=1;
	                          while ($filas=mysql_fetch_array($resul)):
                                      ?>
	                              <tr class="cajas">
	                              <th><? echo $a;?></th>
	                              <td><a href="imprimircartera.php?DatoUsuario=<?echo $cedula;?>&NroPago=<?echo $filas["codigo"];?>"><?echo $filas["codigo"];?></a></td>
	                              <td><? echo $filas["fechaini"];?></td>
	                              <td><? echo $filas["fechacorte"];?></td>

	                            </tr>
	                            <? $a=$a+1;
	                            endwhile;
	                            ?>
	                            </table>
                                                                    	                            <?
	                   else:
	                      ?>
	                         <script language="javascript">
	                            alert("No hay extractos de comision para este empleado ?")
	                            history.back()
	                         </script>
	                         <?
	                   endif;
	  endif;
	       ?>


</body>
</html>
