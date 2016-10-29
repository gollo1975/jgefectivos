<?
if(empty($Vector)){
   ?>
   <script language="javascript">
      alert("Debe de chequea al menos una caja de verificación para pocesar el registro.!")
      history.back()
   </script>
   <?
}elseif(empty($CodZona)){
   ?>
   <script language="javascript">
      alert("Seleccione una zona de la lista.!")
      history.back()
   </script>
   <?
}else{
   include("../numeros.php");
   $letras=num2letras($VlrPagado);
   $letras=strtoupper($letras);
   $FechaV=date("Y-m-d");
   include("../conexion.php");
   $SqlBuscar="select parametrocentrocosto.codzona FROM parametrocentrocosto WHERE parametrocentrocosto.codzona='$CodZona'";
   $RsBuscar=mysql_query($SqlBuscar)or die ("Error al buscar zona");
   $Con=mysql_num_rows($RsBuscar);
   if($Con==0){
	   $consulta = "select count(*) from parametrocentrocosto";
	        $result = mysql_query ($consulta);
	        $sw = mysql_fetch_row($result);
	        if ($sw[0]>0):
	           $consulta = "select max(cast(nroparametro as unsigned)) + 1 from parametrocentrocosto";
	           $result = mysql_query($consulta) or die ("Fallo en la consulta");
	           $codco = mysql_fetch_row($result);
	           $Nroc = str_pad ($codco[0], 5, "0", STR_PAD_LEFT);
	        else:
	          $Nroc="00001";
	        endif;
	       $Sql="insert into parametrocentrocosto(nroparametro,codzona,fechap)
	                   values('$Nroc','$CodZona','$FechaV')";
	        $Rs=mysql_query($Sql)or die("insercción incorrecta de parametrocentrocosto");
	        $registro=mysql_affected_rows();
	        for ($k=1 ; $k<=$Total; $k ++){
	           if   ($Vector[$k] != ""){
	                     $con="insert into detalladoparametrocentrocosto(codigocosto,concepto,nroparametro)
	                     values('$Vector[$k]','$Concepto[$k]','$Nroc')";
	                     $resulta=mysql_query($con)or die("Error al grabar el detalle del parametrocentrocosto");
	                     $registro=mysql_affected_rows();
	           }
	        }
	        echo "<script language=\"javascript\">";
	        echo ("open (\"ParametroCentroCosto.php\" ,\"_self\");");
	        echo "</script>";
   }else{
      ?>
		<script language="javascript">
		alert("Esta zona ya se le agrego los centro de costos iniciales, favor editarlos.!")
                history.back()
		</script>
     <?
   }
}
?>
