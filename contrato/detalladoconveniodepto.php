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
                         if (document.getElementById("cedula").value == 0)
                          {
                            alert ("El campo Documento de identidad, no puede ser Vacío");
                            document.getElementById("cedula").focus();
                            return;
                          }
                        if (document.getElementById("nota").value == 0)
                         {
                            alert ("Digite la descripcion del convenio?");
                            document.getElementById("nota").focus();
                            return;
                         }
                         document.getElementById("matcon").submit();
                     }
   </script>
</head>

<body>
<?php
include("../conexion.php");
$con1="select convenio.* from convenio where nroconvenio='$nro'";
$resu1=mysql_query($con1)or die("Error en la busqueda del convenio");
$reg1=mysql_affected_rows();
while($filas=mysql_fetch_array($resu1)):
          ?>
           <center><h4><u>Contrato Temporal</u></h4></center>
            <form action="grabardetalledepto.php" method="post" id="matcon">
              <table border="0" align="center">
                 <tr><td><br></td></tr>
                 <tr>
                    <td><b>Nro_Convenio:&nbsp;</b></td>
                    <td><input type="text" name="nro" value="<?echo $nro;?>" size="15" class="cajas" readonly>&nbsp;</td>
                 </tr>
                 <tr>
                    <td><b>Documento:&nbsp;</b></td>
                    <td><input type="text" name="cedula" value="<?echo $filas["cedemple"];?>" size="15" class="cajas" maxlength="15" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="cedula">&nbsp;</td>
                 </tr>
                 <tr>
                    <td><b>Empleado:&nbsp;</b></td>
                    <td><input type="text" name="cliente" value="<?echo $filas["nombres"];?>" size="50" class="cajas" maxlength="50" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="cliente"></td>
                 </tr>
                 <tr>
                    <td><b>Tipo_Contrato:&nbsp;</b></td>
                    <td><input type="text" name="tipo" value="<?echo $filas["tipo"];?>" size="75" class="cajas" maxlength="75" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="tipo"></td>
                 </tr>
                 <tr>
                    <td><b>Nota:&nbsp;</b></td>
                    <td><textarea name="nota" cols="90"  rows="25"class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="nota" ><?echo $filas["descripcion"];?></textarea></td>
                 </tr>
                  <tr><td><br></td></tr>
                 <tr>
                  <td colspan="2">
                    <input type="button" value="Grabar Dato" class="boton" onclick="chequearcampos()"></td>
                  </tr>
               </table>
            </form>
          <?
endwhile;
?>
</body>

</html>
