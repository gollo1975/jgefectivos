<html>
<head>
<title>Ingreso De Incapacidades</title>
<LINK  REL="stylesheet" HREF="../estilo.css" type="text/css">
<script type="text/javascript">
/*otras funciones*/
      function ColorFoco(obj)
                    {
                        document.getElementById(obj).style.background="#9DFF9D"

                    }

     function QuitarFoco(obj)
                    {
                        document.getElementById(obj).style.background="white"
                    }

     /*otra funcion*/
      function validar()
                  {
                        if (document.getElementById("cedula").value.length <=0)
                        {
                            alert ("Digite el documento de Identidad ?");
                            document.getElementById("cedula").focus();
                            return;
                        }
                         document.getElementById("f1").submit();
                    }
                    function chequearcampos()
                    {
                        if (document.getElementById("nroinca").value.length <=0)
                        {
                            alert ("El campo Número de Incapacidad no puede estar vacío!");
                            document.getElementById("nroinca").focus();
                            return;
                        }
                         if (document.getElementById("motivo").value.length <=0)
                        {
                            alert ("Ingrese el motivo de la incapacidad !");
                            document.getElementById("motivo").focus();
                            return;
                        }
                         document.getElementById("f2").submit();
                    }

                </script>
</head>
<body>
<?
if (!isset($cedula)):
  ?>
   <center><h4><u>Ingreso de Incapacidad</u></h4></center>
   <form action="" method="post"  id="f1" name="f1">
   <input type="hidden" name="codigo" value="<?echo $codigo;?>"></td>
      <table border="0" align="center">
        <tr><td><br></td></tr>
        <tr>
           <td><b>Documento de identidad:</b><td>
           <td><input type="text" name="cedula" value="" size="15" maxlength="15" onFocus="ColorFoco(this.id)"class="cajas" onBlur="QuitarFoco(this.id)" id="cedula"></td>
        </tr>
        <tr><td><br></td></tr>
        <tr>
                 <td colspan="2">
                   <input type="button" value="Buscar" class="boton" id="buscar" onClick="validar()">
                 </td>
        </tr>
      </table>
   </form>
  <?
else:
   include("../conexion.php");
   $con="select empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1,eps.eps,eps.codeps,zona.codzona from empleado,eps,zona where
        empleado.codeps=eps.codeps and
		zona.codzona=empleado.codzona and
        empleado.cedemple='$cedula'";
   $res=mysql_query($con)or die ("Error de busqueda de empleado");
   $filas=mysql_fetch_array($res);
   $reg=mysql_num_rows($res);
   if($reg!=0):
        $Respuesta="select contrato.contrato,contrato.fechainic,contrato.salario from contrato,empleado where
            empleado.codemple=contrato.codemple and
			contrato.fechater='0000-00-00' and
			empleado.cedemple='$cedula'";
        $Res=mysql_query($Respuesta) or die ("Error al validar contrato");
        $FilaC=mysql_fetch_array($Res);
        $FechaIncial= $FilaC["fechainic"];
        $Salario = $FilaC["salario"];
        $Con=mysql_num_rows($Res);
        if($Con != 0){

			?>
			<center><h4><u>Ingreso de Incapacidad</u></h4></center>
			  <form action="grabarnueva.php" method="post" id="f2" name="f2">
				<input type="hidden" name="codeps" value="<?echo $filas["codeps"];?>"></td>
				<input type="hidden" name="CodZona" value="<?echo $filas["codzona"];?>"></td>
                                <input type="hidden" name="FechaIncial" value="<?echo $FechaIncial;?>"></td>
                                <input type="hidden" name="Salario" value="<?echo $Salario;?>"></td>   
                <input type="hidden" name="codigo" value="<?echo $codigo;?>"></td>
				<table border="0" align="center">
				 <tr>
				   <td colspan="2"><br></td>
				  </tr>
				  <tr>
				   <td><b>Documento:</b></td>
				   <td><input type="text" name="cedula" value="<?echo $cedula;?>" size="25" readonly class="cajas" ></td>
				  </tr>
				  <tr>
				   <td><b>Empleado:</b></td>
				   <td><input type="text"  value="<?echo $filas["nomemple"];?>&nbsp;<?echo $filas["nomemple1"];?>&nbsp;<?echo $filas["apemple"];?>&nbsp;<?echo $filas["apemple1"];?>" size="60" class="cajas" readonly ></td>
				  </tr>
				 <tr>
				   <td><b>Nro. Incapacidad:</b></td>
				   <td><input type="text" name="nroinca" value="" size="25" maxlength="20" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="nroinca" class="cajas"></td>
				 </tr>
				 <tr>
				   <td><b>Fecha Inicio:</b></td>
				   <td><input type="text" name="fechaini" value="<?echo date("Y-m-d");?>" size="25" maxlength="10" onFocus="ColorFoco(this.id)" class="cajas" onBlur="QuitarFoco(this.id)" id="fechaini"></td>
				 </tr>
				  <tr>
				   <td><b>Fecha Termino:</b></td>
				   <td><input type="text" name="fechater" value="<?echo date("Y-m-d");?>" size="25" maxlength="10" onFocus="ColorFoco(this.id)" class="cajas" onBlur="QuitarFoco(this.id)" id="fechater"></td>
				 </tr>
				 <tr>
				   <td><strong>Prorroga</strong></td>
				   <td><select name="prorroga" id="prorroga" class="cajas" style="width: 170px">
					 <option value="NO">NO</option>
					 <option value="SI">SI</option>
				   </select>
				   </td>
				   <td>             
				 </tr>
				 <tr>
				  <td><b>Tipo_Incapacidad:</b></td>
					  <td><select name="tipo" class="cajas" id="tipo" style="width: 170px>
					  <option value="0">Seleccione La Descripción
					  <?
						$consulta_t="select * from tipoinca WHERE tipoinca.estado='ACTIVO' order by concepto ";
						$resultado_t=mysql_query($consulta_t)or die ("Consulta de eps incorrecta");
						while($filas_t=mysql_fetch_array($resultado_t)):
						  ?>
						  <option value="<?echo $filas_t["tipoinca"];?>"> <?echo $filas_t["concepto"];?>
						  <?
						  endwhile;
						  ?></select></td>
				   </td>
				   </tr>
					<tr>
				   <td><b>Eps:</b></td>
				   <td><input type="text"  name="eps" value="<?echo $filas["eps"];?>" size="25" class="cajas"readonly ></td>
				  </tr>
				   <td><b>Estado:</b></td>
				   <td><select name="estado" class="cajas" id="estado" style="width: 170px">
					   <option value="0">Seleccione el Estado
					   <option value="POR COBRAR">POR COBRAR
					   <option value="CANCELADA">CANCELADA
					   <option value="EN TRANSCRIPCION">EN TRANSCRIPCION</option>
				   </select></td>
				 </tr>
				 <tr>
				  <td><b>Diagnóstico:</b></td>
					  <td><select name="diagnostico" class="cajas">
					  <option value="0">Seleccione el diagnostico
					  <?
						$consulta_t="select control.codigo,control.concepto from control order by codigo";
						$resultado_t=mysql_query($consulta_t)or die ("Consulta de codigo incorrecta");
						while($filas_t=mysql_fetch_array($resultado_t)):
						  ?>
						  <option value="<?echo $filas_t["codigo"];?>"> <?echo $filas_t["codigo"];?>-<?echo $filas_t["concepto"];?>
						  <?
						  endwhile;
						  ?></select></td>
				   </td>
				   <tr>
				   <td><input type="hidden" name="fechapro" value="<?echo date("Y-m-d");?>" size="12" class="cajas" maxlength="10"readonly></td>
				 </tr>
				 <tr>
				  <td><b>Cod_Salario:</b></td>
					  <td><select name="CodSala" id="CodSala" class="cajas" style="width: 170px">
					  <option value="0">Seleccione
					  <?
						$consulta_t="select codsala,desala from salario where salario.agruparincapa='SI' order by desala";
						$resultado_t=mysql_query($consulta_t)or die ("Consulta de eps incorrecta");
						while($filas_t=mysql_fetch_array($resultado_t)):
						  ?>
						  <option value="<?echo $filas_t["codsala"];?>"> <?echo $filas_t["desala"];?>
						  <?
						  endwhile;
						  ?></select></td>
				   </td>
				    <tr>
				  <td><b>Reconocer_Usuaria:</b></td>
					  <td>
					     <select name="Reconocer" id="Reconocer" class="cajas" style="width: 170px">
					     <option value="0">Seleccione
					     <option value="NO">NO
					     <option value="SI">SI
					     </select></td>
				   </td>
				  <tr>
				   <td><b>Motivo:</b></td>
				   <td><textarea name="motivo" cols="60" rows="8" class="cajas" onFocus="ColorFoco(this.id)" class="cajas" onBlur="QuitarFoco(this.id)" id="motivo"></textarea></td>
				 </tr>
				 <tr><td><br></td></tr>
				   <tr>
					 <td colspan="2">
					   <input type="button" value="Guardar" class="boton" id ="grabar" onClick="chequearcampos()">
					   <input type="reset" value="Limpiar"  class="boton">                 </td>
				   </tr>
				  </table>
		    <?
	      }else{
			    ?>
             <script language="javascript">
               alert("El documento que se digito aparece retirado en sistema..!")
               history.back()
             </script>
           <?  
		  }	  
        else:
           ?>
             <script language="javascript">
               alert("Este documento no existe en Sistema ?")
               history.back()
             </script>
           <?
         endif;
   endif;
   ?>
</body>
</html>
