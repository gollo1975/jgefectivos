<?
 session_start();
?>
<html>
        <head>
                <title>Impresión de carta Laboral</title>
              <LINK  REL="stylesheet" HREF="../formato.css" type="text/css">
                <script language="javascript">
                        function imprimir()
                        {
                                window.print()
                        }
                </script>
        </head>
        <body onload="imprimir()">  <!-- sirve para cargar la funcion de impresion-->
               <?
    // if(session_is_registered("xsession")):
        include("../conexion.php");
        $variable="select carta.* from carta
                   where carta.codigo='$NroCarta'";
        $resultado=mysql_query($variable)or die("Error al bsucar cartas laborales");
        $fila_C=mysql_fetch_array($resultado);
        $TipoContrato = $fila_C["tipocontrato"];
        $TipoCarta = $fila_C["tipocarta"];
        $NroCarta = $fila_C["codigo"];
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
        $OtroTiempo =$fila_C["otrotiempo"];
        $LetraOtroTiempo =$fila_C["letraotrotiempo"];
        /*variables de numeros*/
         $Cedula=number_format($Cedula);
         $Salario=number_format($Salario);
         $OtroTiempo=number_format($OtroTiempo);
         $SalarioTiempo=number_format($SalarioTiempo);
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
        /*codigo que busca modelo*/
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
         ?>

               <table border="1" align="center" width="700">
               <tr><td>
               <table border="0" align="center" width="700">
                <img src="../image/logocompleto.png" border="0" width="695" height="180">
                   <tr>
                   <td class="FormatoCaja"><div align="right"><b>Nro_Carta:&nbsp;</b><?echo $NroCarta;?></div></td>
                   </tr>
                     <tr><td>&nbsp;</td></tr>
                    <tr>
                      <td colspan="100" class="FormatoCaja"><b><div align="center"><?echo $fila_C["asunto"];?></div></b></td>
                     </tr>
                      <tr><td>&nbsp;</td></tr>
                     <tr><td>&nbsp;</td></tr>
                     <tr>
                      <td colspan="100" class="FormatoCaja"><b><div align="center">CERTIFICA</div></b></td>
                     </tr>
                   <tr><td><br></td></tr>
                </table>
                <table border="0" align="center" width="700" height="605">
                <tr><td>&nbsp;</td></tr>
                   <tr>
                      <td><p align="justify" class="FormatoCaja"><?echo $Cadena;?></p></td>
                   </tr>
                   <tr><td>&nbsp;</td></tr>
                   <td><p align="justify" class="FormatoCaja">La presente solicitud se expida a los interesados a los <?echo $FechaDiaExpedicion;?> dias del mes de <?echo $FechaMesExpedicion;?> del año <? echo $AnioExpedicion;?>.</p></td>
                   <?if($TipoCarta=='GeneralConFirma'){?>
                       <tr>
                         <td><b><? echo "<img src=\"../image/firmaWalter.PNG\"/border=\"0\"/widht=\"75\"/height=\"100\"/>"?></b></td>
                      </tr>
                      <tr>
                      <td class="FormatoCaja"><?echo $fila_C["firma"];?></td>
                   </tr>
                    <tr>
                      <td class="FormatoCaja"><?echo $fila_C["cargo"];?></td>
                   </tr>
                    <tr>
                      <td class="cajasletras"><b>Firmada Digitalmente.</b></td>
                   </tr>
                   <?}else{?>
                        <tr><td>&nbsp;</td></tr>
                        <tr><td>&nbsp;</td></tr>
                        <tr><td>&nbsp;</td></tr>
                        <tr><td>&nbsp;</td></tr>
                        <tr>
                      <td class="FormatoCaja"><?echo $fila_C["firma"];?></td>
                   </tr>
                    <tr>
                      <td class="FormatoCaja"><?echo $fila_C["cargo"];?></td>
                   </tr>
                    <tr><td>&nbsp;</td></tr>
                   <?}?>

                    <tr><td>&nbsp;</td></tr>
                   <?
                    $Sql="select maestro.nomaestro,maestro.dirmaestro,maestro.telmaestro,maestro.web,municipio.municipio from maestro,municipio
                              where maestro.codmuni=municipio.codmuni ";
		    $Rs=mysql_query($Sql)or die("Error al busca la empresa");
		    $fila_E=mysql_fetch_array($Rs);
                   ?>
                   <tr>
                      <td class="FormatoCaja" colspan="30"><b><div align="center"><u>Información de la Empresa</u></div></b></td>
                   </tr>
                   <tr><td>&nbsp;</td></tr>
                   <tr>
                      <td class="FormatoCaja"><b>Empresa:&nbsp;</b><?echo $fila_E["nomaestro"];?></td>
                   </tr>
                   <tr>
                      <td class="FormatoCaja"><b>Dirección:&nbsp;</b><?echo $fila_E["dirmaestro"];?></td>
                   </tr>
                   <tr>
                      <td class="FormatoCaja"><b>Pbx:&nbsp;</b><?echo $fila_E["telmaestro"];?></td>
                   </tr>
                   <tr>
                      <td class="FormatoCaja"><b>Ciudad y Departamento:&nbsp;</b><?echo $fila_E["municipio"];?></td>
                   </tr>
                   <tr>
                      <td class="FormatoCaja"><b>Pagina Web:&nbsp;</b><?echo $fila_E["web"];?></td>
                   </tr>
                   <tr><td>&nbsp;</td></tr>
                </table>

             <?

 /*     else:
?>
 <script language="javascript">
    alert("Debe de hacer Inicio de Sección")
    pagina='../acceso/agregar.php'
    tiempo=10
    ubicacion='_self'
    setTimeout("open(pagina,ubicacion)",tiempo)
 </script>
<?
endif;  */
            ?>

                   </body>
</html>
