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
                            alert ("Digitar el Documento del posible Empleado.!");
                            document.getElementById("cedula").focus();
                            return;
                        }
                         document.getElementById("IdInicio").submit();
                     }
                     function valide()
                      {
                         if (document.getElementById("FechaExamen").value == 0)
                        {
                            alert ("Digite la fecha en que el empleado se hizo el examen.!");
                            document.getElementById("FechaExamen").focus();
                            return;
                        }
                        if (document.getElementById("Dias").value == 0)
                         {
                            alert ("Digite el plazo en días para el nuevo examen.!");
                            document.getElementById("Dias").focus();
                            return;
                        }
                         document.getElementById("IdFinal").submit();
                     }
   </script>
</head>

<body>

<?
if (!isset($cedula)){
?>
<center><h4><u>Restricción Medica</u></h4></center>
<form  action="" method="post" id="IdInicio" name="IdInicio">
    <input type="hidden" name="UsuarioPreparador" value="<? echo $UsuarioPreparador;?>" id="UsuarioPreparador">
    <table border="0" align="center">
       <tr><td><br></td></tr>
       <tr>
        <td><b>Documento de Identidad:&nbsp;</b></td>
         <td><input type="text" name="cedula" size="18" maxlength="15" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="cedula"></td>
       </tr>
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
}else{
    include("../conexion.php");
     /*COSDIGO QUE VALIDA SI UN EMPLEADO ESTA EN SISTEMA*/
     $Sr="select empleado.diremple,empleado.fechanac,empleado.municipio,concat(nomemple,' ',nomemple1,' ',apemple,' ', apemple1) as Empleado from empleado where empleado.cedemple='$cedula'";
     $Rs=mysql_query($Sr)or die("Error el empleado");
     $fila_E=mysql_fetch_array($Rs);
     $Empleado = $fila_E["Empleado"];
     /*CODIGO DE QUE VALIDA EL EXAMENE*/
     $Sql="select examen.validadoso,examen.nombre,examen.cargo,examen.codzona  from examen where examen.cedula='$cedula' and examen.validadoso='SI' order by examen.nro ASC limit 1";
     $Rs=mysql_query($Sql)or die("Error al validar el examen");
     $Contador=mysql_num_rows($Rs);
     $fila_B=mysql_fetch_array($Rs);
     if ($Empleado ==''){
           $Empleado = $fila_B["nombre"];
     }
     if($Contador != 0){?>
            <center><h4><u>Restriccion Medica</u></h4></center>
            <form action="GrabarRestriccion.php" method="post" id="IdFinal" name="IdFinal">
   	         <input type="hidden" name="UsuarioPreparador" value="<? echo $UsuarioPreparador;?>" id="UsuarioPreparador">
                 <table border="0" align="center" width="450">
                       <tr>
	                    <td><b>Documento:&nbsp;</b></td>
	                    <td><input type="text" name="Documento" value="<?echo $cedula;?>" size="15" class="cajas" maxlength="12" onfocus="ColorFoco(this.id)" readonly onblur="QuitarFoco(this.id)" id="Documento"></td>
	               </tr>
                       <tr>
	                    <td><b>Empleado:&nbsp;</b></td>
	                    <td><input type="text" name="Trabajador" value="<?echo $Empleado;?>" size="53" class="cajas" maxlength="50" onfocus="ColorFoco(this.id)" readonly onblur="QuitarFoco(this.id)" id="Trabajador"></td>
	               </tr>
                       <tr>
	                    <td><b>Fecha_Examen:&nbsp;</b></td>
	                    <td><input type="text" name="FechaExamen" value="<?echo date('Y-m-d');?>" size="15" class="cajas" maxlength="10" onfocus="ColorFoco(this.id)"  onblur="QuitarFoco(this.id)" id="FechaExamen"></td>
	               </tr>
                       <tr>
	                    <td><b>Dias de Plazo:&nbsp;</b></td>
	                    <td><input type="text" name="Dias" value="" size="15" class="cajas" maxlength="10" onfocus="ColorFoco(this.id)"  onblur="QuitarFoco(this.id)" id="Dias"></td>
	               </tr>
                         <tr>
	                    <td><b>Tipo_Revision:&nbsp;</b></td>
                             <td><select name="TipoRevision" class="cajasletra" id="TipoRevision" style="width: 110px">
	                      <option value="Revisión Eps">Revision Eps
                              <option value="Revisión Afp">Revision Afp
                              <option value="Revisión Arl">Revision Arl
	                      </select></td>
	               </tr>
                        <tr>
	                    <td><b>Firma:&nbsp;</b></td>
	                    <td><input type="text" name="Firma" value="RUBEN DARIO ZEA" size="53" class="cajas" maxlength="53" onfocus="ColorFoco(this.id)"  onblur="QuitarFoco(this.id)" id="Firma"></td>
	               </tr>
                        <tr>
	                    <td><b>Profesión:&nbsp;</b></td>
	                    <td><input type="text" name="Profesion" value="Tecnólogo en Higiene y Seguridad Ocupacional" size="53" class="cajas" maxlength="53" onfocus="ColorFoco(this.id)"  onblur="QuitarFoco(this.id)" id="Profesion"></td>
	               </tr>
                       <tr>
	                    <td><b>Licencia:&nbsp;</b></td>
	                    <td><input type="text" name="Licencia" value="Res.067678 de DSSA" size="53" class="cajas" maxlength="53" onfocus="ColorFoco(this.id)"  onblur="QuitarFoco(this.id)" id="Licencia"></td>
	               </tr>
                        <tr>
	                    <td><b>Cargo:&nbsp;</b></td>
	                    <td><input type="text" name="Cargo" value="Coordinador Salud Ocupacional" size="53" class="cajas" maxlength="53" onfocus="ColorFoco(this.id)"  onblur="QuitarFoco(this.id)" id="Cargo"></td>
	               </tr>
                        <table border="0" align="center" width="450">
	                   <tr class="cajas">
		             <th><b>#</b></td><th>&nbsp;</th><th><b>Codigo</b></th><th><b>Descripción</b></th>
		           </tr>
	                       <?
	                       $SqlR="select restriccionmedica.*  from restriccionmedica where restriccionmedica.estado='ACTIVO' order by restriccionmedica.concepto ";
	                       $RrM=mysql_query($SqlR)or die("Restriccion Medicas");
	                       $TotalRegistro = mysql_num_rows($RrM);
	                       $i=1;
	                       while ($fila = mysql_fetch_array($RrM)):
		                  ?>
		                  <tr class="cajas">
		                     <th><?echo $i;?></th>
		                     <?
		                     echo ("<td><input type=\"checkbox\" id=\"Dato[" . $i . "]\" name=\"Dato[" . $i . "]\" value=\"" . $fila['idrestriccion'] ."\"  \"></td>");?>
		                     <td><input type="text" value="<?echo $fila["idrestriccion"];?>" name="IdRestriccion[<? echo $i;?>]"id="IdRestriccion[<? echo $i;?>]" size="5" readonly class="cajas"></td>
		                     <td><input type="text" value="<?echo $fila["concepto"];?>" name="Concepto[<? echo $i;?>]"id="Concepto[<? echo $i;?>]" size="60" readonly class="cajas"></td>
		                  <tr>
		                  <?
		                  $i=$i+1;
		               endwhile;
                       ?>
                       <td><input type="hidden" value="<?echo $TotalRegistro;?>" name="TotalR" id="TotalR" size="40" class="cajas" readonly></td>
                       <tr><td colspan="10"><br></td></tr>
                       <tr>
                       <td colspan="2">
                          <input type="button" value="Enviar Dato" class="boton" name="Grabar" id="Grabar" onclick="valide()"></td>
                       </tr>
                 </table>
            </form>
          <?
     }else{
            ?>
             <script language="javascript">
                alert("El examen de este empleado no ha sido validado por el Departamento de Salud Ocupacional.!")
                 history.back()
            </script>
             <?
    }
}
?>
</body>

</html>
