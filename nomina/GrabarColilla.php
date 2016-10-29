<?
                include("../conexion.php");
               $fechaM=date("Y-m-d");
                        $consulta="update nomina set estado='$Proceso',fecham='$fechaM' where consecutivo='$Nro'";
                        $resultado=mysql_query($consulta) or die("Error al abrir la colilla");
                        $registros=mysql_affected_rows();
                              echo "<script language=\"javascript\">";
                                    echo "open (\"../pie.php?msg=Se Actualizó $registros Registro de la colilla Nro: $Nro\",\"pie\");";
                                    echo ("open (\"AbrirColilla.php\",\"_self\");");
                                echo "</script>";

?>
