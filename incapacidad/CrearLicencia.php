<html>
        <head>
                <title>Proceso de Licencias</title>
               <LINK  REL="stylesheet" HREF="../estilo.css" type="text/css">

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
                        if (document.getElementById("Cedula").value.length <=0)
                        {
                            alert ("Digite el documento de identidad del Empleado.!");
                            document.getElementById("Cedula").focus();
                            return;
                        }
                         document.getElementById("matmemo").submit();

                    }
                </script>
                <?
if (!isset($Cedula)){
    include("../conexion.php");  ?>
    <center><h4><u>LICENCIAS..</u></h4></center>
     <form action="" method="post" id="matmemo" name="matmemo">
     <input type="hidden" name="UsuarioSistema" value="<?echo $codigo;?>">
         <table border="0" align="center"
            <tr><td><br></td></tr>
           <tr>
              <td><b>Documento de Identidad:</b></td>
              <td><input type="text" name="Cedula" value="" size="25" mexlength="15" class="cajas" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="Cedula"></td>
           </tr>
         <tr>
         <td><b>Concepto_Nomina:</b></td>
         <td colspan="1"><select name="ConceptoNomina" id="ConceptoNomina" class="cajasletra" style="width: 167px">
             <option value="0">Seleccione
             <?
             $consulta_z="select salario.codsala,salario.desala from salario where salario.validarlicencia='SI' and salario.estado='ACTIVO'  order by desala";
             $resultado_z=mysql_query($consulta_z) or die("Error al buscar el concepto de nomina");
             while ($filas_z=mysql_fetch_array($resultado_z))
                   {
                   ?>
                   <option value="<?echo $filas_z["codsala"];?>"><?echo $filas_z["desala"];?>
                   <?
                   }
                   ?>
                   </select></td>
           </tr>
          <tr><td><br></td></tr>
          <tr>
             <td colspan="6">
             <input type="button" Value="Guardar" class="boton" id ="grabar" name="grabar" onClick="chequearcampos()">&nbsp;<input type="reset" Value="Limpiar" class="boton"></td>
         </tr>
     </table>
  </form>
<?
}elseif(empty($ConceptoNomina)){
?>
  <script language="javascript">
     alert("Seleccion un concepto de nomina de la lista!")
     history.back()
  </script>
<?
}else{
      include("../conexion.php");
      /*codigo que busca el tipo de proceso*/
      $conP="select salario.desala  from salario
	       where salario.codsala='$ConceptoNomina'";
               $resP=mysql_query($conP) or die("Error al el tipo de proceso");
               $filaP=mysql_fetch_array($resP);
               $Concepto=$filaP["desala"];
      /*fin codigo*/
      $conM="select empleado.cedemple,concat(nomemple, ' ' ,nomemple1, ' ' ,apemple, ' ' , apemple1) as nombres,empleado.basico,empleado.codzona  from empleado,contrato
	    where empleado.codemple=contrato.codemple and
	          contrato.fechater='0000-00-00' and
	          empleado.cedemple='$Cedula'";
      $resulM=mysql_query($conM) or die("Error al busca empleados");
      $reg=mysql_num_rows($resulM);
      $filas=mysql_fetch_array($resulM);
      $nombres=$filas["nombres"];
      $Salario=$filas["basico"];
      $CodZona=$filas["codzona"];
      if($reg==0):
	      ?>
	      <script language="javascript">
	         alert("Este empleado se encuentra retirado del Sistema. Validar con Nómina.!")
	         history.back()
	      </script>
	      <?
      else:
	     ?>
	      <center><h4><u>LICENCIAS..</u></h4></center>
	      <form action="GrabarLicencia.php" method="post" id="f1" name="f1">
              <input type="hidden" name="Salario" value="<?echo $Salario;?>">
              <input type="hidden" name="UsuarioSistema" value="<?echo $UsuarioSistema;?>">
              <input type="hidden" name="Concepto" value="<?echo $Concepto;?>">
              <input type="hidden" name="CodZona" value="<?echo $CodZona;?>">
	         <table border="0" align="center"
	             <tr>
	             <td><b>Documento:</b></td>
	             <td><input type="text" name="Cedula" value="<?echo $Cedula;?>" size="15" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" readonly class="cajas" id="Cedula"></td>
	            </tr>
	            <tr>
	             <td><b>Empleado:</b></td>
	             <td><input type="text" name="Empleado" value="<?echo $nombres;?>" size="45"  onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" readonly class="cajas" id="Empleado"></td>
	            </tr>
                    <tr>
	             <td><b>Código_Nómina:</b></td>
	             <td><input type="text" name="ConceptoNomina" value="<?echo $ConceptoNomina;?>" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" size="4"  readonly class="cajas" id="ConceptoNomina"><?echo $Concepto;?></td>
	            </tr>
                     <tr>
	             <td><b>Desde:</b></td>
	             <td><input type="text" name="Desde" value="<?echo date('Y-m-d');?>" size="15"  onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" maxlength="10" class="cajas" id="Desde"></td>
	            </tr>
                   <tr>
	             <td><b>Hasta:</b></td>
	             <td><input type="text" name="Hasta" value="<?echo date('Y-m-d');?>" size="15" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" maxlength="10"  class="cajas" id="Hasta"></td>
	            </tr>
		    <tr>
				<td><b>Afecta_Auxilio:</b></td>
				<td><select name="Afecta" class="cajas"  style="width: 109px" id="Afecta">
				<option value="SI">SI
				<option value="NO">NO
				</select></td>
		    </tr>
                    	<tr>
			   <td><b>Comentarios:</b></td>
			   <td><textarea name="Nota" cols="45" rows="3" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Nota"></textarea></td>
	  	        </tr>
	            <tr><td><br></td></tr>
	            <tr>
	               <td colspan="6">
	                 <input type="submit" Value="Guardar" class="boton">&nbsp;<input type="reset" Value="Limpiar" class="boton"></td>
	            </tr>
	     </table>
	   </form>
          <?
    endif;
}
                 ?>
        </body>
</html>
