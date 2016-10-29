<html>

<head>
  <title></title>
</head>
<body>
<?

if (empty($nroinca)):

?>

  <script language="javascript">
    alert("Digite el Nro de la incapacidad")
    history.back()
  </script>
<?
 elseif (empty($fechaini)):
?>
  <script language="javascript">
    alert("Digite la fecha de inicio ?")
    history.back()
  </script>
<?
   elseif (empty($fechater)):
?>
     <script language="javascript">
       alert("Digite la fecha final")
       history.back()
     </script>
<?
elseif (empty($motivo)):
?>
      <script language="javascript">
       alert("Digite el motivo de la incapacidad ")
       history.back()
      </script>
      <?
        else:
           include("../conexion.php");
		   $FechaFinalIncapacidad = $fechater;
	    $Dias = strtotime($fechater)- strtotime($fechaini);
       $Diferencia_dias=intval($Dias/60/60/24) +1 ;  
        $estado=strtoupper($estado);
         $motivo=strtoupper($motivo);
         /*inicio busqueda de contrato*/
          $SlqE="select contrato.fechainic from contrato,empleado
                  WHERE empleado.codemple=contrato.codemple and
                       empleado.cedemple='$Documento' and
                       contrato.fechater='0000-000-00'";
        $RsE=mysql_query($SlqE) or die ("Error al validar la busqueda del contrato");
        $FilaE=mysql_fetch_array($RsE);
        $$FechaIncial = $FilaE["fechainic"];
        /*fin codigo de empleado*/
         /*INICIO DE CODIGO QUE MUESTRA LAS INCAPACIDADES*/
         $Slq="select tipoinca.concepto from tipoinca
                  WHERE tipoinca.tipoinca='$tipo'";
        $Rs=mysql_query($Slq) or die ("Error al validar tipo incapacidad");
        $FilaS=mysql_fetch_array($Rs);
        $Concepto = $FilaS["concepto"];
       /*FINCODIGO*/
       /*CODIFGO QUE VALIDA EL VALOR DE INCAPACIDAD*/
        $AuxiliarDia = 0; $AuxiliarDiaMenor = 0; $TotalDiaReconocido = 0; $TotalDiaAsumidoUsuaria = 0; $TotalDiaAsumidoTemporal = 0; $ValorPagoAsumido = 0; $ValorPagoTemporal = 0; $ValorPagoUsuaria = 0;
        $SlqSalario="select parametroauxilio.maximo,parametroauxilio.minimo,parametroauxilio.porcentajepago,parametroauxilio.dialeyeps,parametroauxilio.dialeylicencia,parametroauxilio.dialeyarl from parametroauxilio
                  WHERE parametroauxilio.estado='ACTIVO'";
        $RsSalario=mysql_query($SlqSalario) or die ("Error al validar el maximo salario para la incapacidad");
        $FilaSalario=mysql_fetch_array($RsSalario);
        $Maximo = $FilaSalario["maximo"];
        $Minimo = $FilaSalario["minimo"];
        $DiaPagoEps = $FilaSalario["dialeyeps"];
        $DiaPagoLicencia = $FilaSalario["dialeylicencia"];
        $DiaPagoArl = $FilaSalario["dialeyarl"];
        $ValorPorcentaje = $FilaSalario["porcentajepago"];
        if($tipo=='1020'|| $tipo=='1030'){
               if ($Salario > $Maximo){
                    if($Diferencia_dias > $DiaPagoEps){
                        $TotalDiaReconocido = $Diferencia_dias - $DiaPagoEps;
                        $AuxiliarDia = round($Salario/30);
                        $ValorPagoTemporal = round((($AuxiliarDia * $ValorPorcentaje)/100)*$TotalDiaReconocido);
                        $ValorPagoUsuaria = round((($AuxiliarDia * $ValorPorcentaje)/100)*$DiaPagoEps);
                        $TotalDiaAsumidoTemporal = $TotalDiaReconocido;
                        $TotalDiaAsumidoUsuaria = $DiaPagoEps;
                     }else{
                          $AuxiliarDia = round($Salario/30);
                          $ValorPagoTemporal = 0;
                          $ValorPagoUsuaria = round((($AuxiliarDia * $ValorPorcentaje)/100)*$Diferencia_dias);
                          $TotalDiaAsumidoTemporal = 0;
                          $TotalDiaAsumidoUsuaria = $Diferencia_dias;
                     }
               }else{
                      $TotalDiaReconocido = $Diferencia_dias - $DiaPagoEps;
                     if($Diferencia_dias > $DiaPagoEps){
                          $AuxiliarDia = round($Minimo/30);
                          $ValorPagoTemporal = round($AuxiliarDia * $TotalDiaReconocido);
                          $ValorPagoUsuaria = round($AuxiliarDia * $DiaPagoEps);
                          $TotalDiaAsumidoTemporal = $TotalDiaReconocido;
                          $TotalDiaAsumidoUsuaria = $DiaPagoEps;
                     }else{
                          $AuxiliarDia = round($Minimo/30);
                          $ValorPagoTemporal = round($AuxiliarDia * $TotalDiaReconocido);
                          $ValorPagoUsuaria = round($AuxiliarDia * $DiaPagoEps);
                          $TotalDiaAsumidoTemporal = 0;
                          $TotalDiaAsumidoUsuaria = $Diferencia_dias;
                     }
               }
       }
       if($tipo=='1040'|| $tipo=='1050'){
           $AuxiliarDia = round($Salario/30);
           $ValorPagoTemporal = round($AuxiliarDia * $Diferencia_dias);
           $ValorPagoUsuaria = 0;
           $TotalDiaAsumidoUsuaria = 0;
           $TotalDiaAsumidoTemporal = $Diferencia_dias;
       }
       if($tipo=='1010'){
           if($Diferencia_dias <= $DiaPagoArl){
               $AuxiliarDia = round($Salario/30);
               $ValorPagoTemporal = 0;
               $ValorPagoUsuaria = round($AuxiliarDia * $Diferencia_dias);
               $TotalDiaAsumidoUsuaria = $Diferencia_dias;
               $TotalDiaAsumidoTemporal = 0;
           }else{
              $TotalDiaReconocido = $Diferencia_dias - $DiaPagoArl;
               $AuxiliarDia = round($Salario/30);
               $ValorPagoTemporal = round($AuxiliarDia * $TotalDiaReconocido);
               $ValorPagoUsuaria = round($AuxiliarDia * $DiaPagoArl);
               $TotalDiaAsumidoUsuaria = $DiaPagoArl;
               $TotalDiaAsumidoTemporal = $TotalDiaReconocido;
           }
       }
         $FechaFinal =  strtotime ( '+ 27 day' , strtotime ( $FechaIncial ) ) ;
         $FechaFinalValidada = date ( 'Y-m-d' , $FechaFinal );
         if ($Reconocer=='SI'){
             if($fechaini  >= $FechaFinalValidada){
                 if($tipo != '1030' AND $Concepto != 'ACCIDENTE DE TRANSITO'){
                      if($estado != 'EN TRANSCRIPCION'){
		          include("../conexion.php");
		          $consulta="update incapacidad set fechaini='$fechaini',fechater='$FechaFinalIncapacidad',tipoinca='$tipo',dias='$Diferencia_dias',diastemporal='$TotalDiaAsumidoTemporal',diasusuaria='$TotalDiaAsumidoUsuaria',diasnomina='$Diferencia_dias',prorroga='$Prorroga',estado='$estado',codigo='$diagnostico',codsala='$CodSala',reconocerusuaria='$Reconocer',motivo='$motivo',salario='$Salario',valortemporal='$ValorPagoTemporal',valorusuaria='$ValorPagoUsuaria' where nroinca='$nroinca'";
		          $resultad=mysql_query($consulta)or die("Inserccion incorrecta");
		          $registro=mysql_affected_rows();
				  echo "<script language=\"javascript\">";
		          echo "open (\"../pie.php?msg=Se Grabó $registro registros de la Incapacidad Nro: $nroinca\",\"pie\");";
		          echo ("open (\"modificar.php?valor=$valor&opcion=$opcion&codigo=$codigo\",\"_self\");");
		         echo "</script>";
                      }else{
	                   ?>
		             <script language="javascript">
		               alert("Nota Importante: Las incapacidades EN TRANSCRIPCION NO generan reconocimiento a las Empresas Usuarias. Tener presente esta validacion.!")
	  	               history.back()
	  	             </script>
	                   <?
  	              }
                 }else{
	                   ?>
		             <script language="javascript">
		               alert("Nota Importante: Las incapacidades por Accidente de transito, NO generan reconocimiento a las Empresas Usuarias. Tener presente esta validacion.!")
	  	               history.back()
	  	             </script>
	                   <?
	         }
             }else{
                  if($tipo == '1010' || $tipo == '1050'){
                          $consulta="update incapacidad set fechaini='$fechaini',fechater='$FechaFinalIncapacidad',tipoinca='$tipo',dias='$Diferencia_dias',diastemporal='$TotalDiaAsumidoTemporal',diasusuaria='$TotalDiaAsumidoUsuaria',diasnomina='$Diferencia_dias',prorroga='$Prorroga',estado='$estado',codigo='$diagnostico',codsala='$CodSala',reconocerusuaria='$Reconocer',motivo='$motivo',salario='$Salario',valortemporal='$ValorPagoTemporal',valorusuaria='$ValorPagoUsuaria' where nroinca='$nroinca'";
		          $resultad=mysql_query($consulta)or die("Inserccion incorrecta");
		          $registro=mysql_affected_rows();
				  echo "<script language=\"javascript\">";
		          echo "open (\"../pie.php?msg=Se Grabó $registro registros de la Incapacidad Nro: $nroinca\",\"pie\");";
		          echo ("open (\"modificar.php?valor=$valor&opcion=$opcion&codigo=$codigo\",\"_self\");");
		         echo "</script>";
                   }else{
                        ?>
		         <script language="javascript">
		             alert("Nota Importante: Las incapacidades por Enfermedad general o Accidente de transito donde el Empleado este en periodo de urgencia, NO generan reconocimiento a las Empresas Usuarias. Cambiar el reconocimiento.!")
		             history.back()
		         </script>
                         <?
                   }
             }
         }else{
               $consulta="update incapacidad set fechaini='$fechaini',fechater='$FechaFinalIncapacidad',tipoinca='$tipo',dias='$Diferencia_dias',diastemporal='$TotalDiaAsumidoTemporal',diasusuaria='$TotalDiaAsumidoUsuaria',diasnomina='$Diferencia_dias',prorroga='$Prorroga',estado='$estado',codigo='$diagnostico',codsala='$CodSala',reconocerusuaria='$Reconocer',motivo='$motivo',salario='$Salario',valortemporal='$ValorPagoTemporal',valorusuaria='$ValorPagoUsuaria' where nroinca='$nroinca'";
	       $resultad=mysql_query($consulta)or die("Inserccion incorrecta");
	       $registro=mysql_affected_rows();
	       echo "<script language=\"javascript\">";
               echo "open (\"../pie.php?msg=Se Grabó $registro registros de la Incapacidad Nro: $nroinca\",\"pie\");";
	       echo ("open (\"modificar.php?valor=$valor&opcion=$opcion&codigo=$codigo\",\"_self\");");
	       echo "</script>";
         }
endif;
       ?>
</body>
</html>
