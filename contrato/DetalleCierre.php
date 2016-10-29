<html>
<head>
<title>Traslado de Administradora</title>
<LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
<?php
if(!Isset($Trabajador)){
	?>
	<center><h4><u>Cerrar Traslados de Administradoras</u></h4></center>
	<form  action="" method="post" id="IdInicio" name="IdInicio">
	    <input type="hidden" name="UsuarioPreparador" value="<? echo $UsuarioPreparador;?>" id="UsuarioPreparador">
	    <table border="0" align="center">
			<tr>
			<td><b>Documento:&nbsp;</b></td>
			<td><input type="text" name="Documento" value="<?echo $Documento;?>" size="15" class="cajas" maxlength="12" onfocus="ColorFoco(this.id)" readonly onblur="QuitarFoco(this.id)" id="Documento"></td>
			</tr>
			<tr>
			<td><b>Empleado:&nbsp;</b></td>
			<td><input type="text" name="Trabajador" value="<?echo $Empleado;?>" size="53" class="cajas" maxlength="50" onfocus="ColorFoco(this.id)" readonly onblur="QuitarFoco(this.id)" id="Trabajador"></td>
			</tr>
	                <tr>
			<td><b>Cerrar:&nbsp;</b></td>
			<td><select size="1" name="Cerrar" id="Cerrar" style="width: 106px" class="cajas">
                           <option value="<?echo $Estado;?>" selected><?echo $Estado;?>
	                    <option value="ABIERTO">ABIERTO</option>
	                    <option value="CERRADO">CERRADO</option>
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
     $Grabar ="update maestrocartatraslado set estadoproceso='$Cerrar',usuario='$UsuarioPreparador' where maestrocartatraslado.nrocartatraslado='$NroId'";
     $RGrabar=mysql_query($Grabar)or die("Error al actualizar el estado");
     echo "<script language=\"javascript\">";
     echo ("open (\"CerrarTrasladoAdministradora.php?UsuarioPreparador=$UsuarioPreparador\",\"_self\");");
     echo "</script>";
}
?>
</body>

</html>
