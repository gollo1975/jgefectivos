<html>

<head>
<title>Consulta de Factura por Zona</title>
<LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<script language="javascript">
        function volver()// para declara funcion
        {
                pagina='facturazona.php'
                tiempo=60
                ubicacion='_self'
                setTimeout("open(pagina,ubicacion)",tiempo)
        }

</script>
<?
if (empty($desde)):
include("../conexion.php");
?>
<center><h4><u>Facturas por Zona</u><h4></center>
  <form action="" method="post" id="f1" name="f1">
    <table border="0" align="center">
      <tr>
        <td colspan="2" class="fondo"></td>
      </tr>
       <tr>
        <td><b>Fecha_Inicio:</b></td>
         <td><input type="text" name="desde" value="<? echo date("Y-m-d");?>" class="cajas" size="10" maxlength="12"></td>
       </tr>
       <tr>
        <td><b>Fecha Final:</b></td>
         <td><input type="text" name="hasta" value="<? echo date("Y-m-d");?>" class="cajas" size="10" maxlength="12"></td>
       </tr>
       <tr>
         <td><b>Zona:</b></td>
                              <td><select name="campo" class="cajas">
                              <option value="0">Seleccione la zona
                                <?
                                 $consulta_z="select * from zona order by zona";
                                 $resultado_z=mysql_query($consulta_z)or die ("consulta incorrecta");
                                while($filas_z=mysql_fetch_array($resultado_z)):
                                   ?>
                                   <option value="<?echo $filas_z["codzona"];?>"> <?echo $filas_z["zona"];?>
                                  <?
                                  endwhile;
                                  ?>
                                  </select></td>
       </tr>
       <tr><td><br></td></tr>
       <tr>
         <td colspan="2">
           <input type="submit" value="Buscar" class="boton" name="buscar" id="buscar">
           <input type="reset" value="Limpiar" class="boton"></td>
        </tr>
        
    </table>

  </form>
  <?
elseif (empty($campo)):
   ?>
   <script language="javascript">
     alert("Debe de seleccionar una zona de la lista!")
     history.back()
   </script>
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
     $variable="select zona.zona from zona where
                 zona.codzona='$campo'";
         $resultado=mysql_query($variable)or die("consulta incorrecta");
        $registro=mysql_num_rows($resultado);
        if ($registro==0):
          ?>
          <script language="javascript">
            alert("La zona no existe en la bd.")
            history.back()
          </script>
         <?
         else:
         ?>
          <table border="0" align="center">
              <?
             while($filas=mysql_fetch_array($resultado)):
             ?>
               <tr class="cajas">
                 <td><?echo $filas["zona"];?></td>
               </tr>
             <?
              endwhile;
               ?>
               </table>
              <?

            endif;
             include("../conexion.php");
            $variable1="select factura.nrofactura,factura.codigo,factura.fechaini,factura.fechaven,factura.fechagra,factura.subtotal,factura.iva,factura.grantotal,
                    factura.nsaldo,factura.estado from zona,factura where
                    zona.codzona=factura.codzona and
                    factura.fechaini between '$desde'and'$hasta' and
                    zona.codzona='$campo' order by factura.fechaven DESC";
        $resultado1=mysql_query($variable1)or die("consulta incorrecta");
        $registro=mysql_num_rows($resultado1);
        if ($registro==0):
          ?>
          <script language="javascript">
            alert("El dato No existe en la BD.")
            history.back()
          </script>
         <?
         else:
         ?>
         <td><center><h4><u>Listado de Facturas</u></h4></center></td>
         <table align="center">
           <tr>
             <td class="cajas">Si desea ver los recibo de cajas, Presion Click Sobre el Nro de la Factura ?</td>
           </tr>
         </table>
         <tr><td><br></td></tr>
          <table border="0" align="center">
           <tr>
             <td colspan="9" class="fondo"> </td>
           </tr>
           <tr class="cajas">
	      <th>&nbsp;</th>	
              <th class="fondo">Nro_Factura</th>
              <th class="fondo">Nro_Servicio</th>
			  <th class="fondo">F_Proceso</th>
              <th class="fondo">F_Inicio</th>
              <th class="fondo">F_Vencto</th>
              <th class="fondo">Subtotal</th>
              <th class="fondo">Iva</th>
              <th class="fondo">Total</th>
              <th class="fondo">&nbsp;Saldo</th>
              <th class="fondo">Estado</th>
              </tr>
              <?
             while($filas_s=mysql_fetch_array($resultado1)):
             $aux=number_format($filas_s["subtotal"],0);
             $aux1=number_format($filas_s["iva"],0);
             $aux2=number_format($filas_s["grantotal"],0);
             $aux3=number_format($filas_s["nsaldo"],0);
             ?>
               <tr class="cajas">
		<td>&nbsp;<a href="../factura/imprimir.php?nrofactura=<?echo $filas_s["nrofactura"];?>"> <img src="../image/informe.jpg" border = '0' ></a></td>	
              <td><a href="detalladorecibo.php?nrofactura=<?echo $filas_s["nrofactura"];?>"><?echo $filas_s["nrofactura"];?></a></td>
               <td><?echo $filas_s["codigo"];?></td> 
			    <td><?echo $filas_s["fechagra"];?></td>
                 <td><?echo $filas_s["fechaini"];?></td>
                 <td><?echo $filas_s["fechaven"];?></td>
                 <td><div align="right"><?echo $aux;?></div></td>
                 <td><div align="right"><?echo $aux1;?></div></td>
                 <td><div align="right">&nbsp;<?echo $aux2;?></div></td>
                 <td><div align="right">&nbsp;<?echo $aux3;?></div></td>
                 <td><?echo $filas_s["estado"];?></td>
                 </tr>
                <?
                $Saldo=$Saldo + $filas_s["nsaldo"];
                $Subtotal=$Subtotal + $filas_s["subtotal"];
                $TotalF=$TotalF + $filas_s["grantotal"];
                $IvaF=$IvaF + $filas_s["iva"];
              endwhile;
              $Saldo=number_format($Saldo,0);
              $Subtotal=number_format($Subtotal,0);
              $TotalF=number_format($TotalF,0);
              $IvaF=number_format($IvaF,0);
              ?>
              </table>
              <div align="center"><h4><b>Subtotal:</b>&nbsp;<?echo $Subtotal;?>&nbsp;<b>Iva:</b>&nbsp;<?echo $IvaF;?>&nbsp;<b>Total_Pagar:</b>&nbsp;<?echo $TotalF;?>&nbsp;<b>Cartera:</b>&nbsp;<font color="red"><?echo $Saldo;?></font>&nbsp;</h4></div>
                <tr><td><br></td></tr>
               <th><center><a href="imp1.php?campo=<?echo $campo;?>&desde=<?echo $desde;?>&hasta=<?echo $hasta;?>" target="_blank" onclick="volver()" class="fondo"><b><font color="blue"><h3>Imprimir</h3></font></b></a></center></th>
               <?
           endif;
         endif;
         ?>

        </table>
       </body>
  </html>
