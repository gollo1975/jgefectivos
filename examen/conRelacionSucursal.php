<html>
<head>
  <title></title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<center><h4><u>Relacion de Examenes</u></h4></center>
<form action="" method="post">
  <table border="0" align="center" width="400">
    <tr>
    <tr><td><br></td></tr>
        <?
        include("../conexion.php");?>
        <td colspan="20"><b>Empresa:</b></td><td><select name="select" onChange="location.href=this.value" class="cajas">
        <option>Seleccione la Empresa</option>
        <?$con="select zona.codzona,zona.zona from zona,sucursal where sucursal.codsucursal=zona.codsucursal and sucursal.codsucursal='$codigo' and zona.estado='ACTIVA' order by zona.zona";
        $resu=mysql_query($con)or die("Error de busqueda");
        while($filas=mysql_fetch_array($resu)):
        ?>
           <option value="auxiliarexamen.php?codzona=<? echo $filas["codzona"];?>&codS<?echo $codigo;?>"><?echo $filas["zona"];?>
        <?
        endwhile;?>
        </select></td>
       </tr>
           <tr><td><br></td></tr>
     </table>
   </form>
</body>
</html>
