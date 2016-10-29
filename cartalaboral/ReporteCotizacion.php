<?
include("../conexion.php");
$datos="select cotizacioncomercial.*,maestro.dirmaestro,maestro.telmaestro,departamento.departamento,municipio.municipio,maestro.web  FROM cotizacioncomercial,maestro,municipio,departamento WHERE
         maestro.codmaestro= cotizacioncomercial.codmaestro and
       cotizacioncomercial.idcotizacion='$NroC'";
$res=mysql_query($datos)or die("Error al buscar cotizaciones");
$filas=mysql_fetch_array($res);
$Dirigida=$filas["dirigida"];
$RazonSocial=$filas["razonsocial"];
$Cargo=$filas["cargo"];
$Radicado=$filas["idcotizacion"];
$Salario=$filas["salario"];
$Auxilio=$filas["auxilio"];
$Porcentaje=$filas["porcentajeadmon"];
$PorArl=$filas["porarl"];
$TipoCotizacion = $filas["tipocotizacion"];
$Cesantia=$filas["cesantia"];
$Cesantia=$filas["cesantia"];
$Interes=$filas["interes"];
$Prima=$filas["prima"];
$Vacacion=$filas["vacacion"];
$CajaC=$filas["caja"];
$Icbf=$filas["icbf"];
$Sena=$filas["sena"];
$Eps=$filas["eps"];
$Pension=$filas["pension"];
$Arl=$filas["arl"];
$TotalPrestacion=$filas["totalprestacion"];
$TotalParafiscal=$filas["totalparafiscal"];
$TotalSeguridad=$filas["totalseguridad"];
$TotalAdmon=$filas["totaladmon"];
$TotalCotizacion=($TotalPrestacion + $TotalParafiscal + $TotalSeguridad + $TotalAdmon + $Salario + $Auxilio);
$Nota=$filas["nota"];
$Salario=number_format($Salario,0);
$Auxilio=number_format($Auxilio,0);
$Cesantia=number_format($Cesantia,0);
$Interes=number_format($Interes,0);
$Prima=number_format($Prima,0);
$Vacacion=number_format($Vacacion,0);
$CajaC=number_format($CajaC,0);
$Icbf=number_format($Icbf,0);
$Sena=number_format($Sena,0);
$PorArl=number_format($PorArl,3);
$Eps=number_format($Eps,0);
$Pension=number_format($Pension,0);
$Arl=number_format($Arl,0);
$TotalPrestacion=number_format($TotalPrestacion,0);
$TotalParafiscal=number_format($TotalParafiscal,0);
$TotalSeguridad=number_format($TotalSeguridad,0);
$TotalAdmon=number_format($TotalAdmon,0);
$TotalCotizacion=number_format($TotalCotizacion,0);
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
require_once('class.ezpdf.php');
$pdf =& new Cezpdf('a4');
$pdf->selectFont('../fonts/courier.afm');
$pdf->ezSetCmMargins(1,1,1.5,1.5);
$pdf->ezStartPageNumbers(550,18,10,'','Pagina : {PAGENUM} de {TOTALPAGENUM}',1);
$pdf->ezText("\n\n\n", 2);
$pdf->ezImage("../image/LogoPagina.JPG", 10, 500, 'none', 'left');
$pdf->ezText('Medellin, Antioquia '.$FechaDia. ' de ' .$FechaMes. ' del año ' .$Anio,10,'.');
$pdf->ezText('Nro Cotización: '.$Radicado,10,array('justification'=>'right'));
$pdf->ezText("\n\n\n", 3);
$pdf->ezText('Estimado Dr(a): ',9);
$pdf->ezText("\n\n\n", 0.5);
$pdf->ezText($Dirigida,9);
$pdf->ezText("\n\n\n", 0.5);
$pdf->ezText($Cargo,9);
$pdf->ezText("\n\n\n", 0.5);
$pdf->ezText($RazonSocial,9);
$pdf->ezText("\n\n\n", 0.5);
$pdf->ezText('E.S.D. ',9);
$pdf->ezText("\n\n\n", 5);
$pdf->ezText('<b>PROPUESTA COMERCIAL POR EMPLEADO</b> ',15,array('justification'=>'center'));
$pdf->ezText("\n\n\n", 5);
$pdf->ezText('<b>Salario Base:                                             </b> $'.$Salario,12,array('justification'=>'left'));
$pdf->ezText('<b>Auxilio de Transporte:                               </b> $'.$Auxilio,12,array('justification'=>'left'));
$pdf->ezText('<b>Porcentaje:                                                       </b> '.$Porcentaje,12,array('justification'=>'left'));
$pdf->ezText('<b>Tipo Cotizacion:                                          </b> '.$TipoCotizacion,12,array('justification'=>'left'));
$pdf->ezText("\n\n\n", 3);
$pdf->ezText('<b>Provisiones Semestrales y Anuales</b> ',12,array('justification'=>'center'));
$pdf->ezText("\n\n\n", 3);
$pdf->ezText('<b>Cesantias (8.33%):                                   </b> $'.$Cesantia,12,array('justification'=>'left'));
$pdf->ezText('<b>Intereses (1%):                                              </b> $'.$Interes,12,array('justification'=>'left'));
$pdf->ezText('<b>Prima de Servicio (8.33%):                       </b> $'.$Prima,12,array('justification'=>'left'));
$pdf->ezText('<b>Vacaciones (4.5%):                                  </b> $'.$Vacacion,12,array('justification'=>'left'));
$pdf->ezText("\n\n\n", 3);
$pdf->ezText('<b>Parafiscales</b> ',12,array('justification'=>'center'));
$pdf->ezText("\n\n\n", 3);
$pdf->ezText('<b>Caja Compensación (4%):                       </b> $'.$CajaC,12,array('justification'=>'left'));
$pdf->ezText('<b>Icbf (3%):                                                  </b> $'.$Icbf,12,array('justification'=>'left'));
$pdf->ezText('<b>Sena (2%):                                               </b> $'.$Sena,12,array('justification'=>'left'));
$pdf->ezText("\n\n\n", 3);
$pdf->ezText('<b>Seguridad Social</b> ',12,array('justification'=>'center'));
$pdf->ezText("\n\n\n", 3);
$pdf->ezText('<b>Eps(4%):                                                  </b> $'.$Eps,12,array('justification'=>'left'));
$pdf->ezText('<b>Pensión (12%):                                        </b> $'.$Pension,12,array('justification'=>'left'));
$pdf->ezText('<b>Arl ('.$PorArl.'                                                  $' .$Arl);
$pdf->ezText("\n\n\n", 3);
$pdf->ezText('<b>Resumen de la Propuesta</b> ',14,array('justification'=>'center'));
$pdf->ezText("\n\n\n", 3);
$pdf->ezText('<b>Salario Base:                                                </b> $'.$Salario,12,array('justification'=>'left'));
$pdf->ezText('<b>Auxilio de Transporte:                                   </b> $'.$Auxilio,12,array('justification'=>'left'));
$pdf->ezText('<b>Prestaciones sociales:                                  </b> $'.$TotalPrestacion,12,array('justification'=>'left'));
$pdf->ezText('<b>Parafiscales:                                                 </b> $'.$TotalParafiscal,12,array('justification'=>'left'));
$pdf->ezText('<b>Seguridad Social</b>:                                          $'.$TotalSeguridad,12,array('justification'=>'left'));
$pdf->ezText('<b>Valor Administración</b>:                                    $'.$TotalAdmon,12,array('justification'=>'left'));
$pdf->ezText("\n\n\n", 2);
$pdf->ezText('<b>TOTAL COTIZACION</b>:                                     $'.$TotalCotizacion,14,array('justification'=>'left'));
$pdf->ezText("\n\n\n", 8);
$pdf->ezText('<b>Nota Importante:</b>',14);
$pdf->ezText("\n\n\n", 2);
$pdf->ezText($Nota,11,array('justification'=>'full','spacing' =>'1'));
$pdf->ezText("\n\n\n", 10);
$pdf->ezText('<b>Para nosotros es muy importante su opinión. </b> ',12);
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
