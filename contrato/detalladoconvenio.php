<html>

<head>
  <title></title>
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
                         if (document.getElementById("Documento").value == 0)
                          {
                            alert ("El campo Documento de identidad no puede ser Vacío");
                            document.getElementById("Documento").focus();
                            return;
                          }
                           if (document.getElementById("Empleado").value == 0)
                          {
                            alert ("El campo nombre del Empleado no puede ser Vacío");
                            document.getElementById("Empleado").focus();
                            return;
                          }
                        if (document.getElementById("Salario").value == 0)
                         {
                            alert ("Digite el Salario del empleado.!");
                            document.getElementById("Salario").focus();
                            return;
                         }
                         if (document.getElementById("Cargo").value == 0)
                         {
                            alert ("Digite el cargo del Empleado.!");
                            document.getElementById("Cargo").focus();
                            return;
                         }
                        if (document.getElementById("Proceso").value == 0)
                         {
                            alert ("Digite el proceso a Ejecutar en la Empresa.!");
                            document.getElementById("Proceso").focus();
                            return;
                         }
                         document.getElementById("Matriz").submit();
                     }
   </script>
</head>

<body>
<?php
include("../conexion.php");
$con1="select convenio.* from convenio where nroconvenio='$nro'";
$resu1=mysql_query($con1)or die("Error en la busqueda del convenio");
$reg1=mysql_affected_rows();
$filas=mysql_fetch_array($resu1);
if($TipoContrato =='INDEFINIDO'){
     ?>
      <center><h4><u>Editar Contrato Temporal</u></h4></center>
      <form action="grabardetalle.php" method="post" id="Fijo">
          <input type="hidden" name="TipoContrato" value="<?echo $TipoContrato;?>" size="15" class="cajas">
          <input type="hidden" name="UsuarioPreparador" value="<?echo $UsuarioPreparador;?>" size="15" class="cajas">
          <input type="hidden" name="codigo" value="<?echo $codigo;?>" size="15" class="cajas">
          <table border="0" align="center">
              <tr>
                    <td><b>Nro_Contrato:&nbsp;</b></td>
                    <td><input type="text" name="NroContrato" value="<?echo $nro;?>" size="15" class="cajas" readonly id="NroContrato">&nbsp;</td>
              </tr>
              <tr>
                    <td><b>Documento:&nbsp;</b></td>
                    <td><input type="text" name="Documento" value="<?echo $filas["cedemple"];?>" size="15" class="cajas" maxlength="15" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Documento">&nbsp;</td>
                    <td><b>Empleado:&nbsp;</b></td>
                    <td><input type="text" name="Empleado" value="<?echo $filas["nombres"];?>" size="46" class="cajas" maxlength="50" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Empleado"></td>
              </tr>
              <tr>
              <td><b>Lugar Exped.:</b></td>
              <td colspan="30"><select name="LugarExpedicion"class="cajas" id="LugarExpedicion" style="width: 501px">
                  <?
                    $Aux=$filas["codmuni"];
                    $consulta_c="select codmuni,municipio from municipio order by municipio";
                    $resultado_c=mysql_query($consulta_c) or die("consulta de Costo Incorrecta");
                    while ($filas_c=mysql_fetch_array($resultado_c)){
                            if($Aux==$filas_c["codmuni"]){
                                ?>
                                <option value="<?echo $filas_c["codmuni"];?>" selected><?echo $filas_c["municipio"];?>
                                <?
                            }else{
                                ?>
                                <option value="<?echo $filas_c["codmuni"];?>"><?echo $filas_c["municipio"];?>
                                <?
                            }
                    }
                  ?>
                  </select></td>
              </tr>
              <tr>
                    <td><b>Salario:&nbsp;</b></td>
                    <td><input type="text" name="Salario" value="<?echo $filas["salario"];?>" size="15" maxlength="11" class="cajas"  onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Salario">&nbsp;</td>
                    <td><b>Cargo:&nbsp;</b></td>
                    <td><input type="text" name="Cargo" value="<?echo $filas["cargo"];?>" size="46" maxlength="30" class="cajas" maxlength="50" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Cargo"></td>
              </tr>
               <tr>
                    <td><b>F_Contratación:&nbsp;</b></td>
                    <td><input type="text" name="FechaContratacion" value="<?echo $filas["fechacontratacion"];?>" size="15" maxlength="10" class="cajas"  onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="FechaContratacion">&nbsp;</td>
                    <td><b>Barrio:&nbsp;</b></td>
                    <td><input type="text" name="Barrio" value="<?echo $filas["barrio"];?>" size="46" maxlength="30" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Barrio"></td>
              </tr>
              <tr>
                  <td><b>Forma_Pago:</b></td>
                    <td><select name="FormaPago" class="cajasletra" id="FormaPago" style="width: 103px">
                    <option value="<?echo $filas["formapado"];?>"selected><?echo $filas["formapago"];?>
                          <option value="SEMANAL">SEMANAL
                          <option value="DECADAL">DECADAL
                          <option value="CATORCENAL">CATORCENAL
                          <option value="QUINCENAL">QUINCENAL
                          <option value="MENSUAL">MENSUAL
                 </select></td>
                 <td><b>Dirección:</b></td>
                  <td><input type="text" name="Direccion" value="<?echo $filas["direccion"];?>" size="46"  maxlength="20" class="cajas"  onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Direccion"></td>
              </tr>
             <tr>
                    <td><b>F_Nacimiento:&nbsp;</b></td>
                    <td><input type="text" name="FechaNacimiento" value="<?echo $filas["fechanacimiento"];?>" size="15" maxlength="10" class="cajas"  onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="FechaNacimiento">&nbsp;</td>
                    <td><b>Ciudad_Cont.:&nbsp;</b></td>
                    <td><input type="text" name="CiudadContratacion" value="<?echo $filas["municipiocontratacion"];?>" size="46" maxlength="30" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="CiudadContratacion"></td>
              </tr>
              <tr>
                    <td><b>Zona:&nbsp;</b></td>
                    <td colspan="30"><input type="text" name="Zona" value="<?echo $filas["zona"];?>" size="81"  class="cajas"  onfocus="ColorFoco(this.id)" readonly onblur="QuitarFoco(this.id)" id="Zona">&nbsp;</td>
              </tr>
             <tr>
                    <td><b>Contrato:&nbsp;</b></td>
                    <td colspan="30"><input type="text" name="Contrato" value="<?echo $filas["tipo"];?>" size="81"  class="cajas"  onfocus="ColorFoco(this.id)" readonly onblur="QuitarFoco(this.id)" id="Contrato">&nbsp;</td>
              </tr>
              <tr><td><br></td></tr>
              <tr>
                  <td colspan="2">
                    <input type="submit" value="Grabar Dato" class="boton"  id="GrabarFijo" name="GrabarFijo"></td>
                  </tr>
               </table>
            </form>
          <?
}
if($TipoContrato =='FIJO'){
     ?>
      <center><h4><u>Editar Contrato Temporal</u></h4></center>
      <form action="grabardetalle.php" method="post" id="Fijo">
          <input type="hidden" name="TipoContrato" value="<?echo $TipoContrato;?>" size="15" class="cajas">
          <input type="hidden" name="UsuarioPreparador" value="<?echo $UsuarioPreparador;?>" size="15" class="cajas">
          <input type="hidden" name="codigo" value="<?echo $codigo;?>" size="15" class="cajas">
          <table border="0" align="center">
              <tr>
                    <td><b>Nro_Contrato:&nbsp;</b></td>
                    <td><input type="text" name="NroContrato" value="<?echo $nro;?>" size="15" class="cajas" readonly id="NroContrato">&nbsp;</td>
              </tr>
              <tr>
                    <td><b>Documento:&nbsp;</b></td>
                    <td><input type="text" name="Documento" value="<?echo $filas["cedemple"];?>" size="15" class="cajas" maxlength="15" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Documento">&nbsp;</td>
                    <td><b>Empleado:&nbsp;</b></td>
                    <td><input type="text" name="Empleado" value="<?echo $filas["nombres"];?>" size="46" class="cajas" maxlength="50" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Empleado"></td>
              </tr>
              <tr>
              <td><b>Lugar Exped.:</b></td>
              <td colspan="30"><select name="LugarExpedicion"class="cajas" id="LugarExpedicion" style="width: 501px">
                  <?
                    $Aux=$filas["codmuni"];
                    $consulta_c="select codmuni,municipio from municipio order by municipio";
                    $resultado_c=mysql_query($consulta_c) or die("consulta de Costo Incorrecta");
                    while ($filas_c=mysql_fetch_array($resultado_c)){
                            if($Aux==$filas_c["codmuni"]){
                                ?>
                                <option value="<?echo $filas_c["codmuni"];?>" selected><?echo $filas_c["municipio"];?>
                                <?
                            }else{
                                ?>
                                <option value="<?echo $filas_c["codmuni"];?>"><?echo $filas_c["municipio"];?>
                                <?
                            }
                    }
                  ?>
                  </select></td>
              </tr>
              <tr>
                    <td><b>Salario:&nbsp;</b></td>
                    <td><input type="text" name="Salario" value="<?echo $filas["salario"];?>" size="15" maxlength="11" class="cajas"  onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Salario">&nbsp;</td>
                    <td><b>Cargo:&nbsp;</b></td>
                    <td><input type="text" name="Cargo" value="<?echo $filas["cargo"];?>" size="46" maxlength="30" class="cajas" maxlength="50" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Cargo"></td>
              </tr>
               <tr>
                    <td><b>F_Contratación:&nbsp;</b></td>
                    <td><input type="text" name="FechaContratacion" value="<?echo $filas["fechacontratacion"];?>" size="15" maxlength="10" class="cajas"  onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="FechaContratacion">&nbsp;</td>
                    <td><b>Barrio:&nbsp;</b></td>
                    <td><input type="text" name="Barrio" value="<?echo $filas["barrio"];?>" size="46" maxlength="30" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Barrio"></td>
              </tr>
              <tr>
                  <td><b>Forma_Pago:</b></td>
                    <td><select name="FormaPago" class="cajasletra" id="FormaPago" style="width: 103px">
                    <option value="<?echo $filas["formapado"];?>" selected><?echo $filas["formapago"];?>
                          <option value="SEMANAL">SEMANAL
                          <option value="DECADAL">DECADAL
                          <option value="CATORCENAL">CATORCENAL
                          <option value="QUINCENAL">QUINCENAL
                          <option value="MENSUAL">MENSUAL
                 </select></td>
                 <td><b>Dirección:</b></td>
                  <td><input type="text" name="Direccion" value="<?echo $filas["direccion"];?>" size="46"  maxlength="20" class="cajas"  onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Direccion"></td>
              </tr>
             <tr>
                    <td><b>F_Nacimiento:&nbsp;</b></td>
                    <td><input type="text" name="FechaNacimiento" value="<?echo $filas["fechanacimiento"];?>" size="15" maxlength="10" class="cajas"  onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="FechaNacimiento">&nbsp;</td>
                    <td><b>Ciudad_Cont.:&nbsp;</b></td>
                    <td><input type="text" name="CiudadContratacion" value="<?echo $filas["municipiocontratacion"];?>" size="46" maxlength="30" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="CiudadContratacion"></td>
              </tr>
               <tr>
                    <td><b>Dias_Contratacion:&nbsp;</b></td>
                    <td><input type="text" name="NroDias" value="<?echo $filas["nrodias"];?>" size="15" maxlength="11" class="cajas"  onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="NroDias">&nbsp;</td>
              </tr>
              <tr>
                    <td><b>Zona:&nbsp;</b></td>
                    <td colspan="30"><input type="text" name="Zona" value="<?echo $filas["zona"];?>" size="81"  class="cajas"  onfocus="ColorFoco(this.id)" readonly onblur="QuitarFoco(this.id)" id="Zona">&nbsp;</td>
              </tr>
             <tr>
                    <td><b>Contrato:&nbsp;</b></td>
                    <td colspan="30"><input type="text" name="Contrato" value="<?echo $filas["tipo"];?>" size="81"  class="cajas"  onfocus="ColorFoco(this.id)" readonly onblur="QuitarFoco(this.id)" id="Contrato">&nbsp;</td>
              </tr>
              <tr><td><br></td></tr>
              <tr>
                  <td colspan="2">
                    <input type="submit" value="Grabar Dato" class="boton"  id="GrabarFijo" name="GrabarFijo"></td>
                  </tr>
               </table>
            </form>
          <?
}
if($TipoContrato =='LABOR'){
     ?>
      <center><h4><u>Editar Contrato Temporal</u></h4></center>
      <form action="grabardetalle.php" method="post" id="Matriz" name="Matriz">
          <input type="hidden" name="TipoContrato" value="<?echo $TipoContrato;?>" size="15" class="cajas">
          <input type="hidden" name="UsuarioPreparador" value="<?echo $UsuarioPreparador;?>" size="15" class="cajas">
          <input type="hidden" name="codigo" value="<?echo $codigo;?>" size="15" class="cajas">
          <table border="0" align="center">
              <tr>
                    <td><b>Nro_Contrato:&nbsp;</b></td>
                    <td><input type="text" name="NroContrato" value="<?echo $nro;?>" size="15" class="cajas" readonly id="NroContrato">&nbsp;</td>
              </tr>
              <tr>
                    <td><b>Documento:&nbsp;</b></td>
                    <td><input type="text" name="Documento" value="<?echo $filas["cedemple"];?>" size="15" class="cajas" maxlength="15" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Documento">&nbsp;</td>
                    <td><b>Empleado:&nbsp;</b></td>
                    <td><input type="text" name="Empleado" value="<?echo $filas["nombres"];?>" size="50" class="cajas" maxlength="50" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Empleado"></td>
              </tr>
              <tr>
              <td><b>Lugar Exped.:</b></td>
              <td colspan="30"><select name="LugarExpedicion"class="cajas" id="LugarExpedicion" style="width: 474px">
                  <?
                    $Aux=$filas["codmuni"];
                    $consulta_c="select codmuni,municipio from municipio order by municipio";
                    $resultado_c=mysql_query($consulta_c) or die("consulta de Costo Incorrecta");
                    while ($filas_c=mysql_fetch_array($resultado_c)){
                            if($Aux==$filas_c["codmuni"]){
                                ?>
                                <option value="<?echo $filas_c["codmuni"];?>" selected><?echo $filas_c["municipio"];?>
                                <?
                            }else{
                                ?>
                                <option value="<?echo $filas_c["codmuni"];?>"><?echo $filas_c["municipio"];?>
                                <?
                            }
                    }
                  ?>
                  </select></td>
              </tr>
              <tr>
                    <td><b>Salario:&nbsp;</b></td>
                    <td><input type="text" name="Salario" value="<?echo $filas["salario"];?>" size="15" maxlength="11" class="cajas"  onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Salario">&nbsp;</td>
                    <td><b>Cargo:&nbsp;</b></td>
                    <td><input type="text" name="Cargo" value="<?echo $filas["cargo"];?>" size="50" maxlength="30" class="cajas" maxlength="50" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Cargo"></td>
              </tr>
               <tr>
                    <td><b>F_Contratación:&nbsp;</b></td>
                    <td><input type="text" name="FechaContratacion" value="<?echo $filas["fechacontratacion"];?>" size="15" maxlength="10" class="cajas"  onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="FechaContratacion">&nbsp;</td>
                    <td><b>Dia_Pago:&nbsp;</b></td>
                    <td><input type="text" name="DiaPago" value="<?echo $filas["diapago"];?>" size="50" maxlength="30" class="cajas" maxlength="50" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="DiaPago"></td>
              </tr>
              <tr>
                  <td><b>Forma_Pago:</b></td>
                    <td><select name="FormaPago" class="cajasletra" id="FormaPago" style="width: 103px">
                    <option value="<?echo $filas["formapado"];?>" selected><?echo $filas["formapago"];?>
                          <option value="SEMANAL">SEMANAL
                          <option value="DECADAL">DECADAL
                          <option value="CATORCENAL">CATORCENAL
                          <option value="QUINCENAL">QUINCENAL
                          <option value="MENSUAL">MENSUAL
                 </select></td>
                 <td><b>H_Trabajo:</b></td>
                  <td><input type="text" name="HorarioTrabajo" value="<?echo $filas["horariotrabajo"];?>" size="50"  maxlength="20" class="cajas"  onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="HorarioTrabajo"></td>
              </tr>
              <tr>
                    <td><b>Zona:&nbsp;</b></td>
                    <td colspan="30"><input type="text" name="Zona" value="<?echo $filas["zona"];?>" size="83"  class="cajas"  onfocus="ColorFoco(this.id)" readonly onblur="QuitarFoco(this.id)" id="Zona">&nbsp;</td>
              </tr>
              <tr>
                 <td><b>Proceso:&nbsp;</b></td>
                 <td colspan="30"><textarea name="Proceso" cols="83"  rows="4"class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Proceso" ><?echo $filas["proceso"];?></textarea></td>
              </tr>
              <tr><td><br></td></tr>
              <tr>
                  <td colspan="2">
                    <input type="button" value="Grabar Dato" class="boton" onclick="chequearcampos()" id="Grabar" name="Grabar"></td>
                  </tr>
               </table>
            </form>
          <?
}
if($TipoContrato =='ADICCION'){
     ?>
      <center><h4><u>Editar Contrato Temporal</u></h4></center>
      <form action="grabardetalle.php" method="post" id="MatrizAcccion" name="MatrizAccion">
          <input type="hidden" name="TipoContrato" value="<?echo $TipoContrato;?>" size="15" class="cajas">
          <input type="hidden" name="UsuarioPreparador" value="<?echo $UsuarioPreparador;?>" size="15" class="cajas">
          <input type="hidden" name="codigo" value="<?echo $codigo;?>" size="15" class="cajas">
          <table border="0" align="center">
              <tr>
                    <td><b>Nro_Contrato:&nbsp;</b></td>
                    <td><input type="text" name="NroContrato" value="<?echo $nro;?>" size="15" class="cajas" readonly id="NroContrato">&nbsp;</td>
              </tr>
              <tr>
                    <td><b>Documento:&nbsp;</b></td>
                    <td><input type="text" name="Documento" value="<?echo $filas["cedemple"];?>" size="15" class="cajas" readonly maxlength="15" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Documento">&nbsp;</td>
                    <td><b>Empleado:&nbsp;</b></td>
                    <td><input type="text" name="Empleado" value="<?echo $filas["nombres"];?>" size="50" class="cajas" maxlength="50" readonly onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Empleado"></td>
              </tr>
              <tr>
              <tr>
                    <td><b>L_Expedición:&nbsp;</b></td>
                    <td colspan="30"><input type="text" name="" value="<?echo $filas["lugarexpedicion"];?>" size="87"  readonly class="cajas"  onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Salario">&nbsp;</td>
              </tr>
              <tr>
                    <td><b>Salario:&nbsp;</b></td>
                    <td><input type="text" name="Salario" value="<?echo $filas["salario"];?>" size="15" readonly class="cajas"  onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Salario">&nbsp;</td>
                    <td><b>S_No_Presta.:&nbsp;</b></td>
                    <td><input type="text" name="SalarioNoPrestacional" value="<?echo $filas["pagonosalarial"];?>" size="50" maxlength="11" class="cajas" maxlength="50" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="SalarioNoPrestacional"></td>
              </tr>
               <tr>
              <td><b>Concepto:</b></td>
              <td colspan="30"><select name="CodigoConcepto"class="cajas" id="CodigoConcepto" style="width: 474px">
                  <?
                    $AuxC=$filas["codsala"];
                    $consulta_c="select codsala,concepto from conceptonosalarial order by concepto";
                    $resultado_c=mysql_query($consulta_c) or die("consulta de conceptos errdas");
                    while ($filas_c=mysql_fetch_array($resultado_c)){
                            if($AuxC==$filas_c["codsala"]){
                                ?>
                                <option value="<?echo $filas_c["codsala"];?>" selected><?echo $filas_c["concepto"];?>
                                <?
                            }else{
                                ?>
                                <option value="<?echo $filas_c["codsala"];?>"><?echo $filas_c["concepto"];?>
                                <?
                            }
                    }
                  ?>
                  </select></td>
              </tr>

              <tr><td><br></td></tr>
              <tr>
                  <td colspan="2">
                    <input type="submit" value="Grabar Dato" class="boton"  id="Accion" name="Accion"></td>
                  </tr>
               </table>
            </form>
          <?
}
?>
</body>

</html>
