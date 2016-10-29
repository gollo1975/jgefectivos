<html>

<head>
  <title>Consulta del Servicio</title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
 </head>

<?
  if (!isset($desde)):
     include("../conexion.php");
  ?>
  <center><h4><u>Centro de costo</u></h4></center>
<form action="" method="post" width="200">
    <table border="0" align="center">
    <tr><td><br></td></tr>
   <tr>
    <td><b>Desde:</b></td>
    <td colspan="3"><input type="text" name="desde" value="<? echo date("Y-m-d");?>" size="12" class="cajas" maxlength="10"></td>
    <td><b>Hasta:</b></td>
    <td colspan="3"><input type="text" name="hasta" value="<? echo date("Y-m-d");?>" size="12" class="cajas" maxlength"10"></td>
  </tr>
  <tr>
     <tr><td><br></td></tr>
   <tr>
    <td colspan="5">
      <input type="submit" value="Buscar" class="boton">
      <input type="reset" value="Limpiar" class="boton">
    </td>
  </tr>
</table></td></tr>
</table>
</form>
<?
elseif (empty($desde)):
?>
  <script language="javascript">
    alert ("Digite la fecha de inicio de la busqueda ?")
    history.back()
  </script>
    <?
else:
include ("../conexion.php");
      $consu="select zona.zona from zona
                where zona.codzona='$codigo'";
                 $resulta=mysql_query($consu) or die("consulta incorrecta 1  ");
                 while ($filas_s=mysql_fetch_array($resulta)):
                      ?>
                     <table border="0" align="center">
                     <tr>
                       <td colspan="2"><? echo $filas_s["zona"];?></td>
                     </tr>
                     <tr class="cajas">
                       <td colspan="2"><b>Desde:&nbsp;&nbsp;</b><? echo $desde;?><b>&nbsp;&nbsp;&nbsp;Hasta:&nbsp;</b><? echo $hasta;?></td>
                     </tr>
                    </table>
                 <?
                endwhile;
                $consulta="select zonacosto.* from zonacosto,zona
                 where zona.codzona=zonacosto.codzona and
                 zonacosto.desde between '$desde' and '$hasta' and
                 zona.codzona='$codigo' order by zonacosto.centro";
                 $resultado=mysql_query($consulta) or die("consulta incorrecta 3 ");
                 $registros=mysql_num_rows($resultado);
                  if($registros!=0):
                     ?>
                     <center><h4>Centro de Costos</h4></center>
                     <table border="0" align="center">
                       <tr class="cajas">
                         <td>Para Ver el datallado del centro de costo, Presione Click sobre el NRO_SERVICIO..</td>
                       </tr>
                     </table>
                       <table border="0" align="center" >
                         <tr class="cajas">
                            <th>Nro_Servicio</th>
                            <th>Fecha_Pro.</th>
                            <th>Básico</th>
                            <th>T_Extra</th>
                            <th>T_Producción</th>
                            <th>A_Trans.</th>
                            <th>T_Arp</th>
                            <th>T_Eps</th>
                            <th>T_Pensión</th>
                            <th>Caja</td>
                            <th>Sena</td>
                            <th>Icbf</td>
                            <th>Cesa/Prima</th>
                            <th>Vacación</th>
							 <th>A_Parafiscal</th>
                            <th>Admon</th>
                            <th>Iva</th>
                            <th>Centro_Costo</th>
                            <?
                          while ($filas=mysql_fetch_array($resultado)):
                            $basico=number_format($filas["basico"],0);
                            $tiempo=number_format($filas["tiempo"],0);
                            $tauxilio=number_format($filas["tauxilio"],0);
                            $ayuda=number_format($filas["ayuda"],0);
                            $tarp=number_format($filas["tarp"],0);
                            $teps=number_format($filas["teps"],0);
                            $tpension=number_format($filas["tpension"],0);
                            $caja=number_format($filas["caja"],0);
                            $tsena=number_format($filas["tsena"],0);
                            $ticbf=number_format($filas["ticbf"],0);
                            $prestacion=number_format($filas["prestacion"],0);
                            $vacacion=number_format($filas["tvacacion"],0);
							$TotalAjuste=number_format($filas["totalajusteparafiscal"],0);
                            $admon=number_format($filas["admon"],0);
                            $iva=number_format($filas["iva"],0);

                            ?>
                            <tr class="cajas">
							  <td><a href="../facturar/detalladocostoconsulta.php?codigo=<? echo $filas["codigo"];?>"><? echo $filas["codigo"];?></a></td>
                              <td><? echo $filas["fechap"];?></td>
                              <td><? echo $basico;?></td>
                              <td><? echo $tiempo;?></td>
                              <td><? echo $tauxilio;?></td>
                              <td><? echo $ayuda;?></td>
                              <td><? echo $tarp;?></td>
                              <td><? echo $teps;?></td>
                              <td><? echo $tpension;?></td>
                              <td><? echo $caja;?></td>
                              <td><? echo $tsena;?></td>
                              <td><? echo $ticbf;?></td>
                              <td><? echo $prestacion;?></td>
                              <td><? echo $vacacion;?></td>
							  <td><? echo $TotalAjuste;?></td>
                              <td><? echo $admon;?></td>
                              <td><? echo $iva;?></td>
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
                            $con11=$con11 + $filas["tvacacion"];
                            $con12=$con12 + $filas["admon"];
                            $con13=$con13 + $filas["iva"];
						    $con14=$con14 + $filas["totalajusteparafiscal"];

                           $total =$con+$con1+$con2+$con3+$con4+$con5+$con6+$con7+$con8+$con9+$con10+$con11+$con12 + $con14;
                            $grantotal=$total+$con13;
                            endwhile;
                            $con=number_format($con,0);
                            $con1=number_format($con1,0);
                            $con2=number_format($con2,0);
                            $con3=number_format($con3,0);
                            $con4=number_format($con4,0);
                            $con5=number_format($con5,0);
                            $con6=number_format($con6,0);
                            $con7=number_format($con7,0);
                            $con8=number_format($con8,0);
                            $con9=number_format($con9,0);
                            $con10=number_format($con10,0);
                            $con11=number_format($con11,0);
                            $con12=number_format($con12,0);
                            $con13=number_format($con13,0);
							$con14=number_format($con14,0);
                            $total=number_format($total,0);
                            $grantotal=number_format($grantotal,0);
                            ?>
                            </table>
                            <center><h4><u>Totales del Costo</u></h4></center>
                            <table border="0" align="center">
                              <tr class="cajas">
                                 <td><b>Item:</b>&nbsp;<? echo $suma;?>&nbsp;<b>&nbsp;Basico:</b>&nbsp;<? echo $con;?><b>&nbsp;Tiempo:</b>&nbsp;<? echo $con1;?><b>&nbsp;T_Auxilio:</b>&nbsp;<? echo $con2;?><b>&nbsp;Ayuda:</b>&nbsp;<? echo $con3;?><b>&nbsp;Arp.:</b>&nbsp;<? echo $con4;?><b>&nbsp;Eps.:</b>&nbsp;<? echo $con5;?><b>&nbsp;Pensión.:</b>&nbsp;<? echo $con6;?><b>&nbsp;Caja:</b>&nbsp;<? echo $con7;?><b>&nbsp;Sena:</b>&nbsp;<? echo $con8;?><b>&nbsp;Icbf:</b>&nbsp;<? echo $con9;?><b>&nbsp;Cesa/Prima:</b>&nbsp;<? echo $con10;?><b>&nbsp;Vacación:</b>&nbsp;<? echo $con11;?><b>&nbsp;A_Parafiscal:</b>&nbsp;<? echo $con14;?><b>&nbsp;Admon:</b>&nbsp;<? echo $con12;?><b>&nbsp;Iva:</b>&nbsp;<? echo $con13;?></td>
                              </tr>
                            </table>
                            <tr><td><br></td></tr>
                            <h5><div align="center"><b>Subtotal:&nbsp;<?echo $total;?></b></div> </h5>
                            <h5><div align="center"><b>Iva:&nbsp;<?echo $con13;?></b></div> </h5>
                            <h5><div align="center"><b>Total Pagar:&nbsp;<?echo $grantotal;?></b></div> </h5>
                            <?
                   else:
                      ?>
                         <script language="javascript">
                            alert("No hay registros por centro de costos para esta zona ?")
                            history.back()
                         </script>
                         <?
                   endif;
  endif;
       ?>


</body>
</html>
