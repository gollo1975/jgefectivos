<html>
<head>
<title>Clasificacion de incapacidades</title>
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

                    function chequearcampos()
                    {
                        if (document.getElementById("codigo").value.length <=0)
                        {
                            alert ("El campo C�digo de incapacidad no puede estar vac�o");
                            document.getElementById("codigo").focus();
                            return;
                        }
                        if (document.getElementById("concepto").value.length <=0)
                        {
                            alert ("El campo descripci�n no puede estar vac�o");
                            document.getElementById("concepto").focus();
                            return;
                        }
                        document.getElementById("matincapa").submit();
                    }
</script>
</head>
<body>
<h4><div align="center"><u>Clasificar Incapacidades</u></h4></div>
<?
   if (!isset($codigo)):
?>
 <form action="" method="post" id="matincapa">
 <table border="0" align="center">
 <tr>
    <td colspan="2"><br></td>
 </tr>

 <tr>
   <td><b>C�digo:</b></td>
   <td><input type="text" name="codigo" value="" size="12" maxlength="10" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="codigo"></td>
 </tr>
 <tr>
   <td><b>Descripci�n:</b></td>
   <td><input type="text" name="concepto" value="" size="67" maxlength="60" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="concepto"></td>
 </tr>
 <tr><td><br></td></tr>
 <tr>
   <td colspan="2">
     <input type="button" value="Guardar" class="boton" onclick="chequearcampos()">
     <input type="reset" value="Limpiar" class="boton">
   </td>
  </tr>
   <tr><td><br></td></tr>
  </table>
 </form>
 <?
    else:
    include("../conexion.php");
    $concepto=strtoupper($concepto);
    $codigo=strtoupper($codigo);
    $consulta="select control.codigo from control where codigo='$codigo'";
    $resultado=mysql_query($consulta)or die ("error en la busqueda de consecutivos");
    $registro=mysql_num_rows($resultado);
    if($registro==0):
      $consulta="insert into control(codigo,concepto) values('$codigo','$concepto')";
      $resultado=mysql_query($consulta);
    ?>
    <script language="javascript">
     alert("Este C�digo fue grabado con exito en sistema ?")
     open("agregarmotivo.php","_self");
    </script>
    <?
     else:
     ?>
     <script language="javascript">
       alert("El c�digo de la incapacidades ya existe en la bd. ?")
       history.back()
     </script>
    <?
    endif;
 endif;
 ?>
</body>
</html>
