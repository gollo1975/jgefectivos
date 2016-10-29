<?
                include("../conexion.php");
               $concepto=strtoupper($concepto);
                        $consulta="insert into parametro(codigo,concepto)
                        values('$codigo','$concepto')";
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
                                    echo "open (\"../pie.php?msg=Se Grabo $registros Registro del código Nro: $codigo\",\"pie\");";
                                    echo ("open (\"parametro.php\",\"_self\");");
                                echo "</script>";

                        endif;
  ?>
