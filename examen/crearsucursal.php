<html>
<head>
  <title></title>
</head>
<LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
<body>
<script language="javascript">
 function SumarExamen() {
        var Suma = 0
        var Total = 0
        var Aux = 0
        Total=eval(document.getElementById("TotalVector").value);
         for (k = 1;k <= Total; k++) {
            if (document.getElementById("datos[" + k+ "]").checked == true )
              {
               Suma = Suma + eval(document.getElementById("valorE[" + k + "]").value);
               document.getElementById("vlrexamen").value =  parseFloat(Suma);
              }
			  if (Suma ==0){
				  document.getElementById("vlrexamen").value =  parseFloat(Suma); 
			   }
        }

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
                            alert ("Digite el cargo del empleado a desempeñar.!");
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
                </script>
<?
if(!isset($cedula)):
include("../conexion.php");
	   ?>
	  <div align="center"><h4><u>Autorizar Examenes</u></h4></div>
	  <form action="" method="post" id="matcrea">
	  <input type="hidden" name="CodUsuario" value="<?echo $CodUsuario;?>">
	     <table border="0" align="center">
	        <tr><td><br></td></tr>
	        <tr>
	            <td><b>Documento de Identidad:&nbsp;</b></td>
	            <td><input type="text" name="cedula" size="15" maxlength="15" onFocus="ColorFoco(this.id)" class="cajas"onblur="QuitarFoco(this.id)" id="cedula"></td>
	        </tr>
	         <tr>
				         <td><b>Proveedor:</b></td>
				         <td colspan="1"><select name="Proveedor" class="cajasletra"id="Proveedor">
				               <option value="0">Seleccione el Proveedor
				               <?
				               $consulta_z="select nitprove,nomprove from provedor,sucursal
                                                   where provedor.alianza='SI' and sucursal.codsucursal=provedor.codsucursal  order by nomprove";
				               $resultado_z=mysql_query($consulta_z) or die("Error al buscar proveedor");
				                while ($filas_z=mysql_fetch_array($resultado_z)):
				                   ?>
				                   <option value="<?echo $filas_z["nitprove"];?>"><?echo $filas_z["nomprove"];?>
				                   <?
				               endwhile;
				                    ?>
				             </select></td>
				     </tr>
	        <tr>
				         <td><b>Zona:</b></td>
				         <td colspan="1"><select name="Zona" class="cajasletra" id="Zona">
				               <option value="0">Seleccione la zona
				               <?
				               $consulta_z="select codzona,zona from zona,sucursal
                                               where zona.estado='ACTIVA' and
                                               zona.nomina='SI' and
                                               zona.codsucursal=sucursal.codsucursal and sucursal.codsucursal='$codigo' order by zona";
				               $resultado_z=mysql_query($consulta_z) or die("Error al buscar proveedor");
				                while ($filas_z=mysql_fetch_array($resultado_z)):
				                   ?>
				                   <option value="<?echo $filas_z["codzona"];?>"><?echo $filas_z["zona"];?>
				                   <?
				               endwhile;
				                    ?>
				             </select></td>
				     </tr>
					                <tr>
                                        <td><b>Tipo_Examen:</b></td>
                                        <td><select size="1" name="TipoE" class="cajas"id="TipoE">
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
	            </tr>
              <tr>
	               <td><b>Otras Ciudade:&nbsp;</b></td>
	               <td><input type="radio" name="OtraCiudad" value="SI" id"OtraCiudad"><font color="red">Otras Ciudades&nbsp;(Solo aplica para Corporacion Medica)</font></td>
	            </tr>				
	       <tr><td><br></td></tr>
	       <td colspan="3">
	       <input type="button" value="Buscar" class="boton" onClick="chequearcampos()"><input type="reset" value="Limpiar" class="boton" ></td>
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
 elseif(empty($TipoE)):
  ?>
  <script language="javascript">
     alert("Seleccione el tipo de examene a realizar.")
     history.back()
  </script>
  <? 
else:
   include("../conexion.php");
    $Sql="select novedad.estado from novedad where novedad.estado='ACTIVO' and novedad.cedemple='$cedula'";
	$Rs=mysql_query($Sql)or die ("Error al buscar empleados ?");
	$Cont=mysql_num_rows($Rs);
    if($Cont==0){
	   $Cargo = strtoupper($Cargo);
	   $con="select empleado.cedemple,concat(nomemple, ' ' ,nomemple1, ' ' ,apemple, ' ' , apemple1) as nombre,empleado.codzona from empleado where empleado.cedemple='$cedula'";
	   $res=mysql_query($con)or die ("Error al buscar empleados ?");
	   $reg=mysql_num_rows($res);
	   $filas_E=mysql_fetch_array($res);
	   if($reg==0):
		   /*codigo de provedor*/
		   $conP="select nitprove,nomprove from provedor where provedor.nitprove='$Proveedor'";
		   $resP=mysql_query($conP)or die ("Error al buscar proveedor ?");
		   $filas_P=mysql_fetch_array($resP);
			   /*codigo de zona*/
		   $conZ="select zona.codzona,zona.zona,parametroexamen.tipopago from zona,parametroexamen where zona.codzona='$Zona' and zona.codzona=parametroexamen.codzona";
		   $resZ=mysql_query($conZ)or die ("Error al buscar zonas ?");
		   $filas_Z=mysql_fetch_array($resZ);
			   ?>
			 <div align="center"><h4><u>Autorizar Examenes</u></h4></div>
			  <form action="grabarsucursal.php" method="post" id="matgra" name="Dat">
				  <input type="hidden" name="Proveedor" value="<?echo $Proveedor;?>">
				  <input type="hidden" name="codigo" value="<?echo $codigo;?>">
				  <input type="hidden" name="Zona" value="<?echo $Zona;?>">
				 <table border="0" align="center">

				  <tr>
					<td><b>Documento:</b></td>
					<td><input type="text" name="cedula" value="<?echo $cedula;?>"size="15" class="cajas" readonly onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="cedula"></td>
				  </tr>
				  <tr>
					<td><b>Empleado:</b></td>
					<td><input type="text" name="nombre" value="" size="55" maxlength="55" class="cajas" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="nombre"></td>
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
					<td><b><a href="ConsultaExamenes.php?CodZona=<?echo $Zona;?>&Zona=<?echo $filas_Z["zona"];?>" target="_blank" >Zona:</a></b></td>
					<td><input type="text" name="Nomzona" value="<? echo $filas_Z["zona"];?>" class="cajas"size="55" readonly onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="Nomzona"></td>
				  </tr>
					  <tr>
					<td><b>Proveedor:</b></td>
					<td><input type="text" name="Nomprovedor" value="<? echo $filas_P["nomprove"];?>" class="cajas"size="55" readonly onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="Nomprove"></td>
				  </tr>
				  <tr>
						<td><b>Nro_Control:</b></td>
						  <td><input type="text" name="radicado" value="" class="cajas" size="15" maxlength="15" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="radicado">
						  <b>Tipo_Pago:</b>
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
								  provedor.nitprove='$Proveedor'";
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
									   alert("Este Proveedor no tiene centro de examenes creados ?")
									   open("crear.php","_self")
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
	   else:
		  $Cargo = strtoupper($Cargo);
		  $conD="select examen.posicion from examen where examen.cedula='$cedula' and examen.posicion='FALTA'";
		  $resD=mysql_query($conD)or die ("Error al buscar examenes ?");
		  $reg=mysql_num_rows($resD);
		  if($reg==0):
			  /*codigo de provedor*/
		   $conP="select nitprove,nomprove from provedor where provedor.nitprove='$Proveedor'";
		   $resP=mysql_query($conP)or die ("Error al buscar proveedor ?");
		   $filas_P=mysql_fetch_array($resP);
			   /*codigo de zona*/
		   $conZ="select zona.codzona,zona.zona,parametroexamen.tipopago from zona,parametroexamen where zona.codzona='$Zona' and zona.codzona=parametroexamen.codzona";
		   $resZ=mysql_query($conZ)or die ("Error al buscar zonas ?");
		   $filas_Z=mysql_fetch_array($resZ);
			 ?>
			 <div align="center"><h4><u>Autorizar Examenes</u></h4></div>
			  <form action="grabarsucursal.php" method="post" id="matgra" name="Dat">
				  <input type="hidden" name="Proveedor" value="<?echo $Proveedor;?>">
				  <input type="hidden" name="codigo" value="<?echo $codigo;?>">
				  <input type="hidden" name="Zona" value="<?echo $Zona;?>">
				 <table border="0" align="center">

				  <tr>
					<td><b>Documento:</b></td>
					<td><input type="text" name="cedula" value="<?echo $cedula;?>"size="15" class="cajas" readonly onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="cedula"></td>
				  </tr>
				  <tr>
					<td><b>Empleado:</b></td>
					<td><input type="text" name="nombre" value="<?echo $filas_E["nombre"];?>" size="55" readonly class="cajas" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="nombre"></td>
				  </tr>
				  <tr>
					<td><b>Cargo:</b></td>
					<td><input type="text" name="Cargo" value="<? echo $Cargo;?>" class="cajas"size="55" maxlength="35" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="Cargo"></td>
				  </tr>
				  <tr>
					<td><b>Fecha_Examen:</b></td>
					<td><input type="text" name="fechae" value="<? echo date("Y-m-d");?>" class="cajas"size="10" maxlength="10" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="fechae"></td>
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
						<td><b>Nro_Control:</b></td>
						  <td><input type="text" name="radicado" value="" class="cajas" size="15" maxlength="15" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="radicado">
						  <b>Tipo_Pago:</b>
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
								  provedor.nitprove='$Proveedor'";
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
									   alert("Este Proveedor no tiene centro de examenes creados ?")
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
		  else:
			 ?>
			 <script language="javascript">
				alert("Este empleado no le han descargado el examen medico.")
				history.back()
			 </script>
			 <?
		  endif;
	   endif;
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
