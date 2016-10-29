<?
        if (empty($centro))
        {
?>
                <script language="javascript">
                        alert("Digite la descripcion")
                        history.back()
                </script>
<?
        }
        else
        {
                include("../conexion.php");
                $centro=strtoupper($centro);
                $consulta="update itemrequisito set descripcion='$centro' where codigo='$codigo'";
                $resultado=mysql_query($consulta) or die("Actualizacion Incorrecta");
                $registros=mysql_affected_rows();
              echo "<script language=\"javascript\">";
                    echo "open (\"../pie.php?msg=Se actualizó $registros registro para el Item: $centro\",\"pie\");";
                   echo "open (\"modificarlistar.php\",\"_self\");";
                echo "</script>";
        }

?>
