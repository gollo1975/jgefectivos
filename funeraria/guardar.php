<html>
<head>
<title>Grabando Registros</title>
</head>
<body>
<?
if (empty($nombres)):
?>
  <script language="javascript">
    alert("Digite el Nombre del beneficiario")
    history.back()
  </script>
<?
 elseif (empty($parentezco)):
?>
  <script language="javascript">
    alert("Digite el parentezco del beneficiario")
    history.back()
  </script>
<?
   elseif (empty($empleado)):
?>
     <script language="javascript">
       alert("Digite el nombre del empleado ?")
       history.back()
     </script>
     <?
     else:
       $tipo=strtoupper($tipo);
       $nombres=strtoupper($nombres);
        $parentezco=strtoupper($parentezco);
          include("../conexion.php");
          $consulta="update funeraria set tipo='$tipo',nombres='$nombres',parentezco='$parentezco',cedemple='$empleado' where documento='$documento'";
          $resultado=mysql_query($consulta)or die("Inserccion incorrecta");
          $registro=mysql_affected_rows();
          echo "<script language=\"javascript\">";
                    echo "open (\"../pie.php?msg=Se actualizaron $registro registros para la cedula Nro: $empleado\",\"pie\");";
                    echo "open (\"../menu.php?op=funeraria&op1=admemp\",\"contenido\");"; 
                echo "</script>";
       endif;
       ?>
</body>
</html>
