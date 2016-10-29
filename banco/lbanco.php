<?
 session_start();
?>
<html>

<head>
  <title>Listado de Banco</title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<?
 if(session_is_registered("xsession")):
 include("../conexion.php");
  $consulta="select * from banco";
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
<center><h4><u>Listado</u></h4></center>
<table border="1" align="center">
 <tr class="cajas">
  <th>Item</th>
   <th>Cod_Banco</th>
   <th>Banco</th>
   <th>Dirección</th>
   <th>teléfono</th>
   <th>Municipio</th>
  </tr>
<?$a=1;
  while($filas=mysql_fetch_array($resultado)):
?>
<tr class="cajas">
  <th><?echo $a;?></th>
  <td><a href="modificar.php?codbanco=<?echo $filas["codbanco"];?>"><?echo $filas["codbanco"];?></a></td>
  <td><?echo $filas["bancos"];?></td>
  <td><?echo $filas["dirbanco"];?></td>
  <td><?echo $filas["telbanco"];?></td>
  <td><?echo $filas["municipio"];?></td>
 </tr>
  <? $a=$a+1;
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
