<html>
<head>
  <title>Imprimir detalle de la factura</title>
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
      $consu="select sucursal.*,cobrozona.*,zona.iva 'ivaz',zona.prestacion,zona.vacacion,zona.caja,zona.sena,zona.icbf,zona.datos,zona.codzona from cobrozona,sucursal,zona
      where sucursal.codsucursal=zona.codsucursal and
           zona.codzona=cobrozona.codzona and
           cobrozona.codigo='$codigo'";
        $resulta=mysql_query($consu) or die("consulta incorrecta 1  ");
         while ($filas_s=mysql_fetch_array($resulta)):
           $total=$filas_s["total"];
           $totalIva=$filas_s["ivatotal"];
           $totalIvaA=number_format($totalIva,0);
           $incapacidad=$filas_s["incapacidad"];
           $anticipo=$filas_s["anticipo"];
           $otros=$filas_s["otros"];
           $ajuste=$filas_s["ajuste"];
           $menorvlr=$filas_s["menorvlr"];
           $subtotal=$filas_s["subtotal"];
           $grantotal=$filas_s["grantotal"];
           $valor=$filas_s["tipocta1"];
           $cuenta1=$filas_s["cuenta1"];
           $valor1=$filas_s["tipocta2"];
           $cuenta2=$filas_s["cuenta2"];
           $banco1=$filas_s["banco"];
           $banco2=$filas_s["banco1"];
           $ivag=$filas_s["ivaz"];
           $presta=$filas_s["prestacion"];
           $vacacion=$filas_s["vacacion"];
           $cajaC=$filas_s["caja"];
           $datos=$filas_s["datos"];
           $sena=$filas_s["sena"];
           $icbf=$filas_s["icbf"];
           $campo=$filas_s["codzona"];
           $ded=($incapacidad+$anticipo+$otros+$ajuste+$menorvlr);
           ?>
           <table border="0" align="center" >
              <tr>
               <td colspan="5"><div align="center"><b><? echo $filas_s["zona"];?></b></div></td>
              </tr>
              <tr><td><br></td></tr>
              <tr class="cajas">
                <td><b>Desde:&nbsp;&nbsp;</b><? echo $filas_s["desde"];?></td>
                <td colspan="2"><b>Hasta:&nbsp;&nbsp;</b><? echo $filas_s["hasta"];?></td>
              </tr>
              <tr class="cajas">
                <td><b>Nro_Servicio:&nbsp;&nbsp;</b><? echo $filas_s["codigo"];?></td>
                <td><b>&nbsp;Iva:&nbsp;&nbsp;</b><? echo $ivag;?>%</td>
              </tr>
              <tr class="cajas">
                <td><b>&nbsp;Cesa/Prima:&nbsp;&nbsp;</b><? echo $presta;?>%</td>
                <td><b>&nbsp;Caja:&nbsp;&nbsp;</b><? echo $cajaC;?>%</td>
              </tr>
              <tr class="cajas">
                <td><b>&nbsp;Sena:&nbsp;&nbsp;</b><? echo $sena;?>%</td>
                <td><b>&nbsp;Icbf:&nbsp;&nbsp;</b><? echo $icbf;?>%</td>
              </tr>
              <tr class="cajas">
              <td><b>&nbsp;Vacaci�n:&nbsp;&nbsp;</b><? echo $vacacion;?></td>
                <td><b>&nbsp;Admon:&nbsp;&nbsp;</b><? echo $datos;?></td>
              </tr>
            </table>
            <?
        endwhile;
        $consulta="select decobrozona.* from cobrozona,decobrozona
                 where cobrozona.codigo=decobrozona.codigo and
                      cobrozona.codigo='$codigo' order by decobrozona.empleado";
                 $resultado=mysql_query($consulta) or die("consulta incorrecta 3 ");
                 $registros=mysql_num_rows($resultado);
                  if($registros!=0):
                     ?>
                     <center><h5>Detallado del Servicio</h5></center>
                     <input type="hidden" name="ivag" value="<? echo $ivag;?>">
                        <table border="0" align="center"width="1080" >
                         <tr class="cajas">
                            <td><b>C�dula</b></td>
                            <td><b>&nbsp;Empleado</b></td>
                            <td><b>&nbsp;B�sico</b></td>
                            <td><b>&nbsp;T_Extra</td>
                            <td><b>&nbsp;T_Auxilio</td>
                            <td><b>&nbsp;Transporte</td>
                            <td><b>&nbsp;Arp</b></td>
                            <td><b>&nbsp;Eps</b></td>
                            <td><b>&nbsp;Pensi�n</b></td>
                            <td><b>&nbsp;Caja<b></td>
                            <td><b>&nbsp;Sena<b></td>
                            <td><b>&nbsp;Icbf<b></td>
                            <td><b>&nbsp;Cesa/Prima</b></td>
                              <td><b>&nbsp;Vacaci�n.</b></td>
                            <td><b>&nbsp;Admon</b></td>
                            <td><b>&nbsp;Iva</b></td>
                            <td><b>&nbsp;Nove.</b></td>
                            <td><b>&nbsp;%Arp</b></td>
                            <td><b>&nbsp;Cargo.</b></td>
                            <?
                          while ($filas=mysql_fetch_array($resultado)):
                            $aux=number_format($filas["basico"],0);
                            $aux1=number_format($filas["tiempo"],0);
                            $aux2=number_format($filas["tauxilio"],0);
                            $aux3=number_format($filas["ayuda"],0);
                            $aux4=number_format($filas["vlrarp"],0);
                            $aux5=number_format($filas["vlreps"],0);
                            $aux6=number_format($filas["vlrpension"],0);
                            $aux7=number_format($filas["cajac"],0);
                            $aux8=number_format($filas["vlrsena"],0);
                            $aux9=number_format($filas["vlricbf"],0);
                            $aux10=number_format($filas["ps"],0);
                            $aux11=number_format($filas["vacacion"],0);
                            $aux12=number_format($filas["admon"],0);
                            $aux13=number_format($filas["iva"],0);
                            ?>
                            <tr class="cajas">
                              <td><? echo $filas["cedemple"];?></td>
                              <td><? echo $filas["empleado"];?></td>
                              <td>&nbsp;<? echo $aux;?></td>
                              <td>&nbsp;<? echo $aux1;?></td>
                              <td>&nbsp;<? echo $aux2;?></td>
                              <td>&nbsp;<? echo $aux3;?></td>
                              <td>&nbsp;<? echo $aux4;?></td>
                              <td>&nbsp;<? echo $aux5;?></td>
                              <td>&nbsp;<? echo $aux6;?></td>
                              <td>&nbsp;<? echo $aux7;?></td>
                              <td>&nbsp;<? echo $aux8;?></td>
                              <td>&nbsp;<? echo $aux9;?></td>
                              <td>&nbsp;<? echo $aux10;?></td>
                              <td>&nbsp;<? echo $aux11;?></td>
                              <td>&nbsp;<? echo $aux12;?></td>
                              <td>&nbsp;<? echo $aux13;?></td>
                              <td>&nbsp;<? echo $filas["nove"];?></td>
                              <td>&nbsp;<? echo $filas["nivelriesgo"];?>%</td>
                               <td>&nbsp;<? echo $filas["cargo"];?></td>
                            </tr>
                            <?
                            $suma=$suma+1;
                            $con=$con + $filas["basico"];
                            $con1=$con1 + $filas["tiempo"];
                            $con2=$con2 + $filas["tauxilio"];
                            $con3=$con3 + $filas["ayuda"];
                            $con4=$con4 + $filas["vlrarp"];
                            $con5=$con5 + $filas["vlreps"];
                            $con6=$con6 + $filas["vlrpension"];
                            $con7=$con7 + $filas["cajac"];
                            $con8=$con8 + $filas["vlrsena"];
                            $con9=$con9 + $filas["vlricbf"];
                            $con10=$con10 + $filas["ps"];
                            $con11=$con11 + $filas["vacacion"];
                            $con12=$con12 + $filas["admon"];
                            $con13=$con13 + $filas["iva"];
                            $tto=($con+$con1+$con2+$con3+$con4+$con5+$con6+$con7+$con8+$con9+$con10+$con11+$con12)+($ded);
                            endwhile;
                            $ivatt=round($tto*$ivag)/100;
                             $sumatt=($tto+$totalIva);
                            $convertir= round(ivatt,0);
                            $ivatt=number_format($ivatt,0);
                            $tto=number_format($tto,0);
                            $sumatt=number_format($sumatt,0);
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
                            ?>
                      </table>
                            <table border="0" align="center"width="730">
                              <tr class="cajas">
                                 <td><b>Nro:</b>&nbsp;<? echo $suma;?>&nbsp;&nbsp;<b>&nbsp;&nbsp;Basico:</b>&nbsp;<? echo $con;?><b>&nbspT_Extras:</b>&nbsp;<? echo $con1;?><b>&nbspT_Auxilio:</b>&nbsp;<? echo $con2;?><b>&nbspAyuda:</b>&nbsp;<? echo $con3;?><b>&nbsp;Arp:</b>&nbsp;<? echo $con4;?><b>&nbsp;Eps:</b>&nbsp;<? echo $con5;?><b>&nbsp;Pensi�n:</b>&nbsp;<? echo $con6;?><b>&nbsp;Caja</b>&nbsp;<? echo $con7;?><b>&nbspSena:</b>&nbsp;<? echo $con8;?><b>&nbspIcbf:</b>&nbsp;<? echo $con9;?><b>&nbspPrest.:</b>&nbsp;<? echo $con10;?><b>&nbsp;Vacaci�n:</b>&nbsp;<? echo $con11;?><b>&nbsp;Admon:</b>&nbsp;<? echo $con12;?><b>&nbsp;Iva:</b>&nbsp;<? echo $con13;?></td>
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
                                <td><b>SubTotal:</b>&nbsp;<? echo $tto;?></t>
                              </tr>
                              <tr>
                                <td><b>Iva:</b>&nbsp;<? echo $totalIvaA;?></t>
                              </tr>
                              <tr>
                                <td><b>Gran Total:</b>&nbsp;<? echo $sumatt;?></t>
                              </tr>
                            </table>
                             <center><dt class="cajas">Cta de<b> <? echo $valor;?></b>&nbsp;Nro&nbsp;<b><? echo $cuenta1;?>&nbsp;</b>de</b><b>&nbsp;<? echo $banco1;?></b>&nbsp o&nbspCta <b><? echo $valor1;?></b>&nbsp;Nro&nbsp;<b><? echo $cuenta2;?>&nbsp;</b>de</b><b>&nbsp;<? echo $banco2;?></b></td></center>
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
