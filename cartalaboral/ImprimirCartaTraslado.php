<?
include("../conexion.php");
$datos="select maestrocartatraslado.*,maestro.dirmaestro,maestro.telmaestro,departamento.departamento,municipio.municipio,maestro.web  FROM maestrocartatraslado,maestro,municipio,departamento WHERE
        maestrocartatraslado.nrocartatraslado='$NroCartaTraslado'";
$res=mysql_query($datos)or die("Error al buscar cotizaciones");
$filas=mysql_fetch_array($res);
$Empleado=$filas["empleado"];
$RazonSocial=$filas["razonsocial"];
$EpsActual=$filas["epsactual"];
$Radicado=$filas["nrocartatraslado"];
$NuevaEps=$filas["epsnueva"];
$PensionActual = $filas["pensionactual"];
$NuevoFondo = $filas["pensionnueva"];
$TipoProceso=$filas["tipoproceso"];
$Departamento=$filas["departamento"];
$Municipio=$filas["municipio"];
$Direccion=$filas["dirmaestro"];
$Telefono=$filas["telmaestro"];
$PaginaWeb=$filas["web"];
$FechaDia=date('d');
$FechaMes=date('m');
$Anio=date('Y');
$uno='Enero';$dos='Febrero';$tres='Marzo';$cuatro='Abril';$cinco='Mayo';$seis='Junio';$siete='Julio';$ocho='Agosto';$nueve='Septiembre';$diez='Octubre';$once='noviembre';$doce='Diciembre';
if($FechaMes=='01'){
    $FechaMes=$uno;
}else{
     if($FechaMes=='02'){
        $FechaMes=$dos;
     }else{
         if($FechaMes=='03'){
             $FechaMes=$tres;
         }else{
             if($FechaMes=='04'){
                  $FechaMes=$cuatro;
             }else{
                  if($FechaMes=='05'){
                      $FechaMes=$cinco;
                  }else{
                       if($FechaMes=='06'){
                           $FechaMes=$seis;
                       }else{
                            if($FechaMes=='07'){
                               $FechaMes=$siete;
                            }else{
                                if($FechaMes=='08'){
                                    $FechaMes=$ocho;
                                }else{
                                    if($FechaMes=='09'){
                                        $FechaMes=$nueve;
                                    }else{
                                        if($FechaMes=='10'){
                                            $FechaMes=$diez;
                                        }else{
                                            if($FechaMes=='11'){
                                                $FechaMes=$once;
                                            }else{
                                                 $FechaMes=$doce;
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
/*fecha dia de aplicacion*/
$FechaAplicar=$filas["fechatraslado"];
$FechaDiaVencimiento=date('d',strtotime($FechaAplicar));
$FechaMesVencimiento=date("m", strtotime($FechaAplicar));
$AnioVencimiento=date("Y", strtotime($FechaAplicar));
/**/
if($FechaMesVencimiento =='01' ){
            $FechaMesVencimiento = 'Enero';
         }else{
              if($FechaMesVencimiento =='02'){
                 $FechaMesVencimiento = 'Febrero';
              }else{
                 if($FechaMesVencimiento =='03'){
                    $FechaMesVencimiento = 'Marzo';
                 }else{
                    if($FechaMesVencimiento =='04'){
                        $FechaMesVencimiento = 'Abril';
                    }else{
                         if($FechaMesVencimiento =='05'){
                             $FechaMesVencimiento = 'Mayo';
                         }else{
                              if($FechaMesVencimiento =='06'){
                                 $FechaMesVencimiento = 'Junio';
	                      }else{
	                           if($FechaMesVencimiento =='07'){
	                                  $FechaMesVencimiento = 'Julio';
	                           }else{
	                                if($FechaMesVencimiento =='08'){
	           			      $FechaMesVencimiento = 'Agosto';
	                                }else{
	                                     if($FechaMesVencimiento =='09'){
	                                           $FechaMesVencimiento = 'Septiembre';
	                                     }else{
	                                           if($FechaMesVencimiento =='10'){
	                                                $FechaMesVencimiento = 'Octubre';
	                                           }else{
	                                                if($FechaMesVencimiento =='11'){
	                                                       $FechaMesVencimiento = 'Noviembre';
	                                                }else{
	                                                       $FechaMesVencimiento = 'Diciembre';
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
/**/
require_once('class.ezpdf.php');
$pdf =& new Cezpdf('a4');
$pdf->selectFont('../fonts/courier.afm');
$pdf->ezSetCmMargins(1,1,1.5,1.5);
$pdf->ezStartPageNumbers(550,18,10,'','Pagina : {PAGENUM} de {TOTALPAGENUM}',1);
$pdf->ezText("\n\n\n", 2);
$pdf->ezImage("../image/LogoPagina.JPG", 10, 500, 'none', 'left');
$pdf->ezText('Medellin, Antioquia '.$FechaDia. ' de ' .$FechaMes. ' del año ' .$Anio,10,'.');
$pdf->ezText('Nro Carta: '.$Radicado,10,array('justification'=>'right'));
$pdf->ezText("\n\n\n", 3);
$pdf->ezText('Señor(a): ',9);
$pdf->ezText("\n\n\n", 0.5);
$pdf->ezText($Empleado,9);
$pdf->ezText("\n\n\n", 0.5);
$pdf->ezText('E.S.D. ',9);
$pdf->ezText("\n\n\n", 5);
$pdf->ezText('<b>ASUNTO:</b> Notificación de aviso de Traslado de Administradora.',9);
$pdf->ezText("\n\n\n", 0.5);
$pdf->ezText("\n\n\n", 5);
if($TipoProceso=='EPS'){
  $pdf->ezText('De acuerdo al proceso de afiliación que usted realizó en la Compañia como Empleado, usted se encuentra afiliado(a) a la Administradora de Salud '. $EpsActual. ', pero, por información sumistrada por el FOSYGA su aporte se debe de hacer a la nueva EPS de salud '.$NuevaEps. ' a partir del '. $FechaDiaVencimiento. ' de '.$FechaMesVencimiento. ' del año '.$AnioVencimiento.'.',12,array('justification'));
}else{
  $pdf->ezText('De acuerdo al proceso de afiliación que usted realizó en la Compañia como Empleado, usted se encuentra afiliado(a) a la Administradora de fondo de Pensiones '. $PensionActual. ', pero, por información sumistrada por el FOSYGA su aporte se debe de hacer a la nueva Administradora de Fondo  de Pensiones '.$NuevoFondo. ', a partir del '. $FechaDiaVencimiento. ' de '.$FechaMesVencimiento. ' del año '.$AnioVencimiento.'.',12,array('justification'));
}
$pdf->ezText("\n\n\n", 10);
$pdf->ezText('<b>Si necesita ampliar su información, favor comunicarse a la ciudad de Medellín  al (4) 4448120, Ext. 105. </b> ',12);
$pdf->ezText("\n\n\n", 10);
$pdf->ezText('<b>Atentamente. </b> ',12);
$pdf->ezText("\n\n\n", 8);
$pdf->selectFont('font/courier.afm');
$pdf->ezImage("../image/firma.png", 0, 120, 'none', 'left');
$pdf->ezText('JOSE GREGORIO PULGARIN MORALES',8);
$pdf->ezText('Gerente General',8);
$pdf->ezText(''.$NombreE,8);
$pdf->ezText("<b>Firmada digitalmente.</b>", 8,'right');
$pdf->ezText("\n\n\n", 13);
$pdf->ezText('<b>Casa Matriz:</b> '. $Direccion,10);
$pdf->ezText('<b>PBX:</b> (4) '. $Telefono,10);
$pdf->ezText('<b>Departamento</b>: '. $Departamento,10);
$pdf->ezText('<b>Ciudad:</b> '. $Municipio,10);
$pdf->ezText('<b>Pagina Web:</b> '. $PaginaWeb,10);
$pdf->ezStream();
?>
