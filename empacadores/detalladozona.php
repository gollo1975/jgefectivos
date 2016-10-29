<html>

<head>
  <title>Detallado del Servicio</title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
 </head>
<?
include ("../conexion.php");
$consu="select  empacador.* from empacador
        where empacador.codigo='$codigo'";
        $resulta=mysql_query($consu) or die("consulta incorrecta 1  ");
         while ($filas_s=mysql_fetch_array($resulta)):
           $subtotal=$filas_s["subtotal"];
           $incapacidad=$filas_s["incapacidad"];
           $mayor=$filas_s["mayor"];
           $ajuste=$filas_s["ajuste"];
           $total=number_format($filas_s["total"],0);
           $iva=number_format($filas_s["iva"],0);
           $grantotal=number_format($filas_s["grantotal"],0);
           $basico=number_format($filas_s["basico"],0);
           $auxilio=number_format($filas_s["auxilio"],0);
            $admon=number_format($filas_s["admon"],0);
            ?>
            <table border="0" align="center">
              <tr>
               <td colspan="5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<? echo $filas_s["zona"];?></td>
               </tr>
               <tr>
               <td><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nro_Servicio:&nbsp;&nbsp;</b>&nbsp;&nbsp;&nbsp;&nbsp;<? echo $filas_s["codigo"];?></td>
              </tr>
              <tr><td><br></td></tr>
              <tr class="cajas">
                <td><b>Desde:&nbsp;&nbsp;</b><? echo $filas_s["desde"];?></td>
                <td colspan="2"><b>Hasta:&nbsp;&nbsp;</b><? echo $filas_s["hasta"];?></td>
              </tr>
              <tr class="cajas">
                <td><b>% Pensión:&nbsp;&nbsp;</b><? echo $filas_s["pension"];?></td>
                <td><b>% Eps:&nbsp;&nbsp;</b><? echo $filas_s["eps"];?></td>
              </tr>
               <tr class="cajas">
                <td><b>% Arp:&nbsp;&nbsp;</b><? echo $filas_s["arp"];?></td>
                <td><b>% Caja:&nbsp;&nbsp;</b><? echo $filas_s["caja"];?></td>
              </tr>
               <tr class="cajas">
                <td><b>% Admon:&nbsp;&nbsp;</b><? echo $admon;?></td>
                 <td><b>% Prestación:&nbsp;&nbsp;</b><? echo $filas_s["prestacion"];?></td>
              </tr>
              <tr class="cajas">
                <td><b>Ibc:&nbsp;&nbsp;</b><? echo $basico;?></td>
                 <td><b>Auxilio:&nbsp;&nbsp;</b><? echo $auxilio;?></td>
              </tr>
            </table>
            <?
          endwhile;
                $consulta="select dempacador.* from dempacador,empacador
                 where empacador.codigo=dempacador.codigo and
                 empacador.codigo='$codigo'";
                 $resultado=mysql_query($consulta) or die("consulta incorrecta 3 ");
                 $registros=mysql_num_rows($resultado);
                  if($registros!=0):
                     ?>
                     <center><h4>Detallado del Servicio</h4></center>
                        <table border="0" align="center" >
                         <tr class="cajas">
                            <th>Cédula</th>
                            <th>Empleado&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                            <th>Ibc</th>
                            <th>&nbsp;Dias</th>
                            <th>&nbsp;Pensión</th>
                            <th>&nbsp;Eps</th>
                            <th>&nbsp;Arp</th>
                            <th>&nbsp;Caja</td>
                            <th>&nbsp;Admon</th>
                            <th>Presta.</th>
                            <th>&nbsp;Nov.</th>
                            <?
                          while ($filas=mysql_fetch_array($resultado)):
                            ?>
                            <tr class="cajas">
                              <td>&nbsp;&nbsp;<a href="auxiliar.php?cedemple=<? echo $filas["cedemple"];?>"><? echo $filas["cedemple"];?></td>
                              <td>&nbsp;&nbsp;<? echo $filas["nombre"];?></td>
                              <td>&nbsp;&nbsp;<? echo $filas["ibc"];?></td>
                              <td>&nbsp;&nbsp;<? echo $filas["dias"];?></td>
                              <td>&nbsp;&nbsp;<? echo $filas["vlrpension"];?></td>
                              <td>&nbsp;&nbsp;<? echo $filas["vlreps"];?></td>
                              <td>&nbsp;&nbsp;<? echo $filas["vlrarp"];?></td>
                              <td>&nbsp;&nbsp;<? echo $filas["vlrcaja"];?></td>
                              <td>&nbsp;&nbsp;<? echo $filas["vlradmon"];?></td>
                              <td><? echo $filas["vlrpresta"];?></td>
                              <td>&nbsp;&nbsp;<? echo $filas["novedad"];?></td>
                            </tr>
                            <?
                            $suma=$suma+1;
                            $con=$con + $filas["ibc"];
                            $con1=$con1 + $filas["vlrpension"];
                            $con2=$con2 + $filas["vlreps"];
                            $con3=$con3 + $filas["vlrarp"];
                            $con4=$con4 + $filas["vlrcaja"];
                            $con5=$con5 + $filas["vlradmon"];
                            $con6=$con6 + $filas["vlrpresta"];
                             endwhile;
                            ?>
                            </table>
                            <table border="0" align="center">
                              <tr class="cajas">
                                 <td><b>Nro_Registros:&nbsp;<? echo $suma;?></b>&nbsp;&nbsp;&nbsp;<b>&nbsp;&nbsp;Total_Ibc:&nbsp;<? echo $con;?></b><b>&nbspVlr_Pensión:&nbsp;<? echo $con1;?></b><b>&nbspVlr_Eps:&nbsp;<? echo $con2;?></b><b>&nbspVlr_Arp:&nbsp;<? echo $con3;?></b><b>&nbspVlr_Caja.:&nbsp;<? echo $con4;?></b><b>&nbspTotal_Admon:&nbsp;<? echo $con5;?></b><b>&nbspVlr_Prestación:&nbsp;<? echo $con6;?></b></td>
                              </tr>
                            </table>
                            </table>
                            <tr><td><br></td></tr>
                            <table border="0" align="center">
                              <tr class="cajas">
                                 <td><b>SubTotal:&nbsp;<? echo $subtotal;?></b><b>&nbsp;&nbsp;Incapacidades:&nbsp;<? echo $incapacidad;?></b><b>&nbsp;Ajuste:&nbsp;<? echo $ajuste;?></b><b>&nbsp;Mayor Vlr Fac.:&nbsp;<? echo $mayor;?></b></td>
                              </tr>
                            </table>
                            <table border="0" align="center">
                              <tr>
                                <td><b>Total:</b>&nbsp;<? echo $total;?></t>
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
                            alert("No hay registros De Facturacion para esta Zona ?")
                            history.back()
                         </script>
                         <?
                   endif;
  ?>
</body>
</html>
