<html>

<head>
  <title></title>
  <LINK  REL="stylesheet" HREF="../estilo.css" type="text/css">
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
      function Chequear	()
          {
          if (document.getElementById("Nota").value.length <=0)
               {
                            alert ("Digite la descripción del detallado del proceso!");
                            document.getElementById("Nota").focus();
                            return;
              }
             document.getElementById("f3").submit();
          }
 </script>
<?php
if(!isset($Nota)){
   ?>
     <center><h4><u>Editar Detallado</u></h4></center>
        <form action="" method="post" id="f3" name="f3">
        <input type="hidden"  name="Proceso"  value="<?echo $EstadoS;?>">
            <table border="0" align="center"
                 <tr><td><br></td></tr>
                 <tr>
                     <td><b>Id_Relación:</b></td>
                      <td><input type="text"  name="NroR" size="5" value="<?echo $NroR;?>" readonly class="cajas" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="NroR">
                      <td><b>Id_Proceso:</b>
                      <input type="text"  name="NroP" size="5" value="<?echo $NroP;?>" readonly class="cajas" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="NroP"></td>
                 </tr>
                 <tr>
                     <td><b>Descripción:</b></td>
                      <td colspan="15"><p align="justify"><textarea name="Nota" cols="89" rows="15" class="cajas" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="Nota"><?echo $DetalleNota;?></textarea></td>
                    </tr>
                 </tr>

                 <tr><td><br></td></tr>
                 <tr>
                    <td colspan="6">
                    <input type="button" Value="Guardar" class="boton" id ="grabar" onclick="Chequear()" name="grabar"></td>
                 </tr>
            </table>
        </form>
    <?
}else{
     include("../conexion.php");
     $cons="update tipoproceso set descripcion='$Nota' where idpromemo='$NroR'";
     $resul=mysql_query($cons) or die("error al grabar");
      ?>
         <script language="javascript">
             alert("Datos grabados con exito en sistema!")
             open("EditarMaestro.php?EstadoS=<?echo $Concepto;?>","_self");
         </script>
     <?
}
?>
</body>
</html>
