<?
        include("../conexion.php");
          $estado=strtoupper($estado);
          $consulta="update periodo set desde='$desde',hasta='$hasta',estado='$estado',nota='$nota' where codigo='$codigo'";
          $resultad=mysql_query($consulta)or die("Inserccion incorrecta");
          /**/
          $ConR="update nomina set estado='CERRADO' where codigo='$codigo' and desde='$desde' and hasta='$hasta'";
          $resuR=mysql_query($ConR)or die("Error al actualizar el cierre de la colilla");
          $registro=mysql_affected_rows();
          /**/
          echo "<script language=\"javascript\">";
          echo "open (\"../pie.php?msg=Se Modificó $registro registro del codigo de la zona: $codzona\",\"pie\");";
          echo "open (\"nomina.php?Documento=$Documento&Auxiliar=$Auxiliar\",\"_self\");";
          echo "</script>";

?>

