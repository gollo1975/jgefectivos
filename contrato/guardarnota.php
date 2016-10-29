<html>
<head>
<title>Grabando Registros</title>
</head>
<body>
<?
if (empty($contrato)):
?>
  <script language="javascript">
    alert("Digite el Nro del contrato")
    history.back()
  </script>
<?
 elseif (empty($fechainic)):
?>
  <script language="javascript">
    alert("Digite la fecha inicial del empleado")
    history.back()
  </script>
<?
     elseif (empty($nota)):
?>
      <script language="javascript">
       alert("Digite la observacion del empleado")
       history.back()
      </script>
      <?
      else:

       $fechap=date("Y-m-d");
        $nota=strtoupper($nota);
          include("../conexion.php");
          $consulta="insert into dato(contrato,cedemple,nombre,fechap,nota)
             values('$contrato','$cedemple','$nombre','$fechap','$nota')";
          $resultado=mysql_query($consulta)or die("Error al grabar observaciones $consulta");
           $registro=mysql_affected_rows();
              echo "<script language=\"javascript\">";
                    echo "open (\"../pie.php?msg=Se Grabo $registro registro del empleado : $nombre\",\"pie\");";
                    echo "open (\"observacion.php?\",\"_self\");";
                echo "</script>";
       endif;
       ?>
</body>
</html>
