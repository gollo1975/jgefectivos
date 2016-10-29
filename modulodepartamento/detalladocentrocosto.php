<html>

<head>
  <title>Consulta del Servicio</title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
 </head>

<?
  if (!isset($desde)):
     include("../conexion.php");
  ?>
  <center><h4><u>Centro de Costo</u></h4></center>
<form action="" method="post" width="200">
    <table border="0" align="center">
    <tr><td><br></td></tr>
   <tr>
    <td><b>Desde:</b></td>
    <td colspan="3"><input type="text" name="desde" value="<? echo date("Y-m-d");?>" class="cajas" size="12" maxlength="10" id="desde"></td>
    <td><b>Hasta:</b></td>
    <td colspan="3"><input type="text" name="hasta" value="<? echo date("Y-m-d");?>" class="cajas" size="12" maxlength="10" id="hasta"></td>
  </tr>
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
    alert ("Digite la fecha de Inicio ?")
    history.back()
  </script>
    <?
else:
include ("../conexion.php");
      $consu="select zona.zona from zona
                where zona.codzona='$codzona'";
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
                 zona.codzona='$codzona' order by zonacosto.centro";
                 $resultado=mysql_query($consulta) or die("consulta incorrecta 3 ");
                 $registros=mysql_num_rows($resultado);
                  if($registros!=0):
                     ?>
                     <center><h4><u>Centro de Costos</u></h4></center>
                     <table border="0" align="center">
                       <tr class="cajas">
                         <td>Para exportar por centro de costos, Presione Click sobre el NRO_SERVICIO..</td>
                       </tr>
                     </table>
                       <table border="0" align="center" >
                         <tr class="cajas">
                            <th>Nro_Servicio</th>
                            <th>Fecha_Pro.</th>
                            <th>Salarios</th>
                            <th>T_Extra</th>
                            <th>T_Auxilios</th>
                            <th>Transporte</th>
                            <th>T_Arp</th>
                            <th>T_Eps</th>
                            <th>T_Pensión</th>
                            <th>T_Caja</td>
                            <th>T_Sena</td>
                            <th>T_Icbf</td>
                            <th>Cesa/Prima</th>
                            <th>Vacación</th>
							 <th>A_Parafiscal</th>
                            <th>T_Admon</th>
                            <th>T_Iva</th>
                            <th>Centro_Costo</th>
                            <?
                          while ($filas=mysql_fetch_array($resultado)):
                            ?>
                            <tr class="cajas">
							   <td><a href="../exportacion/detalladocosto.php?codigo=<? echo $filas["codigo"];?>&campo=<?echo $codzona;?>"><? echo $filas["codigo"];?></a></td>
                              <td>&nbsp;&nbsp;<? echo $filas["fechap"];?></td>
                              <td>&nbsp;&nbsp;<? echo $filas["basico"];?></td>
                              <td>&nbsp;&nbsp;<? echo $filas["tiempo"];?></td>
                              <td>&nbsp;&nbsp;<? echo $filas["tauxilio"];?></td>
                              <td>&nbsp;&nbsp;<? echo $filas["ayuda"];?></td>
                              <td>&nbsp;&nbsp;<? echo $filas["tarp"];?></td>
                              <td>&nbsp;&nbsp;<? echo $filas["teps"];?></td>
                              <td>&nbsp;&nbsp;<? echo $filas["tpension"];?></td>
                              <td>&nbsp;&nbsp;<? echo $filas["caja"];?></td>
                              <td>&nbsp;&nbsp;<? echo $filas["tsena"];?></td>
                              <td>&nbsp;&nbsp;<? echo $filas["ticbf"];?></td>
                              <td>&nbsp;&nbsp;<? echo $filas["prestacion"];?></td>
                               <td>&nbsp;&nbsp;<? echo $filas["tvacacion"];?></td>
							    <td>&nbsp;&nbsp;<? echo $filas["totalajusteparafiscal"];?></td>
                              <td>&nbsp;&nbsp;<? echo $filas["admon"];?></td>
                              <td>&nbsp;&nbsp;<? echo $filas["iva"];?></td>
                              <td>&nbsp;&nbsp;<? echo $filas["centro"];?></td>
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
							 $con14=$con14 + $filas["totalajusteparafiscal"];
                            $con12=$con12 + $filas["admon"];
                            $con13=$con13 + $filas["iva"];
                            $total =$con+$con1+$con2+$con3+$con4+$con5+$con6+$con7+$con8+$con9+$con10+$con11+$con12 + $con14;
                            $grantotal=$total+$con13;
                            endwhile;
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
                            $total=number_format($total,0);
                            $con12=number_format($con12,0);
                            $con13=number_format($con13,0);
							 $con14=number_format($con14,0);
                            $grantotal=number_format($grantotal,0);
                            ?>
                            </table>
                            <center><h4><u>Resumen del Detallado</u></h4></center>
                            <table border="0" align="center">
                              <tr class="cajas">
                                 <td><b>Item:</b>&nbsp;<? echo $suma;?>&nbsp;<b>&nbsp;Basico:</b>&nbsp;<? echo $con;?><b>&nbsp;T_Extra:</b>&nbsp;<? echo $con1;?><b>&nbsp;T_Auxilio:</b>&nbsp;<? echo $con2;?><b>&nbsp;Transporte:</b>&nbsp;<? echo $con3;?><b>&nbsp;T_Arp:</b>&nbsp;<? echo $con4;?><b>&nbsp;T_Eps:</b>&nbsp;<? echo $con5;?><b>&nbsp;T_Pensión:</b>&nbsp;<? echo $con6;?><b>&nbspCaja:</b>&nbsp;<? echo $con7;?><b>&nbspSena:</b>&nbsp;<? echo $con8;?><b>&nbspIcbf:</b>&nbsp;<? echo $con9;?><b>&nbsp;Cesa/Prima.:</b>&nbsp;<? echo $con10;?><b>&nbsp;Vacación:</b>&nbsp;<? echo $con11;?><b>&nbsp;A_Parafiscal:</b>&nbsp;<? echo $con14;?><b>&nbsp;Admon:</b>&nbsp;<? echo $con12;?><b>&nbsp;Iva:</b>&nbsp;<? echo $con13;?></td>
                              </tr>
                              <tr><td><br></td></tr>
                              <tr>
                                 <td><b><div align="center">Subtotal:&nbsp;$<? echo $total;?></div></b></td>
                              </tr>
                              <tr>
                                 <td><b><div align="center">Iva:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$<? echo $con13;?></div></b></td>
                              </tr>
                              <tr>
                                 <td><b><div align="center">Gran Total:&nbsp;&nbsp;$<? echo $grantotal;?></div></b></td>
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
  endif;
       ?>


</body>
</html>
