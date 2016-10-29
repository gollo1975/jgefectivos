<?
include("../conexion.php");
          $consulta="update modelocon set nota='$nota' where codmodelo='$codigo'";
          $resultado=mysql_query($consulta)or die("Inserccion incorrecta");
           $registro=mysql_affected_rows();
              echo "<script language=\"javascript\">";
                    echo "open (\"../pie.php?msg=Se actualizaron $registro del modelo Nro: $codigo\",\"pie\");";
                    echo "open (\"../menu.php?op=contrato\",\"contenido\");";
                echo "</script>";
?>
</body>
</html>
