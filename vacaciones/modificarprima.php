<html>

<head>
  <title>Compensacion  Semestral</title>
   <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<?
if (!isset($Cedula)):
	?>
	 <center><h4><u>Editar Prima</u></h4></center>
	<form action="" method="post">
	  <table border="0" align="center">
	  <tr>
	       <td colspan="2"><br></td>
	  </tr>
	   <tr>
	     <td><b>Documento de Identidad:</b></td>
	     <td><input type="text" name="Cedula" value="" size="15" maxlength="15"></td>
	   </tr>
	   <tr><td><br></td></tr>
	  <tr>
	    <td colspan="2">
	      <input type="submit" value="Buscar" class="boton">
	    </td>
	  </tr>
	</table>
	</form>
<?
elseif(empty($Cedula)):
   ?>
    <script language="javascript">
       alert ("Digite el documento del Empleado.!")
       history.back()
    </script>
   <?
else:
    include("../conexion.php");
    $con1="select zona.codzona,zona.zona,maestro.codmaestro from zona,maestro,sucursal,empleado
    where maestro.codmaestro=sucursal.codmaestro and
         sucursal.codsucursal=zona.codsucursal and
         zona.codzona=empleado.codzona and
         empleado.cedemple='$Cedula'";
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
   if ($regP !=0):
	$consu="select prima.* from empleado,prima,zona where
	empleado.codzona=zona.codzona and
	empleado.cedemple=prima.cedemple and
	prima.fechai between '$Desde' and '$Hasta' and
	empleado.cedemple='$Cedula'";
	$resulta=mysql_query($consu)or die ("Error al buscar primas por zona");
	$registro=mysql_num_rows($resulta);
	$registro=mysql_affected_rows();
	if ($registro!=0):
	     ?>
	            <table border="0" align="center">

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
	                  <th>Vlr_Pagado</th>
	              </tr>
	    <?      $j=1;
	            while($filas_s=mysql_fetch_array($resulta)):
	            $salario=number_format($filas_s["salario"],0);
	            $total=number_format($filas_s["total"],0);
	   ?>
	              <tr  class="cajas">
	              <th><?echo $j;?></th>
	                 <td><a href="EditarPrima.php?NroPrima=<?echo $filas_s["nroprima"];?>&Validar=1"><?echo $filas_s["nroprima"];?></a></td>
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
	                alert("Este empleado no tiene archivo de primas para modificar.!")
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
endif;
 ?>
</table>

</body>
</html>
