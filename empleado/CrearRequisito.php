<html>
<head>
  <title></title>
</head>
<LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
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
          if (document.getElementById("Cedula").value.length <=0)
          {
             alert ("Digite el documento de Identidad ?");
             document.getElementById("Cedula").focus();
             return;
          }
             document.getElementById("matcrea").submit();
      }
      function validar()
      {
          if (document.getElementById("Nombre").value.length <=0)
             {
             alert ("Digite el nombre del empleado ?");
             document.getElementById("Nombre").focus();
             return;
          }
             document.getElementById("f1").submit();
          }
      function ActualizarSaldo()
      {

         var nEle = document.f1.elements.length;
               for (i=0; i<nEle; i++) {
                  if (document.f1.elements[i].type=="checkbox" &&
	                document.f1.elements[i].name.lastIndexOf('DatoN')!=-1 ) {
			document.f1.elements[i].checked ? document.f1.elements[i].checked=false : document.f1.elements[i].checked=true;
	          }
                }
      }

        </script>
<?
if(!isset($Cedula)):
   include("../conexion.php");
	   ?>
	  <div align="center"><h4><u>Check de Lista</u></h4></div>
	  <form action="" method="post" id="matcrea">
	  <input type="hidden" name="CodUsuario" value="<?echo $CodUsuario;?>">
	     <table border="0" align="center">
	        <tr><td><br></td></tr>
	        <tr>
	            <td><b>Documento de Identidad:&nbsp;</b></td>
	            <td><input type="text" name="Cedula" size="15" maxlength="15" onFocus="ColorFoco(this.id)" class="cajas"onblur="QuitarFoco(this.id)" id="Cedula"></td>
	        </tr>
	        <tr>
                     <td><b>Tipo_Verificacion:</b></td>
                     <td><select size="1" name="TipoE" class="cajas" id="TipoE">
                          <option value="0">Seleccione</option>
                          <option value="INGRESO">INGRESO</option>
                          <option value="REINGRESO">REINGRESO</option>
                     </select></td>
               </tr>
	       <tr><td><br></td></tr>
	       <td colspan="5">
	       <input type="button" value="Buscar" class="boton" onClick="chequearcampos()"></td>
	     </table>
	    </form>
<?
elseif(empty($TipoE)):
  ?>
  <script language="javascript">
     alert("Seleccione el estado de verificacion.!")
     history.back()
  </script>
  <?
else:
   include("../conexion.php");
   if($TipoE=='INGRESO'){
        $con="select examen.nombre from examen where examen.cedula='$Cedula' and examen.control='FALTA'";
   }else{
        $con="select CONCAT(nomemple, ' ', nomemple1, ' ', apemple, ' ', apemple1) as nombre from empleado where empleado.cedemple='$Cedula'";
   }
   $res=mysql_query($con)or die ("Error al buscar el examen ?");   
   $reg=mysql_num_rows($res);
   $filas_E=mysql_fetch_array($res);
   if($reg != 0):
        ?>
	    <div align="center"><h4><u>Check de Lista</u></h4></div>
	    <form action="GrabarChequeo.php" method="post" id="f1" name="f1">
            <input type="hidden" name="UsuarioPreparador" value="<?echo $UsuarioPreparador;?>">
              <table border="0" align="center">
	          <tr>
	            <td><b>Documento:</b></td>
	            <td><input type="text" name="Cedula" value="<?echo $Cedula;?>"size="15" class="cajas" readonly onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="Cedula" readonly></td>
	          </tr>
	          <tr>
	            <td><b>Empleado:</b></td>
	            <td><input type="text" name="Nombre" value="<?echo $filas_E["nombre"];?>" size="55" maxlength="55" class="cajas" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="Nombre" readonly></td>
	          </tr>
	          <tr>
	            <td><b>Tipo_Verificacion:</b></td>
	            <td><input type="text" name="TipoE" value="<?echo $TipoE;?>" class="cajas"size="13" readonly onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" readonly id="TipoE"></td>
	          </tr>
			   <tr>
                   <td><b>Observación:</b></td>
                   <td colspan="9"><textarea name="Nota" cols="56" rows="4" class="cajas" id="Nota"></textarea></td>
               </tr>
	          <tr><td><br></td></tr>
	         <?
             $con1="select listadodocumentoempleado.* from listadodocumentoempleado
                   where listadodocumentoempleado.estado='ACTIVO' order by listadodocumentoempleado.iddocumento";
             $resu1=mysql_query($con1)or die ("Error al buscar provedores");
             $reg1=mysql_num_rows($resu1);
             if($reg1!=0):
                                ?>
                                  <table border="0" align="center" >
                                   <tr class="cajas">
                                      <th><input type="checkbox" name="calculo" onClick="ActualizarSaldo()"></th><th><b>&nbsp;<u>Descripción</u></b></th><th><b><u>C_Real</u></b></th><th><b><u>Estado</u></b></th><th><b><u>Validar</u></b></th><th><b><u>C_Ent.</u></b></th><th><b><u>C_Pend.</u></b></th>
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
	                                        echo "<td><input type=\"checkbox\" id=\"DatoN[" . $i . "]\" name=\"DatoN[" . $i . "]\" value=\"" . $filas_s['iddocumento'] ."\" onClick=\"ActualizarSaldo()\"></td>";?>
	                                        <td><input type="text" value="<?echo $filas_s["concepto"];?>" name="Concepto[<? echo $i;?>]"id="Concepto[<? echo $i;?>]" size="90"  readonly class="cajas"> </td>
	                                        <td><input type="text"  value="<? echo $filas_s["sugerido"];?>" name="CantidadReal[<?php echo $i;?>]" id="CantidadReal[<?php echo $i;?>]" size="5" class="cajas" readonly> </td>
											<td><input type="text" value="<? echo $filas_s["estado"];?>" name="Estado[<?php echo $i;?>]" id="Estado[<?php echo $i;?>]" size="9"  readonly class="cajas"> </td>
	                                        <td><select size="1" name="ValidarDocumento[<?php echo $i;?>]" id="ValidarDocumento[<?php echo $i;?>]" class="cajas">
                                                   <option value="NO APLICA">NO APLICA</option>
                                                   <option value="OK">OK</option>
	                                           <option value="PENDIENTE">PENDIENTE</option>
	                                        </select></td>
                                                <td><input type="text"  name="Cantidad[<?php echo $i;?>]" id="Cantidad[<?php echo $i;?>]" size="5" class="cajas"> </td>
                                                 <td><input type="text"  name="ValidarPendiente[<?php echo $i;?>]" id="ValidarPendiente[<?php echo $i;?>]" class="cajas" size="6"></td>
                                       </tr>
                                       <?
                                       endwhile;
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
            alert("Este Documento no tiene examen de ingreso en el sistema.!")
            history.back()
         </script>
         <?
      endif;
endif;
?>
</body>
</html>
