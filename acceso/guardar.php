<html>

<head>
  <title></title>
</head>
<body>
<?
if (empty($cedula)):
?>
  <script language="javascript">
    alert("El campo Cedula no puede estar Vacio ?")
    history.back()
  </script>
<?
   elseif (empty($nombre)):
?>
     <script language="javascript">
       alert("Digite el Nombre de Empleado que se le asigno el Usuario ?")
       history.back()
     </script>
     <?
      else:
          include("../conexion.php");
          $clave=strtoupper($clave);
          $consulta="update acceso set clave='$clave',cedula='$cedula',nombre='$nombre',telusuario='$telefono',menu='$menup',fechaven='$fvcto',firmadigital='$firma',fechaingreso='$ingreso',horaingreso='$hora',estado='$Estado' where usuario='$usuario'";
          $resultad=mysql_query($consulta)or die("Error al actualizar");
          $registros=mysql_affected_rows();
            echo "<script language=\"javascript\">";
                    echo "open (\"../pie.php?msg=Se actualizaron $registros registros para el usuario: $nombre\",\"pie\");";
                   // echo "open (\"../menu.php?op=curso\",\"contenido\");";
                     echo ("open (\"usuarios.php\",\"_self\");");
                echo "</script>";
       endif;
       ?>
</body>
</html>
