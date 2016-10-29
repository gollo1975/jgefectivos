
<?
if (empty($total) and empty($grantotal)):
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
 $consulta="update cobrozona set total='$total',incapacidad='$incapacidad',anticipo='$anticipo',otros='$otro',ajuste='$ajuste',menorvlr='$menor',subtotal='$subtotal',ivatotal='$ivato',grantotal='$grantotal' where codigo='$codigo'";
 $resultad=mysql_query($consulta)or die("actualizacion errada en datos");

 for($j=1;$j<=$tActualizaciones;$j++ ):
    if ($datos[$j]!= ""):
    ?>
         <input type="text" value="<?echo $codzona;?>" name="codzona" class="cajas"size="11" maxlength="11">
         <input type="text" value="<?echo $desde;?>" name="desde" class="cajas"size="11" maxlength="11">
         <input type="text" value="<?echo $hasta;?>" name="hasta" class="cajas"size="11" maxlength="11">
         <input type="text" value="<?echo $total;?>" name="total" class="cajas"size="11" maxlength="11">
         <input type="text" value="<?echo $codigo;?>" name="codigo" class="cajas"size="11" maxlength="11">
         <input type="text" value="<?echo $datos[$j];?>" name="datos" class="cajas"size="11" maxlength="11">
         <input type="text" value="<?echo $salario[$j];?>" name="salario" class="cajas"size="11" maxlength="11">
         <input type="text" value="<?echo $tiempo[$j];?>" name="tiempo" class="cajas"size="11" maxlength="11">
          <input type="text" value="<?echo $ayuda[$j];?>" name="ayuda" class="cajas"size="11" maxlength="11">
         <input type="text" value="<?echo $arp[$j];?>" name="arp" class="cajas"size="11" maxlength="11">
         <input type="text" value="<?echo $eps[$j];?>" name="eps" class="cajas"size="11" maxlength="11">
         <input type="text" value="<?echo $pension[$j];?>" name="pension" class="cajas"size="11" maxlength="11">
         <input type="text" value="<?echo $cp[$j];?>" name="cp" class="cajas"size="11" maxlength="11">
         <input type="text" value="<?echo $ps[$j];?>" name="ps" class="cajas"size="11" maxlength="11">
         <input type="text" value="<?echo $admon[$j];?>" name="admon" class="cajas"size="11" maxlength="11">
         <input type="text" value="<?echo $ivatotal[$j];?>" name="ivatotal" class="cajas"size="11" maxlength="11">
         <input type="text" value="<?echo $nove[$j];?>" name="nove" class="cajas"size="11" maxlength="11">
         <?
         $con="update decobrozona set basico='$salario[$j]',tiempo='$tiempo[$j]',ayuda='$ayuda[$j]',ss='$arp[$j]',vlreps='$eps[$j]',vlrpension='$pension[$j]',cp='$cp[$j]',ps='$ps[$j]',admon='$admon[$j]',iva='$ivatotal[$j]',codigo='$codigo',nove='$nove[$j]' where decobrozona.conse='$datos[$j]' and decobrozona.codigo='$codigo'";
          $resulta=mysql_query($con)or die("Inserccion incorrecta 2 $con");
     endif;
   endfor;
   $registro=mysql_affected_rows();
           echo "<script language=\"javascript\">";
           echo "open (\"../pie.php?msg=Se Grabó $registro registro de la Zona: $zona\",\"pie\");";
           echo ("open (\"modificarfactura.php\",\"_self\");");
           echo "</script>";

 endif;
?>

