<input type="text" name="hidden" value="<? echo $codzona;?>">
             <input type="hidden" name="cedula" value="<? echo $cedula;?>">
             <input type="hidden" name="desde" value="<? echo $desde;?>">
             <input type="hidden" name="hasta" value="<? echo $hasta;?>">
              <input type="hidden" name="zona" value="<? echo $zona;?>">
             <input type="hidden" name="servicio" value="<? echo $servicio;?>">
            <input type="hidden" name="codigo" value="<? echo $codigo;?>">
            <input type="hidden" name="empresa" value="<? echo $empresa;?>">
            <input type="hidden" name="servicio" value="<? echo $servicio;?>">
<?
if(empty($buscar)):
   ?>
     <script language="javascript">
        alert("Debe de chequear las cajas para poder guardar la información")
        history.back()
     </script>
   <?
else:
                $fecha=date("Y-m-d");
                include("../conexion.php");
                $con1="select carterazona.codigo from carterazona where carterazona.codigo='$codigo'";
                $resu=mysql_query($con1)or die("Error de busqueda en la tabla cartera");
                $reg=mysql_num_rows($resu);
                $filas_s=mysql_fetch_array($resu);
                if($reg==0):
                        $consulta = "select count(*) from carterazona";
                        $result = mysql_query ($consulta);
                        $answ = mysql_fetch_row($result);
                        if ($answ[0] > 0):
                                $consulta = "select max(cast(codigo as unsigned)) + 1 from carterazona";
                                $result2 = mysql_query($consulta);
                                $codc = mysql_fetch_row($result2);
                                $codco= str_pad($codc[0], 6, "0", STR_PAD_LEFT);
                        else:
                                $codco="000001";
                        endif;

                        $consulta="insert into carterazona(codigo,cedulaven,fechaini,fechacorte,fechap)
                                values('$codco','$cedula','$desde','$hasta','$fecha')";
                        $resultado=mysql_query($consulta) or die("Error al grabar en la tabla cartera");
                         for ($k=1 ; $k<=$tActualizaciones; $k ++):
		           if   ($buscar[$k] != "" ):
		               $con="insert into decartera(codzona,zona,fechaini,fechacorte,convenio,porcentaje,total,codigo,remision)
		               values('$codzona[$k]','$zona','$desde','$hasta','$admon[$k]','$porcentaje[$k]','$vlrcomision[$k]','$codco','$remision[$k]')";
		               $resulta=mysql_query($con)or die("Error al grabar detallado de Novedades de nomina ");
		               $registro=mysql_affected_rows();
		           endif;
		       endfor;
                       $empresa=$empresa;
                       $servicio=$servicio;
                       $Busca="select carterazona.codigo,carterazona.fechaini,carterazona.fechacorte,carterazona.cedulaven from carterazona where carterazona.codigo='$codco'";
                        $resu=mysql_query($Busca)or die ("Error en la busqueda en la tabla cartera");
                        $filas_s=mysql_fetch_array($resu);
                        $codigo=$filas_s["codigo"];
                        $cedula=$filas_s["cedulaven"];
                        $desde=$filas_s["fechaini"];
                        $hasta=$filas_s["fechacorte"];
                        $registros=mysql_affected_rows();
              else:

                      for ($k=1 ; $k<=$tActualizaciones; $k ++):
		           if   ($buscar[$k] != "" ):
		               $con="insert into decartera(codzona,zona,fechaini,fechacorte,convenio,porcentaje,total,codigo,remision)
		               values('$codzona[$k]','$zona','$desde','$hasta','$admon[$k]','$porcentaje[$k]','$vlrcomision[$k]','$codigo','$remision[$k]')";
		               $resulta=mysql_query($con)or die("Error al grabar detallado de Novedades de nomina ");
		               $registro=mysql_affected_rows();
		           endif;
		       endfor;
                        $empresa=$empresa;
                        $servicio=$servicio;
                       $Busca="select carterazona.codigo,carterazona.fechaini,carterazona.fechacorte,carterazona.cedulaven from carterazona where carterazona.codigo='$codigo'";
                        $resu=mysql_query($Busca)or die ("Error en la busqueda en la tabla cartera");
                        $filas_s=mysql_fetch_array($resu);
                        $codigo=$filas_s["codigo"];
                        $cedula=$filas_s["cedulaven"];
                        $desde=$filas_s["fechaini"];
                        $hasta=$filas_s["fechacorte"];
                        $registros=mysql_affected_rows();

                endif;
                ?>
                <script language="javascript">
                open ("agregarcartera.php?servicio=<?echo $servicio;?>&empresa=<?echo $empresa;?>&codigo=<?echo $codigo;?>&cedula=<?echo $cedula;?>&desde=<?echo $desde;?>&hasta=<?echo $hasta;?>","_self")
                </script>
                <?
               /* header("location:agregarcartera.php?cedula=$cedula&codcomision=$codigo&desde=$desde&hasta=$hasta&servicio=$servicio");*/
endif;
             
?>
