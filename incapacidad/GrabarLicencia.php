<?php
if(empty($Nota)){
	?>
	<script language="javascript">
	alert("Digite la nota o comentario del proceso a grabar.!" )
	history.back()
	</script>
	<?
}else{
	include("../conexion.php");
        $Sql="select licencia.fechainicio FROM licencia where
              licencia.fechainicio between '$Desde' and '$Hasta' and
              licencia.cedemple='$Cedula'";
        $Rs=mysql_query($Sql)or die ("Error al validar los contratos.");
         $Contador = mysql_num_rows($Rs);
        if($Contador==0){
             $Dias = strtotime($Hasta)- strtotime($Desde );
             $Diferencia_dias=intval($Dias/60/60/24) +1 ;
	     $FechaDia=date("Y-m-d");
             $Nota= strtoupper($Nota);
	     $consulta="insert into licencia(cedemple,empleado,codsala,concepto,codzona,fechainicio,fechafinal,dias,afectaauxilio,salario,nota,usuario,fechaproceso)
	         	values('$Cedula','$Empleado','$ConceptoNomina','$Concepto','$CodZona','$Desde','$Hasta','$Diferencia_dias','$Afecta',$Salario,'$Nota','$UsuarioSistema','$FechaDia')";
	     $resultado=mysql_query($consulta)or die("inserección incorrecta");
		?>
		<script language="javascript">
			alert("Registro Grabado Con Exito en el sistema.!")
			open("CrearLicencia.php?codigo=<?echo $UsuarioSistema;?>","_self");
		</script>
		<?
        }else{
             ?>
	    <script language="javascript">
		alert("Este empleado ya tiene otro proceso en esta fecha de inicio. Favor verificar.!" )
		history.back()
	    </script>
	    <?
        }
}
?>
 </body>
</html>
