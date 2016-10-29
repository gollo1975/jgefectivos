 <input type="hidden" name="codzona" value="<? echo $codzona;?>" size="3">
 <input type="hidden" name="zona" value="<? echo $zona;?>" size="3">
     <input type="hidden" name="basico" value="<? echo $basico;?>" size="3">
     <input type="hidden" name="pension" value="<? echo $pension;?>" size="3">
     <input type="hidden" name="eps" value="<? echo $eps;?>" size="3">
     <input type="hidden" name="arp" value="<? echo $arp;?>" size="3">
     <input type="hidden" name="caja" value="<? echo $caja;?>" size="3">
     <input type="hidden" name="admon" value="<? echo $admon;?>" size="3">
     <input type="hidden" name="hasta" value="<? echo $hasta;?>" size="11">
     <input type="hidden" name="desde" value="<? echo $desde;?>" size="11">
     <input type="hidden" name="iva" value="<? echo $iva;?>">
     <input type="hidden" name="auxilio" value="<? echo $auxilio;?>">
     <input type="hidden" name="prestacion" value="<? echo $prestacion;?>">

<?

  if(empty($datos)):
      ?>
      <script language="javascript">
        alert("Debe de Seleccionar los Item que se van a Enviar para el Proceso de Facturación ?")
        history.back()
        </script>
      <?
   elseif(empty($subtotal)):
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
      
       include("../conexion.php");
       $consulta = "select count(*) from empacador";
       $result = mysql_query ($consulta);
       $sw1 = mysql_fetch_row($result);
       if ($sw1[0]>0):
          $consult1 = "select max(cast(codigo as unsigned)) + 1  from empacador";
          $result1 = mysql_query ($consult1);
          $codec = mysql_fetch_row($result1);
          $codigo = str_pad($codec[0], 6,"0", STR_PAD_LEFT);
       else:
         $codigo="000001";
       endif;
       $consulta="insert into empacador(codigo,codzona,zona,fechap,desde,hasta,basico,pension,eps,arp,caja,admon,prestacion,auxilio,subtotal,incapacidad,ajuste,mayor,total,iva,grantotal)
       values('$codigo','$codzona','$zona','$fechap','$desde','$hasta','$basico','$pension','$eps','$arp','$caja','$admon','$prestacion','$auxilio','$total','$incapacidad','$ajuste','$mayor','$subtotal','$ivato','$grantotal')";
       $resultad=mysql_query($consulta)or die("Inserccion incorrecta 1 $consulta");
       //ciclo de grabar
       for ($k=0 ; $k<=$tActualizaciones; $k ++):
           if   ($datos[$k] != "" ):
            $con="insert into dempacador(cedemple,nombre,ibc,dias,vlrpension,vlreps,vlrarp,vlrcaja,vlradmon,vlrpresta,novedad,codigo)
            values('$datos[$k]','$empleado[$k]','$ibc[$k]','$dia[$k]','$vpension[$k]','$vlreps[$k]','$vlrarp[$k]','$vlrcaja[$k]','$vlradmon[$k]','$vlrpresta[$k]','$novedad[$k]','$codigo')";
            $resulta=mysql_query($con)or die("Inserccion incorrecta 2 $con");
          endif;
       endfor;
       $registro=mysql_affected_rows();
       echo "<script language=\"javascript\">";
       echo "open (\"../pie.php?msg=Se Grabó $registro registro de la Zona: $zona\",\"pie\");";
      echo ("open (\"consulta.php\",\"_self\");");
       echo "</script>";
    endif;
      ?>

