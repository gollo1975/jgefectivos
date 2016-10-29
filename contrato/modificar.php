<?
 session_start();
?>
<html>
<head>
<title>Modificacion de contrato</title>
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
                        if (document.getElementById("fechainic").value.length <=0)
                        {
                            alert ("El campo FECHA INICIO no puede estar vacío");
                            document.getElementById("fechainic").focus();
                            return;
                         }   
                          document.getElementById("concotra").submit();
                    }

                   </script>
</head>
<body>
<?
 if(session_is_registered("xsession")):
   include("../conexion.php");
    $consulta="select contrato.*,CONCAT(nomemple, ' ', nomemple1 ,' ', apemple ,' ', apemple1) as Empleado,empleado.cedemple,empleado.nivel as NivelE from contrato,empleado where
      contrato.codemple=empleado.codemple and contrato.contrato='$con'";
    $resultado=mysql_query($consulta)or die("Consulta incorrecta");
    $registro=mysql_num_rows($resultado);
    $filas=mysql_fetch_array($resultado);
    $NivelE=$filas["NivelE"];
  if($TipoP=='Modificar'){
       ?>
       <center><h4><u>Modificar Contrato</u></h4></center>
         <form action="guardar.php" method="post" id="concontra">
         <input type="hidden" value="<?echo $NivelE;?>" name="NivelE">
           <table border="0" align="center">
             <tr>
               <td><b>Nro_contrato:</b></td>
               <td><input type="text" value="<?echo $filas["contrato"];?>" name="contrato" readonly size="12" class="cajas" id="contrato"></td>
             </tr>
              <tr>
               <td><b>Documento:</b></td>
               <td><input type="text" value="<?echo $filas["cedemple"];?>" name="Documento" readonly size="12" class="cajas" id="Documento"></td>
             </tr>
             <tr>
               <td><b>Empleado:</b></td>
                  <td><input type="text" value="<?echo $filas["Empleado"];?>"name="empleado" class="cajas" size="86" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="empleado" readonly></td>
               <tr>
               <td><b>Fecha_Inicio:</b></td>
               <td><input type="text" value="<?echo $filas["fechainic"];?>"name="fechainic" class="cajas" size="12" maxlength="10"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="fechainic"></td>
             </tr>
              <tr>
               <td><b>Fecha_Final:</b></td>
               <td><input type="text" value="<?echo $filas["fechater"];?>"name="fechater" size="12" class="cajas" maxlength="10" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="fechater"></td>
             </tr>
              <tr>
               <td><b>Salario:</b></td>
               <td><input type="text" value="<?echo $filas["salario"];?>" name="salario"size="12"class="cajas"  maxlength="10"onfocus="ColorFoco(this.id)" readonly=yes onblur="QuitarFoco(this.id)" id="salario"></td>
             </tr>
	       <tr>
               <td><b>Ibc_Seguridad:</b></td>
               <td><input type="text" value="<?echo $filas["salario_ibc"];?>" name="salario_ibc" size="12"class="cajas"  maxlength="10"onfocus="ColorFoco(this.id)"  readonly=yes onblur="QuitarFoco(this.id)" id="salario_ibc"></td>
             </tr>
		<?if ($filas["cambio"]=='SI'){?>	 
		     <tr>
               <td><b>Cambio_Salario:</b></td>
               <td><input type="text" value="<?echo $filas["cambio"];?>" name="CambioS" size="12"class="cajas"  style="text-align:left;background-color:#FFC1C1" onfocus="ColorFoco(this.id)"  readonly=yes onblur="QuitarFoco(this.id)" id="CambioS"></td>
             </tr>
			  <tr>
               <td><b>F_Cambio:</b></td>
               <td><input type="text" value="<?echo $filas["salario_fecha_desde"];?>" name="FCambio" size="12"class="cajas"  style="text-align:left;background-color:#FFC1C1" onfocus="ColorFoco(this.id)"  readonly=yes onblur="QuitarFoco(this.id)" id="FCambio"></td>
             </tr>
		<?}else{?>
			  <tr>
               <td><b>Cambio_Salario:</b></td>
               <td><input type="text" value="<?echo $filas["cambio"];?>" name="CambioS" size="12"class="cajas"  onfocus="ColorFoco(this.id)"  readonly=yes onblur="QuitarFoco(this.id)" id="CambioS"></td>
             </tr>
		<?}?>
            <tr>
                    <td><b>Tipo_Salario</b></td>
                    <td><select name="TipoS" class="cajasletra" id="TipoS" style="width: 92px">
                     <option value="<?echo $filas["tiposalario"];?>" selected><?echo $filas["tiposalario"];?>
                    <option value="NORMAL">NORMAL
                    <option value="INTEGRAL">INTEGRAL                    
                    </select></td>
                  </tr>
                <tr>		
              <tr>
                    <td><b>% Arl:</b></td>
                    <td><select name="nivelarl" class="cajasletra" id="nivelarl">
                     <option value="<?echo $filas["nivel"];?>" selected><?echo $filas["nivel"];?>
                    <option value="0.522">0.522
                    <option value="1.044">1.044
                    <option value="2.436">2.436
                    <option value="4.350">4.350
                    <option value="6.96">6.96
                    </select></td>
                  </tr>
                <tr>
               <td><b>%Salud:</b></td>
               <td><input type="text" value="<?echo $filas["eps"];?>" name="PorSalud" size="12"class="cajas"  maxlength="10"onfocus="ColorFoco(this.id)"   onblur="QuitarFoco(this.id)" id="PorSalud"></td>
             </tr>
                <tr>
               <td><b>%Pensión:</b></td>
               <td><input type="text" value="<?echo $filas["pension"];?>" name="PorPension" size="12"class="cajas"  maxlength="10"onfocus="ColorFoco(this.id)"   onblur="QuitarFoco(this.id)" id="PorPension"></td>
             </tr>
              <tr>
               <td><b>Tipo_Contrato:</b></td>
               <td><select name="tipo" class="cajas" style="width: 535px" id="tipo">
                 <?
                 $tipaux=$filas["tipo"];
                 $con="select * from tipocontrato order by tipo";
                 $res=mysql_query($con)or die("Consulta  incorrecta");
                 while($rS=mysql_fetch_array($res)):
                   if ($tipaux==$rS["tipo"]):
                 ?>
                 <option value="<?echo $rS["tipo"];?>" selected><?echo $rS["concepto"];?>
                 <?
                   else:
                   ?>
                     <option value="<?echo $rS["tipo"];?>"><?echo $rS["concepto"];?>
                   <?
                   endif;
                 endwhile;
                 ?> </selet></td>
             </tr>
              <tr>
               <td><b>Cargo:</b></td>
               <td><input type="text" value="<?echo $filas["cargo"];?>" name="cargo"size="86" class="cajas" maxlength="40"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="cargo"></td>
             </tr>
             <tr>
               <td><b>Caja_Compensación:</b></td>
               <td><select name="CajaC" class="cajas" style="width: 535px" id="CajaC">
                 <?
                 $depaux=$filas["codigo_caja_pk"];
                 $conC=" select caja.* from caja where caja.estado='ACTIVA' order by caja.nombre";
                 $resC=mysql_query($conC)or die("erro al busca la caja de compensacion");
                 while($filas_C=mysql_fetch_array($resC)):
                   if ($depaux==$filas_C["codigo_caja_pk"]):
                 ?>
                 <option value="<?echo $filas_C["codigo_caja_pk"];?>" selected><?echo $filas_C["nombre"];?>
                 <?
                   else:
                   ?>
                     <option value="<?echo $filas_C["codigo_caja_pk"];?>"><?echo $filas_C["nombre"];?>
                   <?
                   endif;
                 endwhile;
                 ?> </selet></td>
             </tr>
               <tr>
               <td><b>Tipo_Cotizante:</b></td>
               <td><select name="TipoC" class="cajas" style="width: 535px" id="TipoC">
                 <?
                 $AuxT=$filas["codigo_tipo_cotizante_fk"];
                 $conT="select sso_tipo_cotizante.* from sso_tipo_cotizante order by sso_tipo_cotizante.codigo_tipo_cotizante_pk";
                 $resT=mysql_query($conT)or die("erro al busca el tipo de cotizante");
                 while($filas_T=mysql_fetch_array($resT)):
                   if ($AuxT==$filas_T["codigo_tipo_cotizante_pk"]):
                 ?>
                 <option value="<?echo $filas_T["codigo_tipo_cotizante_pk"];?>" selected><?echo $filas_T["nombre"];?>
                 <?
                   else:
                   ?>
                     <option value="<?echo $filas_T["codigo_tipo_cotizante_pk"];?>"><?echo $filas_T["nombre"];?>
                   <?
                   endif;
                 endwhile;
                 ?> </selet></td>
             </tr>
              <tr>
               <td><b>Subtipo_Cotizante:</b></td>
               <td><select name="SubTipo" class="cajas" style="width: 535px" id="SubTipo">
                 <?
                 $AuxS=$filas["codigo_subtipo_cotizante_fk"];
                 $conS="select sso_subtipo_cotizante.* from sso_subtipo_cotizante order by sso_subtipo_cotizante.codigo_subtipo_cotizante_pk";
                 $resS=mysql_query($conS)or die("erro al busca el subtipo de cotizante");
                 while($filas_S=mysql_fetch_array($resS)):
                   if ($AuxS==$filas_S["codigo_subtipo_cotizante_pk"]):
                 ?>
                 <option value="<?echo $filas_S["codigo_subtipo_cotizante_pk"];?>" selected><?echo $filas_S["nombre"];?>
                 <?
                   else:
                   ?>
                     <option value="<?echo $filas_S["codigo_subtipo_cotizante_pk"];?>"><?echo $filas_S["nombre"];?>
                   <?
                   endif;
                 endwhile;
                 ?> </selet></td>
             </tr>
             <tr>
               <td><b>Nota:</b></td>
               <td><textarea name="nota" cols="86" rows="3"class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="nota" ><?echo $filas["nota"];?></textarea></td>
             </tr>

             <tr><td><br></td></tr>
              <tr>
               <td colspan="2">
                 <input type="submit" value="Guardar" class="boton">
                 <input type="reset" value="Limpiar"class="boton">
               </td>
              </tr>
           </table>
       </form>
         <?
    }else{
          ?>
       <center><h4><u>Variacion de Salario</u></h4></center>
         <form action="GrabarVariacion.php" method="post" id="var">
           <table border="0" align="center">
           <tr><td><br></td></tr>
             <tr>
               <td><b>Nro_contrato:</b></td>
               <td><input type="text" value="<?echo $filas["contrato"];?>" name="NroC" readonly class="cajas" id="NroC" size="12"></td>
             </tr>
              <tr>
               <td><b>Documento:</b></td>
               <td><input type="text" value="<?echo $filas["cedemple"];?>" name="Cedemple" readonly class="cajas" id="Cedemple" size="12"></td>
             </tr>
              <tr>
               <td><b>Empleado:</b></td>
               <td><input type="text" value="<?echo $filas["Empleado"];?>" name="" size="55" readonly class="cajas" ></td>
             </tr>
              <tr>
               <td><b>Salario_Actual:</b></td>
               <td><input type="text" value="<?echo $filas["salario_ibc"];?>"  name="salarioActual" class="cajas" size="13" maxlength="10"onfocus="ColorFoco(this.id)" readonly=yes onblur="QuitarFoco(this.id)" id="salarioActual"></td>
             </tr>
             <tr>
               <td><b>F_Variación:</b></td>
               <td><input type="text" value="<?echo date("Y-m-d");?>" name="FechaV" class="cajas" size="13" maxlength="10"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="FechaV"></td>
             </tr>
               <tr>
               <td><b>Nuevo_Salario:</b></td>
               <td><input type="text" value="" name="Nuevo_Salario" size="13"class="cajas"  maxlength="10"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Nuevro_Salario"></td>
             </tr>
              <tr>
               <td><b>Nuevo_Salario_Ibc:</b></td>
               <td><input type="text" value="" name="Nuevo_Salario_Ibc" size="13"class="cajas"  maxlength="10"onfocus="ColorFoco(this.id)"  onblur="QuitarFoco(this.id)" id="Nuevo_Salario_Ibc"></td>
             </tr>
             <tr><td><br></td></tr>
              <tr>
               <td colspan="2">
                 <input type="submit" value="Guardar" class="boton">
                 <input type="reset" value="Limpiar"class="boton">
               </td>
              </tr>
           </table>
       </form>
         <?
    }
else:
?>
 <script language="javascript">
    alert("Debe de hacer Inicio de Sección")
    pagina='../acceso/agregar.php'
    tiempo=10
    ubicacion='_self'
    setTimeout("open(pagina,ubicacion)",tiempo)
 </script>
<?
endif;
     ?>
</body>
</html>
