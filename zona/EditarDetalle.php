<html>
<head>
<title>Editar Detalle</title>
<LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
<?php
if(!Isset($IdCodigo)){
	?>
	<center><h4><u>Editar Detalle</u></h4></center>
	<form  action="" method="post" id="IdInicio" name="IdInicio">
	    <input type="hidden" name="CodZona" value="<? echo $CodZona;?>" id="CodZona">
	    <table border="0" align="center">
			<tr>
			<td><b>Consecutivo:&nbsp;</b></td>
			<td><input type="text" name="IdCodigo" value="<?echo $Codigo;?>" size="15" class="cajas" readonly onfocus="ColorFoco(this.id)"  onblur="QuitarFoco(this.id)" id="IdCodigo"></td>
			</tr>
	                <tr>
			<td><b>Estado:&nbsp;</b></td>
			<td><select size="1" name="Cerrar" id="Cerrar" style="width: 106px" class="cajas">
                           <option value="<?echo $Estado;?>" selected><?echo $Estado;?>
	                    <option value="ACTIVO">ACTIVO</option>
	                    <option value="INACTIVO">INACTIVO</option>
	                    </select></td>
			</tr>
			<tr><td colspan="10"><br></td></tr>
			<tr>
			<td colspan="15">
			<input type="submit" value="Enviar Dato" class="boton" name="Grabar" id="Grabar"></td>
			</tr>
	     </table>
	</form>
<?
}else{
     include("../conexion.php");
     $Grabar ="update detalladoparametrocentrocosto set estado='$Cerrar' where detalladoparametrocentrocosto.id='$IdCodigo'";
     $RGrabar=mysql_query($Grabar)or die("Error al actualizar el estado");
     echo "<script language=\"javascript\">";
     echo ("open (\"DetalleCentroCosto.php?CodZona=$CodZona\",\"_self\");");
     echo "</script>";
}
?>
</body>

</html>
