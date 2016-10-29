<html>
<head>
<title>Consulta de Factura por Zona</title>
<LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>

<?
           include("../conexion.php");
            $variable1="select factura.nrofactura,factura.fechaini,factura.fechaven,factura.fechagra,factura.subtotal,factura.iva,factura.grantotal,
                    factura.nsaldo,factura.estado from zona,factura where
                    zona.codzona=factura.codzona and
                    factura.nsaldo > 0 and
                    zona.codzona='$codigo'";
        $resultado1=mysql_query($variable1)or die("consulta incorrecta");
        $registro=mysql_num_rows($resultado1);
        if ($registro==0):
          ?>
          <script language="javascript">
            alert("No existe Cartera En Facturación ?")
            history.back()
          </script>
         <?
         else:
         ?>
         <td><center><h4>Datos de las Facturas</h4></center></td>
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
		   <th class="fondo">#</th>
              <th class="fondo">Nro_Factura</th>
              <th class="fondo">F_Inicio</th>
              <th class="fondo">F_Vencimiento</th>
              <th class="fondo">F_Proceso</th>
              <th class="fondo">Subtotal</th>
              <th class="fondo">Iva</th>
              <th class="fondo">&nbsp;Total</th>
              <th class="fondo">&nbsp;Saldo</th>
              <th class="fondo">Estado</th>
              </tr>
              <? $l= 1;
             while($filas_s=mysql_fetch_array($resultado1)):
              $subtotal=number_format($filas_s["subtotal"],0);
              $iva=number_format($filas_s["iva"],0);
              $grantotal=number_format($filas_s["grantotal"],0);
              $nsaldo=number_format($filas_s["nsaldo"],0);
             ?>
               <tr class="cajas">
			     <th><?echo $l;?></th>
              <td><a href="informerecibo.php?nrofactura=<?echo $filas_s["nrofactura"];?>"><?echo $filas_s["nrofactura"];?></a></td>
                 <td><?echo $filas_s["fechaini"];?></td>
                 <td><?echo $filas_s["fechaven"];?></td>
                 <td><?echo $filas_s["fechagra"];?></td>
                 <td><?echo $subtotal;?></td>
                 <td><?echo $iva;?></td>
                 <td>&nbsp;<?echo $grantotal;?></td>
                 <td>&nbsp;<?echo $nsaldo;?></td>
                 <td><?echo $filas_s["estado"];?></td>
                 </tr>
                <?
				$l += 1;
				$Contador += $filas_s["nsaldo"]; 
              endwhile;
			  $Contador=number_format($Contador,0);
              ?>
              </table>
			  <td><center><h4>Total Pagar:&nbsp;<?php echo $Contador;?></h4></center></td>
               <th><center><a href="impresion.php?codigo=<?echo $codigo;?>"  class="fondo" title="Permite imprimir el Informe"><font color="red">Imprimir</font></a></center></th>
               <?
           endif;
        ?>

        </table>
       </body>
  </html>
