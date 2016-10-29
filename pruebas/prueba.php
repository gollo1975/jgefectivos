<html>
<head>
  <title></title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>

<body>
<?
include("../conexion.php");?>
<select name="select" onChange="location.href=this.value">
<option>Seleccione Una Opcion</option>
<?$con="select eps.codeps,eps.eps from eps";
$resu=mysql_query($con)or die("Error de busqueda");
while($filas=mysql_fetch_array($resu)):
?>
   <option value="dato1.php?codigo=<? echo $filas["codeps"];?>"><?echo $filas["eps"];?>
<?
endwhile;?>

</select>
</body>
</html>
