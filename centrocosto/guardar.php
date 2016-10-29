<?
        $fecha=date("Y-m-d");
        $prestacion=strtoupper($prestacion);
        $tipocon=strtoupper($tipocon);
        include("../conexion.php");
        $con1="select * from centro where cedemple='$cedemple'";
        $re=mysql_query($con1)or die("consulta incorrecta 1");
        $reg=mysql_num_rows($re);
        if($reg==0):
                $consulta = "select count(*) from centro";
                $result = mysql_query ($consulta);
                $answ = mysql_fetch_row($result);
                if ($answ[0] > 0):
                        $consulta = "select max(cast(codcentro as unsigned)) + 1 from centro";
                        $result2 = mysql_query($consulta);
                        $codc = mysql_fetch_row($result2);
                        $codme= str_pad($codc[0], 6, "0", STR_PAD_LEFT);

                else:
                        $codme="000001";
                endif;
                $consulta="insert into centro(codcentro,cedemple,fecha)
                        values('$codme','$cedemple','$fecha')";
                $resultado=mysql_query($consulta) or die("Insercion nueva incorrecta");
                $con="insert into decentro(codcentro,codsala,descripcion,vlrhora,salario,prestacion,variacion,porcentaje,deduccion,estado,datos,activo)
                        values('$codme','$datos','$descripcion','$vlrhora','$salario','$prestacion','$tipocon','$porcentaje','$deduccion','$control','$insertar','$activo')";
                $resultado=mysql_query($con) or die("Actualizacion Incorrecta $con ");
                $registros=mysql_affected_rows();
                if($registros!=0):
?>
                        <script language="javascript">
                                alert("Datos Grabados con Exito en la Base de datos")
                                history.go(-2)
                        </script>
<?
                endif;
        else:
                $con1="select * from centro where cedemple='$cedemple'";
                $re=mysql_query($con1)or die("consulta incorrecta 1");
                $filas=mysql_fetch_array($re);
                $codcentro=$filas["codcentro"];
                $con="select decentro.* from decentro where decentro.codsala='$datos' and codcentro='$codcentro'";
                $resul=mysql_query($con)or die("Consulta incorrecta de busqueda");
                $reg=mysql_num_rows($resul);
                if ($reg!=0):
?>
                        <script language="javascript">
                                alert("Este Empleado ya se le agrego este Item ?")
                                history.go(-2)
                        </script>
<?
                else:
                        $con="insert into decentro(codsala,codcentro,descripcion,vlrhora,salario,prestacion,variacion,porcentaje,deduccion,estado,datos,activo)
                                values('$codsala','$codcentro','$descripcion','$vlrhora','$salario','$prestacion','$tipocon','$porcentaje','$deduccion','$control','$insertar','$activo')";
                        $resultado=mysql_query($con) or die("Actualizacion Incorrecta ");
                        $registros=mysql_affected_rows();
                        if($registros!=0):
?>
                                <script language="javascript">
                                        alert("Datos Cargado Con exito ?")
                                        history.go(-2)
                                </script>
<?
                        endif;
                endif;
        endif;
