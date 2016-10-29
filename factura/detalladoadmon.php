<html>

<head>
  <title>Utilidad del Admon</title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
  </head>
<?php
  include ("../conexion.php");
  $con1="select zona.zona from zona where  zona.codzona='$CodZona'";
  $resu1=mysql_query($con1) or die ("Error al buscar empresas");
  $re1=mysql_affected_rows();
  $filas_e=mysql_fetch_array($resu1);
  $Zona=$filas_e["zona"];
   $consulta="select zona.zona,factura.nrofactura,factura.fechagra,factura.fechaini,factura.fechaven,defactura.total from zona,factura,defactura,item
   where  zona.codzona=factura.codzona and
          factura.nrofactura=defactura.nrofactura and
          factura.fechaini between '$desde'and'$hasta' and
		  factura.estado != 'ANULADA' and
          defactura.codcom=item.codcom and
		  zona.codzona='$CodZona' and
          item.codcom='$codigo' order by factura.nrofactura";
   $resultado=mysql_query($consulta) or die ("Error en la busquedas de  facturas con administracion ");
   $registros=mysql_num_rows($resultado);
   if($registros!=0){
	                  ?>
	                    <table border="0" align="center">
	                     <tr>
	                       <td class="cajas" colspan="5"><b>Zona:</b>&nbsp;<? echo $Zona;?></td>
	                     </tr>
						 <tr>
	                       <td class="cajas"><b>Desde:</b>&nbsp;<? echo $desde;?></td>
						   <td class="cajas"><b>Hasta:</b>&nbsp;<? echo $hasta;?></td>
	                     </tr>
                           </table>
                            <tr><td><br></td></tr>       
	                   <table border="0" align="center" >
	                         <tr class="cajas">
	                            <th>Item</th>
	                            <th>Nro_Factura</th>
								<th>F_Proceso</th>
								<th>F_Inicio</th>
								<th>F_Vcto</th>
								<th>Estado</th>
	                            <th>Vlr_Admon</th>
	                         <?
                                 $a=1;
	                          while ($filas=mysql_fetch_array($resultado)):
                                    $total=number_format($filas["total"],0);
	                            ?>
	                              <tr class="cajas">
                                  <th><? echo $a;?></th>
	                              <td><? echo $filas["nrofactura"];?></a></td>
	                              <td><? echo $filas["fechagra"];?></td>
                                  <td><? echo $filas["fechaini"];?></td>
	                              <td><? echo $filas["fechaven"];?></td>
								  <td><? echo $filas["estado"];?></td>
	                              <td><div align="right">$<? echo $total;?></div></td>
                             </tr>
	                            <?
                                    $con=$con+$filas["total"];
                                    $a=$a+1;
	                          endwhile;
                                  $con=number_format($con,2);
	                            ?>
	                        </table>
                                <div align="center"><b>Vlr_Admon:&nbsp;<? echo $con;?></div>
                            <?
   }else{
	        ?>
	           <script language="javascript">
	              alert("No hay registros De Facturacion en este rango de fechas ?")
	              history.back()
	             </script>
	           <?
   }
?>
</body>
</html>
