<?
        if (empty($eps))
        {
?>
                <script language="javascript">
                        alert("Digite El nombre de la Eps")
                        history.back()
                </script>
<?
        }
         elseif (empty($Nit))
        {
?>
                <script language="javascript">
                        alert("Digite el nit de la Eps")
                        history.back()
                </script>
<?
        }
        elseif (empty($direps))
        {
?>
                <script language="javascript">
                        alert("Digite la Dirección de la Eps")
                        history.back()
                </script>
<?
        }
        elseif (empty($teleps))
        {
?>
                <script language="javascript">
                        alert("Digite un Télefono")
                        history.back()
                </script>
<?
        }
        elseif (empty($municipio))
        {
?>
                <script language="javascript">
                        alert("Digite el municipio de la Eps")
                        history.back()
                </script>
<?
        }
        else
        {
              $municipio=strtoupper($municipio);
              $direps=strtoupper($direps);
              $eps=strtoupper($eps);
                include("../conexion.php");
                $consulta="update eps set nit='$Nit',eps='$eps',direps='$direps',teleps='$teleps',codmuni='$municipio' where codeps='$codeps'";
                $resultado=mysql_query($consulta) or die("Actualizacion Incorrecta");
                $registros=mysql_affected_rows();
                echo "<script language=\"javascript\">";
                    echo "open (\"../pie.php?msg=Se actualizaron $registros registros para la Eps: $eps\",\"pie\");";
                    echo "open (\"listado.php\",\"_self\");";
                echo "</script>";
        }
?>
