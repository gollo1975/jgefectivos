<?
          $nota=strtoupper($nota);
          include("../conexion.php");
          $consulta="update procesonomina set nota='$nota' where procesonomina.codproceso='$codigo'";
          $resultad=mysql_query($consulta)or die("Error al buscar datos");
          $registro=mysql_affected_rows();
           echo "<script language=\"javascript\">";
                    echo "open (\"../pie.php?msg=Se actualizaron $registro registros de la incapacidad Nro: $nroinca\",\"pie\");";
                     echo "open (\"observacion.php?cedula=$cedula&desde=$desde&hasta=$hasta\",\"_self\");";
                echo "</script>";
       ?>
</body>
</html>
