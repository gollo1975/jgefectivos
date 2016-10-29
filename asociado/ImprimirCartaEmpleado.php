<html>
<head>
    <title>Carta Laboral</title>
    <LINK HREF="../formato.css" REL="stylesheet"  type="text/css">
    <script language="javascript">
            function imprimir()
            {
                    window.print()
            }
    </script>
</head>
<body onload="imprimir()">  <!-- sirve para cargar la funcion de imprsion-->
<?
/*fin codigo*/

include ("../conexion.php");
$consulta="select maestro.codmaestro,maestro.nomaestro,maestro.dirmaestro,maestro.telmaestro,municipio.municipio,departamento.departamento,maestro.web,sucursal.sucursal,zona.zona,tipocontrato.concepto,contrato.cargo,contrato.salario,concat(nomemple, ' ' ,nomemple1, ' ' ,apemple, ' ' ,apemple1) as empleado,empleado.periodo,contrato.fechainic,contrato.contrato,acceso.nombre from maestro,sucursal,zona,empleado,contrato,tipocontrato,acceso,municipio,departamento
where  maestro.codmaestro=sucursal.codmaestro and
maestro.codmaestro=acceso.codmaestro and
maestro.codmuni=municipio.codmuni and
municipio.codepart=departamento.codepart and
sucursal.codsucursal=zona.codsucursal and
zona.codzona=empleado.codzona and
empleado.codemple=contrato.codemple and
contrato.fechater='0000-00-00' and
contrato.tipo=tipocontrato.tipo and
empleado.cedemple='$xcodigo'";
$resultado=mysql_query($consulta) or die("Error al buscar carta Laboral");
$registros=mysql_num_rows($resultado);
$filas=mysql_fetch_array($resultado);
$documento=number_format($xcodigo,0);
$abono=$filas["salario"];
$NitEmpresa=$filas["codmaestro"];
$Periodo=$filas["periodo"];
$FechaContratacion = $filas["fechainic"];
include("../numeros.php");
$salario=num2letras($abono);
$salario=strtoupper($salario);
$salariopago=number_format($abono,0);
/*CODIGO PARA VALIR LA NOMINA*/
$SumaVector = 0; $Aux = 0; $TotalIbc = 0; $Calculo = 0;
if($Periodo=='SEMANAL'){
   $SumaVector = 4;
}else{
     if($Periodo=='DECADAL'){
	$SumaVector = 3;
     }else{
	 if($Periodo=='CATORCENAL' or $Periodo =='QUINCENAL'){
         	$SumaVector = 2;
	 }else{
              $SumaVector = 1;
         }
     }
}

$Sql="select nomina.consecutivo,nomina.ibc_tiempo_suple as Total from nomina where nomina.cedemple='$xcodigo' ORDER BY nomina.consecutivo DESC limit $SumaVector";
$Sr=mysql_query($Sql)or die("Error al Colillas de Pago");
$Cont=mysql_num_rows($Sr);
$OtroTiempo = 0;
if($Cont != 0){
	while ($fila_N = mysql_fetch_array($Sr)){
		$CodigoNomina=$fila_N ["consecutivo"];
		$Aux= $fila_N["Total"];
		$Calculo = $Calculo + $Aux;
		$AuxTiempo = 0;
	       	$SqOther="select denomina.codsala,denomina.salario as OtroTotal from denomina where denomina.consecutivo='$CodigoNomina'";
		$SrOther=mysql_query($SqOther)or die("Error al buscar otro valor de nomina");
		while ($filaOther = mysql_fetch_array($SrOther)){
		       $CodSala =  $filaOther["codsala"];
			$Valor = $filaOther["OtroTotal"];
			/*ciclo para que busca el codsala*/
			for ($k=1 ; $k <= $TotalR; $k ++){
                              if($CodSala == $CodSalario[$k]){
				   $AuxTiempo = $AuxTiempo + $Valor;
			      }
			}
		}
	       $OtroTiempo += $AuxTiempo;
        }
        $TotalIbc= $Calculo;
	$OtroTiempo = $OtroTiempo;

}else{
	$TotalIbc = 0;
	$OtroTiempo = 0;
}
$TiempoLegal=num2letras($TotalIbc);
$LetraTiempoLegal=strtoupper($TiempoLegal);
$TiempoLegal=number_format($TiempoLegal,0);
$TotalOtroTiempo=num2letras($OtroTiempo);
$LetraOtroTiempo=strtoupper($TotalOtroTiempo);
$ValorOtroTiempo=number_format($OtroTiempo,0);
$FechaDia=date('d',strtotime($FechaContratacion));
$FechaMes=date("m", strtotime($FechaContratacion));
$Anio=date("Y", strtotime($FechaContratacion));
 if($FechaMes =='01' ){
            $FechaMes = 'Enero';
         }else{
              if($FechaMes =='02'){
                 $FechaMes = 'Febrero';
              }else{
                 if($FechaMes =='03'){
                    $FechaMes = 'Marzo';
                 }else{
                    if($FechaMes =='04'){
                        $FechaMes = 'Abril';
                    }else{
                         if($FechaMes =='05'){
                             $FechaMes = 'Mayo';
                         }else{
                              if($FechaMes =='06'){
                                 $FechaMes = 'Junio';
	                      }else{
	                           if($FechaMes =='07'){
	                                  $FechaMes = 'Julio';
	                           }else{
	                                if($FechaMes =='08'){
	           			      $FechaMes = 'Agosto';
	                                }else{
	                                     if($FechaMes =='09'){
	                                           $FechaMes = 'Septiembre';
	                                     }else{
	                                           if($FechaMes =='10'){
	                                                $FechaMes = 'Octubre';
	                                           }else{
	                                                if($FechaMes =='11'){
	                                                       $FechaMes = 'Noviembre';
	                                                }else{
	                                                       $FechaMes = 'Diciembre';
	                                                }
	                                           }
	                                     }
                                        }
	                           }
                              }
                         }
                    }
                 }
              }
           }
    /*ciclos de fechas*/
$FechaProceso = date('Y-m-d');
$DiaEntrega=date('d',strtotime($FechaProceso));
$MesEntrega=date("m", strtotime($FechaProceso));
$AnioEntrega=date("Y", strtotime($FechaProceso));
         if($MesEntrega =='01' ){
            $MesEntrega = 'Enero';
         }else{
              if($MesEntrega =='02'){
                 $MesEntrega = 'Febrero';
              }else{
                 if($MesEntrega =='03'){
                    $MesEntrega = 'Marzo';
                 }else{
                    if($MesEntrega =='04'){
                        $MesEntrega = 'Abril';
                    }else{
                         if($MesEntrega =='05'){
                             $MesEntrega = 'Mayo';
                         }else{
                              if($MesEntrega =='06'){
                                 $MesEntrega = 'Junio';
	                      }else{
	                           if($MesEntrega =='07'){
	                                  $MesEntrega = 'Julio';
	                           }else{
	                                if($MesEntrega =='08'){
	           			      $MesEntrega = 'Agosto';
	                                }else{
	                                     if($MesEntrega =='09'){
	                                           $MesEntrega = 'Septiembre';
	                                     }else{
	                                           if($MesEntrega =='10'){
	                                                $MesEntrega = 'Octubre';
	                                           }else{
	                                                if($MesEntrega =='11'){
	                                                       $MesEntrega = 'Noviembre';
	                                                }else{
	                                                       $MesEntrega = 'Diciembre';
	                                                }
	                                           }
	                                     }
                                        }
	                           }
                              }
                         }
                    }
                 }
              }
           }
?>

<table border="0" align="center" width="715">
<tr>
<td colspan="30" rowspan="8" class="cajas"><table width="100%" border="0" cellpadding="0" cellspacing="0">

<tr>
<td  rowspan="6" valign="top" style="border-top: 0px solid; border-left: 0px solid; border-bottom: 0px solid;border-right: 0px solid;"><img src="../image/logocompleto.jpg" border="-0" height="155" width="690"></td>
</tr>
<tr>


</tr>
<tr>


</tr>
<tr>

</tr>
<tr>


</tr>
<tr><td>&nbsp;</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td>&nbsp;</td></tr>
<tr>
<th rowspan="2" bgcolor="#c4c4c4" style="border-top: 0px solid; border-right: 0px solid; border-bottom: 0px solid;"><b>DEPARTAMENTO DE NOMINA</b></th>


</tr>
<tr>


</tr>

</table></td><td width="1" class="cajas">&nbsp;</td>
<table border="0" align="center" width="700">
<tr><td>
<tr><td colspan="16">---------------------------------------------------------------------------------------------------------------------------------- </td></tr>
<tr>
<td class="FormatoCaja"><b>Señor(a)</b></td>
</tr>
<tr>
<td class="FormatoCaja">A QUIEN PUEDA INTERESAR</td>
</tr>
<tr>
<td class="FormatoCaja"><b>La Ciudad</b></td>
</tr>
<tr><td>&nbsp;</td></tr>

<tr>
<td class="FormatoCaja"><b><div align="center">CERTIFICA QUE</div></b></td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr><td>&nbsp;</td></tr>
<tr class="FormatoCaja"><td><p align="justify"><b><?echo $filas["empleado"];?></b> identificado con cédula de ciudadanía Nro <b><?echo $documento;?></b>, labora en  la Empresa <b><?echo $filas["nomaestro"];?></b>, desde el <b><?echo $FechaDia;?></b> de <b><?echo $FechaMes;?></b> del año <b><?echo $Anio;?></b>, desempeñandose en el cargo de <b><?echo $filas["cargo"];?></b>, mediante un contrato de trabajo por norma Nro <b><?echo $filas["contrato"];?></b>, definido como <b><?echo $filas["concepto"];?></b> y devengando un salario básico mensual de <b><?echo $salario;?> PESOS ML ($<?echo $salariopago;?>)
</b>; màs un promedio mensual por norma de <b><?echo $LetraTiempoLegal;?> PESOS ML ($<?echo $TiempoLegal;?>)</b> y como pago adicional no prestacional un valor de <b><?echo $LetraOtroTiempo;?> PESOS ML ($<?echo $ValorOtroTiempo;?>)</b>. Los servicios son prestados para la empresa <b><?echo $filas["zona"];?>.</b> </b> </u></p></td></tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td class="FormatoCaja">La presente solicitud fue generada automaticamente por el Empleado <b><?echo $filas["empleado"];?></b> el <b><?echo $DiaEntrega;?></b> de <b><?echo $MesEntrega;?></b> del año <b><?echo $AnioEntrega;?>.</b></td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td class="FormatoCaja">Cordialmente,</td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td><img src="../image/firmaWalter.png" border="0" heigth="115" width="122"></td>
</tr>
<tr>
<td class="FormatoCaja"><b><?echo $filas["nombre"];?></b></td>
</tr>
<tr>
<td class="FormatoCaja"><b>Jefe de Nòmina y Facturaciòn</b></td>
</tr>
<tr>
<td class="cajas"><b>Firmada Digitalmente</b></td>
</tr>

<tr><td colspan="16">---------------------------------------------------------------------------------------------------------------------------------- </td></tr>
<tr>
<td class="FormatoCaja"><b>Casa matriz:&nbsp;</b><?echo $filas["nomaestro"];?></td>
</tr>
<tr>
<td class="FormatoCaja"><b>Dirección:</b>&nbsp;<?echo $filas["dirmaestro"];?></td>
</tr>
<tr>
<td class="FormatoCaja"><b>Pbx:</b>&nbsp;<?echo $filas["telmaestro"];?></td>
</tr>
<tr>
<td class="FormatoCaja"><b>Web:</b>&nbsp;<?echo $filas["web"];?></td>
</tr>
<tr>
<td class="FormatoCaja"><b>Departamento:</b>&nbsp;<?echo $filas["departamento"];?>&nbsp;&nbsp;<b>Municipio:</b>&nbsp;<?echo $filas["municipio"];?></td>
</tr>
</table></td> </tr>
</table>
</body>
</html>
