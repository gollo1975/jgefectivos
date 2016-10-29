<?
        if (empty($nombre))
        {
?>
                <script language="javascript">
                        alert("Digite el nombre del vendedor")
                        history.back()
                </script>
<?
        }
        elseif (empty($direcion))
        {
?>
                <script language="javascript">
                        alert("Digite la dirección del vendedor")
                        history.back()
                </script>
<?
        }
                elseif (empty($telefono))
        {
?>
                <script language="javascript">
                        alert("Digite un Telefono del vendedor")
                        history.back()
                </script>
<?
        }
       else
        {
                include("../conexion.php");
               $razon=strtoupper($razon);
               $direcion=strtoupper($direcion);
               $nombre=strtoupper($nombre);
                $consulta="update vendedor set nombreven='$nombre',dirven='$direcion',teven='$telefono',celular='$celular',codsucursal='$codigo' where cedulaven='$cedula'";
                $resultado=mysql_query($consulta) or die("Se presentó error en la acutalización");
                echo "<script language=\"javascript\">";
                    echo "open (\"../pie.php?msg=Se actualizó $resultado registro para el Vendedor: $nombre\",\"pie\");";
                    echo "open (\"../menu.php?op=vendedor\",\"contenido\");";
                echo "</script>";

        }
?>
