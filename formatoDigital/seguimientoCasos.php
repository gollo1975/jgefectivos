<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<link rel="stylesheet" type="text/css" href="../estilo.css"  />
</head>
<body>

<?php foreach ($procesoS as $listarS)	{	
$var = $listarS -> idRequisito;
$var2 = $_REQUEST["UsuarioFinal"];
 ?>
 
<form id="form1" name="form1" method="post" action="procesos.php?opc=30&UsuarioFinal=<?php echo $UsuarioFinal;?>">
  <table width="700" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td colspan="4"><strong>Seguimiento de Casos Sistemas </strong></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td><strong><a href="procesos.php?opc=24&UsuarioFinal=<?php echo $UsuarioFinal;?>">Retornar</a></strong></td>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td width="192"><strong>C&oacute;digo</strong></td>
      <td colspan="3"><input name="idSolicitud" type="text" id="idSolicitud" value = "<?php echo $listarS -> idSolicitud;?>" /></td>
    </tr>
    <tr>
      <td><strong>Fecha Recibo </strong></td>
      <td><input name="fecha" type="text" id="fecha" value = "<?php echo $listarS -> fecha;?>" /></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><strong>Proceso</strong></td>
      <td width="188"><input name="nombreProceso" type="text" value = "<?php echo $listarS -> nombreProceso;?>" id="nombreProceso" /></td>
      <td width="131">Requisito</td>
      <td width="189"><input name="nombreRequisito" type="text" value = "<?php echo $listarS -> nombreRequisito;?>" id="nombreRequisito" /></td>
    </tr>
    <tr>
      <td><strong>Solicitante</strong></td>
      <td><input name="solicitante" type="text" value = "<?php echo $listarS -> solicitante;?>" id="solicitante" /></td>
      <td>&nbsp;</td>
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
      <td colspan="4"><textarea name="solicitud" cols="75" rows="6" id="solicitud"><?php echo $listarS -> solicitud;?></textarea></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><strong>Respuesta</strong></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="4"><textarea name="respuesta" cols="75" rows="6" id="respuesta"></textarea></td>
    </tr>
    <tr>
      <td><strong>Estado</strong></td>
      <td><select name="estado" id="estado">
        <option><?php echo $listarS -> estado;?></option>
		<option>Activo</option>
        <option>Tramite</option>
        <option>Cerrado</option>
            </select></td>
      <td><strong>Fecha</strong></td>
      <td><input name="fechaTerminacion" type="text" id="fechaTerminacion" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
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
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>
<?php	}	?>


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
	
		document.forms[0].fechaTerminacion.value = year+"-"+month+"-"+daym
</script>
</body>
</html>
