<?
        if (empty($concepto))
        {
?>
                <script language="javascript">
                        alert("Digite una descripcion")
                        history.back()
                </script>
<?
        }
        else
        {
                include("../conexion.php");
                $concepto = strtoupper($concepto);
                $consulta="update item set concepto='$concepto' where codcom='$codcom'";
                $resultado=mysql_query($consulta) or die("Actualizacion Incorrecta");
                $registros=mysql_affected_rows();
                 echo "<script language=\"javascript\">";
                    echo "open (\"../pie.php?msg=Se actualizó $registros registros del item : $concepto\",\"pie\");";
                    echo "open (\"../menu.php?op=generar\",\"contenido\");";
                echo "</script>";
        }
?>
