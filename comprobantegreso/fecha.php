<html>

<head>
<title>Comprobante de Egreso</title>
<LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<script language="javascript">
        /*function volver()// para declara funcion
        {
                pagina='recibozona.php'
                tiempo=100
                ubicacion='_self'
                setTimeout("open(pagina,ubicacion)",tiempo)
        }
        */
</script>
<?
if (empty($desde)):
?>
<center><h4><b><u>Comprobantes de Egreso</u></b></h4></center>
  <form action="" method="post">
    <table border="0" align="center">
      <tr><td><br></td></tr>
       <tr>
        <td><b>Fecha_Inicio:</b></td>
         <td><input type="text" name="desde" value="<? echo date("Y-m-d");?>" size="13" maxlength="10" class="cajas">&nbsp;</td>
       </tr>
       <tr>
        <td><b>Fecha Final:</b></td>
         <td><input type="text" name="hasta" value="<? echo date("Y-m-d");?>" size="13" maxlength="10" class="cajas">&nbsp;</td>
       </tr>
      <tr><td><b>Tipo_Busqueda:</b></td><td><input type="radio" value="historico" name="estado">Historico <input type="radio" value="actual" name="estado">Actual</td><tr>
         <tr><td><br></td></tr>
       <tr>
         <td colspan="2">
           <input type="submit" value="Buscar" class="boton">
           <input type="reset" value="Limpiar" class="boton"></td>
        </tr>
         <tr><td><br></td></tr>
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
   elseif (empty($estado)):
   ?>
   <script language="javascript">
     alert("Seleccione el tipo de busqueda en Sistema.")
     history.back()
   </script>
   <?
   else:
       if($estado=='historico'):
	      include("../conexion.php");
	     $variable1="select comprobante.* from comprobante where
	                     comprobante.fecha between '$desde' and '$hasta' and
                             comprobante.ciudad != '' order by comprobante.fecha DESC";
	        $resultado1=mysql_query($variable1)or die("consulta incorrecta");
	        $registro=mysql_num_rows($resultado1);
	        if ($registro==0):
	          ?>
	          <script language="javascript">
	            alert("No existen Históricos de comprobantes de egreso en este rango de Fechas.")
	            history.back()
	          </script>
	         <?
	         else:
	         ?>
	         <center><h4>Datos Encontrados</h4></center>
	         <table align="center">
	          <tr>
	             <td class="cajas">Para ver el Informe del comprobante de egreso, Presione Click Sobre el Nro de Comprobante.. </td>
	          </tr>
	         </table>
	         <tr><td><br></td></tr>
	         <table align="center">
	         <table border="0" align="center">
	           <tr>
	             <td colspan="9" class="fondo"> </td>
	           </tr>
	           <tr class="cajas">
	              <th class="fondo">Item</th>
	              <th class="fondo">Número</th>
	              <th class="fondo">Nro_Factura</th>
                      <th class="fondo">Nit/Cédula</th> 
	              <th class="fondo">Tercero</th>
	              <th class="fondo">F_Pago</th>
	              <th class="fondo">Vlr_Pagado</th>
	           </tr>
	              <?
	              $l=1;
	             while($filas_s=mysql_fetch_array($resultado1)):
	             $valor=number_format($filas_s["valor"],0);
	             $nuevosaldo=number_format($filas_s["nuevosaldo"],0);
	             ?>
	               <tr class="cajas">
	                 <th><?echo $l;?></th>
	                 <td><a href="imprimirindividual.php?nro=<?echo $filas_s["nro"];?>"><?echo $filas_s["nro"];?></a></td>
	                 <td><?echo $filas_s["nrofactura"];?></td>
                         <td><?echo $filas_s["nitprove"];?></td>
	                 <td><?echo $filas_s["cliente"];?></td>
	                 <td><?echo $filas_s["fecha"];?></td>
	                 <td><div align="right"><?echo $valor;?></div></td>
	                 </tr>
	                <?
                         $Total=$Total+$filas_s["valor"];
	                 $l=$l+1;
	              endwhile;
                      $Total=number_format($Total,0);
	              ?>
	              </table>
                       <div align="center"><b>Total_Pag.:&nbsp;<?echo $Total;?></b></div>
	               <?
	           endif;
       else:
                include("../conexion.php");
	            $ConT="select maestrocomprobante.nro,maestrocomprobante.vlrpagado,maestrocomprobante.fechapago,maestrocomprobante.id,tipocomprobante.descripcion,comprobante.cliente,comprobante.valor,comprobante.nitprove from maestrocomprobante,comprobante,tipocomprobante
                where maestrocomprobante.fechapago between '$desde' and '$hasta' and 
                comprobante.nro=maestrocomprobante.nro  and
				tipocomprobante.id = maestrocomprobante.id  order by maestrocomprobante.fechapago DESC";
	        $resT=mysql_query($ConT)or die("error al buscar comprobantes");
	        $regT=mysql_num_rows($resT);
	        if ($regT==0):
                   ?>
	          <script language="javascript">
	            alert("No existen comprobantes de egreso, en este rango de Fechas.")
	            history.back()
	          </script>
	         <?
                else:
                   ?>
                     <center><h4>Datos Encontrados</h4></center>
	             <table align="center">
	             <tr>
	             <td class="cajas">Presione Click Sobre el Nro de Comprobante.. </td>
	             </tr>
	             </table>
	             <tr><td><br></td></tr>
	             <table align="center">
	             <table border="0" align="center">
	             <tr>
	              <td colspan="9" class="fondo"> </td>
	             </tr>
	             <tr class="cajas">
	              <th class="fondo">Item</th>
	              <th class="fondo">Número</th>
                      <th class="fondo">Nit/Cédula</th> 
                      <th class="fondo">Tercero</th> 
                          <th class="fondo">F_Pago</th>
	              <th class="fondo">Vlr_Pagado</th>
                      <th class="fondo">T_Proceso</th>
	             </tr>
	              <?
	              $l=1;
	             while($filas_s=mysql_fetch_array($resT)):
	             $valor=number_format($filas_s["valor"],0);
	            ?>
	               <tr class="cajas">
	                 <th><?echo $l;?></th>
	                 <td><a href="imprimircomprobante.php?NroComprobante=<?echo $filas_s["nro"];?>"><?echo $filas_s["nro"];?></a></td>
                         <td><?echo $filas_s["nitprove"];?></td>
                         <td><?echo $filas_s["cliente"];?></td>
	                 <td><?echo $filas_s["fechapago"];?></td>
	                 <td><div align="right"><?echo $valor;?></div></td>
                     <td><?echo $filas_s["descripcion"];?></td>
	                 </tr>
	                <?
                         $Total=$Total+$filas_s["valor"];
	                 $l=$l+1;
	              endwhile;
                      $Total=number_format($Total,0);
	              ?>
	              </table>
                       <div align="center"><b>Total_Pag.:&nbsp;<?echo $Total;?></b></div>
	               <?
	        endif;
       endif;
 endif;
	         ?>

        </table>
       </body>
  </html>
