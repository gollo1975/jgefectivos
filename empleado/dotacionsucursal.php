<html>
<head>
  <title></title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<center><h5>Dotacion por Sucursal</h5></center>
<form action="" method="post">
  <table border="0" align="center" width="300">
    <tr>
    <tr><td><br></td></tr>
        <?
        include("../conexion.php");?>
        <td><b>Sucursal:</b></td><td><select name="select" onChange="location.href=this.value" class="cajas">
        <option>Seleccione la sucursal</option>
        <?$con="select sucursal.codsucursal,sucursal.sucursal from sucursal ";
        $resu=mysql_query($con)or die("Error de busqueda");
        while($filas=mysql_fetch_array($resu)):
        ?>
           <option value="detalladosucursal.php?codigo=<? echo $filas["codsucursal"];?>&sucursal=<? echo $filas["sucursal"];?>"><?echo $filas["sucursal"];?>
        <?
        endwhile;?>
        </select></td>
       </tr>
           <tr><td><br></td></tr>
     </table>
   </form>
</body>
</html>
