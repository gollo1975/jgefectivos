<?
        if (empty($centro))
        {
?>
                <script language="javascript">
                        alert("Digite un centro")
                        history.back()
                </script>
<?
        }
        else
        {
                include("../conexion.php");
                $centro=strtoupper($centro);
                $consulta="update itemfondo set concepto='$centro' where codigo='$codcosto'";
                $resultado=mysql_query($consulta) or die("Actualizacion Incorrecta");
                $registros=mysql_affected_rows();
              echo "<script language=\"javascript\">";
                    echo "open (\"../pie.php?msg=Se actualiz� $registros registro para el Item: $centro\",\"pie\");";
                   echo "open (\"modificaritem.php\",\"_self\");";
                echo "</script>";
        }

?>
