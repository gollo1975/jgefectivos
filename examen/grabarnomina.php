<?
         $estado='CANCELADO';
         $fechap=date("Y-m-d");
          include("../conexion.php");
          $consulta1 = "select count(*) from examenomina";
	   $result1 = mysql_query ($consulta1);
	   $sw = mysql_fetch_row($result1);
	    if ($sw[0]>0):
	     $consulta = "select max(cast(codpago as unsigned)) + 1  from examenomina";
	     $result = mysql_query ($consulta);
	     $codec = mysql_fetch_row($result);
	     $codcesa = str_pad($codec[0], 5,"0", STR_PAD_LEFT);
	     else:
	       $codcesa="00001";
	     endif;
            $consulta="insert into examenomina(codpago,conse,cedula,nombre,zona,provedor,radicado,fechap,fechan)
               values('$codcesa','$conse','$cedula','$nombre','$zona','$provedor','$radicado','$fechap','$fechan')";
             $resultad=mysql_query($consulta)or die("Error al descargar los examenes ?");
             $consu="update examen set estado='$estado' where examen.nro='$conse'";
             $resu=mysql_query($consu)or die("Error al actualizar datos del examenes");
             $regis=mysql_affected_rows();
             if($regis!=0):
                echo "<script language=\"javascript\">";
                    echo "open (\"../pie.php?msg=Se Grabó $regis registros del Empleado: $nombre\",\"pie\");";
                     echo ("open (\"subir.php\",\"_self\");");
                 echo "</script>";
             else:
                ?>
                <script language="javascript">
                   alert("No se grabaron los registros en sistema ?")
                   history.back()
                </script>
             <?
          endif;

 ?>

