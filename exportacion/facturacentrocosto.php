<html>

<head>
  <title>Consulta del Servicio</title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
 </head>

<?
  if (!isset($campo)):
     include("../conexion.php");
  ?>
  <center><h4><u>Centro de Costo</u></h4></center>
<form action="" method="post" width="200">
    <table border="0" align="center">
    <tr><td><br></td></tr>
   <tr>
    <td><b>Desde:</b></td>
    <td colspan="3"><input type="text" name="desde" value="<? echo date("Y-m-d");?>" size="10" maxlegth="10"></td>
    <td><b>Hasta:</b></td>
    <td colspan="3"><input type="text" name="hasta" value="<? echo date("Y-m-d");?>" size="10" maxlegth="10"></td>
  </tr>
  <tr>
  <tr>
         <td><b>Zona:</b></td>
                              <td colspan="12"><select name="campo" class="cajas">
                              <option value="0">Seleccione la zona
                                <?
                                 $consulta_z="select * from zona where zona.nomina='SI' order by zona";
                                 $resultado_z=mysql_query($consulta_z)or die ("consulta incorrecta");
                                while($filas_z=mysql_fetch_array($resultado_z)):
                                   ?>
                                   <option value="<?echo $filas_z["codzona"];?>"> <?echo $filas_z["zona"];?>
                                  <?
                                  endwhile;
                                  ?>
                                  </select></td>
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
elseif (empty($campo)):
?>
  <script language="javascript">
    alert ("Despliegue la vista para eligir la zona ?")
    history.back()
  </script>
    <?
else:
include ("../conexion.php");
      $consu="select zona.zona from zona
                where zona.codzona='$campo'";
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
                 zona.codzona='$campo' order by zonacosto.centro";
                 $resultado=mysql_query($consulta) or die("consulta incorrecta 3 ");
                 $registros=mysql_num_rows($resultado);
                  if($registros!=0):
                     ?>
                     <center><h4>Centro de Costos</h4></center>
                     <table border="0" align="center">
                       <tr class="cajas">
                         <td>Para exportar por centro de costos, Presione Click sobre el NRO_SERVICIO..</td>
                       </tr>
                     </table>
                       <table border="0" align="center" >
                         <tr class="cajas">
                            <th>Nro_Servicio</th>
                            <th>Fecha_Pro.</th>
                            <th>B�sico</th>
                            <th>T_Extra</th>
                            <th>T_Auxilio</th>
                            <th>Transporte</th>
                            <th>T_Arp</th>
                            <th>T_Eps</th>
                            <th>T_Pensi�n</th>
                            <th>T_Caja</td>
                            <th>T_Sena</td>
                            <th>T_Icbf</td>
                            <th>Cesa/Prima</th>
                             <th>Vacaci�n</th>
							  <th>A_Parafiscal</th>
                            <th>T_Admon</th>
                            <th>T_Iva</th>
                            <th>Centro_Costo</th>
                            <?
                          while ($filas=mysql_fetch_array($resultado)):
                            ?>
                            <tr class="cajas">
                              <td><a href="detalladocosto.php?codigo=<? echo $filas["codigo"];?>&campo=<?echo $campo;?>"><? echo $filas["codigo"];?></a></td>
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
                              <td><? echo $filas["tvacacion"];?></td>
							   <td><? echo $filas["totalajusteparafiscal"];?></td>
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
                            $con11=$con11 + $filas["tvacacion"];
                            $con12=$con12 + $filas["admon"];
                            $con13=$con13 + $filas["iva"];
							 $con14=$con14 + $filas["totalajusteparafiscal"];
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
                                 <td><b>Item:</b>&nbsp;<? echo $suma;?>&nbsp;<b>&nbsp;Basico:</b>&nbsp;<? echo $con;?><b>&nbsp;T_Extra:</b>&nbsp;<? echo $con1;?><b>&nbsp;T_Auxilio:</b>&nbsp;<? echo $con2;?><b>&nbsp;Transporte:</b>&nbsp;<? echo $con3;?><b>&nbsp;T_Arp:</b>&nbsp;<? echo $con4;?><b>&nbsp;T_Eps:</b>&nbsp;<? echo $con5;?><b>&nbsp;T_Pensi�n:</b>&nbsp;<? echo $con6;?><b>&nbspCaja:</b>&nbsp;<? echo $con7;?><b>&nbspSena:</b>&nbsp;<? echo $con8;?><b>&nbspIcbf:</b>&nbsp;<? echo $con9;?><b>&nbsp;Presta.:</b>&nbsp;<? echo $con10;?><b>&nbsp;Vacacion.:</b>&nbsp;<? echo $con11;?><b>&nbsp;A_Parafiscal:</b>&nbsp;<? echo $con14;?><b>&nbsp;Admon:</b>&nbsp;<? echo $con12;?><b>&nbsp;Iva:</b>&nbsp;<? echo $con13;?></td>
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