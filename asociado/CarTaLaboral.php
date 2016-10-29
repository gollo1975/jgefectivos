<html>
<head>
                <title>Carta Laboral</title>
                <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
        </head>
        <body>
        <script language="javascript">
 function ColorFoco(obj)
                    {
                        document.getElementById(obj).style.background="#9DFF9D"

                    }

                    function QuitarFoco(obj)
                    {
                        document.getElementById(obj).style.background="white"
                    }
         function enviar()
        {
               if (document.getElementById("cedula").value.length <=0)
           {
                alert ("Digite el Documento del Empleado");
                document.getElementById("cedula").focus();
                return;
           }
             document.getElementById("imacentro").submit();
        }

</script>
<?
if (!isset($cedula)):
    ?>
    <center><h4><u>Carta Laboral</u></h4></center>
    <form action="" method="post" id ="imacentro">
          <table border="0" align="center"
          <tr><td><br></td></tr>
          <tr>
          <td><b>Documento de identidad:</b></td>
          <td><input type="text" name="cedula" value="" size="15" maxlength="15"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="cedula"></td>
          </tr>
          <tr><td><br></td></tr>
          <tr><td ><input type="button" Value="Buscar" class="boton" onclick="enviar()"></td></tr>
       </table>
   </form>
<?
else:
   include("../conexion.php");
   $con="select concat(nomemple, ' ' ,nomemple1, ' ' ,apemple, ' ' ,apemple1) as Trabajador,empleado.cedemple from empleado,zona,contrato
   where zona.codzona=empleado.codzona and
         empleado.codemple=contrato.codemple and
         contrato.fechater='0000-00-00' and
         empleado.cedemple='$cedula' and
         zona.codzona='$codigo'";
   $resu=mysql_query($con)or die ("Error al buscar empleados");
   $reg=mysql_num_rows($resu);
   $filas=mysql_fetch_array($resu);
   $fechaP=date("Y-m-d");
	   if($reg!=0):
      ?>
       <center><h4><u>Carta Laboral</u></h4></center>
      <table border="0" align="center">
           <tr class="cajas">
             <td>Presiones Click sobre el Documento de Identidad para procesar el Registro.</td>
           </tr>
         </table>
       <table border="0" align="center"
      <tr class="cajas">
         <th>Documento</th>
         <th>Empleado</th>
         <th>F_Proceso</th>
      </tr>
      <tr class="cajas">
             <td><a href="CartaLineaZona.php?xcodigo=<?echo $filas["cedemple"];?>&codigo=<?echo $codigo;?>"><div align="center"><?echo $filas["cedemple"];?></div></a></td>
             <td><?echo $filas["Trabajador"];?></td>
             <td><?echo $fechaP;?></td>
          </tr>
     </table>
     <?
   else:
     ?>
       <script language="javascript">
          alert("Este documento no existe o no esta autorizado para ver cartas Laborales.")
          history.back()
       </script>
     <?
   endif;
endif;
?>
</body>
</html>
