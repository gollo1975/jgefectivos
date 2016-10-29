<?
include("../conexion.php");
$Sql="select carta.*from carta
       where carta.codigo='$Radicado'";
$Rs=mysql_query($Sql)or die("Error al buscar datos");
$fila_C=mysql_fetch_array($Rs);
//
$TipoContrato = $fila_C["tipocontrato"];
        $TipoCarta = $fila_C["tipocarta"];
        $NroCarta = $fila_C["codigo"];
        $FirmaCarta = $fila_C["firma"];
        $CargoFirma = $fila_C["cargo"];
        $NroContrato = $fila_C["nrocontrato"];
        $EstadoEmpleado = $fila_C["estadoempleado"];
        $TipoEmpleado = $fila_C["tipoempleado"];
        $Cedula =$fila_C["cedemple"];
        $Nombre =$fila_C["nombres"];
        $FechaP =$fila_C["fecha"];
        $Departamento =$fila_C["asunto"];
        $Zona =$fila_C["zonalaborada"];
        $Cargo =$fila_C["cargotrabajador"];
        $FechaContratacion =$fila_C["fechainiciocontrato"];
        $FechaFinal =$fila_C["fechafinalcontrato"];
        $Letra =$fila_C["letrasalario"];
        $Salario =$fila_C["salario"];
        $SalarioTiempo =$fila_C["salariotiempo"];
        $LetraTiempo =$fila_C["letratiempo"];
		$LetraOtroTiempo =$fila_C["letraotrotiempo"];
		$OtroTiempo =$fila_C["Otrotiempo"];
        /*variables de numeros*/
         $Cedula=number_format($Cedula);
         $Salario=number_format($Salario);
         $SalarioTiempo=number_format($SalarioTiempo);
		 $OtroTiempo=number_format($otrotiempo);
         $FechaDia=date('d',strtotime($FechaContratacion));
         $FechaMes=date("m", strtotime($FechaContratacion));
         $Anio=date("Y", strtotime($FechaContratacion));
         /*FECHA DE EXPEDICION*/
         $FechaDiaExpedicion=date('d',strtotime($FechaP));
         $FechaMesExpedicion=date("m", strtotime($FechaP));
         $AnioExpedicion=date("Y", strtotime($FechaP));
         /*fecha dia de vencimiento*/
         $FechaDiaVencimiento=date('d',strtotime($FechaFinal));
         $FechaMesVencimiento=date("m", strtotime($FechaFinal));
         $AnioVencimiento=date("Y", strtotime($FechaFinal));
         /*ciclos de fechas*/
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
         if($FechaMesExpedicion =='01' ){
            $FechaMesExpedicion = 'Enero';
         }else{
              if($FechaMesExpedicion =='02'){
                 $FechaMesExpedicion = 'Febrero';
              }else{
                 if($FechaMesExpedicion =='03'){
                    $FechaMesExpedicion = 'Marzo';
                 }else{
                    if($FechaMesExpedicion =='04'){
                        $FechaMesExpedicion = 'Abril';
                    }else{
                         if($FechaMesExpedicion =='05'){
                             $FechaMesExpedicion = 'Mayo';
                         }else{
                              if($FechaMesExpedicion =='06'){
                                 $FechaMesExpedicion = 'Junio';
	                      }else{
	                           if($FechaMesExpedicion =='07'){
	                                  $FechaMesExpedicion = 'Julio';
	                           }else{
	                                if($FechaMesExpedicion =='08'){
	           			      $FechaMesExpedicion = 'Agosto';
	                                }else{
	                                     if($FechaMesExpedicion =='09'){
	                                           $FechaMesExpedicion = 'Septiembre';
	                                     }else{
	                                           if($FechaMesExpedicion =='10'){
	                                                $FechaMesExpedicion = 'Octubre';
	                                           }else{
	                                                if($FechaMesExpedicion =='11'){
	                                                       $FechaMesExpedicion = 'Noviembre';
	                                                }else{
	                                                       $FechaMesExpedicion = 'Diciembre';
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
// CODIGO QUE BUSCA EL MODELO
include("../conexion.php");
   $Sql="select modelocartalaboral.* from modelocartalaboral where modelocartalaboral.estado='$EstadoEmpleado' and modelocartalaboral.tipoempleado='$TipoEmpleado'";
        $Rs=mysql_query($Sql)or die("Error al bsucar modelos");
        $fila_M=mysql_fetch_array($Rs);
        $Contenido= $fila_M["concepto"];
        $Cadena = str_replace("#1",$Nombre,$Contenido);
        $Cadena = str_replace("#2",$Cedula,$Cadena);
        $Cadena = str_replace("#3",$FechaDia,$Cadena);
        $Cadena = str_replace("#4",$FechaMes,$Cadena);
        $Cadena = str_replace("#5",$Anio,$Cadena);
        $Cadena = str_replace("#6",$Cargo,$Cadena);
        $Cadena = str_replace("#7",$TipoContrato,$Cadena);
        $Cadena = str_replace("#8",$Letra,$Cadena);
        $Cadena = str_replace("#9",$Salario,$Cadena);
        $Cadena = str_replace("#A",$FechaDiaExpedicion,$Cadena);
        $Cadena = str_replace("#B",$FechaMesExpedicion,$Cadena);
        $Cadena = str_replace("#C",$AnioExpedicion,$Cadena);
        $Cadena = str_replace("#D",$Zona,$Cadena);
        $Cadena = str_replace("#E",$Firma,$Cadena);
        $Cadena = str_replace("#F",$FechaDiaVencimiento,$Cadena);
        $Cadena = str_replace("#G",$FechaMesVencimiento,$Cadena);
        $Cadena = str_replace("#H",$AnioVencimiento,$Cadena);
        $Cadena = str_replace("#I",$SalarioTiempo,$Cadena);
        $Cadena = str_replace("#J",$LetraTiempo,$Cadena);
        $Cadena = str_replace("#K",$NroContrato,$Cadena);
		$Cadena = str_replace("#L",$OtroTiempo,$Cadena);
		$Cadena = str_replace("#M",$LetraOtroTiempo,$Cadena);
//FIN DEL CODIGO
//CODIGO QUE BUSCA LA EMPRESA
$SqlMaestro="select maestro.nomaestro,maestro.dirmaestro,maestro.telmaestro,maestro.web,municipio.municipio from maestro,municipio
      where maestro.codmuni=municipio.codmuni ";
$RsMaestro=mysql_query($SqlMaestro)or die("Error al busca la empresa");
$fila_E=mysql_fetch_array($RsMaestro);
$Direccion = $fila_E["dirmaestro"];
$Telefono =  $fila_E["telmaestro"];
$Empresa =  $fila_E["nomaestro"];
$Municipio = $fila_E["municipio"];
$Paginaweb = $fila_E["web"];
//FIN CODIGO
require_once('class.ezpdf.php');
$pdf =& new Cezpdf('a4');
$pdf->selectFont('../fonts/courier.afm');
$pdf->ezSetCmMargins(1,1,1.5,1.5);
$pdf->ezStartPageNumbers(550,18,10,'','Pagina : {PAGENUM} de {TOTALPAGENUM}',1);
$pdf->ezText("\n\n\n", 2);
$pdf->ezImage("../image/imagen.JPG",0,510, 'none', 'left');
//$pdf->ezText('Radicado Nro: '.$Radicado,10,'nome', 'right');
$pdf->ezText('Nro_Carta: '.$Radicado,12,array('justification'=>'right'));
$pdf->ezText("\n\n\n", 3);
$pdf->ezText($Departamento,14,array('justification'=>'center'));
$pdf->ezText("\n\n\n", 9);
$pdf->ezText('<b>CERTIFICA</b>',14,array('justification'=>'center'));
$pdf->ezText("\n\n\n", 9);
$pdf->ezText($Cadena,11,array('justification'=>'full','spacing' =>'1'));
$pdf->ezText("\n\n\n", 7);
//$pdf->ezTable($data, $titles, '', $options);
$pdf->ezText("\n\n\n", 5);
$pdf->ezText('<b>La presente solicitud se expida a los interesados a los ' .$FechaDiaExpedicion. ' dias del mes de ' .$FechaMesExpedicion. ' del año ' .$AnioExpedicion,11);
$pdf->ezText("\n\n\n", 8);
$pdf->selectFont('font/courier.afm');
$pdf->ezImage("../image/firmaWalter.png", 0, 120, 'none', 'left');
$pdf->ezText(''.$FirmaCarta,12);
$pdf->ezText(''.$CargoFirma,12);
$pdf->ezText("<b>Fecha Impresión:</b> ".date("d/m/Y"), 8,'right');
$pdf->ezText("<b>Firmada digitalmente.</b>", 8,'right');
$pdf->ezText("\n\n\n", 7);
$pdf->ezText('<b>Casa Matriz:</b> '. $Empresa,10);
$pdf->ezText('<b>Dirección:</b> '. $Direccion,10);
$pdf->ezText('<b>PBX:</b> (4) '. $Telefono,10);
$pdf->ezText('<b>Ciudad:</b> '. $Municipio,10);
$pdf->ezText('<b>Web:</b> '.$Paginaweb,10);
$pdf->ezStream();
?>
