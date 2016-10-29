<html>
<head>
  <title></title>
<LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
<?
include("../conexion.php");
$consulta="select convenio.*,acceso.nombre from convenio,acceso where
	 convenio.usuarioadmon=acceso.usuario and
         convenio.fechac between '$Desde' and '$Hasta' and
         acceso.usuario='$NroC'";
$resultado=mysql_query($consulta)or die ("Consulta incorrecta");
$registro=mysql_num_rows($resultado);
if($registro!=0):
  ?>
    <center><h4><u>Vinculaciones por Funcionario</u></h4></center>
         <div align="center"><b>Desde</b>:&nbsp;<?echo $Desde;?>&nbsp;&nbsp; <b>Hasta:</b>&nbsp;<?echo $Hasta;?></div>
        <table border="0" align="center">
        <tr><td><br></td></tr>
        <tr class="cajas">
             <th>#</th>
             <th>Numero</th>
             <th>Documento</th>
             <th>Empleado</th>
             <th>Zona</th>
             <th>F_Proceso</th>
			 <th>F_Validado</th>
			 <th>H_Validado</th>
			 <th>H_Contrato</th>
			 <th>H_Cierre</th>
             <th>Funcionario</th>
             </tr>
            <?
            $i=1;
             while($filas=mysql_fetch_array($resultado)):
			    $TipoContrato = $filas["tipocontrato"];  
			      $NroExamen = $filas["nro"];
				  $Sql="select examen.horaexamenvalidado,examen.fechavalidado from examen where
						examen.nro='$NroExamen'";
				  $Rs=mysql_query($Sql)or die ("Error al validar los examenes.");
				  $FilaV = mysql_fetch_array($Rs);
				  $FechaValidacion = $FilaV["horaexamenvalidado"];
				  $FechaValidado =  $FilaV["fechavalidado"];
				  if ($TipoContrato != 'ADICCION'){
					   ?>
						 <tr class="cajas">
						 <th><?echo $i;?></th>
						   <td><a href="ReporteContratoNuevo.php?CodReporte=<?echo $filas["nroconvenio"];?>"><?echo $filas["nroconvenio"];?></td></td>
						   <td><?echo $filas["cedemple"];?></td>
						   <td><?echo $filas["nombres"];?></td>
						   <td><?echo $filas["zona"];?></td>
						   <td><?echo $filas["fechac"];?></td>
						   <td><?echo $FechaValidado;?></td>
							<td><?echo $FechaValidacion;?></td>
						   <td><?echo $filas["horaproceso"];?></td>
						   <td><?echo $filas["horafinalproceso"];?></td>
						   <td><?echo $filas["nombre"];?></td>
						   </tr>
						   <?
				  }		   
                    $i=$i + 1;
             endwhile;
             ?>
             </table>
         <tr>

          </tr>
             <?
else:

?>
  <script language="javascript">
    alert("Este funcionario no ha realizado vinculaciones en este rango de fechas.")
    history.back()
  </script>
  <?
endif;
?>
</body>
</html>
