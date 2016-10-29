<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Formato de Solicitud Digital</title>
<link rel="stylesheet" type="text/css" href="../estilo.css"  />
</head>
<?php
 include("conexion.php");
 $Sql="select acceso.nombre FROM acceso
        where  acceso.usuario='$UsuarioSistema'";
$Rs=mysqli_query ($cnn, $Sql)or die("Error al buscar el usuario..");
$filaU = mysqli_fetch_array($Rs);
$Nombre =$filaU["nombre"]; 
 ?> 
<body>
<form id="form1" name="form1" method="post" action="procesos.php?opc=23">
 
  <table width="700" border="0" align="center" cellpadding="0" cellspacing="0">
  
    <tr>
      <td colspan="4"><strong>Formato Digital Solicitud de Sistemas </strong></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td><strong><a href="../../seguridad/menu.php">Retornar</a></strong></td>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td width="192">&nbsp;</td>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td><strong>Fecha</strong></td>
      <td><input name="fecha" type="text" id="fecha" size="20" maxlength="10" readonly /></td>
      <td><strong>Hora</strong></td>
      <td><input name="hora" type="text" id="hora" size="20" maxlength="10" readonly /></td>
    </tr>
    <tr>
      <td><strong>Proceso</strong></td>
      <td width="214"><select name="idProceso" id="idProceso">
	  	<?php foreach ($procesoP as $listarP)	{	?>
			<option value = "<?php echo $listarP -> idProceso;?>"><?php echo $listarP -> nombreProceso;?>
		<?	}	?>
      </select>      </td>
      <td width="105"><strong>Requisito</strong></td>
      <td width="189"><select name="idRequisito" id="idRequisito">
	  	  	<?php foreach ($procesoR as $listarR)	{	?>
			<option value = "<?php echo $listarR -> idRequisito;?>"><?php echo $listarR -> nombreRequisito;?>
			<?	}	?>
			</select></td>
    </tr>
    <tr>
      <td><strong>Solicitante</strong></td>
      <td colspan="2"><input name="solicitante" type="text" id="solicitante" size="40" maxlength="40" readonly="readonly" value="<? echo $Nombre;?>"/></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><strong>Solicitud</strong></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="4"><textarea name="solicitud" cols="75" rows="10" id="solicitud"></textarea></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>
        <input type="submit" name="Submit" value="Procesar" />      </td>
      <td><input type="reset" name="Submit2" value="Restablecer" /></td>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>

<script type="text/javascript">

	function show()	{
		
 		var Digital=new Date()
 		var hours=Digital.getHours()
 		var minutes=Digital.getMinutes()
 		var seconds=Digital.getSeconds()
 
 		if (minutes<=9)
		
			minutes="0"+minutes
 
 		if (seconds<=9)

			seconds="0"+seconds
 
 		document.form1.hora.value=hours+":"+minutes+":"+seconds

 		setTimeout("show()",1000)
 	}
 	show()
 </script>
 
 <script>	
		var mydate=new Date();	
		var year=mydate.getYear();	
		if (year < 1000)		

			year+=1900;	
	
		var day=mydate.getDay();	
		var month=mydate.getMonth()+1;	
		if (month<10)		

			month="0"+month;	

			var daym=mydate.getDate();	
		if (daym<10)		

		daym="0"+daym;	
	
		document.forms[0].fecha.value = year+"-"+month+"-"+daym
</script>

</body>
</html>
