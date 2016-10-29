<html>

<head>
  <title>Descargar Incapacidad</title>
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
                       if (document.getElementById("nota").value.length <=0)
                        {
                            alert ("Digite la observación de la incapacidad");
                            document.getElementById("nota").focus();
                            return;
                        }
                         document.getElementById("matdescarga").submit();
                    }
                </script>
</head>

<body>
<?
include("../conexion.php");
$cons="select incapacidad.nroinca,incapacidad.cedemple from incapacidad
where incapacidad.nroinca='$nro'";
$resu=mysql_query($cons)or die ("Error de Consulta $cons");
$reg=mysql_num_rows($resu);
while($filas=mysql_fetch_array($resu)):
  ?>
   <center><h4><u>Seguimiento de Incapacidad</u></h4></center>
          <form action="grabarsegui.php" method="post" width="200" id="matdescarga">
           <td><input type="hidden" name="nombre" value="<? echo $nombre;?>"</td>
           <table border="0" align="center">
           <tr><td><br></td></tr> 
            <tr>
                <td><b>Nro_Incapacidad:</b></td>
               <td><input type="text" name="numero" value="<? echo $nro;?>"class="cajas" size="13" readonly></td>
             </tr>
             <tr>
                <td><b>Documento:</b></td>
               <td><input type="text" name="cedula" value="<? echo $filas["cedemple"];?>"class="cajas" size="13" readonly></td>
             </tr>
             <tr>
                <td><b>Empleado:</b></td>
               <td colspan="20"><input type="text" name="nombre" value="<? echo $nombre;?>" class="cajas"size="48" readonly></td>
             </tr>
             <tr>
              <td><b>Observación:</b></td>
               <td colspan="5"><textarea  name="nota" cols="59" rows="8" class="cajas"  onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="nota"></textarea></td>
              </tr>
             <tr><td><br></td></tr>
             <tr>
               <td colspan="5">
                  <input type="button" value="Guardar Dato" class="boton" onclick="chequearcampos()"></td>
             </tr>
           </table>
         </form>
         <?
endwhile;
?>
</body>
</html>
