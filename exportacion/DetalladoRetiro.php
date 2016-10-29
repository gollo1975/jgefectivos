<LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
<?
include("../conexion.php");
if($Estado=='Zona'){
	 $Sql="select contrato.*,zona.zona, concat(nomemple, ' ' ,nomemple1, ' ' ,apemple, ' ' , apemple1) as Empleado,empleado.cedemple,empleado.diremple,empleado.telemple,empleado.email,empleado.celular from zona,contrato,empleado
	where  contrato.codzona=zona.codzona and
	       zona.codzona='$CodZona' and	
	       contrato.fechater between '$Desde' and '$Hasta' and
		   contrato.codemple=empleado.codemple order by empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1";
}else{
       $Sql="select contrato.*,zona.zona, concat(nomemple, ' ' ,nomemple1, ' ' ,apemple, ' ' , apemple1) as Empleado,empleado.cedemple,empleado.diremple,
		empleado.telemple,empleado.email,empleado.celular,sucursal.sucursal from zona,contrato,empleado,sucursal
	    where contrato.codzona=zona.codzona and
	       zona.codsucursal=sucursal.codsucursal and
           sucursal.codsucursal='$CodSucursal' and	
          contrato.fechater between '$Desde' and '$Hasta' and
		   contrato.codemple=empleado.codemple order by zona.zona";
}
$Rs=mysql_query($Sql)or die ("Error al buscar los empleados en la sucursal.!" );
$Cont=mysql_num_rows($Rs);
if($Cont==0){
	?>
	<script language="javascript">
	alert("No hay empleados retirados en este rango de fechas.!")
	history.back()
	</script>
	<?
}else{
	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=Empleados Retirados.xls");
	header("Pragma: no-cache");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("Expires: 0");
        if($Estado=='Zona'){
		?>
		<table border="0" align="center">
		<tr class="cajas">
		<td style='font-weight:bold;font-size:1.1em;'>Nro</td>
		<td style='font-weight:bold;font-size:1.1em;'>Nro_Contrato</td>
		<td style='font-weight:bold;font-size:1.1em;'>Documento</td>
		<td style='font-weight:bold;font-size:1.1em;'>Empleado</td>
		<td style='font-weight:bold;font-size:1.1em;'>Teléfono</td>
		<td style='font-weight:bold;font-size:1.1em;'>Dirección</td>
		<td style='font-weight:bold;font-size:1.1em;'>Celular</td>
		<td style='font-weight:bold;font-size:1.1em;'>Email</td>
		<td style='font-weight:bold;font-size:1.1em;'>F_Ingreso</td>
		<td style='font-weight:bold;font-size:1.1em;'>F_retiro</td>
		<td style='font-weight:bold;font-size:1.1em;'>Dias_Laborados</td>
		<td style='font-weight:bold;font-size:1.1em;'>Cargo</td>
		<td style='font-weight:bold;font-size:1.1em;'>Salario</td>
		<td style='font-weight:bold;font-size:1.1em;'>Zona</td>
		</tr>
		<?
		$i=1;
		while ($filas=mysql_fetch_array($Rs)){
			?>
			<tr class="cajas">
			<td><?echo $i;?></td>
			<td><?echo $filas["contrato"];?></td>
			<td><?echo $filas["cedemple"];?></td>
			<td><?echo $filas["Empleado"];?></td>
			<td><?echo $filas["telemple"];?></td>
			<td><?echo $filas["diremple"];?></td>
			<td><?echo $filas["celular"];?></td>
			<td><?echo $filas["email"];?></td>
			<td><?echo $filas["fechainic"];?></td>
			<td><?echo $filas["fechater"];?></td>
			<td><?echo $DiasLaborados;?></td>
			<td><?echo $filas["cargo"];?></td>
			<td><?echo $filas["salario"];?></td>
			<td><?echo $filas["zona"];?></td>
			</tr>
			<?
			$i=$i+1;
		}
        }else{
               ?>
		<table border="0" align="center">
		<tr class="cajas">
		<td style='font-weight:bold;font-size:1.1em;'>Nro</td>
		<td style='font-weight:bold;font-size:1.1em;'>Nro_Contrato</td>
		<td style='font-weight:bold;font-size:1.1em;'>Documento</td>
		<td style='font-weight:bold;font-size:1.1em;'>Empleado</td>
		<td style='font-weight:bold;font-size:1.1em;'>Teléfono</td>
		<td style='font-weight:bold;font-size:1.1em;'>Dirección</td>
		<td style='font-weight:bold;font-size:1.1em;'>Celular</td>
		<td style='font-weight:bold;font-size:1.1em;'>Email</td>
		<td style='font-weight:bold;font-size:1.1em;'>F_Ingreso</td>
		<td style='font-weight:bold;font-size:1.1em;'>F_retiro</td>
		<td style='font-weight:bold;font-size:1.1em;'>Dias_Laborados</td>
		<td style='font-weight:bold;font-size:1.1em;'>Cargo</td>
		<td style='font-weight:bold;font-size:1.1em;'>Salario</td>
		<td style='font-weight:bold;font-size:1.1em;'>Zona</td>
        <td style='font-weight:bold;font-size:1.1em;'>Sucursal</td>
		</tr>
		<?
		$i=1;
		while ($filas=mysql_fetch_array($Rs)){
			?>
			<tr class="cajas">
			<td><?echo $i;?></td>
			<td><?echo $filas["contrato"];?></td>
			<td><?echo $filas["cedemple"];?></td>
			<td><?echo $filas["Empleado"];?></td>
			<td><?echo $filas["telemple"];?></td>
			<td><?echo $filas["diremple"];?></td>
			<td><?echo $filas["celular"];?></td>
			<td><?echo $filas["email"];?></td>
			<td><?echo $filas["fechainic"];?></td>
			<td><?echo $filas["fechater"];?></td>
			<td><?echo $DiasLaborados;?></td>
			<td><?echo $filas["cargo"];?></td>
			<td><?echo $filas["salario"];?></td>
			<td><?echo $filas["zona"];?></td>
            <td><?echo $filas["sucursal"];?></td> 
			</tr>
			<?
			$i=$i+1;
		}
        }
}
?>
