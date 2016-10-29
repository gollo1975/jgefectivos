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

   </script>
</head>

<body>

<?
if (!isset($cedula)){
?>
<center><h4><u>Entrega Documentos</u></h4></center>
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
     /*CODIGO DE QUE VALIDA EL EXAMENE*/
     $Sql="select convenio.*  from convenio where convenio.cedemple='$cedula' and (convenio.tipocontrato='LABOR' OR convenio.tipocontrato='INDEFINIDO' OR convenio.tipocontrato='FIJO' )order by convenio.nroconvenio ASC limit 1";
     $Rs=mysql_query($Sql)or die("Error al validar el contrato de trabajo.");
     $Contador=mysql_num_rows($Rs);
     $fila_B=mysql_fetch_array($Rs);
     if($Contador != 0){?>
            <center><h4><u>Entrega Documentos</u></h4></center>
            <form action="GrabarDocumento.php" method="post" id="IdFinal" name="IdFinal">
   	         <input type="hidden" name="UsuarioPreparador" value="<? echo $UsuarioPreparador;?>" id="UsuarioPreparador">
                 <table border="0" align="center" width="450">
                       <tr>
	                    <td><b>Documento:&nbsp;</b></td>
	                    <td><input type="text" name="Documento" value="<?echo $cedula;?>" size="15" class="cajas" maxlength="12" onfocus="ColorFoco(this.id)" readonly onblur="QuitarFoco(this.id)" id="Documento"></td>
	               </tr>
                        <tr>
	                    <td><b>Lugar_Expedición:&nbsp;</b></td>
	                    <td><input type="text" name="LugarExpedicion" value="<?echo $fila_B["lugarexpedicion"];?>" size="53" class="cajas" maxlength="50" onfocus="ColorFoco(this.id)" readonly onblur="QuitarFoco(this.id)" id="LugarExpedicion"></td>
	               </tr>
                       <tr>
	                    <td><b>Empleado:&nbsp;</b></td>
	                    <td><input type="text" name="Trabajador" value="<?echo $fila_B["nombres"];?>" size="53" class="cajas" maxlength="50" onfocus="ColorFoco(this.id)" readonly onblur="QuitarFoco(this.id)" id="Trabajador"></td>
	               </tr>
                       <tr>
	                    <td><b>Zona:&nbsp;</b></td>
	                    <td><input type="text" name="Zona" value="<?echo $fila_B["zona"];?>" size="53" class="cajas" maxlength="50" onfocus="ColorFoco(this.id)" readonly onblur="QuitarFoco(this.id)" id="Zona"></td>
	               </tr>
                        <table border="0" align="center" width="440">
	                   <tr class="cajas">
		             <th><b>Item</b></td><th>&nbsp;</th><th><b>Id</b></th><th><b>Descripción</b></th>
		           </tr>
	                       <?
	                       $SqlR="select itementregadocumento.*  from itementregadocumento where itementregadocumento.estado='ACTIVO' order by itementregadocumento.concepto ";
	                       $RrM=mysql_query($SqlR)or die("error al validar los conceptos de entrega.");
	                       $TotalRegistro = mysql_num_rows($RrM);
	                       $i=1;
	                       while ($fila = mysql_fetch_array($RrM)):
		                  ?>
		                  <tr class="cajas">
		                     <th><?echo $i;?></th>
		                     <?
		                     echo ("<td><input type=\"checkbox\" id=\"Dato[" . $i . "]\" name=\"Dato[" . $i . "]\" value=\"" . $fila['iddocumento'] ."\"  \"></td>");?>
		                     <td><input type="text" value="<?echo $fila["iddocumento"];?>" name="IdDocumento[<? echo $i;?>]"id="IdDocumento[<? echo $i;?>]" size="5" readonly class="cajas"></td>
		                     <td><input type="text" value="<?echo $fila["concepto"];?>" name="Concepto[<? echo $i;?>]"id="Concepto[<? echo $i;?>]" size="54" readonly class="cajas"></td>
		                  <tr>
		                  <?
		                  $i=$i+1;
		               endwhile;
                       ?>
                       <td><input type="hidden" value="<?echo $TotalRegistro;?>" name="TotalR" id="TotalR" size="40" class="cajas" readonly></td>
                       <tr><td colspan="10"><br></td></tr>
                       <tr>
                       <td colspan="15">
                          <input type="submit" value="Enviar Dato" class="boton" name="Grabar" id="Grabar"></td>
                       </tr>
                 </table>
            </form>
          <?
     }else{
            ?>
             <script language="javascript">
                alert("No hay Contrato de trabajo generado para este documento.!")
                 history.back()
            </script>
             <?
    }
}
?>
</body>

</html>
