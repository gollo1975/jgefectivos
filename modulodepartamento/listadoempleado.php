<html>

<head>
  <title>Listado de Zonas</title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<?
include("../conexion.php");
$con="select zona.codzona,zona.zona,zona.telzona from zona,sucursal
   where sucursal.codsucursal=zona.codsucursal and
   sucursal.codsucursal='$codigo' order by zona.zona";
$resu=mysql_query($con)or die("Error al buscar zonas");
$reg=mysql_num_rows($resu);
if($reg!=0):
   ?>
   <div align="center"><h4>Listado de Zonas(ERS)</h4></div>
    <table border="0" align="center">
      <tr><td class="cajas">Para ver los empleados por zona, Presione Click en el Campo [Cod_Zona]</td></tr>
    </table>
   <table border="0" align="center">
      <tr><td><br></td></tr>
      <tr class="cajas">
        <th>Cod_Zona</th>
        <th>Zona</th>
        <th>Telefono</th>
      </tr>
      <?
      while($filas=mysql_fetch_array($resu)):
         ?>
         <tr class="cajas">
           <td><a href="empleadoactivo.php?codzona=<?echo $filas["codzona"];?>"><?echo $filas["codzona"];?></a></td>
           <td><?echo $filas["zona"];?></td>
           <td><?echo $filas["telzona"];?></td>
         </tr>
         <?
      endwhile;
      ?>
   </table>
   <?
else:
  ?>
  <script language="javascript">
    alert("No hay zonas de servicios en esta sucursal ?")
    history.back()
  </script>
  <?
endif;
?>

</body>

</html>
