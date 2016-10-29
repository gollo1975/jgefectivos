<html>

<head>
  <title>Listado Empleado</title>
<LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
<script type="text/javascript">
    function ActualizarSaldo()
         {
         totalitem = 0
         pagado = 0
         totalitem =  document.getElementById("TotalV").value
         var nEle = document.f1.elements.length;
               for (i=0; i<nEle; i++) {
                  if (document.f1.elements[i].type=="checkbox" &&
	                document.f1.elements[i].name.lastIndexOf('datoN')!=-1 ) {
			document.f1.elements[i].checked ? document.f1.elements[i].checked=false : document.f1.elements[i].checked=true;
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
							  f1.FechaHora.value = timeString;
							  //Clock.innerHTML = timeString;

							  window.setTimeout("tick();", 100);
							}

							window.onload = tick;

</script>
</body>
<?
 include("../conexion.php");
$consulta="select concat(nomemple,' ',nomemple1) as nombres,concat(apemple,' ',apemple1) as apellidos,empleado.codcosto,empleado.cedemple,contrato.fechainic,contrato.salario,costo.centro,zona.zona,periodo.desde,periodo.hasta,periodo.codigo,detalladozona.pnomina,contrato.tiposalario as TipoSalario from empleado,zona,detalladozona,contrato,periodo,costo where
	zona.codzona=empleado.codzona and
	periodo.codzona=zona.codzona and
	zona.codzona=detalladozona.codzona and
	periodo.estado='FALTA' and
	empleado.codemple=contrato.codemple and
	contrato.fechater='0000-00-00'and
	empleado.codcosto=costo.codcosto and
	contrato.fechainic <= '$hasta' and
	empleado.nomina='SI' and
	zona.codzona='$codzona' order by empleado.nomemple,empleado.apemple,contrato.fechainic";
	$resultado=mysql_query($consulta)or die ("Error al Buscar Empleados");
	$registro=mysql_num_rows($resultado);
	if ($registro==0):
	          ?>
	          <script language="javascript">
	             alert("La nomina de esta empresa ya se genero en el sistema.!")
	             history.back()
	          </script>
	          <?
	       else:
	       ?>
                   <div align="center"><b><u><h4><?echo $Zona;?></h4></u></b></div>
                    <tr><td><br></td></tr>
	             <form action="GenerarNomina.php" name="f1"  method="post">
                       <td><input type="hidden" name="desde" value="<?echo $desde;?>"></td>
                       <td><input type="hidden" name="codzona" value="<?echo $codzona;?>"></td>
                       <td><input type="hidden" name="hasta" value="<?echo $hasta;?>"></td>
                       <td><input type="hidden" name="CodPeriodo" value="<?echo $CodPeriodo;?>"></td>
                        <td><input type="hidden" name="Auxiliar" value="<?echo $Auxiliar;?>"></td>
                         <td><input type="hidden" name="CodPeriodo" value="<?echo $CodPeriodo;?>"></td>
                       <td><input type="hidden" name="Zona" value="<?echo $Zona;?>"></td>
                       <input type="hidden" name="FechaHora" value="" size="12" class="cajas" readonly></td>
	               <table border="0" align="center">
		         <tr  class="fondo">
		            <td colspan="9"></td>
		         </tr>
		          <tr class="cajas">
			       <th>Item</th><th><input type="checkbox" name="calculo" onClick="ActualizarSaldo()"></th><th><b>Documento</b></th><th><b>Empleado</b></th><th><b>Desde</b></th><th><b>Hasta</b></th><th><b>Fecha_Ing</b></th> <th><b>Salario</b></th>
			  </tr>
		          <?
		          $i=1;
		           while($filas=mysql_fetch_array($resultado)):
                              $aux=number_format($filas["salario"],0);
		                   $Cedula= $filas["cedemple"];
		               $conP="select nomina.cedemple from nomina
			               where nomina.cedemple='$Cedula' and
			               nomina.desde='$desde' and
		                   nomina.hasta='$hasta' and
                           nomina.codzona='$codzona'";
			           $ReP=mysql_query($conP)or die("Error en la busqueda de Empleados");
			           $regP=mysql_num_rows($ReP);
		           if($regP==0):
			       ?>
		               <tr  class="cajas">
		                  <th><?echo $i;?></th><?
		                  echo ("<td><input type=\"checkbox\" id=name=\"datoN[" . $i . "]\" name=\"datoN[" . $i . "]\" value=\"" . $filas['cedemple'] ."\" onClick=\"ActualizarSaldo()\"></td>");?>
		                  <td class="cajas"><?echo $filas["cedemple"];?></td>
		                  <td class="cajas"><?echo $filas["nombres"];?>&nbsp;<?echo $filas["apellidos"];?></td>
		                 <td class="cajas"><?echo $filas["desde"];?></td>
		                 <td class="cajas"><?echo $filas["hasta"];?></td>
		                 <td><div align="center"><?echo $filas["fechainic"];?></div></td>
                                 <input type="hidden"  value="<?echo $filas["fechainic"];?>"name="FechaIniCont[<? echo $i;?>]" id="FechaIniCont[<? echo $i;?>]" class="cajas" size="10" readonly>
                                 <input type="hidden"  value="<?echo $filas["TipoSalario"];?>"name="TipoSalario[<? echo $i;?>]" id="TipoSalario[<? echo $i;?>]" class="cajas" size="15" readonly>
		                 <td><div align="right">$<?echo $aux;?></div></td>
		              </tr>
		            <?
		             $i=$i+1;
                          else:
                            $Con=$Con+1;
                          endif;
		           endwhile;
                           $registro=$registro-$Con;
                           echo ("<input type=\"hidden\" id=\"TotalV\" name=\"TotalV\" value=\"" . $registro . "\">");
		           ?>
	                <tr><td><br></td></tr>
	                <td colspan="5">
		          <input type="submit" value="Generar Nómina" class="boton" ></td>
	              </table>
	             </form>
	           <?
	       endif;
?>
 </body>
</html>
