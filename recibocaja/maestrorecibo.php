<html>

<head>
<title>Recibos de caja</title>
<link rel="stylesheet" href="../estilo.css" type="text/css">
</head>
<body>
<?
if (!isset($campo)):
 include("../conexion.php");
?>
<center><h4><u>Recibos de Cajas</u></h4></center>
  <form action="" method="post">
    <table border="0" align="center" width="200">
       <tr><td><br></td></tr>
       <tr>
          <td><b>Desde:&nbsp;</b></td>
          <td ><input type="text" name="desde" value="<?echo date("Y-m-d");?>"size="10" maxlength="10"></td>
          <td><b>Desde:&nbsp;</b></td>
          <td colspan="1"><input type="text" name="hasta" value="<?echo date("Y-m-d");?>" size="10" maxlength="10"></td>
       </tr>
       <tr>
        <td><b>Empresa:</b>&nbsp;</td>
          <td colspan="5"><select name="campo" class="cajas">
          <option value="0">Seleccione la Empresa
          <?
          $consulta_z="select maestro.nomaestro,maestro.codmaestro from maestro ";
          $resultado_z=mysql_query($consulta_z)or die ("Error al buscar empresa");
          while($filas_z=mysql_fetch_array($resultado_z)):
            ?>
            <option value="<?echo $filas_z["codmaestro"];?>"> <?echo $filas_z["nomaestro"];?>
            <?
         endwhile;
           ?>
         </select></td>
      </tr>
      <tr>
         <td><b>Tipo_Consulta:</b></td>
         <td colspan="5"><input type="radio" value="H" name="estado">Histórico<input type="radio" value="R" name="estado">Real</td>
      </tr>
      <tr><td><br></td></tr>
         <tr>
         <td colspan="15"><input type="submit" value="Buscar" class="boton">&nbsp;<input type="reset" value="Limpiar" class="boton"></td>
        </tr>
    </table>
  </form>
  <?
    elseif(empty($campo)):
   ?>
       <script language="javascript">
         alert("Seleccione la empresa de la lista ?")
         history.back()
       </script>
       <?
       elseif(empty($estado)):
   ?>
       <script language="javascript">
         alert("Seleccione el tipo de Busqueda ?")
         history.back()
       </script>
       <?
     else:
     if($estado=='H'):
             include("../conexion.php");
             $consulta="select recibo.* from recibo
              where recibo.fechare between '$desde' and '$hasta' and recibo.suma!= '' order by recibo.fechare" ;
	       $resultado=mysql_query($consulta)or die ("Consulta incorrecta");
	       $registro=mysql_num_rows($resultado);
	       if ($registro==0):
	          ?>
	          <script language="javascript">
	           alert("No hay recibos de cajas en esta rango de fechas ?")
	           history.back()
	          </script>
	        <?
	       else:
	          ?>
	              <table border="0" align="center">
	               <tr>
	                   <td colspan="9"><b>Listado de Recibos</b></td>
	                </tr>
	               </table>
	                <table border="0" align="center">
	                    <tr class="cajas" align="center">
	                  <th>Item</th>
	                  <th>Nro_Recibo</th>
	                   <th>Factura</th>
	                  <th>Nit/Cedula</th>
	                  <th>Cliente</th>
	                  <th>F_Pago</th>
	                  <th>Vlr_Pagado</th>
	                  <th>F_Pago</th>
	                 </tr>

	                  <?
	                  $suma=1;
	                  while($filas=mysql_fetch_array($resultado)):
	                    $valor=number_format($filas["valor"],0);
	                    ?>
	                    <tr  class="cajas">
	                        <th><?echo $suma;?></th>
	                         <td><a href="imprimirindi.php?nrocaja=<?echo $filas["nrocaja"];?>"><?echo $filas["nrocaja"];?></a></td>
	                          <td><?echo $filas["nrofactura"];?></td>
	                          <td><?echo $filas["nit"];?></td>
	                          <td><?echo $filas["zona"];?></td>
	                          <td><?echo $filas["pago"];?></td>
	                          <td><?echo $valor;?></td>
	                         <td><?echo $filas["fechare"];?></td>

	                   </tr>
	                     <?
	                     $contador=$contador+$filas["valor"];
	                     $suma=$suma + 1;
	                 endwhile;
	                  $contador=number_format($contador,0);
	                ?>
	                </table>
	                 <tr>
	                   <center><th><b><u>Ingresos</u>:&nbsp;$<?echo $contador;?></b></th></center>
	                 </tr>
	                <?
	       endif;
         else:
              include("../conexion.php");
             $consulta="select maestrorecibo.*,recibo.zona,recibo.nit,recibo.valor,tiporecibo.descripcion from maestro,maestrorecibo,recibo,tiporecibo
              where maestro.codmaestro=maestrorecibo.codmaestro and
                   maestrorecibo.fechapago between '$desde' and '$hasta' and
                   maestrorecibo.idrecibo=tiporecibo.idrecibo and
                   maestrorecibo.nrocaja=recibo.nrocaja and
                   maestro.codmaestro='$campo' order by maestrorecibo.fechapago DESC";
	       $resultado=mysql_query($consulta)or die ("Consulta incorrecta de reales");
	       $registro=mysql_num_rows($resultado);
	       if ($registro==0):
	          ?>
	          <script language="javascript">
	           alert("No hay recibos de cajas en esta rango de fechas ?")
	           history.back()
	          </script>
	        <?
	       else:
	          ?>
	              <table border="0" align="center">
	               <tr>
	                   <td colspan="9"><b>Listado de Recibos</b></td>
	                </tr>
	               </table>
	                <table border="0" align="center">
	                    <tr class="cajas" align="center">
	                  <th>Item</th>
	                  <th>Nro_Recibo</th>
					  <th>Nit/Cedula</th>
					  <th>Cliente</th>
	                  <th>F_Pago</th>
	                  <th>Vlr_Invidual</th>
					  <th>Vlr_Total</th>
	                  <th>Tipo_Pago</th>
	                 </tr>
	                  <?
	                  $suma=1;
	                  while($filas=mysql_fetch_array($resultado)):
	                    $valor=number_format($filas["vlrpagado"],0);
						$valorP=number_format($filas["valor"],0);
	                    ?>
	                    <tr  class="cajas">
	                        <th><?echo $suma;?></th>
	                         <td><a href="ImprimirRecibo.php?NroRecibo=<?echo $filas["nrocaja"];?>"><?echo $filas["nrocaja"];?></a></td>
							  <td><?echo $filas["nit"];?></td>
							  <td><?echo $filas["zona"];?></td>
	                          <td><div align="center"><?echo $filas["fechapago"];?></div></td>
							  <td><div align="right"><?echo $valorP;?></div></td>
							   <td><div align="right"><?echo $valor;?></div></td>
	                         <td><?echo $filas["descripcion"];?></td>

	                   </tr>
	                     <?
	                     $contador=$contador+$filas["valor"];
	                     $suma=$suma + 1;
	                 endwhile;
	                 $contador=number_format($contador,0);
	                ?>
	                </table>
	                 <tr>
	                   <center><th><b><u>Ingresos</u>:&nbsp;$&nbsp;<?echo $contador;?></b></th></center>
	                 </tr>
	                <?
	       endif;

         endif;
  endif;

     ?>


</body>
</html>
