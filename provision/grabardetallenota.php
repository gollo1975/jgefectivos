<?
                include("../conexion.php");
               $nota=strtoupper($nota);
                        $consulta="update entregaprovi set vlrpagado='$valor',nota='$nota' where entregaprovi.nro='$numero'";
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
                                    echo "alert (\"Se Actualizó $registros Registro de la Nota de Pago: $numero\",\"pie\");";
                                    echo ("open (\"modificarentrega.php?cedula=$cedula\",\"_self\");");
                                echo "</script>";

                        endif;
  ?>
