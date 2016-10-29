<html>

<head>
  <title>Traslado de Administradora</title>
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
<center><h4><u>Traslado de Administradora</u></h4></center>
<form  action="" method="post" id="IdInicio" name="IdInicio">
    <input type="hidden" name="UsuarioPreparador" value="<? echo $UsuarioPreparador;?>" id="UsuarioPreparador">
    <table border="0" align="center">
       <tr><td><br></td></tr>
       <tr>
        <td><b>Documento de Identidad:&nbsp;</b></td>
         <td><input type="text" name="cedula" size="18" maxlength="15" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="cedula"></td>
       </tr>
       <tr>
           <td><b>Tipo_Proceso:</b>&nbsp;</td>
           <td><input type="radio" value="Eps" name="Estado">Eps<input type="radio" value="Pension" name="Estado">Pensión</td>
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
}elseif(empty($Estado)){
?>
    <script language="javascript">
       alert("Seleccion el tipo de proceso con el fin de generar el documento adecuado.")
       history.back()
    </script>
<?
}else{
    include("../conexion.php");
     /*CODIGO DE QUE VALIDA EL CONTRATO*/
     $Sql="select CONCAT(nomemple, ' ', nomemple1, ' ', apemple, ' ', apemple1) AS Empleado,empleado.codeps,empleado.codpension,zona.zona  from empleado,contrato,zona where
          empleado.codemple=contrato.codemple and
          contrato.fechater='0000-00-00' and
          empleado.codzona=zona.codzona and
          empleado.cedemple='$cedula'";
     $Rs=mysql_query($Sql)or die("Error al validar el contrato de trabajo.");
     $Contador=mysql_num_rows($Rs);
     $fila_B=mysql_fetch_array($Rs);
     $CodEps= $fila_B["codeps"];
     $CodPension= $fila_B["codpension"];
     /*codigo que valide la Eps*/
     $SqlE="select eps.eps  from eps where
         eps.codeps='$CodEps'";
     $RsE=mysql_query($SqlE)or die("Error al validar la Eps.");
     $fila_E=mysql_fetch_array($RsE);
     $EpsActual = $fila_E["eps"];
     /*codigo que valida el fondo de pension*/
     $SqlP="select pension.pension  from pension where
         pension.codpension='$CodPension'";
     $RsP=mysql_query($SqlP)or die("Error al validar el Fondo.");
     $fila_P=mysql_fetch_array($RsP);
     $PensionActual = $fila_P["pension"];
     if($Contador != 0){?>
            <center><h4><u>Traslado de Administradora</u></h4></center>
            <form action="GrabarCartaTraslado.php" method="post" id="IdFinal" name="IdFinal">
   	         <input type="hidden" name="UsuarioPreparador" value="<? echo $UsuarioPreparador;?>" id="UsuarioPreparador">
                 <input type="hidden" value="<?echo $Estado;?>" name="Estado" id="Estado">
                 <input type="hidden" value="<?echo $EpsActual;?>" name="EpsActual" id="EpsActual">
                 <input type="hidden" value="<?echo $PensionActual;?>" name="PensionActual" id="PensionActual">
                 <table border="0" align="center" width="450">
                       <tr>
	                    <td><b>Documento:&nbsp;</b></td>
	                    <td><input type="text" name="Documento" value="<?echo $cedula;?>" size="13" class="cajas" maxlength="12" onfocus="ColorFoco(this.id)" readonly onblur="QuitarFoco(this.id)" id="Documento"></td>
	               </tr>
                       <tr>
	                    <td><b>Empleado:&nbsp;</b></td>
	                    <td><input type="text" name="Trabajador" value="<?echo $fila_B["Empleado"];?>" size="53" class="cajas" maxlength="50" onfocus="ColorFoco(this.id)" readonly onblur="QuitarFoco(this.id)" id="Trabajador"></td>
	               </tr>
                       <tr>
	                    <td><b>Zona:&nbsp;</b></td>
	                    <td><input type="text" name="Zona" value="<?echo $fila_B["zona"];?>" size="53" class="cajas" maxlength="50" onfocus="ColorFoco(this.id)" readonly onblur="QuitarFoco(this.id)" id="Zona"></td>
	               </tr>
                       <?if($Estado=='Eps'){?>
                                <tr>
		                    <td><b>Cod_Eps:&nbsp;</b></td>
		                    <td><input type="text" name="CodEps" value="<?echo $fila_B["codeps"];?>" size="13" class="cajas" maxlength="4" onfocus="ColorFoco(this.id)" readonly onblur="QuitarFoco(this.id)" id="CodEps"><b><?echo $fila_E["eps"];?></b></td>
	                       </tr>
	                       <tr>
		                    <td><b>Eps_Traslado:</b></td>
		                    <td colspan="10"><select name="CodEpsTraslado" class="cajasletra" style="width: 338px" id="CodEpsTraslado">
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
                        <?}else{?>
	                        <tr>
		                    <td><b>Cod_Pensión:&nbsp;</b></td>
		                    <td><input type="text" name="CodPension" value="<?echo $fila_B["codpension"];?>" size="4" class="cajas" maxlength="4" onfocus="ColorFoco(this.id)" readonly onblur="QuitarFoco(this.id)" id="CodPension"><b><?echo $fila_P["pension"];?></b></td>
		                </tr>
	                        <tr>
		                    <td><b>Pensión:</b></td>
		                    <td colspan="10"><select name="CodPensionTraslado" class="cajasletra" style="width: 338px" id="CodPensionTraslado">
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
                        <?}?>
                        <tr>
	                    <td><b>F_Traslado:&nbsp;</b></td>
	                    <td><input type="text" name="FechaTraslado" value="<?echo date("Y-m-d");?>" size="15" class="cajas" maxlength="10" onfocus="ColorFoco(this.id)"  onblur="QuitarFoco(this.id)" id="FechaTraslado"></td>
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
