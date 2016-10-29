<html>

<head>
  <title></title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="../jquery-ui-1.10.4/jquery-1.10.2.js"></script>
  <script src="../jquery-ui-1.10.4/ui/jquery-ui.js"></script>
  <link rel="stylesheet" href="../jquery-ui-1.10.4/themes/base/jquery-ui.css">
  <script>
  $(function() {
    $( "#tabs" ).tabs();
  });
  </script>

</head>
<?php
 include("../conexion.php");
 $consu="SELECT empleado.cedemple, CONCAT( empleado.nomemple,  ' ', empleado.nomemple1,  ' ', empleado.apemple,  ' ', empleado.apemple1 ) AS Empleado
FROM empleado, novedad
WHERE empleado.cedemple = novedad.cedemple
AND empleado.cedemple =  '$Cedula'
AND novedad.estado =  'ACTIVO'";
$resulta=mysql_query($consu)or die ("Error al buscar el empleado");
$registro=mysql_num_rows($resulta);
$filas=mysql_fetch_array($resulta);
if ($registro != 0){
    ?>
    <script language="javascript">
        alert("El documento de Identidad Nro: <?echo $Cedula;?> pertenece al empleado <?echo $filas["Empleado"];?> presenta inconvenientes en la Compañia, favor verificar con Gerencia!!")
        history.back()
    </script>
    <?
}else{
?>
   <body>
   <div align="center"><h4><b><u>MAESTRO DOCUMENTOS EMPLEADO</u></b></h4></div>
   <div style="width: 80%; margin: 0 auto" id="tabs">
     <ul>
	 <li><a href="#tabs-1"><font color="#008040"><b>Entrega Documentos</b></font></a></li>
	 <li><a href="#tabs-2"><font color="#008040"><b>Autorización descuento</b></font></a></li>
         <li><a href="#tabs-3"><font color="#008040"><b>Carta Presentación</b></font></a></li>
		 <li><a href="#tabs-4"><font color="#008040"><b>Carta Fosyga</b></font></a></li>
     </ul>
     <div id="tabs-1">
       	   <table border="0" align="center" width="100%">
		   <?
		   include("../conexion.php");
		   $consu="SELECT maestroentregadocumento.* FROM maestroentregadocumento WHERE
                 maestroentregadocumento.cedemple = '$Cedula' order by maestroentregadocumento.fechaentrega DESC";
		   $resulta=mysql_query($consu)or die ("Error al validar el empleado");
		   $registro=mysql_num_rows($resulta);
		   if($registro != 0){
			    ?>
				<tr  class="cajas">
					 <th>Nro_Entrega</th>
					 <th>Documento</th>
					 <th>Empleado</th>
					 <th>Zona</th>
					 <th>Fecha_Proceso</th>
				</tr>
				<?
				while($arNominaAuxiliarDetalle=mysql_fetch_array($resulta)){
					echo "<tr  class='cajas'>";
					?><td><a href="../contrato/ImprimirEntregaDocumento.php?NroEntrega=<?echo $arNominaAuxiliarDetalle["nroentrega"];?>"><?echo $arNominaAuxiliarDetalle["nroentrega"];?></a></td><?
					echo "<td>" . number_format($arNominaAuxiliarDetalle['cedemple'],0,',','.') . "</td>";
					echo "<td style='width: 500px'>" . $arNominaAuxiliarDetalle['empleado'] . "</td>";
					echo "<td style='width: 400px'>" . $arNominaAuxiliarDetalle['zona'] . "</td>";
				   echo "<td style='text-align: center;width: 80px'>" . $arNominaAuxiliarDetalle['fechaentrega'] . "</td>";
					echo "</tr>";
					}
		   }else{
			    echo "NO HAY REGISTROS PARA MOSTRAR EN ESTA VISTA"; 
		   }		
				   ?>
	</table>
  </div>
  <div id="tabs-2">
     <table border="0" align="center" width="100%">
	    <?
		include("../conexion.php");
		$consu="SELECT maestroautorizaciondescuento.* FROM maestroautorizaciondescuento WHERE
                 maestroautorizaciondescuento.cedemple = '$Cedula' order by maestroautorizaciondescuento.fechaentrega DESC";
		$resulta=mysql_query($consu)or die ("Error al validar el la autorizacion de descuento");
		$registro=mysql_num_rows($resulta);
		if($registro != 0){
				?>
				<tr  class="cajas">
					 <th>Nro_Autorización</th>
					 <th>Documento</th>
					 <th>Empleado</th>
					 <th>Fecha_Proceso</th>
				</tr>
				<?
				while($arNominaAuxiliarDetalle=mysql_fetch_array($resulta)){
					echo "<tr  class='cajas'>";
						?><td><a href="../contrato/ImprimirAutorizacion.php?NroAuto=<?echo $arNominaAuxiliarDetalle["nroautorizacion"];?>"><?echo $arNominaAuxiliarDetalle["nroautorizacion"];?></a></td><?
						echo "<td>" . number_format($arNominaAuxiliarDetalle['cedemple'],0,',','.') . "</td>";
						echo "<td style='width: 500px'>" . $arNominaAuxiliarDetalle['empleado'] . "</td>";
						echo "<td style='text-align: center;width: 80px'>" . $arNominaAuxiliarDetalle['fechaentrega'] . "</td>";
					echo "</tr>";
					}
		}else{
			 echo "NO HAY REGISTROS PARA MOSTRAR EN ESTA VISTA";
		}				
	       ?>
	</table>
  </div>
<div id="tabs-3">
     <table border="0" align="center" width="100%">
     <?
      include("../conexion.php");
      $Memorando="SELECT maestrocartapresentacion.* FROM maestrocartapresentacion WHERE
               maestrocartapresentacion.cedemple = '$Cedula' order by maestrocartapresentacion.fechaproceso DESC";
      $resM=mysql_query($Memorando)or die ("Error al validar el la carta de presentacion");
      $regM=mysql_num_rows($resM);
      if($regM != 0){
           ?>
		 <tr  class="cajas">
             <th>Nro_Carta</th>
             <th>Documento</th>
		     <th>Empleado</th>
			 <th>Zona</th>
			 <th>Eps</th>
			 <th>Pensión</th>
			 <th>Caja_Compensación</th>
			 <th>F_Contrato</th>
		     <th>F_Proceso</th>
		</tr>
	    <?
            while($arNominaAuxiliarDetalle=mysql_fetch_array($resM)){
			    echo "<tr  class='cajas'>";
					?><td><a href="../contrato/ImprimirCartaPresentacion.php?NroCarta=<?echo $arNominaAuxiliarDetalle["nrocarta"];?>"><?echo $arNominaAuxiliarDetalle["nrocarta"];?></a></td><?
					echo "<td>" . number_format($arNominaAuxiliarDetalle['cedemple'],0,',','.') . "</td>";
					echo "<td style='width: 500px'>" . $arNominaAuxiliarDetalle['empleado'] . "</td>";
					echo "<td style='width: 500px'>" . $arNominaAuxiliarDetalle['zona'] . "</td>";
					echo "<td style='width: 200px'>" . $arNominaAuxiliarDetalle['eps'] . "</td>";
					echo "<td style='width: 200px'>" . $arNominaAuxiliarDetalle['pension'] . "</td>";
					echo "<td style='width: 200px'>" . $arNominaAuxiliarDetalle['caja'] . "</td>";
					echo "<td style='text-align: center;width: 80px'>" . $arNominaAuxiliarDetalle['fechacontrato'] . "</td>";
					echo "<td style='text-align: center;width: 80px'>" . $arNominaAuxiliarDetalle['fechaproceso'] . "</tr>";
				echo "</tr>";
            }
      }else{
            echo "NO HAY REGISTROS PARA MOSTRAR EN ESTA VISTA";
      }
      ?>
	</table>
  </div>
  <div id="tabs-4">
     <table border="0" align="center" width="100%">
     <?
      include("../conexion.php");
      $Incapacidad="SELECT maestrocartatraslado.* FROM maestrocartatraslado WHERE
               maestrocartatraslado.cedemple = '$Cedula' order by maestrocartatraslado.fechaproceso DESC";
      $resI=mysql_query($Incapacidad)or die ("Error al validar el carta de traslado");
      $regI=mysql_num_rows($resI);
      if($regI != 0){
           ?>
      	    <tr  class="cajas">
             <th>Nro_Carta</th>
             <th>Documento</th>
		     <th>Empleado</th>
			 <th>Zona</th>
			 <th>Nueva_Eps</th>
			 <th>Nueva_Pensión</th>
			 <th>F_Traslado</th>
			 <th>F_Proceso</th>
			 </tr>
	    <?
            while($arNominaAuxiliarDetalle=mysql_fetch_array($resI)){
			    echo "<tr  class='cajas'>";
					?><td><a href="../cartalaboral/ImprimirCartaTraslado.php?NroCartaTraslado=<?echo $arNominaAuxiliarDetalle["nrocartatraslado"];?>"><?echo $arNominaAuxiliarDetalle["nrocartatraslado"];?></a></td><?
					echo "<td>" . number_format($arNominaAuxiliarDetalle['cedemple'],0,',','.') . "</td>";
					echo "<td style='width: 500px'>" . $arNominaAuxiliarDetalle['empleado'] . "</td>";
					echo "<td style='width: 500px'>" . $arNominaAuxiliarDetalle['zona'] . "</td>";
					echo "<td style='width: 200px'>" . $arNominaAuxiliarDetalle['epsnueva'] . "</td>";
					echo "<td style='width: 200px'>" . $arNominaAuxiliarDetalle['pensionnueva'] . "</td>";
					echo "<td style='text-align: center;width: 80px'>" . $arNominaAuxiliarDetalle['fechatraslado'] . "</td>";
					echo "<td style='text-align: center;width: 80px'>" . $arNominaAuxiliarDetalle['fechaproceso'] . "</tr>";
			     echo "</tr>";
	        }
      }else{
            echo "NO HAY REGISTROS PARA MOSTRAR EN ESTA VISTA";
      }
      ?>
	</table>
  </div>
  </div>
   <tr>&nbsp;</td>
  <div align="center"><a href="DetalladoMaestroDocumento.php?codigo=<?echo $codigo;?>"><img src="../image/regresar.png" border="0" alt="Regresar al menu de consulta"></div>
<?
}
?>
</body>

</html>
