<html>

<head>
<title>Facturacion por fechas</title>
<LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<?
if (empty($desde)):
include("../conexion.php");
?>
<center><h4><u>Facturacion General</u><h4></center>
  <form action="" method="post">
    <table border="0" align="center">
      <tr><td><br></td></tr>
       <tr>
        <td><b>Fecha_Inicio:</b></td>
         <td><input type="text" name="desde" value="<? echo date("Y-m-d");?>" size="10" maxlength="10"></td>
       </tr>
       <tr>
        <td><b>Fecha Final:</b></td>
         <td><input type="text" name="hasta" value="<? echo date("Y-m-d");?>" size="10" maxlength="10"></td>
       </tr>
       <tr>
         <td><b>Digite la Zona:</b></td>
                              <td><select name="campo" class="cajas">
                              <option value="0">Seleccione la zona
                                <?
                                 $consulta_z="select codmaestro,nomaestro from maestro";
                                 $resultado_z=mysql_query($consulta_z)or die ("consulta incorrecta");
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
           <input type="reset" value="Limpiar" class="boton"></td>
        </tr>

    </table>

  </form>
  <?
elseif (empty($campo)):
   ?>
   <script language="javascript">
     alert("Debe de seleccionar una zona")
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
     $variable="select maestro.nomaestro from maestro where
                 maestro.codmaestro='$campo'";
         $resultado=mysql_query($variable)or die("consulta incorrecta");
        $registro=mysql_num_rows($resultado);
        if ($registro==0):
          ?>
          <script language="javascript">
            alert("La empresa no existe en sistema")
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
                 <td><?echo $filas["nomaestro"];?></td>
               </tr>
             <?
              endwhile;
               ?>
               </table>
              <?

            endif;
             include("../conexion.php");
            $variable1="select factura.nrofactura,factura.codigo,factura.fechaini,factura.fechaven,factura.fechagra,factura.subtotal,factura.iva,factura.grantotal,
                    factura.nsaldo,factura.estado,zona.zona from maestro,sucursal,zona,factura where
                    maestro.codmaestro=sucursal.codmaestro and
                    sucursal.codsucursal=zona.codsucursal and
                    zona.codzona=factura.codzona and
                    factura.fechaini between '$desde'and'$hasta' and
                    maestro.codmaestro='$campo' order by zona.zona";
        $resultado1=mysql_query($variable1)or die("Error al buscar facturas...");
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
         <tr><td><br></td></tr>
          <table border="0" align="center">
           <tr><td><br></td></tr>
           <tr class="cajas">
           <th class="fondo">Item</th>
              <th class="fondo">Nro_Factura</th>
              <th class="fondo">Zona</th>
              <th class="fondo">F_Inicio</th>
              <th class="fondo">F_Vcto</th>
              <th class="fondo">F_Proceso</th>
              <th class="fondo">Subtotal</th>
              <th class="fondo">Iva</th>
              <th class="fondo">Total</th>
              <th class="fondo">N_Saldo</th>
              <th class="fondo">Estado</th>
              </tr>
              <?$a=1;
             while($filas_s=mysql_fetch_array($resultado1)):
             $AuxNota=$filas_s["nrofactura"];
             $aux=number_format($filas_s["subtotal"],0);
             $aux1=number_format($filas_s["iva"],0);
             $aux2=number_format($filas_s["grantotal"],0);
             $aux3=number_format($filas_s["nsaldo"],0);
             ?>
               <tr class="cajas">
               <th><?echo $a;?></th>
              <td><?echo $filas_s["nrofactura"];?></td>
               <td><?echo $filas_s["zona"];?></td>
                 <td><?echo $filas_s["fechaini"];?></td>
                 <td><?echo $filas_s["fechaven"];?></td>
                 <td><?echo $filas_s["fechagra"];?></td>
                 <td><?echo $aux;?></td>
                 <td><?echo $aux1;?></td>
                 <td>&nbsp;<?echo $aux2;?></td>
                 <td>&nbsp;<?echo $aux3;?></td>
                 <td><?echo $filas_s["estado"];?></td>
                 </tr>
                <?
                $a=$a+1;
                $sumaIva=$sumaIva+$filas_s["iva"];
                $sumaSubtotal=$sumaSubtotal+$filas_s["subtotal"];
                $sumaGrantotal=$sumaGrantotal+$filas_s["grantotal"];
                $sumaSaldo=$sumaSaldo+$filas_s["nsaldo"];
             endwhile;
             $sumaIva=number_format($sumaIva,0);
             $sumaSubtotal=number_format($sumaSubtotal,0);
             $sumaGrantotal=number_format($sumaGrantotal,0);
             $sumaSaldo=number_format($sumaSaldo,0);
             ?>
          </table>
            <tr><td><br><td></tr>
            <td><h5><div align="center"><b>Subtotal:</b>&nbsp;<?echo $sumaSubtotal?>&nbsp;&nbsp;<b>Iva:</b>&nbsp;<?echo $sumaIva?>&nbsp;&nbsp;<b>Total_Factura:</b>&nbsp;<?echo $sumaGrantotal?>&nbsp;&nbsp;<b>Cartera:</b>&nbsp;<?echo $sumaSaldo?>&nbsp;&nbsp;</div></h5></td>
           <?
       endif;
     endif;
         ?>

        </table>
 <?
  $datos="select  notacredito.zona,notacredito.nronota,notacredito.nrofactura,notacredito.valor,notacredito.vlrsaldo,notacredito.vlriva,notacredito.subtotal from maestro,sucursal,zona,notacredito,factura
                 where maestro.codmaestro=sucursal.codmaestro and
                      sucursal.codsucursal=zona.codsucursal and
                      zona.codzona=factura.codzona and
                      factura.nrofactura=notacredito.nrofactura and
                      factura.fechaini between '$desde'and'$hasta' and
                      maestro.codmaestro='$campo' order by notacredito.zona";
	        $resul=mysql_query($datos)or die("Error al buscar Notas Creditos...");
	        $reg=mysql_num_rows($resul);
                if($reg!=0):
	                ?>
	                <td><center><h4><u>Notas Creditos</u></h4></center></td>
		        <tr><td><br></td></tr>
		        <table border="0" align="center">
		        <tr><td><br></td></tr>
		        <tr>
		        <th>Item</th>
	                <th>Nro_Nota</th>
                        <th>Nro_Factura</th>
                        <th>Zona</th>
                        <th>Subtotal</th>
                        <th>Iva</th>
                        <th>Gran Total</th>
	                <? $b=1;
                        while($filas=mysql_fetch_array($resul)):
						   $Total = $filas["subtotal"] + $filas["vlriva"] -$filas["vlrfte"];
						   $Grantotal = $Total;
                           $conIva=number_format($filas["vlriva"],0);
                           $conSubtotal=number_format($filas["subtotal"],0);
						   $Total=number_format($Total,0);
                        
                           ?>
                           <tr class="cajas">
	                        <th><?echo $b;?></th>
	                        <td><a href="../notacredito/imprimir.php?nronota=<?echo $filas["nronota"];?>"><?echo $filas["nronota"];?></a></td>
                            <td><?echo $filas["nrofactura"];?></td>
	                   	    <td><?echo $filas["zona"];?></td>
                                <?if($conSubtotal==0):?>
                                   <td><?echo $conTotal;?></td>
                                    <td><?echo $conIva;?></td>
                                    <td><?echo $conTotal;?></td>
                                 <?else:?>
    	                  	        <td><div align="right"><?echo $conSubtotal;?></div></td>
								   <td> <div align="right"><?echo $conIva;?></div></td>
								   <td> <div align="right"><?echo $Total;?></div></td>
                                 <?endif;?>
                          </tr>
                           <?
                           $b=$b+1;
	                   $Tiva=$Tiva+$filas["vlriva"];
	                   $Tsubtotal += $filas["subtotal"];
	                   $Totalvalor += $Grantotal;
                        endwhile;
                        $Tiva=number_format($Tiva,0);
                        $Tsubtotal=number_format($Tsubtotal,0);
                        $Totalvalor=number_format($Totalvalor,0);
                       ?>
                     </table>
                      <tr><td><br><td></tr>
                      <td><h5><div align="center"><b>Subtotal:</b>&nbsp;<?echo $Tsubtotal?>&nbsp;&nbsp;<b>Iva:</b>&nbsp;<?echo $Tiva?>&nbsp;&nbsp;<b>Total_Notas:</b>&nbsp;<?echo $Totalvalor?></div></h5></td>
                  <?
                endif;
?>
</body>
</html>
