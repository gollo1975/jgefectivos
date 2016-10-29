<?
                $fecha=date("Y-m-d");
                include("../conexion.php");
                $con1="select comision.codigo from comision where comision.codigo='$codcomision'";
                $resu=mysql_query($con1)or die("Error de busqueda en la tabla comision");
                $reg=mysql_num_rows($resu);
                $filas_s=mysql_fetch_array($resu);
                if($reg==0):
                        $consulta = "select count(*) from comision";
                        $result = mysql_query ($consulta);
                        $answ = mysql_fetch_row($result);
                        if ($answ[0] > 0):
                                $consulta = "select max(cast(codigo as unsigned)) + 1 from comision";
                                $result2 = mysql_query($consulta);
                                $codc = mysql_fetch_row($result2);
                                $codco= str_pad($codc[0], 6, "0", STR_PAD_LEFT);
                        else:
                                $codco="000001";
                        endif;

                        $consulta="insert into comision(codigo,cedulaven,fechaini,fechacorte,fechap)
                                values('$codco','$cedula','$desde','$hasta','$fecha')";
                        $resultado=mysql_query($consulta) or die("Error al grabar en la tabla comision");
                        $con="insert into decomision(codzona,zona,fechaini,fechacorte,convenio,porcentaje,can,total,codigo)
                                values('$codzona','$zona','$desde','$hasta','$convenio','$porcentaje','$can','$comision','$codco')";
                        $resultado=mysql_query($con) or die("Error al grabar detalles ");
                        $busca="select comision.codigo,comision.fechaini,comision.fechacorte from comision where comision.codigo='$codco'";
                        $resu=mysql_query($busca)or die ("Error en la busqueda en la tabla comision");
                        $filas_s=mysql_fetch_array($resu);
                        $codigo=$filas_s["codigo"];
                        $desde=$filas_s["fechaini"];
                        $hasta=$filas_s["fechacorte"];
                        $registros=mysql_affected_rows();
                else:
                        $con="insert into decomision(codzona,zona,fechaini,fechacorte,convenio,porcentaje,can,total,codigo)
                                values('$codzona','$zona','$desde','$hasta','$convenio','$porcentaje','$can','$comision','$codcomision')";
                        $resultado=mysql_query($con) or die("Error al grabar detalle de la comision ");
                        $busca="select comision.codigo,comision.fechaini,comision.fechacorte from comision where comision.codigo='$codcomision'";
                        $resu=mysql_query($busca)or die ("Error en la busqueda de la tabla comision");
                        $filas_s=mysql_fetch_array($resu);
                        $codigo=$filas_s["codigo"];
                        $desde=$filas_s["fechaini"];
                        $hasta=$filas_s["fechacorte"];
                        $registros=mysql_affected_rows();

                endif;
                header("location:agregar.php?cedula=$cedula&codcomision=$codigo&desde=$desde&hasta=$hasta");
             
?>
