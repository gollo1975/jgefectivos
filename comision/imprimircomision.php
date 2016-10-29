<html>
        <head>
                <title>Reporte de Comision</title>
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
         $variable="select comision.*,vendedor.nombreven from comision,vendedor
                where vendedor.cedulaven=comision.cedulaven and
                vendedor.cedulaven='$cedula' and
                comision.fechaini='$desde' and comision.fechacorte='$hasta'";
                     $resultado=mysql_query($variable)or die("consulta incorrecta uno");
        $registro=mysql_num_rows($resultado);
        if ($registro!=0):
           $filas=mysql_fetch_array($resultado);
            $cedula=number_format($filas["cedulaven"],0);
            $codigo=$filas["codigo"];
             ?>
               <table border="0" align="center" width="700">
               <img src="../image/logotipo.png" border="0" height="110" cellpadding="0" cellspacing="0">
               <tr>
                 <td class="cajas"><b>Nit:&nbsp;811.034.496-8</b></td>
               </tr>
                 <tr>
                  <td colspan="5"class="cajas"><b><u><div align="center">EXTRACTO DE COMISIONES</div></u></b></td>
                </tr>
                 <td>&nbsp;</td>
                <td>&nbsp;</td>
                <tr>
                 <td class="cajas"><b>Documento:</b>&nbsp;&nbsp;&nbsp;&nbsp;<?echo $cedula;?> </td>
                </tr>
                <tr>
                 <td class="cajas"><b>Vendedor:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?echo $filas["nombreven"];?></td>
                  </tr>
                 <tr>
                  <td class="cajas"><b>Desde:&nbsp;&nbsp;</b><?echo $desde;?>&nbsp;&nbsp;<b>Hasta:</b>&nbsp;&nbsp;<?echo $desde;?></td>
                  </tr>
                 <tr>
                  <td class="cajas"><b>Nro_Comisión:</b>&nbsp;<?echo $filas["codigo"];?></td></center>
                </tr>
               </table>
                 <td>&nbsp;</td>
                 <tr>
                   <table border="0" align="center">
                      <tr aling="center">
                        <td colspan="2"></td><td class="cajas"><b>Detallado de empresas </b></td>
                      </tr>
                   </table>
                 <td>&nbsp;</td>

             <?
              $buscar="select decomision.* from decomision,comision
	                 where comision.codigo=decomision.codigo and
	                 comision.codigo='$codigo'";
                     $resul=mysql_query($buscar)or die("consulta incorrecta uno");
             $reg=mysql_num_rows($resul);
             if($reg!=0):
                       ?>
                      <table border="0" align="center" width="700">
                         <tr align="center" class="cajas">
                             <td><b>Zona<b></td>
                             <td><b>Convenio</b></td>
                             <td><b><div align="center">Porcentaje</div></b></td>
                             <td><b>Cant.</b></td>
                             <td><b>Total</b></td>
                         </tr>
                        <?
                     while ($filas_s=mysql_fetch_array($resul)):
                       $total=number_format($filas_s["total"],0);
                       ?>
                       <tr align="center" class="cajas">
                          <td><?echo $filas_s["zona"];?></td>
                          <td>$<?echo $filas_s["convenio"];?></td>
                          <td><div align="center"><?echo $filas_s["porcentaje"];?>%</div></td>
                          <td><div align="center"><?echo $filas_s["can"];?></div></td>
                          <td>$<?echo $total;?></td>

                       </tr>
                       <?
                        $a=$a+$filas_s["total"];
                     endwhile;
                      $a=number_format($a,2);
                     ?>
                     </table>
                       <td>&nbsp;</td>
                      <tr >
                        <center><td class="cajas"><b>Vlr_Comisión:</b>&nbsp;$<?echo $a;?></td></center>
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
