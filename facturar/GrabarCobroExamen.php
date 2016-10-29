<?
if(empty($datoN)){
   ?>
   <script language="javascript">
      alert("Debe de chequear las diferentes cajas de verificacion para generar el Documento.!")
      history.back()
   </script>
   <?
}else{
     include("../numeros.php");
     $letras=num2letras($ValorTotal);
     $letras=strtoupper($letras);
     $Nota=strtoupper($Nota);
     $FechaV=date("Y-m-d");
	include("../conexion.php");
	$consulta = "select count(*) from relacionexamen";
	$result = mysql_query ($consulta);
	$sw = mysql_fetch_row($result);
	if ($sw[0]>0):
		$consulta = "select max(cast(radicado as unsigned)) + 1 from relacionexamen";
		$result = mysql_query($consulta) or die ("Fallo en la consulta");
		$codco = mysql_fetch_row($result);
		$Nroc = str_pad ($codco[0], 6, "0", STR_PAD_LEFT);
	else:
		$Nroc="000001";
	endif;
	$consulta="insert into relacionexamen (radicado,codzona,zona,nota,letras,fechap,total,contador)
	        values('$Nroc','$CodZona','$Zona','$Nota','$letras','$FechaV','$ValorTotal','$TotalR')";
	$resultado=mysql_query($consulta)or die("Error al grabar el cobro de los examenes!");
	$registro=mysql_affected_rows();
	for ($k=1 ; $k<=$TotalR; $k ++){
	    if   ($datoN[$k] != ""){
	        $con="insert into derelacionexamen(nro,cedemple,empleado,valor,radicado,fechae)
		values('$datoN[$k]','$Documento[$k]','$Empleado[$k]','$CostoE[$k]','$Nroc','$F_Examen[$k]')";
		$resulta=mysql_query($con)or die("Error al grabar el detalle del cobro de los examenes medicos.! ");
		$registro=mysql_affected_rows();
	     $Act="update examen set posicion='PAGADO' where examen.nro='$datoN[$k]'";
	     $RegA=mysql_query($Act)or die("Error al actualizar la tabla examenes");
            }
        }
        echo "<script language=\"javascript\">";
	echo ("open (\"imprimircobroexamen.php?NroCobro=$Nroc\" ,\"\");");
	echo "</script>";
	?>
	              <script language="javascript">
	              	open("CobrarZonaExamen.php","_self");
	             </script>
	<?
}
?>
