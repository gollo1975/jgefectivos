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
include("../conexion.php");
  ?>
   <form action="" method="post" id="matacceso">
   <center><h4>Matricula de Usuario a Zonas</h4></center>
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
           <td colspan="1"><input type="text" name="cedula" value="" class="cajas"size="18" maxlength="15"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="cedula"></td>
       </tr>
       <tr>
         <td><b>Contacto:</b></td>
           <td colspan="1"><input type="text" name="nombre" value="" class="cajas"size="55" maxlength="45" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="nombre"></td>
       </tr>
        <tr>
         <td><b>Teléfono:</b></td>
           <td colspan="1"><input type="text" name="telefono" value=""class="cajas" size="11" maxlength="11" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="telefono"></td>
       </tr>
        <tr>
         <td><b>Fecha Proceso:</b></td>
           <td colspan="1"><input type="text" name="fechap" value="<? echo date("Y-m-d");?>"class="cajas" size="11" maxlength="11" readonly onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="opcion"></td>
       </tr>
       <tr>
          <td><b>Zona:</b></td>
             <td><select name="zona" class="cajasletra">
                 <option value="0">Seleccione la zona
                 <?
                 $consulta_z="select zona.codzona,zona.zona from zona where zona.nomina='SI' and zona.estado='ACTIVA'  order by zona.zona";
                 $resultado_z=mysql_query($consulta_z) or die("Error al buscar municipios");
                 while ($filas_z=mysql_fetch_array($resultado_z)):
                       ?>
                       <option value="<?echo $filas_z["codzona"];?>"><?echo $filas_z["zona"];?>
                       <?
                 endwhile;
                       ?>
               </select></td>
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
elseif(empty($zona)):
 ?>
          <script language="javascript">
            alert("Seleccione una zona de la lista.")
              history.back()
          </script>
         <?
else:
include("../conexion.php");
  $usuario=strtoupper($usuario);
  $clave=strtoupper($clave);
  $nombre=strtoupper($nombre);
     $consulta="insert into accesozona(usuario,clave,cedula,nombre,telefono,fechap,fechaven,codzona,estado)
     values('$usuario','$clave','$cedula','$nombre','$telefono','$fechap','$fechap','$zona','$Estado')";
     $resultado=mysql_query($consulta)or die("error al grabar datos de usuario");
     $regis=mysql_affected_rows();
     if($regis!=0):
           ?>
          <script language="javascript">
            alert("Datos Grabados Y actualizados  con éxitos ?")
              open("matriculaclave.php","_self");
          </script>
         <?
      else:
           ?>
          <script language="javascript">
            alert("Error al grabar los datos de la zona ?")
              open("matriculaclave.php","_self");
          </script>
         <?
      endif;
endif;
?>
</body>
</html>
