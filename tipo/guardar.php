<?
        if (empty($descripcion))
        {
?>
                <script language="javascript">
                        alert("Digite un descripcion")
                        history.back()
                </script>
<?
        }
        else
        {
                include("../conexion.php");
                $descripcion = strtoupper($descripcion);
                $consulta="update tipo set descripcion='$descripcion' where tipocre='$tipocre'";
                $resultado=mysql_query($consulta) or die("Actualizacion Incorrecta");
                $registros=mysql_affected_rows();
                 echo "<script language=\"javascript\">";
                    echo "open (\"../pie.php?msg=Se actualizaron $registros registros de item de créditos: $sucursal\",\"pie\");";
                    echo "open (\"../menu.php?op=crear\",\"contenido\");";
                echo "</script>";
        }
?>
