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
                       if (document.getElementById("tipocarta").value == 0)
                         {
                            alert ("Digite el tipo de carta de instrucción?");
                            document.getElementById("tipocarta").focus();
                            return;
                         }
                        if (document.getElementById("nota").value == 0)
                         {
                            alert ("Digite la descripcion de la carta?");
                            document.getElementById("nota").focus();
                            return;
                         }
                         document.getElementById("matcon").submit();
                     }
   </script>
</head>

<body>
<?
include("../conexion.php");
$con1="select cartainstruccion.* from cartainstruccion where nrocarta='$nrocarta'";
$resu1=mysql_query($con1)or die("Error en la busqueda del convenio");
$reg1=mysql_affected_rows();
while($filas=mysql_fetch_array($resu1)):
          ?>
           <center><h4><u>Carta de Instrucción</u></h4></center>
            <form action="grabardetallecarta.php" method="post" id="matcon">
              <table border="0" align="center">
                 <tr><td><br></td></tr>
                 <tr>
                    <td><b>Nro_Carta:&nbsp;</b></td>
                    <td><input type="text" name="nrocarta" value="<?echo $nrocarta;?>" size="8" class="cajas" readonly>&nbsp;</td>
                 </tr>
                 <tr>
                    <td><b>Nro_Convenio:&nbsp;</b></td>
                    <td><input type="text" name="nroconvenio" value="<?echo $filas["nroconvenio"];?>" size="8" class="cajas" maxlength="8"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="nroconvenio">&nbsp;</td>
                 </tr>
                 <tr>
                    <td><b>Documento:&nbsp;</b></td>
                    <td><input type="text" name="cedula" value="<?echo $filas["cedemple"];?>" size="15" class="cajas" readonly>&nbsp;</td>
                 </tr>
                 <tr>
                    <td><b>Cliente:&nbsp;</b></td>
                    <td><input type="text" name="cliente" value="<?echo $filas["asociado"];?>" size="50" class="cajas" readonly></td>
                 </tr>
                 <tr>
                    <td><b>Tipo_Convenio:&nbsp;</b></td>
                    <td><input type="text" name="tipocon" value="<?echo $filas["tipocon"];?>" size="50" class="cajas"readonly></td>
                 </tr>
                 <tr>
                    <td><b>Tipo_Carta:&nbsp;</b></td>
                    <td><input type="text" name="tipocarta" value="<?echo $filas["tipocarta"];?>" size="50" class="cajas" maxlength="50" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="tipocarta"></td>
                 </tr>
                 <tr>
                    <td><b>Nota:&nbsp;</b></td>
                    <td><textarea name="nota" cols="90"  rows="25"class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="nota" ><?echo $filas["nota"];?></textarea></td>
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
