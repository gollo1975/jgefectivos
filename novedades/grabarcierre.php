<?
        include("../conexion.php");
          $estado=strtoupper($estado);
          $consulta="update pnovedad set desde='$desde',hasta='$hasta',estado='$estado',nota='$nota' where codigo='$codigo'";
          $resultad=mysql_query($consulta)or die("Inserccion incorrecta");
          $registro=mysql_affected_rows();
          echo "<script language=\"javascript\">";
          echo "open (\"../pie.php?msg=Se Modificó $registro registro del periodo de Nomina del: $desde Hasta: $hasta\",\"pie\");";
          echo "open (\"../menu.php?op=crearnovedad\",\"contenido\");";
          echo "</script>";
         
      ?>

