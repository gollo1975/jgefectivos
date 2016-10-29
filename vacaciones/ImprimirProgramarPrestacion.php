<html>
        <head>
                <title>Programacion de Prestaciones</title>
                  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
                  <script language="javascript">
                        function imprimir()
                        {
                                window.print()
                        }
    </script>

        </head>
        <body onload="imprimir()">
               <?

        include("../conexion.php");
         $variable="select programarprestacion.*,maestro.nomaestro,maestro.dvmaestro from maestro,programarprestacion
                where maestro.codmaestro=programarprestacion.codmaestro and
                       programarprestacion.idprogramapresta='$IdPrograma'";
                     $resultado=mysql_query($variable)or die("Error al consulta la programacion de vacaciones");
        $registro=mysql_num_rows($resultado);
          $filas=mysql_fetch_array($resultado);
            $nit=number_format($filas["codmaestro"],0);
            $valor=number_format($filas["vlrpagado"],0);
            $cod=$filas["idprogramapresta"];
             ?>
               <table border="0" align="center" width="720">

                 <tr>
                  <td colspan="1"class="cajas"><b><u><div align="left"><img src="../image/LogoInicio.JPG" border="0" height="100" width="195" cellpadding="0" cellspacing="0"><u><div align="center">PROGRAMACION DE PRESTACIONES</div></u></b></td>
                </tr>
                <td>&nbsp;</td>
                <tr>
                 <td class="cajas"><b>Nit/Cédula:</b>&nbsp;<?echo $nit;?>-<?echo $filas["dvmaestro"];?> </td>
                </tr>
                 <tr>
                  <td class="cajas"><b>Empresa:&nbsp;</b><?echo $filas["nomaestro"];?>&nbsp;&nbsp;<b>F_Proceso:</b>&nbsp;<?echo $filas["fechap"];?></td>
                  </tr>
                 <tr>
                  <td class="cajas"><b>Nro_Programación:</b>&nbsp;<?echo $filas["idprogramapresta"];?></td></center>
                </tr>
               </table>
                 <td>&nbsp;</td>
                 <tr>
                   <table border="0" align="center">
                      <tr aling="center">
                        <td colspan="2"></td><td class="cajas"><b>Listado de Prestaciones</b></td>
                      </tr>
                   </table>
                 <td>&nbsp;</td>

             <?
            $buscar="select detallepagoprestacion.* from detallepagoprestacion,programarprestacion
	               where  programarprestacion.idprogramapresta=detallepagoprestacion.idprogramapresta and
                              programarprestacion.idprogramapresta='$cod' order by detallepagoprestacion.zona";
              $resul=mysql_query($buscar)or die("consulta incorrecta uno");
              $reg=mysql_num_rows($resul);
             if($reg!=0):
                       ?>
                      <table border="0" align="center" width="720">
                         <tr align="center" class="cajas">
                          <td><b><div align="center">Item</div><b></td>
                             <td><b><div align="center">Nro_Vaca.</div><b></td>
                             <td><b>Documento</b></td>
                             <td><b>Empleado</b></td>
                             <td><b><div align="center">Zona</div></b></td>
                             <td><b><div align="left">Valor_Pagar</div></b></td>
                         </tr>
                        <?$f=1;
                     while ($filas_s=mysql_fetch_array($resul)):
                       $total=number_format($filas_s["total"],0);
                       ?>
                       <tr align="center" class="cajas">
                       <td><div align="center"><?echo $f;?></div></td>
                          <td><div align="center"><?echo $filas_s["nropresta"];?></div></td>
                           <td><?echo $filas_s["cedemple"];?></td>
                          <td><?echo $filas_s["empleado"];?></td>
                          <td><div align="left"><?echo $filas_s["zona"];?></div></td>
                          <td><div align="right">$<?echo $total;?></div></td>

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
	            alert("No hay detallado de la programacion de vacaciones!  ?")
	            history.back()
	          </script>
	         <?
             endif;
            ?>

                   </body>
</html>
