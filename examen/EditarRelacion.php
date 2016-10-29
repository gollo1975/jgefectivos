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
  $consulta="select *,zona.zona from parametroexamen,zona where zona.codzona=parametroexamen.codzona";
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
<center><h4><u>Parametro Examen</u></h4></center>
<table border="1" align="center">
 <tr class="cajas">
 <th>Item</th>
   <th>Cod_Zona</th>
   <th>Zona</th>
   <th>Tipo_Pago</th>
  </tr>
<?
$i=1;
  while($filas=mysql_fetch_array($resultado)):
?>
<tr class="cajas">
   <th><?echo $i;?></th>
  <td><a href="ModificarDetalle.php?codzona=<?echo $filas["codzona"];?>"><?echo $filas["codzona"];?></a></td>
  <td><?echo $filas["zona"];?></td>
  <td><?echo $filas["tipopago"];?></td>
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
