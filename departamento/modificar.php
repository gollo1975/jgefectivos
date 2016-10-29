<html>
<head>
<title>Modificacion de Departamentos</title>
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
                            alert ("Digite el Código del departamento para la busqueda?");
                            document.getElementById("codepart").focus();
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
    <center><h4><u>Modificar Datos</u></h4></center>
  <form action="" method="post" id="matdepto">
  <table border="0" align="center">
  <tr>
    <td colspan="2"><br></td>
  </tr>
  <tr>
    <td><b>Digite el Código:</b></td>
    <td><input type="text" name="codepart" value="" size="13" maxlength="10" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="codepart" class="cajas"></td>
  </tr>
   <tr><td><br></td></tr>
   <tr>
    <td colspan="2">
      <input type="button" value="Buscar" class="boton" onclick="chequearcampos()">
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
     $filas=mysql_fetch_array($resultado);
     if ($registro==0):
     ?>
       <script language="javascript">
        alert("El dato no existe en la base de dato ?")
        history.back()
       </script>
     <?
     else:
       ?>
       <center><h4><u>Datos a Modificar</u></h4></center>
       <form action="guardar.php" method="post">
       <table border="0" align="center">
       <tr><td><br></td></tr>
       <tr>
         <td><b>Código Departamento:</b></td>
         <td><input type="text" name="codepart" value="<?echo $filas["codepart"];?>" size="10"readonly onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="codepart" class="cajas"></td>
       </tr>
       <tr>
         <td><b>Departamento:</b></td>
         <td><input type="text" name="departamento" value="<?echo $filas["departamento"];?>"
         size="40" maxlength="40" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="departamento" ></td>
       </tr>
       <tr><td><br></td></tr>
       <tr>
         <td colspan="2">
           <input type="submit" value="Guardar" class="boton">
         </td>
       </tr>
      </form>
      </table>
      <?
    endif;
  endif;
  ?>
</body>
</html>
