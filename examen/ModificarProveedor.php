<html>
<head>
                <title>Modificar Datos</title>
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
               if (document.getElementById("cedemple").value.length <=0)
           {
                alert ("Digite el Documento del Empleado");
                document.getElementById("cedemple").focus();
                return;
           }
             document.getElementById("imacentro").submit();
        }

</script>
<?
if (!isset($cedemple)):
    ?>
    <center><h4><u>Modificar Examen</u></h4></center>
    <form action="" method="post" id ="imacentro">
    <input type="hidden" name="CodUsuario" value="<?echo $CodUsuario?>" size="15">
          <table border="0" align="center"
          <tr><td><br></td></tr>
          <tr>
          <td><b>Documento de identidad:</b></td>
          <td><input type="text" name="cedemple" value="" size="15" maxlength="15"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="cedemple"></td>
          </tr>
          <tr><td><br></td></tr>
          <tr><td ><input type="button" Value="Buscar" class="boton" onclick="enviar()"></td></tr>
       </table>
   </form>
<?
else:
   include("../conexion.php");
   $con="select examen.* from examen
   where examen.cedula='$cedemple' and control='FALTA'";
   $resu=mysql_query($con)or die ("Error al buscar datos del examen.");
   $reg=mysql_num_rows($resu);
   if($reg!=0):
      ?>
       <center><h4><u>Modificar Examen</u></h4></center>
      <table border="0" align="center"
      <tr class="cajas">
         <th>Reg.</th>
         <th>Nro_Examen</th>
         <th>Empleado</th>
         <th>F_Examen</th>
         <th>Vlr_Examen</th>
      </tr>
      <? $a=1;
      while($filas=mysql_fetch_array($resu)):
        $Nro=$filas["nro"];
         $Valor=number_format($filas["costoe"],0);
         ?>
          <tr class="cajas">
             <th><?echo $a;?></th>
             <td><a href="DetalladoEditadoProvedor.php?Nro=<?echo $filas["nro"];?>&CodUsuario=<?echo $CodUsuario;?>"><div align="center"><?echo $filas["nro"];?></div></a></td>
             <td><?echo $filas["nombre"];?></td>
             <td><?echo $filas["fechap"];?></td>
             <td><div align="center"><?echo $Valor;?></div></td>
          </tr>
         <?$a=$a+1;
      endwhile;
     ?>
     </table>
     <?
   else:
      ?>
       <script language="javascript">
          alert("Este registro no se puede modificar, ya se cerro el proceso contable.!")
          history.back()
       </script>
      <?
   endif;
endif;
?>
</body>
</html>
