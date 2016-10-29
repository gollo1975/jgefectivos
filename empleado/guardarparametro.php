<?
       $fecha=date("Y-m-d");
        include("../conexion.php");
        $con1="select * from parametro where cedemple='$cedula'";
        $re=mysql_query($con1)or die("consulta incorrecta 1");
        $reg=mysql_num_rows($re);
        if($reg==0):
                $consulta="insert into parametro(cedemple,empleado,fecha)
                        values('$cedula','$empleado','$fecha')";
                $resultado=mysql_query($consulta) or die("Error al grabar Parametros");
                $con="insert into deparametro(codsala,descripcion,facturar,ss,para,presta,cedemple)
                        values('$datos','$descripcion','$estado','$ss','$parafiscal','$presta','$cedula')";
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
                $con="select deparametro.* from deparametro where deparametro.codsala='$datos' and cedemple='$cedula'";
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
                        $con="insert into deparametro(codsala,descripcion,facturar,ss,para,presta,cedemple)
                                values('$datos','$descripcion','$estado','$ss','$parafiscal','$presta','$cedula')";
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
