<?
 session_start();
?>
<html>

<head>
  <title>Centro de Costos</title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<?
 if(session_is_registered("xsession")):
 include("../conexion.php");
  $consulta="select * from costo";
  $resultado=mysql_query($consulta)or die ("Consulta incorrecta");
  $registros=mysql_num_rows($resultado);
  if ($registros==0):

?>
  <script language="javascript">
    alert("No existen Registro en la base de datos ?")
    history.back()
    </script>
 <?
   else:
  ?>
<center><h4><u>Centro de Costos</u></h4></center>
<table border="1" align="center">
 <tr class="cajas">
 <th>Item</th>
   <th>Codigo</th>
   <th>Descripción</th>
   <th>Estado</th>
  </tr>
<?
$i=1;
  while($filas=mysql_fetch_array($resultado)):
?>
<tr class="cajas">
   <th><?echo $i;?></th>
  <td><a href="modificardato.php?codcosto=<?echo $filas["codcosto"];?>"><?echo $filas["codcosto"];?></a></td>
  <td><?echo $filas["centro"];?></td>
  <td><?echo $filas["estado"];?></td>
 </tr>
  <?
  $i=$i+1;
  endwhile;
endif;
else:
?>
 <script language="javascript">
    alert("Debe de hacer Inicio de Sección")
    pagina='../acceso/agregar.php'
    tiempo=10
    ubicacion='_self'
    setTimeout("open(pagina,ubicacion)",tiempo)
 </script>
<?
endif;
?>
</table>
</body>


</html>
