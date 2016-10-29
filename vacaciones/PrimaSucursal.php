<html>
<head>
  <title></title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<center><h4>Primas Semestrales</h4></center>
<form action="" method="post">
  <table border="0" align="center" width="300">
    <tr>
    <tr><td><br></td></tr>
        <?
        include("../conexion.php");?>
        <td colspan="10	"><b>Sucursal:</b></td><td colspan="30"><select name="select" onChange="location.href=this.value" class="cajas">
        <option>Seleccione la Sucursal</option>
        <?$con="select sucursal.codsucursal,sucursal.sucursal from sucursal where sucursal.estado='ACTIVA' order by sucursal.sucursal";
        $resu=mysql_query($con)or die("Error de busqueda de zonas");
        while($filas=mysql_fetch_array($resu)):
       ?>
         <option value="DetalladoPrimaSucursal.php?CodSucursal=<? echo $filas["codsucursal"];?>"><?echo $filas["sucursal"];?>
        <?
        endwhile;?>
               </select></td>
       </tr>
       <tr><td><br></td></tr> 
     </table>
   </form>
</body>
</html>
