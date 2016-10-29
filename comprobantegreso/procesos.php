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
include("../conexion.php");
?>
<center><h4><b><u>Comprobantes</u></b></h4></center>
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
       <tr>
        <td ><b>Tipo Proceso:</b></td>
			   <td  colspan="15"><select name="proceso" class="cajas" id="proceso">
			   <option value="0">Seleccione
			    <?
                           $consulta="select id,descripcion from tipocomprobante order by descripcion";
	                   $resultado=mysql_query($consulta) or die("error al buscar comprobante");
	                   while ($filas=mysql_fetch_array($resultado)):
	                        ?>
	                       <option value="<?echo $filas["id"];?>"><?echo $filas["descripcion"];?>
	                       <?
	                   endwhile;
	                      ?>
	                   </select></td>
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
   elseif (empty($proceso)):
   ?>
   <script language="javascript">
     alert("Seleccione el tipo de proceso.")
     history.back()
   </script>
   <?
   else:
	      include("../conexion.php");
	     $variable1="select maestrocomprobante.*,comprobante.cliente,comprobante.nitprove,comprobante.valor,tipocomprobante.descripcion from maestrocomprobante,comprobante,tipocomprobante where
	                     comprobante.nro=maestrocomprobante.nro and
                             maestrocomprobante.fechapago between '$desde' and '$hasta' and
                             maestrocomprobante.id ='$proceso' and
							 tipocomprobante.id = maestrocomprobante.id order by maestrocomprobante.fechapago DESC";
	        $resultado1=mysql_query($variable1)or die("consulta incorrecta de comprobantes");
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
				  <th class="fondo">Nro_Comp.</th>
				  <th class="fondo">Factura</th>
                   <th class="fondo">Nit/Cédula</th>
                   <th class="fondo">Tercero</th>
	              <th class="fondo">F_Pago</th>
	              <th class="fondo">Vlr_Pagado</th>
                  <th class="fondo">Vlr_Total</th>
	              <th class="fondo">T_Proceso</th>
	           </tr>
	              <?
	              $l=1;
	             while($filas_s=mysql_fetch_array($resultado1)):
	               $valor=number_format($filas_s["vlrpagado"],0);
                     $valorInd=number_format($filas_s["valor"],0);
	             ?>
	               <tr class="cajas">
	                 <th><?echo $l;?></th>
	                 <td><a href="imprimircomprobante.php?NroComprobante=<?echo $filas_s["nro"];?>"><?echo $filas_s["nro"];?></a></td>
					    <td><?echo $filas_s["nrofactura"];?></td>
                           <td><?echo $filas_s["nitprove"];?></td>
                          <td><?echo $filas_s["cliente"];?></td>
	                 <td><?echo $filas_s["fechapago"];?></td>
                         <td><div align="center"><?echo $valorInd;?></div></td>
	                 <td><div align="center"><?echo $valor;?></div></td>
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
	         ?>

        </table>
       </body>
  </html>
