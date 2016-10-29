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
   <div align="center"><h4><b><u>MAESTRO EMPLEADO</u></b></h4></div>
   <div style="width: 100%; margin: 0 auto" id="tabs">
     <ul>
	 <li><a href="#tabs-1"><font color="#008040"><b>Detalle Empleado</b></font></a></li>
	 <li><a href="#tabs-2"><font color="#008040"><b>Contrato Laboral</b></font></a></li>
         <li><a href="#tabs-3"><font color="#008040"><b>Proceso Disciplinario</b></font></a></li>
         <li><a href="#tabs-4"><font color="#008040"><b>Incapacidades</b></font></a></li>
         <li><a href="#tabs-5"><font color="#008040"><b>Entrada Visitante</b></font></a></li>
     </ul>
     <div id="tabs-1">
       	   <table border="0" align="center" width="100%">
	   	<tr  class="cajas">
                   <th>Codigo</th>
                   <th>T_Docu.</th>
	     	   <th>Documento</th>
		   <th>Empleado</th>
		   <th>Direcciòn</th>
		   <th>Telefòno</th>
                   <th>Celular</th>
                   <th>Email</th>
                   <th>Sexo</th>
                   <th>E._Civil</th>
                   <th>Rh</th>
                   <th>Forma_Pago</th>
                   <th>Eps</th>
                   <th>Pensiòn</th>
		</tr>
		<?
                include("../conexion.php");
		$consu="SELECT empleado.*,concat(nomemple, ' ', nomemple1, ' ', apemple, ' ', apemple1) as Empleado,pension.pension,eps.eps FROM empleado,eps,pension WHERE
                 empleado.codeps=eps.codeps and
                 empleado.codpension=pension.codpension and
                 empleado.cedemple = '$Cedula'";
		$resulta=mysql_query($consu)or die ("Error al validar el empleado");
		$registro=mysql_num_rows($resulta);
		while($arNominaAuxiliarDetalle=mysql_fetch_array($resulta)){
		    echo "<tr  class='cajas'>";
		    echo "<td>" . $arNominaAuxiliarDetalle['codemple'] . "</td>";
		    echo "<td>" . $arNominaAuxiliarDetalle['tipod'] . "</td>";
		    echo "<td>" . number_format($arNominaAuxiliarDetalle['cedemple'],0,',','.') . "</td>";
		    echo "<td style='width: 500px'>" . $arNominaAuxiliarDetalle['Empleado'] . "</td>";
		    echo "<td style='width: 400px'>" . $arNominaAuxiliarDetalle['diremple'] . "</td>";
                    echo "<td style='text-align: center;width: 80px'>" . $arNominaAuxiliarDetalle['telemple'] . "</td>";
                    echo "<td style='text-align: center;width: 80px'>" . $arNominaAuxiliarDetalle['celular'] . "</td>";
                    echo "<td style='width: 230px'>" . $arNominaAuxiliarDetalle['email'] . "</td>";
		     echo "<td style='text-align: center;width: 80px'>" . $arNominaAuxiliarDetalle['sexo'] . "</td>";
                    echo "<td style='text-align: center;width: 80px'>" . $arNominaAuxiliarDetalle['estcivil'] . "</td>";
                    echo "<td style='text-align: center;width: 80px'>" . $arNominaAuxiliarDetalle['rh'] . "</td>";
                    echo "<td style='text-align: center;width: 80px'>" . $arNominaAuxiliarDetalle['periodo'] . "</td>";
                    echo "<td style='text-align: center;width: 80px'>" . $arNominaAuxiliarDetalle['eps'] . "</td>";
                    echo "<td style='text-align: center;width: 80px'>" . $arNominaAuxiliarDetalle['pension'] . "</td>";
		    echo "</tr>";
	        }
	       ?>
	</table>
  </div>
  <div id="tabs-2">
     <table border="0" align="center" width="100%">
	   	<tr  class="cajas">
                   <th>Id</th>
                   <th>Nro_Contrato</th>
                   <th>Tipo_Contrato</th>
	     	   <th>F_Inicio</th>
		   <th>F_Final</th>
		   <th>Salario</th>
		   <th>Cargo</th>
                   <th>Zona</th>
		</tr>
		<?
                $t=1;
                include("../conexion.php");
		$Contrato="SELECT contrato.*,tipocontrato.concepto FROM empleado,contrato,tipocontrato WHERE
                   empleado.codemple=contrato.codemple and
                   contrato.tipo=tipocontrato.tipo and
                   empleado.cedemple = '$Cedula' order by contrato.fechainic DESC";
		$resC=mysql_query($Contrato)or die ("Error al validar el contrato");
		$regC=mysql_num_rows($resC);
		while($Registro=mysql_fetch_array($resC)){
		    echo "<tr  class='cajas'>";
                    echo "<th>" . $t . "</th>";
		    echo "<td style='text-aign: center;width: 75px'>" . $Registro['contrato'] . "</td>";
                    echo "<td style='width: 490px'>" . $Registro['concepto'] . "</td>";
		    echo "<td style='text-align: center;width: 75px'>" . $Registro['fechainic'] . "</td>";
                    echo "<td style='text-align: center;width: 75px'>" . $Registro['fechater'] . "</td>";
                    echo "<td style='text-align: right;width: 80px'>" . number_format($Registro['salario'],2) . "</td>";
                    echo "<td style='text-align: left;width: 550px'>" . $Registro['cargo'] . "</td>";
                    echo "<td style='text-align: left;width: 850px'>" . $Registro['zona'] . "</td>";

		    echo "</tr>";
                  $t=$t + 1;
	        }
	       ?>
	</table>
  </div>
<div id="tabs-3">
     <table border="0" align="center" width="80%">
     <?
      include("../conexion.php");
      $Memorando="SELECT memorando.*,tipoprocesomemo.concepto FROM empleado,memorando,tipoprocesomemo WHERE
               empleado.cedemple=memorando.cedemple and
               tipoprocesomemo.idproceso=memorando.idproceso and
               empleado.cedemple = '$Cedula' order by memorando.fecha DESC";
      $resM=mysql_query($Memorando)or die ("Error al validar el memorando");
      $regM=mysql_num_rows($resM);
      if($regM != 0){
           ?>
      	    <tr  class="cajas">
                   <th>Id</th>
                   <th>Nro_Proceso</th>
                   <th>Tipo_Proceso</th>
	     	   <th>F_Proceso</th>
		   <th>Firma</th>
                   <th>Cargo</th>
		   <th>Estado</th>

	    </tr>
	    <?
            $t=1;
            while($Registro=mysql_fetch_array($resM)){
			    echo "<tr  class='cajas'>";
	                    echo "<th>" . $t . "</th>";
                            ?><td><a href="../memorando/imprimir1.php?radicado=<?echo $Registro["radicado"];?>"><?echo $Registro["radicado"];?></a></td><?
			   // echo "<td style='text-aign: center;width: 75px'><a href" . $Registro['radicado'] . "</td>";
	                    echo "<td style='width: 400px'>" . $Registro['concepto'] . "</td>";
			    echo "<td style='text-align: center;width: 75px'>" . $Registro['fecha'] . "</td>";
	                    echo "<td style='text-align: left;width: 490px'>" . $Registro['firma'] . "</td>";
	                    echo "<td style='text-align: left;width: 490px'>" . $Registro['cargo'] . "</td>";
	                    echo "<td style='text-align: center;width: 75px'>" . $Registro['estado'] . "</td>";

			    echo "</tr>";
	                  $t=$t + 1;
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
                            echo "<td style='text-align: left;width: 80px'>" . $Registro['estado'] . "</td>";
			    echo "</tr>";
	                  $t=$t + 1;
	    }
      }else{
            echo "NO HAY REGISTROS PARA MOSTRAR EN ESTA VISTA";
      }
      ?>
	</table>
  </div>
     <div id="tabs-5">
     <table border="0" align="center" width="60%">
     <?
      include("../conexion.php");
       $Ingreso="SELECT detallevisitante.*,dependencia.nombreDependencia FROM detallevisitante,dependencia,visitante WHERE
          visitante.identificacion=detallevisitante.identificacion and
          dependencia.idDependencia=.detallevisitante.idDependencia and
          visitante.identificacion = '$Cedula' order by detallevisitante.fecha DESC";
      $resE=mysql_query($Ingreso)or die ("Error al validar el ingreso a la compañia");
      $regE=mysql_num_rows($resE);
      if($regE != 0){
           ?>
      	    <tr  class="cajas">
                   <th>Id</th>
                   <th>Nro_Entrada</th>
                   <th>F_Entrada</th>
                   <th>H_Entrada</th>
	     	   <th>H_Salida</th>
		   <th>Tiempo</th>
                   <th>Dependencia</th>


	    </tr>
	    <?
            $t=1;
            $Hora="SELECT parametrohora.* FROM parametrohora";
            $resH=mysql_query($Hora)or die ("Error al validar el parametro de la hora");
            $fila=mysql_fetch_array($resH);
            while($Registro=mysql_fetch_array($resE)){
                   $HoraEntrada =  strtotime($Registro['horaIngreso']) ;
			    echo "<tr  class='cajas'>";
	                    echo "<th>" . $t . "</th>";
                            echo "<td style='text-aign: left;width: 90px'>" . $Registro['id'] . "</td>";
	                    echo "<td style='text-align: center;width: 65px'>" . $Registro['fecha'] . "</td>";
                            echo "<td style='text-align: center;width: 65px'>" . $Registro['horaIngreso'] . "</td>";
	                    echo "<td style='text-align: center;width: 65px'>" . $Registro['horaSalida'] . "</td>";
	                    echo "<td style='text-align: center;width: 35px'>" . $Registro['tiempoTotal'] . "</td>";
	                    echo "<td style='text-align: center;width: 250px'>" . $Registro['nombreDependencia'] . "</td>";
                            echo "</tr>";
	                  $t=$t + 1;
	    }
      }else{
            echo "NO HAY REGISTROS PARA MOSTRAR EN ESTA VISTA";
      }
      ?>
	</table>
  </div>
  </div>
  <tr>&nbsp;</td>
  <div align="center"><a href="../ppal/consultazona.php?codigo=<?echo $codigo;?>"><img src="../image/regresar.png" border="0" alt="Regresar al menu de consulta"></div>
<?
}
?>
</body>

</html>
