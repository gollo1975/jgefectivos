<?
                include("../conexion.php");
               $nota=strtoupper($nota);
                        $consulta="update provision set valor='$valor',periodo='$periodo',nota='$nota' where provision.nro='$numero'";
                        $resultado=mysql_query($consulta) or die("Error al grabar datos");
                        $registros=mysql_affected_rows();
                        if ($registros==0):
                        ?>
                            <script language="javascript">
                                   alert("Los registros no se grabaron en la bd. ?")
                                history.go(-2)
                            </script>
                        <?
                        else:
                              echo "<script language=\"javascript\">";
                                    echo "alert (\"Se Actualizó $registros Registro del Nro de Pago: $numero\",\"pie\");";
                                    echo ("open (\"modificar.php?cedula=$cedula\",\"_self\");");
                                echo "</script>";

                        endif;
  ?>
