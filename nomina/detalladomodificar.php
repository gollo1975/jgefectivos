<html>
	<head>
  		<title></title>
  		<LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
  		<script type="text/javascript">
		
     		function ActualizarSaldo()	{
			
          		var aux = 0;
          		var subtotal = 0;
          		var subtotal1 = 0;
          		var totalitem =  document.getElementById("TotalV").value;
          		var nEle = document.f1.elements.length;
          		for (i = 0; i < nEle; i++) {
				
               		if (document.f1.elements[i].type == "checkbox" && document.f1.elements[i].name.lastIndexOf('datoN') !=- 1) {
					
	     	   			document.f1.elements[i].checked ? document.f1.elements[i].checked=false : document.f1.elements[i].checked=true;
	       			}
          		}
              	for (k = 1; k<= totalitem; k++)	{
				
                	if (document.f1.elements ("datoN[" + k + "]").checked == true )	{
				  
	                  	subtotal +=  parseFloat (document.getElementById("deven[" + k + "]").value);
    	                subtotal1 += parseFloat(document.getElementById("deduccion[" + k+ "]").value);
        	            aux = (subtotal + subtotal1);
            	        f1.devengado.value =  subtotal;
                	    f1.dedu.value = subtotal1;
                    	f1.neto.value = aux;
                    }
               }
     		}
		</script>
	</head>
	<body>
<?php

	include("../conexion.php");
	$con1="select empleado.nomemple,empleado.apemple,empleado.apemple1,empleado.nomemple1,nomina.* from nomina,empleado
     where empleado.cedemple=nomina.cedemple and
          nomina.estado='ABIERTO' and
          nomina.consecutivo='$codigo'";
$resu1=mysql_query($con1)or die ("Consulta Incorrecta 1");
$reg1=mysql_num_rows($resu1);
$filas = mysql_fetch_array($resu1);
if($reg1!=0):
	$cedula=$filas["cedemple"];
	$cambio=$filas["devengado"];
	$cambio1=$filas["deduccion"];
	$cambio2=$filas["neto"];
	$desde=$filas["desde"];
	$hasta=$filas["hasta"];
	?>
	  <center><h4><u>Datos de la Colilla</u></h4></center>
	  <form action="guardarsegunda.php" name="f1" id="f1" method="post" >
	    <table border="0" align="center" width="100">
	    <td><input type="hidden" name="hasta" value="<? echo $filas["hasta"];?>"></td>
	      <tr>
	         <td><b>Cod_Nomina:</b></td>
	         <td><input type="text" name="codigo" value="<? echo $codigo;?>"  size="12" maxlength="12" class="cajas" readonly></td>
	         <td><b>Cod_Periodo:</b></td>
	         <td><input type="text" name="codigop" value="<? echo $filas["codigo"];?>"  size="12" maxlength="12" class="cajas" readonly></td>
	      </tr>
	      <tr>
	         <td><b>Documento:</b></td>
	         <td><input type="text" value="<? echo $filas["cedemple"];?>" name="cedula" size="12" maxlength="12" class="cajas" readonly></td>
	         <td><b>Fecha_Proceso:</b></td>
	         <td><input type="text" value="<? echo $filas["fechap"];?>" name="fechap" size="12" maxlength="10" class="cajas" readonly></td>
	      </tr>
	       <tr>
	          <td><b>Empleado:</b></td>
	         <td colspan="3"><input type="text" value="<? echo $filas["nomemple"];?>&nbsp;<? echo $filas["nomemple1"];?>&nbsp;<? echo $filas["apemple"];?>&nbsp;<? echo $filas["apemple1"];?>" name="empleado" size="44" maxlength="45" class="cajas" readonly></td>
	       </tr>
	       <td><b>Desde:</b></td>
	         <td><input type="text" value="<? echo $filas["desde"];?>" name="desde" size="12" maxlength="12" class="cajas" readonly></td>
	         <td><b>Hasta:</b></td>
	         <td><input type="text" value="<? echo $filas["hasta"];?>" name="hasta" size="12" maxlength="12" class="cajas" readonly></td>
	       </tr>
	       </tr>
	       <td><b>Devengado:</b></td>
	         <td><input type="text" value="<? echo $filas["devengado"];?>" name="devengado"   size="12" maxlength="12" class="cajas"></td>
	         <td><b>Deducción:</b></td>
	         <td><input type="text" value="<? echo $filas["deduccion"];?>" name="dedu"   size="12" maxlength="12" class="cajas"></td>
	       </tr>
	        <td><b>Neto_Pagar:</b></td>
	         <td><input type="text" value="<? echo $filas["neto"];?>" name="neto"   size="12" maxlength="12" class="cajas"></td>
	         <td><b>Prestación:</b></td>
	         <td><input type="text" value="<? echo $filas["presta"];?>" name="presta" size="12" maxlength="12" class="cajas"></td>
	       </tr>
	    </table>
	  <?
	$con="select denomina.* from nomina,denomina where
	      nomina.consecutivo=denomina.consecutivo and
	      nomina.consecutivo='$codigo'order by denomina.porcentaje";
	$resu=mysql_query($con)or die ("Consulta Incorrecta 1");
	$reg=mysql_num_rows($resu);
	if($reg!=0):
	  ?>
	   <table border="0" align="center">
	    <tr><td>&nbsp;</td></tr>
	    <tr class="cajas">
	       <th>Item</th><th><input type="checkbox" name="calculo" onClick="ActualizarSaldo()"></th><th><b>Cód_Sal</b></th><th><b>Descripción</b></th><th><b>Vlr_Hora</b></th><th><b>Nro_Hora</b></th><th><b>Devengado</b></th><th><b>%</b></th><th><b>Deducción</b></th>
	    </tr>
	    <?
	    $i=1;
	     echo ("<input type=\"hidden\" id=\"TotalV\" name=\"TotalV\" value=\"" . mysql_num_rows($resu) . "\">");
	     while ($filas_s = mysql_fetch_array($resu)):
	          ?>
	         <tr class="cajas">
                  <th><?echo $i;?></th>
	          <?
	             echo ("<td><input type=\"checkbox\" id=name=\"datoN[" . $i . "]\" name=\"datoN[" . $i . "]\" value=\"" . $filas_s['conse'] ."\" onclick=\"ActualizarSaldo()\"></td>");?>
	             <input type="hidden" value="<?echo $filas_s["conse"];?>" name="conse[<? echo $i;?>]"id="conse[<? echo $i;?>]" size="10" maxlength="10" readonly class="cajas">
	              <td><input type="text" value="<?echo $filas_s["codsala"];?>" class="cajas" name="codsala[<? echo $i;?>]"id="codsala[<? echo $i;?>]"size="5"  readonly></td>
	             <td><input type="text" value="<?echo $filas_s["descripcion"];?>"class="cajas" name="descri[<? echo $i;?>]"id="descri[<? echo $i;?>]"size="33" READONLY></td>
	             <td><input type="text" value="<?echo $filas_s["vlrhora"];?>" class="cajas" name="vlrhora[<? echo $i;?>]" id="vlrhora[<? echo $i;?>]"size="10" ></td>
	             <td><input type="text" value="<?echo $filas_s["nrohora"];?>"class="cajas"  name="nrohora[<? echo $i;?>]"id="nrohora[<? echo $i;?>]"size="6"></td>
	              <td><input type="text" value="<?echo $filas_s["salario"];?>" class="cajas" name="deven[<? echo $i;?>]"id="deven[<? echo $i;?>]"size="13"></td>
	             <td><input type="text" value="<?echo round($filas_s["porcentaje"],0);?>" class="cajas" name="porcen[<? echo $i;?>]"id="porcen[<? echo $i;?>]" size="6"readonly></td>
	             <td><input type="text" value="<?echo $filas_s["deduccion"];?>" class="cajas" name="deduccion[<? echo $i;?>]"id="deduccion[<? echo $i;?>]"size="13"></td>
	         </tr>
	         <?
	         $i=$i+1;
	       endwhile;
	      endif;
	       ?>
	        <tr>
	         <td colspan="5"><input type="submit" value="Enviar" class="boton"></td>
	                </tr>
	   </table>
	    <?
	     $conC = "select centro.cedemple,centro.codcentro from centro where centro.cedemple='$cedula'";
	     $resC = mysql_query ($conC) or die ("Error al buscar centro de costos");
	     $regC=mysql_num_rows($resC);
	     $filas=mysql_fetch_array($resC);
	     $codcentro=$filas["codcentro"];
	     /*codido del detallado*/
	     $conD = "select decentro.codsala,decentro.descripcion,decentro.conse,decentro.vlrhora,decentro.prestacion from decentro,centro where decentro.codcentro=centro.codcentro and
	        centro.codcentro='$codcentro'";
	     $resD = mysql_query ($conD) or die ("Error al buscar centro de costos");
	     $regD=mysql_affected_rows();
	    ?>
	     <table border="0" align="center">
	        <input type="hidden" name="codnovedad" value="<? echo $codnovedad;?>">
	        <tr class="cajas">
	          <td><b>Para Agregar un Item a la Nómina, Presiones Click sobre el Cod_Salario..</b></td>
	        </tr>
	     </table>
	     <form action="cargar.php" method="post">
	          <table border="0" align="center">
	          <tr class="cajas">
	            <td><br></td><td><b><u>Nro Cuenta</u></b></td><td>&nbsp;<b><u>Descripción</u></b></td><td>&nbsp;<b><u>Vlr_Hora</u></b></td><td>&nbsp;<b><u>Prest.</u></b></td>
	          </tr>
	          <tr>
	           <td><br></td>
	          </tr>
	          <?
	          while ($registro = mysql_fetch_array($resD)):
	              ?>
	              <tr class="cajas">
	                <td>&nbsp;&nbsp;<a href="cargardato.php?datos=<?echo $registro["codsala"];?>&codnomina=<? echo $codigo;?>&desde=<? echo $desde;?>&hasta=<? echo $hasta;?>&cedula=<?echo $cedula;?>"><img src="../image/mod.jpg" border="0" alt="Permite agregar Registro"></a></td><td>&nbsp;&nbsp;<?echo $registro["codsala"];?></td>
	                <td>&nbsp;&nbsp;<?echo $registro["descripcion"];?></td>
                         <td>&nbsp;&nbsp;<?echo $registro["vlrhora"];?></td>
                          <td>&nbsp;&nbsp;<?echo $registro["prestacion"];?></td>
	              </tr>
	              <?
	         endwhile;
      else:
         ?>
          <script language="javascript">
             alert("Esta colilla no se puede modificar, ya se hizo el detalle de factura.")
             history.back()
          </script>
         <?

      endif;
                  ?>

       </table>
     </form>
    </table>

</form>
</body>
</html>
