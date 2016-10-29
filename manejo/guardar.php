<?
        if (empty($descripcion))
        {
?>
                <script language="javascript">
                        alert("Digite una Descripcion")
                        history.back()
                </script>
<?
        }
        else
        {
                include("../conexion.php");
                $descripcion=strtoupper($descripcion);
                $consulta="update manejo set descripcion='$descripcion' where codmanejo='$codmanejo'";
                $resultado=mysql_query($consulta) or die("Actualizacion Incorrecta");
                $registros=mysql_affected_rows();
                 echo "<script language=\"javascript\">";
                    echo "open (\"../pie.php?msg=Se actualizaron $registros registros de Items de Abono\",\"pie\");";
                    echo "open (\"../menu.php?op=crear\",\"contenido\");";
                echo "</script>";
        }
?>
