<html>
<head>
<title>Grabando registro</title>
<LINK HREF="../estilo.css" REL="stylesheet"  type="text/css">
</head>
<body>
<?
include("../conexion.php");
$consulta="select licencia.* From licencia
where licencia.idlicencia='$NroId'";
$resultado=mysql_query($consulta)or die("Error al buscar la licencias");
$filas=mysql_fetch_array($resultado);
$auxem=$filas["cedemple"];
$Salario=$filas["basico"];
?>
<center><h4><u>EDITAR LICENCIA</u></h4></center>
<form action="GrabarEditadoLicencia.php" method="post">
	<input type="hidden" name="codigo" value="<?echo $codigo;?>">
	<table border="0" align="center">
		<tr>
		<td><b>Id_Licencia:</b></td>
		<td><input type="text" name="NroId" value="<?echo $NroId;?>" class="cajas" size="15"readonly  id="NroId"></td>
		</tr>
		<tr>
		<td><b>Documento:</b></td>
		<td><input type="text" name="Cedula" value="<?echo $Cedula;?>" class="cajas" size="15" readonly id="Cedula"></td>
		</tr>
		<tr>
		<td><b>Empleado:</b></td>
		<td><input type="text" name="Empleado" value="<?echo $Empleado;?>" class="cajas" size="45"readonly id="Empleado"></td>
		</tr>
              	<tr>
			<td><b>Tipo_Licencia:</b></td>
			<td><select name="TipoLicencia"class="cajas" id="TipoLicencia" style="width: 289px">
			<?
			$tuxI=$filas["codsala"];
			$consulta_i="select salario.codsala,salario.desala from salario where salario.validarlicencia='SI' and salario.estado='ACTIVO'  order by desala";
			$resultI=mysql_query($consulta_i)or die("Consulta  incorrecta");
			while($filasI=mysql_fetch_array($resultI)):
			if ($tuxI==$filasI["codsala"]):
			?>
			<option value="<?echo $filasI["codsala"];?>" selected><?echo $filasI["desala"];?>
			<?
			else:
			?>
			<option value="<?echo $filasI["codsala"];?>"><?echo $filasI["desala"];?>
			<?
			endif;
			endwhile;
			?> </selet></td>
		</tr>
		<tr>
		<td><b>F_Inicio:</b></td>
		<td><input type="text" name="Desde" value="<?echo $filas["fechainicio"];?>" class="cajas"  size="15" maxlength="10" id="Desde"></td>
		</tr>
		<tr>
		<td><b>F_final:</b></td>
		<td><input type="text" name="Hasta" value="<?echo $filas["fechafinal"];?>"class="cajas" size="15" maxlength="10" id="Hasta"></td>
		</tr>
		<tr>
		<td><b>Dias:</b></td>
		<td><input type="text" name="Dias" value="<?echo $filas["dias"];?>" class="cajas" size="15" maxlength="10" id="Dias" readonly></td>
		</tr>
		<tr>
			<td><b>Afecta_Auxilio:</b></td>
			<td><select name="Afecta" class="cajas" id="Afecta" style="width: 110px">
			<option vale="<? echo $filas ["afectaauxilio"];?>"selected><? echo $filas["afectaauxilio"];?>
			<option value="SI">SI
			<option value="NO">NO
			</select></td>
		</tr>
		<tr>
		<td><b>Nota:</b></td>
		<td><textarea name="Nota" cols="45" rows="3" class="cajas" id="Nota"><?echo $filas["nota"];?></textarea></td>
		</tr>
		<tr><td><br></td></tr>
		<tr>
		<td colspan="2">
		<input type="submit" value="Guardar" class="boton">
		<input type="reset" value="Limpiar" class="boton">
		</td>
		</tr>


	</table>

</form>
</body>
</html>
