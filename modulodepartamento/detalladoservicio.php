<html>

<head>
  <title>Detallado del Servicio</title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
 </head>
<?
include ("../conexion.php");
$consu="select  cobrozona.* from cobrozona
        where cobrozona.codigo='$codservicio'";
        $resulta=mysql_query($consu) or die("consulta incorrecta 1  ");
         while ($filas_s=mysql_fetch_array($resulta)):
           $total=$filas_s["total"];
           $incapacidad=$filas_s["incapacidad"];
           $anticipo=$filas_s["anticipo"];
           $otros=$filas_s["otros"];
           $ajuste=$filas_s["ajuste"];
           $menorvlr=$filas_s["menorvlr"];
           $subtotal=$filas_s["subtotal"];
           $iva=$filas_s["ivatotal"];
           $grantotal=$filas_s["grantotal"];
           $ded=($incapacidad+$anticipo+$otros+$ajuste+$menorvlr);
            ?>
            <table border="0" align="center">
              <tr>
               <td colspan="5""><? echo $filas_s["zona"];?></td>
              </tr>
              <tr class="cajas">
                <td><b>Desde:&nbsp;&nbsp;</b><? echo $filas_s["desde"];?></td>
                <td colspan="2"><b>Hasta:&nbsp;&nbsp;</b><? echo $filas_s["hasta"];?></td>
              </tr>
              <tr class="cajas">
                <td><b>Nro_Servicio:&nbsp;&nbsp;</b><? echo $filas_s["codigo"];?></td>
              </tr>
            </table>
            <?
          endwhile;
                $consulta="select decobrozona.* from cobrozona,decobrozona
                 where cobrozona.codigo=decobrozona.codigo and
                 cobrozona.codigo='$codservicio'";
                 $resultado=mysql_query($consulta) or die("consulta incorrecta 3 ");
                 $registros=mysql_num_rows($resultado);
                  if($registros!=0):
                     ?>
                     <center><h4>Detallado del Servicio</h4></center>
                        <table border="0" align="center" >
                         <tr class="cajas">
                            <td><b>Cédula</b></td>
                            <td><b>Empleado</b></td>
                            <td><b>Básico</b></td>
                            <td><b>&nbsp;Tiempo</td>
                            <td><b>&nbsp;Ayuda</td>
                            <td><b>&nbsp;Seg_Social</b></td>
                            <td><b>&nbsp;Caja<b></td>
                            <td><b>&nbsp;Presta.</b></td>
                            <td><b>&nbsp;Admon</b></td>
                            <td><b>&nbsp;Iva</b></td>
                            <?
                          while ($filas=mysql_fetch_array($resultado)):
                            ?>
                            <tr class="cajas">
                              <td><? echo $filas["cedemple"];?></td>
                              <td><? echo $filas["empleado"];?></td>
                              <td><? echo $filas["basico"];?></td>
                              <td>&nbsp;<? echo $filas["tiempo"];?></td>
                              <td>&nbsp;<? echo $filas["ayuda"];?></td>
                              <td>&nbsp;<? echo $filas["ss"];?></td>
                              <td>&nbsp;<? echo $filas["cp"];?></td>
                              <td>&nbsp;<? echo $filas["ps"];?></td>
                              <td>&nbsp;<? echo $filas["admon"];?></td>
                              <td>&nbsp;<? echo $filas["iva"];?></td>
                            </tr>
                            <?
                            $suma=$suma+1;
                            $con=$con + $filas["basico"];
                            $con1=$con1 + $filas["tiempo"];
                            $con2=$con2 + $filas["ayuda"];
                            $con3=$con3 + $filas["ss"];
                            $con4=$con4 + $filas["cp"];
                            $con5=$con5 + $filas["ps"];
                            $con6=$con6 + $filas["admon"];
                            $con7=$con7 + $filas["iva"];
                            $tto=($con+$con1+$con2+$con3+$con4+$con5+$con6)+($ded);
                            endwhile;
                            ?>
                            </table>
                            <table border="0" align="center">
                              <tr class="cajas">
                                 <td><b>Nro:</b>&nbsp;<? echo $suma;?>&nbsp;&nbsp;<b>&nbsp;&nbsp;Basico:</b>&nbsp;<? echo $con;?><b>&nbspTiempo:</b>&nbsp;<? echo $con1;?><b>&nbspAyuda:</b>&nbsp;<? echo $con2;?><b>&nbspSeg_Social:</b>&nbsp;<? echo $con3;?><b>&nbspCaja:</b>&nbsp;<? echo $con4;?><b>&nbspPresta:</b>&nbsp;<? echo $con5;?><b>&nbspAdmon:</b>&nbsp;<? echo $con6;?></td>
                              </tr>
                            </table>
                            </table>
                            <tr><td><br></td></tr>
                            <table border="0" align="center">
                              <tr class="cajas">
                                 <td><b>Total:</b>&nbsp;<? echo $total;?><b>&nbsp;&nbsp;Incapacidades:</b>&nbsp;<? echo $incapacidad;?><b>&nbspAnticipo:</b>&nbsp;<? echo $anticipo;?><b>&nbspOtros Dcto:</b>&nbsp;<? echo $otros;?><b>&nbsp;Ajuste:</b>&nbsp;<? echo $ajuste;?><b>&nbsp;Menor Vlr Fac.:</b>&nbsp;<? echo $menorvlr;?></td>
                              </tr>
                            </table>
                            <table border="0" align="center">
                              <tr>
                                <td><b>SubTotal:</b>&nbsp;<? echo round($tto,0);?></t>
                              </tr>
                              <tr>
                                <td><b>Iva:</b>&nbsp;<? echo $iva;?></t>
                              </tr>
                              <tr>
                                <td><b>Gran Total:</b>&nbsp;<? echo $grantotal;?></t>
                              </tr>
                            </table>
                            <?
                   else:
                      ?>
                         <script language="javascript">
                            alert("No hay información para este detalle ?")
                            history.back()
                         </script>
                         <?
                   endif;
  ?>
</body>
</html>
