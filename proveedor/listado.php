<html>

<head>
  <title>Listado de Proveedores</title>
 <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<?
 include("../conexion.php");
  $consulta="select provedor.*,sucursal.sucursal,municipio.municipio from provedor,sucursal,municipio where
                provedor.codsucursal=sucursal.codsucursal and
                municipio.codmuni=provedor.codmuni";
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
<center><h4>Listado de Proveedores</h4></center>
<table border="0" align="center">
 <tr>
   <td colspan="15"></td>
 </tr>
 <tr class="cajas">
   <th>Nit</th>
   <th>Dv</th>
   <th>Proveedor</th>
   <th>Direccion</th>
   <th>Telefono</th>
   <th>Fax</th>
   <th>Municipio</th>
   <th>Cuenta</th>
   <th>Tipo Cta</th>
   <th>Banco</th>
   <th>Sucursal</th>
</tr>
<?
  while($filas=mysql_fetch_array($resultado)):
  $banco=strtoupper($banco);
?>
<tr class="cajas">
  <td><?echo $filas["nitprove"];?></td>
  <td>&nbsp;<?echo $filas["dvprove"];?></td>
  <td>&nbsp;<?echo $filas["nomprove"];?></td>
  <td>&nbsp;<?echo $filas["dirprove"];?></td>
  <td>&nbsp;<?echo $filas["telprove"];?></td>
  <td>&nbsp;<?echo $filas["faxprove"];?></td>
  <td>&nbsp;<?echo $filas["municipio"];?></td>
  <td>&nbsp;<?echo $filas["cuenta"];?></td>
  <td>&nbsp;<?echo $filas["tipoc"];?></td>
  <td>&nbsp;<?echo $banco;?></td>
  <td>&nbsp;<?echo $filas["sucursal"];?></td>

 </tr>
<?
endwhile;
endif;
?>
</table>

</body>


</html>
