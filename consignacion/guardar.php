<html>
<head>
<title>Grabando Registros</title>
</head>
<body>
<?
if (empty($nrocon)):
?>
  <script language="javascript">
    alert("Digite el Nro de la consignación")
    history.back()
  </script>
<?

    else:
       include("../conexion.php");

       $fecha1=$a1 . "/" . $m1 . "/" . $d1;
          $consulta="update consignacion set cedemple='$empleado',codbanco='$nombre',fechapro='$fechapro',fechapago='$fecha1',
             valor='$valor' where nrocon='$nrocon'";
          $resultado=mysql_query($consulta)or die("Inserccion incorrecta");
          $registro=mysql_affected_rows();
        echo "<script language=\"javascript\">";
                    echo "open (\"../pie.php?msg=Se actualizaron $registro registros en Aportes sociales\",\"pie\");";
                    echo "open (\"modificar.php\",\"_self\");";
                echo "</script>";
       endif;
       ?>
</body>
</html>
