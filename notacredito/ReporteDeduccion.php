<html>
        <head>
                <title>Reporte de deducciones</title>
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
         $variable="select programardeduccion.*,maestro.nomaestro,maestro.dvmaestro,salario.desala from maestro,programardeduccion,salario
                where maestro.codmaestro=programardeduccion.codmaestro and
                salario.codsala=programardeduccion.codsala and
                       programardeduccion.id_p='$NroReporte'";
                     $resultado=mysql_query($variable)or die("Error al consulta la programacion de vacaciones");
        $registro=mysql_num_rows($resultado);
          $filas=mysql_fetch_array($resultado);
            $nit=number_format($filas["codmaestro"],0);
            $Pagado=number_format($filas["vlrpagado"],0);
            $CodP=$filas["id_p"];
             ?>
               <table border="0" align="center" width="700">

                 <tr>
                  <td colspan="10"class="cajas"><b><u><div align="left"><img src="../image/LogoInicio.JPG" border="0" height="100" width="195" cellpadding="0" cellspacing="0"><u><div align="center">PROGRAMACION DEDUCCIONES</div></u></b></td>
                </tr><td><br></td></td>
                 <tr class="cajas">
                  <td colspan="4"><b>Nit/Cédula:</b>&nbsp;<?echo $filas["codmaestro"];?>-<?echo $filas["dvmaestro"]?></td><td colspan="4"><b>Empresa:</b>&nbsp;<?echo $filas["nomaestro"];?></td>
                </tr>
                 <tr class="cajas">
                  <td colspan="4"><b>Cod_Deducción:</b>&nbsp;<?echo $filas["codsala"];?></td><td colspan="4"><b>Descripción:</b>&nbsp;<?echo $filas["desala"];?></td>
                </tr>
                 <tr class="cajas">
                  <td colspan="4"><b>Fecha_Carga:</b>&nbsp;<?echo $filas["fechapro"];?></td><td colspan="4"><b>Nro_Autorizacion:</b>&nbsp;<?echo $filas["id_p"];?></td><td colspan="40"><b>Vlr_Pago:</b>&nbsp;$<?echo $Pagado;?></td>
                </tr>
               </table>

             <?
            $buscar="select detalleprogramardeduccion.* from programardeduccion,detalleprogramardeduccion
	               where  programardeduccion.id_p=detalleprogramardeduccion.id_p and
                              programardeduccion.id_p='$CodP' order by detalleprogramardeduccion.empleado";
              $resul=mysql_query($buscar)or die("consulta incorrecta uno");
              $reg=mysql_num_rows($resul);
             if($reg!=0):
                       ?>
                      <table border="0" align="center" width="700">
                       <tr>
                        <td colspan="10" class="cajas"><b><div align="center"><u>Listado de Deducciones</u></div></b></td>
                      </tr>
                         <tr align="center" class="cajas">
                          <td><b><div align="center">Item</div><b></td>
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
