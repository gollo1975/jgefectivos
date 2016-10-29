<?
session_start();
?>
<LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
<?
// if(session_is_registered("xsession")):
	if(empty($DatoB)):
		?>
		<script language="javascript">
		alert("Debe de Seleccionar un Item ?")
		history.back()
		</script>
		<?
	else:
		include("../conexion.php");
		$consulta="select examenglobal.* from examenglobal
		where examenglobal.conse='$DatoB'";
		$resultado=mysql_query($consulta) or die ("Error al busca datos");
		$registros=mysql_affected_rows();
		if ($registros!=0):
			?>
			<center><h4><u>Modificar Datos</u></h4></center>
			<?
			while ($filas_s=mysql_fetch_array($resultado)):
				?>
				<form action="GrabarEditado.php" method="post">
                                <input type="hidden" value="<?echo $NitProve;?>" name="NitProve">
                                <input type="hidden" value="<?echo $CodMuni;?>" name="CodMuni">
				<table border="0" align="center">
				<tr><td><br></td></tr>
				<tr>
				<td><b>Codigo:</b></td>
				<td colspan=3><input type="text" value="<?echo $filas_s["conse"];?>" size="15"name="codigo" class="cajas" readonly id="codigo"></td>
				</tr>
				<tr>
				<td><b>Descripción:</b></td>
				<td colspan=3><input type="text" value="<?echo $filas_s["descripcion"];?>"class="cajas" name="descripcion" size="63" maxlength="60 " class="cajas"></td>
				</tr>
				<tr>
				<td><b>Valor:</b></td>
				<td colspan=3><input type="text" value="<?echo $filas_s["valor"];?>" class="cajas"name="valor"size="15" maxlength="11"></td>
				</tr>
				<tr>
				<td><b>Estado</b></td>
				<td><select name="EstadoE" class="cajasletra" id="EstadoE" style="width: 110px">
				<option value="<?echo $filas_s["estado"];?>" selected><?echo $filas_s["estado"];?>
				<option value="ACTIVO">ACTIVO
				<option value="INACTIVO">INACTIVO
				</select></td>
				</tr>
				<tr>
				<td><b>Municipio:</b></td>
				<td colspan="10"><select name="CodMunicipio"class="cajas" style="width: 400px" id="CodMunicipio">
				<?
				$aux=$CodMuni;
				$consulta_c="select codmuni,municipio from municipio order by municipio";
				$resultado_c=mysql_query($consulta_c) or die("consulta de Costo Incorrecta");
				while ($filas_c=mysql_fetch_array($resultado_c)){
                                    if($aux==$filas_c["codmuni"]){
					?>
					<option value="<?echo $filas_c["codmuni"];?>" selected><?echo $filas_c["municipio"];?>
					<?
				    }else{
					?>
					<option value="<?echo $filas_c["codmuni"];?>"><?echo $filas_c["municipio"];?>
					<?
				    }
				}
				?>
				</select></td>
				</tr>
				<tr><td><br></td></tr>
				<tr>
				<td colspan="5"><input type="submit" value="Guardar" class="boton"></td>
				</tr>
				</table>
				</form>
                                	<div align="center"><h4><b><font color="green"><a href="ModificarAdmon.php"><u>Volver</u></font></b></h4></div>

				<?
			endwhile;
		endif;
	endif;
/*else:
	?>
	<script language="javascript">
	alert("Debe de hacer Inicio de Sección")
	pagina='../acceso/agregar.php'
	tiempo=10
	ubicacion='_self'
	setTimeout("open(pagina,ubicacion)",tiempo)
	</script>
	<?
endif;    */
?>
