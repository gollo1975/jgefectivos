<html>
<head>
<title>Anular Examen</title>
<LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
<?php
if(empty($DatosE)){
     ?>
	    <script language="javascript">
	       alert("Favor chequear el registro para la anulación.!")
	       history.back()
	    </script>
	    <?
}else{
       include("../conexion.php");
        $Sql="select acceso.* from acceso
	where acceso.usuario='$CodUsuario'";
	$Rs=mysql_query($Sql)or die ("Error al buscar los usuarios");
	$fila_U=mysql_fetch_array($Rs);
	$Nivel=$fila_U["codigo"];
	if($Nivel == 10){
	     $lista=$_POST["DatosE"];
	     foreach ($lista as $Dato){
		       $conB="select examen.* from examen
			where examen.nro='$Dato' and examen.estado='ACTIVO' and examen.cobrarexamen='NO'";
			$resuB=mysql_query($conB)or die ("Error al buscar examen");
                        $Cont = mysql_num_rows($resuB);
			$filas=mysql_fetch_array($resuB);
	     }
             if($Cont!= 0){
			?>
			<center><h4><u>Anular Examen</u></h4></center>
			<form  action="GrabarAnular.php" method="post" id="IdInicio" name="IdInicio">
			<input type="hidden" name="CodUsuario" value="<? echo $CodUsuario;?>" id="CodUsuario">
			<table border="0" align="center">
	                	<tr>
			<td><b>Nro_Examen:&nbsp;</b></td>
			<td><input type="text" name="NroExamen" value="<?echo $filas["nro"];?>" size="15" class="cajas"  onfocus="ColorFoco(this.id)" readonly onblur="QuitarFoco(this.id)" id="NroExamen"></td>
			</tr>
			<tr>
			<td><b>Documento:&nbsp;</b></td>
			<td><input type="text" name="Documento" value="<?echo $filas["cedula"];?>" size="15" class="cajas"  onfocus="ColorFoco(this.id)" readonly onblur="QuitarFoco(this.id)" id="Documento"></td>
			</tr>
			<tr>
			<td><b>Empleado:&nbsp;</b></td>
			<td><input type="text" name="Trabajador" value="<?echo $filas["nombre"];?>" size="53" class="cajas" onfocus="ColorFoco(this.id)" readonly onblur="QuitarFoco(this.id)" id="Trabajador"></td>
			</tr>
			<tr>
			<td><b>Cerrar:&nbsp;</b></td>
			<td><select size="1" name="Cerrar" id="Cerrar" style="width: 106px" class="cajas">
			<option value="<?echo $filas["estado"];?>" selected><?echo $filas["estado"];?>
			<option value="ACTIVO">ACTIVO</option>
			<option value="ANULADO">ANULADO</option>
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
                  ?>
		    <script language="javascript">
		       alert("Este registro ya esta anulado en sistema o ya se le cobro a la zona. Favor validar.!")
		       history.back()
	    	    </script>
	         <?
             }
	}else{
	    ?>
	    <script language="javascript">
	       alert("Usted no tiene permiso para ANULAR el examen médico. Validar con sistemas.!")
	       history.back()
	    </script>
	    <?
	}
}
?>

</body>

</html>
