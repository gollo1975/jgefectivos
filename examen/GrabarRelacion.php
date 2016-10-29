<?              include("../conexion.php");
                $consulta="update parametroexamen set tipopago='$Pago' where codzona='$codzona'";
                $resultado=mysql_query($consulta) or die("Actualizacion Incorrecta");
                $registros=mysql_affected_rows();
              echo "<script language=\"javascript\">";
                    echo "open (\"../pie.php?msg=Se actualizó $registros registro para el Código: $codzona\",\"pie\");";
                   echo "open (\"EditarRelacion.php\",\"_self\");";
                echo "</script>";

?>
