<html>
<head>
  <title></title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<center><h4><u>Empleados x Sucursal</u></h4></center>
<form action="" method="post">
  <table border="0" align="center" width="200">
    <tr>
    <tr><td><br></td></tr>
        <?
        include("../conexion.php");?>
        <td colspan="10"><b>Sucursal:&nbsp;</b></td><td><select name="select" onChange="location.href=this.value" class="cajas">
        <option>Seleccione la Sucursal</option>
        <?php $con="select codsucursal,sucursal from sucursal where estado='ACTIVA' order by sucursal";
        $resu=mysql_query($con)or die("Error de busqueda");
        while($filas=mysql_fetch_array($resu)):
        ?>
           <option value="exportarempleadoSucursal.php?CodSucursal=<? echo $filas["codsucursal"];?>"><?echo $filas["sucursal"];?>
        <?
        endwhile;?>
        </select></td>
       </tr>
           <tr><td><br></td></tr>
     </table>
   </form>
</body>
</html>
