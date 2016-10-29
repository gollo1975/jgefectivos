
<?
if (empty($total) and empty($GranTotal)):
   ?>
         <script language="javascript">
           alert("Los campos SUBTOTAL Y GRAN TOTAL, no pueden estar vacio ?")
           history.back()
         </script>
         <?
elseif (empty($datos)):
   ?>
         <script language="javascript">
           alert("Debe de Chequear los campos que va a modificar?")
           history.back()
         </script>
         <?
 else:
 include("../conexion.php");
 $consulta="update cobrozona set total='$total',incapacidad='$incapacidad',anticipo='$anticipo',otros='$otro',ajuste='$ajuste',menorvlr='$menor',subtotalsinadmon='$TotalSinAdmon',admon='$total13',subtotal='$subtotal',ivatotal='$IvaPagar',grantotal='$GranTotal',contador='$ContadorEmpleado' where codigo='$CodigoIngreso'";
 $resultad=mysql_query($consulta)or die("actualizacion errada en datos");

 for($j=1;$j<=$tActualizaciones;$j++ ):
    if ($datos[$j]!= ""):
          $con="update decobrozona set basico='$salario[$j]',tiempo='$tiempo[$j]',tauxilio='$tauxilio[$j]',ayuda='$ayuda[$j]',
                vlrarp='$arp[$j]',vlrsena='$sena[$j]',vlricbf='$icbf[$j]',vlreps='$eps[$j]',vlrpension='$pension[$j]',cajac='$cp[$j]',
                ps='$ps[$j]',vacacion='$vacacion[$j]',ajusteparafiscal='$AjusteParafiscal[$j]',admon='$admon[$j]',novedadingreso='$NovedadIngreso[$j]',novedadretiro='$NovedadRetiro[$j]', diasincapacidadgeneral='$DiasIG[$j]', diasincapacidadlaboral='$DiasIL[$j]', nivelriesgo='$NivelArl[$j]' where decobrozona.conse='$datos[$j]' and decobrozona.codigo='$CodigoIngreso'";
          $resulta=mysql_query($con)or die("Inserccion incorrecta 2 $con");
     endif;
endfor;
   $registro=mysql_affected_rows();
           echo "<script language=\"javascript\">";
           echo "open (\"../pie.php?msg=Se Grabó $registro registro de la Zona: $zona\",\"pie\");";
           echo ("open (\"modificarfacturaparafiscal.php\",\"_self\");");
           echo "</script>";

 endif;
?>

