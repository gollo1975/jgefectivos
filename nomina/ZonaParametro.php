<html>

<head>
  <title>Cargando Sucursales</title>
   <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
 <?
 include("../conexion.php");
  $con="select maestro.nomaestro from maestro";
  $resulta=mysql_query($con)or die ("Consulta incorrecta 1");
  $registros=mysql_num_rows($resulta);
  while($fila=mysql_fetch_array($resulta)):
     ?>
     <table border="0" align="center">
       <tr class="cajas">
         <td><?echo $fila["nomaestro"];?></td>
       </tr>
     </table>
     <?
  endwhile;
  $consulta="select maestro.*,sucursal.* from maestro,sucursal where
  maestro.codmaestro=sucursal.codmaestro";
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
<table border="0" align="center">
  <tr class="cajas">
    <td>Presione Click,en el Cod_Sucursal para ver las zona que tienen periodo de Nomina.</td>
  </tr>
</table>
<table border="1" align="center">
 <tr>
   <th>#</th>
   <th>Cod_Sucursal</th>
   <th>Sucursal</th>
   <th>Telefono</th>
   </tr>
<?$a=1;
  while($filas=mysql_fetch_array($resultado)):
?>
<tr class="cajas">
  <th><?echo $a;?></th>
  <td><a href="ListadoZona.php?CodSucursal=<?echo $filas["codsucursal"];?>"> 	<div align="center"><?echo $filas["codsucursal"];?></div></td>
  <td><?echo $filas["sucursal"];?></td>
  <td><?echo $filas["telsucursal"];?></td>
  </tr>
<? $a=$a+1;
endwhile;
endif;
?>
</table>
</body>


</html>
