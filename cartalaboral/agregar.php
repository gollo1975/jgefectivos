<html>
<head>
        <title>Carta laboral</title>
         <LINK HREF="../estilo.css" REL="stylesheet"  type="text/css">
</head>
<body>
<?
if (!isset($Documento)):
              ?>
      <center><h4><u>Carta Laboral</u></h4></center>
       <form action="" method="post">
         <table border="0" align="center"
              <tr>
                 <td colspan="2"><br></td>
              </tr>
              <tr>
                <td><b>Documento de Identidad:</b></td>
                 <td><input type="text" name="Documento" value="" size="50" maxlength="30" class="cajas" id="Documento">
                 <tr>
                <td><b>Firma Autorizada:</b></td>
                 <td><input type="text" name="Firma" value="WALTER PULGARIN MORALES" size="50" maxlength="30" readonly class="cajas" id="Firma">
              </tr><tr>
                <td><b>Cargo:</b></td>
                 <td><input type="text" name="CargoT" value="Jefe de Nómina y Facturación" size="50" maxlength="30" readonly class="cajas" id="CargoT">
              </tr>
              </tr>
                     <td><b>Tipo de Carta:</b></td>
                     <td><input type="radio" value="GeneralConFirma" checked name="ValidarTipo">General con Firma<input type="radio" value="GeneralSinFirma" name="ValidarTipo">General sin Firma<input type="radio" value="Personalizada" name="ValidarTipo">Personalizada</td>
                 </tr>
                 <tr><td><br></td></tr>

                 <tr><td colspan="1"><input type="submit" Value="Buscar" class="boton"></td></tr>
             </tr>
      </table>
 </form>
<?
elseif(empty($Documento)):
 ?>
   <script language="javascript">
      alert("Digite el documento del empleado para procesar la carta Laboral.!" )
      history.back()
    </script>
<?
else:
    include("../conexion.php");
    $consulta1="select empleado.cedemple from empleado where
                  empleado.cedemple='$Documento'";
    $resultado1=mysql_query($consulta1) or die("Consulta de empleado incorrecta");
    $regis=mysql_num_rows($resultado1);
    if ($regis!=0):
        $consu1="select novedad.cedemple from novedad where
                  novedad.estado='ACTIVO' and
                  novedad.cedemple='$Documento'";
         $resul1=mysql_query($consu1) or die("Consulta incorrecta");
         $regist=mysql_num_rows($resul1);
         $regist=mysql_affected_rows();
         if ($regist==0):
                $Sql="select CONCAT(nomemple, ' ' , nomemple1, ' ', apemple, ' ', apemple1) as Empleado,empleado.tipoempleado,empleado.periodo,contrato.fechainic,contrato.fechater,contrato.contrato,contrato.salario, contrato.cargo,contrato.zona,tipocontrato.concepto from contrato,empleado,tipocontrato where
                      contrato.codemple=empleado.codemple and
                      tipocontrato.tipo=contrato.tipo and
                      empleado.cedemple='$Documento' order by contrato.contrato DESC limit 1";
                $Sr=mysql_query($Sql) or die("Error al busca los contratos laborales");
                $Con=mysql_num_rows($Sr);
                $filas=mysql_fetch_array($Sr);
                $Empleado = $filas["Empleado"];
                $Periodo=$filas["periodo"];
                $Salario=$filas["salario"];
                ?>
                <center><h4><u>Carta Laboral</u></h4></center>
                <form action="guardar.php" method="post">
                       <input type="hidden" name="FirmaDigital" value="<?echo $FirmaDigital;?>">
                       <input type="hidden" name="TipoEmpleado" value="<?echo $filas["tipoempleado"];?>" size="30">
                       <input type="hidden" name="Periodo" value="<?echo $Periodo;?>" size="30">
                       <input type="hidden" name="Firma" value="<?echo $Firma;?>" size="30">
                       <input type="hidden" name="CargoT" value="<?echo $CargoT;?>" size="30">
                       <input type="hidden" name="ValidarTipo" value="<?echo $ValidarTipo;?>" size="30">
                        <input type="hidden" name="Salario" value="<?echo $Salario;?>" size="30">
                      <?if($ValidarTipo=='Personalizada'){;?>
                          <table border="0" align="center">
		                  <tr>
		                   <td colspan="6"><br></td>
		                  </tr>
		                  <tr>
		                    <td><b>Documento:</b></td>
		                    <td><input type="text" name="Documento" value="<?echo $Documento;?>" class="cajas" size="20" readonly id="Documento"></td>
		                    <td><b>Nombre:</b></td>
		                     <td><input type="text" name="Nombres" value="<?echo $Empleado;?>" size="45" readonly class="cajas" id="Nombres"></td>
		                  </tr>
	                          <tr>
		                    <td><b>Nro_Contrato:</b></td>
		                     <td><input type="text" name="NroContrato" value="<?echo $filas["contrato"];?>" size="20" readonly class="cajas" id="NroContrato"></td>
	                              <td><b>Departamento *:</b></td>
		                    <td><input type="text" name="Departamento" value="DEPARTAMENTO DE NOMINA" class="cajas" size="45" maxlength="30"  id="Departamento"></td>
		                  </tr>
	                          <tr>
		                    <td><b>F_Inicio_Contrato:</b></td>
		                     <td><input type="text" name="FechaInicioContrato" value="<?echo $filas["fechainic"];?>" size="20" maxlength="10" class="cajas" id="FechaInicioContrato"></td>
	                              <td><b>F_Final_Contrato:</b></td>
		                    <td><input type="text" name="FechaFinalContrato" value="<?echo $filas["fechater"];?>" class="cajas" size="45" maxlength="10"   id="FechaFinalContrato"></td>
		                  </tr>
	                          <tr>
		                    <td><b>Salario:</b></td>
		                     <td><input type="text" name="Salario" value="<?echo $filas["salario"];?>" size="20" maxlength="11" class="cajas" id="Salario"></td>
	                              <td><b>Cargo:</b></td>
		                    <td><input type="text" name="Cargo" value="<?echo $filas["cargo"];?>" class="cajas" size="45" maxlength="30"  id="Cargo"></td>
		                  </tr>
	                          <tr>
		                    <td><b>Zona:</b></td>
		                     <td colspan="30"><input type="text" name="Zona" value="<?echo $filas["zona"];?>" size="87" class="cajas" id="Zona"></td>
		                  </tr>
	                           <tr>
		                    <td><b>Tipo_Contrato:</b></td>
		                     <td colspan="30"><input type="text" name="TipoContrato" value="<?echo $filas["concepto"];?>" size="87" class="cajas" id="TipoContrato"></td>
		                  </tr>
		                   <tr><td><br></td></tr>
		                   <tr>
		                    <td colspan="6"><input type="submit" value="Guardar" class="boton" id="grabar"><b>Los Campos con * son obligatorios.</b></td>
		                   </tr>
                        </table>
                      <?}else{?>
                           <table border="0" align="center">
		                  <tr>
		                   <td colspan="6"><br></td>
		                  </tr>
		                  <tr>
		                    <td><b>Documento:</b></td>
		                    <td><input type="text" name="Documento" value="<?echo $Documento;?>" class="cajas" size="20" readonly id="Documento"></td>
		                    <td><b>Nombre:</b></td>
		                     <td><input type="text" name="Nombres" value="<?echo $Empleado;?>" size="45" readonly class="cajas" id="Nombres"></td>
		                  </tr>
	                          <tr>
		                    <td><b>Nro_Contrato:</b></td>
		                     <td><input type="text" name="NroContrato" value="<?echo $filas["contrato"];?>" size="20" readonly class="cajas" id="NroContrato"></td>
	                              <td><b>Departamento *:</b></td>
		                    <td><input type="text" name="Departamento" value="DEPARTAMENTO DE NOMINA" class="cajas" size="45" maxlength="30"  id="Departamento"></td>
		                  </tr>
	                          <tr>
		                    <td><b>F_Inicio_Contrato:</b></td>
		                     <td><input type="text" name="FechaInicioContrato" value="<?echo $filas["fechainic"];?>" size="20" readonly class="cajas" id="FechaInicioContrato"></td>
	                              <td><b>F_Final_Contrato:</b></td>
		                    <td><input type="text" name="FechaFinalContrato" value="<?echo $filas["fechater"];?>" class="cajas" size="45" maxlength="10" readonly  id="FechaFinalContrato"></td>
		                  </tr>
	                          <tr>
		                    <td><b>Salario:</b></td>
		                     <td><input type="text" name="Salario" value="<?echo $filas["salario"];?>" size="20" readonly class="cajas" id="Salario"></td>
	                              <td><b>Cargo:</b></td>
		                    <td><input type="text" name="Cargo" value="<?echo $filas["cargo"];?>" class="cajas" size="45" maxlength="10"  id="Cargo"></td>
		                  </tr>
	                          <tr>
		                    <td><b>Zona:</b></td>
		                     <td colspan="30"><input type="text" name="Zona" value="<?echo $filas["zona"];?>" size="87" readonly class="cajas" id="Zona"></td>
		                  </tr>
	                           <tr>
		                    <td><b>Tipo_Contrato:</b></td>
		                     <td colspan="30"><input type="text" name="TipoContrato" value="<?echo $filas["concepto"];?>" size="87" readonly class="cajas" id="TipoContrato"></td>
		                  </tr>
			           <table border="0" align="center" width="300">
				       <tr class="cajas">
					      <th><b>Item</b></td><th>&nbsp;</th><th><b>Codigo</b></th><th><b>Descripción</b></th>
					    </tr>
				       <?
				       $i=1;
				       $Sql="select parametrolicenciapermiso.* from parametrolicenciapermiso where parametrolicenciapermiso.estado='CARTA'";
				       $Rs=mysql_query($Sql)or die("Error la validar salario");
			               $TotalRegistro = mysql_num_rows($Rs);
				       while ($fila = mysql_fetch_array($Rs)):
				              ?>
				              <tr class="cajas">
				                  <th><?echo $i;?></th>
				                  <?
				                  echo ("<td><input type=\"checkbox\" id=\"Dato[" . $i . "]\" name=\"Dato[" . $i . "]\" value=\"" . $filas_s['codsala'] ."\" checked \"></td>");?>
				                  <td><input type="text" value="<?echo $fila["codsala"];?>" name="CodSalario[<? echo $i;?>]"id="CodSalario[<? echo $i;?>]" size="4" readonly class="cajas"></td>
				                  <td><input type="text" value="<?echo $fila["concepto"];?>" name="Concepto[<? echo $i;?>]"id="Concepto[<? echo $i;?>]" size="40" readonly class="cajas"></td>
				              <tr>
				                 <?
				                 $i=$i+1;
				       endwhile;
				       ?>
			              <td><input type="hidden" value="<?echo $TotalRegistro;?>" name="TotalR" id="TotalR" size="40" class="cajas" readonly></td>
		                   <tr><td><br></td></tr>
		                   <tr>
		                    <td colspan="6"><input type="submit" value="Guardar" class="boton" id="grabar"></td>
		                   </tr>
                        </table>
                     <?}?>
               </form>
               <?
           else:
               ?>
	          <script language="javascript">
	            alert("Este empleado no se le puede dar carta Laboral. Favor validar con Gerencia.!")
	            history.back()
	          </script>
	       <?
	  endif;
    else:
        ?>
          <script language="javascript">
            alert("El documento digitado no existe n la empresa.!")
            history.back()
          </script>
        <?
    endif;
endif;
                           ?>
       </body>
</html>
