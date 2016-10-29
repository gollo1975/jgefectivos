<?
                include("../conexion.php");
                $fechap=date("Y-m-d");
                $camisa=strtoupper($camisa);
                $pantalon=strtoupper($pantalon);
                $zapato=strtoupper($zapato);
                        $consulta="update talla set camisa='$camisa',pantalon='$pantalon',zapato='$zapato',fecham='$fechap' where cedemple='$cedula'";
                        $resultado=mysql_query($consulta) or die("Actualizacion Incorrecta");
                        $registros=mysql_affected_rows();
                        if ($registros==0):
                        ?>
                            <script language="javascript">
                                   alert("Los registros no se modificaron con éxito en sistema ?")
                                   open ("modificartalla.php","_self");
                            </script>
                        <?
                        else:
                              echo "<script language=\"javascript\">";
                                    echo "open (\"../pie.php?msg=Se Grabo $registros Registro del Empleado: $nombre\",\"pie\");";
                                    echo ("open (\"modificartalla.php\",\"_self\");");
                                echo "</script>";

                        endif;
  ?>
