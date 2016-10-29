<html>

<head>
  <title></title>
</head>
<body>
<?
 include("../conexion.php");
  $consulta="select sucursal.*,departamento.*,maestro.* from sucursal,departamento,maestro where
                sucursal.codepart=departamento.codepart and sucursal.codmaestro=maestro.codmaestro";
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
   <th>Cod_Sucursal</th>
   <th>Sucursal</th>
   <th>Dirección</th>
   <th>teléfono</th>
   <th>Fax</th>
   <th>Municipio</th>
   <th>Departamento</th>
   <th>Email</th>
   <th>Maestro</th>

  </tr>
<?
  while($filas=mysql_fetch_array($resultado)):
?>
<tr>
  <td><?echo $filas["codsucursal"];?></td>
  <td><?echo $filas["sucursal"];?></td>
  <td><?echo $filas["dirsucursal"];?></td>
  <td><?echo $filas["telsucursal"];?></td>
  <td><?echo $filas["faxsucursal"];?></td>
  <td><?echo $filas["munmaestro"];?></td>
  <td><?echo $filas["departamento"];?></td>
  <td><?echo $filas["email"];?></td>
  <td><?echo $filas["nomaestro"];?></td>
 </tr>
<?
endwhile;
endif;
?>
</table>
</body>


</html>
