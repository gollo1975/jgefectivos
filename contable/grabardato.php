<?
 include("../conexion.php");
   $descripcion=strtoupper($descripcion);
    $ingreso="update tipocomprobante set descripcion='$descripcion',porcentaje='$PorC' where id='$Id'";
     $resu=mysql_query($ingreso)or die ("Error al grabar datos contables");
     $re=mysql_affected_rows();
     echo "<script language=\"javascript\">";
        echo "open (\"../pie.php?msg=Se Grabo $re registro para el comprobante contable Nro: $codigo\",\"pie\");";
                   // echo "open (\"../menu.php?op=curso\",\"contenido\");";
        echo ("open (\"modificarcontable.php\",\"_self\");");
     echo "</script>";
?>
