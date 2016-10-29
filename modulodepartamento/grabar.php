<input type="hidden" name="fechap" value="<? echo $fechap;?>" size="11">
<input type="hidden" name="desde" value="<? echo $desde;?>" size="11">
<input type="hidden" name="hasta" value="<? echo $hasta;?>" size="11">
<?
if(empty($datos)):
   ?>
   <script language="javascript">
      alert("Debe de chequear todas las cajas de verificacion ?")
      history.back()
   </script>
   <?
else:
   include("../conexion.php");
   $consulta = "select count(*) from novedadnomina";
        $result = mysql_query ($consulta);
        $sw = mysql_fetch_row($result);
        if ($sw[0]>0):
           $consulta = "select max(cast(codnovedad as unsigned)) + 1 from novedadnomina";
           $result = mysql_query($consulta) or die ("Fallo en la consulta");
           $codco = mysql_fetch_row($result);
           $codnove = str_pad ($codco[0], 10, "0", STR_PAD_LEFT);
        else:
          $codnove="0000000001";
        endif;
        $consulta="insert into novedadnomina(codnovedad,cedemple,nombre,codzona,zona,fechap,desde,hasta,nota)
                   values('$codnove','$cedula','$nombre','$codzona','$zona','$fechap','$desde','$hasta','$observacion')";
        $resultado=mysql_query($consulta)or die("inserección incorrecta $consulta");
        $registro=mysql_affected_rows();
         for ($k=1 ; $k<=$tActualizaciones; $k ++):
           if   ($datos[$k] != "" ):
               $con="insert into denovedanomina(codnovedad,codsala,concepto,vlrhora,nrohora,salario,prestacion,variacion,porcentaje,deduccion)
               values('$codnove','$datos[$k]','$concepto[$k]','$vlrhora[$k]','$nrohora[$k]','$salario[$k]','$prestacion[$k]','$variacion[$k]','$porcentaje[$k]','$deduccion[$k]')";
               $resulta=mysql_query($con)or die("Error al grabar detallado de Novedades de nomina ");
               $registro=mysql_affected_rows();
           endif;
       endfor;
        echo "<script language=\"javascript\">";
        echo "open (\"../pie.php?msg=Se Grabó $registro registro del Empleado: $nombre\",\"pie\");";
        echo "</script>";
        header("location: nuevanovedad.php?desde=$desde&hasta=$hasta&codzona=$codzona&orden=$orden");
endif;
     ?>
