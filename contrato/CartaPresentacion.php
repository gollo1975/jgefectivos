<html>

<head>
  <title>Carta de Presentación</title>
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
					IdInicio.FechaHora.value = timeString;
					//Clock.innerHTML = timeString;

					window.setTimeout("tick();", 100);
			}
		    window.onload = tick;			 		 

   </script>
</head>

<body>

<?
if (!isset($cedula)){
?>
<center><h4><u>Carta de Presentación</u></h4></center>
<form  action="" method="post" id="IdInicio" name="IdInicio">
    <input type="hidden" name="UsuarioPreparador" value="<? echo $UsuarioPreparador;?>" id="UsuarioPreparador">
	<input type="hidden" name="FechaHora" value="" id="FechaHora">
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
     $Sql="select convenio.*  from convenio where convenio.cedemple='$cedula' and (convenio.tipocontrato='LABOR' OR convenio.tipocontrato='INDEFINIDO' OR convenio.tipocontrato='FIJO' )order by convenio.nroconvenio DESC limit 1";
     $Rs=mysql_query($Sql)or die("Error al validar el contrato de trabajo.");
     $Contador=mysql_num_rows($Rs);
     $fila_B=mysql_fetch_array($Rs);
	 $NroExamen = $fila_B["nro"];
	 $NroConvenio = $fila_B["nroconvenio"];;
     if($Contador != 0){?>
            <center><h4><u>Carta de Presentación</u></h4></center>
            <form action="GrabarPresentacion.php" method="post" id="IdFinal" name="IdFinal">
   	         <input type="hidden" name="UsuarioPreparador" value="<? echo $UsuarioPreparador;?>" id="UsuarioPreparador">
			 <input type="hidden" name="FechaHora" value="<?echo $FechaHora;?>" id="FechaHora">
			 <input type="hidden" name="NroExamen" value="<?echo $NroExamen;?>" id="NroExamen">
			  <input type="hidden" name="NroConvenio" value="<?echo $NroConvenio;?>" id="NroConvenio">
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
                       <tr>
	                    <td><b>Cargo:&nbsp;</b></td>
	                    <td><input type="text" name="Cargo" value="<?echo $fila_B["cargo"];?>" size="53" class="cajas" maxlength="50" onfocus="ColorFoco(this.id)" readonly onblur="QuitarFoco(this.id)" id="Cargo"></td>
	               </tr>
                       <tr>
	                    <td><b>Eps:</b></td>
	                    <td colspan="10"><select name="CodEps" class="cajasletra" style="width: 338px" id="CodEps">
                            <option value="0">Seleccione la Eps
	                        <?
                                 $consulta_e="select * from eps order by eps.eps";
                                 $resultado_e=mysql_query($consulta_e) or die("consulta de Eps Incorrecta");
                                 while ($filas_e=mysql_fetch_array($resultado_e))
                                        {
	                                ?>
		                        <option value="<?echo $filas_e["codeps"];?>"><?echo $filas_e["eps"];?>
		                        <?
	                                }
	                                ?>
	                   </select></td>
                       </tr>
                       <tr>
	                    <td><b>Pensión:</b></td>
	                    <td colspan="10"><select name="CodPension" class="cajasletra" style="width: 338px" id="CodPension">
                            <option value="0">Seleccione el fondo
	                        <?
                                 $sqlPension="select * from pension order by pension.pension";
                                 $RsP=mysql_query($sqlPension) or die("consulta de pension Incorrecta");
                                 while ($filaP=mysql_fetch_array($RsP))
                                        {
	                                ?>
		                        <option value="<?echo $filaP["codpension"];?>"><?echo $filaP["pension"];?>
		                        <?
	                                }
	                                ?>
	                   </select></td>
                       </tr>
                       <tr>
                           <td><b>Caja_Compensación:</b></td>
                              <td colspan="30"><select name="CodCaja"class="cajasletra" id="CodCaja" style="width: 338px">
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
	                    <td><b>F_Contratación:&nbsp;</b></td>
	                    <td><input type="text" name="FechaContratacion" value="<?echo date("Y-m-d");?>" size="15" class="cajas" maxlength="10" onfocus="ColorFoco(this.id)"  onblur="QuitarFoco(this.id)" id="FechaContratacion"></td>
	               </tr>
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
