<?
        if (empty($desala))
        {
?>
                <script language="javascript">
                        alert("Digite la Descripción del codigo")
                        history.back()
                </script>
<?
        }
        else
        {
               $desala=strtoupper($desala);
               include("../conexion.php");
                $consulta="update salario set desala='$desala',porcentaje='$porcentaje',ayuda='$ayuda',prestacion='$prestacion',control='$control',insertar='$Variable',sumarcupo='$SumarC',ingreso='$Ingreso',egreso='$Egreso',formapago='$FormaPago',totalhoras='$TotalHoras',activo='$Activo',permanente='$Permanente',estado='$Estado' where salario.codsala='$codsala'";
                $resultado=mysql_query($consulta) or die("Actualizacion Incorrecta $consulta");
                $registros=mysql_affected_rows();
                $con="update decentro set estado='$control'where codsala='$codsala'";
                $resu=mysql_query($con) or die("consulta incorrecta");
                $registros=mysql_affected_rows();
                echo "<script language=\"javascript\">";
                    echo "open (\"../pie.php?msg=Se actualizaron $resultado registros en el Código Nro: $codsala\",\"pie\");";
                    echo "open (\"ListarM.php\",\"_self\");";
                echo "</script>";
        }
?>
