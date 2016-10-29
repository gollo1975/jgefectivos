<?
              $concepto=strtoupper($concepto);
               include("../conexion.php");
                $consulta="update parametro set concepto='$concepto',nivel='$nivel',estado='$Estado' where codigo='$Codigo'";
                $resultado=mysql_query($consulta) or die("Actualizacion Incorrecta $consulta");
                $registros=mysql_affected_rows();
                $registros=mysql_affected_rows();
                echo "<script language=\"javascript\">";
                    echo "open (\"../pie.php?msg=Se actualizaron $resultado registros en el Código Nro: $Codigo\",\"pie\");";
                    echo "open (\"ParametroCredito.php\",\"_self\");";
                echo "</script>";
?>
