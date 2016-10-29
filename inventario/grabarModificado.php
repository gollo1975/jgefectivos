<html>

<head>
  <title></title>
</head>
<body>
<?
$fechaini=date("Y-m-d");
$estado='ENTREGADO';
$motivo=strtoupper($motivo);
include("../conexion.php");
$consulta="insert into devolucion(nroentrega,cedemple,empleado,motivo,fechaini,estado)
values('$nroentrega','$cedula','$empleado','$motivo','$fechaini','$estado')";
$resultad=mysql_query($consulta)or die("Error al grabar datos");
$reg=mysql_affected_rows();
$cons="update carpeta set estado='$estado' where nroentrega='$nroentrega'";
$resultad=mysql_query($cons)or die("Inserccion incorrecta");
$registros=mysql_affected_rows();
echo "<script language=\"javascript\">";
echo "open (\"../pie.php?msg=Se actualizaron $registros registros para el empleado: $empleado\",\"pie\");";
// echo "open (\"../menu.php?op=curso\",\"contenido\");";
echo ("open (\"devolucion.php\",\"_self\");");
echo "</script>";
?>
</body>
</html>
