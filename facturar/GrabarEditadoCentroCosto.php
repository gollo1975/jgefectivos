<?

  if(empty($datos)){
      ?>
      <script language="javascript">
        alert("Debe de Seleccionar los Item que se van a Enviar para el Proceso de Edicion.!")
        history.back()
        </script>
      <?
   }elseif(empty($subtotal)){
      ?>
      <script language="javascript">
        alert("Debe colocar el subtotal de la factura de servicio ?")
        history.back()
        </script>
      <?
       }elseif(empty($grantotal)){
      ?>
      <script language="javascript">
        alert("Debe colocar el total de la factura de servicio ?")
        history.back()
        </script>
      <?
   }else{
       $fechap=date("Y-m-d");
       include("../conexion.php");
       $consulta = "select count(*) from zonacosto";
       $result = mysql_query ($consulta);
       $sw1 = mysql_fetch_row($result);
       if ($sw1[0]>0):
          $consult1 = "select max(cast(codigo as unsigned)) + 1  from zonacosto";
          $result1 = mysql_query ($consult1);
          $codec = mysql_fetch_row($result1);
          $codigo = str_pad($codec[0], 7,"0", STR_PAD_LEFT);
       else:
         $codigo="0000001";
       endif;
       include("../conexion.php");
       $TotalSinAdmon=0;
       $TotalSinAdmon = round($subtotal- $ValorAdmon);
       $Sql="update zonacosto set basico='$Basico',tiempo='$TiempoExtra',tauxilio='$TiempoNoExtra',ayuda='$AyudaTransporte',tarp='$ValorArl',teps='$ValorEps',tpension='$ValorPension',caja='$ValorCaja',
             tsena='$ValorSena',ticbf='$ValorIcbf',prestacion='$ValorCensatiaPrima',tvacacion='$ValorVacacion',totalajusteparafiscal='$ValorAjuste',admon='$ValorAdmon',iva='$ivato',subtotal='$subtotal',
             grantotal='$grantotal',subtotalsinadmon='$TotalSinAdmon',contador='$ContadorEmpleado' where zonacosto.codigo='$NroCodigo'";
       $Ra=mysql_query($Sql)or die("Error al actualizar la tabla zona costo.");
       //ciclo de grabar
       for ($k=1 ; $k<=$tActualizaciones; $k ++){
           if   ($datos[$k] != "" ){
           $SqlA="update dezonacosto set basico='$salario[$k]',tiempo='$tiempo[$k]',tauxilio='$tauxilio[$k]',ayuda='$ayuda[$k]',ss='$arp[$k]',vlreps='$DatoEps[$k]',vlrpension='$pension[$k]',cp='$cp[$k]',vlrsena='$sena[$k]',
                   vlricbf='$icbf[$k]',ps='$ps[$k]',vacacion='$vacacion[$k]',ajusteparafiscal='$AjusteFiscal[$k]',admon='$admon[$k]' where dezonacosto.conse='$datos[$k]'";
            $Ractualizar=mysql_query($SqlA)or die("Error al actualizar el detallado del centro de costo.!");
          }
       }
               $registro=mysql_affected_rows();
               echo "<script language=\"javascript\">";
               echo "open (\"../pie.php?msg=Se Grabó $registro registro de la Zona: $zona\",\"pie\");";
               echo ("open (\"detalladocostoconsulta.php?codigo=$NroCodigo\" ,\"\");");
               echo ("open (\"ListadoCentroCosto.php?CodZona=$CodZona&Desde=$Desde&Hasta=$Hasta&baseiva=$baseiva\" ,\"_self\");");
               echo "</script>";
}
?>

