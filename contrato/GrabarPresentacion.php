<script language="javascript">
                function imprimir(numero)// para declara funcion
                {
                pagina='ImprimirCartaPresentacion.php?NroCarta=' + numero
                tiempo=50
                ubicacion='_self'
                setTimeout("open(pagina,ubicacion)",tiempo)
                }
                </script>
<input type="hidden" value="<?echo $UsuarioPreparador;?>" name="UsuarioPreparador" id="UsuarioPreparador">
<?php
if(empty($CodEps)){
   ?>
   <script language="javascript">
       alert("Seleccione la Eps de la lista.!")
       history.back()
   </script>
   <?
}elseif(empty($CodPension)){
   ?>
   <script language="javascript">
       alert("Seleccione el fondo de Pensión de la lista.!")
       history.back()
   </script>
   <?
}elseif(empty($CodCaja)){
    ?>
   <script language="javascript">
       alert("Seleccione la caja de compensación de la lista.!")
       history.back()
   </script>
   <?
}else{
       include("../conexion.php");
       /*CODIGO QUE BUSCA LA EPS*/
       $SqlEps="select eps.eps  from eps where eps.codeps='$CodEps'";
       $RsEps=mysql_query($SqlEps)or die("Error al validar la Eps.");
       $fila_E=mysql_fetch_array($RsEps);
       $Eps = $fila_E["eps"];
       /*codigo que busca la pension*/
       $SqlPension="select pension.pension  from pension where pension.codpension='$CodPension'";
       $RsPension=mysql_query($SqlPension)or die("Error al validar la pension.");
       $fila_P=mysql_fetch_array($RsPension);
       $Pension = $fila_P["pension"];
       /*codigo que valida la caja de compensacion*/
       $SqlCaja="select caja.nombre  from caja where caja.codigo_caja_pk='$CodCaja'";
       $RsCaja=mysql_query($SqlCaja)or die("Error al validar la caja.");
       $fila_C=mysql_fetch_array($RsCaja);
       $Caja = $fila_C["nombre"];
       /*fin codigo*/
       $Sql = "select count(*) from maestrocartapresentacion";
       $Rs = mysql_query ($Sql);
       $sw = mysql_fetch_row($Rs);
       if ($sw[0]>0):
		$consulta = "select max(cast(nrocarta as unsigned)) + 1 from maestrocartapresentacion";
		$result = mysql_query($consulta) or die ("Fallo en la consulta");
		$IdCarta = mysql_fetch_row($result);
		$NroCarta = str_pad ($IdCarta[0], 7, "0", STR_PAD_LEFT);
	else:
		$NroCarta="0000001";
	endif;
	//$UsuarioPreparador= strtoupper($UsuarioPreparador);
	$FechaP=date('Y-m-d');
	$ConSql="insert into maestrocartapresentacion(nrocarta,cedemple,empleado,lugarexpedicion,zona,cargo,codeps,eps,codpension,pension,codigo_caja_fk,caja,fechacontrato,fechaproceso,usuario,horaproceso)
	values('$NroCarta','$Documento','$Trabajador','$LugarExpedicion','$Zona','$Cargo','$CodEps','$Eps','$CodPension','$Pension','$CodCaja','$Caja','$FechaContratacion','$FechaP','$UsuarioPreparador','$FechaHora')";
	$RsI=mysql_query($ConSql)or die("Error al grabar el maestro de la Tabla.");
	$Editar = "update examen set horafinalproceso ='$FechaHora' where examen.nro='$NroExamen'";
	$RE=mysql_query($Editar)or die("Error AL EDICIONAR LA FECHA DE LA CARTA EN LA TABLA EXAMEN.");
	$EditarC = "update convenio set horafinalproceso ='$FechaHora' where convenio.nroconvenio='$NroConvenio'";
	$RC=mysql_query($EditarC)or die("Error al adicionar la fecha en el convenio.");
	$registro=mysql_affected_rows();
	echo "<script language=\"javascript\">";
	echo ("open (\"ImprimirCartaPresentacion.php?NroCarta=$NroCarta\" ,\"\");");
	echo "</script>";
	?>
	<script language="javascript">
	open("CartaPresentacion.php?UsuarioPreparador=<?echo $UsuarioPreparador;?>","_self");
	</script>
<?
}
?>

