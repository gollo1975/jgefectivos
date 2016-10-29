
<?php
if(empty($Vector)){
   ?>
	<script language="javascript">
	alert("Debe de chequear al menos una caja de verificación.")
	history.back()
	</script>
   <?
}else{
	include ("../conexion.php");
        /*codigo que busca el codigo de costo*/
        for ($k=1 ; $k <= $Total; $k ++){
            if   ($Vector[$k] != ""){
	          $SqlCosto="select costo.centro,costo.codcosto from costo
	                     where costo.codcosto='$Vector[$k]'";
	          $RsCosto=mysql_query($SqlCosto) or die("Error al buscar costo");
	          $FilaC=mysql_fetch_array($RsCosto);
	          $CodCosto= $FilaC["codcosto"];
	          $Concepto= $FilaC["centro"];
	        /*codigo que permite grabar*/
	        $FechaP = date('Y-m-d');
	        $consulta = "select count(*) from zonacosto";
	        $result = mysql_query ($consulta);
	        $sw1 = mysql_fetch_row($result);
	        if ($sw1[0]>0):
	          $consult1 = "select max(cast(codigo as unsigned)) + 1  from zonacosto";
	          $result1 = mysql_query ($consult1);
	          $codec = mysql_fetch_row($result1);
	          $CodC = str_pad($codec[0], 7,"0", STR_PAD_LEFT);
	        else:
	         $CodC="0000001";
	        endif;
			$Contador = 0;
	        $Insertar="insert into zonacosto(codigo,codzona,zona,codcosto,centro,desde,hasta,fechap)
	        values('$CodC','$CodZona','$Zona','$CodCosto','$Concepto','$Desde','$Hasta','$FechaP')";
		    $RSul=mysql_query($Insertar)or die("Error al grabar datos del costo");
	        /*codigo que busca los empleados de decobro zona*/
	        $Sql="select decobrozona.* FROM zona,empleado,costo,cobrozona,decobrozona WHERE
	                          zona.codzona=cobrozona.codzona and
	                          cobrozona.codigo=decobrozona.codigo and
	                          empleado.codcosto=costo.codcosto and
	                          costo.codcosto='$CodCosto' and
	                          empleado.cedemple=decobrozona.cedemple
	                          and cobrozona.desde='$Desde' and
	                          cobrozona.hasta='$Hasta' and
	                          zona.codzona='$CodZona' order by decobrozona.empleado DESC";
		    $Rs=mysql_query($Sql) or die("Error al busca empleados en la tabla decobrozona.");
	       	$Contador=mysql_num_rows($Rs);
	        $i=0;
                $Salario=0;$TiemPrestacional=0;$TiempoNoPrestacional=0;$AuxilioTransporte=0;$VlrArl=0;$VlrEps=0;$VlrPension=0;$VlrCaja=0;$VlrSena;$VlrIcbf=0;$VlrPrestaciones=0;
                $VlrVacacion=0;$VlrAjusteP=0;$VlrAdmon=0;$Subtotal=0;$AuxIva=0;$TotalIva=0;$GranTotal=0;$SubtotalSinAdmon=0;
	        while ($VT=mysql_fetch_array($Rs)){
	               $InsertaDos="insert into dezonacosto(cedemple,empleado,basico,tiempo,tauxilio,ayuda,ss,vlreps,vlrpension,cp,vlrsena,vlricbf,ps,vacacion,ajusteparafiscal,admon,novedadingreso,novedadretiro,diasincapacidadgeneral,diasincapacidadlaboral,nivelr,peps,ppension,cargo,codigo)
		            values('" . $VT['cedemple'] . "','" . $VT['empleado'] . "','" . $VT['basico'] . "','" . $VT['tiempo'] . "','" . $VT['tauxilio'] . "','" . $VT['ayuda'] . "','" . $VT['vlrarp'] . "','" . $VT['vlreps'] . "','" . $VT['vlrpension'] . "','" . $VT['cajac'] . "',
	                    '" . $VT['vlrsena'] . "','" . $VT['vlricbf'] . "','" . $VT['ps'] . "','" . $VT['vacacion'] . "','" . $VT['ajusteparafiscal'] . "','" . $VT['admon'] . "','" . $VT['novedadingreso'] . "','" . $VT['novedadretiro'] . "','" . $VT['diasincapacidadgeneral'] . "',
	                    '" . $VT['diasincapacidadlaboral'] . "','" . $VT['nivelriesgo'] . "','" . $VT['peps'] . "','" . $VT['ppension'] . "','" . $VT['cargo'] . "','$CodC')";
		      $RsInsertardos=mysql_query($InsertaDos)or die("Erro al grabar en el detalle del centro de costo");
	              $i +=1;
                      /*codigo que acumula*/
                      $Salario += $VT['basico'] ;
                      $TiemPrestacional += $VT['tiempo'];
                      $TiempoNoPrestacional += $VT['tauxilio'];
                      $AuxilioTransporte += $VT['ayuda'];
                      $VlrArl += $VT['vlrarp'];
                      $VlrEps += $VT['vlreps'];
                      $VlrPension += $VT['vlrpension'];
                      $VlrCaja += $VT['cajac'];
                      $VlrSena += $VT['vlrsena'];
                      $VlrIcbf += $VT['vlricbf'];
                      $VlrPrestaciones += $VT['ps'];
                      $VlrVacacion += $VT['vacacion'];
                      $VlrAjusteP += $VT['ajusteparafiscal'];
                      $VlrAdmon += $VT['admon'];
	        }
                $Subtotal = round($Salario+$TiemPrestacional+$TiempoNoPrestacional+$AuxilioTransporte+$VlrArl+$VlrEps+$VlrPension+$VlrCaja+$VlrSena+$VlrIcbf+$VlrPrestaciones+$VlrVacacion+$VlrAjusteP+$VlrAdmon);
                $SubtotalSinAdmon = round($Subtotal - $VlrAdmon);
                $AuxIva = round($Subtotal / $baseiva);
                $TotalIva = round(($AuxIva * $vlriva)/100);
                $GranTotal = round($Subtotal + $TotalIva);
                /*codigo que acualiza la tabla*/
                $SqlActualizar = "update zonacosto set basico='$Salario',tiempo='$TiemPrestacional',tauxilio='$TiempoNoPrestacional',ayuda='$AuxilioTransporte',tarp='$VlrArl',teps='$VlrEps',tpension='$VlrPension',
                                 caja='$VlrCaja',tsena='$VlrSena',ticbf='$VlrIcbf',prestacion='$VlrPrestaciones',tvacacion='$VlrVacacion',totalajusteparafiscal='$VlrAjusteP',admon='$VlrAdmon',iva='$TotalIva',
                                 subtotal='$Subtotal',subtotalsinadmon='$SubtotalSinAdmon',grantotal='$GranTotal',contador='$Contador' WHERE zonacosto.codigo='$CodC'";
                $RsActualizar = mysql_query($SqlActualizar)or die ("Error al actualizar datos en la ZonaCosto");
                $Validar=mysql_affected_rows();
            }
        }
        echo "<script language=\"javascript\">";
	echo ("open (\"ProcesoCentroCosto.php\",\"_self\");");
	echo "</script>";
}
?>
