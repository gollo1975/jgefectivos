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
        <body onLoad="imprimir()">  <!-- sirve para cargar la funcion de impresion-->
               <?

        include("../conexion.php");
         $variable="select cobroexamen.* from cobroexamen
                where cobroexamen.codigo='$codigo'";
                     $resultado=mysql_query($variable)or die("consulta incorrecta uno");
        $registro=mysql_num_rows($resultado);
        if ($registro!=0):
           $filas=mysql_fetch_array($resultado);
            $nit=number_format($filas["nit"],0);
            $valor=number_format($filas["valor"],0);
            $cod=$filas["codigo"];
             ?>
               <table border="1" align="center" width="830"><tr><td>
                <table border="0" align="center" width="830">
               <img src="../image/logoInicio.JPG" border="0" height="103" cellpadding="0" cellspacing="0" width="175">
               <td colspan="30"class="cajas"><b><u><div align="center">EXTRACTO DE DESCARGAR</div></u></b></td>
                </tr>

                <tr>
                 <td class="cajas"><b>Nit:</b>&nbsp;<?echo $nit;?> </td>
                </tr>
                <tr>
                 <td class="cajas"><b>Proveedor:</b>&nbsp;<?echo $filas["provedor"];?></td>
                  </tr>
                 <tr>
                  <td class="cajas"><b>Nro_Factura:&nbsp;</b><?echo $filas["nrofactura"];?>&nbsp;<b>Valor:</b>&nbsp;<?echo $valor;?>&nbsp;<b>Nro_Carga:</b>&nbsp;<?echo $filas["codigo"];?>&nbsp;<b>Fecha_Proceso:</b>&nbsp;<?echo $filas["fechap"];?></td>
                  </tr>
                <tr>
                 <td colspan="30" class="cajas"><b>Observaciones:</b>&nbsp;<?echo $filas["observacion"];?> </td>
                </tr>
                  <table border="1" align="center" width="830"><tr><td>
                   <table border="0" align="center" width="830">
                      <tr>
                        <td colspan="10"><td class="cajas"><b><div align="center">Detallado de Examenes</div></b></td>
                      </tr>
                   </table>


             <?
              $buscar="select dexamen.* from dexamen,cobroexamen
	                 where cobroexamen.codigo=dexamen.codigo and
	                 cobroexamen.codigo='$cod'";
                     $resul=mysql_query($buscar)or die("consulta incorrecta uno");
             $reg=mysql_num_rows($resul);
             if($reg!=0):
                       ?>
                      <table border="0" align="center" width="830">
                         <tr align="center" class="cajas">
                             <td><b><div align="left">Documento</div><b></td>
                             <td><b><div align="left">Empleado</div></b></td>
                             <td><b><div align="center">Nro_Recibo</div></b></td>
                             <td><b><div align="left">Vlr_Examen</div></b></td>
                             <td><b><div align="left">Postivo</div></b></td>
                             <td><b><div align="left">Negativo</div></b></td>
                             <td><b><div align="left">Estado</div></b></td>
                              <td><b><div align="left">Zona</div></b></td>
                         </tr>
                        <?
                     while ($filas_s=mysql_fetch_array($resul)):
                       $valor=number_format($filas_s["vlrexamen"],0);
                       $negativo=number_format($filas_s["negativo"],0);
                       $positivo=number_format($filas_s["positivo"],0);
                       ?>
                       <tr align="center" class="cajas">
                          <td><div align="left"><?echo $filas_s["cedula"];?></div></td>
                          <td><div align="left"><?echo $filas_s["asociado"];?></div></td>
                          <td><div align="center"><?echo $filas_s["nroabono"];?></div></td>
                          <td>$<?echo $valor;?></td>
                           <td>$<?echo $positivo;?></td>
                            <td>$<?echo $negativo;?></td>
                          <td><div align="left"><?echo $filas_s["estado"];?></div></td>
                           <td><div align="left"><?echo $filas_s["zona"];?></div></td>
                       </tr>
                       <?
                        $a=$a+$filas_s["vlrexamen"];
                     endwhile;
                      $a=number_format($a,2);
                     ?>

                       <td>&nbsp;</td>
        <tr >
                        <td class="cajas" colspan="10"><b><div align="right">Total Factura:</b>&nbsp;$<?echo $a;?></div></td>
                      </tr>
                    </table>
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
