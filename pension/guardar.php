<?
        if (empty($pension))
        {
?>
                <script language="javascript">
                        alert("Digite el fondo de pensión")
                        history.back()
                </script>
<?
        }
        elseif (empty($dirpension))
        {
?>
                <script language="javascript">
                        alert("Digite una Direccion")
                        history.back()
                </script>
<?
        }
        elseif (empty($telpension))
        {
?>
                <script language="javascript">
                        alert("Digite un Télefono")
                        history.back()
                </script>
<?
        }
        elseif (empty($munpension))
        {
?>
                <script language="javascript">
                        alert("Digite el municipio de la sucursal del fondo")
                        history.back()
                </script>
<?
        }
        else
        {
              $munpension=strtoupper($munpension);
              $dirpension=strtoupper($dirpension);
              $pension=strtoupper($pension);
                include("../conexion.php");
                $consulta="update pension set pension='$pension',dirpension='$dirpension',telpension='$telpension',munpension='$munpension' where codpension='$codpension'";
                $resultado=mysql_query($consulta) or die("Actualizacion Incorrecta");
                $registros=mysql_affected_rows();
                echo "<script language=\"javascript\">";
                    echo "open (\"../pie.php?msg=Se actualizaron $registros registros para el fondo de pensión: $pension\",\"pie\");";
                    echo "open (\"../menu.php?op=pension\",\"contenido\");";
                echo "</script>";
        }
?>
