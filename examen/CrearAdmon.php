<html>
<head>
<title>Matricular Servicios</title>
<LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
<script language="javascript">
	function ColorFoco(obj)
	{
	document.getElementById(obj).style.background="#9DFF9D"

	}

	function QuitarFoco(obj)
	{
	document.getElementById(obj).style.background="white"
	}

	function chequearcampos()
	{
	if (document.getElementById("concepto").value.length <=0)
	{
	alert ("Digite la descripcion del examen.");
	document.getElementById("concepto").focus();
	return;
	}
	if (document.getElementById("valor").value.length <=0)
	{
	alert ("Digite el valor del Examen, segun convenio");
	document.getElementById("valor").focus();
	return;
	}

	document.getElementById("matexamen").submit();

}
</script>
</head>
<body>
<?
if (!isset($concepto)):
	include("../conexion.php");
	?>
	<center><h4><u>Examenes Medicos X Proveedor</u></h4></center>
	<form action="" method="post"id="matexamen">
		<table border="0" align="center"
                	<tr><td><br></td></tr>
                <tr>
			<td><b>Proveedor:</b></td>
			<td colspan="1"><select name="Proveedor" class="cajasletra" id="Proveedor" style="width: 404px">
			<option value="0">Seleccione el Proveedor
			<?
			$consulta_z="select nitprove,nomprove from provedor where provedor.alianzaexamen='SI'  order by provedor.nomprove";
			$resultado_z=mysql_query($consulta_z) or die("Error al buscar proveedor");
			while ($filas_z=mysql_fetch_array($resultado_z)):
				?>
				<option value="<?echo $filas_z["nitprove"];?>"><?echo $filas_z["nomprove"];?>
				<?
			endwhile;
			?>
			</select></td>
		</tr>
                 <tr>
			<td><b>Municipio:</b></td>
			<td colspan="1"><select name="CodMuni" class="cajasletra" id="CodMuni" style="width: 404px">
			<option value="0">Seleccione el Municipio
			<?
			$Sql="select codmuni,municipio from municipio order by municipio.municipio";
			$Rs=mysql_query($Sql) or die("Error al buscar la ciudad");
			while ($fila=mysql_fetch_array($Rs)):
				?>
				<option value="<?echo $fila["codmuni"];?>"><?echo $fila["municipio"];?>
				<?
			endwhile;
			?>
			</select></td>
		</tr>
		<tr>
		<td><b>Descripción:</b></td>
		<td><input type="text" name="concepto" value="" size="64" maxlength="60" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="concepto">
		</tr>
		<tr>
		<td><b>Valor_Examen:</b></td>
		<td><input type="text" name="valor" value="" size="15" maxlength="11" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="valor">
		</tr>
		<tr>
		<tr><td>&nbsp;</td></tr>
		<tr>
		<td colspan="2"><input type="button" Value="Guardar" class="boton" onclick="chequearcampos()">&nbsp;<input type="reset" Value="Limpiar"class="boton"></td>
		</tr>
		<tr><td><br></td></tr>

		</table>

	</form>
	<?
elseif(empty($Proveedor)):
	?>
	<script language="javascript">
	alert("Seleccion el proveedor de la lista..")
	history.back()
	</script>
	<?
elseif(empty($CodMuni)):
	?>
	<script language="javascript">
	alert("Seleccion el Municipio de la lista.")
	history.back()
	</script>
	<?
else:
	$fechap=date("Y-m-d");
	$concepto=strtoupper($concepto);
	include("../conexion.php");
	$consulta="insert into examenglobal (descripcion,valor,nitprove,codmuni,fechap)
	value('$concepto','$valor','$Proveedor','$CodMuni','$fechap')";
	$resultado=mysql_query($consulta) or die("Error al validar los ingresos de los examenes.");
	$re=mysql_affected_rows();
	echo "<script language=\"javascript\">";
	echo "open(\"CrearAdmon.php\",\"_self\");";
	echo "</script>";
endif;
?>
</body>
</html>
