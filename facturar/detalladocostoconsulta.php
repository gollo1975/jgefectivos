<html>

<head>
  <title>Detallado del Servicio</title>
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
include ("../conexion.php");
$consu="select  zonacosto.* from zonacosto
        where zonacosto.codigo='$codigo'";
        $resulta=mysql_query($consu) or die("consulta incorrecta 1  ");
         while ($filas_s=mysql_fetch_array($resulta)):
           $total=$filas_s["centro"];
           $incapacidad=$filas_s["zona"];
           $anticipo=$filas_s["codigo"];
            ?>
            <table border="0" align="center">
              <tr>
              <td colspan="40"><b><? echo $filas_s["zona"];?></b></td>
                            </tr>
              <tr class="cajas">
                <td colspan="1"><b>Desde:&nbsp;&nbsp;</b><? echo $filas_s["desde"];?></td>
                <td colspan="8" class="cajas"><b>Hasta:&nbsp;</b><? echo $filas_s["hasta"];?></td>
              </tr>
              <tr>
                <td colspan="20" class="cajas"><b>Centro_Costo:&nbsp;&nbsp;</b><? echo $filas_s["centro"];?></td>
              </tr>
              <tr class="cajas">
                <td><b>Nro_Servicio:&nbsp;&nbsp;</b><? echo $filas_s["codigo"];?></td>
              </tr>
            </table>
            <?
          endwhile;
                $consulta="select dezonacosto.*,zonacosto.iva as ivaT from zonacosto,dezonacosto
                 where dezonacosto.codigo=zonacosto.codigo and
                 zonacosto.codigo='$codigo' order by dezonacosto.empleado ASC";
                 $resultado=mysql_query($consulta) or die("consulta incorrecta 3 ");
                 $registros=mysql_num_rows($resultado);
                  if($registros!=0):
                     ?>
                     <center><h4>Detallado del Servicio</h4></center>
                        <table border="0" align="center" width="1180">
                         <tr class="cajas">
                            <td><div align="center"><b><u>Documento</u></b></div></td>
                            <td><div align="center"><b><u>Empleado</u></b></div></td>
                            <td><div align="center"><b><u>Básico</u></b></div></td>
                            <td><div align="center"><b><u>T_Extra</u></b></div></td>
                            <td><div align="center"><b><u>T_Auxilio</u></b></div></td>
                            <td><div align="center"><b><u>Ayuda</u></b></div></td>
                            <td><div align="center"><b><u>Arp</u></b></div></td>
                            <td><div align="center"><b><u>Eps</u></b></div></td>
                            <td><div align="center"><b><u>Pensión</u></b></div></td>
                            <td><div align="center"><b><u>Caja</u></b></div></td>
                            <td><div align="center"><b><u>Sena</u></b></div></td>
                            <td><div align="center"><b><u>Icbf</u></b></div></td>
                            <td><div align="center"><b><u>Cesa/Prima</u></b></div></td>
                            <td><div align="center"><b><u>Vacación</u></b></div></td>
							  <td><div align="center"><b><u>A_Parafiscal</u></b></div></td>
                            <td><div align="center"><b><u>Admon</u></b></div></td>
                            <td><div align="center"><b><u>iva</u></b></div></td>
                            <td><div align="center"><b><u>N_Ingreso.</u></b></div></td>
							<td><div align="center"><b><u>N_Retiro.</u></b></div></td>
							<td><div align="center"><b><u>H_EG.</u></b></div></td>
							<td><div align="center"><b><u>H_AT.</u></b></div></td>
                            <td><div align="center"><b><u>%Arp</u></b></div></td>
                            <td><div align="center"><b><u>%Eps</u></b></div></td>
                            <td><div align="center"><b><u>%Pen.</u></b></div></td>
                            <td><div align="left"><b><u>cargo</u></b></div></td>
                            <?
                          while ($filas=mysql_fetch_array($resultado)):
                           $ivaT=$filas["ivaT"];
                            ?>
                            <tr class="cajas">
                              <td><? echo $filas["cedemple"];?></td>
                              <td><? echo $filas["empleado"];?></td>
                              <td><? echo $filas["basico"];?></td>
                              <td><? echo $filas["tiempo"];?></td>
                              <td><? echo $filas["tauxilio"];?></td>
                              <td><? echo $filas["ayuda"];?></td>
                              <td><? echo $filas["ss"];?></td>
                              <td><? echo $filas["vlreps"];?></td>
                              <td><? echo $filas["vlrpension"];?></td>
                              <td><? echo $filas["cp"];?></td>
                              <td><? echo $filas["vlrsena"];?></td>
                              <td><? echo $filas["vlricbf"];?></td>
                              <td><? echo $filas["ps"];?></td>
                              <td><? echo $filas["vacacion"];?></td>
							  <td><? echo $filas["ajusteparafiscal"];?></td>
                              <td><? echo $filas["admon"];?></td>
                              <td><? echo $filas["iva"];?></td>
                              <td><? echo $filas["novedadingreso"];?></td>
							  <td><? echo $filas["novedadretiro"];?></td>
							  <td><? echo $filas["diasincapacidadgeneral"];?></td>
							  <td><? echo $filas["diasincapacidadlaboral"];?></td>
                              <td><? echo $filas["nivelr"];?>%</td>
                              <td><? echo $filas["peps"];?>%</td>
                              <td><? echo $filas["ppension"];?>%</td>
                              <td><? echo $filas["cargo"];?></td>
                            </tr>
                            <?
                            $suma=$suma+1;
                            $con=$con + $filas["basico"];
                            $con1=$con1 + $filas["tiempo"];
                            $con2=$con2 + $filas["tauxilio"];
                            $con3=$con3 + $filas["ayuda"];
                            $con4=$con4 + $filas["ss"];
                            $con5=$con5 + $filas["vlreps"];
                            $con6=$con6 + $filas["vlrpension"];
                            $con7=$con7 + $filas["cp"];
                            $con8=$con8 + $filas["vlrsena"];
                            $con9=$con9 + $filas["vlricbf"];
                            $con10=$con10 + $filas["ps"];
                            $con11=$con11 + $filas["vacacion"];
							$con14=$con14 + $filas["ajusteparafiscal"];
                            $con12=$con12 + $filas["admon"];
                            $con13=$con13 + $filas["iva"];
                            $total =$con+$con1+$con2+$con3+$con4+$con5+$con6+$con7+$con8+$con9+$con10+$con11+$con12 + $con14;
                             endwhile;
                             $grantotal=$total+$ivaT;
                             $ivaT=number_format($ivaT,0);
                             $total=number_format($total,0);
                             $con9=number_format($con9,0);
                             $con=number_format($con,0);  
                             $con1=number_format($con1,0);
                             $con2=number_format($con2,0);
                             $con3=number_format($con3,0);
                             $con4=number_format($con4,0);
                             $con5=number_format($con5,0);
                             $con6=number_format($con6,0);
                             $con7=number_format($con7,0);
                             $con8=number_format($con8,0);
                             $con10=number_format($con10,0);
                             $con11=number_format($con11,0);
                             $con12=number_format($con12,0);
                             $con13=number_format($con13,0);
							 $con14=number_format($con14,0);
                             $grantotal=number_format($grantotal,0);
                            ?>
                            </table>
                            <tr><td><br></td></tr>
                            <table border="0" align="center">
                              <tr class="cajas">
                                 <td><b>Item:&nbsp;<? echo $suma;?></b>&nbsp;&nbsp;<b>Basico:&nbsp;<? echo $con;?></b><b>&nbsp;T_Extra:&nbsp;<? echo $con1;?><b>&nbsp;T_Auxilio:&nbsp;<? echo $con2;?></b><b>&nbspAyuda:&nbsp;<? echo $con3;?></b><b>&nbspArp:&nbsp;<? echo $con4;?></b><b>&nbspEps:&nbsp;<? echo $con5;?><b>&nbspPensión:&nbsp;<? echo $con6;?></b></b><b>&nbsp;Caja:&nbsp;<? echo $con7;?></b><b>&nbsp;Sena:&nbsp;<? echo $con8;?></b><b>&nbsp;Icbf:&nbsp;<? echo $con9;?></b><b>&nbsp;Presta.:&nbsp;<? echo $con10;?></b><b>&nbsp;Vacación:&nbsp;<? echo $con11;?></b><b>&nbsp;A_Parafiscal:&nbsp;<? echo $con14;?></b><b>&nbsp;Admon:&nbsp;<? echo $con12;?></b><b>&nbspIva:&nbsp;<? echo $con13;?></b></td>
                              </tr>
                            </table>
                            </table>
                            <table border="0" align="center">
                              <tr>
                                <td><b>SubTotal:</b>&nbsp;$<? echo $total;?></t>
                              </tr>
                              <tr>
                                <td><b>Iva</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;$<? echo $ivaT;?></t>
                              </tr>
                              <tr>
                                <td><b>Gran Total:</b>&nbsp;$<? echo $grantotal;?></t>
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
