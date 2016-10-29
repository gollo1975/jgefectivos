<?
        if (empty($descripcion))
        {
?>
                <script language="javascript">
                        alert("Digite un servicio")
                        history.back()
                </script>
<?
        }
        else
        {
                include("../conexion.php");
                $descripcion=strtoupper($descripcion);
                $consulta="update servicio set descripcion='$descripcion' where codservi='$codservi'";
                $resultado=mysql_query($consulta) or die("Actualizacion Incorrecta");
                $registros=mysql_affected_rows();
                echo "<script language=\"javascript\">";
                    echo "open (\"../pie.php?msg=Se actualizó $registros registro para el item : $codservi\",\"pie\");";
                    echo "open (\"../menu.php?op=tercero&op1=admemp\",\"contenido\");";
                echo "</script>";
        }
?>
