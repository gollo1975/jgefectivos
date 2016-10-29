<?
        if (empty($dvmaestro))
        {
?>
                <script language="javascript">
                        alert("Digite un Dv")
                        history.back()
                </script>
<?
        }
        elseif (empty($nomaestro))
        {
?>
                <script language="javascript">
                        alert("Digite un Nombre")
                        history.back()
                </script>
<?
        }
        elseif (empty($dirmaestro))
        {
?>
                <script language="javascript">
                        alert("Digite una Direccion")
                        history.back()
                </script>
<?
        }
        elseif (empty($telmaestro))
        {
?>
                <script language="javascript">
                        alert("Digite un Telefono")
                        history.back()
                </script>
<?
        }
         elseif (empty($actividad))
        {
?>
                <script language="javascript">
                        alert("Seleccione un actividad de la lista")
                        history.back()
                </script>
<?
        }
        else
        {
                include("../conexion.php");
               $nomaestro=strtoupper($nomaestro);
                                      $dirmaestro=strtoupper($dirmaestro);
                                      $email=strtoupper($email);
                                      $web=strtoupper($web);
                $consulta="update maestro set dvmaestro='$dvmaestro',nomaestro='$nomaestro',dirmaestro='$dirmaestro',telmaestro='$telmaestro',faxmaestro='$faxmaestro',codmuni='$codmunicipio',email='$email',web='$web',codigocre='$actividad' where codmaestro='$codmaestro'";
                $resultado=mysql_query($consulta) or die("Se presentó error en la acutalización");
                echo "<script language=\"javascript\">";
                    echo "open (\"../pie.php?msg=Se actualizaron $resultado registros para la empresa: $nomaestro\",\"pie\");";
                    echo "open (\"../menu.php?op=empresas&op1=admemp\",\"contenido\");";
                echo "</script>";

        }
?>
