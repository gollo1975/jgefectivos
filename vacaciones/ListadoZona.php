	<html>

<head>
  <title>Modificar Registro.</title>
      <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<?
include("../conexion.php");
$con1="select zona.codzona,zona.zona,maestro.codmaestro from zona,maestro,sucursal
   where maestro.codmaestro=sucursal.codmaestro and
         sucursal.codsucursal=zona.codsucursal and
         zona.codzona='$CodZona'";
$re1=mysql_query($con1)or die("Error al buscar el periodo");
$filas_s=mysql_fetch_array($re1);
$NitEmpresa=$filas_s["codmaestro"];
$Zona=$filas_s["zona"];
$conP="select periodoprima.nrop,periodoprima.desde,periodoprima.hasta from periodoprima,maestro
where maestro.codmaestro=periodoprima.codmaestro and
     maestro.codmaestro='$NitEmpresa' and
     periodoprima.estado='FALTA'";
$reP=mysql_query($conP)or die("Error al buscar el periodo");
$regP=mysql_num_rows($reP);
$filas_F=mysql_fetch_array($reP);
$Desde=$filas_F["desde"];
$Hasta=$filas_F["hasta"];
$Zona=$filas_s["zona"];
if ($regP !=0):
    	?>
	<table border="0" align="center">
	   <tr>
	   <td><?echo $filas["zona"];?></td>
	  </tr>
	</table>
	<?
	$consu="select prima.* from empleado,prima,zona where
	zona.codzona = prima.codzona and
	empleado.cedemple=prima.cedemple and
	prima.fechai between '$Desde' and '$Hasta' and
	zona.codzona='$CodZona'order by prima.nombre";
	$resulta=mysql_query($consu)or die ("Error al buscar primas por zona");
	$registro=mysql_num_rows($resulta);
	$registro=mysql_affected_rows();
	if ($registro!=0):
	     ?>
	            <table border="0" align="center">
	              <tr class="cajas">
	                <td><b>Cod_Zona:&nbsp;<?echo $CodZona;?></b></td>
	              </tr>
	               <tr class="cajas">
	                <td><b>Zona:&nbsp;<?echo $Zona;?></b></td>
	              </tr>
	            </table>
	           <table border="0" align="center">

	              <tr  class="cajas">
	                  <th>#</th>
	                  <th>Nro_Prima</th>
	                  <th>Ducumento</th>
	                  <th>Empleado</th>
	                  <th>F_Proceso</th>
	                  <th>F_Inicio</th>
	                  <th>F_Corte</th>
	                  <th>F_Contrato</th>
					   <th>C_Salario</th>
					  <th>F_Cambio</th>  
	                  <th>Ibc</th>
	                  <th>Dias</th>
					  <th>Dias_Ded.</th>
	                  <th>Vlr_Pagado</th>
	              </tr>
	    <?      $j=1;
	            while($filas_s=mysql_fetch_array($resulta)):
	            $salario=number_format($filas_s["salario"],0);
	            $total=number_format($filas_s["total"],0);
	   ?>
	              <tr  class="cajas">
	              <th><?echo $j;?></th>
	                 <td><a href="EditarPrima.php?NroPrima=<?echo $filas_s["nroprima"];?>&CodZona=<?echo $CodZona;?>"><?echo $filas_s["nroprima"];?></a></td>
	                 <td><?echo $filas_s["cedemple"];?></td>
	                 <td><?echo $filas_s["nombre"];?></td>
	                 <td><?echo $filas_s["fechap"];?></td>
	                 <td><?echo $filas_s["fechai"];?></td>
	                 <td><?echo $filas_s["fechacorte"];?></td>
	                 <td><div align="center"><?echo $filas_s["fechainicio"];?></div></td>
					 <td><div align="center"><?echo $filas_s["cambiosalario"];?></div></td>
					  <td><div align="center"><?echo $filas_s["fechacambio"];?></div></td>
	                 <td><div align="right"><?echo $salario;?></div></td>
	                 <td><div align="center"><?echo $filas_s["dias"];?></div></td>
					 <td><div align="center"><?echo $filas_s["diadeduccion"];?></div></td>
	                 <td><div align="right"><?echo $total;?></div></td>
	               </tr>

	           <?
	           $j=$j+1;
	           $con=$con+$filas_s["total"];
	            endwhile;
	            $con=number_format($con,0);
	            ?>
	            </table>
	            <tr><td>&nbsp;</td></tr>
	             <center><td class="cajas"><b>Vlr_Pagado:</b>&nbsp;&nbsp;<?echo $con;?></td></center>
	            <?
	          else:
	            ?>
	              <script language="javascript">
	                alert("No Existen empleados con Primas en esta Zona")
	                history.back()
	             </script>
	            <?

	         endif;
else:
    ?>
       <script language="javascript">
          alert("Ya no se puede modificar el registro.")
          history.back()
       </script>
    <?
endif;
 ?>
</table>

</body>
</html>
