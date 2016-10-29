 <input type="hidden" name="codnovedad" value="<? echo $codnovedad;?>" size="11">
 <input type="hidden" name="codigo" value="<? echo $codigo;?>">
<?
include("../conexion.php");
        $consulta=" update novedadnomina set nota='$observacion'
         where novedadnomina.codnovedad='$CodNomina'";
        $resultado=mysql_query($consulta)or die("inserección incorrecta $consulta");
        $reg=mysql_affected_rows();
          echo "<script language=\"javascript\">";
                    echo "open (\"../pie.php?msg=Se actualizó $reg registros del Asociado: $nombre\",\"pie\");";
                  echo ("open (\"ModificarM.php?desde=$desde&hasta=$hasta&codzona=$codzona&cedula=$cedula\",\"_self\");");
                echo "</script>";
?>
