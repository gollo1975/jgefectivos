<html>
<head>
<title> Datos a Modificar</title>
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
                        if (document.getElementById("usuario").value.length <=0)
                        {
                            alert ("Digite el usuario del sistema");
                            document.getElementById("usuario").focus();
                            return;
                        }
                        if (document.getElementById("clave").value.length <=0)
                        {
                            alert ("Digite la clave para el acceso  al sistema ?");
                            document.getElementById("clave").focus();
                            return;
                        }
                         document.getElementById("matmodi").submit();

                    }
                </script>
</head>
<body>

<?
     include("../conexion.php");
     $consulta="select acceso.* from acceso where usuario='$usuario'";
     $resultado=mysql_query($consulta)or die("Consulta incorrecta");
     $registros=mysql_num_rows($resultado);
       while($filas=mysql_fetch_array($resultado)):
?>
      <center><h4>Datos a Modificar</h4></center>
      <form action="guardar.php" method="post" id="matmodi">
        <table border="0" align="center">
           <tr>
            <td><b>Usuario:</b></td>
            <td><input type="text" name="usuario" value="<?echo $filas["usuario"];?>"readonly class="cajas"></td>
            </tr>
             <tr>
                   <td><b>Clave:</b></td>
                   <td><input type="text" name="clave" value="<?echo $filas["clave"];?>" size="15" maxlength="15" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="clave"></td>
                 </tr>
                 <tr>
                   <td><b>Documento:</b></td>
                   <td><input type="text" name="cedula" value="<?echo $filas["cedula"];?>" size="15" maxlength="15" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="cedula"></td>
                 </tr>
                 <tr>
                   <td><b>Nombre:</b></td>
                   <td><input type="text" name="nombre" value="<?echo $filas["nombre"];?>" size="40" maxlength="40" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="nombre"></td>
                 </tr>
                 <tr>
                   <td><b>Teléfono:</b></td>
                   <td><input type="text" name="telefono" value="<?echo $filas["telusuario"];?>" size="10" maxlength="7" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="telefono"></td>
                 </tr>
                 <tr>
                   <td><b>Menu:</b></td>
                   <td><input type="text" name="menup" value="<?echo $filas["menu"];?>" size="40" maxlength="40" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="menup"></td>
                 </tr>
                 <tr>
                   <td><b>F_Vcto</b></td>
                   <td><input type="text" name="fvcto" value="<?echo $filas["fechaven"];?>" size="15" maxlength="10" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="fvcto"></td>
                 </tr>
                  <tr>
                   <td><b>F_Digital</b></td>
                   <td><input type="text" name="firma" value="<?echo $filas["firmadigital"];?>" size="40" maxlength="40" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="firma"></td>
                 </tr>
                 <tr>
                   <td><b>F_Ingreso:</b></td>
                   <td><input type="text" name="ingreso" value="<?echo $filas["fechaingreso"];?>" size="15" maxlength="10" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="ingreso"></td>
                 </tr>
                 <tr>
                   <td><b>H_Ingreso:</b></td>
                   <td><input type="text" name="hora" value="<?echo $filas["horaingreso"];?>" size="15" maxlength="14" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="hora"></td>
                 </tr>
                 <tr>
                 <td><b>Estado:</b></td>
                 <td><select name="Estado" class="cajasletra">
                 <option value="<?echo $filas["estado"];?>" selected><?echo $filas["estado"];?>
                 <option value="ACTIVO">ACTIVO
                  <option value="INACTIVO">INACTIVO 
                 </select></td>
                 </tr>
                <tr><td><br></td></tr>
                <tr>
                  <td colspan="5">
                   <input type="submit" value="Grabar" class="boton" onclick="chequearcampos()"></td>
                </tr>
                </tr>

 <?
     endwhile;
 ?>
 </table>
 
 </form>
</body>
</html>
