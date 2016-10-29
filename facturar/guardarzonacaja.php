<script language="javascript">
     function imprimir(numero)// para declara funcion
                {
                pagina='imprimirdetallecaja.php?codigo=' + numero
                tiempo=80
                ubicacion='_self'
                setTimeout("open(pagina,ubicacion)",tiempo)
                }
 </script>
 <input type="hidden" value="<?echo $CodZona;?>" name="CodZona" class="cajas"size="11" maxlength="11">
 <input type="hidden" value="<?echo $filas_s["zona"]?>" name="zona" class="cajas"size="11" maxlength="11">
 <input type="hidden" value="<?echo $Desde;?>" name="Desde" class="cajas"size="11" maxlength="11">
 <input type="hidden" value="<?echo $Hasta;?>" name="Hasta" class="cajas"size="11" maxlength="11">
 <input type="hidden" value="<?echo $fechap;?>" name="fechap" class="cajas"size="11" maxlength="11">
 <td><input type="hidden" name="valor" value="<? echo $valor;?>"></td>
<?

  if(empty($datos)):
      ?>
      <script language="javascript">
        alert("Debe de Seleccionar los Item que se van a Enviar para el Proceso de Facturación ?")
        history.back()
        </script>
      <?
   elseif(empty($total)):
      ?>
      <script language="javascript">
        alert("Debe colocar el subtotal de la factura de servicio ?")
        history.back()
        </script>
      <?
       elseif(empty($grantotal)):
      ?>
      <script language="javascript">
        alert("Debe colocar el total de la factura de servicio ?")
        history.back()
        </script>
      <?
   else:
       $fechap=date("Y-m-d");
       include("../conexion.php");
       $consulta = "select count(*) from cobrozona";
       $result = mysql_query ($consulta);
       $sw1 = mysql_fetch_row($result);
       if ($sw1[0]>0):
          $consult1 = "select max(cast(codigo as unsigned)) + 1  from cobrozona";
          $result1 = mysql_query ($consult1);
          $codec = mysql_fetch_row($result1);
          $codigo = str_pad($codec[0], 7,"0", STR_PAD_LEFT);
       else:
         $codigo="0000001";
       endif;
       $TotalSinAdmon=0;
       $TotalSinAdmon = round($subtotal- $total13);
       $consulta="insert into cobrozona(codigo,codzona,zona,desde,hasta,fechap,total,incapacidad,anticipo,otros,ajuste,menorvlr,subtotalsinadmon,admon,subtotal,ivatotal,grantotal,contador)
       values('$codigo','$CodZona','$zona','$Desde','$Hasta','$fechap','$total','$incapacidad','$anticipo','$otro','$ajuste','$menor','$TotalSinAdmon','$total13','$subtotal','$ivato','$grantotal','$ContadorEmpleado')";
       $resultad=mysql_query($consulta)or die("Inserccion incorrecta 1 $consulta");
       //ciclo de grabar
       for ($k=1 ; $k<=$tActualizaciones; $k ++):
           if   ($datos[$k] != "" ):
            $con="insert into decobrozona(cedemple,empleado,basico,tiempo,tauxilio,ayuda,vlrarp,vlreps,vlrpension,cajac,vlrsena,vlricbf,ps,vacacion,ajusteparafiscal,admon,iva,codigo,novedadingreso,novedadretiro,diasincapacidadgeneral,diasincapacidadlaboral,nivelriesgo,peps,ppension,cargo)
            values('$datos[$k]','$empleado[$k]','$salario[$k]','$tiempo[$k]','$tauxilio[$k]','$ayuda[$k]','$arp[$k]','$eps[$k]','$pension[$k]','$cp[$k]','$sena[$k]','$icbf[$k]','$ps[$k]','$vacacion[$k]','$AjusteCaja[$k]','$admon[$k]','$ivatotal[$k]','$codigo','$NovedadIngreso[$k]','$NovedadRetiro[$k]','$IncapacidadGeneral[$k]','$IncapacidadLaboral[$k]','$parp[$k]','$peps[$k]','$ppension[$k]','$cargo[$k]')";
            $resulta=mysql_query($con)or die("Inserccion incorrecta 2 $con");
            /*codigo que actualiza la tabla nomina*/
             if   ($tiempo[$k] != 0 ){
                $SS="update nomina set ibc_tiempo_suple='$tiempo[$k]' where nomina.cedemple='$datos[$k]' and nomina.desde='$Desde' and nomina.hasta='$Hasta' and nomina.codzona='$CodZona'";
                 $Res=mysql_query($SS)or die("Error al validar el tiempo en la tabla nomina");
             }
            /*fin codigo*/
          endif;
       endfor;
               $registro=mysql_affected_rows();
               echo "<script language=\"javascript\">";
               echo "open (\"../pie.php?msg=Se Grabó $registro registro de la Zona: $zona\",\"pie\");";
               echo ("open (\"imprimirdetallecaja.php?codigo=$codigo\" ,\"\");");
               if($Xestado==2):
                 echo ("open (\"facturasolobasico.php\" ,\"_self\");");
               else:
                 echo ("open (\"auxiliarFacturacion.php\" ,\"_self\");");
               endif;
               echo "</script>";
endif;
?>

