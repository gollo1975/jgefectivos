<?
                include("../conexion.php");
               $estado='NO';
                        $consulta="update empleado set colilla='$estado' where empleado.cedemple='$cedula'";
                        $resultado=mysql_query($consulta) or die("Error al grabar datos");
                        $registros=mysql_affected_rows();
                        if ($registros==0):
                        ?>
                            <script language="javascript">
                                   alert("Los registros no se grabaron en la bd. ?")
                                history.back()
                            </script>
                        <?
                        else:
                              echo "<script language=\"javascript\">";
                                    echo "open (\"../pie.php?msg=Se Actualizó $registros Registro del empleado: $nombres\",\"pie\");";
                                    echo ("open (\"parametro.php\",\"_self\");");
                                echo "</script>";

                        endif;
  ?>
