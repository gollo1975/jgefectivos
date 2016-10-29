<html>
<head>
  <title></title>
</head>
<LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
<body>
<script language="javascript">
     function SumarExamen() {
        var Suma = 0;
        var Total = 0;
		var Aux = 0;
        Total = eval(document.getElementById("TotalVector").value);
         for (k = 1;k <= Total; k++) {
            if (document.getElementById("datos[" + k+ "]").checked == true )
               {
                Suma = Suma + eval(document.getElementById("valorE[" + k + "]").value);
                document.getElementById("vlrexamen").value =  parseFloat(Suma);
			   }
			   if (Suma == 0){
				  document.getElementById("vlrexamen").value =  parseFloat(Suma); 
			   }
			  
        }

     }
     function volver()// para declara funcion
        {
                pagina='individual.php'
                tiempo=50
                ubicacion='_self'
                setTimeout("open(pagina,ubicacion)",tiempo)
        }
                    function ColorFoco(obj)
                    {
                        document.getElementById(obj).style.background="#9DFF9D"

                    }

                    function QuitarFoco(obj)
                    {
                        document.getElementById(obj).style.background="white"
                    }
                      function chequearcampos()
                    {
                        if (document.getElementById("cedula").value.length <=0)
                        {
                            alert ("Digite el documento de Identidad ?");
                            document.getElementById("cedula").focus();
                            return;
                        }
						if (document.getElementById("Cargo").value.length == "")
                        {
                            alert ("Favor digite el cargo que va a tener el empleado..");
                            document.getElementById("Cargo").focus();
                            return;
                        }
						
                        document.getElementById("matcrea").submit();

                    }
                    function validar()
                    {
                        if (document.getElementById("nombre").value.length <=0)
                        {
                            alert ("Digite el nombre del empleado ?");
                            document.getElementById("nombre").focus();
                            return;
                        }
                        document.getElementById("matgra").submit();

                    }
					function tick(){
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
					if (intMinutes < 10){
					minutes = "0"+intMinutes+":";
					}else{
					minutes = intMinutes+":";
					}
					if (intSeconds < 10) {
					seconds = "0"+intSeconds+" ";
					} else {
					seconds = intSeconds+" ";
					}
					timeString = hours+minutes+seconds+ap;
					matcrea.FechaHora.value = timeString;
					//Clock.innerHTML = timeString;

					window.setTimeout("tick();", 100);
			}
		    window.onload = tick;			 
                </script>
<?
if(!isset($cedula)):
         include("../conexion.php");
	/*codigo que busca el usuario*/
 $Sql="select acceso.nivel from acceso where acceso.usuario='$CodUsuario'";
	$RsU=mysql_query($Sql)or die ("Error al buscar usuarios ?");
	$filaU=mysql_fetch_array($RsU);
	 $NivelPermiso = $filaU["nivel"];
	   ?>
	  <div align="center"><h4><u>Autorizar Examenes</u></h4></div>
	  <form action="" method="post" id="matcrea">
	  <input type="hidden" name="CodUsuario" value="<?echo $CodUsuario;?>">
	  <input type="hidden" name="FechaHora" value="" id="FechaHora">
	     <table border="0" align="center">
	        <tr><td><br></td></tr>
	        <tr>
	            <td><b>Documento de Identidad:&nbsp;</b></td>
	            <td><input type="text" name="cedula" size="40" maxlength="15" onFocus="ColorFoco(this.id)" class="cajas"onblur="QuitarFoco(this.id)" id="cedula"></td>
	        </tr>
	         <tr>
				         <td><b>Proveedor:</b></td>
				         <td colspan="1"><select name="Proveedor" class="cajasletra" id="Proveedor" style="width: 404px">
				               <option value="0">Seleccione el Proveedor
				               <?
				               $consulta_z="select nitprove,nomprove from provedor where alianzaexamen='SI'  order by nomprove";
				               $resultado_z=mysql_query($consulta_z) or die("Error al buscar proveedor");
				                while ($filas_z=mysql_fetch_array($resultado_z)):
				                   ?>
				                   <option value="<?echo $filas_z["nitprove"];?>"><?echo $filas_z["nomprove"];?>
				                   <?
				               endwhile;
				                    ?>
				             </select></td>
                                     </tr>
                            <?if($NivelPermiso==1){?>
		                              <tr>
					         <td><b>Zona:</b></td>
					         <td colspan="1"><select name="Zona" class="cajasletra" style="width: 404px" id="Zona">
					               <option value="0">Seleccione la zona
					               <?
					               $consulta_z="select codzona,zona from zona where estado='ACTIVA' and nomina='SI' AND zona.estado='ACTIVA'  and zona.tiponegociacion='MISIONAL'order by zona";
					               $resultado_z=mysql_query($consulta_z) or die("Error al buscar proveedor");
					                while ($filas_z=mysql_fetch_array($resultado_z)):
					                   ?>
					                   <option value="<?echo $filas_z["codzona"];?>"><?echo $filas_z["zona"];?>
					                   <?
					               endwhile;
					                    ?>
					             </select></td>
					     </tr>
                                      <?}else{?>
                                             <tr>
					         <td><b>Zona:</b></td>
					         <td colspan="1"><select name="Zona" class="cajasletra" style="width: 404px" id="Zona">
					               <option value="0">Seleccione la zona
					               <?
					               $consulta_z="select zona.codzona,zona.zona from zona,sucursal where
                                                       sucursal.codsucursal=zona.codsucursal and
                                                       sucursal.codsucursal='$codigo' and
                                                       zona.estado='ACTIVA' and
                                                       zona.nomina='SI' AND
                                                       zona.estado='ACTIVA'  and
                                                       zona.tiponegociacion='MISIONAL'order by zona";
					               $resultado_z=mysql_query($consulta_z) or die("Error al buscar empresas usuarias");
					                while ($filas_z=mysql_fetch_array($resultado_z)):
					                   ?>
					                   <option value="<?echo $filas_z["codzona"];?>"><?echo $filas_z["zona"];?>
					                   <?
					               endwhile;
					                    ?>
					             </select></td>
					     </tr>
                                      <?}?>
                                     <tr>
					<td><b>Municipio:</b></td>
					<td colspan="1"><select name="CodMuni" class="cajasletra" id="CodMuni" style="width: 404px">
					<option value="0">Seleccione el Municipio
					<?
					$Sql="select codmuni,municipio from municipio order by municipio.municipio";
					$Rs=mysql_query($Sql) or die("Error al buscar la ciudad");
					while ($fila=mysql_fetch_array($Rs)):
						?>
						<option value="<?echo $fila["codmuni"];?>"><?echo $fila["municipio"];?>
						<?
					endwhile;
					?>
					</select></td>
				</tr>
                                    <tr>
                                        <td><b>Tipo_Examen:</b></td>
                                        <td><select size="1" name="TipoE" class="cajas" style="width: 260px">
                                           <option value="0">Seleccione</option>
                                           <option value="INGRESO">INGRESO</option>
                                           <option value="EGRESO">RETIRO</option>
                                           <option value="PERIODICO">PERIODICO</option>
                                            <option value="OTRO">OTRO</option>
                                     </select></td>
                    </tr>
				<tr>
	               <td><b>Cargo Desempeñar:&nbsp;</b></td>
	               <td><input type="text" name="Cargo" size="40" maxlength="35" onFocus="ColorFoco(this.id)" class="cajas"onblur="QuitarFoco(this.id)" id="Cargo"></td>
           <tr><td><br></td></tr>
	       <td colspan="5">
	       <input type="button" value="Buscar" class="boton" onClick="chequearcampos()" id="buscar"><input type="reset" value="Limpiar" class="boton" ></td>
	     </table>
	    </form>
<?
elseif(empty($Proveedor)):
  ?>
  <script language="javascript">
     alert("Seleccione el proveedor para el examen.")
     history.back()
  </script>
  <?
elseif(empty($Zona)):
  ?>
  <script language="javascript">
     alert("Seleccione la Empresa usuaria de la lista.")
     history.back()
  </script>
  <?
elseif(empty($CodMuni)):
  ?>
  <script language="javascript">
     alert("Seleccione el Municipio de la lista.")
     history.back()
  </script>
  <?
elseif(empty($TipoE)):
  ?>
  <script language="javascript">
     alert("Seleccione el tipo de Examen medico.!")
     history.back()
  </script>
  <?
else:
     include("../conexion.php");
     $Sw=0;
     $Sql="select novedad.estado from novedad where novedad.estado='ACTIVO' and novedad.cedemple='$cedula'";
	$Rs=mysql_query($Sql)or die ("Error al buscar novedades ?");
	$Cont=mysql_num_rows($Rs);
     if($Cont==0){
	   $Cargo = strtoupper($Cargo);
	   $con="select empleado.cedemple,concat(nomemple, ' ' ,nomemple1, ' ' ,apemple, ' ' , apemple1) as nombre,empleado.codzona from empleado where empleado.cedemple='$cedula'";
	   $res=mysql_query($con)or die ("Error al buscar empleados ?");
	   $reg=mysql_num_rows($res);
	   $filas_E=mysql_fetch_array($res);
	   if($reg==0){
		?>
		<script language="javascript">
		alert("Este Empleado no existe en el sistema de la Compañia, favor crearlo.!")
        	</script>
		<?
                $Sw=1;
           }else{
               $Sw=1;
           }
           if($Sw==1){
		   /*codigo de provedor*/
		   $conP="select nitprove,nomprove from provedor where provedor.nitprove='$Proveedor'";
		   $resP=mysql_query($conP)or die ("Error al buscar proveedor del sistema.!");
		   $filas_P=mysql_fetch_array($resP);
		   /*codigo de zona*/
		   $conZ="select zona.codzona,zona.zona,parametroexamen.tipopago,zona.codzona from zona,parametroexamen where
                       zona.codzona='$Zona' and
                       zona.codzona=parametroexamen.codzona";
		   $resZ=mysql_query($conZ)or die ("Error al buscar zonas ?");
		   $filas_Z=mysql_fetch_array($resZ);
                   /*codigo de municipio*/
                       $SqlM="select municipio.municipio from municipio where municipio.codmuni='$CodMuni'";
			$RsM=mysql_query($SqlM)or die ("Error al buscar municipios ?");
			$filaM=mysql_fetch_array($RsM);
			$Municipio = $filaM["municipio"];
		    ?>
			<div align="center"><h4><u>Autorizar Examenes</u></h4></div>
			<form action="grabar.php" method="post" id="matgra" name="Dat">
				<input type="hidden" name="Proveedor" value="<?echo $Proveedor;?>">
				<input type="hidden" name="CodUsuario" value="<?echo $CodUsuario;?>">
				<input type="hidden" name="TipoE" value="<?echo $TipoE;?>">
				<input type="hidden" name="Zona" value="<?echo $Zona;?>">
				<input type="hidden" name="FechaHora" value="<?echo $FechaHora;?>" id="FechaHora">
				<table border="0" align="center">

					<tr>
					<td><b>Documento:</b></td>
					<td><input type="text" name="cedula" value="<?echo $cedula;?>"size="15" class="cajas" readonly onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="cedula"></td>
					</tr>
					<tr>
					<td><b>Empleado:</b></td>
					<td><input type="text" name="nombre" value="<?echo $filas_E["nombre"];?>" size="55" maxlength="55" class="cajas" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="nombre"></td>
					</tr>
					<tr>
					<td><b><a href="ConsultaExamenes.php?CodZona=<?echo $Zona;?>&Zona=<?echo $filas_Z["zona"];?>" target="_blank" >Zona:</a></b></td>
					<td><input type="text" name="Nomzona" value="<? echo $filas_Z["zona"];?>" class="cajas"size="55" readonly onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="Nomzona"></td>
					</tr>
					<tr>
					<td><b>Proveedor:</b></td>
					<td><input type="text" name="Nomprovedor" value="<? echo $filas_P["nomprove"];?>" class="cajas"size="55" readonly onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="Nomprove"></td>
					</tr>
                                        <tr>
					<td><b>Municipio:</b></td>
					<td><input type="text" name="CodMuni" value="<? echo $CodMuni;?>" class="cajas"size="6" readonly onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="CodMuni"><?echo $Municipio;?></td>
					</tr>
                                        <tr>
					<td><b>Cargo:</b></td>
					<td><input type="text" name="Cargo" value="<? echo $Cargo;?>" class="cajas"size="55" maxlength="35" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="Cargo"></td>
					</tr>
					<tr>
					<td><b>F_Examen:</b></td>
					<td><input type="text" name="fechae" value="<? echo date("Y-m-d");?>" class="cajas"size="15" maxlength="10" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="fechae"></td>
					</tr>
					<tr>
					<td><b>Nro_Control:</b></td>
					<td><input type="text" name="radicado" value="" class="cajas" size="15" maxlength="15" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="radicado">
					<b>Tipo_Pago:&nbsp;&nbsp;&nbsp;&nbsp;</b>
					<input type="text" name="pago" value="<?echo $filas_Z["tipopago"];?>" class="cajas" size="15" readonly onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="pago"></td>
					</tr>
					<tr>
					<td><b>Vlr_Examen:</b></td>
					<td><input type="text" name="vlrexamen" value="" class="cajas"size="15" readonly onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="vlrexamen">
					<b>Tipo_Examen:&nbsp;</b
					<td><input type="text" name="TipoE" value="<?echo $TipoE;?>" class="cajas"size="15" readonly onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" readonly id="TipoE"></td>
					</tr>
					<tr><td><br></td></tr>
					<?
					$con1="select examenglobal.* from examenglobal,provedor
					where provedor.nitprove=examenglobal.nitprove and
					provedor.nitprove='$Proveedor'  and
                    examenglobal.codmuni='$CodMuni' and
					examenglobal.estado='ACTIVO'";
					$resu1=mysql_query($con1)or die ("Error al buscar provedores");
					$reg1=mysql_num_rows($resu1);
					if($reg1!=0):
						?>
						<table border="0" align="center">
						<tr class="cajas">
						<th>Conse</th><th><b>&nbsp;<u>Descripción</u></b></th><th><b><u>Valor</u></b></th>
						</tr>
						<tr>
						<td><br></td>
						</tr>
						<input type="hidden" id="TotalVector" name="TotalVector" value="<?php echo mysql_num_rows($resu1);?>">
						<?
						$i=0;
						while ($filas_s = mysql_fetch_array($resu1)):
							$i++;
							?>
							<tr class="cajas"><?
							echo "<td><input type=\"checkbox\" id=\"datos[" . $i . "]\" name=\"datos[" . $i . "]\" value=\"" . $filas_s['conse'] ."\" onClick=\"SumarExamen()\">" .$filas_s['conse']."</td>";?>
							<td><input type="text" value="<?echo $filas_s["descripcion"];?>" name="concepto[<? echo $i;?>]"id="concepto[<? echo $i;?>]" size="56"  readonly class="cajas"> </td>
							<?if($OtraCiudad=="SI"){?>
							<td><input type="text" value="" name="valorE[<?php echo $i;?>]" id="valorE[<?php echo $i;?>]" size="11"   class="cajas"> </td>
							<?}else{?>
							<td><input type="text" value="<? echo $filas_s["valor"];?>" name="valorE[<?php echo $i;?>]" id="valorE[<?php echo $i;?>]" size="11"  readonly class="cajas"> </td>
							<?}?>
							</tr>
							<?
						endwhile;

					else:
						?>
						<script language="javascript">
						alert("Este Proveedor no presta servicios en esta ciudad o No tiene servicios de examenes creados.!")
						history.back()
						</script>
						<?
					endif;
					?>
					<tr><td><br></td></tr>
					<td colspan="3">
					<input type="button" value="Grabar" class="boton" onClick="validar()"></td>
				</table>

			</form>
			<?
           }

}else{
	?>
	<script language="javascript">
	alert("Este docoumento tiene una restriccion en JGEFECTIVOS SAS, favor validar con Gerencia.!")
	history.back()
	</script>
	<?
	}
endif;
?>
</body>
</html>
