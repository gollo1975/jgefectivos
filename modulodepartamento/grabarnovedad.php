 <input type="hidden" name="codnovedad" value="<? echo $codnovedad;?>" size="11">
 <input type="hidden" name="codzona" value="<? echo $codzona;?>">
<?
include("../conexion.php");
        $consulta=" update novedadnomina set nota='$observacion'
         where novedadnomina.codnovedad='$codnovedad'";
        $resultado=mysql_query($consulta)or die("inserección incorrecta $consulta");
        $reg=mysql_affected_rows();
        if ($reg!=0):
          echo "<script language=\"javascript\">";
                    echo "open (\"../pie.php?msg=Se actualizó $reg registros del Asociado: $nombre\",\"pie\");";
                 echo ("open (\"modificarnovedad.php?codzona=$codzona&zona=$zona&desde=$desde&hasta=$hasta\",\"_self\");");
                echo "</script>";
        else:
            echo "<script language=\"javascript\">";
                    echo "open (\"../pie.php?msg=Se actualizó $reg registros del Asociado: $nombre\",\"pie\");";
                   echo ("open (\"modificarnovedad.php?codzona=$codzona&zona=$zona&desde=$desde&hasta=$hasta\",\"_self\");");
                echo "</script>";
        endif;
?>
