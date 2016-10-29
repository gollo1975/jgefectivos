<html>
        <head>
                <title>Inscripciones</title>
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
                         if (document.getElementById("Nombres").value.length <=0)
                        {
                            alert ("Digite el Nombre del invitado.!");
                            document.getElementById("Nombres").focus();
                            return;
                        }
                         if (document.getElementById("Direccion").value.length <=0)
                        {
                            alert ("Digite la dirección del invitado.!");
                            document.getElementById("Direccion").focus();
                            return;
                        }
                         if (document.getElementById("Telefono").value.length <=0)
                        {
                            alert ("Digite el Nro Teléfonico del invitado.!");
                            document.getElementById("Telefono").focus();
                            return;
                        }
                         if (document.getElementById("Celular").value.length <=0)
                        {
                            alert ("Digite el Nro de celular del invitado.!");
                            document.getElementById("Celular").focus();
                            return;
                        }
                         if (document.getElementById("Empresa").value.length <=0)
                        {
                            alert ("Digite la Empresa de Trabajo del invitado.!");
                            document.getElementById("Empresa").focus();
                            return;
                        }
                         if (document.getElementById("Cargo").value.length <=0)
                        {
                            alert ("Digite elcargo del invitado.!");
                            document.getElementById("Cargo").focus();
                            return;
                        }
                         if (document.getElementById("Email").value.length <=0)
                        {
                            alert ("Digite el email para el envio de la información.!");
                            document.getElementById("Email").focus();
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
      <center><h4><u>INSCRIPCIONES LANZAMIENTO</u></h4></center>
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
      $consulta="select inscripcion.* FROM inscripcion where inscripcion.documento ='$Documento'";
      $resultado=mysql_query($consulta) or die("consulta incorrecta");
      $registros=mysql_num_rows($resultado);
      if ($registros==0){
           $Estado= 0;
             ?>
             <center><h4><u>INSCRIPCIONES LANZAMIENTO</u></h4></center>
              <form action="GrabarInscripcion.php" method="post" id="Datos" name="Datos">
              <input type="hidden" name="Estado" value="<? echo $Estado;?>">
                <table border="0" align="center" width="450">
                  <tr>
                    <td><b>Documento (*):&nbsp;</b></td>
                    <td><input type="text" name="Documento" value="<?echo $Documento;?>" size="15"  class="cajas" readonly onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="Documento"></td>
                  </tr>
                  <tr>
                    <td><b>Invitado (*):&nbsp;</b></td>
                    <td><input type="text" name="Nombres" value="" size="53" maxlength="45" class="cajas" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="Nombres"></td>
                  </tr>
                  <tr>
                    <td><b>Dirección (*):&nbsp;</b></td>
                    <td><input type="text" name="Direccion" value="" size="53" maxlength="45" class="cajas" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="Direccion"></td>
                  </tr>
                   <tr>
                      <td><b>Municipio (*)</b></td>
                       <td colspan="30"><select name="CodMuni" class="cajasletra" id="CodMuni" style="width: 340px">
                           <option value="0">Seleccione el Municipio
                              <?
                              $consulta_z="select codmuni,municipio from municipio  order by municipio";
                              $resultado_z=mysql_query($consulta_z) or die("Error al buscar municipios");
                              while ($filas_z=mysql_fetch_array($resultado_z))
                                 {
                                 ?>
                                <option value="<?echo $filas_z["codmuni"];?>"><?echo $filas_z["municipio"];?>
                                 <?
                              }
                                 ?>
                        </select></td>
                    </tr>
                   <tr>
                      <td><b>Teléfono (*):&nbsp;</b></td>
                      <td><input type="text" name="Telefono" value="" size="15" maxlength="10" class="cajas" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="Telefono"></td>
                   </tr>
                   <tr>
                      <td><b>Celular (*):&nbsp;</b></td>
                      <td><input type="text" name="Celular" value="" size="15" maxlength="10" class="cajas" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="Celular"></td>
                   </tr>
                    <tr>
                    <td><b>Empresa (*):&nbsp;</b></td>
                    <td><input type="text" name="Empresa" value="" size="53" maxlength="45" class="cajas" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="Empresa"></td>
                  </tr>
                   <tr>
                    <td><b>Cargo (*):&nbsp;</b></td>
                    <td><input type="text" name="Cargo" value="" size="53" maxlength="45" class="cajas" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="Cargo"></td>
                  </tr>
                  <tr>
                    <td><b>Email (*):&nbsp;</b></td>
                    <td><input type="text" name="Email" value="" size="53" maxlength="45" class="cajas" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="Email"></td>
                  </tr>
                   <tr>
                    <td><b>Lugar:&nbsp;</b></td>
                    <td><input type="text" name="Lugar" value="" size="53" maxlength="53" class="cajas" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="Lugar"></td>
                  </tr>
                  <tr>
                      <td><b>Empresa (*):</b></td>
                       <td colspan="30"><select name="CodEmpresa" class="cajasletra" id="CodEmpresa" style="width: 340px">
                              <?
                              $con="select codmaestro,nomaestro from maestro  order by nomaestro";
                              $res=mysql_query($con) or die("Error al buscar Empresa");
                              while ($fila=mysql_fetch_array($res))
                                 {
                                 ?>
                                <option value="<?echo $fila["codmaestro"];?>"><?echo $fila["nomaestro"];?>
                                 <?
                              }
                                 ?>
                        </select></td>
                    </tr>
                     <tr><td><br></td></tr>
                  <tr class="cajas"><td colspan="10">Todos los campos con (*) son obligatorios</td></tr>
                   <tr><td><br></td></tr>
                  <tr>
                    <td colspan="9"><input name="Enviar" type="button" class="boton" value="Guardar" Onclick="ValidarDato()" id="Enviar">
                      &nbsp;
                      <input name="reset" type="reset" class="boton" value="Limpiar"></td>
                  </tr>
                </table>
              </form>
              <?
               $SqlBuscar="select inscripcion.*,municipio.municipio FROM municipio,inscripcion where
                        inscripcion.codmuni=municipio.codmuni order by nombres DESC";
	       $ArBuscar=mysql_query($SqlBuscar) or die("Error al buscar invitados");
               ?>
              <table border="0" align="center" >
                <tr class="cajas">
                    <th>#</th>
                    <th>Documento</th>
                    <th>Invitado</th>
                    <th>Empresa</th>
                    <th>Cargo</th>
                    <th>Teléfono</th>
                    <th>Celular</th>
                    <th>Email</th>
                    <th>Municipio</th>
                </tr>
                <?
                $a=1;
                while($Rg=mysql_fetch_array($ArBuscar)){
                   ?>
                   <tr class="cajas">
                     <th><?echo $a;?></th>
                     <td><?echo $Rg["documento"];?></td>
                     <td><?echo $Rg["nombres"];?></td>
                     <td><?echo $Rg["empresa"];?></td>
                     <td><?echo $Rg["cargo"];?></td>
                     <td><?echo $Rg["telefono"];?></td>
					   <td><?echo $Rg["celular"];?></td>
                     <td><?echo $Rg["email"];?></td>
                     <td><?echo $Rg["municipio"];?></td>
                   </tr>
                   <?
				   $a =$a + 1;
                }
                ?>
             </table>
            <?
            }else{
	          include("../conexion.php");
		  $Sql="select inscripcion.*,municipio.municipio FROM municipio,inscripcion where
                        inscripcion.codmuni=municipio.codmuni and
                      inscripcion.documento ='$Documento'";
		  $Ar=mysql_query($Sql) or die("Error al buscar invitados");
		  $fila=mysql_fetch_array($Ar);
                  $a=1;
                  ?>
                   <center><h4><u>INSCRIPCIONES LANZAMIENTO</u></h4></center>
                    <table border="0" align="center" >
                       <tr class="cajas">
                           <th>#</th>
                           <th>Documento</th>
                           <th>Nombres</th>
                           <th>Dirección</th>
                           <th>Telefono</th>
                           <th>Celular</th>
                           <th>Municipio</th>
                           <th>Empresa</th>
                           <th>Cargo</th>
                           <th>Email</th>
                       </tr>
                       <tr class="cajas">
                           <th><?echo $a;?></th>
                           <td><a href="DetalleI.php?Documento=<?echo $fila["documento"];?>&Estado=1"><?echo $fila["documento"];?></a></th>
                           <td><?echo $fila["nombres"];?></th>
                           <td><?echo $fila["direccion"];?></th>
                           <td><?echo $fila["telefono"];?></th>
                           <td><?echo $fila["celular"];?></th>
                           <td><?echo $fila["municipio"];?></th>
                           <td><?echo $fila["empresa"];?></th>
                           <td><?echo $fila["cargo"];?></th>
                           <td><?echo $fila["email"];?></th>
                       </tr>
                    </table>
                   <div align="center"><a href="AgregarInscripcion.php"><img src="../image/regresar.png" border="0" alt="Regresar al formulario"></div>
                  <?

           }

}
?>
        </body>
</html>

