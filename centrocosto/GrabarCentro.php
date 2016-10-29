<input type="hidden" name="TipoSalario" value="<?echo $TipoSalario;?>">
<input type="hidden" name="PagarPension" value="<?echo $PagarPension;?>">
<input type="hidden" name="AuxilioT" value="<?echo $AuxilioT;?>">
<?
if(empty($datoN)):
   ?>
   <script language="javascript">
      alert("Debe de chequear al menos una caja de verificación para grabar la información!")
      history.back()
   </script>
   <?
else:
   $FechaV=date("Y-m-d");
   /*codigo de empleado*/
   include("../conexion.php");
   $ConE="select empleado.periodo,empleado.basico,empleado.tiempo from empleado where empleado.cedemple='$Cedula'";
   $Reg=mysql_query($ConE)or die("Error al buscar empleado");
   $Registro=mysql_fetch_array($Reg);
   $Periodo=$Registro["periodo"];
   $Salario=$Registro["basico"];
   $Contrato=$Registro["tiempo"];
   /*codigo de validacion de registros*/
   $consulta = "select count(*) from centro";
   $result = mysql_query ($consulta);
   $sw = mysql_fetch_row($result);
   if ($sw[0]>0):
           $consulta = "select max(cast(codcentro as unsigned)) + 1 from centro";
           $result = mysql_query($consulta) or die ("Fallo en la consulta");
           $codco = mysql_fetch_row($result);
           $Nroc = str_pad ($codco[0], 6, "0", STR_PAD_LEFT);
        else:
          $Nroc="000001";
        endif;
        $consulta="insert into centro(codcentro,cedemple,fecha)
                   values('$Nroc','$Cedula','$FechaV')";
        $resultado=mysql_query($consulta)or die("error al grabar centro");
        $registro=mysql_affected_rows();
        /*CODIGO DE BUSQUEDA VALIDAR PENSION*/
        $ConE="select parametropension.codsala from parametropension where parametropension.cedemple='$Cedula' and estado='ACTIVO'";
        $resE=mysql_query($ConE)or die("error al buscar parametro");
        $filas_e=mysql_fetch_array($resE);
        $CodSalario=$filas_e["codsala"];
         for ($k=1 ; $k<=$tActualizaciones; $k ++):
          if($datoN[$k] != ''):
               if($datoN[$k] != $CodSalario):
                /*codigo de salario*/
                 $ConS="select salario.codsala,salario.porcentaje as Porc,salario.ayuda,salario.formapago,salario.ingreso,salario.totalhoras,salario.desala,salario.control,prestacion,salario.activo,salario.permanente
                  from salario where salario.codsala='$datoN[$k]'";
                 $RegS=mysql_query($ConS)or die("Error al buscar salarios");
                 $Registro_s=mysql_fetch_array($RegS);
                 $Ingreso=$Registro_s["ingreso"];
                 $FormaPago=$Registro_s["formapago"];
                 $TotalHoras=$Registro_s["totalhoras"];
                 $Concepto=$Registro_s["desala"];
                 $Visible=$Registro_s["control"];
                 $Prestacion=$Registro_s["prestacion"];
                 $VlrPorHora=$Registro_s["Porc"];
                 $Activo=$Registro_s["activo"];
                 $Permanente=$Registro_s["permanente"];
                 $VlrHora=0;$Total=0;$PorcenT=0;
                 if($FormaPago=='HORAS' and $TotalHoras=='SI'):
                     if($Periodo=='SEMANAL'):
	                 if($Contrato=='NORMAL'):
	                        $VlrHora=$Salario/30/8;
                                $Total=(7 * 8);
                                $PorcenT=0;
                                $Deduccion=0;
	                 else:
	                        if($Contrato=='MEDIO TIEMPO'):
                                   $VlrHora=$Salario/30/4;
                                   $Total=(7 * 4);
                                   $PorcenT=0;
                                   $Deduccion=0;
	                        else:
                                   $VlrHora=$Salario/30/8;
                                   $Total=0;
                                   $PorcenT=0;
                                   $Deduccion=0;
	                        endif;
	                 endif;
	             else:
	                 if($Periodo=='DECADAL'):
                            if($Contrato=='NORMAL'):
	                        $VlrHora=$Salario/30/8;
                                $Total=(10 * 8);
                                $PorcenT=0;
                                $Deduccion=0;
	                    else:
	                        if($Contrato=='MEDIO TIEMPO'):
                                   $VlrHora=$Salario/30/4;
                                   $Total=(10 * 4);
                                   $PorcenT=0;
                                   $Deduccion=0;
	                        else:
                                   $VlrHora=$Salario/30/8;
                                   $Total=0;
                                   $PorcenT=0;
                                   $Deduccion=0;
	                        endif;
	                    endif;
	                 else:
	                     if($Periodo=='CATORCENAL'):
                                if($Contrato=='NORMAL'):
	                           $VlrHora=$Salario/30/8;
                                   $Total=(14 * 8);
                                   $PorcenT=0;
                                   $Deduccion=0;
	                        else:
	                            if($Contrato=='MEDIO TIEMPO'):
                                       $VlrHora=$Salario/30/4;
                                       $Total=(14 * 4);
                                       $PorcenT=0;
                                       $Deduccion=0;
	                            else:
                                       $VlrHora=$Salario/30/8;
                                       $Total=0;
                                       $PorcenT=0;
                                       $Deduccion=0;
	                            endif;
	                        endif;
	                     else:
	                         if($Periodo=='QUINCENAL'):
                                     if($Contrato=='NORMAL'):
	                                $VlrHora=$Salario/30/8;
                                        $Total=(15 * 8);
                                        $PorcenT=0;
                                        $Deduccion=0;
	                             else:
	                                if($Contrato=='MEDIO TIEMPO'):
                                           $VlrHora=$Salario/30/4;
                                           $Total=(15 * 4);
                                           $PorcenT=0;
                                           $Deduccion=0;
	                                else:
                                           $VlrHora=$Salario/30/8;
                                           $Total=0;
                                           $PorcenT=0;
                                           $Deduccion=0;
	                                endif;
	                             endif;
	                         else:
                                     if($Contrato=='NORMAL'):
	                                $VlrHora=$Salario/30/8;
                                        $Total=(30 * 8);
                                        $PorcenT=0;
                                        $Deduccion=0;
	                             else:
	                                if($Contrato=='MEDIO TIEMPO'):
                                           $VlrHora=$Salario/30/4;
                                           $Total=(30 * 4);
                                           $PorcenT=0;
                                           $Deduccion=0;
	                                else:
                                           $VlrHora=$Salario/30/8;
                                           $Total=0;
                                           $PorcenT=0;
                                           $Deduccion=0;
	                                endif;
	                             endif;
	                         endif;
	                     endif;
	                endif;
	             endif;
                 endif;
                      $ConP="select parametroauxilio.* from parametroauxilio where estado='ACTIVO'";
		      $RegP=mysql_query($ConP)or die("Error al buscar empleado");
		      $filas=mysql_fetch_array($RegP);
                      $Maximo=$filas["maximo"];
	              $Minimo=$filas["minimo"];
                      if($FormaPago=='DIAS' and $TotalHoras=='NO'):
	                    $VlrHora=0;$Total=0;$PorcenT=0;
			     if($Periodo=='SEMANAL'):
		                  if($Contrato=='NORMAL'):
	                              if($Salario <= $Maximo):
	                                $VlrHora=$AuxilioT/30;
	                                $Total= 7 ;
	                                $PorcenT=0;
                                        $Deduccion=0;
	                              endif;
		                  else:
		                      if($Contrato=='MEDIO TIEMPO'):
                                         if($AuxilioT <= $Maximo):
	                                    $VlrHora=$AuxilioT/30;
	                                    $Total= 7;
	                                    $PorcenT=0;
                                            $Deduccion=0;
	                                 endif;
		                      else:
                                            $VlrHora=$AuxilioT/30;
	                                    $Total= 0;
	                                    $PorcenT=0;
                                            $Deduccion=0;
		                      endif;
		                  endif;
		             else:
		                 if($Periodo=='DECADAL'):
                                    if($Contrato=='NORMAL'):
	                             if($Salario <= $Maximo):
	                                $VlrHora=$AuxilioT/30;
	                                $Total= 10 ;
	                                $PorcenT=0;
                                        $Deduccion=0;
	                              endif;
		                    else:
		                      if($Contrato=='MEDIO TIEMPO'):
                                         if($AuxilioT <= $Maximo):
	                                    $VlrHora=$AuxilioT/30;
	                                    $Total= 10 ;
	                                    $PorcenT=0;
                                            $Deduccion=0;
	                                 endif;
		                      else:
                                            $VlrHora=$AuxilioT/30;
	                                    $Total= 0;
	                                    $PorcenT=0;
                                            $Deduccion=0;
                                       endif;
                                    endif;
                                 else:
                                     if($Periodo=='CATORCENAL'):
                                         if($Contrato=='NORMAL'):
	                                   if($Salario <= $Maximo):
	                                        $VlrHora=$AuxilioT/30;
	                                        $Total= 14 ;
	                                        $PorcenT=0;
                                                $Deduccion=0;
	                                    endif;
		                         else:
		                             if($Contrato=='MEDIO TIEMPO'):
                                                 if($AuxilioT <= $Maximo):
	                                            $VlrHora=$AuxilioT/30;
	                                            $Total= 14 ;
	                                            $PorcenT=0;
                                                    $Deduccion=0;
	                                         endif;
		                             else:
                                                 $VlrHora=$AuxilioT/30;
	                                         $Total= 0;
	                                         $PorcenT=0;
                                                 $Deduccion=0;
                                             endif;
		                         endif;
		                     else:
		                        if($Periodo=='QUINCENAL'):
                                            if($Contrato=='NORMAL'):
	                                       if($Salario <= $Maximo):
	                                            $VlrHora=$AuxilioT/30;
	                                            $Total= 15 ;
	                                            $PorcenT=0;
                                                    $Deduccion=0;
	                                        endif;
		                            else:
		                                if($Contrato=='MEDIO TIEMPO'):
                                                    if($AuxilioT <= $Maximo):
	                                               $VlrHora=$AuxilioT/30;
	                                               $Total= 15 ;
	                                               $PorcenT=0;
                                                       $Deduccion=0;
	                                            endif;
		                                else:
                                                    $VlrHora=$AuxilioT/30;
	                                            $Total= 0;
	                                            $PorcenT=0;
                                                    $Deduccion=0;
                                                endif;
		                            endif;
		                        else:
                                            if($Contrato=='NORMAL'):
	                                       if($Salario <= $Maximo):
	                                            $VlrHora=$AuxilioT/30;
	                                            $Total= 30 ;
	                                            $PorcenT=0;
                                                    $Deduccion=0;
	                                        endif;
		                            else:
		                                if($Contrato=='MEDIO TIEMPO'):
                                                   if($Salario <= $Maximo):
	                                               $VlrHora=$AuxilioT/30;
	                                               $Total= 30 ;
	                                               $PorcenT=0;
                                                       $Deduccion=0;
	                                            endif;
		                                else:
                                                    $VlrHora=$AuxilioT/30;
	                                            $Total= 0;
	                                            $PorcenT=0;
                                                    $Deduccion=0;
                                                endif;
		                            endif;
		                        endif;
		                     endif;
		                 endif;
		             endif;
                      endif;
                        /*CODIGO DE TIEMPO EXTRAS O INGRESOS*/
                          if($FormaPago=='HORAS' and $TotalHoras=='NO'):
                              $AuxH=0; $AuxP=0;
                             if($Periodo=='SEMANAL'):
	                       if($Contrato=='NORMAL'):
                                  $AuxH= round(($Salario/30)/8);
                                  $AuxP= round(($AuxH*$VlrPorHora)/100);
                                  $VlrHora=$AuxP;
                                  $Total=0;
                                  $Deduccion=0;
                                  $PorcenT=$VlrPorHora;
	                       else:
	                          if($Contrato=='MEDIO TIEMPO'):
                                     $AuxH= round(($Salario/30)/4);
                                     $AuxP= round(($AuxH*$VlrPorHora)/100);
                                     $VlrHora=$AuxP;
                                     $Total=0;
                                     $Deduccion=0;
                                     $PorcenT=$VlrPorHora;
	                          else:
                                     $AuxH= round(($Salario/30)/8);
                                     $AuxP= round(($AuxH*$VlrPorHora)/100);
                                     $VlrHora=$AuxP;
                                     $Total=0;
                                     $Deduccion=0;
                                     $PorcenT=$VlrPorHora;
	                          endif;
	                       endif;
	                     else:
	                         if($Periodo=='DECADAL'):
                                     if($Contrato=='NORMAL'):
                                       $AuxH= round(($Salario/30)/8);
                                       $AuxP= round(($AuxH*$VlrPorHora)/100);
                                       $VlrHora=$AuxP;
                                       $Total=0;
                                       $Deduccion=0;
                                       $PorcenT=$VlrPorHora;
	                             else:
	                                if($Contrato=='MEDIO TIEMPO'):
                                           $AuxH= round(($Salario/30)/4);
                                           $AuxP= round(($AuxH*$VlrPorHora)/100);
                                           $VlrHora=$AuxP;
                                           $Total=0;
                                           $Deduccion=0;
                                           $PorcenT=$VlrPorHora;
	                                else:
                                           $AuxH= round(($Salario/30)/8);
                                           $AuxP= round(($AuxH*$VlrPorHora)/100);
                                           $VlrHora=$AuxP;
                                           $Total=0;
                                           $Deduccion=0;
                                           $PorcenT=$VlrPorHora;
	                                endif;
                                     endif;
	                         else:
	                             if($Periodo=='CATORCENAL'):
                                         if($Contrato=='NORMAL'):
                                            $AuxH= round(($Salario/30)/8);
                                            $AuxP= round(($AuxH*$VlrPorHora)/100);
                                            $VlrHora=$AuxP;
                                            $Total=0;
                                            $Deduccion=0;
                                            $PorcenT=$VlrPorHora;
	                                 else:
	                                     if($Contrato=='MEDIO TIEMPO'):
                                                $AuxH= round(($Salario/30)/4);
                                                $AuxP= round(($AuxH*$VlrPorHora)/100);
                                                $VlrHora=$AuxP;
                                                $Total=0;
                                                $Deduccion=0;
                                                $PorcenT=$VlrPorHora;
	                                     else:
                                                $AuxH= round(($Salario/30)/8);
                                                $AuxP= round(($AuxH*$VlrPorHora)/100);
                                                $VlrHora=$AuxP;
                                                $Total=0;
                                                $Deduccion=0;
                                                $PorcenT=$VlrPorHora;
	                                     endif;
                                         endif;
	                             else:
	                                  if($Periodo=='QUINCENAL'):
                                              if($Contrato=='NORMAL'):
                                                 $AuxH= round(($Salario/30)/8);
                                                $AuxP= round(($AuxH*$VlrPorHora)/100);
                                                 $VlrHora=$AuxP;
                                                 $Total=0;
                                                 $Deduccion=0;
                                                 $PorcenT=$VlrPorHora;
	                                      else:
	                                          if($Contrato=='MEDIO TIEMPO'):
                                                     $AuxH= round(($Salario/30)/4);
                                                    $AuxP= round(($AuxH*$VlrPorHora)/100);
                                                     $VlrHora=$AuxP;
                                                     $Total=0;
                                                     $Deduccion=0;
                                                     $PorcenT=$VlrPorHora;
	                                          else:
                                                      $AuxH= round(($Salario/30)/8);
                                                     $AuxP= round(($AuxH*$VlrPorHora)/100);
                                                      $VlrHora=$AuxP;
                                                      $Total=0;
                                                      $Deduccion=0;
                                                      $PorcenT=$VlrPorHora;
	                                          endif;
                                              endif;
	                                  else:
                                              if($Contrato=='NORMAL'):
                                                 $AuxH= round(($Salario/30)/8);
                                                 $AuxP= round(($AuxH*$VlrPorHora)/100);
                                                 $VlrHora=$AuxP;
                                                 $Total=0;
                                                 $Deduccion=0;
                                                 $PorcenT=$VlrPorHora;
	                                      else:
	                                          if($Contrato=='MEDIO TIEMPO'):
                                                     $AuxH= round(($Salario/30)/4);
                                                     $AuxP= round(($AuxH*$VlrPorHora)/100);
                                                     $VlrHora=$AuxP;
                                                     $Total=0;
                                                     $Deduccion=0;
                                                     $PorcenT=$VlrPorHora;
	                                          else:
                                                      $AuxH= round(($Salario/30)/8);
                                                      $AuxP= round(($AuxH*$VlrPorHora)/100);
                                                      $VlrHora=$AuxP;
                                                      $Total=0;
                                                      $Deduccion=0;
                                                      $PorcenT=$VlrPorHora;
	                                          endif;
                                              endif;
	                                  endif;
	                             endif;
	                         endif;
                             endif;
                          endif;
                            /*codigo para horas que no acumulen el mas igual*/
                              if($FormaPago=='HORAS' and $TotalHoras=='IGUAL'):
                                $AuxH=0; $AuxP=0;
                                if($Periodo=='SEMANAL'):
	                           if($Contrato=='NORMAL'):
                                      $AuxH= round(($Salario/30)/8);
                                      $AuxP= round(($AuxH*$VlrPorHora)/100);
                                      $VlrHora=round($AuxP);
                                      $Total=0;
                                      $Deduccion=0;
                                      $PorcenT=$VlrPorHora;
	                           else:
	                              if($Contrato=='MEDIO TIEMPO'):
                                         $AuxH= round(($Salario/30)/4);
                                         $AuxP= round(($AuxH*$VlrPorHora)/100);
                                         $VlrHora=round($AuxP);
                                         $Total=0;
                                         $Deduccion=0;
                                         $PorcenT=$VlrPorHora;
	                              else:
                                         $AuxH= round(($Salario/30)/8);
                                        $AuxP= round(($AuxH*$VlrPorHora)/100);
                                         $VlrHora=round($AuxP);
                                         $Total=0;
                                         $Deduccion=0;
                                         $PorcenT=$VlrPorHora;
	                              endif;
	                           endif;
	                        else:
	                            if($Periodo=='DECADAL'):
                                           if($Contrato=='NORMAL'):
	                                      $AuxH= round(($Salario/30)/8);
	                                     $AuxP= round(($AuxH*$VlrPorHora)/100);
	                                      $VlrHora=round($AuxP);
	                                      $Total=0;
	                                      $Deduccion=0;
	                                      $PorcenT=$VlrPorHora;
		                           else:
		                              if($Contrato=='MEDIO TIEMPO'):
	                                         $AuxH= round(($Salario/30)/4);
	                                         $AuxP= round(($AuxH*$VlrPorHora)/100);
	                                         $VlrHora=round($AuxP);
	                                         $Total=0;
	                                         $Deduccion=0;
	                                         $PorcenT=$VlrPorHora;
		                              else:
	                                         $AuxH= round(($Salario/30)/8);
	                                         $AuxP= round(($AuxH*$VlrPorHora)/100);
	                                         $VlrHora=round($AuxP);
	                                         $Total=0;
	                                         $Deduccion=0;
	                                         $PorcenT=$VlrPorHora;
		                              endif;
		                           endif;
	                            else:
	                                if($Periodo=='CATORCENAL'):
                                           if($Contrato=='NORMAL'):
	                                      $AuxH= round(($Salario/30)/8);
	                                     $AuxP= round(($AuxH*$VlrPorHora)/100);
	                                      $VlrHora=round($AuxP);
	                                      $Total=0;
	                                      $Deduccion=0;
	                                      $PorcenT=$VlrPorHora;
		                           else:
		                              if($Contrato=='MEDIO TIEMPO'):
	                                         $AuxH= round(($Salario/30)/4);
	                                      $AuxP= round(($AuxH*$VlrPorHora)/100);
	                                         $VlrHora=round($AuxP);
	                                         $Total=0;
	                                         $Deduccion=0;
	                                         $PorcenT=$VlrPorHora;
		                              else:
	                                         $AuxH= round(($Salario/30)/8);
	                                       $AuxP= round(($AuxH*$VlrPorHora)/100);
	                                         $VlrHora=round($AuxP);
	                                         $Total=0;
	                                         $Deduccion=0;
	                                         $PorcenT=$VlrPorHora;
		                              endif;
		                           endif;
	                                else:
	                                   if($Periodo=='QUINCENAL'):
                                               if($Contrato=='NORMAL'):
	                                           $AuxH= round(($Salario/30)/8);
	                                           $AuxP= round(($AuxH*$VlrPorHora)/100);
	                                           $VlrHora=round($AuxP);
	                                           $Total=0;
	                                           $Deduccion=0;
	                                           $PorcenT=$VlrPorHora;
		                               else:
		                                   if($Contrato=='MEDIO TIEMPO'):
	                                               $AuxH= round(($Salario/30)/4);
	                                              $AuxP= round(($AuxH*$VlrPorHora)/100);
	                                               $VlrHora=round($AuxP);
	                                               $Total=0;
	                                               $Deduccion=0;
	                                               $PorcenT=$VlrPorHora;
		                                   else:
	                                               $AuxH= round(($Salario/30)/8);
	                                               $AuxP= round(($AuxH*$VlrPorHora)/100);
	                                               $VlrHora=round($AuxP);
	                                               $Total=0;
	                                               $Deduccion=0;
	                                               $PorcenT=$VlrPorHora;
		                                   endif;
		                               endif;
	                                   else:
                                               if($Contrato=='NORMAL'):
	                                           $AuxH= round(($Salario/30)/8);
	                                           $AuxP= round(($AuxH*$VlrPorHora)/100);
	                                           $VlrHora=round($AuxP);
	                                           $Total=0;
	                                           $Deduccion=0;
	                                           $PorcenT=$VlrPorHora;
		                               else:
		                                   if($Contrato=='MEDIO TIEMPO'):
	                                               $AuxH= round(($Salario/30)/4);
	                                              $AuxP= round(($AuxH*$VlrPorHora)/100);
	                                               $VlrHora=round($AuxP);
	                                               $Total=0;
	                                               $Deduccion=0;
	                                               $PorcenT=$VlrPorHora;
		                                   else:
	                                               $AuxH= round(($Salario/30)/8);
	                                              $AuxP= round(($AuxH*$VlrPorHora)/100);
	                                               $VlrHora=round($AuxP);
	                                               $Total=0;
	                                               $Deduccion=0;
	                                               $PorcenT=$VlrPorHora;
		                                   endif;
		                               endif;
	                                   endif;
	                                endif;
	                            endif;
                                endif;
                              endif;
                              if($FormaPago=='COMISION' and $TotalHoras=='NO'):
                                     $VlrHora=0;
                                     $Total=0;
                                     $Deduccion=0;
                                     $PorcenT=0;
                              endif;
	                      if($FormaPago=='NINGUNA' and $TotalHoras=='NO'):
	                          $AuxH=0;$Deduccion=0;
	                          if($Periodo=='SEMANAL'):
	                             if($Contrato=='NORMAL'):
	                                if($TipoSalario=='VARIABLE'):
	                                    $PorcenT=$VlrPorHora;
	                                    $Total=0;
	                                    $Deduccion=0;
	                                else:
	                                              $AuxH= round($Salario/30)*7;
	                                              $Deduccion= round(-$AuxH*$VlrPorHora)/100;
	                                              $PorcenT=$VlrPorHora;
	                                              $Total=0;
	                                endif;
	                             else:
                                                if($Contrato=='MEDIO TIEMPO'):
                                                   if($TipoSalario=='VARIABLE'):
	                                               $PorcenT=$VlrPorHora;
	                                              $Total=0;
	                                              $Deduccion=0;
	                                           else:
	                                              $AuxH= round($Salario/30)*7;
	                                              $Deduccion= round(-$AuxH*$VlrPorHora)/100;
	                                              $PorcenT=$VlrPorHora;
	                                              $Total=0;
	                                           endif;
                                                else:
                                                    $PorcenT=$VlrPorHora;
                                                    $Total=0;
                                                    $Deduccion=0;
                                                endif;
	                             endif;
	                          else:
                                       $AuxH=0;$Deduccion=0;
		                       if($Periodo=='DECADAL'):
		                           if($Contrato=='NORMAL'):
		                               if($TipoSalario=='VARIABLE'):
		                                   $PorcenT=$VlrPorHora;
		                                   $Total=0;
		                                   $Deduccion=0;
		                               else:
		                                              $AuxH= round($Salario/30)*10;
		                                              $Deduccion= round(-$AuxH*$VlrPorHora)/100;
		                                              $PorcenT=$VlrPorHora;
		                                              $Total=0;
		                                endif;
		                           else:
	                                        if($Contrato=='MEDIO TIEMPO'):
	                                            if($TipoSalario=='VARIABLE'):
		                                               $PorcenT=$VlrPorHora;
		                                              $Total=0;
		                                              $Deduccion=0;
		                                    else:
		                                              $AuxH= round($Salario/30)*10;
		                                              $Deduccion= round(-$AuxH*$VlrPorHora)/100;
		                                              $PorcenT=$VlrPorHora;
		                                              $Total=0;
		                                     endif;
	                                        else:
	                                                    $PorcenT=$VlrPorHora;
	                                                    $Total=0;
	                                                    $Deduccion=0;
	                                        endif;
		                           endif;
                                       else:
                                            $AuxH=0;$Deduccion=0;
		                            if($Periodo=='CATORCENAL'):
		                               if($Contrato=='NORMAL'):
		                                  if($TipoSalario=='VARIABLE'):
		                                     $PorcenT=$VlrPorHora;
		                                     $Total=0;
		                                     $Deduccion=0;
		                                  else:
		                                      $AuxH= round($Salario/30)*14;
		                                      $Deduccion= round(-$AuxH*$VlrPorHora)/100;
		                                      $PorcenT=$VlrPorHora;
		                                      $Total=0;
		                                  endif;
		                               else:
	                                           if($Contrato=='MEDIO TIEMPO'):
	                                               if($TipoSalario=='VARIABLE'):
		                                               $PorcenT=$VlrPorHora;
		                                              $Total=0;
		                                              $Deduccion=0;
		                                       else:
		                                              $AuxH= round($Salario/30)*14;
		                                              $Deduccion= round(-$AuxH*$VlrPorHora)/100;
		                                              $PorcenT=$VlrPorHora;
		                                              $Total=0;
		                                       endif;
	                                           else:
	                                                    $PorcenT=$VlrPorHora;
	                                                    $Total=0;
	                                                    $Deduccion=0;
	                                           endif;
                                               endif;
                                            else:
                                                if($Periodo=='QUINCENAL'):
		                                    if($Contrato=='NORMAL'):
		                                        if($TipoSalario=='VARIABLE'):
		                                            $PorcenT=$VlrPorHora;
		                                            $Total=0;
		                                            $Deduccion=0;
		                                         else:
		                                             $AuxH= round($Salario/30)*15;
		                                              $Deduccion= round(-$AuxH*$VlrPorHora)/100;
			                                      $PorcenT=$VlrPorHora;
			                                      $Total=0;
		                                         endif;
		                                    else:
	                                                if($Contrato=='MEDIO TIEMPO'):
	                                                    if($TipoSalario=='VARIABLE'):
		                                               $PorcenT=$VlrPorHora;
		                                               $Total=0;
		                                               $Deduccion=0;
		                                            else:
		                                                $AuxH= round($Salario/30)*15;
		                                                $Deduccion= round(-$AuxH*$VlrPorHora)/100;
		                                                $PorcenT=$VlrPorHora;
		                                                $Total=0;
		                                            endif;
	                                                else:
	                                                    $PorcenT=$VlrPorHora;
	                                                    $Total=0;
	                                                    $Deduccion=0;
	                                                endif;
                                                    endif;
                                                else:
                                                     if($Contrato=='NORMAL'):
		                                        if($TipoSalario=='VARIABLE'):
		                                            $PorcenT=$VlrPorHora;
		                                            $Total=0;
		                                            $Deduccion=0;
		                                         else:
		                                             $AuxH= round($Salario/30)*30;
		                                              $Deduccion= round(-$AuxH*$VlrPorHora)/100;
			                                      $PorcenT=$VlrPorHora;
			                                      $Total=0;
		                                         endif;
		                                    else:
	                                                if($Contrato=='MEDIO TIEMPO'):
	                                                    if($TipoSalario=='VARIABLE'):
		                                               $PorcenT=$VlrPorHora;
		                                               $Total=0;
		                                               $Deduccion=0;
		                                            else:
		                                                $AuxH= round($Salario/30)*30;
		                                                $Deduccion= round(-$AuxH*$VlrPorHora)/100;
		                                                $PorcenT=$VlrPorHora;
		                                                $Total=0;
		                                            endif;
	                                                else:
	                                                    $PorcenT=$VlrPorHora;
	                                                    $Total=0;
	                                                    $Deduccion=0;
	                                                endif;
                                                    endif;
                                                endif;
                                            endif;
                                       endif;
                                  endif;
                              endif;
                              if($FormaPago=='DEDUCCION' and $TotalHoras=='NO'):
		                     $PorcenT=0;
		                     $Total=0;
		                      $Deduccion=0;
                              endif;
                              if($FormaPago=='HORAS' and $TotalHoras=='ING'):

                                    $TotalAux=0;$VlrHora=0;
                                    $TotalAux=round($Minimo*1.5);
                                    if($Salario <= $TotalAux):
                                        $VlrHora= ($Minimo/30)/8;
                                        $PorcenT= 0;
		                        $Total=0;
		                        $Deduccion=0;
                                    else:
                                         $TotalAux=round((($Salario/30/8)*$VlrPorHora)/100);
                                         $VlrHora= $TotalAux;
                                         $PorcenT= $VlrPorHora;
		                         $Total=0;
		                         $Deduccion=0;
                                    endif;
                              endif;
                              if($FormaPago=='NINGUNA' and $TotalHoras=='ING'):
                                         $TotalAux=0;$VlrHora=0;
                                         $TotalAux=round($Salario/30/8);
                                         $VlrHora= $TotalAux;
                                         $PorcenT= 0;
		                         $Total=0;
		                         $Deduccion=0;
                              endif;
                 /*codigo de ingresos al centro*/
                   $con="insert into decentro(codcentro,codsala,descripcion,vlrhora,nrohora,prestacion,variacion,porcentaje,deduccion,estado,datos,activo,permanente,agrupado)
                   values('$Nroc','$datoN[$k]','$Concepto','$VlrHora','$Total','$Prestacion','$TipoSalario','$PorcenT','$Deduccion','$Ingreso','$Visible','$Activo','$Permanente','$Agrupado[$k]')";
                   $resulta=mysql_query($con)or die("Error al grabar detallado del centro de costo. ");
                   $registro=mysql_affected_rows();
             endif;
           endif;
       endfor;
      ?>
       <script language="javascript">
            alert("Registros Grabados con exito en la base de datos!")
            open("agregar.php","_self")
       </script>
        <?
endif;
     ?>
