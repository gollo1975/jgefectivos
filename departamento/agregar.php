<html>
<head>
<title>Ingreso de departamento</title>
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
                        if (document.getElementById("codepart").value.length <=0)
                        {
                            alert ("El campo Código de Departamento no puede estar vacío");
                            document.getElementById("codepart").focus();
                            return;
                        }
                        if (document.getElementById("departamento").value.length <=0)
                        {
                            alert ("El campo Departamento no puede estar vacío");
                            document.getElementById("departamento").focus();
                            return;
                        }
                        document.getElementById("matdepto").submit();
                    }
</script>
</head>
<body>
<?
   if (!isset($codepart)):
?>
<td><center><u><h4>Matricular Departamentos</h4></u></center></td>
<form action="" method="post" id="matdepto">
 <table border="0" align="center">
 <tr>
    <td colspan="2"><br></td>
 </tr>

 <tr>
   <td><b>Código Departamento:</b></td>
   <td><input type="text" name="codepart" value="" size="10" maxlength="10" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="codepart" class="cajas"></td>
 </tr>
 <tr>
   <td><b>Departamento:</b></td>
   <td><input type="text" name="departamento" value="" size="40" maxlength="40" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="departamento" class="cajas"></td>
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
    $consulta="select * from departamento where codepart='$codepart'";
    $resultado=mysql_query($consulta)or die ("Consulta incorrecta");
    $registro=mysql_num_rows($resultado);
    if($registro==0):
      $departamento=strtoupper("$departamento");
      $consulta="insert into departamento(codepart,departamento) values('$codepart','$departamento')";
      $resultado=mysql_query("$consulta");
    ?>
    <script language="javascript">
     alert("Datos Grabados con exito en sistema?");
     open("agregar.php","_self");
    </script>
    <?
     else:
     ?>
     <script language="javascript">
       alert("El dato ya existe en la bd. ?")
       history.back()
     </script>
    <?
    endif;
endif;
 ?>
</body>
</html>
