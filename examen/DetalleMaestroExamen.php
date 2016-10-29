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
 $consu="SELECT examen.* FROM novedad,examen
WHERE examen.cedula = novedad.cedemple
AND examen.cedula =  '$Cedula'
AND novedad.estado =  'ACTIVO'";
$resulta=mysql_query($consu)or die ("Error al buscar el empleado");
$registro=mysql_num_rows($resulta);
$filas=mysql_fetch_array($resulta);
if ($registro != 0){
    ?>
    <script language="javascript">
        alert("El documento de Identidad Nro: <?echo $Cedula;?> pertenece al empleado <?echo $filas["nombre"];?> presenta inconvenientes en la Compañia, favor verificar con Gerencia!!")
        history.back()
    </script>
    <?
}else{
?>
   <body>
   <div align="center"><h4><b><u>MAESTRO EXAMEN MEDICO</u></b></h4></div>
   <div style="width: 75%; margin: 0 auto" id="tabs">
     <ul>
	 <li><a href="#tabs-1"><font color="#008040"><b>Examenes Médicos</b></font></a></li>
         <li><a href="#tabs-2"><font color="#008040"><b>Restriccion Médica</b></font></a></li>
         <li><a href="#tabs-3"><font color="#008040"><b>Incapacidades</b></font></a></li>
     </ul>
     <div id="tabs-1">
       	   <table border="0" align="center" width="100%">
	   	<tr  class="cajas">
                   <th>Número</th>
                   <th>Documento</th>
		   <th>Empleado</th>
		   <th>F_Proceso</th>
		   <th>Zona</th>
                   <th>Costo_Examen</th>
                   <th>Proveedor</th>
		</tr>
		<?
                include("../conexion.php");
		$consu="SELECT examen.*,zona.zona,provedor.nomprove FROM zona,examen,provedor WHERE
                 examen.codzona=zona.codzona and
                 examen.nitprove=provedor.nitprove and
                 examen.cedula = '$Cedula'";
		$resulta=mysql_query($consu)or die ("Error al validar el examen medico");
		$registro=mysql_num_rows($resulta);
		while($arNominaAuxiliarDetalle=mysql_fetch_array($resulta)){
		    echo "<tr  class='cajas'>";
		    ?><td><a href="imprimircontrol.php?nropago=<?echo $arNominaAuxiliarDetalle["nro"];?>"><?echo $arNominaAuxiliarDetalle["nro"];?></a></td><?
		    echo "<td style='width: 10px'>" . number_format($arNominaAuxiliarDetalle['cedula'],0,',','.') . "</td>";
		    echo "<td style='width: 220px'>" . $arNominaAuxiliarDetalle['nombre'] . "</td>";
                    echo "<td style='text-align: center;width: 20px'>" . $arNominaAuxiliarDetalle['fechap'] . "</td>";
                    echo "<td style='width: 390px'>" . $arNominaAuxiliarDetalle['zona'] . "</td>";
		    echo "<td>" . number_format($arNominaAuxiliarDetalle['costoe'],0,',','.') . "</td>";
                    echo "<td style='width: 390px'>" . $arNominaAuxiliarDetalle['nomprove'] . "</td>";
		    echo "</tr>";
	        }
	       ?>
	</table>
  </div>
  <div id="tabs-2">
       	   <table border="0" align="center" width="100%"><?
                include("../conexion.php");
		$consu="SELECT maestrocartarestriccion.* FROM maestrocartarestriccion WHERE
                        maestrocartarestriccion.cedula = '$Cedula'";
		$resulta=mysql_query($consu)or die ("Error al validar la restriccion medica");
                $regI=mysql_num_rows($resulta);
                if($regI != 0){ ?>
		   	<tr  class="cajas">
	                   <th>Número</th>
	                   <th>Documento</th>
			   <th>Empleado</th>
			   <th>F_Proceso</th>
			   <th>Dias</th>
	                   <th>Tipo_Revisión</th>
			</tr>
			<?
			while($arNominaAuxiliarDetalle=mysql_fetch_array($resulta)){
			    echo "<tr  class='cajas'>";
	                    ?><td><a href="ImprimirCartaRestriccion.php?NroCarta=<?echo $arNominaAuxiliarDetalle["nrocarta"];?>"><?echo $arNominaAuxiliarDetalle["nrocarta"];?></a></td><?
			    echo "<td style='width: 15px'>" . number_format($arNominaAuxiliarDetalle['cedula'],0,',','.') . "</td>";
			    echo "<td style='width: 300px'>" . $arNominaAuxiliarDetalle['empleado'] . "</td>";
	                    echo "<td style='text-align: center;width: 20px'>" . $arNominaAuxiliarDetalle['fechaexamen'] . "</td>";
	                    echo "<td style='text-align: center;width: 290px'>" . $arNominaAuxiliarDetalle['dias'] . "</td>";
			    echo "<td style='width: 290px'>" . $arNominaAuxiliarDetalle['tiporevision'] . "</td>";
			    echo "</tr>";
		        }
                }else{
                     echo "NO HAY RESTRICCIONES MEDICAS PARA MOSTRA EN LA VISTA. ";
                }
                       ?>
	</table>
  </div>
   <div id="tabs-3">
       	<table border="0" align="center" width="100%">
           <?
           include("../conexion.php");
           $Incapacidad="SELECT incapacidad.*,tipoinca.concepto,control.concepto as Motivo,eps.eps FROM empleado,incapacidad,tipoinca,control,eps WHERE
               empleado.cedemple=incapacidad.cedemple and
               tipoinca.tipoinca=incapacidad.tipoinca and
               incapacidad.codigo=control.codigo and
               incapacidad.codeps=eps.codeps and
               empleado.cedemple = '$Cedula' order by incapacidad.fechapro DESC";
      	   $resI=mysql_query($Incapacidad)or die ("Error al validar el incapacidades");
           $regI=mysql_num_rows($resI);
           if($regI != 0){
              ?>
      	      <tr  class="cajas">
                   <th>Id</th>
                   <th>Nro_Incapa.</th>
                   <th>Concepto</th>
                   <th>F_Proceso</th>
	     	   <th>F_Inicio</th>
		   <th>F_Termino</th>
                   <th>Dias</th>
		   <th>Prorroga</th>
                   <th>Motivo</th>
                   <th>Eps</th>
                   <th>Estado</th>
	      </tr>
	      <?
              $t=1;
              while($Registro=mysql_fetch_array($resI)){
			    echo "<tr  class='cajas'>";
	                    echo "<th>" . $t . "</th>";
                            echo "<td style='text-aign: left;width: 90px'>" . $Registro['nroinca'] . "</td>";
	                    echo "<td style='width: 190px'>" . $Registro['concepto'] . "</td>";
			    echo "<td style='text-align: center;width: 65px'>" . $Registro['fechapro'] . "</td>";
                            echo "<td style='text-align: center;width: 65px'>" . $Registro['fechaini'] . "</td>";
	                    echo "<td style='text-align: center;width: 65px'>" . $Registro['fechater'] . "</td>";
	                    echo "<td style='text-align: center;width: 35px'>" . $Registro['dias'] . "</td>";
	                    echo "<td style='text-align: center;width: 35px'>" . $Registro['prorroga'] . "</td>";
                            echo "<td style='text-align: left;width: 490px'>" . $Registro['Motivo'] . "</td>";
                            echo "<td style='text-align: left;width: 120px'>" . $Registro['eps'] . "</td>";
                            echo "<td style='text-align: left;width: 60px'>" . $Registro['estado'] . "</td>";
			    echo "</tr>";
	                  $t=$t + 1;
	      }
      }else{
            echo "NO HAY INCAPACIDADES PARA MOSTRAR EN LA VISTA.";
      }
      ?>
	</table>
  </div>
  <div align="center"><a href="MaestroExamenMedico.php"><img src="../image/regresar.png" border="0" title="Regresar al menu de consulta"></div>
<?
}
?>
</body>

</html>
