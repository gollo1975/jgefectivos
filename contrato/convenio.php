<html>

<head>
  <title>Contrato de Trabajo</title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
  <script language="javascript">
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
                         if (document.getElementById("cedula").value == 0)
                        {
                            alert ("El campo Documento de identidad, no puede ser Vacío");
                            document.getElementById("cedula").focus();
                            return;
                        }
                         document.getElementById("matlibra").submit();
                     }
                     function valide()
                      {
                         if (document.getElementById("cliente").value == 0)
                        {
                            alert ("Digite el nombre del empleado?");
                            document.getElementById("cliente").focus();
                            return;
                        }
                         document.getElementById("matcon").submit();
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
					matlibra.FechaHora.value = timeString;
					//Clock.innerHTML = timeString;

					window.setTimeout("tick();", 100);
			}

		window.onload = tick;			 
   </script>
</head>

<body>

<?
if (!isset($cedula)):
?>
<center><h4><u>Contrato de Trabajo</u></h4></center>
<form  action="" method="post" id="matlibra">
    <input type="hidden" name="UsuarioPreparador" value="<? echo $UsuarioPreparador;?>" id="UsuarioPreparador">
    <input type="hidden" name="codigo" value="<? echo $codigo;?>" id="codigo">
	<input type="hidden" name="FechaHora" value="" id="FechaHora">
    <table border="0" align="center">
       <tr><td><br></td></tr>
       <tr>
        <td><b>Documento de Identidad:&nbsp;</b></td>
         <td><input type="text" name="cedula" size="15" maxlength="12" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="cedula"></td>
       </tr>
       <?if($codigo== ''){?>
           <tr>
              <td><b>Tipo de Contrato:&nbsp;</b></td>
             <td><input type="radio" name="estado" value="FIJO" class="cajas">Fijo<input type="radio" name="estado" value="INDEFINIDO" class="cajas">Indefinido<input type="radio" name="estado" value="LABOR" class="cajas">Obra o Labor<input type="radio" name="estado" value="ADICCION" class="cajas">Adiccion al contrato</td>
           </tr>
       <?}else{?>
           <tr>
              <td><b>Tipo de Contrato:&nbsp;</b></td>
             <td><input type="radio" name="estado" value="LABOR" class="cajas">Obra o Labor<input type="radio" name="estado" value="ADICCION" class="cajas">Adiccion al contrato</td>
           </tr>
        <?}?>
              <tr><td><br></td></tr>
    <tr>
         <td colspan="2">
           <input type="button" value="Buscar" class="boton" onclick="chequearcampos()">
           <input type="reset" value="Limpiar"class="boton"> </td>
       </tr>

    </table>
    <br>
</form>
  <?
else:
   if(empty($estado)):
      ?>
      <script language="javascript">
         alert("Debe de seleccionar un estado de Convenio ?")
         history.back()
      </script>
      <?
   else:
     include("../conexion.php");
     /*COSDIGO QUE VALIDA SI UN EMPLEADO ESTA EN SISTEMA*/
     $Sr="select empleado.diremple,empleado.fechanac,empleado.municipio,concat(nomemple,' ',nomemple1,' ',apemple,' ', apemple1) as Empleado from empleado where empleado.cedemple='$cedula'";
     $Rs=mysql_query($Sr)or die("Error el empleado");
     $fila_E=mysql_fetch_array($Rs);
     $Empleado = $fila_E["Empleado"];
     $Direccion = $fila_E["diremple"];
     $FechaNacimiento = $fila_E["fechanac"];
     $Barrio = $fila_E["municipio"];
     /*CODIGO DE QUE VALIDA EL EXAMENE*/
     $Sql="select examen.nro,examen.validadoso,examen.nombre,examen.cargo,examen.codzona  from examen where examen.cedula='$cedula' and examen.validadoso='SI' order by examen.nro DESC limit 1";
     $Rs=mysql_query($Sql)or die("Error al validar el examen");
	 $Contador=mysql_num_rows($Rs);
    $fila_B=mysql_fetch_array($Rs);
    $NroExamen = $fila_B["nro"];
	 $Cargo = $fila_B["cargo"];
        $CodZona = $fila_B["codzona"];
        if ($Empleado ==''){
           $Empleado = $fila_B["nombre"];
        }
        if($Contador != 0):
            /*CODIGO QUE VALIDE LA ZONA*/
	     $SrZona="select zona.zona as Zona from zona where zona.codzona='$CodZona'";
	     $RsZona=mysql_query($SrZona)or die("Error el empleado");
	     $fila_Z=mysql_fetch_array($RsZona);
	     $Zona = $fila_Z["Zona"];
		?>
           <center><h4><u>Contrato de Trabajo</u></h4></center>
            <form action="grabarconvenio.php" method="post" id="matcon">
	   <input type="hidden" name="UsuarioPreparador" value="<? echo $UsuarioPreparador;?>" id="UsuarioPreparador">
           <input type="hidden" name="codigo" value="<? echo $codigo;?>" id="codigo">
           <input type="hidden" name="CodZona" value="<? echo $CodZona;?>" id="CodZona">
		   <input type="hidden" name="FechaHora" value="<?echo $FechaHora;?>" id="FechaHora">
            <input type="hidden" name="estado" value="<? echo $estado;?>" id="estado">
			<input type="hidden" name="NroExamen" value="<? echo $NroExamen;?>" id="NroExamen">
              <table border="0" align="center" >
                 <?if($estado=='FIJO'):?>
                         <tr>
	                    <td><b>Documento:&nbsp;</b></td>
	                    <td><input type="text" name="cedula" value="<?echo $cedula;?>" size="35" class="cajas" readonly>&nbsp;</td>
	                 </tr>
	                 <tr>
		              <td><b>Lugar_Exped.:&nbsp;</b></td>
		                  <td colspan="40"><select name="CodMuni" class="cajasletra" id="CodMuni"  style="width: 500px">
		                         <option value="0">Seleccione Municipio
		                          <?
	                                       $consulta_z="select codmuni,municipio from municipio  order by municipio";
	                                       $resultado_z=mysql_query($consulta_z) or die("Error al buscar municipios");
	                                       while ($filas_z=mysql_fetch_array($resultado_z))
	                                       {
		                               ?>
		                                        <option value="<?echo $filas_z["codmuni"];?>"><?echo $filas_z["municipio"];?>
		                                  <?
		                                  }
		                                  ?>
		                   </select></td>
		         </tr>
	                 <tr>
	                    <td><b>Trabajador:&nbsp;</b></td>
	                    <td><input type="text" name="cliente" value="<?echo $Empleado;?>" size="80" class="cajas" maxlength="50" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="cliente"></td>
	                 </tr>
	                 <tr>
	                    <td><b>Dirección:&nbsp;</b></td>
	                    <td><input type="text" name="Direccion" value="<?echo $Direccion;?>" size="35" class="cajas" maxlength="40" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Direccion">
	                     <b>Barrio:&nbsp;</b>
	                    <input type="text" name="Barrio" value="<?echo $Barrio;?>" size="33" class="cajas" maxlength="40" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Barrio"></td>
	                 </tr>
	                 <tr>
	                    <td><b>Cargo:&nbsp;</b></td>
	                    <td><input type="text" name="Cargo" value="<?echo $Cargo;?>" size="35" class="cajas" maxlength="35" onfocus="ColorFoco(this.id)" readonly onblur="QuitarFoco(this.id)" id="Cargo">
	                     <b>Salario:&nbsp;</b>
	                    <input type="text" name="Salario" value="" size="32" class="cajas" maxlength="34" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Salario"></td>
	                 </tr>
	                 <tr>
                          <?if($FechaNacimiento==''){?>
	                       <td><b>F_Nacimiento:&nbsp;</b></td>
	                       <td><input type="text" name="FechaNacimiento" value="<?echo date('Y-m-d');?>" size="35" class="cajas" maxlength="10" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="FechaNacimiento">
                          <?}else{?>
                                <td><b>F_Nacimiento:&nbsp;</b></td>
	                       <td><input type="text" name="FechaNacimiento" value="<?echo $FechaNacimiento;?>" size="35" class="cajas" maxlength="10" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="FechaNacimiento">
                          <?}?>
	                     <b>F_Contratación:&nbsp;</b>
	                    <input type="text" name="FechaContratacion" value="<?echo date('Y-m-d');?>" size="24" class="cajas" maxlength="10" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="FechaContratacion"></td>
	                 </tr>
                         <tr>
	                    <td><b>Nro_Dias:&nbsp;</b></td>
	                    <td><input type="text" name="NroDias" value="" size="35" class="cajas" maxlength="10" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="NroDias">
	                     <b>Forma_Pago:&nbsp;</b>
	                     <select name="FormaPago" class="cajasletra"  id="FormaPago" style="width: 180px">
	                        <option value="SEMENAL">SEMANAL
	                        <option value="DECADAL">DECADAL
	                        <option value="CATORCENAL">CATORCENAL
	                        <option value="QUINCENAL">QUINCENAL
	                       <option value="MENSUAL">MENSUAL
	                       <option value="POR DIAS">POR DIAS
	                        </select></td>
	                  </tr>
                         <tr>
			       <td><b>Zona:&nbsp;</b></td>
			       <td><input type="text" name="Zona" value="<?echo $Zona;?>" size="80" class="cajas"  onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" readonly id="Zona"></td>
			  </tr>
		          <tr>
		                    <td><b>Ciudad_Contratación:&nbsp;</b></td>
		                   <td colspan="40"><select name="Municipio" class="cajasletra" id="Municipio"  style="width: 500px">
		                         <option value="0">Seleccione Municipio
		                          <?
	                                       $consulta_z="select codmuni,municipio from municipio  order by municipio";
	                                       $resultado_z=mysql_query($consulta_z) or die("Error al buscar municipios");
	                                       while ($filas_z=mysql_fetch_array($resultado_z))
	                                       {
		                               ?>
		                                        <option value="<?echo $filas_z["municipio"];?>"><?echo $filas_z["municipio"];?>
		                                  <?
		                                  }
		                                  ?>
		                                    </select></td>
		          </tr>
	                  <tr>
	                      <td><b>Tipo_Contrato:&nbsp;</b></td>
	                      <td><input type="text" name="tipo" value="CONTRATO INDIVIDUAL DE TRABAJO A TERMINO FIJO INFERIOR A UN AÑO" size="80" readonly class="cajas" maxlength="80" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="tipo"></td>
	                  </tr>
                 <?else:
                       if($estado=='INDEFINIDO'):?>
                            <tr>
	                    <td><b>Documento:&nbsp;</b></td>
	                    <td><input type="text" name="cedula" value="<?echo $cedula;?>" size="35" class="cajas" readonly>&nbsp;</td>
	                    </tr>
	                    <tr>
		              <td><b>Lugar_Exped.:&nbsp;</b></td>
		                  <td colspan="40"><select name="CodMuni" class="cajasletra" id="CodMuni"  style="width: 500px">
		                         <option value="0">Seleccione Municipio
		                          <?
	                                       $consulta_z="select codmuni,municipio from municipio  order by municipio";
	                                       $resultado_z=mysql_query($consulta_z) or die("Error al buscar municipios");
	                                       while ($filas_z=mysql_fetch_array($resultado_z))
	                                       {
		                               ?>
		                                        <option value="<?echo $filas_z["codmuni"];?>"><?echo $filas_z["municipio"];?>
		                                  <?
		                                  }
		                                  ?>
		                   </select></td>
		           </tr>
	                   <tr>
	                    <td><b>Trabajador:&nbsp;</b></td>
	                    <td><input type="text" name="cliente" value="<?echo $Empleado;?>" size="80" class="cajas" maxlength="50" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="cliente"></td>
	                   </tr>
	                   <tr>
	                    <td><b>Dirección:&nbsp;</b></td>
	                    <td><input type="text" name="Direccion" value="<?echo $Direccion;?>" size="35" class="cajas" maxlength="40" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Direccion">
	                     <b>Barrio:&nbsp;</b>
	                    <input type="text" name="Barrio" value="<?echo $Barrio;?>" size="33" class="cajas" maxlength="40" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Barrio"></td>
	                   </tr>
	                   <tr>
	                    <td><b>Cargo:&nbsp;</b></td>
	                    <td><input type="text" name="Cargo" value="" size="35" class="cajas" maxlength="35" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Cargo">
	                     <b>Salario:&nbsp;</b>
	                    <input type="text" name="Salario" value="" size="32" class="cajas" maxlength="34" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Salario"></td>
	                   </tr>
                           <tr>
                          <?if($FechaNacimiento==''){?>
	                       <td><b>F_Nacimiento:&nbsp;</b></td>
	                       <td><input type="text" name="FechaNacimiento" value="<?echo date('Y-m-d');?>" size="35" class="cajas" maxlength="10" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="FechaNacimiento">
                          <?}else{?>
                                <td><b>F_Nacimiento:&nbsp;</b></td>
	                       <td><input type="text" name="FechaNacimiento" value="<?echo $FechaNacimiento;?>" size="35" class="cajas" maxlength="10" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="FechaNacimiento">
                          <?}?>
	                     <b>F_Contratación:&nbsp;</b>
	                    <input type="text" name="FechaContratacion" value="<?echo date('Y-m-d');?>" size="24" class="cajas" maxlength="10" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="FechaContratacion"></td>
	                 </tr>
	                   <tr>
	                     <td><b>Forma_Pago:&nbsp;</b></td>
	                     <td><select name="FormaPago" class="cajasletra"  id="FormaPago" style="width: 230px">
	                        <option value="SEMENAL">SEMANAL
	                        <option value="DECADAL">DECADAL
	                        <option value="CATORCENAL">CATORCENAL
	                        <option value="QUINCENAL">QUINCENAL
	                       <option value="MENSUAL">MENSUAL
	                       <option value="POR DIAS">POR DIAS
	                        </select></td>
	                   </tr>
                           <tr>
			       <td><b>Zona:&nbsp;</b></td>
			       <td><input type="text" name="Zona" value="<?echo $Zona;?>" size="80" class="cajas"  onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" readonly id="Zona"></td>
			   </tr>
		           <tr>
		                    <td><b>Ciudad_Contratación:&nbsp;</b></td>
		                   <td colspan="40"><select name="Municipio" class="cajasletra" id="Municipio"  style="width: 500px">
		                         <option value="0">Seleccione Municipio
		                          <?
	                                       $consulta_z="select codmuni,municipio from municipio  order by municipio";
	                                       $resultado_z=mysql_query($consulta_z) or die("Error al buscar municipios");
	                                       while ($filas_z=mysql_fetch_array($resultado_z))
	                                       {
		                               ?>
		                                        <option value="<?echo $filas_z["municipio"];?>"><?echo $filas_z["municipio"];?>
		                                  <?
		                                  }
		                                  ?>
		                                    </select></td>
		          </tr>
                             <tr>
	                        <td><b>Tipo_Contrato:&nbsp;</b></td>
	                        <td><input type="text" name="tipo" value="CONTRATO INDIVIDUAL DE TRABAJO A TERMINO INDEFINIDO" size="80" readonly class="cajas" maxlength="80" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="tipo"></td>
	                     </tr>
                       <?else:
			      if($estado=='LABOR'):?>
                                           <tr>
			                    <td><b>Documento:&nbsp;</b></td>
			                    <td><input type="text" name="cedula" value="<?echo $cedula;?>" size="35" class="cajas" readonly>&nbsp;</td>
			                 </tr>
			                 <tr>
				              <td><b>Lugar_Exped.:&nbsp;</b></td>
				                  <td colspan="40"><select name="CodMuni" class="cajasletra" id="CodMuni"  style="width: 466px">
				                         <option value="0">Seleccione Municipio
				                          <?
			                                       $consulta_z="select codmuni,municipio from municipio  order by municipio";
			                                       $resultado_z=mysql_query($consulta_z) or die("Error al buscar municipios");
			                                       while ($filas_z=mysql_fetch_array($resultado_z))
			                                       {
				                               ?>
				                                        <option value="<?echo $filas_z["codmuni"];?>"><?echo $filas_z["municipio"];?>
				                                  <?
				                                  }
				                                  ?>
				                   </select></td>
				         </tr>
			                 <tr>
			                    <td><b>Trabajador:&nbsp;</b></td>
			                    <td><input type="text" name="cliente" value="<?echo $Empleado;?>" size="82" class="cajas" maxlength="50" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="cliente"></td>
			                 </tr>
			                 <tr>
			                    <td><b>Cargo:&nbsp;</b></td>
			                    <td><input type="text" name="Cargo" value="<?echo $Cargo;?>" size="35" class="cajas" maxlength="35" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Cargo">
			                     <b>Salario:&nbsp;</b>
			                    <input type="text" name="Salario" value="" size="34" class="cajas" maxlength="34" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Salario"></td>
			                 </tr>
			                 <tr>
			                    <td><b>Dia_Pago:&nbsp;</b></td>
			                    <td><input type="text" name="DiaPago" value="" size="35" class="cajas" maxlength="10" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="DiaPago">
			                     <b>F_Contratación:&nbsp;</b>
			                    <input type="text" name="FechaContratación" value="<?echo date('Y-m-d');?>" size="26" class="cajas" maxlength="10" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="FechaContratación"></td>
			                 </tr>
			                 <tr>
			                     <td><b>Forma_Pago:&nbsp;</b></td>
			                         <td><select name="FormaPago" class="cajasletra"  id="FormaPago" style="width: 214px">
				                      <option value="SEMENAL">SEMANAL
				                      <option value="DECADAL">DECADAL
				                      <option value="CATORCENAL">CATORCENAL
				                      <option value="QUINCENAL">QUINCENAL
				                      <option value="MENSUAL">MENSUAL
				                      <option value="POR DIAS">POR DIAS
			                          </select>
                                             <b>Horario_Trabajo:&nbsp;</b>
		                             <input type="text" name="Horario" value="" size="28" class="cajas" maxlength="20" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Horario">
			                  </tr>

                                          <tr>
						    <td><b>Zona:&nbsp;</b></td>
						    <td><input type="text" name="Zona" value="<?echo $Zona;?>" size="82" class="cajas"  onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" readonly id="Zona"></td>
					    </tr>
					 <tr>
						    <td><b>Tipo_Contrato:&nbsp;</b></td>
						    <td><input type="text" name="tipo" value="CONTRATO DE TRABAJO POR DURACION DE OBRA O LABOR CONTRATADA" size="82" readonly class="cajas"  onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="tipo"></td>
					    </tr>
			                   <tr>
			                    <td><b>Proceso:&nbsp;</b></td>
			                    <td><textarea name="Proceso" cols="82"  rows="4"class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Proceso" ></textarea></td>
			                  </tr>
			      <?else:
                                    include("../conexion.php");
                                    $SrC="select convenio.lugarexpedicion,convenio.fechacontratacion,convenio.nombres as Empleado,convenio.salario from convenio where convenio.cedemple='$cedula' order by convenio.nroconvenio DESC limit 1";
				     $RsC=mysql_query($SrC)or die("Error el empleado");
				     $fila_C=mysql_fetch_array($RsC);
				     $Empleado = $fila_C["Empleado"];
                                     $Salario = $fila_C["salario"];
                                     $LugarExpedicion = $fila_C["lugarexpedicion"];
                                     $FechaContratacion = $fila_C["fechacontratacion"];
                              ?>
                                          <tr>
			                    <td><b>Documento:&nbsp;</b></td>
			                    <td><input type="text" name="cedula" value="<?echo $cedula;?>" size="35" class="cajas" readonly>&nbsp;</td>
			                 </tr>
                                          <tr>
			                    <td><b>Lugar_Expedi.:&nbsp;</b></td>
			                    <td><input type="text" name="Expedicion" value="<?echo $LugarExpedicion;?>" size="80" class="cajas"readonly onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Expedicion"></td>
			                 </tr>
			                 <tr>
			                    <td><b>Trabajador:&nbsp;</b></td>
			                    <td><input type="text" name="cliente" value="<?echo $Empleado;?>" size="80" class="cajas" readonly onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="cliente"></td>
			                 </tr>
                                         <tr>
			                    <td><b>Salario.:&nbsp;</b></td>
			                   <td> <input type="text" name="Salario" value="<?echo $Salario;?>" size="35" class="cajas"  maxlength="10" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Salario">
                                            <b>S. No Presta.:&nbsp;</b>
			                    <input type="text" name="SalarioNoPrestacional" value="" size="26" class="cajas" maxlength="10" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="SalarioNoPrestacional">
                                           </tr>
                                           <tr>
			                      <td><input type="hidden" name="FechaContratación" value="<?echo $FechaContratacion;?>" size="35" class="cajas" maxlength="10" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" readonly id="FechaContratación"></td>
			                 </tr>
                                          <tr>
				              <td><b>Concepto_No_Salarial:&nbsp;</b></td>
				                  <td colspan="40"><select name="CodigoConcepto" class="cajasletra" id="CodigoConcepto"  style="width: 466px">
				                         <option value="0">Seleccione concepto
				                          <?
			                                       $consulta_z="select codsala,concepto from conceptonosalarial  order by concepto";
			                                       $resultado_z=mysql_query($consulta_z) or die("Error al buscar concepto no salariales");
			                                       while ($filas_z=mysql_fetch_array($resultado_z))
			                                       {
				                               ?>
				                                        <option value="<?echo $filas_z["codsala"];?>"><?echo $filas_z["concepto"];?>
				                                  <?
				                                  }
				                                  ?>
				                   </select></td>
				         </tr>
   				         <tr>
						    <td><b>Tipo_Contrato:&nbsp;</b></td>
						    <td><input type="text" name="tipo" value="OTRO SI AL CONTRATO DE TRABAJO" size="80" readonly class="cajas" maxlength="82" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="tipo"></td>
					 </tr>
			      <?endif;
                       endif;
                  endif;?>
                  <tr><td><br></td></tr>
                 <tr>
                  <td colspan="2">
                    <input type="button" value="Enviar Dato" class="boton" onclick="valide()"></td>
                  </tr>
               </table>
            </form>
          <?
		 else:
            ?>
             <script language="javascript">
                alert("El examen de este empleado no ha sido validado por el Departamento de Salud Ocupacional.!")
                 history.back()
            </script>
             <?
         endif;

   endif;
endif;
?>

</body>

</html>
