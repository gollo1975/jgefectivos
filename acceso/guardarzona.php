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
          $consulta="update accesozona set clave='$clave',cedula='$cedula',nombre='$nombre',telefono='$telefono',codzona='$Zona',estado='$Estado' where codigo='$CodU'";
          $resultad=mysql_query($consulta)or die("Inserccion incorrecta");
          $cons="update zona set permiso='$clave' where nitzona='$usuario'";
          $resultad=mysql_query($cons)or die("Inserccion incorrecta");
          $registros=mysql_affected_rows();
            echo "<script language=\"javascript\">";
                    echo "open (\"../pie.php?msg=Se actualizaron $registros registros para el usuario: $nombre\",\"pie\");";
                   // echo "open (\"../menu.php?op=curso\",\"contenido\");";
                     echo ("open (\"usuariozona.php\",\"_self\");");
                echo "</script>";
       endif;
       ?>
</body>
</html>
