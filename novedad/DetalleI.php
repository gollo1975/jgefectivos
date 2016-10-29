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
                            alert ("Digite el Email para el envio de la información.!");
                            document.getElementById("Email").focus();
                            return;
                        }
                        document.getElementById("Datos").submit();
                    }
                 </script>
</head>
<body>
<?
include("../conexion.php");
$Sql="select inscripcion.* FROM inscripcion where inscripcion.documento ='$Documento'";
$Resu=mysql_query($Sql) or die("consulta incorrecta");
$Registro=mysql_fetch_array($Resu);
?>
<center><h4><u>EDITAR INSCRIPCION</u></h4></center>
<form action="GrabarInscripcion.php" method="post" id="Datos" name="Datos">
<input type="hidden" name="Estado" value="<? echo $Estado;?>"> 
    <table border="0" align="center" width="340">
         <tr>
             <td><b>Documento:&nbsp;</b></td>
             <td><input type="text" name="Documento" value="<?echo $Documento;?>" size="15"  class="cajas" readonly onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="Documento"></td>
         </tr>
         <tr>
              <td><b>Invitado:&nbsp;</b></td>
              <td><input type="text" name="Nombres" value="<? echo $Registro["nombres"];?>" size="53" maxlength="45" class="cajas" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="Nombres"></td>
         </tr>
         <tr>
              <td><b>Dirección:&nbsp;</b></td>
              <td><input type="text" name="Direccion" value="<? echo $Registro["direccion"];?>" size="53" maxlength="50" class="cajas" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="Direccion"></td>
         </tr>
        <tr>
              <td><b>Municipio:</b></td>
              <td colspan="30"><select name="CodMuni"class="cajas" id="CodMuni" style="width: 340px">
                    <?
                    $aux=$Registro["codmuni"];
                    $consulta_c="select codmuni,municipio from municipio order by municipio";
                    $resultado_c=mysql_query($consulta_c) or die("consulta de Costo Incorrecta");
                    while ($filas_c=mysql_fetch_array($resultado_c)){
                          if($aux==$filas_c["codmuni"]){
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
                    </select>
             </td>
        </tr>
        <tr>
                      <td><b>Teléfono:&nbsp;</b></td>
                      <td><input type="text" name="Telefono" value="<? echo $Registro["telefono"];?>" size="15" maxlength="10" class="cajas" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="Telefono"></td>
         </tr>
         <tr>
                      <td><b>Celular:&nbsp;</b></td>
                      <td><input type="text" name="Celular" value="<? echo $Registro["celular"];?>" size="15" maxlength="10" class="cajas" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="Celular"></td>
         </tr>
                    <tr>
                    <td><b>Empresa:&nbsp;</b></td>
                    <td><input type="text" name="Empresa" value="<? echo $Registro["empresa"];?>" size="53" maxlength="50" class="cajas" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="Empresa"></td>
         </tr>
         <tr>
                    <td><b>Cargo:&nbsp;</b></td>
                    <td><input type="text" name="Cargo" value="<? echo $Registro["cargo"];?>" size="53" maxlength="50" class="cajas" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="Cargo"></td>
         </tr>
          <tr>
                    <td><b>Email:&nbsp;</b></td>
                    <td><input type="text" name="Email" value="<? echo $Registro["email"];?>" size="53" maxlength="50" class="cajas" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="Email"></td>
         </tr>
          <tr>
                    <td><b>Lugar:&nbsp;</b></td>
                    <td><input type="text" name="Lugar" value="<? echo $Registro["lugar"];?>" size="53" maxlength="53" class="cajas" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="Lugar"></td>
         </tr>
         <tr><td><br></td></tr>
         <tr>
                    <td colspan="9"><input name="Enviar" type="button" class="boton" value="Guardar" Onclick="ValidarDato()" id="Enviar">
                      &nbsp;
                      <input name="reset" type="reset" class="boton" value="Limpiar"></td>
         </tr>
    </table>
    <div align="center"><a href="AgregarInscripcion.php"><img src="../image/regresar.png" border="0" alt="Regresar al formulario"></div>
</form>
</body>
</html>

