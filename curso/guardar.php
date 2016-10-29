<html>

<head>
  <title></title>
</head>
<body>
<?
if (empty($fechag)):
?>
  <script language="javascript">
    alert("Digite la fecha de Grabado")
    history.back()
  </script>
<?
 elseif (empty($fechar)):
?>
  <script language="javascript">
    alert("Digite la fecha de Realizo del curso ?")
    history.back()
  </script>
<?
   elseif (empty($puntaje)):
?>
     <script language="javascript">
       alert("Digite el puntaje del examen ?")
       history.back()
     </script>
     <?
      else:
          include("../conexion.php");
          $consulta="update curso set cedemple='$empleado',fechag='$fechag',fechar='$fechar',puntaje='$puntaje',
             nitprove='$provedor' where codcurso='$codcurso'";
          $resultad=mysql_query($consulta)or die("Inserccion incorrecta");
          $registro=mysql_affected_rows();
            echo "<script language=\"javascript\">";
                    echo "open (\"../pie.php?msg=Se actualizaron $registro registros para la Cedula: $empleado\",\"pie\");";
                    echo "open (\"../menu.php?op=curso\",\"contenido\");";
                echo "</script>";
       endif;
       ?>
</body>
</html>
