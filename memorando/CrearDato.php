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
          if (document.getElementById("Concepto").value.length <=0)
               {
                            alert ("Digite la descripción del proceso!");
                            document.getElementById("Concepto").focus();
                            return;
              }
             document.getElementById("f2").submit();
          }
 </script>
<?php
if(!isset($Concepto)){
   ?>
     <center><h4><u>Ingreso de Procesos</u></h4></center>
        <form action="" method="post" id="f2" name="f2">
            <table border="0" align="center"
                 <tr><td><br></td></tr>
                 <tr>
                     <td><b>Descripción:</b></td>
                      <td><input type="text"  name="Concepto" size="40" class="cajas" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="Concepto"></td>
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
     $Concepto=strtoupper($Concepto);
     $cons="insert into tipoprocesomemo(concepto)
          values('$Concepto')";
     $resul=mysql_query($cons) or die("error al grabar");
      ?>
         <script language="javascript">
             alert("Datos grabados con exito en sistema!")
             open("MaestroMemo.php","_self");
         </script>
     <?
}
?>
</body>
</html>
