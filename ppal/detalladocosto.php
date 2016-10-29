<html>

<head>
  <title>Detallado del Servicio</title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
 </head>
<?
include ("../conexion.php");
$consu="select  zonacosto.* from zonacosto
        where zonacosto.codigo='$codser'";
        $resulta=mysql_query($consu) or die("consulta incorrecta 1  ");
         while ($filas_s=mysql_fetch_array($resulta)):
           $total=$filas_s["centro"];
           $incapacidad=$filas_s["zona"];
           $anticipo=$filas_s["codigo"];
            ?>
            <table border="0" align="center">
              <tr>
               <td colspan="5""><? echo $filas_s["zona"];?></td>
              </tr>
              <tr class="cajas">
                <td><b>Desde:&nbsp;&nbsp;</b><? echo $filas_s["desde"];?></td>
                <td colspan="2"><b>Hasta:&nbsp;&nbsp;</b><? echo $filas_s["hasta"];?></td>
              </tr>
              <tr>
                <td><b>Centro_Costo:&nbsp;&nbsp;</b><? echo $filas_s["centro"];?></td>
              </tr>
              <tr class="cajas">
                <td><b>Nro_Servicio:&nbsp;&nbsp;</b><? echo $filas_s["codigo"];?></td>
              </tr>
            </table>
            <?
          endwhile;
                $consulta="select dezonacosto.* from zonacosto,dezonacosto
                 where dezonacosto.codigo=zonacosto.codigo and
                 zonacosto.codigo='$codser'";
                 $resultado=mysql_query($consulta) or die("consulta incorrecta 3 ");
                 $registros=mysql_num_rows($resultado);
                  if($registros!=0):
                     ?>
                     <center><h4>Detallado del Servicio</h4></center>
                        <table border="0" align="center" width="1020" >
                        <tr class="cajas">
                            <th>Nro_Servicio</th>
                            <th>Fecha_Pro.</th>
                            <th>Básico</th>
                            <th>T_Extra</th>
                            <th>Auxilio</th>
                            <th>Ayuda</th>
                            <th>T_Arp</th>
                            <th>T_Eps</th>
                            <th>T_Pensión</th>
                            <th>Caja</td>
                            <th>Sena</td>
                            <th>Icbf</td>
                            <th>Presta.</th>
                            <th>Admon</th>
                            <th>Iva</th>
                            <th>Centro_Costo</th>
                            <?
                          while ($filas=mysql_fetch_array($resultado)):
                            ?>
                            <tr class="cajas">
                              <td><a href="detalladocostoconsulta.php?codigo=<? echo $filas["codigo"];?>"><? echo $filas["codigo"];?></a></td>
                              <td><? echo $filas["fechap"];?></td>
                              <td><? echo $filas["basico"];?></td>
                              <td><? echo $filas["tiempo"];?></td>
                              <td><? echo $filas["tauxilio"];?></td>
                              <td><? echo $filas["ayuda"];?></td>
                              <td><? echo $filas["tarp"];?></td>
                              <td><? echo $filas["teps"];?></td>
                              <td><? echo $filas["tpension"];?></td>
                              <td><? echo $filas["caja"];?></td>
                              <td><? echo $filas["tsena"];?></td>
                              <td><? echo $filas["ticbf"];?></td>
                              <td><? echo $filas["prestacion"];?></td>
                              <td><? echo $filas["admon"];?></td>
                              <td><? echo $filas["iva"];?></td>
                              <td><? echo $filas["centro"];?></td>
                            </tr>
                            <?
                           $suma=$suma+1;
                            $con=$con + $filas["basico"];
                            $con1=$con1 + $filas["tiempo"];
                            $con2=$con2 + $filas["tauxilio"];
                            $con3=$con3 + $filas["ayuda"];
                            $con4=$con4 + $filas["tarp"];
                            $con5=$con5 + $filas["teps"];
                            $con6=$con6 + $filas["tpension"];
                            $con7=$con7 + $filas["caja"];
                            $con8=$con8 + $filas["tsena"];
                            $con9=$con9 + $filas["ticbf"];
                            $con10=$con10 + $filas["prestacion"];
                            $con11=$con11 + $filas["admon"];
                            $con12=$con12 + $filas["iva"];

                           $total =$con+$con1+$con2+$con3+$con4+$con5+$con6+$con7+$con8+$con9+$con11+$con10;
                            $grantotal=$total+$con12;
                            endwhile;
                            ?>
                            </table>
                            <center><h4>Resumen del Detallado De Costo</h4></center>
                            <table border="0" align="center">
                              <tr class="cajas">
                                 <td><b>Item:</b>&nbsp;<? echo $suma;?>&nbsp;<b>&nbsp;Basico:</b>&nbsp;<? echo $con;?><b>&nbsp;Tiempo:</b>&nbsp;<? echo $con1;?><b>&nbsp;T_Auxilio:</b>&nbsp;<? echo $con2;?><b>&nbsp;Ayuda:</b>&nbsp;<? echo $con3;?><b>&nbsp;Arp.:</b>&nbsp;<? echo $con4;?><b>&nbsp;Eps.:</b>&nbsp;<? echo $con5;?><b>&nbsp;Pensión.:</b>&nbsp;<? echo $con6;?><b>&nbsp;Caja:</b>&nbsp;<? echo $con7;?><b>&nbsp;Sena:</b>&nbsp;<? echo $con8;?><b>&nbsp;Icbf:</b>&nbsp;<? echo $con9;?><b>&nbspPresta.:</b>&nbsp;<? echo $con10;?><b>&nbspAdmon:</b>&nbsp;<? echo $con11;?><b>&nbspIva:</b>&nbsp;<? echo $con12;?></td>
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
