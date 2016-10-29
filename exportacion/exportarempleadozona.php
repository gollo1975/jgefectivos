<html>
<head>
  <title></title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<center><h4><u>Empleados x Zona</u></h4></center>
<form action="" method="post">
  <table border="0" align="center" width="350">
    <tr>
    <tr><td><br></td></tr>
        <?
        include("../conexion.php");?>
        <td colspan="10"><b>Zona:&nbsp;</b></td><td><select name="select" onChange="location.href=this.value" class="cajas">
        <option>Seleccione la Zona</option>
        <?php $con="select codzona,zona from zona where estado='ACTIVA' order by zona";
        $resu=mysql_query($con)or die("Error de busqueda");
        while($filas=mysql_fetch_array($resu)):
        ?>
           <option value="auxiliarempleado.php?codzona=<? echo $filas["codzona"];?>"><?echo $filas["zona"];?>
        <?
        endwhile;?>
        </select></td>
       </tr>
           <tr><td><br></td></tr>
     </table>
   </form>
</body>
</html>
