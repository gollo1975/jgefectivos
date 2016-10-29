<html>

<head>
  <title>Listado de Zona</title>
</head>
<body>
<?
 include("../conexion.php");
  $consulta="select zona.*,sucursal.* from zona,sucursal where
                zona.codsucursal=sucursal.codsucursal";
  $resultado=mysql_query($consulta)or die ("Consulta incorrecta");
  $registros=mysql_num_rows($resultado);
  if ($registros==0):

?>
  <script language="javascript">
    alert("No existen Registro en la base de datos ?")
    </script>
 <?
   else:
  ?>
<table border="1" align="center">
 <tr>
   <th>Cod_Zona</th>
   <th>Zona</th>
   <th>Telefono</th>
   <th>Fax</th>
   <th>Direccion</th>
   <th>Barrio</th>
   <th>Email</th>
   <th>Sucursal</th>
   <th>Nit</th>
   <th>Digito</th>
   <th>Fecha</th>
   <th>Nomina</th>
  </tr>
<?
  while($filas=mysql_fetch_array($resultado)):
?>
<tr>
  <td><?echo $filas["codzona"];?></td>
  <td><?echo $filas["zona"];?></td>
  <td><?echo $filas["telzona"];?></td>
  <td><?echo $filas["faxzona"];?></td>
  <td><?echo $filas["dirzona"];?></td>
  <td><?echo $filas["barzona"];?></td>
  <td><?echo $filas["emailzona"];?></td>
  <td><?echo $filas["sucursal"];?></td>
  <td><?echo $filas["nitzona"];?></td>
  <td><?echo $filas["dvzona"];?></td>
  <td><?echo $filas["fechaini"];?></td>
  <td><?echo $filas["nomina"];?></td>
 </tr>
<?
endwhile;
endif;
?>
</table>
</body>


</html>
