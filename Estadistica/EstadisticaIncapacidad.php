<?php
include("../conexion.php");
if (!isset($Documento)){
	?>
	<script language="javascript">
	function ColorFoco(obj)
	{
	document.getElementById(obj).style.background="#9DFF9D"

	}
	function QuitarFoco(obj)
	{
	document.getElementById(obj).style.background="white"
	}
	function Validar(){
	if (document.getElementById("Documento").value.length <=0)
	{
	alert ("Digite el documento del emplead para la consulta.!");
	document.getElementById("Documento").focus();
	return;
	}
	document.getElementById("Inicio").submit();
	}
	</script>
	<LINK HREF="../estilo.css" REL="stylesheet"  type="text/css">
	<center><h4><u>Estadistica Incapacidades / Licencias</u></h4></center>
	<form action="" method="post" name="Inicio" id="Inicio">
	<table border="0" align="center">
	<tr><td><br></td></tr>
	<tr>
	<td><b>Documento de Identidad:&nbsp;<b></td>
	<td><input type="text" name="Documento" value="" size="15" maxlength="15" class="cajas" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="Documento"></td>
	</tr>
	</tr>
         <?if($codigo==''){?>
        <tr>
		<td><b>Desde:&nbsp;<b></td>
		<td><input type="text" name="Desde" value="<?echo date('Y-m-d');?>" size="15" maxlength="15" class="cajas" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="Desde"></td>
	        <td><b>Desde:&nbsp;<b></td>
		<td><input type="text" name="Hasta" value="<?echo date('Y-m-d');?>" size="15" maxlength="15" class="cajas" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="Desde"></td>
	</tr>
        <?}?>
        <tr>
		<td><b>Tipos incapacidad:</b></td>
		<td colspan="5"><select name="CodIncapacidad" class="cajasletra" id="CodIncapacidad" style="width: 266px">
		<?
		$consulta="select tipoinca.* from tipoinca ";
		$resultado=mysql_query($consulta) or die("Error al buscar tipos de incapacidad");
		while ($fila=mysql_fetch_array($resultado))
	         	{
			?>
			<option value="<?echo $fila["tipoinca"];?>"><?echo $fila["concepto"];?>
			<?
		}
		?>
		</select></td>
        </tr>
         <?if($codigo==''){?>
	        <tr>
	           <td><b>Tipo busqueda</b></td>
	           <td><input type="radio" value="Fecha" name="TipoBusqueda">&nbsp;Fechas</td>
	        </tr>
        <?}?>
	<tr><td><br></td></tr>
	<tr>
	<td colspan="9"><input type="button" Value="Buscar Dato" class="boton" onclick="Validar()" > <input type="reset" Value="Limpiar" class="boton"></td>
	</tr>
	</table>
	</form>
<?
}else{
if($codigo==''){
	if($TipoBusqueda=='Fecha'){
	    $Sql = "select tipoinca.concepto , concat(nomemple, ' ' ,nomemple1, ' ' ,apemple, ' ' , apemple1) as Empleado from tipoinca,empleado,incapacidad where
	        empleado.cedemple=incapacidad.cedemple and
	        incapacidad.tipoinca=tipoinca.tipoinca and
	        incapacidad.fechaini between '$Desde' and '$Hasta' and
	        empleado.cedemple='$Documento' and
	        tipoinca.tipoinca='$CodIncapacidad'";
	}else{
	    $Sql = "select tipoinca.concepto , concat(nomemple, ' ' ,nomemple1, ' ' ,apemple, ' ' , apemple1) as Empleado from tipoinca,empleado,incapacidad where
	        empleado.cedemple=incapacidad.cedemple and
	        incapacidad.tipoinca=tipoinca.tipoinca and
	        empleado.cedemple='$Documento' and
	        tipoinca.tipoinca='$CodIncapacidad'";
	}
}else{
     $Sql = "select tipoinca.concepto , concat(nomemple, ' ' ,nomemple1, ' ' ,apemple, ' ' , apemple1) as Empleado from tipoinca,empleado,incapacidad,zona where
        empleado.cedemple=incapacidad.cedemple and
        incapacidad.tipoinca=tipoinca.tipoinca and
        incapacidad.codzona=zona.codzona and
        empleado.cedemple='$Documento' and
        tipoinca.tipoinca='$CodIncapacidad' and
        zona.codzona='$codigo'";
}
$Rs = mysql_query($Sql)or die("Error de busqueda");
$NroIncapacidad = mysql_num_rows($Rs);
$Vector = mysql_fetch_array($Rs);
$Concepto = $Vector["concepto"];
$Empleado = $Vector["Empleado"];
if($NroIncapacidad != 0){
	?>
	<!DOCTYPE HTML>
	<html>
		<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			<title>Reporte estadistico de incapacidades </title>

			<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
			<style type="text/css">
	${demo.css}
			</style>
			<script type="text/javascript">
	$(function () {
	    $('#container').highcharts({
	        title: {
	            text: 'Estadistica de incapacidades',
	            x: -20 //center
	        },
	        subtitle: {
	            text: 'Empleado: <?echo $Empleado;?>',
	            x: -20
	        },
	        xAxis: {
	            categories: [
	                  <?
	                  if($TipoBusqueda=='Fecha'){
	                      $Sql = mysql_query("select incapacidad.*, tipoinca.concepto from incapacidad,tipoinca,empleado where empleado.cedemple=incapacidad.cedemple and tipoinca.tipoinca=incapacidad.tipoinca and incapacidad.cedemple='$Documento' and incapacidad.tipoinca='$CodIncapacidad' and  incapacidad.fechaini between '$Desde' and '$Hasta'  order by incapacidad.fechaini ASC");
	                  }else{
	                      $Sql = mysql_query("select incapacidad.*, tipoinca.concepto from incapacidad,tipoinca,empleado where empleado.cedemple=incapacidad.cedemple and tipoinca.tipoinca=incapacidad.tipoinca and incapacidad.cedemple='$Documento' and incapacidad.tipoinca='$CodIncapacidad'  order by incapacidad.fechaini ASC");
	                  }
	                  while($Registro =mysql_fetch_array($Sql)){
	                     ?>
	                      ['<?echo $Registro['fechaini'];?>'],
	                     <?
	                     }
	                    ?>
	               ]
	        },
	        yAxis: {
	            title: {
	                text: 'Valor limite Incapacidad'
	            },
	            plotLines: [{
	                value: 0,
	                width: 1,
	                color: '#808080'
	            }]
	        },
	        tooltip: {
	            valueSuffix: 'Dias'
	        },
	        legend: {
	            layout: 'vertical',
	            align: 'right',
	            verticalAlign: 'middle',
	            borderWidth: 0
	        },
	        series: [{
	            name: '<?echo $Concepto?> <?echo $NroIncapacidad?>',
	            data: [
	                  <?
	                 if($TipoBusqueda=='Fecha'){
	                      $Sql = mysql_query("select incapacidad.*, tipoinca.concepto from incapacidad,tipoinca,empleado where empleado.cedemple=incapacidad.cedemple and tipoinca.tipoinca=incapacidad.tipoinca and incapacidad.cedemple='$Documento' and incapacidad.tipoinca='$CodIncapacidad' and  incapacidad.fechaini between '$Desde' and '$Hasta'  order by incapacidad.fechaini ASC");
	                  }else{
	                      $Sql = mysql_query("select incapacidad.*, tipoinca.concepto from incapacidad,tipoinca,empleado where empleado.cedemple=incapacidad.cedemple and tipoinca.tipoinca=incapacidad.tipoinca and incapacidad.cedemple='$Documento' and incapacidad.tipoinca='$CodIncapacidad'  order by incapacidad.fechaini ASC");
	                  }
	                  while($Registro =mysql_fetch_array($Sql)){
	                     ?>
	                      ['<?echo $Registro['concepto'];?>', <?echo $Registro['dias']?>],
	                     <?
	                     }
	                    ?>

	                ]

	        }]
	    });
	 });
      </script>
	</head>
	<body>
	<script src="Highcharts/js/highcharts.js"></script>
	<script src="Highcharts/js/modules/exporting.js"></script>

	<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

	</body>
	</html>
	<?
	}else{
             ?>
		<script language="javascript">
		  alert("Este empleado no presenta incapacidades y / Licencias por este concepto.!")
                 open ("EstadisticaIncapacidad.php?codigo=<?echo $codigo;?>","_self")
		</script>
             <?
        }
}
