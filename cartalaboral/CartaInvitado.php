<?
include("../conexion.php");
$datos="select inscripcion.*,maestro.nomaestro,maestro.dirmaestro,maestro.telmaestro,municipio.municipio,departamento.departamento  FROM inscripcion,maestro,departamento,municipio WHERE
       maestro.codmaestro=inscripcion.codmaestro and
       maestro.codmuni=municipio.codmuni and
       municipio.codepart=departamento.codepart and
      inscripcion.documento='$Documento'";
$res=mysql_query($datos)or die("Error al buscar invitados");
$filas=mysql_fetch_array($res);
$Invitado=$filas["nombres"];
$Empresa=$filas["empresa"];
$Cargo=$filas["cargo"];
$Email=$filas["email"];
$Lugar=$filas["lugar"];
$Direccion=$filas["dirmaestro"];
$Telefono=$filas["telmaestro"];
$Departamento=$filas["departamento"];
$Municipio=$filas["municipio"];
$NombreE=$filas["nomaestro"];
$NombreE=$filas["nomaestro"];
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
$Nota='Tenemos el gusto de envitarle al <b>GRAN LANZAMIENTO DE SOGA</b>, que tendrá lugar el dia 12 de Febrero de 2016 de 3:00 pm a 8:00 pm, dicho evento se realizará en la '.$Lugar.'.';
require_once('class.ezpdf.php');
$pdf =& new Cezpdf('a4');
$pdf->selectFont('../fonts/courier.afm');
$pdf->ezSetCmMargins(1,1,1.5,1.5);
$pdf->ezStartPageNumbers(550,18,10,'','Pagina : {PAGENUM} de {TOTALPAGENUM}',1);
$pdf->ezText("\n\n\n", 2);
$pdf->ezImage("../image/LogoSogaCompleto.JPG", 0, 150, 'none', 'left');
$pdf->ezText('Medellin, Antioquia '.$FechaDia. ' de ' .$FechaMes. ' del año ' .$Anio,10,'.');
$pdf->ezText("\n\n\n", 3);
$pdf->ezText('Estimado Dr(a): ',10);
$pdf->ezText("\n\n\n", 0.5);
$pdf->ezText($Invitado,10);
$pdf->ezText("\n\n\n", 0.5);
$pdf->ezText($Cargo,10);
$pdf->ezText("\n\n\n", 0.5);
$pdf->ezText($Empresa,10);
$pdf->ezText("\n\n\n", 6);
$pdf->ezText('ASUNTO: <b>INVITACION AL GRAN LANZAMIENTO DE SOGA</b>,',10);
$pdf->ezText("\n\n\n", 7);
$pdf->ezText('Cordial saludo,',10);
$pdf->ezText("\n\n\n", 7);
$pdf->ezText($Nota,11,array('justification'=>'full','spacing' =>'1'));
$pdf->ezText("\n\n\n", 10);
$pdf->ezText('<b>Contamos con su valiosa presencia. </b> ',12);
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
$pdf->ezText('<b>www.jgefectivo.com</b> ',10);
$pdf->ezStream();
?>
