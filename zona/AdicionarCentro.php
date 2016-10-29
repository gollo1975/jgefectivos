<?php
if(empty($CodCosto)){
   ?>
    <script language="javascript">
	alert("Seleccion el centro de costo de la Lista.!")
	history.back()
    </script>
   <?
}else{
	include("../conexion.php");
	/*CODIGO PARA BUSCAR CENTRO*/
	$SqlCentro="select costo.centro FROM costo WHERE costo.codcosto='$CodCosto'";
	$RsCentro=mysql_query($SqlCentro) or die("Error al buscar centro de costos.");
	$Fila=mysql_fetch_array($RsCentro);
	$Concepto= $Fila["centro"];
	/*FIN CODIGO*/
	/*CODIGO PARA VALIDAR CENTRO*/
	$SqlDato="select detalladoparametrocentrocosto.codigocosto FROM detalladoparametrocentrocosto WHERE
	    detalladoparametrocentrocosto.codigocosto='$CodCosto' and
	    detalladoparametrocentrocosto.nroparametro='$NroParametro'";
	$RsDato=mysql_query($SqlDato) or die("Error al buscar varios centros de costos.");
	$Cont = mysql_fetch_array($RsDato);
	/*FIN CODIGO*/
	if($Cont==0){
		$Sql="insert into detalladoparametrocentrocosto(codigocosto,concepto,nroparametro)
		   values('$CodCosto','$Concepto','$NroParametro')";
		$Rs=mysql_query($Sql)or die("Error al validar");
		echo "<script language=\"javascript\">";
		echo ("open (\"DetalleCentroCosto.php?CodZona=$CodZona\" ,\"_self\");");
		echo "</script>";
	}else{
	   	?>
		<script language="javascript">
		alert("Este centro de costo ya fue creado para esta empresa.!")
		history.back()
		</script>
		<?
        }
}
?>
