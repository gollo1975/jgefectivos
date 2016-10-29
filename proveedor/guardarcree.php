<?
        if (empty($concepto)):
?>
                <script language="javascript">
                        alert("Digite la descripcion de la actividad económica!")
                        history.back()
                </script>
<?
        else:
                include("../conexion.php");
                $concepto=strtoupper($concepto);
                $consulta="update cree set concepto='$concepto',valor='$valor' where codigocre='$codigo'";
                $resultado=mysql_query($consulta) or die("Actualizacion Incorrecta");
                $registros=mysql_affected_rows();
              echo "<script language=\"javascript\">";
                    echo "open (\"Se actualizó $registros registro para el Item: $concepto\",\"pie\");";
                   echo "open (\"listadocree.php\",\"_self\");";
                echo "</script>";
        endif;

?>
