<!--<script language="javascript">
                function imprimir(numero)// para declara funcion
                {
                pagina='ImprimirCartaTraslado.php?NroCarta=' + numero
                tiempo=50
                ubicacion='_self'
                setTimeout("open(pagina,ubicacion)",tiempo)
                }
                </script>  -->
<input type="hidden" value="<?echo $UsuarioPreparador;?>" name="UsuarioPreparador" id="UsuarioPreparador">
<input type="hidden" value="<?echo $Estado;?>" name="Estado" id="Estado">
<?php
$Sw=0;
if($Estado=='Eps'){
     if(empty($CodEpsTraslado)){
	   ?>
	   <script language="javascript">
	       alert("Seleccione la Eps de la lista para el traslado.!")
	       history.back()
	   </script>
	   <?
     }else{
         $Sw=1;
         $PensionActual = '';
     }
}else{
    if(empty($CodPensionTraslado)){
      ?>
      <script language="javascript">
        alert("Seleccione el fondo de Pensión de la lista para el traslado.!")
        history.back()
      </script>
      <?
    }else{
      $Sw=1;
      $EpsActual = '';
    }
}
if($Sw==1){;
       include("../conexion.php");
       /*CODIGO QUE BUSCA LA EPS*/
       $SqlEps="select eps.eps  from eps where eps.codeps='$CodEpsTraslado'";
       $RsEps=mysql_query($SqlEps)or die("Error al validar la Eps.");
       $fila_E=mysql_fetch_array($RsEps);
       $EpsNueva = $fila_E["eps"];
       /*codigo que busca la pension*/
       $SqlPension="select pension.pension  from pension where pension.codpension='$CodPensionTraslado'";
       $RsPension=mysql_query($SqlPension)or die("Error al validar la pension.");
       $fila_P=mysql_fetch_array($RsPension);
       $PensionNueva = $fila_P["pension"];
       $Sql = "select count(*) from maestrocartatraslado";
       $Rs = mysql_query ($Sql);
       $sw = mysql_fetch_row($Rs);
       if ($sw[0]>0):
		$consulta = "select max(cast(nrocartatraslado as unsigned)) + 1 from maestrocartatraslado";
		$result = mysql_query($consulta) or die ("Fallo en la consulta");
		$IdCarta = mysql_fetch_row($result);
		$NroCartaT = str_pad ($IdCarta[0], 7, "0", STR_PAD_LEFT);
	else:
		$NroCartaT="0000001";
	endif;
	//$UsuarioPreparador= strtoupper($UsuarioPreparador);
	$FechaP=date('Y-m-d');
        $Estado = strtoupper($Estado);
        $ConSql="insert into maestrocartatraslado(nrocartatraslado,cedemple,empleado,zona,codepsactual,epsactual,codepsnueva,epsnueva,codpensionactual,pensionactual,codpensionnueva,pensionnueva,fechatraslado,fechaproceso,usuario,tipoproceso)
	values('$NroCartaT','$Documento','$Trabajador','$Zona','$CodEps','$EpsActual','$CodEpsTraslado','$EpsNueva','$CodPension','$PensionActual','$CodPensionTraslado','$PensionNueva','$FechaTraslado','$FechaP','$UsuarioPreparador','$Estado')";
	$RsI=mysql_query($ConSql)or die("Error al grabar el maestro de la Tabla.");
	if($Estado=='EPS'){
		$SqlA = "update empleado set codeps='$CodEpsTraslado' where empleado.cedemple='$Documento'";
		 $RsA = mysql_query($SqlA) or die("Error al actualizar el campo de la eps");
	}else{
       	 $SqlA = "update empleado set codpension='$CodPensionTraslado' where empleado.cedemple='$Documento'";
		 $RsA = mysql_query($SqlA) or die("Error al actualizar el campo del fondo de pension");	
	}
	$registro=mysql_affected_rows();
	echo "<script language=\"javascript\">";
	echo ("open (\"../cartalaboral/ImprimirCartaTraslado.php?NroCartaTraslado=$NroCartaT\" ,\"\");");
	echo "</script>";
	?>
	<script language="javascript">
	open("CartaTrasladoAdministradora.php?UsuarioPreparador=<?echo $UsuarioPreparador;?>","_self");
	</script>
        <?
}
?>

