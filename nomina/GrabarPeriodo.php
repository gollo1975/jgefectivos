<?
                include("../conexion.php");
                        $consulta="update periodo set pagado='$Proceso' where codigo='$NroP'";
                        $resultado=mysql_query($consulta) or die("Error al abrir la colilla");
                        $registros=mysql_affected_rows();
                          echo "<script language=\"javascript\">";
                                    echo "open (\"../pie.php?msg=Se Actualizó $registros Registro de la colilla Nro: $NroP\",\"pie\");";
                                    echo ("open (\"AbrirPeriodo.php?desde=$desde&hasta=$hasta\",\"_self\");");
                                echo "</script>";

?>
