<html>
        <head>
                <title>Reporte de descarga</title>
                  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">

                <script language="javascript">
                        function imprimir()
                        {
                                window.print()
                        }
                </script>
        </head>
        <body onload="imprimir()">  <!-- sirve para cargar la funcion de impresion-->
               <?

        include("../conexion.php");
         $variable="select pagozona.*,zona.nitzona,zona.dvzona from pagozona,zona
                where zona.codzona=pagozona.codzona and
                       pagozona.radicado='$codigo'";
                     $resultado=mysql_query($variable)or die("consulta incorrecta uno");
        $registro=mysql_num_rows($resultado);
        if ($registro!=0):
           $filas=mysql_fetch_array($resultado);
            $nit=number_format($filas["nitzona"],0);
            $valor=number_format($filas["valor"],0);
            $codzona=$filas["codzona"];
            $cod=$filas["radicado"];
             ?>
               <table border="0" align="center" width="700">

                 <tr>
                  <td colspan="1"class="cajas"><b><u><div align="left"><img src="../image/logounico.png" border="0" height="110" cellpadding="0" cellspacing="0"><u><div align="center">PAGO DE INCAPACIDADES</div></u></b></td>
                </tr>
                <td>&nbsp;</td>
                <tr>
                 <td class="cajas"><b>Nit/Cédula:</b>&nbsp;<?echo $nit;?>-<?echo $filas["dvzona"];?> </td>
                </tr>
                <tr>
                 <td class="cajas"><b>Empresa Usuaria:</b>&nbsp;<?echo $filas["zona"];?></td>
                  </tr>
                 <tr>
                  <td class="cajas"><b>Nro_Factura:&nbsp;</b><?echo $filas["nrofactura"];?>&nbsp;&nbsp;<b>Fecha_Proceso:</b>&nbsp;<?echo $filas["fechap"];?></td>
                  </tr>
                 <tr>
                  <td class="cajas"><b>Nro_Radicado:</b>&nbsp;<?echo $filas["radicado"];?></td></center>
                </tr>
                <tr>
                 <td class="cajas"><b>Observaciones:</b>&nbsp;<?echo $filas["nota"];?> </td>
                </tr>
               </table>
                 <td>&nbsp;</td>
                 <tr>
                   <table border="0" align="center">
                      <tr aling="center">
                        <td colspan="2"></td><td class="cajas"><b>Detallado de Pago </b></td>
                      </tr>
                   </table>
                 <td>&nbsp;</td>

             <?
              $buscar="select depagozona.*,concat(nomemple,' ',nomemple1,' ',apemple,' ',apemple1) as empleado,empleado.cedemple from depagozona,pagozona,empleado,zona,incapacidad
	               where zona.codzona=empleado.codzona and
                               empleado.cedemple=incapacidad.cedemple and
                               zona.codzona=pagozona.codzona and
                               zona.codzona='$codzona' and
                               incapacidad.nroinca=depagozona.nroinca and
                               pagozona.radicado=depagozona.radicado and
	                       depagozona.radicado='$cod'";
              $resul=mysql_query($buscar)or die("consulta incorrecta uno");
              $reg=mysql_num_rows($resul);
             if($reg!=0):
                       ?>
                      <table border="0" align="center" width="700">
                         <tr align="center" class="cajas">
                          <td><b><div align="center">Item</div><b></td>
                             <td><b><div align="center">Nro_Incap.</div><b></td>
                             <td><b>Documento</b></td>
                             <td><b>Empleado</b></td>
                             <td><b><div align="center">Nro_Dias</div></b></td>
                             <td><b><div align="center">Ibc</div></b></td>
                             <td><b><div align="center">%Pago</div></b></td>
                             <td><b><div align="left">Total</div></b></td>
                         </tr>
                        <?$f=1;
                     while ($filas_s=mysql_fetch_array($resul)):
                       $total=number_format($filas_s["total"],0);
                       ?>
                       <tr align="center" class="cajas">
                       <td><div align="center"><?echo $f;?></div></td>
                          <td><div align="center"><?echo $filas_s["nroinca"];?></div></td>
                           <td><?echo $filas_s["cedemple"];?></td>
                          <td><?echo $filas_s["empleado"];?></td>
                          <td><div align="center"><?echo $filas_s["dias"];?></div></td>
                          <td><div align="center">$<?echo $filas_s["ibc"];?></div></td>
                          <td><div align="center"><?echo $filas_s["porcentaje"];?></div></td>
                          <td>$<?echo $total;?></td>

                       </tr>
                       <?
                       $f=$f+1;
                        $a=$a+$filas_s["total"];
                     endwhile;
                      $a=number_format($a,2);
                     ?>
                     </table>
                       <td>&nbsp;</td>
                      <tr >
                        <center><td class="cajas"><b>Total_Pago:</b>&nbsp;$<?echo $a;?></td></center>
                      </tr>
                     <?
              else:
               ?>
	          <script language="javascript">
	            alert("No hay detallado de comision  ?")
	            history.back()
	          </script>
	         <?
             endif;
          else:
               ?>
	          <script language="javascript">
	            alert("No hay comision en este rango de fechas ?")
	            history.back()
	          </script>
	         <?
          endif;

            ?>

                   </body>
</html>
