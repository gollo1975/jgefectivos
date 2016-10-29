<html>
<head>
  <title>Creando Nomina</title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
  <script language="javascript">

              function actualizarSaldo()
              {
               totalAutorizaciones = document.getElementById("tActualizaciones").value
               subtotal =0
               subtotal1 =0
               suma = 0
               suma1 = 0
               xpresta= 0
               tot = 0
               total=0
               eps=0
               pension=0
               aux=0
               for (i=1;i<=totalAutorizaciones;i++)
               {
                    if (document.getElementById("datos[" + i+ "]").checked == true )
                    {
                        if(document.getElementById("vlrhora[" + i+ "]").value!=0)
                        {
                                suma = document.getElementById("vlrhora[" + i+ "]").value
                                suma1 = document.getElementById("nrohora[" + i+ "]").value
                                total = (suma * suma1);
                                document.getElementById("salario["+ i+"]").value= total.toFixed(0);
                        }
                           if (document.getElementById("prestacion[" + i+ "]").value=='SI')
                           {
                             xpresta = parseFloat(xpresta) + parseFloat(document.getElementById("salario[" + i+ "]").value);
                             document.getElementById("presta").value =  parseFloat(xpresta);
                           }
                              subtotal = parseFloat(subtotal) + parseFloat(document.getElementById("salario[" + i+ "]").value);
                              if (document.getElementById("variacion[" + i+ "]").value=='VARIABLE')
                              {
                                 aux= parseFloat(document.getElementById("porcenta[" + i+"]").value);
                                 eps = (-xpresta * aux)/100;
                                 document.getElementById("deduccion["+ i+ "]").value= eps.toFixed(0);
                               }
                               subtotal1 = parseFloat(subtotal1) + parseFloat(document.getElementById("deduccion[" + i+ "]").value);
                               tot= (subtotal + subtotal1);
                               document.getElementById("devengado").value =  parseFloat(subtotal);
                               document.getElementById("dedu").value =  parseFloat(subtotal1);
                               document.getElementById("neto").value =  parseFloat(tot);
                     }

               }
             }
                            function tick()
 						{
							  var hours, minutes, seconds, ap;
							  var intHours, intMinutes, intSeconds;
							  var today;

							  today = new Date();

							  intHours = today.getHours();
							  intMinutes = today.getMinutes();
							  intSeconds = today.getSeconds();

							  switch(intHours){
								   case 0:
									   intHours = 12;
									   hours = intHours+":";
									   ap = "A.M.";
									   break;
								   case 12:
									   hours = intHours+":";
									   ap = "P.M.";
									   break;
								   case 24:
									   intHours = 12;
									   hours = intHours + ":";
									   ap = "A.M.";
									   break;
								   default:
									   if (intHours > 12)
									   {
										 intHours = intHours - 12;
										 hours = intHours + ":";
										 ap = "P.M.";
										 break;
									   }
									   if(intHours < 12)
									   {
										 hours = intHours + ":";
										 ap = "A.M.";
									   }
								}


							  if (intMinutes < 10) {
								 minutes = "0"+intMinutes+":";
							  } else {
								 minutes = intMinutes+":";
							  }

							  if (intSeconds < 10) {
								 seconds = "0"+intSeconds+" ";
							  } else {
								 seconds = intSeconds+" ";
							  }

							  timeString = hours+minutes+seconds+ap;
							  mifactura.fechahora.value = timeString;
							  //Clock.innerHTML = timeString;

							  window.setTimeout("tick();", 100);
							}

							window.onload = tick;
</script>

</head>
<body>
<?
include ("../conexion.php");
$conemple="select empleado.vlrpagado,empleado.tiempo,empleado.periodo,empleado.basico from empleado
        where empleado.cedemple='$cedula'";
$resuemple=mysql_query($conemple)or die("Error al buscar empleados $conemple");
$filas_e=mysql_fetch_array($resuemple);
$basico=$filas_e["vlrpagado"];
$cons="select nomina.cedemple from nomina
        where nomina.desde='$desde' and
              nomina.hasta='$hasta' and
              nomina.cedemple='$cedula'";
$resu=mysql_query($cons)or die("Consulta incorrecta $cons");
$reg=mysql_num_rows($resu);
if($reg!=0):
  ?>
  <script language="javascript">
    alert("Este empleado Ya se le creo este periodo de Nomina ?")
    history.back()
  </script>
  <?
else:
$dia=substr($fechainic,8,2);
$calculo=substr($hasta,8,2);
$inicio=substr($desde,8,2);
$Tdias=($calculo-$inicio)+1;
$Tdias1=($calculo-$dia)+1;
$resta=($calculo-$dia)+1;
$Thora=($Tdias*8);
$ThoraInicio=($resta*8);
$aux=substr($fechainic,2,8);
$auxInicio=substr($desde,2,8);
$consulta="select empleado.cedemple,empleado.nomemple,empleado.apemple,empleado.nomemple1,empleado.apemple1,empleado.codbanco,empleado.periodo,empleado.tiempo,empleado.vlrpagado,empleado.basico from empleado where empleado.cedemple='$cedula'";
$resultado=mysql_query($consulta)or die("Consulta incorrecta");
$registro=mysql_affected_rows();
$filas=mysql_fetch_array($resultado);
  ?>
  <center><h4><u>Procesando Nomina</u></h4></center>
  <form action="guardarnomina.php" name="mifactura" method="post">
  <td><input type="hidden" name="codzona" value="<? echo $codzona;?>"></td>
  <td><input type="hidden" name="codbanco" value="<? echo $filas["codbanco"];?>"></td>
  <td><input type="hidden" name="codnomina" value="<? echo $codnomina;?>"></td>
  <td><input type="hidden" name="Auxiliar" value="<? echo $Auxiliar;?>"></td>
  <td><input type="hidden" name="Documento" value="<? echo $Documento;?>"></td>
  <td><input type="hidden" name="codigo" value="<? echo $codigo;?>"></td>
   <table border="0" align="center" width="100">
       <tr>
         <td><b>Documento:</b></td>
         <td><input type="text" value="<? echo $filas["cedemple"];?>" name="cedula" size="14" class="cajas" readonly></td>
         <td><b>Fecha_Proceso:</b></td>
         <td><input type="text" value="<? echo date("Y-m-d");?>" name="fechap" size="14" class="cajas" readonly></td>
       </tr>
       <tr>
          <td><b>Empleado:</b></td>
         <td colspan="3"><input type="text" value="<? echo $filas["nomemple"];?>&nbsp;<? echo $filas["nomemple1"];?>&nbsp;<? echo $filas["apemple"];?>&nbsp;<? echo $filas["apemple1"];?>" name="empleado" size="47" class="cajas" readonly></td>
       </tr>
       <td><b>Desde:</b></td>
         <td><input type="text" value="<? echo $desde;?>" name="desde" size="14"  class="cajas" readonly></td>
         <td><b>Hasta:</b></td>
         <td><input type="text" value="<? echo $hasta;?>" name="hasta" size="14"  class="cajas" readonly></td>
       </tr>
       </tr>
        <td><b>Periodo</b></td>
         <td><input type="text" name="periodo" value="<?echo $filas["periodo"];?>"  size="14" class="cajas" readonly></td>
         <td><b>Salario:</b></td>
         <td><input type="text" name="basico" value="<?echo $filas["basico"];?>"  size="14" class="cajas" readonly></td>
       </tr>
       </tr>
        <td><b>Básico:</b></td>
         <td><input type="text" name="pagado" value="<?echo $filas["vlrpagado"];?>"  size="14" class="cajas" readonly></td>
         <td><b>Tiempo:</b></td>
         <td><input type="text" name="tiempo" value="<?echo $filas["tiempo"];?>"  size="14" class="cajas" readonly></td>
       </tr>
       </tr>
       <td><b>Devengado:</b></td>
         <td><input type="text" name="devengado" value=""  size="14" class="cajas"></td>
         <td><b>Deducción:</b></td>
         <td><input type="text" name="dedu" value=""  size="14"  class="cajas"></td>
       </tr>
        <td><b>Neto_Pagar:</b></td>
         <td><input type="text" name="neto" value=""  size="14" class="cajas"></td>
         <td><b>Prestación:</b></td>
         <td><input type="text" name="presta" value=""  size="14" class="cajas"></td>
       </tr>
     <?if($auxInicio>$aux):?>
        <td><b>Dia_Pagar:</b></td>
         <td><input type="text" name="diaspagar" value="<?echo $Tdias;?>"  size="5" class="cajas" readonly></td>
         <td><b>Total_Horas:</b></td>
         <td><input type="text" name="totalhora" value="<?echo $Thora;?>"  size="5" class="cajas" readonly>
          <input type="hidden" name="fechahora" value="" size="12" class="cajas" readonly></td>
       </tr>
     <?else:?>
         <td><b>Dia_Pagar:</b></td>
         <td><input type="text" name="diaspagar" value="<?echo $Tdias1;?>"  size="5" class="cajas" readonly></td>
         <td><b>Total_Horas:</b></td>
         <td><input type="text" name="totalhora" value="<?echo $ThoraInicio;?>"  size="5" class="cajas" readonly></td>
         <input type="hidden" name="fechahora" value="" size="12" class="cajas" readonly></td>
       </tr>
       <?endif;?>
    </table>
  <?
  include("../conexion.php");
  $con1="select centro.codcentro,decentro.* from centro,empleado,decentro where
	     empleado.cedemple=centro.cedemple and
	     decentro.codcentro=centro.codcentro and
	     empleado.cedemple='$cedula' and
             decentro.activo='SI' order by decentro.porcentaje";
  $resu1=mysql_query($con1)or die ("Consulta Incorrecta 1");
  $reg1=mysql_num_rows($resu1);
  if($reg1!=0):
           $conN="select novedadnomina.* from novedadnomina,empleado
            where empleado.cedemple=novedadnomina.cedemple and
                  novedadnomina.desde='$desde' and
                  novedadnomina.hasta='$hasta' and
                  empleado.cedemple='$cedula'order by novedadnomina.nombre";
           $resuN=mysql_query($conN)or die ("Error al Buscar Novedades");
	   $regN=mysql_num_rows($resuN);
           $filasN=mysql_fetch_array($resuN);
           $codNovedad=$filasN["codnovedad"];
           if($regN==0):
		  ?>
		   <table border="0" align="center">
                     <tr class="cajas">
		      <th><b>Código</b></th><th><b>Descripción</b></th><th><b>Vlr_Hora</b></th><th><b>Nro_Hora</b></th><th><b>Devengado</b></th><th><b>%Por.</b></th><th><b>Deducción</b></th>
		    </tr>
		    <tr>
		     <td><br></td>
		    </tr>
		    <?
		    $i=1;
		    $con="select nomina.cedemple from nomina where nomina.cedemple='$cedula'";
		    $res=mysql_query($con)or die ("Error de consulta");
		    $reg=mysql_affected_rows();
		    if($reg==0):
		        echo ("<input type=\"hidden\" id=\"tActualizaciones\" name=\"tActualizaciones\" value=\"" . mysql_num_rows($resu1) . "\">");
		        while ($filas_s = mysql_fetch_array($resu1)):
                           $Xcontrol=$filas_s["datos"];
           	           ?>
		           <tr class="cajas">
			            <?
			            echo ("<td><input type=\"checkbox\" id=name=\"datos[" . $i . "]\" name=\"datos[" . $i . "]\" value=\"" . $filas_s['codsala'] ."\" onClick=\"actualizarSaldo()\">" .$filas_s['codsala']."</td>");?>
			             <!-- <td><input type="checkbox" id=name="datos[]" value="<?echo $filas_s["codsala"];?>"onClick="actualizarSaldo()">&nbsp;&nbsp;&nbsp;<?echo $filas_s["codsala"];?></td>-->
			             <td><input type="text" value="<?echo $filas_s["descripcion"];?>" name="descrip[<? echo $i;?>]"id="descrip[<? echo $i;?>]" size="35" maxlength="35" readonly class="cajas"> <option></td>
			             <td><input type="text" value="<?echo $filas_s["vlrhora"];?>" name="vlrhora[<? echo $i;?>]"id="vlrhora[<? echo $i;?>]"size="8" mexlength="8"  readonly></td>
                                     <?if ($Xcontrol=='SI'):?>
                                        <?if($auxInicio>$aux):?>
			                    <td><input type="text" value="<?echo $Thora;?>" name="nrohora[<? echo $i;?>]"id="nrohora[<? echo $i;?>]"size="4" mexlength="4"></td>
                                         <?else:?>
                                            <td><input type="text" value="<?echo $ThoraInicio;?>" name="nrohora[<? echo $i;?>]"id="nrohora[<? echo $i;?>]"size="4" mexlength="4"></td>
                                         <?endif;?>
                                     <?else:?>
                                       <td><input type="text" value="<?echo $filas_s["nrohora"];?>" name="nrohora[<? echo $i;?>]"id="nrohora[<? echo $i;?>]"size="4" mexlength="4"></td>
                                     <?endif;?>
			             <td><input type="text" value="<?echo round($filas_s["salario"]/15*$resta,0);?>" name="salario[<? echo $i;?>]" id="salario[<? echo $i;?>]"size="11" mexlength="11"></td>
			             <input type="hidden" value="<?echo $filas_s["prestacion"];?>" name="prestacion[<? echo $i;?>]"id="prestacion[<? echo $i;?>]"size="11" mexlength="11"readonly>
			             <td><input type="text" value="<?echo $filas_s["porcentaje"];?>" name="porcenta[<? echo $i;?>]"id="porcenta[<? echo $i;?>]"size="5" mexlength="5"readonly></td>
			             <td><input type="text" value="<?echo round($filas_s["deduccion"],0);?>" name="deduccion[<? echo $i;?>]"id="deduccion[<? echo $i;?>]"size="9" mexlength="9"></td>
			             <input type="hidden" value="<?echo $filas_s["variacion"];?>" name="variacion[]"id="variacion[<? echo $i;?>]"size="5" mexlength="5"readonly>
		           </tr>
		            <?
		            $i=$i+1;
		        endwhile;
		    else:
		          echo ("<input type=\"hidden\" id=\"tActualizaciones\" name=\"tActualizaciones\" value=\"" . mysql_num_rows($resu1) . "\">");
		           while ($filas_s = mysql_fetch_array($resu1)):
                              $Xcontrol=$filas_s["datos"];
		               ?>
		               <tr class="cajas">
		                  <? 
		                  echo ("<td><input type=\"checkbox\" id=name=\"datos[" . $i . "]\" name=\"datos[" . $i . "]\" value=\"" . $filas_s['codsala'] ."\" onClick=\"actualizarSaldo()\">" .$filas_s['codsala']."</td>");?>
		                  <!-- <td><input type="checkbox" id=name="datos[]" value="<?echo $filas_s["codsala"];?>"onClick="actualizarSaldo()">&nbsp;&nbsp;&nbsp;<?echo $filas_s["codsala"];?></td>-->
		                  <td><input type="text" value="<?echo $filas_s["descripcion"];?>" name="descrip[<? echo $i;?>]"id="descrip[<? echo $i;?>]" size="35" maxlength="35" readonly class="cajas"></td>
		                  <td><input type="text" value="<?echo $filas_s["vlrhora"];?>" name="vlrhora[<? echo $i;?>]"id="vlrhora[<? echo $i;?>]"size="8" mexlength="8"  readonly></td>
                                   <?if ($Xcontrol=='SI'):?>
                                        <?if($auxInicio>$aux):?>
			                    <td><input type="text" value="<?echo $Thora;?>" name="nrohora[<? echo $i;?>]"id="nrohora[<? echo $i;?>]"size="4" maxlength="4"></td>
                                         <?else:?>
                                            <td><input type="text" value="<?echo $ThoraInicio;?>" name="nrohora[<? echo $i;?>]"id="nrohora[<? echo $i;?>]"size="4" mexlength="4"></td>
                                         <?endif;?>
                                   <?else:?>
                                       <td><input type="text" value="<?echo $filas_s["nrohora"];?>" name="nrohora[<? echo $i;?>]"id="nrohora[<? echo $i;?>]"size="4" maxlength="a"></td>
                                  <?endif;?>
		                  <td><input type="text" value="<?echo $filas_s["salario"];?>" name="salario[<? echo $i;?>]" id="salario[<? echo $i;?>]"size="11" mexlength="11"></td>
		                  <input type="hidden" value="<?echo $filas_s["prestacion"];?>" name="prestacion[<? echo $i;?>]"id="prestacion[<? echo $i;?>]"size="11" mexlength="11"readonly>
		                  <td><input type="text" value="<?echo $filas_s["porcentaje"];?>" name="porcenta[<? echo $i;?>]"id="porcenta[<? echo $i;?>]"size="5" mexlength="5"readonly></td>
		                  <td><input type="text" value="<?echo round($filas_s["deduccion"],0);?>" name="deduccion[<? echo $i;?>]"id="deduccion[<? echo $i;?>]"size="9" mexlength="9"></td>
		                  <input type="hidden" value="<?echo $filas_s["variacion"];?>" name="variacion[]"id="variacion[<? echo $i;?>]"size="5" mexlength="5"readonly>
		               </tr>
		               <?
		           $i=$i+1;
		           endwhile;
		    endif;
           else:
           /*CODIGO PARA INGRESO DE NOVEDADES*/
              ?>
		   <table border="0" align="center">
		    <tr><td>&nbsp;</td></tr>
		    <tr class="cajas">
		      <td><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cuenta</b></td><td><b>Descripción</b></td><td><b>Vlr_Hora</b></td><td><b>Nro_Hora</b></td><td><b>Devengado</b></td><td><b>%Porc.</b></td><td><b>Deducción</b></td>
		    </tr>
		    <tr>
		     <td><br></td>
		    </tr>
		    <?
                    $conP="select denovedanomina.* from novedadnomina,denovedanomina
                           where novedadnomina.codnovedad=denovedanomina.codnovedad and
                           novedadnomina.codnovedad='$codNovedad' order by denovedanomina.porcentaje";
                    $resuP=mysql_query($conP)or die ("Error al buscar novedades");
                    $regP=mysql_num_rows($resuP);
                    $i=1;
                    echo ("<input type=\"hidden\" id=\"tActualizaciones\" name=\"tActualizaciones\" value=\"" . mysql_num_rows($resuP) . "\">");
                    if($regP!=0):
			    $con="select nomina.cedemple from nomina where nomina.cedemple='$cedula'";
			    $res=mysql_query($con)or die ("Error de consulta");
			    $reg=mysql_affected_rows();
			    if($reg==0):
			        while ($filas_s = mysql_fetch_array($resuP)):
			           ?>
			           <tr class="cajas">
				            <?
				            echo ("<td><input type=\"checkbox\" id=name=\"datos[" . $i . "]\" name=\"datos[" . $i . "]\" value=\"" . $filas_s['codsala'] ."\" onClick=\"actualizarSaldo()\">" .$filas_s['codsala']."</td>");?>
				             <!-- <td><input type="checkbox" id=name="datos[]" value="<?echo $filas_s["codsala"];?>"onClick="actualizarSaldo()">&nbsp;&nbsp;&nbsp;<?echo $filas_s["codsala"];?></td>-->
				             <td><input type="text" value="<?echo $filas_s["concepto"];?>" name="descrip[<? echo $i;?>]"id="descrip[<? echo $i;?>]" size="35" maxlength="35" readonly class="cajas"></td>
				             <td><input type="text" value="<?echo $filas_s["vlrhora"];?>" name="vlrhora[<? echo $i;?>]"id="vlrhora[<? echo $i;?>]"size="8" maxlength="8"  readonly></td>
				             <td><input type="text" value="<?echo $filas_s["nrohora"];?>" name="nrohora[<? echo $i;?>]"id="nrohora[<? echo $i;?>]"size="4" maxlength="4"></td>
				             <td><input type="text" value="<?echo round($filas_s["salario"]/15*$resta,0);?>" name="salario[<? echo $i;?>]" id="salario[<? echo $i;?>]"size="11" mexlength="11"></td>
				             <input type="hidden" value="<?echo $filas_s["prestacion"];?>" name="prestacion[<? echo $i;?>]"id="prestacion[<? echo $i;?>]"size="5" mexlength="5"readonly>
                                             <input type="hidden" value="<?echo $filas_s["variacion"];?>" name="variacion[]"id="variacion[<? echo $i;?>]"size="5" mexlength="5"readonly>
                                             <td><input type="text" value="<?echo $filas_s["porcentaje"];?>" name="porcenta[<? echo $i;?>]"id="porcenta[<? echo $i;?>]"size="5" mexlength="5"readonly></td>
				             <td><input type="text" value="<?echo round($filas_s["deduccion"],0);?>" name="deduccion[<? echo $i;?>]"id="deduccion[<? echo $i;?>]"size="9" mexlength="9"></td>
			           </tr>
			            <?
			            $i=$i+1;
			        endwhile;
			    else:
                                while($filas_s=mysql_fetch_array($resuP)):
	                                    ?>
					    <tr class="cajas">
					    <?
                                                echo ("<td><input type=\"checkbox\" id=name=\"datos[" . $i . "]\" name=\"datos[" . $i . "]\" value=\"" . $filas_s['codsala'] ."\" onClick=\"actualizarSaldo()\">" .$filas_s['codsala']."</td>");?>
   			                        <!-- <td><input type="checkbox" id=name="datos[]" value="<?echo $filas_s["codsala"];?>"onClick="actualizarSaldo()">&nbsp;&nbsp;&nbsp;<?echo $filas_s["codsala"];?></td>-->
                                                <td><input type="text" value="<?echo $filas_s["concepto"];?>" name="descrip[<? echo $i;?>]"id="descrip[<? echo $i;?>]" size="35" maxlength="35" readonly class="cajas"></td>
					        <td><input type="text" value="<?echo $filas_s["vlrhora"];?>" name="vlrhora[<? echo $i;?>]"id="vlrhora[<? echo $i;?>]"size="8" maxlength="8"  readonly></td>
	                                        <td><input type="text" value="<?echo $filas_s["nrohora"];?>" name="nrohora[<? echo $i;?>]"id="nrohora[<? echo $i;?>]"size="4" maxlength="4"></td>
					        <td><input type="text" value="<?echo $filas_s["salario"];?>" name="salario[<? echo $i;?>]" id="salario[<? echo $i;?>]"size="11" mexlength="11"></td>
					        <input type="hidden" value="<?echo $filas_s["prestacion"];?>" name="prestacion[<? echo $i;?>]"id="prestacion[<? echo $i;?>]"size="11" mexlength="11"readonly>
                                                <input type="hidden" value="<?echo $filas_s["variacion"];?>" name="variacion[]"id="variacion[<? echo $i;?>]"size="5" mexlength="5"readonly>
                                                <td><input type="text" value="<?echo $filas_s["porcentaje"];?>" name="porcenta[<? echo $i;?>]"id="porcenta[<? echo $i;?>]"size="4" mexlength="4"readonly></td>
					        <td><input type="text" value="<?echo round($filas_s["deduccion"],0);?>" name="deduccion[<? echo $i;?>]"id="deduccion[<? echo $i;?>]"size="9" mexlength="9"></td>

					               </tr>
	                                            <?
	                                            $i=$i+1;
	                                endwhile;
	                    endif;
		    endif;
           endif;
        ?>
        <td><input type="hidden" name="i" value="<? echo $i;?>"></td>
        <td><input type="hidden" name="desde" value="<? echo $desde;?>"></td>
        <td><input type="hidden" name="hasta" value="<? echo $hasta;?>"></td>
        <tr>
         <td colspan="1"><input type="submit" value="Enviar Dato" class="boton"></td>
        </tr>
     </table>
     <table  border="0" align="center">
       <tr>
          <td><b><a href="nomina.php?Auxiliar=<?echo $Auxiliar;?>&Documento=<?echo $Documento;?>">Volver</b></a> </td>
       </tr>
     <table>
 <?
else:
   ?>
   <script language="javascript">
     alert("Este Empleado No tiene centro de costo Creado ?")
     history.back()
     </script>
   <?
endif;
endif;
?>
</form>
</body>
</html>
