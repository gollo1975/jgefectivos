<html>
<head>
  <title>Control de Usuarios</title>
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
                         if (document.getElementById("cedula").value.length <=0)
                        {
                            alert ("Digite el documento del empleado ?");
                            document.getElementById("cedula").focus();
                            return;
                        }
                         if (document.getElementById("nombre").value.length <=0)
                        {
                            alert ("Digite el Nombre del Empleado ?");
                            document.getElementById("nombre").focus();
                            return;
                        }
                         if (document.getElementById("telefono").value.length <=0)
                        {
                            alert ("Digite El teléfono del empleado ?");
                            document.getElementById("telefono").focus();
                            return;
                        }
                         if (document.getElementById("opcion").value.length <=0)
                        {
                            alert ("Digite la ruta de acceso al sistema ?");
                            document.getElementById("opcion").focus();
                            return;
                        }
                         document.getElementById("matacceso").submit();

                    }
                </script>
</head>
<body>
<?
if (empty($usuario)):
  ?>
   <form action="" method="post" id="matacceso">
   <center><h4>Ingreso de Usuarios al Sistema</h4></center>
     <table boder="0" align="center">
     <tr><td><br></td></tr>
       <tr>
         <td><b>Usuario:</b></td>
           <td colspan="1"><input type="text" name="usuario" value="" class="cajas" size="18" maxlength="15" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="usuario"></td>
       </tr>
       <tr>
         <td><b>Clave:</b></td>
           <td colspan="1"><input type="text" name="clave" value="" class="cajas" size="18" maxlength="15"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="clave"></td>
       </tr>
       <tr>
         <td><b>Cedula:</b></td>
           <td colspan="1"><input type="text" name="cedula" value="" class="cajas"size="15" maxlength="15"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="cedula"></td>
       </tr>
       <tr>
         <td><b>Empleado:</b></td>
           <td colspan="1"><input type="text" name="nombre" value="" class="cajas"size="45" maxlength="45" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="nombre"></td>
       </tr>
        <tr>
         <td><b>Teléfono:</b></td>
           <td colspan="1"><input type="text" name="telefono" value=""class="cajas" size="11" maxlength="11" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="telefono"></td>
       </tr>
        <tr>
         <td><b>Menú:</b></td>
           <td colspan="1"><input type="text" name="opcion" value=""class="cajas" size="30" maxlength="30" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="opcion"></td>
       </tr>
       <tr>
         <td><b>Fecha Proceso:</b></td>
           <td colspan="1"><input type="text" name="fechap" value="<? echo date("Y-m-d");?>"class="cajas" size="11" maxlength="11" readonly onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="opcion"></td>
       </tr>
        <tr>
                                          <td><b>Estado:</b></td>
                                          <td><select name="Estado" class="cajasletra">
                                                <option value="ACTIVO">ACTIVO
                                                <option value="INACTIVO">INACTIVO
                                            </select></td>
                                       </tr>
       <tr><td><br></td></tr>
      <td colspan="2">
           <input type="button" value="Guardar" class="boton" onclick="chequearcampos()">
           <input type="reset" value="Limpiar" class="boton">
         </td>
     </table>
   </form>
  <?
else:
include("../conexion.php");
  $usuario=strtoupper($usuario);
  $clave=strtoupper($clave);
  $nombre=strtoupper($nombre);
  $con="select * from acceso where acceso.usuario='$usuario'";
  $resu=mysql_query($con)or die("Error de busqueda ");
  $reg=mysql_num_rows($resu);
   if($reg==0):
     $consulta="insert into acceso(usuario,clave,cedula,nombre,telusuario,menu,fechap,fechaven,estado)
     values('$usuario','$clave','$cedula','$nombre','$telefono','$opcion','$fechap','$fechap','$Estado')";
     $resultado=mysql_query($consulta)or die("error de grabado");
      ?>
      <script language="javascript">
        alert("Datos Grabados con éxitos ?")
          open("matricula.php","_self");
      </script>
     <?
  else:
    ?>
      <script language="javascript">
        alert("El Usuario Ya existe en Sistema ?")
        history.back(-1)
        open("matricula.php","_self");
      </script>
     <?
  endif;
endif;
?>
</body>
</html>
