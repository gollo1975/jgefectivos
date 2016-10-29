<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Formato de Solicitud DigitalLLLL</title>
<link rel="stylesheet" type="text/css" href="formatoNuevo.css"  />


</head>

<body>
<form id="form1" name="form1" method="post" action="procesos.php?opc=23" class = "forma">
	<div>
    	<input name="fecha" type="text" id="fecha" size="40" maxlength="10" placehonter ="Fecha" class = "caja" />
      	<input name="hora" type="text" id="hora" size="40" maxlength="10" placehonter ="Hora" class = "caja" />
	</div>
	<div>
	  	<select name="idProceso" id="idProceso" class = "caja">
	  		<?php foreach ($procesoP as $listarP)	{	?>
				<option value = "<?php echo $listarP -> idProceso;?>"><?php echo $listarP -> nombreProceso;?>
			<?	}	?>
      	</select>
		<select name="idRequisito" id="idRequisito" class = "caja">
	  		<?php foreach ($procesoR as $listarR)	{	?>
				<option value = "<?php echo $listarR -> idRequisito;?>"><?php echo $listarR -> nombreRequisito;?>
			<?	}	?>
		</select>
	</div>
	<div>
		<input name="solicitante" type="text" id="solicitante" size="40" maxlength="40"  placehonter ="Nombre del Solicitante" class = "caja" />
		<textarea name="solicitud" cols="40" rows="10" id="solicitud"  placehonter ="Solicitud" class = "caja"></textarea>
	</div>
	<div>
	    <input type="submit" name="Submit" value="Procesar" />
      	<input type="reset" name="Submit2" value="Restablecer" />
	</div>
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
