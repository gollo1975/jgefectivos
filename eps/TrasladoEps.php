<html>
        <head>
                <title>Traslado a otra Eps</title>
                 <LINK HREF="../estilo.css" REL="stylesheet"  type="text/css">
                 <script language="javascript">
                     function ColorFoco(obj)
                     {
                        document.getElementById(obj).style.background="#9DFF9D"

                     }
                     function QuitarFoco(obj)
                     {
                        document.getElementById(obj).style.background="white"
                     }
                      function Validar()
                        {
                        if (document.getElementById("Documento").value.length <=0)
                        {
                            alert ("Digite el Documento del invitado.!");
                            document.getElementById("Documento").focus();
                            return;
                        }
                        document.getElementById("MatInvitado").submit();
                      }
                      function ValidarDato(){
                         if (document.getElementById("Desde").value.length <=0)
                        {
                            alert ("Digite la fecha del inicio del traslado.!");
                            document.getElementById("Desde").focus();
                            return;
                        }
                        document.getElementById("Datos").submit();
                    }
                 </script>
</head>
<body>
<?
if (!isset($Documento)){
     ?>
      <center><h4><u>TRASLADO DE EPS</u></h4></center>
      <form action="" method="post" name="MatInvitado" id="MatInvitado">
           <table border="0" align="center">
                             <tr><td><br></td></tr>
             <tr>
                   <td><b>Documento de Identidad:&nbsp;<b></td>
                   <td><input type="text" name="Documento" value="" size="15" maxlength="15" class="cajas" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="Documento"></td>
             </tr>
            <tr><td><br></td></tr>
            <tr>
              <td colspan="9"><input type="button" Value="Buscar Dato" class="boton" Onclick="Validar()"></td>
            </tr>
         </table>
     </form>
<?
}else{
      include("../conexion.php");
      $consulta="select empleado.codemple,empleado.cedemple,CONCAT(nomemple, ' ', nomemple1, ' ', apemple, ' ', apemple1) as Empleado ,empleado.codeps,eps.eps FROM empleado,contrato,eps where
              empleado.codemple=contrato.codemple and
              contrato.fechater='0000-00-00' and
              empleado.codeps=eps.codeps and
              empleado.cedemple='$Documento'";
      $resultado=mysql_query($consulta) or die("Error al buscar el empleado");
      $registros=mysql_num_rows($resultado);
      $filas=mysql_fetch_array($resultado);
      if ($registros != 0){
             ?>
             <center><h4><u>TRASLADO DE EPS</u></h4></center>
              <form action="GrabarTraslado.php" method="post" id="Datos" name="Datos">
                <table border="0" align="center" width="450">
                <tr>
                    <td><b>Cod_Empleado:&nbsp;</b></td>
                    <td><input type="text" name="CodEmple" value="<?echo $filas["codemple"];?>" size="12"  class="cajas" readonly onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="CodEmple"></td>
                  </tr>
                  <tr>
                    <td><b>Documento:&nbsp;</b></td>
                    <td><input type="text" name="Documento" value="<?echo $Documento;?>" size="12"  class="cajas" readonly onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="Documento"></td>
                  </tr>
                  <tr>
                    <td><b>Empleado:&nbsp;</b></td>
                    <td><input type="text" name="Empleado" value="<?echo $filas["Empleado"];?>" size="53" readonly class="cajas" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="Empleado"></td>
                  </tr>
                  <tr>
                    <td><b>Cod_Eps:&nbsp;</b></td>
                    <td><input type="text" name="CodEpsActual" value="<?echo $filas["codeps"];?>" size="12" readonly class="cajas" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="CodEpsActual"><?echo $filas["eps"];?></td>
                  </tr>

                   <tr>
                      <td><b>Nueva_Eps</b></td>
                       <td colspan="30"><select name="CodEpNueva" class="cajasletra" id="CodEpNueva" style="width: 340px">
                           <option value="0">seleccione la nueva Eps
                              <?
                              $consulta_z="select codeps,eps from eps  order by eps";
                              $resultado_z=mysql_query($consulta_z) or die("Error al buscar eps");
                              while ($filas_z=mysql_fetch_array($resultado_z))
                                 {
                                 ?>
                                <option value="<?echo $filas_z["codeps"];?>"><?echo $filas_z["eps"];?>
                                 <?
                              }
                                 ?>
                        </select></td>
                    </tr>
                   <tr>
                      <td><b>Traslado_Desde:&nbsp;</b></td>
                      <td><input type="text" name="Desde" value="<?echo date('Y-m-d');?>" size="12" maxlength="10" class="cajas" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="Desde"></td>
                   </tr>
				   <tr>
                      <td><b>Fecha_Aplicacion:&nbsp;</b></td>
                      <td><input type="text" name="FechaAplicacion" value="<?echo date('Y-m-d');?>" size="12" maxlength="10" class="cajas" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="FechaAplicacion"></td>
                   </tr>
                   <tr><td><br></td></tr>
                  <tr>
                    <td colspan="9"><input name="Enviar" type="button" class="boton" value="Guardar" Onclick="ValidarDato()" id="Enviar">
                      &nbsp;
                      <input name="reset" type="reset" class="boton" value="Limpiar"></td>
                  </tr>
                </table>
              </form>
            <?
           }else{
              ?>
               <script language="javascript">
                   alert("El Nro de documento digitado no se en cuentra en Sistema.!")
                   history.back()
               </script>
              <?
           }

}
?>
        </body>
</html>

