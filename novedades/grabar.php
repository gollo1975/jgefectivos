<input type="hidden" name="fechap" value="<? echo $fechap;?>" size="11">
<input type="hidden" name="desde" value="<? echo $desde;?>" size="11">
<input type="hidden" name="hasta" value="<? echo $hasta;?>" size="11">
<?
include("../conexion.php");
 $consulta = "select count(*) from novedadindividual";
        $result = mysql_query ($consulta);
        $sw = mysql_fetch_row($result);
        if ($sw[0]>0):
           $consulta = "select max(cast(codnovedad as unsigned)) + 1 from novedadindividual";
           $result = mysql_query($consulta) or die ("Fallo en la consulta");
           $codco = mysql_fetch_row($result);
           $codnove = str_pad ($codco[0], 10, "0", STR_PAD_LEFT);
        else:
          $codnove="0000000001";
        endif;
        $consulta="insert into novedadindividual(codnovedad,cedemple,nombre,codzona,zona,fechap,desde,hasta,nota)
                   values('$codnove','$cedula','$nombre','$codzona','$zona','$fechap','$desde','$hasta','$observacion')";
        $resultado=mysql_query($consulta)or die("Error al grabar datos ?");
        $registro=mysql_affected_rows();
        echo "<script language=\"javascript\">";
        echo "open (\"../pie.php?msg=Se Grabó $registro registro del Empleado: $nombre\",\"pie\");";
        echo "</script>";
         header("location: cargar.php?desde=$desde&hasta=$hasta");
      ?>
