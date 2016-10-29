<html>
<head>
<title> Datos a Modificar</title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
   <script language="javascript">
                    function ColorFoco(obj)	{
					
                        document.getElementById(obj).style.background="#9DFF9D"
                    }

                    function QuitarFoco(obj)	{
					
                        document.getElementById(obj).style.background="white"
                    }
                    
					function chequearcampos()	{
					
                        if (document.getElementById("usuario").value.length <=0)	{
						
                            alert ("Digite el usuario del sistema");
                            document.getElementById("usuario").focus();
                            return;
                        }
						
                        	document.getElementById("matmo").submit();
		}
                </script>
</head>
<body>
<?
if (!isset($usuario)):
?>
   <center><h4>Busqueda de Usuarios</h4></center>
    <form action="" method="post" id="matmo">
        <table border="0" align="center">
        <tr><td><br></td></tr>
          <tr>
            <td><b>Digite el Usuario:</b></td>
            <td><input type="text" name="usuario" value="" class="cajas" size="15" maxlength="15" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="usuario"></td>
            </tr>
            <tr><td><br></td></tr>
            <tr>
              <td colspan="5">
              <input type="button" value="Buscar" class="boton" onClick="chequearcampos()"></td>
            </tr>
        </table>
     </form>
     <?
 else:
     include("../conexion.php");
     $consulta="select acceso.* from acceso where usuario='$usuario'";
     $resultado=mysql_query($consulta)or die("Consulta incorrecta ");
     $registros=mysql_num_rows($resultado);
     if ($registros!= 0):
       while($filas=mysql_fetch_array($resultado)):
      ?>
      <center><h4>Datos a Modificar</h4></center>
      <form action="grabar.php" method="post" >
        <table border="0" align="center">
           <tr>
            <td><b>Usuario:</b></td>
            <td><input type="text" name="usuario" value="<?echo $filas["usuario"];?>" size="15"readonly class="cajas"></td>
            </tr>
             <tr>
                   <td><b>Clave Actual:</b></td>
                   <td><input type="text" name="actual" value="" size="15" maxlength="15" class="cajas" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="actual"></td>
                 </tr>
                 <tr>
                   <td><b>Nueva Clave:</b></td>
                   <td><input type="text" name="nueva" value="" size="15" maxlength="15" class="cajas" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="nueva"></td>
                 </tr>
                 <tr>
                   <td><b>Confirmar Clave:</b></td>
                   <td><input type="text" name="confirmar" value="" size="15" maxlength="15" class="cajas" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="confirmar"></td>
                 </tr>
                 <tr><td><br></td></tr>
                <tr>
                  <td colspan="5">
                   <input type="submit" value="Grabar" class="boton" onClick="chequearcampos()"></td>
                </tr>
                </tr>

 <?
     endwhile;
 else:
   ?>
    <script language="javascript">
      alert("El Usuario no existe en Sistema ?")
      open("cambiar.php","_self")
    </script>
   <?
 endif;
endif;
 ?>
 </table>
 
 </form>
</body>
</html>
