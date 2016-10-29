<html>

<head>
  <title></title>
</head>
<body>
<?
$nota=strtoupper($nota);
$fechap=date("Y-m-d");
include("../conexion.php");
    $consulta1="insert into seguimiento(nroinca,cedemple,nombres,nota,fechap)
     values('$numero','$cedula','$nombre','$nota','$fechap')";
     $resultado=mysql_query($consulta1)or die("Error al Grabar ");
     $reg=mysql_affected_rows();
     echo "<script language=\"javascript\">";
     echo "open (\"../pie.php?msg=Se Grabo $reg registro de la incapacidad Nro: $numero\",\"pie\");";
     echo "open(\"seguimiento.php\",\"_self\");";
          echo "</script>";
      ?>
</body>
</html>
