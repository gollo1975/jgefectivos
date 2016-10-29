<input type="hidden" name="fechap" value="<? echo $fechap;?>" size="11">
<input type="hidden" name="desde" value="<? echo $desde;?>" size="11">
<input type="hidden" name="hasta" value="<? echo $hasta;?>" size="11">
<?
include("../conexion.php");
        $consulta=" update novedadnomina set cedemple='$cedula',nombre='$nombre',codzona='$codzona',zona='$zona',desde='$desde',hasta='$hasta',hed='$extra',hedf='$festiva',dc='$dc',dnc='$dnc',hn='$nocturno',rn='$recargo',retorno='$retorno',hnf='$hnf',otros='$otros',nota='$observacion'
         where novedadnomina.codnovedad='$codnovedad'";
        $resultado=mysql_query($consulta)or die("inserección incorrecta $consulta");
        $reg=mysql_affected_rows();
        if ($reg!=0):
          echo "<script language=\"javascript\">";
                    echo "open (\"../pie.php?msg=Se actualizó $reg registros del Asociado: $nombre\",\"pie\");";
                    echo "open (\"../menuzona.php?op=crearnovedad\",\"contenido\");";
                echo "</script>";
        else:
            echo "<script language=\"javascript\">";
                    echo "open (\"../pie.php?msg=Se actualizó $reg registros del Asociado: $nombre\",\"pie\");";
                    echo "open (\"../menuzona.php?op=crearnovedad\",\"contenido\");";
                echo "</script>";
        endif;
?>
