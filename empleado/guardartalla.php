<?
                include("../conexion.php");
                $fechap=date("Y-m-d");
                $camisa=strtoupper($camisa);
                $pantalon=strtoupper($pantalon);
                $zapato=strtoupper($zapato);
                        $consulta="insert into talla(cedemple,nombre,camisa,pantalon,zapato,fechap)
                        values('$cedula','$nombre','$camisa','$pantalon','$zapato','$fechap')";
                        $resultado=mysql_query($consulta) or die("Actualizacion Incorrecta");
                        $registros=mysql_affected_rows();
                        if ($registros==0):
                        ?>
                            <script language="javascript">
                                   alert("Los registros no se grabaron  ?")
                                history.back()
                            </script>
                        <?
                        else:
                              echo "<script language=\"javascript\">";
                                    echo "open (\"../pie.php?msg=Se Grabo $registros Registro del Empleado: $nombre\",\"pie\");";
                                    echo ("open (\"talladotacion.php\",\"_self\");");
                                echo "</script>";

                        endif;
  ?>
