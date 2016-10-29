<html>

<head>
  <title>Consulta de Zonas</title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<?
include("../conexion.php");
$Sql = "select sucursal.*,municipio.municipio from maestro,sucursal,municipio where
                maestro.codmaestro = sucursal.codmaestro  and
				municipio.codmuni=sucursal.codmuni and
                sucursal.estado='ACTIVA' order by sucursal.sucursal";
$Rs=mysql_query($Sql)or die ("Consulta incorrecta");
?>
<div align="center"><b>LISTADO DE SUCURSALES</b></div>
<br>
<table border="0" align="center">
<tr class="cajas">
   <th>#</th> 
   <th>Cod_Sucursal</th>
   <th>Sucursal</th>
   <th>Direccion</th>
   <th>Teléfono</th>
   <th>Municipio</th>
</tr><?
$a=1;
while($filas=mysql_fetch_array($Rs)){
   ?>
     <tr class="cajas">
	   <th><?echo $a;?></th>
       <td><a href="detalladoZona.php?NroSucursal=<?echo $filas["codsucursal"];?>"><div align="center"><?echo $filas["codsucursal"];?></div></a></td>
       <td><?echo $filas["sucursal"];?></td>
       <td><?echo $filas["dirsucursal"];?></td>
       <td><?echo $filas["telsucursal"];?></td>
       <td><?echo $filas["municipio"];?></td>
    </tr>

    <?
$a +=1;	
	
}	   
?>
</table>

</body>
</html>
