
<html>
<head>
<title></title>
<LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">

</head>
<body>
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
                        if (document.getElementById("cedula").value.length <=0)
                        {
                            alert ("Digite el Documento del Empleado ?");
                            document.getElementById("cedula").focus();
                            return;
                        }
                        document.getElementById("contrato").submit();
                    }
</script>
<?
if (empty($cedula)):
   include("../conexion.php");
?>
  <center><h4><u>Crear Contratos</u><h4></center>
  <form action="" method="post" id="contrato">
    <table border="0" align="center">
     <tr><td><br></td></tr>
      <tr>
       <td><b>Documento de Identidad:</b></td>
         <td><input type="text" name="cedula" value="" size="14" maxlength="14" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="cedula">
     </tr>
     <tr>
           <td><b>Tipo_Contrato:</b></td>
               <td><select name="tipo" class="cajas" style="width: 295px" id="tipo">
                  <option value="0">Seleccione el Contrato
                  <?
                   $consulta_c="select * from tipocontrato order by concepto ";
                   $resultado_c=mysql_query($consulta_c)or die ("Consulta de contratos incorrecta");
                   while($filas_c=mysql_fetch_array($resultado_c)):
                      ?>
                       <option value="<?echo $filas_c["tipo"];?>"> <?echo $filas_c["concepto"];?>
                      <?
                  endwhile;
              ?></select></td>
          </tr>
      <tr><td><br></td></tr>
      <tr>
         <td colspan="5">
           <input type="button" value="Crear registro" class="boton" onclick="chequearcampos()">
         </td>
       </tr>
      </table>
    </form>
    <?
elseif(empty($tipo)):
    ?>
    <script language="javascript">
        alert("Seleccione el tipo de contrato de la lista.!")
        history.back()
    </script>
    <?
else:
      include("../conexion.php");
      /*CODIGO QUE BUSCA EL CODIGO DEL CONTRATO*/
      $Sql="select tipocontrato.* FROM tipocontrato where tipocontrato.tipo='$tipo'";
      $Rs=mysql_query($Sql)or die("Error de Busqueda");
      $fila=mysql_fetch_array($Rs);
      $Aporteps=$fila["aporteps"];
      $AportePension=$fila["aportpension"];
      /*FIN CODIGO*/
	  /*CODIGO QUE VALIDA SI TIENE BLOQUEO*/
      /*FIN CODIGO*/	  
	  $Sql="select novedad.novedad from empleado,novedad
			where  novedad.cedemple=empleado.cedemple and
			       empleado.cedemple='$cedula' and
				   novedad.estado='ACTIVO'";
	  $Rs=mysql_query($Sql)or die("Error de Busqueda");
	  $Conta=mysql_num_rows($Rs);
	 if ($Conta ==0){
			$busca="select empleado.codemple,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1,zona.zona,empleado.codzona,empleado.basico,empleado.nivel,empleado.pagarp from empleado,zona
					 where  zona.codzona=empleado.codzona and
							empleado.cedemple='$cedula'";
			  $resultado=mysql_query($busca)or die("Error de Busqueda");
			  $registro=mysql_num_rows($resultado);
			if ($registro!=0):
					 $consulta="select empleado.codemple,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1 from empleado,contrato
					  where contrato.codemple=empleado.codemple and
						   contrato.fechater = '0000-00-00' and
						   empleado.cedemple='$cedula'";
					  $result=mysql_query($consulta)or die("Error de Busqueda contrato");
					  $regi=mysql_affected_rows();
				   while($filas=mysql_fetch_array($resultado)):
					if($regi!=0):
						   ?>
						<script language="javascript">
						  alert("Este empleado ya tiene Contrato  con la compañia y se en cuentra activo.!")
						  open("agregar.php","_self")
						</script>
				<?
					else:
					$Estado=0;
						?>
						 <h4><div align="center"><u>Matricular Contratos</u></div></h4>
						  <form action="guardarnuevo.php" method="post" id="nuevo">
						  <input type="hidden" name="Estado" value="<? echo $Estado;?>">
						   <input type="hidden" name="Aporteps" value="<? echo $Aporteps;?>">
						   <input type="hidden" name="CodZona" value="<? echo $filas["codzona"];?>" id="CodZona">
							<input type="hidden" name="AportePension" value="<? echo $AportePension;?>">
						   <table border="0" align="center">
						   <tr>
							  <td><b>Cod_Empleado:</b></td>
							   <td><input type="text" name="codemple" value="<? echo $filas["codemple"];?>" class="cajas" size="12" readonly><td>
						   </tr>
							<tr>
							  <td><b>Documento:</b></td>
							   <td><input type="text"  value="<? echo $cedula;?>" size="12"class="cajas" readonly><td>
						   </tr>
						   <tr>
							  <td><b>Empleado:</b></td>
							   <td><input type="text"  value="<? echo $filas["nomemple"];?>&nbsp;<? echo $filas["nomemple1"];?>&nbsp;<? echo $filas["apemple"];?>&nbsp;<? echo $filas["apemple1"];?>"class="cajas" size="86" readonly></td>
						   </tr>
						   <tr>
							  <td><b>F_Inicio:</b></td>
							   <td><input type="text" name="fechainic" value="<?echo date("Y-m-d");?>" size="12" maxlength="10" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="fechainic"></td>
						   </tr>
						   <tr>
							   <td><b>F_Trabajado:</b></td>
							   <td><input type="text" name="fechater" value="" size="12" maxlength="10" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="fechater"></td>
						   </tr>
							<tr>
							   <td><b>F_Finalizacion:</b></td>
							   <td><input type="text" name="FechaF" value="" size="12" maxlength="10" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="FechaF"><b>Si el contrato es indefinido, poner esta fecha '2099-09-09'.</b></td>
						   </tr>
						   <tr>
							   <td><b>Salario:</b></td>
							   <td><input type="text" name="salario" value="<?echo $filas["basico"];?>" size="12" maxlength="10" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="salario" readonly>
						   </tr>
				           <tr>
							   <td><b>Ibc_Seguridad:</b></td>
							   <td><input type="text" name="salario_ibc" value="" size="12" maxlength="10" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="salario_ibc">
						   </tr>
						   <tr> 
						    <td><b>Tipo_Salario:</b></td>
	                          <td><select name="TipoS" class="cajas"  style="width: 92px" id="TipoS">
	                             <option value="NORMAL">NORMAL
	                             <option value="INTEGRAL">INTEGRAL
	                             </select></td>
	                        </tr>
							<tr>
							   <td><b>%Arl:</b></td>
							   <td><input type="text" name="nivelarl" value="<?echo $filas["nivel"];?>" size="12" maxlength="10" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="nivelarl" readonly>
						   </tr>
						   <?if ($Aporteps == 'SI' || $AportePension=='SI'){?>
							   <tr>
							   <td><b>%Salud:</b></td>
							   <td><input type="text" name="PorSalud" value="" size="12" maxlength="10" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="PorSalud">
						   </tr>
							  <tr>
							   <td><b>%Pensión:</b></td>
							   <td><input type="text" name="PorPension" value="" size="12" maxlength="10" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="PorPension">
							 </tr>
						   <?}?>
						   <tr>
							   <td><b>Cod_Contrato:</b></td>
							   <td><input type="text" name="tipo" value="<?echo $tipo;?>" size="12" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="tipo" readonly><b><?echo $fila["concepto"];?></b></td>
							</tr>
						   <tr>
							   <td><b>Cargo:</b></td>
							   <td><input type="text" name="cargo" value="" size="86" maxlength="40" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="cargo"></td>
							</tr>
							 <tr>
						   <td><b>Caja_Compe.:</b></td>
							<td colspan="30"><select name="CodCaja"class="cajasletra" id="CodCaja" style="width: 535px">
								<option value="0">Seleccione la caja
								<?
									$consulta_p="select caja.* from caja where caja.estado='ACTIVA' order by caja.nombre";
									$resultado_p=mysql_query($consulta_p) or die("error al validar la entidad caja");
									while ($filas_p=mysql_fetch_array($resultado_p))
									   {
									   ?>
									 <option value="<?echo $filas_p["codigo_caja_pk"];?>"><?echo $filas_p["nombre"];?>
									  <?
									   }
									   ?>
							 </select></td>
						  </tr>
							 <tr>
						   <td><b>Tipo_Cotizante:</b></td>
							<td colspan="20"><select name="TipoCotizante"class="cajasletra" id="TipoCotizante" style="width: 535px">
								<?
									$con="select sso_tipo_cotizante.* from sso_tipo_cotizante order by sso_tipo_cotizante.codigo_tipo_cotizante_pk";
									$res=mysql_query($con) or die("error al validar el tipo de cotizante");
									while ($filas_T=mysql_fetch_array($res))
									   {
									   ?>
									 <option value="<?echo $filas_T["codigo_tipo_cotizante_pk"];?>"><?echo $filas_T["nombre"];?>
									  <?
									   }
									   ?>
							 </select></td>
						   </tr>
						   <tr>
						   <td><b>Subtipo_Cotiz.:</b></td>
							<td colspan="20"><select name="SubTipoCotizante"class="cajasletra" id="SubTipoCotizante" style="width: 535px">
								<?
									$consulta_p="select sso_subtipo_cotizante.* from sso_subtipo_cotizante order by sso_subtipo_cotizante.codigo_subtipo_cotizante_pk";
									$resultado_p=mysql_query($consulta_p) or die("error al validar el subtipo cotizante");
									while ($filas_S=mysql_fetch_array($resultado_p))
									   {
									   ?>
									 <option value="<?echo $filas_S["codigo_subtipo_cotizante_pk"];?>"><?echo $filas_S["nombre"];?>
									  <?
									   }
									   ?>
							 </select></td>
						  </tr>
							<tr>
							   <td><b>Zona:</b></td>
							   <td><input type="text" name="zona" value="<?echo $filas["zona"];?>" size="86" maxlength="50" class="cajas"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="zona"></td>
							</tr>
							<tr>
							   <td><b>Nota:</b></td>
							   <td><textarea name="nota" cols="86" rows="3" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="nota"></textarea></td>
						   </tr>
						   <tr><td><br></td></tr>
						   <tr>
								 <td colspan="2">
								   <input type="submit" value="Guardar" class="boton" id="grabar">
								 </td>
							   </tr>
							  </table>
						 </form>
					 <?
					endif;
					endwhile;
			else:

				?>
				<script language="javascript">
				  alert("Este empleado, No existe en el Sistema ?")
				  open("agregar.php","_self")
				</script>
				<?
			endif;
	}else{
		 ?>
				<script language="javascript">
				  alert("Este empleado no pueden ingresar a la empresa por que presenta bloqueo por Gerencia, favor verificar.!")
				  history.back()
				</script>
	 	<?
	}
endif;
 ?>
 </body>
</html>
