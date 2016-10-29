<html>
<head>
<title>Modificacion de Salario</title>
<LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<?
if (!isset($NitProve)):
	include("../conexion.php");
	?> <center><h4><u>Editar tipo de Examen</u></h4></center>
	<form action="" method="post">
		<table border="0" align="center">
			<tr>
			<td colspan="2"><br></td>
			</tr>
			<tr>
				<td><b>Proveedor:</b></td>
				<td colspan="1"><select name="NitProve" class="cajasletra" style="width: 404px" id="NitProve">
				<option value="0">Seleccione el Proveedor
				<?
				$consulta_z="select nitprove,nomprove from provedor where alianzaexamen='SI'  order by nomprove";
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
			<tr><td>&nbsp;</td></tr>
			<tr>
			<td colspan="2"><input type="submit" Value="Buscar" class="boton">&nbsp;<input type="reset" Value="Limpiar" class="boton"></th>
			</tr>
		</table>
	</form>
	<?
elseif (empty($NitProve)):
	?>
	<script language="javascript">
	alert("Seleccione el proveedor de la lista.")
	history.back()
	</script>
	<?
elseif (empty($CodMuni)):
	?>
	<script language="javascript">
	alert("Seleccione el Municipio de la Lista.")
	history.back()
	</script>
	<?
else:
	include("../conexion.php");
        /*Codigo de Proveedor*/
	$con="select provedor.nomprove from provedor where nitprove='$NitProve'";
	$resu=mysql_query($con)or die ("Error de Proveedor");
	$filaP= mysql_fetch_array($resu);
        $Proveedor = $filaP["nomprove"];
         /*Codigo de Proveedor*/
	$sql="select municipio.municipio from municipio where municipio.codmuni='$CodMuni'";
	$Rs=mysql_query($sql)or die ("Error de municipio");
        $filaM = mysql_fetch_array($Rs);
        $Municipio = $filaM["municipio"];
	?>
	<center><h4><u>Modificar Registro</u></h4></center>
	<table border="0" align="center">
		<tr>
			<td><b>Proveedor:</b></td>
			<td><input type="text" value="<?echo $Proveedor;?>" size="45"  class="cajas" readonly></td>
		</tr>
                <tr>
			<td><b>Municipio:</b></td>
			<td><input type="text" value="<?echo $Municipio;?>" size="45"  class="cajas" readonly></td>
		</tr>
		</table>
		<?

		/*codigo de busqueda el proveedor*/
		$con1="select examenglobal.* from examenglobal,provedor,municipio
		where provedor.nitprove=examenglobal.nitprove and
		provedor.nitprove='$NitProve' and
                examenglobal.codmuni=municipio.codmuni and
                examenglobal.codmuni='$CodMuni' order by examenglobal.descripcion ";
		$resu1=mysql_query($con1)or die ("Error al buscar provedores");
		$reg1=mysql_num_rows($resu1);
		if($reg1!=0):
			?>
			<form action="eliminar.php" method="post">
                               <input type="hidden" value="<?echo $NitProve;?>" name="NitProve">
                               <input type="hidden" value="<?echo $CodMuni;?>" name="CodMuni">
				<table border="1" align="center">
					<tr class="cajas">
					<th><br></th><th><b><u>Conse.</u></b></th><th><b>&nbsp;<u>Descripción</u></b></th><th><b><u>Valor</u></b></th><th><b><u>Estado</u></b></th>
					</tr>
					<?
					while ($filas_s = mysql_fetch_array($resu1)):
					$valor=number_format($filas_s["valor"],0);
					?>
					<tr class="cajas">
					<input type="hidden" name="DatoB" value="<? echo $filas_s["conse"];?>">
					<td><a href="DetalladoModificar.php?DatoB=<?echo $filas_s["conse"];?>&NitProve=<?echo $NitProve;?>&CodMuni=<?echo $CodMuni;?>&conse=<?echo $filas_s["conse"];?>&Proveedor=<?echo $Proveedor;?>"><img src="../image/mod.jpg" border="0" alt="Permite Modificar el Registro"></a></td><td><div align="center"><?echo $filas_s["conse"];?></div></td>
					<td><?echo $filas_s["descripcion"];?></td>
					<td><div align="right">$<?echo $valor;?></div></td>
					<td><div align="center"><?echo $filas_s["estado"];?></div></td>

					</tr>
					<?
					endwhile;
					?>
				</table>
				<div align="center"><h4><b><font color="green"><a href="ModificarAdmon.php"><u>Volver</u></font></b></h4></div>
		      </form>
		   <?
		else:
		   ?>
			<script language="javascript">
			alert("Este Proveedor no tiene centro de examenes creados ?")
			history.back()
			</script>
			<?
		endif;
endif;
?>
</body>
</html>
