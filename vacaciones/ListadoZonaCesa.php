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
$conP="select periodocesantia.nroc,periodocesantia.desde,periodocesantia.hasta from periodocesantia,maestro
where maestro.codmaestro=periodocesantia.codmaestro and
     maestro.codmaestro='$NitEmpresa' and
     periodocesantia.estado='ACTIVO'";
$reP=mysql_query($conP)or die("Error al buscar el periodo");
$regP=mysql_num_rows($reP);
$filas_F=mysql_fetch_array($reP);
$Desde=$filas_F["desde"];
$Hasta=$filas_F["hasta"];
$Zona=$filas_s["zona"];
if ($regP !=0):
	$consu="select cesantiainteres.* from empleado,cesantiainteres,zona where
	empleado.codzona=zona.codzona and
	empleado.cedemple=cesantiainteres.cedemple and
	cesantiainteres.inicioperiodo between '$Desde' and '$Hasta' and
	zona.codzona='$CodZona'order by cesantiainteres.nombre";
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
	                  <th>Nro_Cesa.</th>
	                  <th>Ducumento</th>
	                  <th>Empleado</th>
	                  <th>F_Proceso</th>
	                  <th>F_Inicio</th>
	                  <th>F_Corte</th>
	                  <th>F_Contrato</th>
	                  <th>Ibc</th>
	                  <th>Dias</th>
                          <th>Dias_Licencia</th>
                          <th>Auxilio</th>
	                  <th>Vlr_Cesant.</th>
                           <th>Vlr_Interes</th>
	              </tr>
	    <?      $j=1;
	            while($filas_s=mysql_fetch_array($resulta)):
	            $Cesantia=number_format($filas_s["pagocesantia"],0);
                    $Interes=number_format($filas_s["pagointeres"],0);
                   $Salario=number_format($filas_s["salario"],0);
                    $Auxilio=number_format($filas_s["auxilio"],0);
	   ?>
	              <tr  class="cajas">
	              <th><?echo $j;?></th>
	                 <td><a href="EditarCesa.php?NroCesa=<?echo $filas_s["nrocesantia"];?>&CodZona=<?echo $CodZona;?>"><?echo $filas_s["nrocesantia"];?></a></td>
	                 <td><?echo $filas_s["cedemple"];?></td>
	                 <td><?echo $filas_s["nombre"];?></td>
	                 <td><div align="center"><?echo $filas_s["fechap"];?></div></td>
	                 <td><?echo $filas_s["inicioperiodo"];?></td>
	                 <td><?echo $filas_s["fechafinal"];?></td>
	                 <td><div align="center"><?echo $filas_s["fechainicio"];?></div></td>
	                 <td><div align="right"><?echo $Salario;?></div></td>
	                 <td><div align="center"><?echo $filas_s["dias"];?></div></td>
                          <td><div align="center"><?echo $filas_s["dialicencia"];?></div></td>   
                          <td><div align="right"><?echo $Auxilio;?></div></td>
	                 <td><div align="right"><?echo $Cesantia;?></div></td>
                          <td><div align="right"><?echo $Interes;?></div></td>

	               </tr>

	           <?
	           $j=$j+1;
	           $Cesa=$Cesa+$filas_s["pagocesantia"];
                   $Inte=$Inte+$filas_s["pagointeres"];
	            endwhile;
	            $Cesa=number_format($Cesa,0);
                    $Inte=number_format($Inte,0);
	            ?>
	            </table>
	            <tr><td>&nbsp;</td></tr>
	             <center><td class="cajas"><b>Vlr_Cesantia:</b>&nbsp;&nbsp;$<?echo $Cesa;?>&nbsp;&nbsp;<b>Vlr_Interes:</b>&nbsp;&nbsp;$<?echo $Inte;?></td></center>
				<div align="center"><a href="ModificarZonaCesa.php"><img src="../image/regresar.png" border="0" alt="Regresar al menu de consulta"></div>
			<?	
	          else:
	            ?>
	              <script language="javascript">
	                alert("No Existen empleados con Cesantias generadas para este periodo.!")
	                history.back()
	             </script>
	            <?

	         endif;
else:
    ?>
       <script language="javascript">
          alert("Ya no se puede modificar el registro, el periodo se cerro.!")
          history.back()
       </script>
    <?
endif;
 ?>
</table>

</body>
</html>
