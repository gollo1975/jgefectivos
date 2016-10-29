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
                            alert ("Digite la descripción del proceso!");
                            document.getElementById("Nota").focus();
                            return;
              }
             document.getElementById("f2").submit();
          }
 </script>
<?php
if(!isset($Nota)){
   ?>
     <center><h4><u>Ingreso de Procesos</u></h4></center>
        <form action="" method="post" id="f2" name="f2">
        <input type="hidden"  name="EstadoS"  value="<?echo $EstadoS;?>">
            <table border="0" align="center"
                 <tr><td><br></td></tr>
                 <tr>
                     <td><b>Id_Proc.:</b></td>
                      <td><input type="text"  name="NroP" size="3" value="<?echo $NroP;?>" readonly class="cajas" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="NroP"></td>
                    </tr>
                 <tr>
                     <td><b>Descripción:</b></td>
                      <td><input type="text"  name="Nota" value="<?echo $Concepto;?>" size="45 maxlength="45" class="cajas" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="Nota"></td>
                    </tr>
                 </tr>
                 <TR>
                 <td><b>Estado:</b></td>
		 <td><select name="Tipo" class="cajasletra">
		     <option value="<?echo $EstadoP;?>" selected><?echo $EstadoP;?>
			 <option value="ACTIVO">ACTIVO
			 <option value="INACTIVO">INACTIVO
		     </select></td>
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
     $Nota=strtoupper($Nota);
     $cons="update tipoprocesomemo set concepto='$Nota', estado='$Tipo' where idproceso='$NroP'";
     $resul=mysql_query($cons) or die("error al grabar");
      ?>
         <script language="javascript">
             alert("Datos grabados con exito en sistema!")
             open("EditarMaestro.php?EstadoS=<?echo $EstadoS;?>","_self");
         </script>
     <?
}
?>
</body>
</html>
