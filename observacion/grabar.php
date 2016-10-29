<?

  include("../conexion.php");
  $con="update observacion set descripcion='$nota' where numero='$numero'";
  $res=mysql_query($con)or die("Error de Inserccion $con");
  $registros=mysql_affected_rows();
            echo "<script language=\"javascript\">";
                    echo "open (\"../pie.php?msg=Se actualizaron $registros registros para la Observacion Nro: $numero\",\"pie\");";
                   // echo "open (\"../menu.php?op=curso\",\"contenido\");";
                     echo ("open (\"modificar.php\",\"_self\");");
                echo "</script>";
?>

