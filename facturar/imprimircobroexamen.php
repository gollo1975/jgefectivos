<html>
        <head>
                <title>Reporte de descarga</title>
                  <LINK  REL="stylesheet" HREF="../formato.css"  type="text/css">

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
         $variable="select relacionexamen.*,zona.nitzona,zona.dvzona from relacionexamen,zona
                where zona.codzona=relacionexamen.codzona and
                       relacionexamen.radicado='$NroCobro'";
                     $resultado=mysql_query($variable)or die("Error al imprimir el reorte.!");
        $registro=mysql_num_rows($resultado);
        if ($registro!=0):
            $filas=mysql_fetch_array($resultado);
            $nit=number_format($filas["nitzona"],0);
            $Total=number_format($filas["total"],0);
            $codzona=$filas["codzona"];
            $cod=$filas["radicado"];
             ?>
              <table border="1" align="center" width="700">
		<tr>
		<td>
		<table border="0" align="center" width="700" >
                  <td colspan="10"class="cajas"><b><u><div align="left"><img src="../image/cabezote.PNG" border="0" height="135" cellpadding="0" cellspacing="0"></td>
                  <tr>
                        <td colspan="10" class="cajas"><div align="center"><b>DETALLADO DE COBRO EXAMENES MEDICOS</b></div></td>
                      </tr>
               <tr>
                        <td colspan="10"><div align="right"><b>Nro_Cobro:</b>&nbsp;<?echo $filas["radicado"];?></div></td>
                      </tr>
                <tr>
                 <td class="cajas"><b>Nit/Cédula:</b>&nbsp;<?echo $nit;?>-<?echo $filas["dvzona"];?> </td>
                </tr>
                <tr>
                 <td class="cajas"><b>Empresa Usuaria:</b>&nbsp;<?echo $filas["zona"];?></td>
                  </tr>
                 <tr>
                  <td class="cajas"><B>Fecha_Proceso:</b>&nbsp;<?echo $filas["fechap"];?></td>
                  </tr>
                 <tr>
                  <td class="cajas"><b>Valor_Cobro:</b>&nbsp;$<?echo $Total;?></td></center>
                </tr>
                <tr>
                  <td class="cajas"><b>Letras:</b>&nbsp;<?echo $filas["letras"];?> PESOS ML.</td></center>
                </tr>
                <tr>
                 <td class="cajas"><b>Observaciones:</b>&nbsp;<?echo $filas["nota"];?> </td>
                </tr>
                 </table>
                  </tr></td>
                  </table>
                 <table border="1" align="center" width="710">
                       <tr><td>
	                  <table border="0" align="center" width="710">
                        <td colspan="10"><b><div align="center">Detallado de los Exámenes</div> </b></td>
                      </tr>

	             <?
	              $buscar="select derelacionexamen.* from derelacionexamen,relacionexamen
		               where relacionexamen.radicado=derelacionexamen.radicado and
		                       relacionexamen.radicado='$cod'";
	              $resul=mysql_query($buscar)or die("consulta incorrecta uno");
	              $reg=mysql_num_rows($resul);
	             if($reg!=0):
	                       ?>
	                      <table border="0" align="center" width="700">
	                         <tr align="center" class="cajas">
	                          <td><b><div align="center">Item</div><b></td>
	                             <td><b><div align="center">Nro_Exámen</div><b></td>
	                             <td><b><div align="left">Documento</div></b></td>
	                             <td><b><div align="left">Empleado</div></b></td>
	                             <td><b><div align="center">F_Examen</div></b></td>
	                             <td><b><div align="center">Vlr_Examen</div></b></td>
	                         </tr>
	                        <?$f=1;
	                     while ($filas_s=mysql_fetch_array($resul)):
	                       $total=number_format($filas_s["valor"],0);
	                       ?>
	                       <tr align="center" class="cajas">
	                       <td><div align="center"><?echo $f;?></div></td>
	                          <td><div align="center"><?echo $filas_s["nro"];?></div></td>
	                           <td><div align="left"><?echo $filas_s["cedemple"];?></div></td>
	                          <td><div align="left"><?echo $filas_s["empleado"];?></div></td>
	                          <td><?echo $filas_s["fechae"];?></td>
	                          <td><div align="right">$<?echo $total;?></div></td>

	                       </tr>
	                       <?
	                       $f=$f+1;
	                        $a=$a+$filas_s["valor"];
	                     endwhile;
	                      $a=number_format($a,2);
	                     ?>
	                  </table>
	                 </table>
	                      <tr >
	                        <center><td class="cajas"><b><h5>Total_Cobro:</b>&nbsp;$<?echo $a;?></h5></td></center>
	                      </tr>
	                     <?
	              else:
	               ?>
		          <script language="javascript">
		            alert("No hay detallado de examenes medicos.!")
		            history.back()
		          </script>
		         <?
	             endif;
          else:
               ?>
	          <script language="javascript">
	            alert("No existe este radicado para cobro.!")
	            history.back()
	          </script>
	         <?
          endif;

            ?>

                   </body>
</html>
